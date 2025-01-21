<?php

$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$contenido = $_REQUEST['contenido'];

$to = 'juan.rodriguez6249@alumnos.udg.mx';
$subject = 'Ayuda con el servidor';
$message = 'Nombre del cliente: '.$nombre.' '.$apellidos.' Correo: '.$correo.' Asunto: '.$contenido;
$headers = 'From: '.$correo."\r\n".'Reply-To: '.$correo;

if(mail($to,$subject,$message,$headers)){
    echo $resultado = 'Exito';
    header('../index.php');
}else{
    echo $resultado = 'Error';
    header('../contact.php');
}
?>