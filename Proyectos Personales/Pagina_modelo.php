<html>
	<head>
		<meta charset="UTF-8">
		<title>Enseñanza de indiomas</title>
		<style>
			body{
				padding:0;
				margin: 0;
				height: 100%;
			}
			#pag{
				display:flex;
				flex-direction: column;
				height: 100%;
			}
			#top{
				width: 100%;
				height: 100px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
				position: absolute;
			}
			#logo img{
				margin: 4px 0 0 40px;
				height: 50px;
				width: 50px;
				border-radius: 10%;
				border: solid #3a3 2px;
			}
			#barraup{
				display: flex;
				justify-content: space-between;
			}
			#sesion{
				float: right;
			}
			#sesion img{
				width: 		36px;
				height: 	36px;
				border-radius: 50%;			
				overflow: hidden;
				border: solid #3a3 2px;
				margin: 10px 40px 0px 0px;
			}
			#barra{
				display: flex;
				position: absolute;
				bottom: 0;
				height: auto;
				max-height: 33px;
				width: 100%;
				flex: 1;
				overflow: hidden;
				background-color: #2c2;
				box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.3);
			}
			.boton1{
				border-radius: 10px;			
				border: solid #000 1px;
				background-color: #5c5;
				height: 20px;
				margin: 0 auto;
				padding: 5px;
				text-align: center;
				color: white;
				text-decoration: none;
				border-bottom: solid #aaa 3px;
				transition: 0.2s;
				box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
				
			}
			.boton1:hover{
				padding: 7px;
				color: #070;
				font-weight:bold;
				font-size: 16;
			}
			#info{
				background-color: #fff;
				flex-grow: 1;
			}
			#pagizq{
				border: solid #000 1px;
				height: 200px;
			}
			#botom{
				width: 100%;
				height: 50px;
				box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.3);
			}
			#redes{
				display: flex;
				flex: 1;
				padding-left: 40px;
			}
			.btnredes{
				width: 		36px;
				height: 	36px;
				border-radius: 10px;			
				overflow: hidden;
				border: solid #3a3 2px;
				margin: 5px 8px 0px 8px;
			}
			.color1{background-color: #3f3;}
			#txt1{
				width: 80%;
				border: solid #000 2px;
				color: white;
				font-size: 10;
				height: auto;
				text-align: center;
			}

			
		</style>
		<script>

		</script>
	</head>
	
	<body>
		<div id="pag">
			<div class="color1" id="top">
				<div id="barraup">
					<div id="logo">
						<img src="../Fotos/Logo.png">
					</div>
					<div id="sesion">
						<a href="Idiomas_inicio_sesion.php" ><img src="../Fotos/sesion.png"></a>
					</div>
				</div>
				<div id="barra">
					<a class="boton1" href="Idiomas_inicio.php">Inicio</a>
					<a class="boton1" href="Idiomas_info.php">¿Quienes Somos?</a>
					<a class="boton1" href="Idiomas_vision.php">Nuestra vision</a>
					<a class="boton1" href="Idiomas_inscripcion.php">Inscribirse</a>
					<a class="boton1" href="Idiomas_contacto.php">Contacto</a>
				</div>
			</div>
			<div id="info">
				<div id="pagizq">Holas</div>
				<div id="pagcent"></div>
				<div id="pagder"></div>
			</div>
			<div class="color1" id="botom">
				<div id="redes">
					<div>
						<a id="X-TW" href="https://x.com/XIJuanDiegoIX" target="_blank">						<img class="btnredes" src="../Fotos/Twitter.png"></a>
						<a id="Face" href="https://www.facebook.com/juandiego.rodriguezmacias" target="_blank">	<img class="btnredes" src="../Fotos/Facebook.png"></a>
						<a id="Insta" href="https://www.instagram.com/xijuandiegoix/" target="_blank">			<img class="btnredes" src="../Fotos/Instagram.png"></a>
					</div>
					<div id="txt1">Pagina sin fines de lucro.</div>
				</div>
			</div>
		</div>
	</body>
</html>