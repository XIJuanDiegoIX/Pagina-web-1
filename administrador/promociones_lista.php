<?php
session_start();
$nombreUser = $_SESSION['nombreUser'];
if($nombreUser == ''){
	header('Location: index.php');
}
//promociones_lista.php
require "funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM promociones WHERE eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;
?>
<html>
	<head>
		<title>Modulo de promociones</title>
		<link rel="stylesheet" href="../Estilos/Estilos_promociones_lista3.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		<script> 
			function borrar(id){
				var val = confirm('¿Desea Eliminar el producto?');
				if(val == true){
					$.ajax({
						url  	 : 'promociones_elimina.php?id='+id,
						type 	 : 'post',
						dataType : 'text',
						success  : function(){
							console.log('si');
							$('#line'+id).hide();
						},error:function(){
							alert('Error archivado no encontrado...');
						}
						
					});
				}
			}
		</script>

	</head>
	<body>
		
		<?php include('menu.php');?>
		<div class="fondotabla">
			<div id="tabla1" class="borde borde1">
				<div class="titulos">Lista de promociones (<?php echo $num?>)</div>
				<a href="promociones_alta.php">
					<div class="tab borde color3 boton1">
						<div class="link">Dar de alta promociones</div>
					</div> 
				</a>
				<div class="tab txttitle">
					<div class='borde color2 id'>ID</div>
					<div class='borde color2 nombre'>Nombre</div>
					<div class='borde color2 detalle'>Ver detalle</div>
					<div class='borde color2 editar'>Editar</div>
					<div class='borde color2 eliminar'>Eliminar</div>
				</div>
				<?php while($row = $res->fetch_array()){
						$id 			= $row["id"];
						$nombre			= $row["nombre"];
						echo"<div id='line$id' class='tab txt'>";
							echo "<div class='borde color1 id'>$id</div>";
							echo "<div class='borde color1 nombre'>$nombre</div>";
							echo "<a class='borde color3 detalle' href=\"promociones_detalle.php?id=$id\"><div  class='link'>Ver detalle</div></a>";
							echo "<a class='borde color3 editar' href=\"promociones_editar.php?id=$id\"><div  class='link'>Editar</div></a>";
							//echo "<div class='borde color1 editar'>Editar</div>";
							echo "<a class='borde color3 eliminar' href=\"javascript:void(0);\" onclick='borrar($id);'><div  class='link'>Eliminar</div></a>"; //\"lo lee como texto
							//echo "<a class='borde color3 eliminar' href=\"promociones_elimina.php?id=$id\"><div><div  class='link'>Eliminar</div></div></a>"; //\"lo lee como texto
						echo"</div>";
					}
				?>
			</div>
		</div>
	</body>


</html>
