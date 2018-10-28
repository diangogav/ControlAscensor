<?php 

function Comando($command){
	switch ($command) {
		case 0:
			return "Reposando en PB con Puertas Cerradas";
		break;
		case 1:
			return "Reposando en PB con Puertas Cerrando";
		break;
		case 2:
			return "Reposando en PB con Puertas Abriendo";
		break;
		case 3:
			return "Reposando en PB con Puertas Abiertas";
		break;
		case 10:
			return "Reposando en P1 con Puertas Cerradas";
		break;
		case 11:
			return "Reposando en P1 con Puertas Cerrando";
		break;
		case 12:
			return "Reposando en P1 con Puertas Abriendo";
		break;
		case 13:
			return "Reposando en P1 con Puertas Abiertas";
		break;
		case 20:
			return "Reposando en P2 con Puertas Cerradas";
		break;
		case 21:
			return "Reposando en P2 con Puertas Cerrando";
		break;
		case 22:
			return "Reposando en P2 con Puertas Abriendo";
		break;
		case 23:
			return "Reposando en P2 con Puertas Abiertas";
		break;

		case 50:
			return "Subiendo a P1";
		break;
		case 51:
			return "Subiendo a P2";
		break;
		case 62:
			return "Bajando a P1";
		break;
		case 61:
			return "Bajando a PB";
		break;
		case -1:
			return "Error";
		break;
		case 255:
			return "Reiniciando";
		break;
	}
}
	

 ?>