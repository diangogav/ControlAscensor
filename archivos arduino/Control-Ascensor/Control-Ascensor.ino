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

//Función para leer el puerto serial
int GetSerialData(){
  if(Serial.available() > 0){
    int aux = Serial.read();
    sqlSerial.println(aux);
    return aux;
  }else{
    return -1;
  }
}

int CheckOpenDoors(){
  if(digitalRead(XPA) == 1 &&
     digitalRead(XPC) == 0){
      return 1;
     }

  if(digitalRead(XPA) == 0 &&
     digitalRead(XPC) == 1){
      return 0;
     }

  if(digitalRead(XPA) == 0 && 
     digitalRead(XPC) == 0){
      return -1;
     }

  if(digitalRead(XPA) == 1 && 
     digitalRead(XPC) == 1){
      return -2;
     }
}


// the loop function runs over and over again forever
void loop() {

//=========================================================
// Estados iniciales de las salidas digitales
if(ESTADO == "INICIO"){
  
  //ACCIONES
  digitalWrite(M1SUBE,LOW);
  digitalWrite(M1BAJA,LOW);
  digitalWrite(M2ABRE,LOW);
  digitalWrite(M2CIERRA,LOW);
  
  //TRANSICCION
  ESTADO = "SENSANDO";
}


//=========================================================
// Sensando: encuentra la ubicación actual del ascensor
if(ESTADO == "SENSANDO"){
  //ACCIONES
  
  //TRANSICCION
  if(digitalRead(XS0A) == 1 && digitalRead(XS0B) == 1 &&
     digitalRead(XS1A) == 0 && digitalRead(XS1B) == 0 && 
     digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0)
   {    
     ESTADO = "REPOSANDO PB";  
   }
  if(digitalRead(XS0A) == 0 && digitalRead(XS0B) == 0 &&
     digitalRead(XS1A) == 1 && digitalRead(XS1B) == 1 && 
     digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0)
   {
     ESTADO = "REPOSANDO P1";    
   }
}

//=========================================================
// Reposando PB: El ascensor se encuentra en planta baja
if(ESTADO == "REPOSANDO PB"){
  
  if(CheckOpenDoors() == 1){
     sqlSerial.println(00);
  }else if(CheckOpenDoors() == 0){
    sqlSerial.println(01);
  }
     
  previousLevel = 0;
  dat = GetSerialData();
  
  //TRANSICION
  if(dat == 48){
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

//=========================================================
// CONFIGURANDO SUBIR: Configura las banderas para subir
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

  //TRANSICCION
  if(digitalRead(XPA) == 0 &&
     digitalRead(XPC) == 1){
      
     //NUEVO ESTADO
     ESTADO = "SUBIENDO";
   }
}

//=========================================================
// Cerrando: Se prende el motor M2 en sentido para cerra las puertas
if(ESTADO == "CERRANDO"){
  //ACCIONES
  sqlSerial.println(8);
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

   if(flagS == 0 && flagB == 0 &&
      previousLevel == 0){
        ESTADO = "REPOSANDO PB";
      }

    if(flagS == 0 && flagB == 0 &&
      previousLevel == 1){
        ESTADO = "REPOSANDO P1";
      }

    if(flagS == 0 && flagB == 0 &&
      previousLevel == 2){
        ESTADO = "REPOSANDO P2";
      }
}

//=========================================================
// Subiendo: Se enciende el motor M1 en sentido subir
if(ESTADO == "SUBIENDO"){
  //ACCIONES
  if(previousLevel == 0){
     sqlSerial.println(13);
  }
  if(previousLevel == 1){
     sqlSerial.println(23);
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
//=========================================================
// Parando: Se apaga el motor M1
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

//=========================================================
// Abriendo: Se enciende el motor M1 en sentido abrir
if(ESTADO == "ABRIENDO"){
  //ACCIONES
  sqlSerial.println(9);
  digitalWrite(M2ABRE,HIGH);
  digitalWrite(M2CIERRA,LOW);
  Serial.println(previousLevel);
  
  //TRANSICION
  if(previousLevel == 0 && 
     flagS == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P1";    
    }
  }

  //TRANSICION
  if(previousLevel == 0 && 
     flagS == 0){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO PB";    
    }
  }

  //TRANSICION
  if(previousLevel == 1 &&
     flagS == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P2";    
    }
  }

  //TRANSICION
  if(previousLevel == 1 &&
     flagS == 0 &&
     flagB == 0){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P1";    
    }
  }

  //TRANSICION
  if(previousLevel == 2 &&
     flagB == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P1";    
    }
  }

  //TRANSICION
  if(previousLevel == 2 &&
     flagB == 0){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO P2";    
    }
  }

  //TRANSICION
  if((previousLevel == 1 || previousLevel == 255) &&
     flagB == 1){
    if(digitalRead(XPA) == 1 &&
       digitalRead(XPC) == 0){
       //NUEVO ESTADO
       ESTADO = "REPOSANDO PB";    
    }
  }
}

//=========================================================
// Reposando P1: El ascensor se encuentra reposando en P1
if(ESTADO == "REPOSANDO P1"){
  //ACCIONES
  if(CheckOpenDoors() == 1){
     sqlSerial.println(10);
  }else if(CheckOpenDoors() == 0){
    sqlSerial.println(11);
  }
     
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

  if(dat == 52){
    ESTADO = "RESETEANDO";
  }
}

//=========================================================
// Reposando P2: El ascensor se encuentra reposando en P2
if(ESTADO == "REPOSANDO P2"){
  //ACCIONES
  if(CheckOpenDoors() == 1){
     sqlSerial.println(20);
  }else if(CheckOpenDoors() == 0){
    sqlSerial.println(21);
  }
     
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

   if(dat == 52){
    ESTADO = "RESETEANDO";
  }
}

//=========================================================
// Configurando Bajar: Se configuran las banderas para bajar
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

//=========================================================
// Bajando: Se enciende el motor M2 en sentido bajar
if(ESTADO == "BAJANDO"){
  //ACCIONES
  if(previousLevel == 2){
      sqlSerial.println(14);
  }
  if(previousLevel == 1){
      sqlSerial.println(04);
  }
  if(previousLevel == 255){
      sqlSerial.println(-4);
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
       ((previousLevel == 1 || previousLevel == 255) &&
        digitalRead(XS0A) == 1 && digitalRead(XS0B) == 1 &&
        digitalRead(XS1A) == 0 && digitalRead(XS1B) == 0 && 
        digitalRead(XS2A) == 0 && digitalRead(XS2B) == 0)){
        
       //NUEVO ESTADO
       ESTADO = "PARANDO";    
     }
   }
//=========================================================
// Reseteando: El ascensor volverà a PB
   if(ESTADO == "RESETEANDO"){
    //ACCIONES
    previousLevel = 255;       
    ESTADO = "CONFIGURANDO BAJAR";   
  }
}
