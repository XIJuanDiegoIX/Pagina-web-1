<!doctype= html>
<?php
require "funciones/conecta.php";
$con = conecta();
session_start();
$idUser = $_SESSION['idUser'] ?? '';
$nombreUser = $_SESSION['nombreUser'] ?? '';
$rolUser = $_SESSION['rolUser'] ?? '';
$archivoUser = $_SESSION['archivoUser'] ?? "5f8135d9e153952323596710e14cd64d.png";
$archivo_nUser = $_SESSION['archivo_nUser'] ?? "5f8135d9e153952323596710e14cd64d.png";

if($rolUser != ''){
    header('Location: salir.php');
}
if($nombreUser == ''){
	header('Location: index.php');
}
$sql = "SELECT * FROM pedidos WHERE id_cliente = $idUser AND estado = 0";
$res = $con->query($sql);
if($row = $res->fetch_array()){
    $id_pedido = $row['id'];
    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
    $res = $con->query($sql);
    $num = $res->num_rows;
    if($num <= 0){
        header('Location: carrito.php');
    }
}
?>

<html>
    <head>
        <script src="Librerias/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="Estilos/Estilos_carrito1.css">
        <link rel="stylesheet" href="Estilos/Estilos_top1.css">
        <link rel="stylesheet" href="Estilos/Estilos_botom2.css">
        <title>Index</title>

        <script>
            var val;
            function cerrar_carrito(){
                var act = 'close';
                $.ajax({
					url  	 : 'funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {act : act},
					success  : function(res){
                        console.log(res);
                        if(res == 'Exito'){
                            window.location.href = 'index.php';
                        }
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
            }
            function carrito(){
                $.ajax({
					url  	 : 'funciones/cant_articulos_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {val : val},
					success  : function(num){
						if(num >= 0){
                            $('#carrito').html('Carrito ('+num+')');
						}
						//setTimeout("$('#mensaje').html('');",5000);
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
            }

            //Actualizar el total del carrito
            function actualizar_total(){
                var act = 'total';
                $.ajax({
					url  	 : 'funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {act : act},
					success  : function(total){
						if(total >= 0){
                            $('#total').html('Total = '+total);
						}
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
            }
            
            //Crear carrito
            function crear_carrito(){
                var act = '';
                $.ajax({
					url  	 : 'funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {act, act},
				});
            }
            crear_carrito();
            carrito();
        </script>
    </head>
    <body>
    <div id="pag">  
            <?php include('top.php');?>
            <div id="info">
                <div class='subtotal'>
                    <a class='total'  href='carrito.php'>
                        <div id='buy' type='button'>Regresar</div>
                    </a>
                </div>
                <div id="productos">
                <?php
                    $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido";
                    $res = $con->query($sql);
                    $num = $res->num_rows;
                    $ids = array();
                    for($j=1;$j <= $num;$j++){
                        $row = $res->fetch_array();
                        $ids[$j-1] = $row['id_producto'];
                        $cants[$j-1] = $row['cantidad'];
                    }
                    for($i = 0;$i < $num;$i++){
                        $sql = "SELECT * FROM productos WHERE id = $ids[$i]";
                        $res = $con->query($sql);
                        if($row = $res->fetch_array()){
                            $id_producto = $row["id"];
                            $nombre = $row["nombre"];
                            $codigo = $row["codigo"];
                            $descripcion = $row["descripcion"];
                            $costo = $row["costo"];
                            $stock = $row["stock"];
                            $archivo = $row['archivo'];
                            $archivo_n = $row['archivo_n'];
                        }
                        $cant = $cants[$i];
                        $suma = $cant * $costo;
                        echo "
                        <div id='barra_producto$id_producto' class='barra_producto'>
                            <div class='recuadro'>
                                <a id='producto$id_producto' class='prod' href='producto_detalle.php?id=$id_producto'><img src='productos/$archivo'></a>
                                <div class='info_producto'><p>$descripcion</p></div>
                                <div class='info_compra'>
                                    <div>Costo</div>
                                    <div id='producto_precio$id_producto'>$ $suma</div>
                                    <div class='cantidad'>
                                        <div class='cant_art2' id='producto_cantidad$id_producto'>$cant</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                        }
                ?>
                </div>
                <div class='subtotal'>
                    <div class='total'>
                        <div id="total"><?php echo "<script>actualizar_total();</script>";?></div>
                    </div>
                    <button class='total'  id='closecar' type='button' onclick='cerrar_carrito();'>
                        <?php
                        if($num > 0){
                            echo "<div id='buy' type='button'>Comprar</div>";
                        }
                        ?>
                    </button>
                </div>
            </div>
            <?php include('botom.php');?>            
        </div>
    </body>
</html>