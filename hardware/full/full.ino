#include <Servo.h>
Servo myservo1;
Servo myservo2;

int ldr1=A0;
int ldr2=A1;

//Sonar 1
int echoPin1 = 3;
int initPin1 = 2;
int distance1 =0;

//Sonar 2
int echoPin2 = 9;
int initPin2 = 7;
int distance2 =0;


//other
int pump = 4;
int isDisSensor = 0;
int isDisSensor2 = 0;
int pos = 0;
int value1=0;
int value2=0;
void setup() {
  myservo1.attach(6);
  myservo2.attach(10);
  pinMode(pump, OUTPUT);
  digitalWrite(pump, HIGH); 
  pinMode(initPin1, OUTPUT);
  pinMode(echoPin1, INPUT);
  pinMode(initPin2, OUTPUT);
  pinMode(echoPin2, INPUT);
  myservo1.write(0);
  myservo2.write(0);
}

void loop() {
  value1=analogRead(ldr1);
  value2=analogRead(ldr2);
  digitalWrite(pump, HIGH); 
  distance1 = getDistance(initPin1, echoPin1);
  distance2 = getDistance(initPin2, echoPin2);
  if (distance1 <= 40){
    son1();
  }
  if(value1<100)
  {
    opense1();
  }
  if(value2<100)
  {
    opense2();
  }
 son2();
}
int getDistance (int initPin, int echoPin){
 digitalWrite(initPin, HIGH);
 delayMicroseconds(10); 
 digitalWrite(initPin, LOW); 
 
 unsigned long pulseTime = pulseIn(echoPin, HIGH); 
 int distance = pulseTime/58;
 return distance;
 
}
void son1(){
  digitalWrite(pump, LOW);
  delay(2000);
  digitalWrite(pump, HIGH);
  }
void son2(){
  //Kohereza data kuri website
  }
void opense1(){
  for (pos = 0; pos <= 180; pos += 1) {
    myservo1.write(pos);
    delay(15);
  }
  delay(200);
  for (pos = 180; pos >= 0; pos -= 1) {
    myservo1.write(pos);
    delay(15);
  }
}
void opense2(){
  for (pos = 0; pos <= 180; pos += 1) {
    myservo2.write(pos);
    delay(15);
  }
  delay(200);
  for (pos = 180; pos >= 0; pos -= 1) {
    myservo2.write(pos);
    delay(15);
  }
}
