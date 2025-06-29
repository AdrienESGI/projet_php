// server.ino
#include "declarations.h"

bool IsUserAuthed(AsyncWebServerRequest *request) {
  String authCookie = GetCookieValueByKey(request, "token");
  if (authCookie != "") {
    if (kvdb_get(authCookie) != "") {
      return true;
    }
  }
  return false;
}

void initWebServer() {
  Serial.println("initWebServer");

  // API Routes sont gérées dans api.ino via setupApi()
  server.onNotFound([](AsyncWebServerRequest *request) {
    prettyPrintRequest(request);
    request->send(404, "text/plain", "Not Found");
  });

  // Gestion du fichier upload
  server.onFileUpload(handleFileUpload);

  // Route principale
  server.addHandler(new MainRouter());

  server.begin();
  Serial.println("HTTP server started");
}

void HandleDirRender(AsyncWebServerRequest *r, String dirName, String dirToList) {
  File dir = SD.open(dirToList);
  if (!dir || !dir.isDirectory()) {
    r->send(500, "text/plain", "Not a directory");
    return;
  }

  AsyncResponseStream *response = r->beginResponseStream("text/html");
  response->print("<html><body><h2>Directory: " + dirName + "</h2><ul>");

  File file = dir.openNextFile();
  while (file) {
    response->print("<li><a href='" + String(file.name()) + "'>" + String(file.name()) + "</a> (" + humanReadableSize(file.size()) + ")</li>");
    file = dir.openNextFile();
  }

  response->print("</ul></body></html>");
  r->send(response);
  dir.close();
}