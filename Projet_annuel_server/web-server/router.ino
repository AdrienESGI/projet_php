// router.ino - version propre et corrigée
#include "declarations.h"

void serveStaticFile(AsyncWebServerRequest *request, const String &filePath, const String &mimeType) {
  if (SD.exists(filePath)) {
    request->send(SD, filePath, mimeType);
  } else {
    request->send(404, "text/plain", "File not found");
  }
}

void HandleDirRender(AsyncWebServerRequest *r, const String &uri, const String &dirPath) {
  AsyncResponseStream *response = r->beginResponseStream("text/html");
  response->print("<html><body><h2>Directory Listing</h2><ul>");
  File dir = SD.open(dirPath);
  File entry = dir.openNextFile();
  while (entry) {
    response->print("<li>");
    response->print(entry.name());
    response->print("</li>");
    entry = dir.openNextFile();
  }
  response->print("</ul></body></html>");
  r->send(response);
}

class MainRouter : public AsyncWebHandler {
public:
  MainRouter() { Serial.println("Init MainRouter"); }

  bool canHandle(AsyncWebServerRequest *request) override {
    String requestURI = request->url();
    if (requestURI.equals("/upload") || requestURI.startsWith("/api/")) {
      return false;
    }
    return true;
  }

  void handleRequest(AsyncWebServerRequest *request) override {
    String requestURI = request->url();
    if (requestURI == "/") {
      request->redirect("/index.html");
      return;
    }

    if (requestURI.startsWith("/store/")) {
      request->send(403, "text/plain", "Forbidden");
      return;
    }

    String fullPath = "/www" + requestURI;
    if (SD.exists(fullPath)) {
      if (IsDir(fullPath)) {
        String indexPath = fullPath + "/index.html";
        if (SD.exists(indexPath)) {
          serveStaticFile(request, indexPath, getMime("index.html"));
        } else {
          HandleDirRender(request, requestURI, fullPath);
        }
      } else {
        serveStaticFile(request, fullPath, getMime(requestURI));
      }
    } else {
      request->send(404, "text/html", "<h1>404 - Not Found</h1>");
    }
  }
};
