<?php
session_start();
require "conecta.php";
$con = conecta();

$correo = $_REQUEST['correo'];
$pass = $_REQUEST['pass'];

$passEnc = md5($pass);

$sql = "SELECT * FROM clientes WHERE eliminado = 0 AND correo = '$correo' AND pass = '$passEnc'";

$res = $con->query($sql);
$num = $res->num_rows;

if($num == 1){
	$row 		= $res->fetch_array();
	$id 		= $row["id"];
	$nombre		= $row["nombre"];
	$correo		= $row["correo"];
	$archivo	= $row["archivo"];
	$archivo_n	= $row["archivo_n"];
	//
	$_SESSION['idUser'] 		= $id;
	$_SESSION['nombreUser'] 	= $nombre;
	$_SESSION['correoUser'] 	= $correo;
	$_SESSION['archivoUser'] 	= $archivo;
	$_SESSION['archivo_nUser'] 	= $archivo_n;
}


echo $num;

?>