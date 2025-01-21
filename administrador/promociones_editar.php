<!doctype= html>

<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
require "funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];

$sql = "SELECT * FROM promociones WHERE eliminado = 0 AND id = $id";
$res = $con->query($sql);
$num = $res->num_rows;
if($row = $res->fetch_array()){
	$id 			= $row["id"];
	$nombre			= $row["nombre"];
	$archivo1 		= $row["archivo"];
	$archivo2 		= $row["archivo_n"];
}
?>

<html lang="es">
	<!--www.w3schools.com-->
	<head>
		<meta charset="utf-8">
		<title>Editar promociones</title> 
		
		<link rel="stylesheet" href="../Estilos/Estilos_promociones_alta.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">
		
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
			function envia(){
				var nombre 			= $('#nombre').val();
				var archivo 		= $('#archivo').val();
				
				if(nombre == ""){
					$('#mensaje').html('Faltan Campos por llenar');
					setTimeout("$('#mensaje').html('');",5000);
					return false;
				}else{
					//alert('Campos llenos');
					
					document.forma01.method = 'post';
					document.forma01.action = 'promociones_salva_ed.php?id=<?=$id?>';
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
					<div class="titulos">Editar a promociones</div>
					<div class='borde'><a class="txttitle borde color3 link" href="promociones_lista.php">Regresar a listados</a></div>
					<div class="campotxt" id="mensaje"></div>
					<form enctype="multipart/form-data" name="forma01" method="post" action="promociones_salva_ed.php?id=<?=$id?>">
						<div class='borde color2 encabezado txttitle'>Nombre del producto</div>
						<input value="<?php echo"$nombre"?>" class='borde campotxt' type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre"/> <br> <!--<br> es un salto de linea-->
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
// 