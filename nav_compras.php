<?php
##### ##### ##### ##### NAVEGACION FLOTILLA COMPRAS
echo "<hr>";
if($_SESSION["datos"] > 1){ // SE HABILITA VISTA RESUMEN A SUPERVISOR COMPRAS BLANCA ?>
<form action="alta_unidades.php" class="navegacion">
	<input id="gobutton2" type="submit" name="alta_unidades" value="Alta Unidad Vehicular">
</form>
<?php }


if($_SESSION["datos"] > 1){ // SE HABILITA VISTA RESUMEN A SUPERVISOR COMPRAS BLANCA ?>
<form action="consulta_flotilla.php" class="navegacion">
	<input id="gobutton2" type="submit" name="consulta_flotilla" value="Consultar Flotilla">
</form>
<?php }


if($_SESSION["datos"] > 1){ // SE HABILITA VISTA RESUMEN A SUPERVISOR COMPRAS BLANCA ?>
<form action="comprasOrdenes.php" class="navegacion">
	<input id="gobutton2" type="submit" name="ordenes_compra" value="Ordenes de Compra">
</form>
<?php }
##### ##### ##### ##### NAVEGACION FLOTILLA COMPRAS.
?>