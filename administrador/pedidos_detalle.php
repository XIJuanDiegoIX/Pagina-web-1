<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
//pedidos_lista.php
require "funciones/conecta.php";
$con = conecta();

$id_pedido = $_REQUEST['id'];

?>
<html>
	<head>
		<title>Modulo de pedidos</title>
		<link rel="stylesheet" href="../Estilos/Estilos_pedidos_lista2.css">
		<link rel="stylesheet" href="../Estilos/Estilos_pedidos_detalle.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		<script>
            var val;
            //Obtener valores actuales para el carrito
            function actualizar_cant(id){
                var act = 'cant';
                $.ajax({
					url  	 : '../funciones/operaciones_carrito.php',
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
					url  	 : '../funciones/operaciones_carrito.php',
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
                setTimeout(actualizar_total(), 15);
            }
            //Actualizar el total del carrito
            function actualizar_total(){
                var act = 'total';
                $.ajax({
					url  	 : '../funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {act : act},
					success  : function(total){
						if(total > 0){
                            $('#total').html('Total = $ '+total);
						}else{
                            $('#total').html('Total = $ '+total);
                        }
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
            }

            function carrito(){
                $.ajax({
					url  	 : '../funciones/cant_articulos_carrito.php',
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

            //Elimina un producto del carrito
            function elimina(id){
                var act = 'del';
                $.ajax({
					url  	 : '../funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {id: id, act : act},
					success  : function(){
                        console.log('exito');
                        $('#barra_producto'+id).hide();
						//setTimeout("$('#mensaje').html('');",5000);
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
                actualizar_total();
                carrito();
            }

            //Aregar valores de acuerdo a la cantidad
            function agregar(id, cant){
                var act = 'add';
                $.ajax({
					url  	 : '../funciones/operaciones_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {id : id, cant : cant, act : act},
					success  : function(num){
						if(num >= 1){
                            
						}
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
					url  	 : '../funciones/operaciones_carrito.php',
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
		
		<?php include('menu.php');?>
		<div class="fondotabla">
			<div id="tabla1" class="borde borde1">
				<div class="titulos">Detalle de pedido<?php echo "($id_pedido)";?></div>
				<a class="txttitle borde color3 link" href="pedidos_lista.php">Regresar</a>
				<div class="tab txttitle">
					<div class='borde color2 id'>ID Producto</div>
					<div class='borde color2 nombre'>Nombre</div>
					<div class='borde color2 codigo'>Codigo</div>
					<div class='borde color2 descripcion'>Descripcion</div>
					<div class='borde color2 stock'>Articulos comprados</div>
					<div class='borde color2 costo'>Costo</div>
					<div class='borde color2 foto'>Foto</div>
				</div>
				<?php
				    $suma2 = 0;
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
                        }
                        $cant = $cants[$i];
                        $suma = $cant * $costo;
						$suma2 += $suma;
						echo"<div id='line$id_producto' class='tab txt'>";
							echo "<div class='borde color1 id'>$id_producto</div>";
							echo "<div class='borde color1 nombre'>$nombre</div>";
							echo "<div class='borde color1 codigo'>$codigo</div>";
							echo "<div class='borde color1 descripcion'>$descripcion</div>";
							echo "<div id='producto_cantidad$id_producto' class='borde color1 stock'>$cant</div>";
							echo "<div id='producto_precio$id_producto' class='borde color1 costo'>$suma</div>";
							echo "<div class='borde color1 foto'><img src='../productos/$archivo'></div>";
						echo"</div>";
                        }
				?>
				<div class='total'>
                    <div id="total"><?php echo "Total = $$suma2";?></div>
                </div>
			</div>
		</div>
	</body>


</html>
