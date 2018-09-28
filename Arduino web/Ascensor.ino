#include <EEPROM.h>
const int a = 2;///primer disp
const int b = 3;
const int c = 4;
const int d = 5;

const int e = 6;/// segundo disp
const int f = 7;
const int g = 8;
const int h = 9;

const int SW1 = A0; ///SW ---->> Significa interruptor piso 1
const int SW2 = A1; 
const int SW3 = A2;
const int SW4 = A3;
const int SW5 = A4;
const int CNY70 = A5;

const int Subir = 13;
const int Bajar = 12;

int entrada1 = 0; ///declaro las variables de entrada digital
int entrada2 = 0;
int entrada3 = 0;
int entrada4 = 0;
int entrada5 = 0;
int pisoActual = 0;
int piso = pisoActual;

int sensor = 0;  //declaro la variable del  sensor

void setup() {
   Serial.begin(4800);
  pinMode(a, OUTPUT);//// declaro los pines a,b,c,d,etc como salidas
  pinMode(b, OUTPUT);
  pinMode(c, OUTPUT);
  pinMode(d, OUTPUT);
  pinMode(e, OUTPUT);
  pinMode(f, OUTPUT);
  pinMode(g, OUTPUT);
  pinMode(h, OUTPUT);
  pinMode(Subir, OUTPUT);
  pinMode(Bajar, OUTPUT);
  
  pinMode(SW1, INPUT); //// declaro los SWcomo entradas
  pinMode(SW2, INPUT);
  pinMode(SW3, INPUT);
  pinMode(SW4, INPUT);
  pinMode(SW5, INPUT);
  
  pinMode(CNY70, INPUT); //declaro en pin A5(CNY70) como entrada
  
 digitalWrite(Subir, LOW);
 digitalWrite(Bajar, LOW);
Serial.println(EEPROM.read(0));
}

void loop() { 
if(EEPROM.read(0)==255){
pisoActual=1;
piso=1;
EEPROM.write(0,1);
display1(pisoActual);
display2(pisoActual);
Serial.println(EEPROM.read(0));
}else{
display1(pisoActual);
display2(pisoActual);
}
 entrada1 = digitalRead(SW1);//// Asigno los sw a las variables entrada y le digo que las lea como 1 y 0
 entrada2 = digitalRead(SW2);
 entrada3 = digitalRead(SW3);
 entrada4 = digitalRead(SW4);
 entrada5 = digitalRead(SW5);

 if(entrada1==HIGH){
   while(entrada1==HIGH){entrada1 = digitalRead(SW1);}
   display1(1);
   piso=1;
   if(pisoActual!=piso){
      MoverAscensor(piso);
   }
 }else if(entrada2==HIGH){
   while(entrada2==HIGH){entrada2 = digitalRead(SW2);}
   display1(2);
   piso=2;
   if(pisoActual!=piso){
      MoverAscensor(piso);
   }
 }else if(entrada3==HIGH){
   while(entrada3==HIGH){entrada3 = digitalRead(SW3);}
   display1(3);
   piso=3;
   if(pisoActual!=piso){
      MoverAscensor(piso);
   }
 }else if(entrada4==HIGH){
   while(entrada4==HIGH){entrada4 = digitalRead(SW4);}
   display1(4);
   piso=4;
   if(pisoActual!=piso){
      MoverAscensor(piso);
   }
 }else if(entrada5==HIGH){
   while(entrada5==HIGH){entrada5 = digitalRead(SW5);}
   display1(5);
   piso=5;
   if(pisoActual!=piso){
      MoverAscensor(piso);
   }
 }
}
int pisoSubir=0;
int i = 0;
void MoverAscensor(int nuevoPiso){
   pisoSubir = nuevoPiso - pisoActual;
   // +  +  + "-" + 
   Serial.print("Me movere ");
   Serial.print(pisoSubir);
   Serial.println(" pisos.");
   if(nuevoPiso > pisoActual){
      digitalWrite(Subir, HIGH);
      digitalWrite(Bajar, LOW);
      i=0;
      while(i < pisoSubir){
	 Serial.println("Subiendo...");
	 sensor = digitalRead(CNY70); // Asigno a la variable sensor es estado de la entrada del CNY70
	 if(sensor==HIGH){
	    //while(digitalRead(CNY70)==HIGH){}
	    pisoActual++;
	    EEPROM.write(0,pisoActual);
	    i=i+1;
	    delay(350);
	    display2(pisoActual);
	 }
      }
      digitalWrite(Subir, LOW);
      digitalWrite(Bajar, LOW);
   }else if(nuevoPiso < pisoActual){
      digitalWrite(Subir, LOW);
      digitalWrite(Bajar, HIGH);
      i=0;
      while(i > pisoSubir){
	 Serial.println("Bajando...");
	 sensor = digitalRead(CNY70); // Asigno a la variable sensor es estado de la entrada del CNY70
	 if(sensor==HIGH){
	    //while(digitalRead(CNY70)==HIGH){}
	    pisoActual--;
	    EEPROM.write(0,pisoActual);
	    i=i-1;
	    delay(350);
	    display2(pisoActual);
	 }
      }
      digitalWrite(Subir, LOW);
      digitalWrite(Bajar, LOW);
   }
}

void display1(int numero) {
  switch (numero) {
    case 1:
      digitalWrite(d, LOW);
      digitalWrite(c, LOW);
      digitalWrite(b, LOW);
      digitalWrite(a, HIGH);
    break;
    case 2:
      digitalWrite(a, LOW);
      digitalWrite(b, HIGH);
      digitalWrite(c, LOW);
      digitalWrite(d, LOW);;
    break;
    case 3:
      digitalWrite(a, HIGH);
      digitalWrite(b, HIGH);
      digitalWrite(c, LOW);
      digitalWrite(d, LOW);
    break;
    case 4:
      digitalWrite(a, LOW);
      digitalWrite(b, LOW);
      digitalWrite(c, HIGH);
      digitalWrite(d, LOW);
    break;
    case 5:
      digitalWrite(a, HIGH);
      digitalWrite(b, LOW);
      digitalWrite(c, HIGH);
      digitalWrite(d, LOW);
    break;
  }
}

void display2(int numero) {
  switch (numero) {
    case 1:
      digitalWrite(e, HIGH);
      digitalWrite(f, LOW);
      digitalWrite(g, LOW);
      digitalWrite(h, LOW);

    break;
    case 2:
      digitalWrite(e, LOW);
      digitalWrite(f, HIGH);
      digitalWrite(g, LOW);
      digitalWrite(h, LOW);;
    break;
    case 3:
      digitalWrite(e, HIGH);
      digitalWrite(f, HIGH);
      digitalWrite(g, LOW);
      digitalWrite(h, LOW);
    break;
    case 4:
      digitalWrite(e, LOW);
      digitalWrite(f, LOW);
      digitalWrite(g, HIGH);
      digitalWrite(h, LOW);
    break;
    case 5:
      digitalWrite(e, HIGH);
      digitalWrite(f, LOW);
      digitalWrite(g, HIGH);
      digitalWrite(h, LOW);
    break;
  }
}

