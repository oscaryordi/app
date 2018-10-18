<nav>

<?php
if($_SESSION["callcenterH"] > 0){ // RESUMEN GPS ?>
<form action="callcenterRes.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen callcenter" value="Resumen Call Center">
</form>
<?php }

if($_SESSION["callcenterH"] > 10){ // ALTA GPS ?>
<form action="gpsequipoalta.php" class="navegacion">
<input id="gobutton2" type="submit" name="gps alta" value="Alta GPS">
</form>
<?php }

if($_SESSION["callcenterH"] > 10){ // ALTA LINEA ?>
<form action="gpslineaalta.php" class="navegacion">
<input id="gobutton2" type="submit" name="linea alta" value="Alta línea">
</form>
<?php }


?>
</nav>