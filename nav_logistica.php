<?php
if($_SESSION["movimientos"] > 0){ // LOGISTICA SE HABILITA VISTA A EJECUTIVOS ?>
<form action="registrofisico.php" class="navegacion">
	<input id="gobutton2" type="submit" name="registrofisico" value="Inicio Registro"></form>
<?php }


if($_SESSION["superLog"] > 0){ // SE HABILITA VISTA RESUMEN MOVIMIENTOS PARA CLIENTE DETERMINADO ?>
	<form action="resumenes_movimientos.php" class="navegacion">
		<input id="gobutton2" type="submit" name="resumenes_movimientos" 
		value="Filtrar Movimientos" title="Sirve para consultar movimientos de un PROYECTO">
	</form>
<?php } 

if($_SESSION["superLog"] > 0)
{ // SE HABILITA VISTA RESUMEN MOVIMIENTOS PARA CLIENTE DETERMINADO ?>
	<form action="logESres.php" class="navegacion">
		<input id="gobutton2" type="submit" name="resumenes_Entradas_Salidas" 
		value="Descargar Bitácora" title="Descargar toda la bitacora de entradas y salidas">
	</form>
<?php
}

if($_SESSION["movimientos"] > 2)
{ // SE HABILITA VISTA RESUMEN MOVIMIENTOS PARA CLIENTE DETERMINADO ?>
	<form action="ubicacionBloque.php" class="navegacion">
		<input id="gobutton2" type="submit" name="ActualizarUbicacionBloque" 
		value="Ubicación Bloque" title="Actualizar ubicación en bloque">
	</form>
<?php
}


if($_SESSION["movimientos"] > 2)
{ // VISTA A SUPERVISOR BRENDA ?>
<form action="registrofisico_consultas.php" class="navegacion">
	<input id="gobutton2" type="submit" name="ConsultasBitacora" value="Consultas Bitacora">
</form>
<?php 
}


if($_SESSION["movimientos"] > 2){ // SE HABILITA VISTA A SUPERVISOR BRENDA OMAR ?>
<form action="paginacion_salidas.php" class="navegacion"><input id="gobutton2" type="submit" name="salidaspaginacion" value="Ver todas las Salidas"></form>
<?php 
}

if($_SESSION["movimientos"] > 2){ // SE HABILITA VISTA A SUPERVISOR BRENDA OMAR ?>
<form action="paginacion_entradas.php" class="navegacion"><input id="gobutton2" type="submit" name="entradaspaginacion" value="Ver todas las Entradas"></form>
<?php 
}  