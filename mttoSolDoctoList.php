<?php
echo "<fieldset><legend>DOCUMENTOS DE LA SOLICITUD</legend>";


if(  $_SESSION['mttoSolSup']  > 2){
$sql_MSD = 'SELECT * ' 
		. ' FROM'
		. ' mttoDocto '
		. " WHERE id_mttoSol = '$id_mttoSol' "
//		." AND borrado = 0  "
		. " ORDER BY tipo ASC, fechareg DESC LIMIT 0, 50 "; 
}
else{	
//CONSULTA ARCHIVOS
$sql_MSD = 'SELECT *  ' 
		. ' FROM'
		. ' mttoDocto '
		 . " WHERE id_mttoSol = '$id_mttoSol' 
		 AND borrado = 0 
		 ORDER BY tipo ASC, fechareg DESC LIMIT 0, 50 ";
//FIN CONSULTA
}

// fechareg es HORA DEL SERVIDOR

$sql_MSD_R 		= mysqli_query($dbd2, $sql_MSD);
@$camposMSDR 	= mysqli_num_fields($sql_MSD_R);
@$filasMSDR 	= mysqli_num_rows($sql_MSD_R);

echo "\n";
echo "<section><table><caption><a>Click en archivo: <b>$filasMSDR</b>  </a>"; 
echo "</caption>\n"; 

echo "<tr>
<th>TIPO</th>
<th>EDITAR CLASIFICACION</th>
<th>BORRAR</th>
</tr>";

while($row = mysqli_fetch_assoc($sql_MSD_R))
{
	$id_docto   = $row['id_docto'];
	$m_archivo	= $row['archivo'];	
	$m_tipo		= $row['tipo']; // poner descripciones segun valor
	$tipoA		= $row['tipo']; // PARA EDICION
	$borrado	= $row['borrado'];	

	$fechareg	= $row['fechareg'];
	
	$capturo	= $row['id_capturo']; 

	$m_ts1		= ''; // PARA EL SELECTED
	$m_ts2		= ''; // PARA EL SELECTED
	$m_ts3		= ''; // PARA EL SELECTED
	$m_ts4		= ''; // PARA EL SELECTED
	$m_ts5		= ''; // PARA EL SELECTED

	switch($m_tipo)
		{
			case "1":
				$m_tipo = 'COTIZACION';
				$m_ts1 	= 'SELECTED';
				break;
			case "2":
				$m_tipo = 'DEPOSITO';
				$m_ts2 	= 'SELECTED';
				break;
			case "3":
				$m_tipo = 'FACTURA';
				$m_ts3 	= 'SELECTED';
				break;
			case "4":
				$m_tipo = 'FOTO';
				$m_ts4 	= 'SELECTED';
				break;
			case "5":
				$m_tipo = 'EMAIL';
				$m_ts5 	= 'SELECTED';
				break;
			default:
				;
		}

	$m_ruta		= $row['ruta'];

		echo "<tr>";
		echo "<td><a style='text-decoration:none; font-weight:bold; ' 
		href='https://sistema.jetvan.com.mx/exp/mtto/$m_ruta/$m_archivo' target='_blank'>{$m_tipo}</a></td>";

	$id_usuario = $_SESSION['id_usuario'];

	// CAMBIAR CLASIFICACION
   if($id_usuario == $capturo || $_SESSION["mttoSolSup"] > 0 )
	{ // INICIO privilegio editar
			echo "<td>
			<form action='mttoSolDoctoEditar.php' method='post'>
			<input type='hidden' value='$id_docto' 		name='id_docto'>
			<input type='hidden' value='$id_mttoSol' 	name='id_mttoSol'>
			<input type='hidden' value='$tipoA' 		name='tipoA'>

			<select name = 'tipoN' style='font-size:10px;' >
				  <option value='1' $m_ts1 >COTIZACION</option>
				  <option value='2' $m_ts2 >DEPOSITO</option>
				  <option value='3' $m_ts3 >FACTURA</option>
				  <option value='4' $m_ts4 >FOTO</option>
				  <option value='5' $m_ts5 >MAIL</option>
			</select>
			<input type='submit' value='Editar' name='Editar'>
			</form>
			</td>";
	} // TERMINA privilegio editar

	// BORRAR
	if($id_usuario == $capturo || $_SESSION["mttoSolSup"] > 0 AND $borrado == 0) // INICIO BORRAR
	{
		echo "<td>
				<form action='mttoSolDoctoBorrar.php' method='post'>
				<input type='hidden' value='$id_docto' 		name='id_docto'>
				<input type='hidden' value='$id_mttoSol' 	name='id_mttoSol'>
				<input type='hidden' value='$tipoA' 		name='tipoA'>";
		?>
				<a onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO'); " >
		<?php
		echo "		
			   <input type='submit' value='Borrar' name='borrar' title='BORRAR DOCUMENTO' >
				</a>
				</form>
			</td>";
	}	   // TERMINA privilegio borrar
	elseif($borrado == 1)
	{
		echo "<td>BORRADO</td>";
	}
	else
	{
		echo "<td></td>";
	}	


	if($_SESSION["mttoSolSup"] > 2)
	{
		echo "<td>$fechareg HS</td>";
	}

		echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";
?>