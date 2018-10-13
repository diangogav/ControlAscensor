//Voy a probar el git ammend

#include <SoftwareSerial.h>
const byte rxPin = 9;
const byte txPin = 10;

#define BAUD_RATE 9600

#define M1SUBE 9
#define M1BAJA 11
#define M2ABRE 12
#define M2CIERRA 13

#define XS0A 1
#define XS0B 2
#define XS1A 3
#define XS1B 4
#define XS2A 5
#define XS2B 6

#define XPA 7
#define XPC 8

uint8_t dat;
uint8_t flagS = 0;
uint8_t flagB = 0;
uint8_t previousLevel;

String ESTADO = "INICIO";

SoftwareSerial sqlSerial (rxPin, txPin);

void setup() {

  //swSer.begin(BAUD_RATE);
  Serial.begin(BAUD_RATE);
  
  pinMode(txPin, OUTPUT);

  pinMode(M1SUBE,OUTPUT);
  pinMode(M1BAJA,OUTPUT);
  pinMode(M2ABRE,OUTPUT);
  pinMode(M2CIERRA,OUTPUT);
  
  pinMode(XS0A,INPUT);
  pinMode(XS0B,INPUT);
  pinMode(XS1A,INPUT);
  pinMode(XS1B,INPUT);
  pinMode(XS2A,INPUT);
  pinMode(XS2B,INPUT);
  
  pinMode(XPA,INPUT);
  pinMode(XPC,INPUT);
  
  sqlSerial.begin(BAUD_RATE);
}

int GetSerialData(){
  if(Serial.available() > 0){
    int aux = Serial.read();
    Serial.println(aux);
    return aux;
  }else{
    return -1;
  }
}

// the loop function runs over and over again forever
void loop() {

if(ESTADO == "INICIO"){
  //ACCIONES
  digitalWrite(M1SUBE,LOW);
  digitalWrite(M1BAJA,LOW);
  digitalWrite(M2ABRE,LOW);
  digitalWrite(M2CIERRA,LOW);
  //TRANSICCION
  
  //NUEVO ESTADO
  ESTADO = "SENSANDO";
}

if(ESTADO == "SENSANDO"){
  //ACCIONES
  //TRANSICCION
  if(digitalRead(XS0A) == 1 && digitalRead(XS0B) == 1 &&
     digitalRead(XS1A) == 0 && digitalRead(XS1B) == 0 && 
     digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0)
     {
      
     //NUEVO ESTADO
     ESTADO = "REPOSANDO PB";  
   }
  if(digitalRead(XS0A) == 0 && digitalRead(XS0B) == 0 &&
     digitalRead(XS1A) == 1 && digitalRead(XS1B) == 1 && 
     digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0){
      
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

   if(dat == 50 &&
      digitalRead(XPA) == 0 &&
      digitalRead(XPC) == 1)
   {
      Serial.println("ABRIENDO");
      ESTADO = "ABRIENDO";
   }

   if(dat == 51 &&
      digitalRead(XPA) == 1 &&
      digitalRead(XPC) == 0)
   {
      Serial.println("CERRANDO");
      ESTADO = "CERRANDO";   
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
  
  digitalWrite(M2CIERRA,HIGH);
  digitalWrite(M2ABRE,LOW);
  
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
  digitalWrite(M2ABRE,LOW);
  digitalWrite(M2CIERRA,LOW);
  digitalWrite(M1SUBE,HIGH);
  digitalWrite(M1BAJA,LOW);

  //TRANSICCION
  if((previousLevel == 0 &&
     digitalRead(XS0A) == 0 && digitalRead(XS0B) == 0 &&
     digitalRead(XS1A) == 1 && digitalRead(XS1B) == 1 && 
     digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0) 
     ||
     (previousLevel == 1 &&
     digitalRead(XS0A) == 0 && digitalRead(XS0B) == 0 &&
     digitalRead(XS1A) == 0 && digitalRead(XS1B) == 0 && 
     digitalRead(XS2A) == 1 && digitalRead(XS2B) == 1))
     {
      
     //NUEVO ESTADO
     ESTADO = "PARANDO";    
   }
}

if(ESTADO == "PARANDO"){
  //ACCIONES
  digitalWrite(M1SUBE,LOW);
  digitalWrite(M1BAJA,LOW);  
  
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
  
  digitalWrite(M2ABRE,HIGH);
  digitalWrite(M2CIERRA,LOW);
  Serial.println(previousLevel);
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
  if(previousLevel == 0 && 
     flagS == 0){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO PB";    
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
  if(previousLevel == 1 &&
     flagS == 0 &&
     flagB == 0){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P1";    
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
  if(previousLevel == 2 &&
     flagB == 0){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P2";    
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
  
  digitalWrite(M2ABRE,LOW);
  digitalWrite(M2CIERRA,LOW); 
  
  //TRANSICCION
  if(dat == 48){
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO SUBIR";   
   }else if(dat == 49){
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO BAJAR";   
   }
     
   if(dat == 50 &&
      digitalRead(XPA) == 0 &&
      digitalRead(XPC) == 1)
   {
      Serial.println("ABRIENDO");
      ESTADO = "ABRIENDO";
   }

   if(dat == 51 &&
      digitalRead(XPA) == 1 &&
      digitalRead(XPC) == 0)
   {
      Serial.println("CERRANDO");
      ESTADO = "CERRANDO";   
   }
}

if(ESTADO == "REPOSANDO P2"){
  //ACCIONES
  sqlSerial.println("REPOSANDO P2");
  flagS = 0;
  previousLevel = 2;
  dat = GetSerialData();
  
  digitalWrite(M2ABRE,LOW);
  digitalWrite(M2CIERRA,LOW);

  //TRANSICCION
  if(dat == 49){
     //NUEVO ESTADO
     ESTADO = "CONFIGURANDO BAJAR";   
   }
   
   if(dat == 50 &&
      digitalRead(XPA) == 0 &&
      digitalRead(XPC) == 1)
   {
      Serial.println("ABRIENDO");
      ESTADO = "ABRIENDO";
   }

   if(dat == 51 &&
      digitalRead(XPA) == 1 &&
      digitalRead(XPC) == 0)
   {
      Serial.println("CERRANDO");
      ESTADO = "CERRANDO";   
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
  
  digitalWrite(M2ABRE,LOW);
  digitalWrite(M2CIERRA,LOW);
  digitalWrite(M1SUBE,LOW);
  digitalWrite(M1BAJA,HIGH);

  //TRANSICCION
    if((previousLevel == 2 &&
        digitalRead(XS0A) == 0 && digitalRead(XS0B) == 0 &&
        digitalRead(XS1A) == 1 && digitalRead(XS1B) == 1 && 
        digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0) ||
       (previousLevel == 1 &&
        digitalRead(XS0A) == 1 && digitalRead(XS0B) == 1 &&
        digitalRead(XS1A) == 0 && digitalRead(XS1B) == 0 && 
        digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0)){
        
       //NUEVO ESTADO
       ESTADO = "PARANDO";    
     }
   }
}
