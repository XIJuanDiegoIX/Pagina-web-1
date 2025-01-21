<?php
//clientes_lista.php
require "conecta.php";
$con = conecta();

//Cachar variables
$nombre 	= $_REQUEST['nombre'];
$apellidos 	= $_REQUEST['apellidos'];
$correo 	= $_REQUEST['correo'];
$pass 		= $_REQUEST['pass'];
$file_name 	= $_FILES['archivo']['name'];
$file_tmp 	= $_FILES['archivo']['tmp_name'];
$archivo_n  = $file_name;
//Encriptar Contraseña
$passEnc = md5($pass);

//Encripta los archivos
if($file_name != ''){
	$arreglo 	= explode(".", $file_name);
	$len 		= count($arreglo);
	$pos 		= $len-1;
	$ext 		= $arreglo[$pos];
	$dir 		= "../archivos/";
	$file_enc 	= md5_file($file_tmp);

	if($file_name != ''){
		$archivo = "$file_enc.$ext";
		copy($file_tmp, $dir.$archivo);
	}
}else{
	$archivo = '5f8135d9e153952323596710e14cd64d.png';
	$archivo_n = '5f8135d9e153952323596710e14cd64d.png';
}

//Sube la informacion a la base de datos
$sql = "INSERT INTO clientes
		(nombre, apellidos, correo, pass, archivo_n, archivo)
		VALUES('$nombre', '$apellidos', '$correo', '$passEnc', '$archivo_n', '$archivo')";
$res = $con->query($sql);
?>

<html>
	<head>
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		<script>
			function iniciar(){
				var correo 		= "<?php echo $correo;?>";
				var pass 		= "<?php echo $pass;?>";
				console.log(correo);
				console.log(pass);
				$.ajax({
					url  	 : 'validaInicio.php',
					type 	 : 'post',
					dataType : 'text',
					data	 : {correo: correo, pass: pass},
					success  : function(num){
						console.log(num);
						if(num >= 1){
							$('#mensaje').html('Inico Exitoso');
							setTimeout("$('#mensaje').html('');",5000);
							window.location.href = '../index.php';
						} else {
							$('#mensaje').html('El correo y contrasena son incorrectos');
						}
						setTimeout("$('#mensaje').html('');",5000);
					},error:function(){
						alert('Error archivado no encontrado...');
					}
				});
				return false;
			}
			iniciar();
		</script>
	</head>
	<body>
		<div id="mensaje"></div>
	</body>
</html>