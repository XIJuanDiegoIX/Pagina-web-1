<!doctype= html>
<?php
session_start();
$nombreUser = $_SESSION['nombreUser'] ?? '';
$archivoUser = $_SESSION['archivoUser'] ?? "5f8135d9e153952323596710e14cd64d.png";
$archivo_nUser = $_SESSION['archivo_nUser'] ?? "5f8135d9e153952323596710e14cd64d.png";
if($rolUser != ''){
    header('Location: salir.php');
}
if($nombreUser != ''){
	header('Location: index.php');
}
?>

<html lang="es">
	<!--www.w3schools.com-->
	<head>
		<meta charset="utf-8">
		<title>Alta de clientes</title> 
		
		<!--<link rel="stylesheet" href="Estilos/Estilos_alta_clientes.css">-->
        <link rel="stylesheet" href="Estilos/Estilos_principal1.css">
		<link rel="stylesheet" href="Estilos/Estilos_alta_clientes.css">
        <link rel="stylesheet" href="Estilos/Estilos_top1.css">
        <link rel="stylesheet" href="Estilos/Estilos_botom2.css">

		
		<script src="Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
			function envia(){
				var nombre 		= $('#nombre').val();
				var apellidos 	= $('#apellidos').val();
				var archivo 	= $('#archivo').val();
				var correo 		= document.forma01.correo.value;
				var pass 		= document.forma01.pass.value;
				//alert('Entro');
				
				if(nombre == "" || apellidos == "" || correo == "" || pass == ""){
					$('#mensaje').html('Faltan Campos por llenar');
					setTimeout("$('#mensaje').html('');",5000);
					//alert('Campos vacios');
					return false;
				}else{
					//alert('Campos llenos');
					
					document.forma01.method = 'post';
					document.forma01.action = 'funciones/clientes_salva.php';
					document.forma01.submit();
					
					return true;
				}
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
		<?php include('top.php');?>
		<div id="tabla12" class="borde2 borde12">
			<div id="dist2">
				<div id='info2' class='tab2 txt2'>
					<div class="titulos2">Alta de clientes</div>
					<div class='borde2'><a class="txttitle2 borde2 color32 link2" href="sesion.php">Regresar</a></div>
					<div class="campotxt2" id="mensaje2"></div>
					<form enctype="multipart/form-data" name="forma01" method="post" action="clientes_salva.php">
						<div class='borde2 color22 encabezado2 txttitle2'>Nombre(s).</div>
						<input class='borde2 campotxt2' type="text" name="nombre" id="nombre2" placeholder="Escribe tu nombre"/> <br> <!--<br> es un salto de linea-->
						<div class='borde2 color22 encabezado2 txttitle2'>Apellido(s).</div>
						<input class='borde2 campotxt2' type="text" name="apellidos" id="apellidos2" placeholder="Escribe tus apellidos"/> <br> <!--<br> es un salto de linea-->
						<div class='borde2 color22 encabezado2 txttitle2'>Correo</div>
						<input class='borde2 campotxt2' onBlur="sale();" type="text" name="correo" id="correo2" placeholder="Escribe tu correo"/> <br> <!--<br> es un salto de linea-->
						<div class='borde2 color22 encabezado2 txttitle2'>Contrasena</div>
						<input class='borde2 campotxt2' type="password" name="pass" id="pass2" placeholder="Escribe tu password"/> <br> <!--text guarda todo caracter alfa numerico y especial-->
						<div class='borde2 color22 encabezado2 txttitle2'>Subir archivo</div>
						<input class='borde2 color12' type="file" name="archivo" id="archivo2"/>
						<input class="borde2 color32 alta2" onclick="return envia(); " type="submit" value="Dar de alta" /> <!--sobmit se asocia en automatico-->
						<!--En on click se escribe codigo javascript, se puede ejecutar una funcion o lo que sea necesario-->
					</form>
				</div>
			</div>
		</div>
	</body>
	
</html>