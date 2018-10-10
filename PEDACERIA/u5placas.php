<!--PLACAS-->
<?php
if($_SESSION["placas"] > 0){  // APERTURA PRIVILEGIOS VE PLACAS
echo "<fieldset><legend>-</legend>";

$sql4 		= "SELECT `Placas` FROM `placa` 
				WHERE `id_unidad`= $id_unidad 
				ORDER BY `fechaAsignacion` DESC LIMIT 0, 30 ";
$res4 		= mysql_query($sql4);
@$campos4 	= mysql_num_fields($res4);
@$filas4 	= mysql_num_rows($res4);

$sql5 		= "SELECT `Placas` FROM `placa` WHERE `id_unidad`=$id_unidad ORDER BY `fechaAsignacion` DESC LIMIT 1 ";
$r5 		= mysql_query($sql5);
@$matriz5 	= mysql_fetch_array($r5);


//echo "<a>Cantidad de placas encontradas: <b>$filas4</b></a>\n";
echo "<table>\n"; // Empezar tabla
	echo "<tr>"; // Crear fila
for ($i = 0;$i < $campos4;$i++) {
	$nombrecampo4 = mysql_field_name($res4, $i);
	echo "<th>$nombrecampo4</th>";
	} 
	#echo "</tr>\n"; // Cerrar fila
while (@$row4 = mysql_fetch_assoc($res4)) 
{
	#echo "<tr>"; // Crear fila
	foreach ($row4 as $key4 => $value4) 
	{
		echo "<td>$value4&nbsp;";
		$xz = ($value4 == $matriz5['Placas'])?" Actual ":" Anterior ";
		echo $xz;
		echo "";
		if($_SESSION["placas"] > 2){
			//estadoxidEdo();
			//echo "DE $estadoEC";
			echo "<a href='u5placaseditar.php?id_unidad=".@$id_unidad."&placas=".$value4."' ><button type='button' title='Editar Placas'>Ed</button></a></td>";
		}
	} 
} 


		if($TipoBusqueda !== 'Actualizar Placas')
		{
			if($_SESSION["placas"] > 1)
			{  // APERTURA PRIVILEGIOS CREA PLACAS
				echo "<td><a href='u5placasalta.php?id_unidad=".@$id_unidad."' ><button type='button' title='Actualizar Placas'>Actualizar  Placas</button></a></td>\n";
			} // CIERRE PRIVILEGIOS CREA PLACAS
		} // &laquo; &#9997; 
echo "</tr>\n"; // Cerrar fila
echo "</table>\n"; // Cerrar tabla
echo "</fieldset>
<!--PLACAS-->";
} // CIERRE PRIVILEGIOS  VE PLACAS ?>