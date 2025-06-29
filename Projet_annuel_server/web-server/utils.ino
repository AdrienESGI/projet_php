// utils.ino
#include "declarations.h"

String GetCookieValueByKey(AsyncWebServerRequest *request, const String &key) {
  if (!request->hasHeader("Cookie")) return "";
  String cookie = request->header("Cookie");
  int pos = cookie.indexOf(key + "=");
  if (pos == -1) return "";
  int start = pos + key.length() + 1;
  int end = cookie.indexOf(';', start);
  if (end == -1) end = cookie.length();
  return cookie.substring(start, end);
}

bool IsDir(const String &path) {
  File f = SD.open(path);
  bool result = f && f.isDirectory();
  f.close();
  return result;
}

String humanReadableSize(unsigned long bytes) {
  if (bytes < 1024) return String(bytes) + " B";
  else if (bytes < 1024 * 1024) return String(bytes / 1024.0, 2) + " KB";
  else if (bytes < 1024 * 1024 * 1024) return String(bytes / 1024.0 / 1024.0, 2) + " MB";
  return String(bytes / 1024.0 / 1024.0 / 1024.0, 2) + " GB";
}

void prettyPrintRequest(AsyncWebServerRequest *request) {
  Serial.println("[HTTP REQUEST]");
  Serial.println("Method: " + String((int)request->method()));
  Serial.println("URL: " + request->url());
  Serial.println("Headers: " + String(request->headers()));
  for (int i = 0; i < request->headers(); i++) {
    AsyncWebHeader *h = request->getHeader(i);
    Serial.println("  " + h->name() + ": " + h->value());
  }
  Serial.println("Params: " + String(request->params()));
  for (int i = 0; i < request->params(); i++) {
    AsyncWebParameter *p = request->getParam(i);
    Serial.println("  " + p->name() + " = " + p->value());
  }
}
