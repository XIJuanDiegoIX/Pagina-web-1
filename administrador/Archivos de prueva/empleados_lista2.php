<?php
//empleados_lista.php
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM empleados WHERE eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;

while($row = $res->fetch_array()){
	$id 	= $row["id"];
	$nombre = $row["nombre"];
	$correo = $row["correo"];
	echo "$id $nombre $correo<br>";
}

?>