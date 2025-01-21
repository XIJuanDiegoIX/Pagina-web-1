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
		<title>Alta de Productos</title> 
		
		<link rel="stylesheet" href="../Estilos/Estilos_productos_alta.css">
		<link rel="stylesheet" href="../Estilos/Estilos_menu.css">

		
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
			function envia(){
				var nombre 			= $('#nombre').val();
				var codigo 			= $('#codigo').val();
				var descripcion 	= $('#descripcion').val();
				var costo 			= $('#costo').val();
				var stock 			= $('#stock').val();
				var archivo 		= $('#archivo').val();
				//alert('Entro');
				
				if(nombre == "" || codigo == "" || descripcion == "" || costo == "" || stock == 0 || archivo == ''){
					$('#mensaje').html('Faltan Campos por llenar');
					setTimeout("$('#mensaje').html('');",5000);
					//alert('Campos vacios');
					return false;
				}else{
					//alert('Campos llenos');
					
					document.forma01.method = 'post';
					document.forma01.action = 'productos_salva.php';
					document.forma01.submit();
					
					return true;
				}
			}
			
			function entra(){
				console.log('Entro al campo');
				
			}
			
			function sale(){
				console.log('Salio del campo');
				var codigo = $('#codigo').val();
				var id = '';
				$.ajax({
						url  	 : 'funciones/validaCodigo.php',
						type 	 : 'post',
						dataType : 'text',
						data	 : {codigo: codigo, id: id},
						success  : function(num){
							console.log(num);
							if(num >= 1){
								$('#mensaje').html('El codigo: '+codigo+', ya existe');
								$('#codigo').val('');
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
					<div class="titulos">Alta de productos</div>
					<div class='borde'><a class="txttitle borde color3 link" href="productos_lista.php">Regresar a listados</a></div>
					<div class="campotxt" id="mensaje"></div>
					<form enctype="multipart/form-data" name="forma01" method="post" action="productos_salva.php">
						<div class='borde color2 encabezado txttitle'>Nombre del producto</div>
						<input class='borde campotxt' type="text" name="nombre" id="nombre" placeholder="Escribe tu nombre"/> <br> <!--<br> es un salto de linea-->
						<div class='borde color2 encabezado txttitle'>Codigo</div>
						<input class='borde campotxt' onBlur="sale();" type="text" name="codigo" id="codigo" placeholder="Escribe el codigo"/> <br> <!--<br> es un salto de linea-->
						<div class='borde color2 encabezado txttitle'>Descripcion</div>
						<input class='borde campotxt' type="text" name="descripcion" id="descripcion" placeholder="Escribe tu descripcion"/> <br> <!--<br> es un salto de linea-->
						<div class='borde color2 encabezado txttitle'>Costo</div>
						<input class='borde campotxt' type="number" step="0.01" name="costo" id="costo" placeholder="Escribe tu costo"/> <br> <!--text guarda todo caracter alfa numerico y especial-->
						<div class='borde color2 encabezado txttitle'>Stock</div>
						<input class='borde campotxt' type="number" name="stock" id="stock" placeholder="Escribe tu stock"/> <br> <!--text guarda todo caracter alfa numerico y especial-->
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