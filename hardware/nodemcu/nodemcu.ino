#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include<SoftwareSerial.h>
SoftwareSerial s(3,1);
const char* ssid = "Virus";
const char* password = "mbega123455";
String serverName = "http://192.168.43.76/smartshed_animal_feeding_system/data.php";
//String serverName = "http://137.184.232.255/smart_toilet_card/data.php";
//String serverName = "http://didier.requestcatcher.com/data.php";
void setup() {
  s.begin(9600);
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED) {
  delay(500);
  }
}

void loop() {
    if(WiFi.status()== WL_CONNECTED){
      WiFiClient client;
      HTTPClient http;
      //String   httpRequestData = Serial.readStringUntil('\n');
      http.begin(client, serverName);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");
      String httpRequestData = s.readStringUntil('\n');
      int      httpResponseCode = http.POST(httpRequestData);
      if (httpResponseCode>0) {
        s.println(httpResponseCode);
        String payload = http.getString();
        s.println(payload);
      }
      // Free resources
      http.end();
    }
  }
