<div style='display:block; margin: 5px;'>
<hr>
<?php if($_SESSION["mttoSolSup"] > 2){ // SUPERVISOR VE ESTADISTICAS ?>
<form action="mttoSolEstU.php" class="navegacion"><input id="gobutton2" type="submit" name="Usuarios" value="E:Usuarios"></form>
<?php } ?>

<?php if($_SESSION["mttoSolSup"] > 2){ // SUPERVISOR VE ESTADISTICAS ?>
<form action="mttoSolEstC.php" class="navegacion"><input id="gobutton2" type="submit" name="Clientes" value="E:Clientes"></form>
<?php } ?>

<?php if($_SESSION["mttoSolSup"] > 2){ // SUPERVISOR VE ESTADISTICAS ?>
<form action="mttoSolEstP.php" class="navegacion"><input id="gobutton2" type="submit" name="Proveedores" value="E:Proveedores"></form>
<?php } ?>
<hr>
</div>