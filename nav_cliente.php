<?php
?>
<style>
     .fa-trash-alt{color:gray;font-size:16px;}
     .fa-trash-alt:hover{ color:green;}
 </style>   
<?php
$borrarTxtIcon = "<i class='fas fa-trash-alt' alt='ELIMINAR' ></i>";
// ICONO PARA BORRAR

if($_SESSION["clientes"] > 0){ // RESUMEN CONTRATOS ?>
<form action="clientesresumencto.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen clientes" value="Resumen Contratos"></form>
<?php } 

if($_SESSION["clientes"] > 0){ // RESUMEN CLIENTES ?>
<form action="clientesresumen.php" class="navegacion">
<input id="gobutton2" type="submit" name="resumen clientes" value="Resumen Clientes"></form>
<?php }

if($_SESSION["clientes"] > 0){ // CONSULTA CLIENTE ?>
<form action="clienteconsulta.php" class="navegacion">
<input id="gobutton2" type="submit" name="consulta cliente" value="Consultar Cliente"></form>
<?php } 

if($_SESSION["clientes"] > 1){ // Alta DE CLIENTE ?>
<form action="clientealta.php" class="navegacion">
<input id="gobutton2" type="submit" name="alta cliente" value="Alta Cliente"></form>
<?php } ?>