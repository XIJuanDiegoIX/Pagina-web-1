<!doctype= html>
<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
/*$rolUser = $_SESSION['rolUser'];
if($rolUser != 1){
	header('Location: ../index.php');
    exit();
}*/
?>


<html>
	<head>
		<title>Inicio de Sesion</title>
		
		<link rel="stylesheet" href="../Estilos/Estilos_alta3.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">
		
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		
	</head>
	<body>
		<?php include('menu.php');?>
		<div id="tabla1" class="borde borde1">
			<div class='borde color2 encabezado txttitle'>Bienvenido Al programa "Proyecto Terminal"</div>
			<div class='borde color3 alta'>Bienvenido <?php echo $nombreUser?></div>
			<a href="../index.php">Regresar</a>
		</div>
		
	</body>
</html>