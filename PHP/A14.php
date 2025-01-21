<?php
	$nombre   	  = $_POST['nombre'];
	$correo   	  = $_POST['correo'];
	$sexo 	  	  = $_POST['sexo'];
	if($sexo == 'F'){$sex = 'Femenino';}
	else{$sex = 'Masculino';}
	$pass 	  	  = $_POST['pass'];
	$carrera 	  = $_POST['carrera'];
	if($carrera == 1){$car = 'Ingenieria Informática';}
	else{$car = 'Ingenieria en Computacion';}
	$promedio 	  = $_POST['promedio'];
	$fecha    	  = $_POST['fecha'];
	if(isset($_POST['boletin'])){
		$boletin  = $_POST['boletin'];
		if($boletin == true){$bol = 'si';}
		else{$bol = 'no';}
	}else{$bol = 'no';}
	$comentario  = $_POST['comentario'];
	if($comentario == ""){$com = 'Usted no ingreso comentarios';}
	else{$com = $comentario;}

	echo "Bienvenido $nombre ($correo)<br>";
	echo "Sexo: $sex <br>";
	echo "Contraseña: $pass <br>";
	echo "Carrera: $car <br>";
	echo "Promedio: $promedio <br>";
	echo "Fecha de nacimiento: $fecha <br>";
	echo "Usted $bol desea recibir el boletin. <br>";
	echo "Cometarios: $com <br>";
	echo "<br><br>";

?>