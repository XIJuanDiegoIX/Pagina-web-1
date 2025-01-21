<html>
	<head>
		<title>Ajax / Jquery</title>
		<style>
		#mensaje{
			color:#f00;
			font-size:16px
		}
		</style>
		<script src="../Librerias/jquery-3.3.1.min.js"></script>
		<script>
			function enviaAjax(){
				var numero = $('#numero').val();
				if (numero == '' || numero <= 0) {
					$('#mensaje').html('Faltan campos por llenar');
					setTimeout("$('#mensaje').html('');",5000);
				}else{
					//Hace algo
					$.ajax({
						url  	 : 'respuesta.php',
						type 	 : 'post',
						dataType : 'text',
						data	 : 'numero='+numero,
						success  : function(res){
							console.log(res);
							if(res == 1){
								$('#mensaje').html('APROBASTE');
							} else {
								$('#mensaje').html('REPROBASTE');
							}
							setTometout("$('#mensaje').html('');",5000);
						},error:function(){
							alert('Error archivado no encontrado...');
						}
						
					});
				}
			}
		</script>
	</head>
	<body>
		<input type="text" name="numero" id="numero" /><br>
		<a href="javascript:void(0);" onclick="enviaAjax();">
			Envia con ajax
		</a><br>
		<div id="mensaje"></div>
	</body>
</html>