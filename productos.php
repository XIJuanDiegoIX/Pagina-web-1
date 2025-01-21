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
	//header('Location: index.php');
}
?>

<html>
    <head>
        <script src="Librerias/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="Estilos/Estilos_principal.css">
        <link rel="stylesheet" href="Estilos/Estilos_top1.css">
        <link rel="stylesheet" href="Estilos/Estilos_botom2.css">
        <title>Index</title>

        <script>
            var val = 0;
            function carrito(){
                $.ajax({
					url  	 : 'funciones/cant_articulos_carrito.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {val : val},
					success  : function(num){
						if(num >= 0){
							val = num;
                            $('#carrito').html('Carrito ('+val+')');
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
    </head>
    <body>
    <div id="pag">  
            <?php include('top.php');?>
            <div id="info">
                <div id="productos">
                    <?php
                        
                        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND stock > 0";
                        $res = $con->query($sql);
                        $num = $res->num_rows;
                        $i=0;
                        echo "<div class='filas'>";
                        while($row = $res->fetch_array()){
                            if($i%5 == 0){echo "</div><div class='filas'>";} 
                            $i++;
                            $id_producto = $row['id'];
                            $archivo = $row['archivo'];
                            $descripcion = $row['descripcion'];
                            echo "<div id='prod$id_producto' class='prod'>
                                    <a href='producto_detalle.php?id=$id_producto'>
                                        <img src='productos/$archivo'>
                                    </a>
                                    <div class='recuadro'>
                                        <div class='desc'>
                                            <p>$descripcion</p>
                                        </div>
                                        <div>";
                                        if($idUser != ''){
                                            echo "<button class='boton_agregar' onclick='return agregar($id_producto, 1);'>Agregar</button>";
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