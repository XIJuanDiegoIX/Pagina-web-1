<?php
//promociones_lista.php
require "funciones/conecta.php";
$con = conecta();

//Cachar variables
$nombre 		= $_REQUEST['nombre'];
$file_name 		= $_FILES['archivo']['name'];
$file_tmp 		= $_FILES['archivo']['tmp_name'];
$archivo_n  	= $file_name;

//Encripta los archivos
if($file_name != ''){
	$arreglo 	= explode(".", $file_name);
	$len 		= count($arreglo);
	$pos 		= $len-1;
	$ext 		= $arreglo[$pos];
	$dir 		= "../promociones/";
	$file_enc 	= md5_file($file_tmp);

	if($file_name != ''){
		$archivo = "$file_enc.$ext";
		copy($file_tmp, $dir.$archivo);
	}
}

//Sube la informacion a la base de datos
$sql = "INSERT INTO promociones
		(nombre, archivo_n, archivo)
		VALUES('$nombre', '$archivo_n', '$archivo')";
$res = $con->query($sql);

echo"archivo:  $archivo   <br>";
echo"archivo_n:  $archivo_n   <br>";

header("Location: promociones_lista.php");

?>