<nav>

<?php if($_SESSION["documentos"] > 2){ // RESUMEN GPS ?>
<form action="docresumenerr.php" class="navegacion"><input id="gobutton2" type="submit" name="resumen gps" value="Resumen Errores Reportados"></form>
<?php } ?>

<?php if($_SESSION["documentos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="gps alta" value="ND"></form>
<?php } ?>

<?php if($_SESSION["documentos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="linea alta" value="ND"></form>
<?php } ?>

<?php if($_SESSION["documentos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="sim alta" value="ND"></form>
<?php } ?>

<?php if($_SESSION["documentos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="equipo_activo_asignar" value="ND"></form>
<?php } ?>

</nav>