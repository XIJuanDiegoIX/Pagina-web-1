<?php
		$filas = $_POST['filas'];
			echo "<table width='100%' border='1'>";
			for ($i = 0; $i < $filas; $i++) {
				echo "<tr><td>" . ($i + 1) . "</td></tr>";
			}
			echo "</table>";
		}
?>