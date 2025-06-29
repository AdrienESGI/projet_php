// WiFi
#include <WiFi.h>
#include <WiFiUdp.h>
#include <ESPmDNS.h>
#include <NTPClient.h>

// Stockage
#include <SPI.h>
#include <SD.h>
#include <FS.h>

// Web Server
#include <ESPAsyncWebServer.h>
#include <ArduinoJson.h>
#include "declarations.h"

// Configuration matérielle
#define CS_PIN 7 // PIN CS SD

// Variables globales
AsyncWebServer server(80);
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP, "pool.ntp.org");

String adminUsername = "";
String adminPassword = "";
String mdnsName = "webstick";
String authSession = "";



void setup() {
  Serial.begin(115200);
  Serial.println("TinyNAS booting...");

  // Initialisation SD
  while (!SD.begin(CS_PIN)) {
    Serial.println("SD card init failed. Retry in 3s...");
    delay(3000);
  }
  Serial.println("SD card initialized.");
  getSDCardTotalSpace();
  getSDCardUsedSpace();

  // Connexion WiFi (fichier cfg/wifi.txt)
  initWiFiConn();

  // Chargement credentials admin (cfg/admin.txt)
  initAdminCredentials();

  // mDNS
  initmDNSName();
  if (!MDNS.begin(mdnsName)) {
    Serial.println("mDNS start failed.");
  } else {
    Serial.println("mDNS ok: http://" + mdnsName + ".local");
    MDNS.addService("http", "tcp", 80);
  }

  // Temps via NTP
  timeClient.begin();
  timeClient.update();
  Serial.print("Heure NTP: ");
  Serial.println(getTime());

  // Init base de données
  DBInit();

  // Restauration session
  initLoginSessionKey();

  // Serveur HTTP
  initWebServer();
  setupApi(server);  // Routes API
}

void loop() {
  timeClient.update();
  delay(10);
}
