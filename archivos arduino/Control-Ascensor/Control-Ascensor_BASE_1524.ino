//#include "SoftwareSerial.h"
#include <SoftwareSerial.h>
const byte rxPin = 9;
const byte txPin = 10;

#define BAUD_RATE 9600

#define MOTOR1 13
#define MOTOR2 12

#define XS0 3
#define XS1 4
#define XS2 5

#define XPA 7
#define XPC 8

#define SUBIR 9
#define BAJAR 10

uint8_t dat;
uint8_t flagS = 0;
uint8_t flagB = 0;
uint8_t previousLevel;

String ESTADO = "INICIO";

//SoftwareSerial swSer(14, 12, false, 256);
SoftwareSerial sqlSerial (rxPin, txPin);

void setup() {

  //swSer.begin(BAUD_RATE);
  Serial.begin(BAUD_RATE);
  
  pinMode(txPin, OUTPUT);

  pinMode(MOTOR1,OUTPUT);
  pinMode(MOTOR2,OUTPUT);
  
  pinMode(XS0,INPUT);
  pinMode(XS1,INPUT);
  pinMode(XS2,INPUT);
  pinMode(XPA,INPUT);
  pinMode(XPC,INPUT);

  pinMode(11,OUTPUT);
  pinMode(12,OUTPUT);
  pinMode(13,OUTPUT);
  pinMode(1,OUTPUT);
  digitalWrite(11,LOW);
  digitalWrite(12,LOW);
  digitalWrite(13,LOW);
  digitalWrite(1,LOW);

  sqlSerial.begin(BAUD_RATE);
}

int GetSerialData(){
  if(Serial.available() > 0){
    return Serial.read();
  }else{
    return -1;
  }
}

// the loop function runs over and over again forever
void loop() {

  

if(ESTADO == "INICIO"){
  //ACCIONES
  digitalWrite(MOTOR1,LOW);
  digitalWrite(MOTOR2,LOW);
  //TRANSICCION
  
  //NUEVO ESTADO
  ESTADO = "SENSANDO";
}

if(ESTADO == "SENSANDO"){
  //ACCIONES
  //TRANSICCION
  if(digitalRead(XS0) == 1 &&
     digitalRead(XS1) == 0 &&
     digitalRead(XS2) == 0){
      
     //NUEVO ESTADO
     ESTADO = "REPOSANDO PB";  
   }
  if(digitalRead(XS0) == 0 &&
     digitalRead(XS1) == 1 &&
     digitalRead(XS2) == 0){
      
     //NUEVO ESTADO
     ESTADO = "REPOSANDO P1";    
   }
}

if(ESTADO == "REPOSANDO PB"){
  //ACCIONES
  sqlSerial.println("REPOSANDO PB");
  previousLevel = 0;
  dat = GetSerialData();
  
  //TRANSICCION
  if(dat == 48){
      
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO SUBIR";   
   }
}

if(ESTADO == "CONFIGURANDO SUBIR"){
  //ACCIONES
  flagS = 1;
  flagB = 0;
  
  //TRANSICCION
  if(digitalRead(XPA) == 1 &&
     digitalRead(XPC) == 0){
      
     //NUEVO ESTADO
     ESTADO = "CERRANDO";   
   }
}

if(ESTADO == "CERRANDO"){
  //ACCIONES
  sqlSerial.println("CERRANDO PUERTAS");
  digitalWrite(MOTOR2,HIGH);

  //TRANSICCION
  if(flagS == 1 &&
     digitalRead(XPA) == 0 &&
     digitalRead(XPC) == 1){
      
     //NUEVO ESTADO
     ESTADO = "SUBIENDO";    
   }

  if(flagB == 1 &&
     digitalRead(XPA) == 0 &&
     digitalRead(XPC) == 1){
      
     //NUEVO ESTADO
     ESTADO = "BAJANDO";    
   }
}
  
if(ESTADO == "SUBIENDO"){
  //ACCIONES
  if(previousLevel == 0){
     sqlSerial.println("SUBIENDO A P1");
  }
  if(previousLevel == 1){
     sqlSerial.println("SUBIENDO A P2");
  }
  digitalWrite(MOTOR2,LOW);
  digitalWrite(MOTOR1,HIGH);

  //TRANSICCION
  if((previousLevel == 0 &&
     digitalRead(XS0) == 0 &&
     digitalRead(XS1) == 1 &&
     digitalRead(XS2) == 0) ||
     (previousLevel == 1 &&
     digitalRead(XS0) == 0 &&
     digitalRead(XS1) == 0 &&
     digitalRead(XS2) == 1)){
      
     //NUEVO ESTADO
     ESTADO = "PARANDO";    
   }
}

if(ESTADO == "PARANDO"){
  //ACCIONES
  digitalWrite(MOTOR1,LOW);
  //TRANSICCION
  if(digitalRead(XPA) == 0 &&
     digitalRead(XPC) == 1){
      
     //NUEVO ESTADO
     ESTADO = "ABRIENDO";    
   }
}


if(ESTADO == "ABRIENDO"){
  //ACCIONES
  sqlSerial.println("ABRIENDO PUERTAS");
  digitalWrite(MOTOR2,HIGH);
  
  //TRANSICCION
  if(previousLevel == 0 && 
     flagS == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P1";    
    }
  }

  //TRANSICCION
  if(previousLevel == 1 &&
     flagS == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P2";    
    }
  }

  //TRANSICCION
  if(previousLevel == 2 &&
     flagB == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P1";    
    }
  }

  //TRANSICCION
  if(previousLevel == 1 &&
     flagB == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO PB";    
    }
  }
}

