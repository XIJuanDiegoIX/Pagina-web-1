<?php
require "conecta.php";
$con = conecta();

$codigo = $_REQUEST['codigo'];
$id = $_REQUEST['id'];

if($id != ''){
	$sql = "SELECT * FROM productos WHERE eliminado = 0 AND codigo = '$codigo' AND id != '$id'";
	}else{
	$sql = "SELECT * FROM productos WHERE eliminado = 0 AND codigo = '$codigo'";
}
$res = $con->query($sql);
$num = $res->num_rows;

echo $num;
?>