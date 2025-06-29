#include <ArduinoJson.h>
#include <mbedtls/md.h>
#include "declarations.h"

// Utils
String GetPara(AsyncWebServerRequest *request, String key) {
  if (request->hasParam(key)) return request->getParam(key)->value();
  return "";
}

void SendErrorResp(AsyncWebServerRequest *r, String msg) {
  StaticJsonDocument<200> doc;
  doc["error"] = msg;
  String out;
  serializeJson(doc, out);
  r->send(200, "application/json", out);
}

void SendJsonResp(AsyncWebServerRequest *r, String json) {
  r->send(200, "application/json", json);
}

void SendOK(AsyncWebServerRequest *r) {
  r->send(200, "application/json", "\"ok\"");
}

// --- Handlers ---
void HandleCheckAuth(AsyncWebServerRequest *r) {
  if (!r->hasHeader("Cookie")) {
    r->send(200, "application/json", "false"); return;
  }
  String token = r->header("Cookie").substring(6);
  r->send(200, "application/json", kvdb_get(token) != "" ? "true" : "false");
}

void HandleLogin(AsyncWebServerRequest *request) {
  if (!request->hasParam("username", true) || !request->hasParam("password", true)) {
    request->send(400, "application/json", "{\"error\":\"missing parameters\"}");
    return;
  }
String username = request->getParam("username", true)->value();
String password = request->getParam("password", true)->value();

// Lire le fichier admin.txt
File f = SD.open("/cfg/admin.txt");
if (!f) {
  request->send(500, "application/json", "{\"error\":\"admin config missing\"}");
  return;
}

String fileUser = f.readStringUntil('\n');
String filePass = f.readStringUntil('\n');
f.close();
fileUser.trim(); filePass.trim();

if (username == fileUser && password == filePass) {
  String token = String(random(0xFFFFFFF), HEX);
  kvdb_set(token, username);
  AsyncWebServerResponse *resp = request->beginResponse(200, "application/json", "{\"status\":\"login ok\"}");
  resp->addHeader("Set-Cookie", "token=" + token + "; Path=/; HttpOnly");
  request->send(resp);
} else {
  request->send(401, "application/json", "{\"status\":\"error\", \"error\":\"Invalid credentials\"}");
}

}


void HandleLogout(AsyncWebServerRequest *r) {
  if (r->hasHeader("Cookie")) {
    String token = r->header("Cookie").substring(6);
    kvdb_del(token);
  }
  AsyncWebServerResponse *resp = r->beginResponse(200, "text/plain", "Logged out");
  resp->addHeader("Set-Cookie", "token=deleted; Path=/; Expires=Thu, 01 Jan 1970 00:00:00 GMT");
  r->send(resp);
}

void HandleListDir(AsyncWebServerRequest *r) {
  String path = GetPara(r, "dir");
  if (!SD.exists(path)) { SendErrorResp(r, "Directory not found"); return; }

  File root = SD.open(path);
  if (!root || !root.isDirectory()) { SendErrorResp(r, "Not a directory"); return; }

  String json = "[";
  File file = root.openNextFile();
  bool first = true;
  while (file) {
    if (!first) json += ",";
    json += "{\"name\":\"" + String(file.name()) + "\",\"size\":" + String(file.size()) +
            ",\"type\":\"" + (file.isDirectory() ? "dir" : "file") + "\"}";
    file = root.openNextFile();
    first = false;
  }
  json += "]";
  SendJsonResp(r, json);
}

void HandleFileDel(AsyncWebServerRequest *r) {
  String path = GetPara(r, "file");
  if (SD.remove(path)) SendOK(r);
  else SendErrorResp(r, "Deletion failed");
}

void HandleFileRename(AsyncWebServerRequest *r) {
  String src = GetPara(r, "src");
  String dst = GetPara(r, "dest");
  if (!SD.exists(src)) { SendErrorResp(r, "Source does not exist"); return; }
  if (SD.rename(src, dst)) SendOK(r);
  else SendErrorResp(r, "Rename failed");
}

