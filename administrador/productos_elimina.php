<?php
//productos_elimina.php
require "funciones/conecta.php";
$con = conecta();

//cachar variables
$id = $_REQUEST['id'];

//$sql = "DELETE FROM productos WHERE id = $id";
$sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
$res = $con->query($sql);

header("Location: productos_lista.php");

?>