<?php if($_SESSION["gerencia"] > 0){ // SE HABILITA VISTA RESUMEN SUSTITUTOS ?>
<form action="resumen_sustitutos.php" class="navegacion"><input id="gobutton2" type="submit" name="resumen_sustitutos" value="Consultar Salidas de Sustitutos"></form>
<?php } ?>

<?php if($_SESSION["gerencia"] > 0){ // SE HABILITA VISTA DIRECTORIO RADIOS ?>
<form action="directorio_radios.php" class="navegacion"><input id="gobutton2" type="submit" name="directorio_radios" value="Directorio Radios"></form>
<?php } ?>

<?php if($_SESSION["gerencia"] > 1){ // SE HABILITA VISTA RESUMEN MOVIMIENTOS PARA CLIENTE DETERMINADO ?>
<form action="resumenes_movimientos.php" class="navegacion"><input id="gobutton2" type="submit" name="resumenes_movimientos" value="Resumen Movimientos"></form>
<?php } ?>

<?php if($_SESSION["gerencia"] > 0){ // SE HABILITA VISTA VER TODA FLOTILLA ?>
<form action="consulta_flotilla.php" class="navegacion"><input id="gobutton2" type="submit" name="consulta_flotilla" value="Ver flotilla"></form>
<?php } ?>