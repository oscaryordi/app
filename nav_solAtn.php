<nav>

<?php
if($_SESSION["solAtn"] > 0){ // RESUMEN GPS ?>
<form action="solAtnRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="SolAtn" value="Resumen de Solicitudes">
</form>
<?php }


if($_SESSION["solAtn"] > 0){ // RESUMEN GPS ?>
<form action="solAtnRPendiente.php" class="navegacion">
<input id="gobutton2" type="submit" name="SolAtn" value="Pendientes">
</form>
<?php }


if($_SESSION["solAtn"] > 0){ // RESUMEN GPS ?>
<form action="solAtnRAtendido.php" class="navegacion">
<input id="gobutton2" type="submit" name="SolAtn" value="Programadas">
</form>
<?php }


if($_SESSION["solAtn"] > 0){ // RESUMEN GPS ?>
<form action="solAtnRPropias.php" class="navegacion">
<input id="gobutton2" type="submit" name="SolAtn" value="Propias">
</form>
<?php }




?>

</nav>