<?php 
if($_SESSION["consultaB"] > 0){ // ECONOMICO ?>
<form action="consultaBE.php" class="navegacion">
<input id="gobutton2" type="submit" name="xeconomicos" value="Por Economicos">
</form>
<?php }

if($_SESSION["consultaB"] > 0){ // PLACAS ?>
<form action="consultaBP.php" class="navegacion">
<input id="gobutton2" type="submit" name="xplacas" value="Por Placas">
</form>
<?php }

if($_SESSION["consultaB"] > 0){ // SERIE ?>
<form action="consultaBS.php" class="navegacion">
<input id="gobutton2" type="submit" name="xseries" value="Por Series">
</form>
<?php }


if($_SESSION["consultaB"] > 0 AND $_SESSION["compra"] > 0 ){ // SERIE ?>
<form action="consultaBFF.php" class="navegacion">
<input id="gobutton2" type="submit" name="xFoliosF" value="Por Folios de Factura de Origen">
</form>
<?php }