<nav >

<form action="index.php" class="navegacion"><input id="gobutton2" type="submit" name="enviar" value="Inicio"></form>

<form action="presentacion.php" class="navegacion"><input id="gobutton2" type="submit" name="enviar" value="Presentación"></form>

<?php if($_SESSION["gerencia"] > 0){ // GERENCIA SE HABILITA VISTA GERENCIA ?>
<form action="gerencia.php" class="navegacion"><input id="gobutton2" type="submit" name="gerencia" value="GERENCIA"></form>
<?php }

if($_SESSION["datos"] > 1){ // ALTA UNIDAD SE HABILITA VISTA A SUPERVISOR COMPRAS BLANCA ?>
<form action="alta_unidades.php" class="navegacion"><input id="gobutton2" type="submit" name="alta_unidades" value="Alta Unidades"></form>
<?php }

if($_SESSION["movimientos"] > 0){ // LOGISTICA SE HABILITA VISTA A EJECUTIVOS ?>
<form action="registrofisico.php" class="navegacion"><input id="gobutton2" type="submit" name="registrofisico" value="Registro Entrada / Salida"></form>
<?php }

if($_SESSION["sustituto"] > 0){ // SUSTITUTO SE HABILITA VISTA A EJECUTIVOS ?>
<form action="sustitutoindice.php" class="navegacion"><input id="gobutton2" type="submit" name="autosustituto" value="Sustitutos"></form>
<?php }

if($_SESSION["mttos"] > 1 || $_SESSION["mttoSolSup"] > 0){ // MANTENIMIENTO SE HABILITA VISTA A EJECUTIVOS ?>
<form action="mttoindex.php" class="navegacion"><input id="gobutton2" type="submit" name="mantenimiento" value="Mantenimiento"></form>
<?php }

if($_SESSION["clientes"] > 0){ // CLIENTES SE HABILITA VISTA A Gerencia Ventas Gobierno ?>
<form action="clienteindex.php" class="navegacion"><input id="gobutton2" type="submit" name="clientes" value="Clientes"></form>
<?php }

if($_SESSION["asigna"] > 1 OR $_SESSION["asigcto"]){ // UNIDAD SE HABILITA VISTA A Gerencia Ventas  ?>
<form action="asignaindex.php" class="navegacion"><input id="gobutton2" type="submit" name="asigna" value="Asignación"></form>
<?php }

if($_SESSION["gps"] > 0){ // UNIDAD SE HABILITA VISTA A C4   ?>
<form action="gpsindex.php" class="navegacion"><input id="gobutton2" type="submit" name="gps" value="GPS"></form>
<?php }

if($_SESSION["documentos"] > 2){ // UNIDAD SE HABILITA VISTA A CONTROL VEHICULAR Y DOCUMENTOS  ?>
<form action="docindex.php" class="navegacion"><input id="gobutton2" type="submit" name="gps" value="Documentos"></form>
<?php }

tienecontrato($_SESSION["id_usuario"]);
if($miflotilla > 0){ // VISTA DE FLOTILLAS A EJECUTIVO ?>
<form action="flotillaindex.php" class="navegacion"><input id="gobutton2" type="submit" name="gps" value="Mi flotilla"></form>
<?php }

if($_SESSION["seminuevos"] > 0){ // UNIDAD SE HABILITA VISTA A SEMINUEVOS ?>
<form action="semindex.php" class="navegacion"><input id="gobutton2" type="submit" name="seminuevos" value="Seminuevos"></form>
<?php }

if($_SESSION["siniestro"] > 0){ // UNIDAD SE HABILITA VISTA A SEGUROS ?>
<form action="sinindex.php" class="navegacion">
<input id="gobutton2" type="submit" name="siniestro" value="Siniestros"  ></form>
<?php } //style='background-color: red;'

if($_SESSION["movForaneo"] > 0){ // UNIDAD SE HABILITA VISTA A LOGISTICA  ?>
<form action="movindex.php" class="navegacion"><input id="gobutton2" type="submit" name="
Traslados" value="Traslados"></form>
<?php }


if($_SESSION["externo"] == 0){ // UNIDAD SE HABILITA VISTA A LOGISTICA  ?>
<a href='soporteTecnico.php' target='blank' style='text-decoration: none;' ><input id="gobutton2" type="submit" name="
soporte" value="Soporte"></a>
<?php }


if($_SESSION["datos"] > 0){ // UNIDAD SE HABILITA VISTA A EJECUTIVOS  ?>
<form action="u1consulta.php" class="navegacion"><input id="gobutton2" type="submit" name="idunidad" value="Consultar Otro"></form>
<?php } 


if($_SESSION["mttoSolPag"] > 0){ // UNIDAD SE HABILITA VISTA A EJECUTIVOS  ?>
<form action="pagosindex.php" class="navegacion"><input id="gobutton2" type="submit" name="idunidad" value="Pagos"></form>
<?php } ?>


<form action="salir.php" class="navegacion" id="salir"><input id="gobutton2" type="submit" name="salir" value="Salir" ></form>	
</nav>