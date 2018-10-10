<nav>

<?php if($_SESSION["seminuevos"] > 0){ // RESUMEN GPS ?>
<form action="semRes.php" class="navegacion"><input id="gobutton2" type="submit" name="resumen gps" value="Resumen Venta Seminuevos"></form>
<?php } ?>

<?php if($_SESSION["seminuevos"] > 0){ // DEFINIR ?>
<form action="semResTodo.php" class="navegacion"><input id="gobutton2" type="submit" name="gps alta" value="Todos los Registros"></form>
<?php } ?>

<?php if($_SESSION["seminuevos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="linea alta" value="ND"></form>
<?php } ?>

<?php if($_SESSION["seminuevos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="sim alta" value="ND"></form>
<?php } ?>

<?php if($_SESSION["seminuevos"] > 4){ // DEFINIR ?>
<form action=".php" class="navegacion"><input id="gobutton2" type="submit" name="equipo_activo_asignar" value="ND"></form>
<?php } ?>

</nav>