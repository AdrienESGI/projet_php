/*
    internal.ino
    - Gère la configuration WiFi, les identifiants admin
    - Détermine les infos de la carte SD et le mDNS
*/

#include <WiFi.h>
#include <SD.h>
#include <FS.h>
#include "declarations.h"

extern String adminUsername;
extern String adminPassword;
extern String mdnsName;
extern String authSession;
extern String DBRead(String table, String key);
extern String humanReadableSize(unsigned long size);

String loadWiFiInfoFromSD() {
  if (!SD.exists("/cfg/wifi.txt")) return "";
  File f = SD.open("/cfg/wifi.txt", FILE_READ);
  String content = "";
  while (f.available()) content += char(f.read());
  f.close();
  return content;
}

void splitWiFiFileContent(const String& src, String& ssid, String& pass) {
  int idx = src.indexOf('\n');
  if (idx != -1) {
    ssid = src.substring(0, idx);
    pass = src.substring(idx + 1);
  }
}

void initWiFiConn() {
  String content = loadWiFiInfoFromSD();
  if (content == "") {
    while (1) {
      Serial.println("Missing /cfg/wifi.txt with SSID + Password");
      delay(3000);
    }
  }
  String ssid, password;
  splitWiFiFileContent(content, ssid, password);
  ssid.trim();
  password.trim();
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("\nConnected.");
  Serial.println("IP: " + WiFi.localIP().toString());
}

String loadAdminCredFromSD() {
  if (!SD.exists("/cfg/admin.txt")) return "";
  File f = SD.open("/cfg/admin.txt", FILE_READ);
  String content = "";
  while (f.available()) content += char(f.read());
  f.close();
  return content;
}

void splitAdminCreds(const String& src, String& username, String& pass) {
  int idx = src.indexOf('\n');
  if (idx != -1) {
    username = src.substring(0, idx);
    pass = src.substring(idx + 1);
  }
}

void initAdminCredentials() {
  String content = loadAdminCredFromSD();
  if (content == "") return;
  splitAdminCreds(content, adminUsername, adminPassword);
  adminUsername.trim();
  adminPassword.trim();
  Serial.println("Admin loaded: " + adminUsername);
}

void initmDNSName() {
  if (!SD.exists("/cfg/mdns.txt")) return;
  File f = SD.open("/cfg/mdns.txt", FILE_READ);
  String name = "";
  while (f.available()) name += char(f.read());
  f.close();
  name.trim();
  mdnsName = name;
}

void initLoginSessionKey() {
  String cookie = DBRead("auth", "cookie");
  if (cookie != "") authSession = cookie;
}

String getMime(const String& path) {
  if (path.endsWith(".html")) return "text/html";
  if (path.endsWith(".css")) return "text/css";
  if (path.endsWith(".js")) return "application/javascript";
  if (path.endsWith(".png")) return "image/png";
  if (path.endsWith(".jpg")) return "image/jpeg";
  if (path.endsWith(".gif")) return "image/gif";
  if (path.endsWith(".svg")) return "image/svg+xml";
  if (path.endsWith(".ico")) return "image/x-icon";
  return "text/plain";
}

uint32_t getTotalUsedSpace(const String& dir) {
  uint32_t total = 0;
  File root = SD.open(dir);
  while (root && root.available()) {
    File entry = root.openNextFile();
    if (!entry) break;
    if (entry.isDirectory())
      total += getTotalUsedSpace(dir + "/" + entry.name());
    else
      total += entry.size();
    entry.close();
  }
  root.close();
  return total;
}

long getSDCardUsedSpace() {
  uint32_t used = getTotalUsedSpace("/");
  Serial.println("Used: " + humanReadableSize(used));
  return used;
}

long getSDCardTotalSpace() {
  uint64_t total = SD.cardSize();
  Serial.println("Total: " + humanReadableSize(total));
  return total;
}

String humanReadableSize(unsigned long bytes) {
  if (bytes < 1024) return String(bytes) + " B";
  if (bytes < 1024 * 1024) return String(bytes / 1024.0, 2) + " KB";
  return String(bytes / 1024.0 / 1024.0, 2) + " MB";
}
