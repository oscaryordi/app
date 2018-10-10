<?php 
if($_SESSION["infraccionV"] > 0 AND $_SESSION["filtroFlotilla"]==0)
{ // RESUMEN SUSTITUTO ?>
	<form action="infResumen.php" class="navegacion">
		<input id="gobutton2" type="submit" name="resumen infracciones" value="Resumen Infracciones">
	</form>
<?php 
}

/**/
if($_SESSION["infraccionV"] > 0 AND $_SESSION["filtroFlotilla"]==1)
{ // HACER SOLICITUD ?>
	<form action="infResumenFF1.php" class="navegacion">
		<input id="gobutton2" type="submit" name="resumen infracciones" value="Resumen Infracciones Ctto">
	</form>
<?php 
} 
?>