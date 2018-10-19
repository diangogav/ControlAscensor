# Guía de instalación

### 1- Clonar el repositorio desde git o descargarlo en su formato comprimido

### 2- Instalar Node.js LTS. https://nodejs.org/es/download/ 

### 3- Ubicarse en la carpeta Arduino_mySql_driver y ejecutar el comando "npm install" (sin comillas) para instalar la librerìa necesaria para el funcionamiento del driver mysql

### 4- Ubicar el proyecto en el servidor local

### 5- Configurar los puertos seriales a ser utilizados

### 6- Para fines de prueba y simulación se puede usar el software "Virtual Serial Port Driver", que permite crear puertos virtuales. Crear un par de puertos virtuales. https://www.eltima.com/es/products/vspdxp/

### 7- El puerto serial de la web en php se configura en el archivo ajaxWrite.php ubicado en la ruta:  arduino\Arduino web\sertecinweb\ajax. En la línea 6 se puede configurar el puerto a ser utilizado así como su velocidad.

### 8- Para probar el funcionamiento de la página es necesario configurar otro terminal serial que reciba los datos. Puede ser el de arduino. Por ejemplo si se agregaron los puertos com2 y com3 con el "Virtual Serial Port Driver". el com2 debe ser configurado en la página y el com3 en el arduino. Al enviar algún dato desde la página por el puerto serial, este se debe ver reflejado en la consola del arduino.

### 9- Una vez se tenga en correcto funcionamiento la página, es necesario configurar el Arduino. Para ello primero es recomendable realizar la simulación usando el proteus. En este caso se usó la versión 7.7 con la librería arduino.

### 10- Para realizar la simulación es necesario cargar el archivo hexadecimal que viene adjunto en la carpeta del proyecto con el nombre Control_Ascensor.hex en el proteus.

### 11- Al iniciar la simulación. Se desplegaran dos consolas virtuales: Uno que simula la página php, por el cuál se pueden enviar los comandos, y el otro que se encarga de simular el driver mysql para guardar los datos en la base de datos. Probar todos los casos para comprobar el correcto funcionamiento del código. Más abajo se anexa el formato de los comandos manejados por el programa.

### 12- Finalmente queda configurar el segundo puerto serial en el software escrito en Node.js, que será el encargado de enviar los datos a la base de datos. Para ello ubicar el archivo main en la siguiente ruta: "arduino\Arduino_mySql_driver". Abrirlo y configurar el nombre del puerto en la línea 51 en la variable comName, la velocidad se configura en la linea 42 en la variable baudRate.

### 13- Es recomendable usar la misma velocidad para ambos puertos seriales.

### 14- Finalmente queda crear la base de datos en MySQL con los siguientes parámetros:

### Una tabla llamada "arduino" (sin comillas) con los campos siguientes:

### id de tipo int(11) AUTO_INCREMENT con Llave Primaria
### data de tipo varchar(100) 
### time de tipo timestamp

### 15- Los parámetros de conexión de la base de datos se comfiguran en el archivo main.js a partir de la línea 8.

### 16- Finalmente se deben realziar las conexiones físicas como se muestran en la simulación adjunta en la carpeta del proyecto.

# Comandos

### Reposando PB con Puertas Cerradas 00
### Reposando PB con Puertas Cerrando 01
### Reposando PB con Puertas Abriendo 02
### Reposando PB con Puertas Abiertas 03

### Reposando P1 con Puertas Cerradas 10
### Reposando P1 con Puertas Cerrando 11
### Reposando P1 con Puertas Abriendo 12
### Reposando P1 con Puertas Abiertas 13

### Reposando P2 con Puertas Cerradas 20
### Reposando P2 con Puertas Cerrando 21
### Reposando P2 con Puertas Abriendo 22
### Reposando P2 con Puertas Abiertas 23

### Subiendo a P1 50
### Subiendo a P2 51
### Bajando a P1 62
### Bajando a PB 61
### Reset 255