<?php
include("1header.php");
include("nav_logistica.php");

if($_SESSION["movimientos"] > 2){  // APERTURA PRIVILEGIOS 

@$uPlacas 	= mysqli_real_escape_string($dbd2, ($_POST['uPlacas']));
@$uNEco 	= limpiarVariable($_POST['uNEco']);
@$uSerie 	= limpiarVariable($_POST['uSerie']);

if(isset($_POST['Movimientos'])){ // SI EL FORMULARIO SE LLENO PROCEDE CONSULTA

// OBTENER ID EN LA TABLA

	if(isset($uPlacas) && $uPlacas !== '')
	{
		idxplaca($uPlacas);
	}
	elseif(isset($uNEco) && $uNEco !== '')
	{
		idxeconomico($uNEco);
	}
	elseif(isset($uSerie) && $uSerie !== '')
	{
		idxserie($uSerie);
	}


// ASIGNAR A VARIABLE QUE SE CONSULTARA
	datosxid($id_unidad);

echo 	"  <p> Id en Bd: <b>".$id_unidad
		."</b>, Economico: <b>".$Economico
		."</b>, Placas: <b>".$Placas
		."</b>, Serie: <b>".$Serie
		."</b>, Tipo: <b>".$Vehiculo
		."</b>, Modelo: <b>".$Modelo."</b></p><br />";

ubicacionHistoricoM($id_unidad);


@$camposuh 	= mysqli_num_fields($resultadouhf); // OBTENER CAMPOS
@$filasuh 	= mysqli_num_rows($resultadouhf); // OBTENER FILAS

echo "<fieldset><legend>Folios Formato Inventario</legend>";
echo "<section><table><caption>Inventario encontrados: <b>$filasuh</b></caption>"; 
echo "<tr>
		<th>FECHA</th>
		<th>PROYECTO</th>
		<th>UBICACION</th>
		<th>INVENTARIO</th>
	  </tr>";

while($row = mysqli_fetch_assoc($resultadouhf))
{
	$u_fecha 		= $row['fecha'];
	$u_proyecto 	= $row['proyecto'];
	$u_ubicacion 	= $row['ubicacion'];
	$u_inventario 	= $row['NroInventario'];
	$u_id 			= $row['id'];
	$fuente 		= $row['fuente'];
	
	echo "<tr>";
		echo "<td>{$u_fecha}</td>";
		echo "<td>{$u_proyecto}</td>";
		echo "<td>{$u_ubicacion}</td>";	

		if($fuente == 3){
			echo "<td><a href='formato_vista_id.php?id_inventario=".$u_id."'>Inventario {$u_inventario}</a></td>";
		}
		elseif($fuente == 4){
			echo "<td><a href='movVerxId.php?id_movFor=".$u_id."&pagina=0'>Traslado {$u_inventario}</a></td>";
		}
		else
		{
			echo "<td>Sin documento</td>";
		}
	echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";


}


?>
<h2>CONSULTAS A BITACORA DE ENTRADAS Y SALIDAS</h2>
<fieldset><legend>Consultar Unidad</legend>
<table>
	<FORM action="" method="POST">
		<tr>
			<th colspan=4 >Indique uno de los 3 siguientes datos.</th>
		</tr>
		<tr>
			<td>Económico 	<INPUT TYPE="text" NAME="uNEco" placeholder="Pon aqui el economico"></td>
			<td>Placas 		<INPUT TYPE="text" NAME="uPlacas" placeholder="Aqui van las placas" autofocus></td>
			<td>Serie 		<INPUT TYPE="text" NAME="uSerie" placeholder="Aqui la serie"></td>
			<td colspan=3 align=center >
				<INPUT id="gobutton2" TYPE="SUBMIT" NAME="Movimientos" VALUE="Ver movimientos">
			</td>
		</tr>		
	</FORM>
</table>
</fieldset> 
<?php 



echo "<p>";
if($_SESSION["movimientos"] > 2){ // SE HABILITA VISTA A SUPERVISOR BRENDA OMAR ?>
<form action="paginacion_salidas.php" class="navegacion"><input id="gobutton2" type="submit" name="salidaspaginacion" value="Ver todas las Salidas"></form>
<?php 
}



if($_SESSION["movimientos"] > 2){ // SE HABILITA VISTA A SUPERVISOR BRENDA OMAR ?>
<form action="paginacion_entradas.php" class="navegacion"><input id="gobutton2" type="submit" name="entradaspaginacion" value="Ver todas las Entradas"></form>
<?php 
} 
echo "</p>";

} // CIERRE PRIVILEGIOS
include("1footer.php");?>