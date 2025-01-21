<?php
//promociones_elimina.php
require "funciones/conecta.php";
$con = conecta();

//cachar variables
$id = $_REQUEST['id'];

//$sql = "DELETE FROM promociones WHERE id = $id";
$sql = "UPDATE promociones SET eliminado = 1 WHERE id = $id";
$res = $con->query($sql);

header("Location: promociones_lista.php");

?>