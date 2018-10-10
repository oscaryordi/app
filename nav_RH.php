<nav>

<?php
if($_SESSION["rh"] > 0){ // RH  ?>
<form action="RHinterno.php" class="navegacion">
<input id="gobutton2" type="submit" name="Internos" value="Internos">
</form>
<?php }

if($_SESSION["rh"] > 0){ // RH ?>
<form action="RHasociado.php" class="navegacion">
<input id="gobutton2" type="submit" name="Asociados" value="Asociados">
</form>
<?php }

if($_SESSION["rh"] > 0){ // RH ?>
<form action="RHexterno.php" class="navegacion">
<input id="gobutton2" type="submit" name="Clientes" value="Clientes">
</form>
<?php }

if($_SESSION["rh"] > 2){ // RH ?>
<form action="RHcrear.php" class="navegacion">
<input id="gobutton2" type="submit" name="crearUsuario" value="Crear Usuario">
</form>
<?php }

if($_SESSION["rh"] > 7){ // RH ?>
<form action="gpsequipoasignacion.php" class="navegacion">
<input id="gobutton2" type="submit" name="equipo_activo_asignar" value="Asignar Equipo Activo">
</form>
<?php }

if($_SESSION["rh"] > 7){ // RH ?>
<form action="gpsResumenD.php" class="navegacion">
<input id="gobutton2" type="submit" name="descargar_resumen" value="Descargar Resumen">
</form>
<?php }

if($_SESSION["rh"] > 7){ // RH ?>
<form action="gpsAlerta.php" class="navegacion">
<input id="gobutton2" type="submit" name="generar_alerta" value="Generar Alerta">
</form>
<?php } 

if($_SESSION["rh"] > 7){ // RH ?>
<form action="gpsAlertaRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen_alerta" value="Resumen Alertas">
</form>
<?php }


?>
</nav>