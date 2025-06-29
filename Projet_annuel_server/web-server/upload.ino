/*
    Upload.ino
    This script handles file upload to the web-stick.
    Requires admin authentication (admin.txt)
*/

#include "declarations.h"

String trimFilename(String filename) {
  if (filename.length() > 31) return filename.substring(0, 31);
  return filename;
}

void handleFileUpload(AsyncWebServerRequest *request, String filename, size_t index, uint8_t *data, size_t len, bool final) {
  if (IsUserAuthed(request)) {
    String logmessage = "Client:" + request->client()->remoteIP().toString() + " " + request->url();
    Serial.println(logmessage);

    filename = trimFilename(filename);
    String dirToStore = GetPara(request, "dir");
    if (!dirToStore.startsWith("/")) dirToStore = "/" + dirToStore;
    if (!dirToStore.endsWith("/")) dirToStore += "/";
    dirToStore = "/www" + dirToStore;

    if (!index) {
      Serial.println("Selected Upload Dir: " + dirToStore);
      if (!SD.exists(dirToStore)) SD.mkdir(dirToStore);
      if (SD.exists(dirToStore + filename)) SD.remove(dirToStore + filename);
      request->_tempFile = SD.open(dirToStore + filename, FILE_WRITE);
      Serial.println("Upload Start: " + filename);
    }

    if (len) {
      request->_tempFile.write(data, len);
    }

    if (final) {
      request->_tempFile.close();
      Serial.println("Upload Complete: " + filename + ", size: " + String(index + len));
      if (!SD.exists(dirToStore + filename)) {
        SendErrorResp(request, "Write failed for " + filename + ". Try a shorter name!");
        return;
      }
      request->send(200, "application/json", "ok");
    }
  } else {
    Serial.println("Auth: Failed");
    SendErrorResp(request, "unauthorized");
  }
}

uint8_t getUtf8CharLength(const uint8_t firstByte) {
  if ((firstByte & 0x80) == 0) return 1;
  else if ((firstByte & 0xE0) == 0xC0) return 2;
  else if ((firstByte & 0xF0) == 0xE0) return 3;
  else if ((firstByte & 0xF8) == 0xF0) return 4;
  return 0;
}

String filterBrokenUtf8(const String& input) {
  String result;
  size_t len = input.length();
  size_t i = 0;
  while (i < len) {
    uint8_t firstByte = input[i];
    uint8_t charLen = getUtf8CharLength(firstByte);
    if (charLen == 0 || (i + charLen > len)) break;
    for (uint8_t j = 0; j < charLen; j++) result += input[i++];
  }
  return result;
}

String trimFilename(String& filename) {
  filename.replace("#", "");
  filename.replace("?", "");
  filename.replace("&", "");
  int dotIndex = filename.lastIndexOf('.');
  if (dotIndex > 0 && dotIndex < filename.length() - 1) {
    int maxLength = 32 - (filename.length() - dotIndex - 1);
    if (filename.length() > maxLength) {
      String trimmed = filterBrokenUtf8(filename.substring(0, maxLength)) + filename.substring(dotIndex);
      return trimmed;
    }
  }
  return filename;
}

void setupUpload() {
  server.on("/upload", HTTP_POST,
    [](AsyncWebServerRequest *request) {
      request->send(200, "text/plain", "Upload complete");
    },
    handleFileUpload);
}
