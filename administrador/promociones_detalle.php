<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
//promociones_lista.php
require "funciones/conecta.php";
$con = conecta();
$id = $_REQUEST['id'];

$sql = "SELECT * FROM promociones WHERE eliminado = 0 AND id = $id";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
	<head>
		<title>Detalles del Producto</title>
		<link rel="stylesheet" href="../Estilos/Estilos_promociones_detalles.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">

		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		<script> 
		</script>

	</head>
	<body>
		<?php include('menu.php');?>
		<div class="fondotabla">
			<div id="tabla1" class="borde borde1">
				<div class="titulos">Informacion del Producto</div>
				<div id="dist">
					<?php if($row = $res->fetch_array()){
							$id 			= $row["id"];
							$nombre			= $row["nombre"];
							$archivo1 		= $row["archivo"];
							$archivo2 		= $row["archivo_n"];
							echo"<div id='info' class='tab txt'>";
								echo "<div class='borde color2 encabezado2 tab txttitle'>ID</div>";
								echo "<div class='borde color1 encabezado2'>$id</div>";
								echo "<div class='borde color2 encabezado tab txttitle'>Nombre</div>";
								echo "<div class='borde color1 encabezado'>$nombre</div>";
								echo"<div class='borde color2 encabezado tab txttitle'>Nombre del archivo</div>";
								echo"<div class='borde color1 encabezado'>$archivo2</div>";
							echo"</div>";
							echo"<div id='imagen' class='tab txt'>";
								echo"<div class='borde1 img'><img class='img1' src='../promociones/$archivo1'/></div>";
								
							echo"</div>";
						}
					?>
				</div>
				<a href="promociones_lista.php">
					<div class="tab borde color3 boton1">
						<div class="link">Regresar al Listado</div>
					</div>
				</a>
				<a href="promociones_editar.php?id=<?=$id?>">
					<div class="tab borde color3 boton1">
						<div class="link">Editar informacion</div>
					</div>
				</a>	
			</div>
		</div>
	</body>


</html>
