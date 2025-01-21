<!doctype= html>
<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
?>

<html lang="es">
	<!--www.w3schools.com-->
	<head>
		<meta charset="utf-8">
		<title>Alta de Empleados</title> 
		
		<link rel="stylesheet" href="../Estilos/Estilos_alta3.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">

		
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
			
			//Comentario

			/*Comentario*/
			
			//Redireccionamiento mediante JavaScript
			//window.location.href = 'bienvenido.php';
			
			function miAlerta(nombre, calificacion){
				alert('Bienvenido: '+nombre+', Tu calificacion es: '+calificacion); //Se puede usar sin estar en una funcion
				//El simbolo "+" concatena
				//F12, herramienta para desarrolladores en navegador
			}
			
			var nombre 			= "Ruben";
			var apellidos		= 'Maldonado';
			var calificacion	=  59;
			
			//miAlerta(nombre, calificacion);
			
			function envia(){
				var nombre 		= $('#nombre').val();
				var apellidos 	= $('#apellidos').val();
				var archivo 	= $('#archivo').val();
				var correo 		= document.forma01.correo.value;
				var pass 		= document.forma01.pass.value;
				var rol 		= document.forma01.rol.value;
				//alert('Entro');
				
				if(nombre == "" || apellidos == "" || correo == "" || pass == "" || rol == 0 || archivo == ''){
					$('#mensaje').html('Faltan Campos por llenar');
					setTimeout("$('#mensaje').html('');",5000);
					//alert('Campos vacios');
					return false;
				}else{
					//alert('Campos llenos');
					
					document.forma01.method = 'post';
					document.forma01.action = 'empleados_salva.php';
					document.forma01.submit();
					
					return true;
				}
			}
			
			function entra(){
				console.log('Entro al campo');
				
			}
			
			function sale(){
				console.log('Salio del campo');
				var correo = $('#correo').val();
				var id = '';
				$.ajax({
						url  	 : 'funciones/validaCorreo.php',
						type 	 : 'post',
						dataType : 'text',
						data	 : {correo: correo, id: id},
						success  : function(num){
							console.log(num);
							if(num >= 1){
								$('#mensaje').html('El correo: '+correo+', ya existe');
								$('#correo').val('');
							} else {
								//$('#mensaje').html('REPROBASTE'); //test
							}
							setTimeout("$('#mensaje').html('');",5000);
						},error:function(){
							alert('Error archivado no encontrado...');
						}
						
					});
				
			}
			
			
		</script>
	</head>

	<body>
		<!--Metodos:
		-post no muestra datos extra
		-get muestra los datos a enviar en el url
		-->
		<?php include('menu.php');?>
		<div id="tabla1" class="borde borde1">
			<div id="dist">
				<div id='info' class='tab txt'>
					<div class="titulos">Alta de Empleados</div>
					<div class='borde'><a class="txttitle borde color3 link" href="empleados_lista.php">Regresar a listados</a></div>
					<div class="campotxt" id="mensaje"></div>
					<form enctype="multipart/form-data" name="forma01" method="post" action="empleados_salva.php">
						<div class='borde color2 encabezado txttitle'>Nombre(s).</div>
						<input class='borde campotxt' type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre"/> <br> <!--<br> es un salto de linea-->
						<div class='borde color2 encabezado txttitle'>Apellido(s).</div>
						<input class='borde campotxt' type="text" name="apellidos" id="apellidos" placeholder="Escribe tus apellidos"/> <br> <!--<br> es un salto de linea-->
						<div class='borde color2 encabezado txttitle'>Correo</div>
						<input class='borde campotxt' onfocus="entra();" onBlur="sale();" type="text" name="correo" id="correo" placeholder="Escribe tu correo"/> <br> <!--<br> es un salto de linea-->
						<div class='borde color2 encabezado txttitle'>Contrasena</div>
						<input class='borde campotxt' type="password" name="pass" id="pass" placeholder="Escribe tu password"/> <br> <!--text guarda todo caracter alfa numerico y especial-->
						<div class='borde color2 encabezado txttitle'>Rol</div>
						<!--Name, las etiquetas pueden compartir el mismo nombre, id, no puede repetirse
						ctrl + f5 actualiza y borra cache
						-->
						<select class='borde campotxt' name="rol" id="rol">
							<option value="0">Selecciona</option>
							<option value="1">Gerente</option>
							<option value="2">Ejecutivo</option>
						</select> <br>
						<div class='borde color2 encabezado txttitle'>Subir archivo</div>
						<input class='borde color1' type="file" name="archivo" id="archivo"/>
						<input class="borde color3 alta" onclick="return envia(); " type="submit" value="Dar de alta" /> <!--sobmit se asocia en automatico-->
						<!--En on click se escribe codigo javascript, se puede ejecutar una funcion o lo que sea necesario-->
					</form>
				</div>
			</div>
		</div>
	</body>
	
</html>