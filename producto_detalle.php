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

$id_producto = $_REQUEST['id'];

if($rolUser != ''){
    header('Location: salir.php');
}
if($id_producto == ''){
	header('Location: index.php');
}
?>

<html>
    <head>
        <script src="Librerias/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="Estilos/Estilos_detalleC2.css">
        <link rel="stylesheet" href="Estilos/Estilos_top1.css">
        <link rel="stylesheet" href="Estilos/Estilos_botom2.css">
        <title>Index</title>

        <script>
            var val;
            //Obtener valores actuales para el carrito
            function actualizar_cant(id){
                var act = 'cant';
                $.ajax({
					url  	 : 'funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {id : id, act : act},
					success  : function(cant){
						if(cant >= 0){
                            //$('#cant'+id).val(res);
                            $('#producto_cantidad'+id).html(cant);
						}
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
                setTimeout(actualizar_costo(id), 15);
            }
            //Actualizar el costo total del producto
            function actualizar_costo(id){
                var act = 'costo';
                $.ajax({
					url  	 : 'funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {id : id, act : act},
					success  : function(precio){
						if(precio >= 0){
                            $('#producto_precio'+id).html('$ '+precio);
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
            function agregar(id, cant){
                var act = 'add';
                $.ajax({
					url  	 : 'funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {id : id, cant : cant, act : act},
					success  : function(num){
						if(num >= 1){
							console.log("Se agrego con exito");
						} else {
							$('#mensaje').html('El correo y contrasena son incorrectos');
							//alert('Fallo');
						}
						setTimeout("$('#mensaje').html('');",5000);
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
                actualizar_cant(id);
                carrito();
                return false;
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
        <style>

        </style>
    </head>
    <body>
        <div id="pag">  
            <?php include('top.php');?>
            <div id="info">
                <div id="productos">
                    <?php
                        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND stock > 0 AND id = $id_producto";
                        $res = $con->query($sql);
                        echo "<div class='filas'>";
                        if($row = $res->fetch_array()){
                            $nombre = $row['nombre'];
                            $codigo = $row['codigo'];
                            $descripcion = $row['descripcion'];
                            $costo = $row['costo'];
                            $stock = $row['stock'];
                            $archivo = $row['archivo'];
                            $archivo_n = $row['archivo_n'];
                            $suma = $row['costo'];
                            echo "<div id='prod$id_producto' class='prod'>";
                                        if($idUser != ''){
                                            $sql = "SELECT * FROM pedidos WHERE id_cliente = $idUser AND estado = 0";
                                            $res = $con->query($sql);
                                            if($row = $res->fetch_array()){
                                                $id_pedido = $row['id'];
                                            }
                                            $sql = "SELECT * FROM pedidos_productos WHERE id_producto = $id_producto AND id_pedido = $id_pedido";
                                            $res = $con->query($sql);
                                            $cant = 0;
                                            if($row = $res->fetch_array()){
                                                $cant = $row['cantidad'];
                                                $suma = $suma * $cant;
                                            }else{
                                                $suma = 0;
                                            }
                                            echo "
                                                <div id='barra_producto$id_producto' class='barra_producto'>
                                                    <div class='recuadro'>
                                                        <a id='producto$id_producto' class='prod' href='producto_detalle.php?id=$id_producto'><img src='productos/$archivo'></a>
                                                        <div class='info_total'>
                                                            <div class='info_producto'>
                                                                <div class='apoyo_fila'>
                                                                    <div class='apoyo2'>
                                                                        <div>Nombre</div>
                                                                        <div>$nombre</div>
                                                                    </div>
                                                                    <div class='apoyo2'>
                                                                        <div>Codigo</div>
                                                                        <div>$codigo</div>
                                                                    </div>
                                                                </div>
                                                                <div class='apoyo2'>
                                                                    <p>Descripcion: 
                                                                        <p>$descripcion</p>
                                                                    </p>
                                                                </div>
                                                                <div class='apoyo_fila'>
                                                                    <div class='apoyo2'>
                                                                        <div>Stock</div>
                                                                        <div>$stock</div>
                                                                    </div>
                                                                    <div class='apoyo2'>
                                                                        <div>Costo</div>
                                                                        <div>$costo</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='apoyo1'>
                                                                <div class='info_compra'>
                                                                    <div>Costo Total</div>
                                                                    <div id='producto_precio$id_producto'>$ $suma</div>
                                                                    <div class='cantidad'>
                                                                        <div><button class='boton' id='boton_menos'type=' button' onclick='agregar($id_producto, -1);'>-</button></div>
                                                                        <div class='cant_art' id='producto_cantidad$id_producto'>$cant</div>
                                                                        <div><button class='boton' id='boton_mas'type=' button' onclick='agregar($id_producto, 1);'>+</button></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                        }
                            echo "      </div>
                                    </div>
                                </div>";
                        }
                        echo "</div>";
                    ?>
                </div>
            </div>
            <?php include('botom.php');?>            
        </div>
    </body>
</html>