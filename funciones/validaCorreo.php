<?php
require "conecta.php";
$con = conecta();

$correo = $_REQUEST['correo'];
$id = $_REQUEST['id'];

if($id != ''){
	$sql = "SELECT * FROM clientes WHERE eliminado = 0 AND correo = '$correo' AND id != '$id'";
	}else{
	$sql = "SELECT * FROM clientes WHERE eliminado = 0 AND correo = '$correo'";
}
$res = $con->query($sql);
$num = $res->num_rows;

echo $num;
?>