void HandleFileDownload(AsyncWebServerRequest *r) {
  String path = GetPara(r, "file");
  if (!SD.exists(path)) { SendErrorResp(r, "File not found"); return; }
  r->send(SD, path, getMime(path));
}

void HandleNewFolder(AsyncWebServerRequest *r) {
  String path = GetPara(r, "path");
  if (SD.mkdir("/www/" + path)) SendOK(r);
  else SendErrorResp(r, "Folder creation failed");
}

void HandleFileProp(AsyncWebServerRequest *r) {
  String path = GetPara(r, "file");
  File f = SD.open(path);
  if (!f) { SendErrorResp(r, "Unable to open file"); return; }
  String json = "{\"name\":\"" + String(f.name()) + "\",\"size\":" + String(f.size()) + "}";
  f.close();
  SendJsonResp(r, json);
}

void HandleLoadSpaceInfo(AsyncWebServerRequest *r) {
  String json = "{\"diskSpace\":" + String(getSDCardTotalSpace()) + ",\"usedSpace\":" + String(getSDCardUsedSpace()) + "}";
  SendJsonResp(r, json);
}

void HandleFileSearch(AsyncWebServerRequest *r) {
  String keyword = GetPara(r, "keyword");
  if (keyword == "") { SendErrorResp(r, "Keyword required"); return; }
  AsyncResponseStream *response = r->beginResponseStream("application/json");
  response->print("[");
  int foundCounter = 0;
  scanSDCardForKeyword("/www", keyword, &foundCounter, response);
  response->print("]");
  r->send(response);
}

void HandleSetPref(AsyncWebServerRequest *r) {
  String key = GetPara(r, "key");
  String value = GetPara(r, "value");
  if (key == "" || value == "") { SendErrorResp(r, "Missing key/value"); return; }
  DBWrite("pref", key, value);
  SendOK(r);
}

void HandleLoadPref(AsyncWebServerRequest *r) {
  String key = GetPara(r, "key");
  if (!DBKeyExists("pref", key)) { SendErrorResp(r, "Not found"); return; }
  SendJsonResp(r, "\"" + DBRead("pref", key) + "\"");
}

void HandleMeteoCurrentReadings(AsyncWebServerRequest *r) {
  StaticJsonDocument<64> json;
  json["temp"] = 22.0;
  String result;
  serializeJson(json, result);
  r->send(200, "application/json", result);
}

void HandleWiFiInfo(AsyncWebServerRequest *r) {
  StaticJsonDocument<256> json;
  json["SSID"] = WiFi.SSID();
  json["IP"] = WiFi.localIP().toString();
  json["RSSI"] = WiFi.RSSI();
  String out;
  serializeJson(json, out);
  r->send(200, "application/json", out);
}

void setupApi(AsyncWebServer &server) {
  server.on("/api/auth/chk", HTTP_GET, HandleCheckAuth);
  server.on("/api/auth/login", HTTP_POST, HandleLogin);
  server.on("/api/auth/logout", HTTP_GET, HandleLogout);
  server.on("/api/fs/list", HTTP_GET, HandleListDir);
  server.on("/api/fs/delete", HTTP_GET, HandleFileDel);
  server.on("/api/fs/move", HTTP_POST, HandleFileRename);
  server.on("/api/fs/download", HTTP_GET, HandleFileDownload);
  server.on("/api/fs/newFolder", HTTP_POST, HandleNewFolder);
  server.on("/api/fs/properties", HTTP_GET, HandleFileProp);
  server.on("/api/fs/disk", HTTP_GET, HandleLoadSpaceInfo);
  server.on("/api/fs/search", HTTP_GET, HandleFileSearch);
  server.on("/api/pref/set", HTTP_GET, HandleSetPref);
  server.on("/api/pref/get", HTTP_GET, HandleLoadPref);
  server.on("/api/meteo/getCurrent", HTTP_GET, HandleMeteoCurrentReadings);
  server.on("/api/info/wifi", HTTP_GET, HandleWiFiInfo);
}
