<hr>

<?php if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movTrasladoR.php" class="navegacion">
<input id="gobutton2" type="submit" name="RegistrarTraslado" value="Registrar Traslado"></form>
<?php }

if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movResTodo.php" class="navegacion">
<input id="gobutton2" type="submit" name="ConsultarTraslado" value="Consultar Traslado"></form>
<?php }

if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movindex.php" class="navegacion">
<input id="gobutton2" type="submit" name="ConsultarFolio" value="Consultar por FOLIO"></form>
<?php }





if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="movResProv.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumenProveedor " value="Resumen por Proveedor"></form>
<?php } 

if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="movResClt.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumenCliente" value="Resumen por Cliente"></form>
<?php }

if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="movResFL.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumenFactura" value="Listado Factura"></form>
<?php }

if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="movResFls.php" class="navegacion">
<input id="gobutton2" type="submit" name="Falsos" value="Falsos"></form>
<?php } 

if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="mttoSolResSup.php" class="navegacion">
<input id="gobutton2" type="submit" name="Supervisor" value="Supervisor"></form>
<?php }

if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="mttoSolResSupX1.php" class="navegacion">
<input id="gobutton2" type="submit" name="SupervisorX1" value="SupervisorX1"></form>
<?php }

if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="mttoSolEst.php" class="navegacion">
<input id="gobutton2" type="submit" name="Estadisticas" value="Estadisticas"></form>
<?php } 

echo "<br>";
?>