<?php

session_start();
if ( !isset($_SESSION) ) {
	header("location:../../index.html");
}
