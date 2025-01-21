<!doctype= html>

<html>
	<head>
		<title>Inicio de Sesion</title>
		
		<link rel="stylesheet" href="PracticasJDRM/Estilos/Estilos_alta3.css">
		
		<script src="PracticasJDRM/Librerias/jquery-3.3.1.min.js"></script>
		
		<script>
		
			function ingreso(){
				var correo 		= $('#email').val();
				var pass 		= $('#pass').val();
				if(correo == '' || pass == ''){
					$('#mensaje').html('Campos Vacios');
					setTimeout("$('#mensaje').html('');",5000);
					return false;
				}else{
					$.ajax({
						url  	 : 'PracticasJDRM/administrador/funciones/validaInicio.php',
						type 	 : 'post',
						dataType : 'text',
						data	 : {correo: correo, pass: pass},
						success  : function(num){
							console.log(num);
							if(num >= 1){
								$('#mensaje').html('Inico Exitoso');
								//alert('Exito');
								setTimeout("$('#mensaje').html('');",5000);
								document.login01.method = 'post';
								document.login01.action = 'PracticasJDRM/administrador/bienvenido.php';
								document.login01.submit();
							} else {
								$('#mensaje').html('El correo y contrasena son incorrectos');
								//alert('Fallo');
							}
							setTimeout("$('#mensaje').html('');",5000);
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
		<div id="tabla1" class="borde borde1">
			<div id="dist">
				<div id='info' class='tab txt'>
					<div class="titulos">Inicio De Sesion</div>
					<div class="campotxt" id="mensaje"></div>
					<form name="login01">
						<div class='borde color2 encabezado txttitle'>Correo</div>
						<input class='borde campotxt' id="email" name="email" type="text" />
						<div class='borde color2 encabezado txttitle'>Contrasena</div>
						<input class='borde campotxt' id="pass"  name="pass" type="password" />
						<input class="borde color3 alta" onclick="return ingreso();" type="submit" value="Iniciar Sesion" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>