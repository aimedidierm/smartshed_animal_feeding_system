
int echoPin=3;
int trigPin=2;

int echoPin=3;
int trigPin=2;

void setup() {
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  Serial.begin(9600);
}
void loop() {
  gedis(trigPin, echoPin);
  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");
}
void gedis(int trigPin, int echoPin){
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = duration * 0.034 / 2;
  return distance;
  }
