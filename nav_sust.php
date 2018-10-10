<?php
if($_SESSION["sustituto"] > 0)
{ // RESUMEN SUSTITUTO ?>
	<form action="autosustitutolistado.php" class="navegacion">
		<input id="gobutton2" type="submit" name="resumen sustitutos" value="Resumen Sustitutos">
	</form>
<?php 
} 

if($_SESSION["sustituto"] > 0)
{ // HACER SOLICITUD ?>
	<form action="autosustituto.php" class="navegacion">
		<input id="gobutton2" type="submit" name="solicitar sustituto" value="Solicitar Sustituto">
	</form>
<?php 
} 

if($_SESSION["sustituto"] > 2){ // DESCARGAR RESUMEN ?>
	<form action="autosSresumenD.php" class="navegacion">
		<input id="gobutton2" type="submit" name="Descargar_Resumen" value="Descargar_Resumen">
	</form>
<?php 
}

if($_SESSION["sustituto"] > 0){ // DESCARGAR RESUMEN ?>
	<form action="autosustitutoindice.php" class="navegacion">
		<input id="gobutton2" type="submit" name="Consultar_solicitud" value="Consultar Solicitud">
	</form>
<?php 
}

?>