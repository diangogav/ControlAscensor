int redpin = 7;
int greenpin = 8;
int fanpin = 9;
String incomingbyte;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600); //Starts the serial connection
  pinMode(redpin, OUTPUT);
  pinMode(greenpin, OUTPUT);
  pinMode(fanpin, OUTPUT);

}

void loop() {
  // put your main code here, to run repeatedly:
  if (Serial.available() > 0) {
    incomingbyte = Serial.read();
  }
  if (incomingbyte == '0') {
    digitalWrite(redpin, HIGH);
  }
  if (incomingbyte == '1') {
    digitalWrite(redpin, LOW);
  }
  if (incomingbyte == '2') {
    digitalWrite(greenpin, HIGH);
  }
  if (incomingbyte == '3') {
    digitalWrite(greenpin, LOW);
  }
  if (incomingbyte == '4') {
    digitalWrite(fanpin, HIGH);
  }
  if (incomingbyte == '5') {
    digitalWrite(fanpin, LOW);
  }

}
