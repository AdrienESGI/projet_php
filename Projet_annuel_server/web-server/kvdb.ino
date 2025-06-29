#include "declarations.h"

String DBCleanInput(const String& inputString) {
  String result = inputString;
  result.trim();
  result.replace("/", "_");
  result.replace("\\", "_");
  result.replace(":", "_");
  result.replace("*", "_");
  result.replace("?", "_");
  result.replace("\"", "_");
  result.replace("<", "_");
  result.replace(">", "_");
  result.replace("|", "_");
  return result;
}

void DBInit() {
  if (!SD.exists("/db")) SD.mkdir("/db");
}

void DBNewTable(String tableName) {
  String clean = DBCleanInput(tableName);
  String path = "/db/" + clean;
  if (!SD.exists(path)) SD.mkdir(path);
}

bool DBTableExists(String tableName) {
  String clean = DBCleanInput(tableName);
  return SD.exists("/db/" + clean);
}

bool DBWrite(String tableName, String key, String value) {
  String table = DBCleanInput(tableName);
  String fkey = DBCleanInput(key);
  String path = "/db/" + table + "/" + fkey;

  File f = SD.open(path, FILE_WRITE);
  if (!f) return false;
  f.print(value);
  f.close();
  return true;
}

String DBRead(String tableName, String key) {
  String table = DBCleanInput(tableName);
  String fkey = DBCleanInput(key);
  String path = "/db/" + table + "/" + fkey;

  File f = SD.open(path);
  if (!f) return "";
  String value = f.readString();
  f.close();
  return value;
}

bool DBKeyExists(String tableName, String key) {
  String table = DBCleanInput(tableName);
  String fkey = DBCleanInput(key);
  return SD.exists("/db/" + table + "/" + fkey);
}

bool DBRemove(String tableName, String key) {
  String table = DBCleanInput(tableName);
  String fkey = DBCleanInput(key);
  return SD.remove("/db/" + table + "/" + fkey);
}

// KVDB simple
void kvdb_set(String key, String value) {
  DBWrite("kvdb", key, value);
}

String kvdb_get(String key) {
  return DBRead("kvdb", key);
}

void kvdb_del(String key) {
  DBRemove("kvdb", key);
}
