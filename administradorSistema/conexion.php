<?php
//CONEXION CON LA BASE DE DATOS
//if (!($link=mysql_connect("localhost","root","metallica12345")))//ingreso a mysql
if (!($link=mysql_connect("localhost","root",""))){
	echo "ERROR AL CONECTARSE CON MYSQL";
	exit();
}
if (!(mysql_select_db("skynet",$link)))//conexion a la BD
{ echo "ERROR AL SELECCIONAR LA BASE DE DATOS";
  exit();
}

/*
if (!($link=mysql_connect("localhost","trebold_yulius","roqwy53docE,"))){
	echo "ERROR AL CONECTARSE CON MYSQL";
	exit();
}
if (!(mysql_select_db("trebold_idealplace",$link)))//conexion a la BD
{ echo "ERROR AL SELECCIONAR LA BASE DE DATOS";
  exit();
}
 * 
 */
?>