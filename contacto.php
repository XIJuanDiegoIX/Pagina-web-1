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
            var val;
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
            function envia(){
                var nombre = $('#nombre').val();
                var apellidos = $('#apellidos').val();
                var correo = $('#correo').val();
                var contenido = $('#texto').val();
                //alert('funcion');
                if(nombre == '' || apellidos == '' || correo == '' || contenido == ''){
                    $('#mensaje').html('Faltan Campos por llenar');
                    setTimeout("$('#mensaje').html('Ingrese su mensaje');",5000);
                    return false;
                }
                $('#enviar').hide();
                $('#mensaje').html('Su solicitud esta siendo procesada');
                setTimeout("$('#mensaje').html('Ingrese su mensaje');", 5000);
                $.ajax({
					url  	 : 'funciones/mail.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {
                                nombre: nombre,
                                apellidos: apellidos, 
                                correo: correo,
                                contenido: contenido
                            },
					success  : function(resultado){
                        //alert('entro');
						if(resultado == 'Exito'){
                            //alert(resultado);
                            window.location.href = 'index.php';
						}else{
                            $('#mensaje').html('Error al enviar, verifique los datos enviados');
                            $('#enviar').show();
                            return false;
                        }
						setTimeout("$('#mensaje').html('');",5000);
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
                return false;
            }
        </script>
        <style>

        </style>
    </head>
    <body>
        <div id="pag">  
            <?php include('top.php');?>
            <div id="info">
                <div class='fondoC'>
                    <div class='tablaC'>
                        <form name="forma01" method="post" action='index.php'>
                            <div id='mensaje'>Ingrese su mensaje</div>
                            <div class='info_boton'>Nombre</div>
                            <input class='recuadroC' type="text" id='nombre' placeholder='Nombre'/><br/>
                            <div class='info_boton'>Apellidos</div>
                            <input class='recuadroC' type="text" id='apellidos' placeholder='Apellidos'/><br/>
                            <div class='info_boton'>Correo</div>
                            <input class='recuadroC' type="email" id='correo' placeholder='Correo'/><br/>
                            <div class='info_boton'>Mensaje</div>
                            <input class='recuadroC' type='text' id='texto' placeholder='Ingrese su mensaje'/><br/>
                            <input class='boton_agregar' type='submit' id='enviar' placeholder='Enviar' onclick="return envia();"/>
                        </form>
                    </div>
                </div>
            </div>
            <?php include('botom.php');?>            
        </div>
    </body>
</html>