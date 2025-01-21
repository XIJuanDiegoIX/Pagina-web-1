	<div id="top" class="">
		<div id="cabeza">
			<div id="logo"><img src="Fotos/logo.png" alt="Tu Empresa"></div>
			<div id="sesion">
				
				<?php if($nombreUser == ''){
					echo"
					<div id='Nomb_usuario' class=''>
						<div id='sesion1'> 
							<div>Bienvenid@</div>
							<a href='sesion.php' alt='Iniciar sesion'>
								<img src='archivos/$archivoUser' alt='Iniciar sesion'>
							</a>
						</div>
					</div>
					";
				}else{
					echo"
					<div id='Nomb_usuario' class=''>
						<div id='sesion1'>
							<div>Bienvenid@ $nombreUser</div>
							<img src='archivos/$archivoUser' alt='$archivo_nUser'>
						</div>
					</div>
					";
				}
				?>
			</div>
		</div>
        <div id="menu">
			<div class="fondotablamenu">
				<div class="tablamenu">
					<a class="linksM color3 botonM" href="index.php">Inicio</a>
					<a class="linksM color3 botonM" href="productos.php">Productos</a>
					<a class="linksM color3 botonM" href="contacto.php">Contacto</a>
					<?php if($nombreUser != ''){
						echo "<a id='carrito' class='linksM color3 botonM' href='carrito.php'></a>";
					}?>
					<?php if($nombreUser != ''){
						echo "<a class='linksM color3 botonM' href='salir.php'>Salir</a>";
					}?>
				</div>
			</div>
        </div>
    </div>