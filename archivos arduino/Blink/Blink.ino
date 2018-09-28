#define LED_BUILTIN 2

int dat;

void setup() {
  Serial.begin(9600);
  pinMode(LED_BUILTIN, OUTPUT);
  digitalWrite(LED_BUILTIN, HIGH);
}


void loop() {

  if (Serial.available() > 0) {


    dat = Serial.read();
    if(dat == 48){

      digitalWrite(LED_BUILTIN, HIGH);
    }

    if(dat == 49){

      digitalWrite(LED_BUILTIN, LOW);

    }

  delay(2000);
  Serial.println(dat);
  }

}
