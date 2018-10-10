<?php
//CONSULTA ARCHIVOS
$sql_MSD = 'SELECT * ' 
		. ' FROM '
		. ' estimacionDocto '
		. " WHERE id_estimacion = '$id_estimacion' 
		 AND borrado = 0 
		 ORDER BY tipo ASC, fechareg DESC LIMIT 0, 250 ";
//FIN CONSULTA

$sql_MSD_R 		= mysqli_query($dbd2, $sql_MSD);
@$camposMSDR 	= mysqli_num_fields($sql_MSD_R);
@$filasMSDR 	= mysqli_num_rows($sql_MSD_R);

echo "<br>";
echo "<fieldset><legend>DOCUMENTOS DE LA ESTIMACION</legend>"; 
echo "<section><table><caption><a>Click en columna TIPO: <b>$filasMSDR</b>  </a>"; 
echo "</caption>\n"; 

echo "	<tr>
		<th>TIPO</th>
		<th>IMPORTE</th>
		<th>OBSERVACIONES DOCUMENTO</th>
		<th>FORMATO</th>
		<th>FECHA/SUBIDA</th>
		<th>QUIEN SUBIO</th>
		<th>EDITAR</th>
		<th>BORRAR</th>
		</tr>";

while($row = mysqli_fetch_assoc($sql_MSD_R))
{
	$id_docto   = $row['id_docto'];
	$m_archivo	= $row['archivo'];
	$m_tipo		= $row['tipo']; // poner descripciones segun valor
	$tipoA		= $row['tipo']; // PARA EDICION
	$borrado	= $row['borrado']; // PARA NO VALIDAR...
	$extension	= $row['extension'];
	$obsEA		= $row['obs'];
	$importeDtoEA = $row['importeDto'];
	$fechareg 	= $row['fechareg'];
	$capturo	= $row['capturo'];

	$m_ts1		= ''; // PARA EL SELECTED
	$m_ts2		= ''; // PARA EL SELECTED
	$m_ts3		= ''; // PARA EL SELECTED
	$m_ts4		= ''; // PARA EL SELECTED
	$m_ts5		= ''; // PARA EL SELECTED

	switch($m_tipo)
		{
			case "1":
				$m_tipo = 'FACTURA';
				$m_ts1 	= 'SELECTED';
				break;
			case "2":
				$m_tipo = 'ESTIMACION';
				$m_ts2 	= 'SELECTED';
				break;
			case "3":
				$m_tipo = 'OTRO';
				$m_ts3 	= 'SELECTED';
				break;
			case "4":
				$m_tipo = 'PENALIZACION';
				$m_ts4 	= 'SELECTED';
				break;
			case "5":
				$m_tipo = 'OTRO3';
				$m_ts5 	= 'SELECTED';
				break;
			default:
				;
		}

	$m_ruta		= $row['ruta'];

		echo "<tr>";
		echo "<td><a style='text-decoration:none; font-weight:bold;  
		href='https://sistema.jetvan.com.mx/exp/estima/$m_ruta/$m_archivo' target='_blank'>{$m_tipo}</a></td>";
		echo "<td>{$importeDtoEA}</td>";
		echo "<td>{$obsEA}</td>";

		echo "<td>{$extension}</td>";
		echo "<td>{$fechareg}</td>";

		$id_usuario = $capturo;
		usuarioxid($id_usuario); 
		echo "<td>{$nombre}</td>";

	$id_usuario = $_SESSION['id_usuario'];

	// CAMBIAR CLASIFICACION
   if($id_usuario == $capturo || $_SESSION["estimacionH"] > 1 )
		{ // INICIO privilegio editar
			echo "<td>
			<form action='estimacionDoctoEditar.php' method='post'>
			<input type='hidden' value='$id_docto' 		name='id_docto'>
			<input type='hidden' value='$id_estimacion' name='id_estimacion'>
			<input type='hidden' value='$id_contrato' 	name='id_contrato'>
			<input type='hidden' value='$tipoA' 		name='tipoA'>

			TIPO<select name = 'tipoN' style='font-size:10px;' >
				  <option value='1' $m_ts1 >FACTURA</option>
				  <option value='2' $m_ts2 >ESTIMACION</option>
				  <option value='3' $m_ts3 >OTRO</option>
				  <option value='4' $m_ts4 >PENALIZACION/DEDUCTIVA</option>
			</select>

		MONTO"; 
			if( $_SESSION['id_usuario'] != 103 )
			{ // reglas para cualquier usuario
				echo "
				$<input 
	 			type='number'  
	 			step='0.01' 
	 			min='0'  
	 			max='100000000'  
	 			pattern='[0-9]+([\.,][0-9]+)?' 
				name='importeDto' 
				value='$importeDtoEA' 
				style='text-align: right;' 
				required 
				>";
			}
			else
			{ // reglas para lupita mendoza
			echo "
				$<input 
	 			type='text'  
	 			name='importeDto' 
				value='$importeDtoEA' 
				style='text-align: right;' 
				required 
				>		
				";
			}

		echo "
			OBS<input type='text' value='$obsEA' 	name='obsEd'>

			<input type='submit' value='Editar' name='Editar'>
			</form>
			</td>";
		} // TERMINA privilegio editar // lang='en-150'

	// BORRAR
	if($id_usuario == $capturo || $_SESSION["estimacionH"] > 1 ) // INICIO BORRAR
		{
		echo "<td>
				<form action='estimacionDoctoBorrar.php' method='post'>
				<input type='hidden' value='$id_docto' 		name='id_docto'>
				<input type='hidden' value='$id_estimacion' name='id_estimacion'>
				<input type='hidden' value='$id_contrato' 	name='id_contrato'>
				<input type='hidden' value='$tipoA' 		name='tipoA'>
				<input type='hidden' value='$borrado' 		name='borrado'>";
		?>
				<a onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO'); " >
		<?php
		echo "		
			   <input type='submit' value='Borrar' name='borrar' title='BORRAR DOCUMENTO' >
				</a>
				</form>
			</td>";
		}// TERMINA BORRAR

		echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";
?>