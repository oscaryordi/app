<div style='display:block; margin: 5px;'>
<hr>

<?php if($_SESSION["mttoSolAut"] > 0){ // SUPERVISOR PENDIENTE AUTORIZAR ?>
<form action="mttoSolAutSR.php" class="navegacion"><input id="gobutton2" type="submit" name="Sin_Revisar" value="En Revisión"></form>
<?php } ?>

<?php if($_SESSION["mttoSolAut"] > 0){ // SUPERVISOR SOLO AUTORIZADO ?>
<form action="mttoSolAutRA.php" class="navegacion"><input id="gobutton2" type="submit" name="Autorizado" value="Autorizado"></form>
<?php } ?>

<?php if($_SESSION["mttoSolAut"] > 0){ // SUPERVISOR TODO AUTORIZAR ?>
<form action="mttoSolAutRC.php" class="navegacion"><input id="gobutton2" type="submit" name="A_Corregir" value="A Corregir"></form>
<?php } ?>



<?php if($_SESSION["mttoSolAut"] > 0){ // SUPERVISOR PENDIENTE AUTORIZAR ?>
<form action="mttoSolAutSRBloque.php" class="navegacion"><input id="gobutton2" type="submit" name="Bloque" value="A en Bloque"></form>
<?php } ?>




<hr>
</div>