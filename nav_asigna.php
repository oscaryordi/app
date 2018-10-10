<?php
if($_SESSION["asigcto"] > 1){ // RESUMEN CONTRATOS ?>
<form action="asignaejecutivoresumen.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen clientes" value="Resumen Contratos Asignados"></form>
<?php } 

if($_SESSION["asigna"] > 1){ // ASIGNA UNIDAD ?>
<form action="asignaunidad.php" class="navegacion">
<input id="gobutton2" type="submit" name="consulta cliente" value="Asignar Unidad"></form>
<?php } 

if($_SESSION["asigna"] > 3){ // ASIGNA UNIDAD ?>
<form action="asignaBloque.php" class="navegacion">
<input id="gobutton2" type="submit" name="ASIGNA BLOQUE" value="Asignar Unidad BLOQUE"></form>
<?php }

if($_SESSION["asigcto"] > 1){ // ASIGNA CONTRATO ?>
<form action="asignaejecutivo.php" class="navegacion">
<input id="gobutton2" type="submit" name="alta cliente" value="Asignar Ejecutivo"></form>
<?php } 

if($_SESSION["asigEctoSup"] > 0){ // ASIGNA CONTRATO ?>
<form action="asignaEcons.php" class="navegacion">
<input id="gobutton2" type="submit" name="consultaEjecutivo" value="Consultar Ejecutivo"></form>
<?php }

if($_SESSION["asigEctoSup"] > 0){ // ASIGNA CONTRATO ?>
<form action="asignaEXcons.php" class="navegacion">
<input id="gobutton2" type="submit" name="consultaEjecutivo" value="Consultar Externos"></form>
<?php } ?>
