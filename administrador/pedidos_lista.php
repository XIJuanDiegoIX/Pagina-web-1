<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
//pedidos_lista.php
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM pedidos WHERE estado = 1";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
	<head>
		<title>Modulo de pedidos</title>
		<link rel="stylesheet" href="../Estilos/Estilos_pedidos_lista3.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">
		<script src="../Librerias/jquery-3.3.1.min.js"></script>

	</head>
	<body>
		
		<?php include('menu.php');?>
		<div class="fondotabla">
			<div id="tabla1" class="borde borde1">
				<div class="titulos">Lista de pedidos (<?php echo $num?>)</div>
				<div class="tab txttitle">
					<div class='borde color2 id'>ID</div>
					<div class='borde color2 nombre'>Fecha</div>
					<div class='borde color2 codigo'>Id Cliente</div>
					<div class='borde color2 detalle'>Ver detalle</div>
				</div>
				<?php while($row = $res->fetch_array()){
						$id 			= $row["id"];
						$fecha			= $row["fecha"];
						$id_cliente		= $row["id_cliente"];
						echo"<div id='line$id' class='tab txt'>";
							echo "<div class='borde color1 id'>$id</div>";
							echo "<div class='borde color1 nombre'>$fecha</div>";
							echo "<div class='borde color1 codigo'>$id_cliente</div>";
							echo "<a class='borde color3 detalle' href=\"pedidos_detalle.php?id=$id\"><div  class='link'>Ver detalle</div></a>";
							//echo "<a class='borde color3 eliminar' href=\"pedidos_elimina.php?id=$id\"><div><div  class='link'>Eliminar</div></div></a>"; //\"lo lee como texto
						echo"</div>";
					}
				?>
			</div>
		</div>
	</body>


</html>
