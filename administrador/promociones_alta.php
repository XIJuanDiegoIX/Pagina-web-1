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
		<title>Alta de promociones</title> 
		
		<link rel="stylesheet" href="../Estilos/Estilos_promociones_alta.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">

		
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
			function envia(){
				var nombre 			= $('#nombre').val();
				var archivo 		= $('#archivo').val();
				//alert('Entro');
				
				if(nombre == "" || archivo == ''){
					$('#mensaje').html('Faltan Campos por llenar');
					setTimeout("$('#mensaje').html('');",5000);
					//alert('Campos vacios');
					return false;
				}else{
					//alert('Campos llenos');
					
					document.forma01.method = 'post';
					document.forma01.action = 'promociones_salva.php';
					document.forma01.submit();
					
					return true;
				}
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
					<div class="titulos">Alta de promociones</div>
					<div class='borde'><a class="txttitle borde color3 link" href="promociones_lista.php">Regresar a listados</a></div>
					<div class="campotxt" id="mensaje"></div>
					<form enctype="multipart/form-data" name="forma01" method="post" action="promociones_salva.php">
						<div class='borde color2 encabezado txttitle'>Nombre (Etiqueta)</div>
						<input class='borde campotxt' type="text" name="nombre" id="nombre" placeholder="Escribe la promocion"/> <br> <!--<br> es un salto de linea-->
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