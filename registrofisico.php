<?php
include("1header.php");
include("nav_logistica.php");

if($_SESSION["movimientos"] > 1)
{ // VISTA A OPERADORES LOGISTICOS ENTRADA SALIDA ?>
<fieldset><legend>Registrar Entrada</legend>
<table class='ResTabla'>
	<FORM action="formato_entrada.php" method="POST">
		<tr>
			<th colspan=4 >Indique uno de los 3 siguientes datos o solo presione en Registrar Entrada para iniciar en blanco.</th>
		</tr>
		<tr>
			<td>Económico<INPUT TYPE="text" NAME="uNEco" placeholder="Pon aqui el economico" autofocus></td>
			<td>Placas<INPUT TYPE="text" NAME="uPlacas" placeholder="Aqui van las placas"></td>
			<td>Serie<INPUT   TYPE="text" NAME="uSerie" placeholder="Aqui la serie"></td>
			<td colspan=3 align=center ><INPUT id="gobutton2" TYPE="SUBMIT" NAME="ENVIAR" VALUE="Registrar Entrada"></td>
		</tr>
	</FORM>
</table>
</fieldset>
<?php 
}

if($_SESSION["movimientos"] == 1)
{ // SE HABILITA VISTA A EJECUTIVOS 
	echo "<div class='article'>";
	include("entradas_ejecutivos.php");
	echo "</div>";
}

if($_SESSION["movimientos"] >= 2)
{ // SUPERVISOR LOGISTICA 
	echo "<div class='article'>";
	include("entradas.php");
	echo "</div>";
}

if($_SESSION["movimientos"] > 1)
{ // VISTA A OPERADORES LOGISTICOS ENTRADA SALIDA ?>
<fieldset><legend>Registrar Salida</legend>
<FORM action="formato_salida.php" method="POST">
	<table class='ResTabla'>
		<tr>
			<th colspan=4 >Indique uno de los 4 siguientes datos o solo presione en Registrar Salida para iniciar en blanco.</th>
		</tr>
		<tr>
			<td>Folio Inventario<INPUT TYPE="text" NAME="numero_inventario" placeholder="Folio Inventario" autofocus></td>
			<td>Económico<INPUT TYPE="text" NAME="uNEco" placeholder="Pon aqui el economico" ></td>
			<td>Placas<INPUT TYPE="text" NAME="uPlacas" placeholder="Aqui van las placas"></td>
			<td>Serie<INPUT   TYPE="text" NAME="uSerie" placeholder="Aqui la serie"></td>
			<td colspan=3 align=center ><INPUT id="gobutton3" TYPE="SUBMIT" NAME="ENVIAR" VALUE="Registrar Salida"></td>
		</tr>
	</table>
</FORM>
<?php 
} 

if($_SESSION["movimientos"] > 2)
{ // VISTA A SUPERVISOR BRENDA ?>
<form action="registrofisico_consultas.php" class="navegacion">
	<input id="gobutton2" type="submit" name="ConsultasBitacora" value="Consultas Bitacora">
</form>
<?php 
} 
echo "</fieldset>";

if($_SESSION["movimientos"] == 1)
{ // SE HABILITA VISTA A EJECUTIVOS 
	echo "<div class='article'>";
	include("salidas_ejecutivos.php");
	echo "</div>";
} 

if($_SESSION["movimientos"] >= 2)
{ // SUPERVISOR LOGISTICA 
	echo "<div class='article'>";
	include("salidas.php");
	echo "</div>";
}
include("1footer.php");?>