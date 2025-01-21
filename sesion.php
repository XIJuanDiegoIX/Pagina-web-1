<!doctype= html>
<?php
session_start();
$nombreUser = $_SESSION['nombreUser'] ?? '';
$rolUser = $_SESSION['rolUser'] ?? '';
$archivoUser = $_SESSION['archivoUser'] ?? "5f8135d9e153952323596710e14cd64d.png";
$archivo_nUser = $_SESSION['archivo_nUser'] ?? "5f8135d9e153952323596710e14cd64d.png";
if($rolUser != ''){
    header('Location: salir.php');
}
if($nombreUser != ''){
	header('Location: index.php');
}
?>
<html>
	<head>
		<title>Inicio de Sesion</title>
		
		<link rel="stylesheet" href="Estilos/Estilos_alta_clientes.css">
		<link rel="stylesheet" href="Estilos/Estilos_top1.css">
        <link rel="stylesheet" href="Estilos/Estilos_botom2.css">
		
		<script src="Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
		
			function ingreso(){
				var correo 		= $('#email2').val();
				var pass 		= $('#pass2').val();
				if(correo == '' || pass == ''){
					$('#mensaje2').html('Campos Vacios');
					setTimeout("$('#mensaje2').html('');",5000);
					return false;
				}else{
					$.ajax({
						url  	 : 'funciones/validaInicio.php',
						type 	 : 'post',
						dataType : 'text',
						data	 : {correo: correo, pass: pass},
						success  : function(num){
							console.log(num);
							if(num >= 1){
								$('#mensaje2').html('Inico Exitoso');
								//alert('Exito');
								setTimeout("$('#mensaje').html('');",5000);
								document.login01.method = 'post';
								document.login01.action = 'index.php';
								document.login01.submit();
							} else {
								$('#mensaje2').html('El correo y contrasena son incorrectos');
								//alert('Fallo');
							}
							setTimeout("$('#mensaje2').html('');",5000);
						},error:function(){
							alert('Error archivado no encontrado...');
						}
					});
					return false;
				}
			}
		</script>
		
	</head>
	<body>
		<?php include('top.php');?>
		<div id="tabla12" class="borde2 borde12">
			<div id="dist2">
				<div id='info2' class='tab2 txt2'>
					<div class="titulos2">Inicio De Sesion</div>
					<div class="campotxt2" id="mensaje2"></div>
					<form name="login01">
						<div class='borde2 color22 encabezado2 txttitle2'>Correo</div>
						<input class='borde2 campotxt2' id="email2" name="email2" type="text" />
						<div class='borde2 color22 encabezado2 txttitle2'>Contrasena</div>
						<input class='borde2 campotxt2' id="pass2"  name="pass2" type="password" />
						<input class="borde2 color32 alta2" onclick="return ingreso();" type="submit" value="Iniciar Sesion" />
					</form>
					<div class='borde2'><a class="txttitle2 borde2 color32 link2" href="clientes_alta.php">Nuevo Usuario</a></div>
				</div>
			</div>
		</div>
		<?php include('botom.php');?>
	</body>
</html>