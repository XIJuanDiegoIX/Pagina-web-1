<?php
//empleados_lista.php
require "funciones/conecta.php";
$con = conecta();

//Cachar variables
$nombre 	= $_REQUEST['nombre'];
$apellidos 	= $_REQUEST['apellidos'];
$correo 	= $_REQUEST['correo'];
$pass 		= $_REQUEST['pass'];
$rol	 	= $_REQUEST['rol'];
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
}

//Sube la informacion a la base de datos
$sql = "INSERT INTO empleados
		(nombre, apellidos, correo, rol, pass, archivo_n, archivo)
		VALUES('$nombre', '$apellidos', '$correo', $rol, '$passEnc', '$archivo_n', '$archivo')";
$res = $con->query($sql);

echo"archivo:  $archivo   <br>";
echo"archivo_n:  $archivo_n   <br>";

header("Location: empleados_lista.php");

?>