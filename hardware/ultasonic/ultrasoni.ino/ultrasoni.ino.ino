two_ultrasonic.ino
//Sonar 1
int echoPin1 = 3;
int initPin1 = 2;
int distance1 =0;

//Sonar 2
int echoPin2 = 8;
int initPin2 = 7;
int distance2 =0;

int ledPin3  = 13; // for led

// for indivisual sensor -> led will start blowing and stop when distance is graeter than critcal distance =>50 cm
int isDisSensor = 0;
int isDisSensor2 = 0;

void setup() {
  pinMode(initPin1, OUTPUT);
  pinMode(echoPin1, INPUT);
  pinMode(initPin2, OUTPUT);
  pinMode(echoPin2, INPUT);
  pinMode(ledPin3, OUTPUT);
  Serial.begin(9600);
n }

void loop() {
  distance1 = getDistance(initPin1, echoPin1);
  printDistance(1, distance1);
  delay(1000);
  
  distance2 = getDistance(initPin2, echoPin2);
  printDistance(2, distance2);
  delay(1000);
}

/* called by individual senser to get distance 
   first triger the triger and than delay with 1 micro second
   than stop the triger and 
   start echo to get wave back to sensor 
   and messure distance
   ---- last line */
int getDistance (int initPin, int echoPin){
 digitalWrite(initPin, HIGH);
 delayMicroseconds(10); 
 digitalWrite(initPin, LOW); 
 
 unsigned long pulseTime = pulseIn(echoPin, HIGH); 
 int distance = pulseTime/58;
 return distance;
 
}

/* LOW ==> stop 
 * HIGH ==> start working 
 *  
 *  
 * id == sesonr id
  distance == distance got from sensar
  if 
   checking for minimum distance  <= 50 
    write out of rang and 
    check by which sensor this method call
      making that sensor mini distcane  == 1
      and led will call to High 
  else 
   write the -----
   cheking from which sensor called 
     making that sensor mini distcane variable == 0
     and call led to LOW */

void printDistance(int id, int dist) {
    Serial.print("sensor number ");
    Serial.print(id);
    Serial.print(":  ");
    if (dist <= 50 || dist == 0 ){
      Serial.print ( dist);
      Serial.println(" Out of range");
      if(id ==1) {
        isDisSensor = 1;  
        digitalWrite(ledPin3, HIGH);
      } else {
        isDisSensor2 = 1;  
        digitalWrite(ledPin3, HIGH);
      }        
    } else {
      Serial.print("----------");
      if(id ==1) {
        if(isDisSensor == 1){  
          isDisSensor = 0;  
          digitalWrite(ledPin3, LOW);
        }
      } else {
         if(isDisSensor2 == 1){  
           isDisSensor2 = 0;  
           digitalWrite(ledPin3, LOW);
        }
      }        
      
      Serial.print(dist, DEC);
      Serial.println(" cm");
    }
}
