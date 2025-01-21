<?php
//Obtener id de el usuario
session_start();
$idUser = $_SESSION['idUser'] ?? '';
if($idUser == ''){
    header('Location: ../index.php');
}
require "conecta.php";
$con = conecta();

//Datos sobre el producto a agrgar
$act = $_REQUEST['act'] ?? ''; //accion a realizar sobre el carrito de la base
$id_producto = $_REQUEST['id'] ?? 0;
$cant = $_REQUEST['cant'] ?? 0;

//Comprobar si el usuario tiene un pedido abierto, si no crear uno
$sql = "SELECT * FROM pedidos WHERE id_cliente = $idUser AND estado = 0";
$res = $con->query($sql);
$num_pedidos = $res->num_rows;
if($num_pedidos == 0){
    date_default_timezone_set('UTC');
    $fecha = date('Y-m-d H:i:s');
    $sql = "INSERT INTO pedidos (id_cliente, fecha) VALUES($idUser, '$fecha');";
    $res = $con->query($sql);
}

//obtener el id del pedido
$sql = "SELECT * FROM pedidos WHERE id_cliente = $idUser AND estado = 0";
$res = $con->query($sql);
if($row = $res->fetch_array()){
    $id_pedido = $row['id'];
}

//Cerrar carrito
if($act == 'close'){
    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
    $res = $con->query($sql);
    while($row = $res->fetch_array()){
        $id_producto2 = $row['id_producto'];
        $cant = $row['cantidad'];         // Obtener la cantidad atual del carrito
        $sql = "UPDATE productos SET stock = stock - $cant WHERE id = $id_producto2";
        $res2 = $con->query($sql);
    }
    $sql = "UPDATE pedidos SET estado = 1 WHERE id_cliente = $idUser AND estado = 0";
    $res = $con->query($sql);
    echo 'Exito';
    exit;
}

//Comprobar valores recibidos para evitar valores
if ($act == '' || $id_producto == '') {
    die('Acción o ID de producto no especificado');
}


//Checar si el producto ya esta en el carrito
if($id_producto != 0){
    $sql = "SELECT * FROM pedidos_productos WHERE id_producto = $id_producto AND id_pedido = $id_pedido"; 
    $res = $con->query($sql);
    if($row = $res->fetch_array() && $act == 'add'){
        $act = 'upd';
    }
}
//Checar si aun existe stock
if($cant != 0) {
    $sql = "SELECT * FROM productos WHERE id = $id_producto AND eliminado = 0";
    $res = $con->query($sql);
    if($row = $res->fetch_array()){
        $stock = $row['stock'];
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res = $con->query($sql);
        if($row = $res->fetch_array()){
            $cant_act = $row['cantidad'];         // Obtener la cantidad atual del carrito
            $cant_act += $cant;
        }
        if($cant_act > $stock){
            exit;
        }
    }
}


switch ($act){
    case 'add':{ //Agregar productos al carrito
        $sql = "SELECT * FROM productos WHERE id = $id_producto AND eliminado = 0";
        $res = $con->query($sql);
        if($row = $res->fetch_array()){
            $precio = $row['costo'];
            $stock = $row['stock'];
            if($stock <= 0){
                echo "El producto esta agotado";
                exit;
            }
            $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio) VALUES($id_pedido, $id_producto, $cant, $precio)";
            $res = $con->query($sql);
        }
        break;
    }
    case 'del':{ //Eliminar Productos del carrito
        $sql = "DELETE FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res = $con->query($sql);
        break;
    }
    case 'upd':{ //Actualizar Productos del carrito
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res = $con->query($sql);
        if($row = $res->fetch_array()){
            $act_cant = $row['cantidad'];
            $cant += $act_cant;
            if($cant <= 0){
                $sql = "DELETE FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
                $res = $con->query($sql);
            }
        }
        $sql = "UPDATE pedidos_productos SET cantidad = $cant WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res = $con->query($sql);
        break;
    }
    case 'cant':{ //obtener cantidad
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res = $con->query($sql);
        if($row = $res->fetch_array()){
            $cant = $row['cantidad'];         // Obtener la cantidad atual del carrito
        }
        echo $cant;
        break;
    }
    case 'costo':{ //obtener costo
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
        $res = $con->query($sql);
        if($row = $res->fetch_array()){
            $cant = $row['cantidad'];         // Obtener la cantidad atual del carrito
        }
        $sql = "SELECT * FROM productos WHERE id = $id_producto";
        $res = $con->query($sql);
        if($row = $res->fetch_array()){
            $precio = $cant * $row['costo'];         // Obtener la cantidad atual del carrito
        }
        echo $precio;
        break;
    }
    case 'total': { //Obtener total del pedido
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
        $res = $con->query($sql);
        $total = 0;
        while($row = $res->fetch_array()){
            $cant = $row['cantidad']; // Obtener la cantidad atual del pedido
            $precio = $row['precio']; //
            $total += $cant * $precio;
        }
        echo $total;
        break;
    }
}

//Actualiza el stock del producto, si esta en cero lo elimina del carrito
if($id_producto != 0){
    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
    $res = $con->query($sql);
    while($row = $res->fetch_array()){
        $act_cant = $row['cantidad'];
        if($act_cant <= 0){
            $sql = "DELETE FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto";
            $res = $con->query($sql);
        }
    }
}

?>