<?php
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>"; // LINK PARA USAR LOS ICONOS FONTAWESOME
$borrarTxtIcon = "<i class='fa fa-trash-o'  style='font-size:16px; color:gray;font-weight: ;'   alt='ELIMINAR' ></i>"; // ICONO PARA BORRAR

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