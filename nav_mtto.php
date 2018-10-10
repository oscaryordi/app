<?php if($_SESSION["mttos"] > 1){ // RESUMEN MTTO ?>
<form action="mttoSolRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen mantenimiento" value="Resumen Mantenimiento"></form>
<?php }

if($_SESSION["mttos"] > 1 && $_SESSION["filtroFlotilla"] < 2){ // RESUMEN MTTO ?>
<form action="mttoSolResMCtos.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen mantenimiento mis contratos" value="Cttos Mtto"
title="Todos los servicios de mis contratos" ></form>
<?php }

if($_SESSION["mttos"] > 1){ // RESUMEN MTTO ?>
<form action="mttorestacuba.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen mantenimiento" value="Resumen Tacuba"></form>
<?php }

if($_SESSION["proveedores"] > 0){ // CONSULTA PROVEEDOR ?>
<form action="provconsult.php" class="navegacion">
<input id="gobutton2" type="submit" name="consulta proveedor" value="Consultar Proveedor"></form>
<?php }

if($_SESSION["proveedores"] > 0){ // Alta DE PROVEEDOR ?>
<form action="provalta.php" class="navegacion">
<input id="gobutton2" type="submit" name="alta proveedor" value="Alta Proveedor"></form>
<?php }

if($_SESSION["mttoSolDep"] > 0){ // SUBIR DEPOSITOS ?>
<form action="mttoSolResDep.php" class="navegacion">
<input id="gobutton2" type="submit" name="Depositos" value="Depositos"></form>
<?php }

if($_SESSION["mttoSolSup"] > 0){ // SUBIR GERALDINE ?>
<form action="mttoSolResSup.php" class="navegacion">
<input id="gobutton2" type="submit" name="Supervisor" value="Supervisor"></form>
<?php }

if($_SESSION["mttoSolSup"] > 1){ // SUPERVISOR ESCOGE USUARIO ?>
<form action="mttoSolResSupX1.php" class="navegacion">
<input id="gobutton2" type="submit" name="SupervisorX1" value="SupervisorX1"></form>
<?php }

if($_SESSION["mttoSolSup"] > 2){ // SUPERVISOR VE ESTADISTICAS ?>
<form action="mttoSolEst.php" class="navegacion">
<input id="gobutton2" type="submit" name="Estadisticas" value="Estadisticas"></form>
<?php }

if($_SESSION["mttoSolAut"] > 0){ // SUPERVISOR AUTORIZA ?>
<form action="mttoSolAut.php" class="navegacion">
<input id="gobutton2" type="submit" name="autorizaciones" value="AUTORIZACIONES"></form>
<?php }

if($_SESSION["almacen"] > 0){ // CONSULTA PROVEEDOR ?>
<form action="mttoSolResSupProv.php" class="navegacion" method='get'>
<input type='hidden' name='id_prov' value='81'>
<input id="gobutton2" type="submit" name="consulta jetvan taller" value="Consultar Jet Van Taller">
</form>
<?php }


if($_SESSION["mttoSolPag"] > 0){ // SUPERVISOR PAGOS ?>
<!--
<form action="mttoSolPag.php" class="navegacion">
<input id="gobutton2" type="submit" name="pagos" value="SUPERVISOR PAGOS"></form>
-->
<?php } ?>