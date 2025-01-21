<html>
	<head>
	<script>
	var valor;
	function validar(){
		var valor = document.forma01.filas.value;
		if (valor < 0 || valor > 5000 || valor == "") {
			alert("El valor no es válido.");
			return false;
		} else if (valor == 0) {
			alert("El valor es demasiado pequeño.");
			return false;
		} else {return true};
	}
	</script>
	
	</head>
	<body>
		<form name="forma01" method='post' action='A15.1.php'>
			<div>
				Ingrese un valor entre 1 y 5000
			</div><br>
			<label for='filas'>
				Filas:
				<input type='number' name='filas' min='0' max='5000'/><br>
			</label>
			<input type='submit' onclick="return validar();" value='Crear' />
		</form>
	</body>
</html>