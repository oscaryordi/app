<nav>

<?php
if($_SESSION["gps"] > 0){ // RESUMEN GPS ?>
<form action="gpsresumen.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen gps" value="Resumen GPS">
</form>
<?php }

if($_SESSION["gps"] > 0){ // ALTA GPS ?>
<form action="gpsequipoalta.php" class="navegacion">
<input id="gobutton2" type="submit" name="gps alta" value="Alta GPS">
</form>
<?php }

if($_SESSION["gps"] > 0){ // ALTA LINEA ?>
<form action="gpslineaalta.php" class="navegacion">
<input id="gobutton2" type="submit" name="linea alta" value="Alta línea">
</form>
<?php }

if($_SESSION["gps"] > 0){ // ALTA SIM ?>
<form action="gpssimalta.php" class="navegacion">
<input id="gobutton2" type="submit" name="sim alta" value="Alta SIM">
</form>
<?php }

if($_SESSION["gps"] > 0){ // ASIGNAR GPS ?>
<form action="gpsequipoasignacion.php" class="navegacion">
<input id="gobutton2" type="submit" name="equipo_activo_asignar" value="Asignar Equipo Activo">
</form>
<?php }

if($_SESSION["gps"] > 0){ // ASIGNAR GPS ?>
<form action="gpsResumenD.php" class="navegacion">
<input id="gobutton2" type="submit" name="descargar_resumen" value="Descargar Resumen">
</form>
<?php }

if($_SESSION["gps"] > 0){ // ASIGNAR GPS ?>
<form action="gpsAlerta.php" class="navegacion">
<input id="gobutton2" type="submit" name="generar_alerta" value="Generar Alerta">
</form>
<?php } 

if($_SESSION["gps"] > 0){ // ASIGNAR GPS ?>
<form action="gpsAlertaRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen_alerta" value="Resumen Alertas">
</form>
<?php }


if($_SESSION["gps"] > 0){ // RESUMEN GPS ?>
<form action="gpsResumenNOGPS.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen gps" value="UNIDADES SIN GPS">
</form>
<?php }



?>
</nav>