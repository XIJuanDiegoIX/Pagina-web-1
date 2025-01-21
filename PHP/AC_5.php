<?php
	echo "Programacion para internet <br>";
	echo 'Lunes y miercoles 7:00am <br>';
	$maestro = 'Rubén';
	$alumno = "Luis";
	$examen1 = 60;
	$examen2 = 85;
	$total = ($examen1 + $examen2) / 2;
	echo "La calificacion de $alumno es ".$total.'<br>';
	echo 'Calificado por $maestro';
	echo "<br>";
	echo "Calificacion del primer examen: <br>";
	echo $examen1;
	echo "<br>";
	/*en php las comillas dobles permiten imprimir 
	variables dentro de la variable echo:
	echo "Calificación: $cal";
	echo 'Calificación: $cal';

	En el caso de las comillas dobles si imprimirá 
	el valor de la calificación, en las comillas 
	simples lo imprimirá como texto(textualmente: $cal).
	*/
?>  