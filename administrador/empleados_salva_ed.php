<?php
//empleados_lista.php
require "funciones/conecta.php";
$con = conecta();

//Cachar variables
$id 		= $_REQUEST['id'];
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
}else{
	$archivo = '';
}

//Sube la informacion a la base de datos
$sql = "UPDATE empleados SET 
			nombre = '$nombre', 
            apellidos = '$apellidos', 
            correo = '$correo', 
            rol = $rol";
if($file_name != '') {$sql .= ", archivo_n = '$archivo_n', archivo = '$archivo'";} 
if($pass != '') {$sql .= ", pass = '$passEnc'";} 
$sql .= " WHERE id = $id";
$res = $con->query($sql);

echo"archivo:  $archivo   <br>";
echo"archivo_n:  $archivo_n   <br>";

header("Location: empleados_lista.php");

?>