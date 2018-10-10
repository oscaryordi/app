<nav>

<?php
if($_SESSION["facturacionV"] > 0){ // RESUMEN facturacionV ?>
<form action="factRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="ResumenFacturacion" value="Resumen Facturación">
</form>
<?php }

if($_SESSION["facturacionV"] > 0){ // ALTA facturacionV ?>
<form action="factResEst.php" class="navegacion">
<input id="gobutton2" type="submit" name="ResumenEstimacion" value="Resumen Estimaciones">
</form>
<?php }

if($_SESSION["facturacionV"] > 0){ // ALTA LINEA ?>
<form action="factIndex.php" class="navegacion">
<input id="gobutton2" type="submit" name="FacturaFolio" value="Consultar Factura por Folio">
</form>
<?php }

if($_SESSION["facturacionV"] > 0){ // ALTA SIM ?>
<form action="factxUsuario.php" class="navegacion">
<input id="gobutton2" type="submit" name="sim alta" value="Consultar Estimaciones por Usuario">
</form>
<?php }

if($_SESSION["facturacionV"] > 7){ // ASIGNAR facturacionV ?>
<form action="facturacionVequipoasignacion.php" class="navegacion">
<input id="gobutton2" type="submit" name="equipo_activo_asignar" value="Asignar Equipo Activo">
</form>
<?php }

if($_SESSION["facturacionV"] > 7){ // ASIGNAR facturacionV ?>
<form action="facturacionVResumenD.php" class="navegacion">
<input id="gobutton2" type="submit" name="descargar_resumen" value="Descargar Resumen">
</form>
<?php }

if($_SESSION["facturacionV"] > 7){ // ASIGNAR facturacionV ?>
<form action="facturacionVAlerta.php" class="navegacion">
<input id="gobutton2" type="submit" name="generar_alerta" value="Generar Alerta">
</form>
<?php } 

if($_SESSION["facturacionV"] > 7){ // ASIGNAR facturacionV ?>
<form action="facturacionVAlertaRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen_alerta" value="Resumen Alertas">
</form>
<?php }


?>
</nav>