<?php
require "conecta.php";
$con = conecta();
session_start();
$idUser = $_SESSION['idUser'] ?? '';
//Comprobar si el usuario tiene un pedido abierto, si no crear uno
$sql = "SELECT * FROM pedidos WHERE id_cliente = $idUser AND estado = 0";
$res = $con->query($sql);
$num_pedidos = $res->num_rows;
if($num_pedidos == 0){
    $sql = "INSERT INTO pedidos (id_cliente) VALUES($idUser)";
    $res = $con->query($sql);
}
//obtener el id del pedido
$sql = "SELECT * FROM pedidos WHERE id_cliente = $idUser AND estado = 0";
$res = $con->query($sql);
if($row = $res->fetch_array()){
    $id_pedido = $row['id'];
}
//Obtener el total de articulos del pedido
$sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
$res = $con->query($sql);
$num = 0;
while($row = $res->fetch_array()){
    $num += $row['cantidad'];
}
echo $num;
?>