<hr>
<?php if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movResTodo.php" class="navegacion"><input id="gobutton2" type="submit" name="resumenTraslados" value="Todos los Traslados"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movResProv.php" class="navegacion"><input id="gobutton2" type="submit" name="resumenProveedor " value="Resumen por Proveedor"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movResClt.php" class="navegacion"><input id="gobutton2" type="submit" name="resumenCliente" value="Resumen por Cliente"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movResFL.php" class="navegacion"><input id="gobutton2" type="submit" name="resumenFactura" value="Listado Factura"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 0){ // RESUMEN MTTO ?>
<form action="movResFls.php" class="navegacion"><input id="gobutton2" type="submit" name="Falsos" value="Falsos"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="mttoSolResSup.php" class="navegacion"><input id="gobutton2" type="submit" name="Supervisor" value="Supervisor"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="mttoSolResSupX1.php" class="navegacion"><input id="gobutton2" type="submit" name="SupervisorX1" value="SupervisorX1"></form>
<?php } ?>

<?php if($_SESSION["movForaneo"] > 7){ // RESUMEN MTTO ?>
<form action="mttoSolEst.php" class="navegacion"><input id="gobutton2" type="submit" name="Estadisticas" value="Estadisticas"></form>
<?php } ?>