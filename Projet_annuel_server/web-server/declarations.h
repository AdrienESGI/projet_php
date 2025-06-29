#ifndef DECLARATIONS_H
#define DECLARATIONS_H

#include <Arduino.h>
#include <ESPAsyncWebServer.h>
#include <FS.h>
#include <SD.h>

// Globals
extern AsyncWebServer server;
extern String adminUsername;
extern String adminPassword;
extern String mdnsName;
extern String authSession;

// System
long getSDCardUsedSpace();
long getSDCardTotalSpace();
unsigned long getTime();

void initWiFiConn();
void initAdminCredentials();
void initmDNSName();
void initLoginSessionKey();
void printESPInfo();

void initWebServer();
void setupApi(AsyncWebServer &server);

// MIME, FS, Cookies
String getMime(const String& path);
bool IsDir(const String& path);
String GetCookieValueByKey(AsyncWebServerRequest*, const String&);
String humanReadableSize(unsigned long);
bool recursiveDirRemove(const String&);
void scanSDCardForKeyword(const String&, const String&, int*, AsyncResponseStream*);

// DB
bool DBWrite(String table, String key, String value);
bool DBRemove(String table, String key);
bool DBKeyExists(String table, String key);
String DBRead(String table, String key);
void DBInit();
void DBNewTable(String table);

// KVDB
void kvdb_set(String key, String value);
String kvdb_get(String key);
void kvdb_del(String key);

// --- HANDLER DECLARATIONS ---
void HandleCheckAuth(AsyncWebServerRequest *request);
void HandleLogin(AsyncWebServerRequest *request);
void HandleLogout(AsyncWebServerRequest *request);

void HandleListDir(AsyncWebServerRequest *request);
void HandleFileDel(AsyncWebServerRequest *request);
void HandleFileRename(AsyncWebServerRequest *request);
void HandleFileDownload(AsyncWebServerRequest *request);
void HandleNewFolder(AsyncWebServerRequest *request);
void HandleLoadSpaceInfo(AsyncWebServerRequest *request);
void HandleFileProp(AsyncWebServerRequest *request);
void HandleFileSearch(AsyncWebServerRequest *request);
void HandleSetPref(AsyncWebServerRequest *request);
void HandleLoadPref(AsyncWebServerRequest *request);
void HandleMeteoCurrentReadings(AsyncWebServerRequest *request);
void HandleWiFiInfo(AsyncWebServerRequest *request);

// Upload
void handleFileUpload(AsyncWebServerRequest *request, String filename, size_t index, uint8_t *data, size_t len, bool final);

#endif