if(ESTADO == "REPOSANDO P1"){
  //ACCIONES
  sqlSerial.println("REPOSANDO P1");
  flagS = 0;
  previousLevel = 1;
  dat = GetSerialData();
  digitalWrite(MOTOR2,LOW);
  //TRANSICCION
  if(dat == 48){
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO SUBIR";   
   }else if(dat == 49){
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO BAJAR";   
   }
}

if(ESTADO == "REPOSANDO P2"){
  //ACCIONES
  sqlSerial.println("REPOSANDO P2");
  flagS = 0;
  previousLevel = 2;
  dat = GetSerialData();
  digitalWrite(MOTOR2,LOW);
  //TRANSICCION
  if(dat == 49){
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO BAJAR";   
   }
}

if(ESTADO == "CONFIGURANDO BAJAR"){
  //ACCIONES
  flagB = 1;
  flagS = 0;

  //TRANSICCION
  if(digitalRead(XPA) == 1 &&
     digitalRead(XPC) == 0){
      
     //NUEVO ESTADO
     ESTADO = "CERRANDO";   
   }
}

if(ESTADO == "BAJANDO"){
  //ACCIONES
  if(previousLevel == 2){
      sqlSerial.println("BAJANDO P1");
  }
  if(previousLevel == 1){
      sqlSerial.println("BAJANDO PB");
  }
  digitalWrite(MOTOR2,LOW);
  digitalWrite(MOTOR1,HIGH);

  //TRANSICCION
    if((previousLevel == 2 &&
       digitalRead(XS0) == 0 &&
       digitalRead(XS1) == 1 &&
       digitalRead(XS2) == 0) ||
       (previousLevel == 1 &&
       digitalRead(XS0) == 1 &&
       digitalRead(XS1) == 0 &&
       digitalRead(XS2) == 0)){
        
       //NUEVO ESTADO
       ESTADO = "PARANDO";    
     }
   }
  
  /*if(swSer.available() > 0){
    
    dat = swSer.read();

    if(dat == 48){
      digitalWrite(LED_BUILTIN, HIGH);
        Serial.println(dat);
    }

    if(dat == 49){
      digitalWrite(LED_BUILTIN, LOW);
      Serial.println(dat);
    }
  }*/
}
