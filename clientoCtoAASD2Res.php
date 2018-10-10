<?php
$sql_AA = 'SELECT * '
			. ' FROM '
			. ' clbSubDiv2 '
			. " WHERE id_contrato = '$id_contrato' "
			. "	ORDER BY descripcion ASC ";
$sql_AA_R 		= mysqli_query($dbd2, $sql_AA);
$campos_ptds 	= mysqli_num_fields($sql_AA_R);
$filas_ptds 	= mysqli_num_rows($sql_AA_R);

echo "<section><p>AREAS ADMINISTRATIVAS DEL CONTRATO: <b>$filas_ptds</b>"; 
echo "</p><table class='tablasimple'>"; 
if($filas_ptds > 0)
	{
		echo "<tr>
				<th>ID_AA2</th>
				<th>DESCRIPCION</th>
				<th>nombre</th>
				<th>domicilio</th>
				<th>Flotilla</th>
				<th>SUBAREAS</th>
				<th>CAPTURO</th>
				<th>FECHA REGISTRO</th>
				<th>EDITAR</th>
			  </tr>";

	while($row = mysqli_fetch_assoc($sql_AA_R))
		{
			$id_subDiv2 	= 	$row['id_subDiv2'];
			$descripcion 	= 	$row['descripcion'];
			$nombre 		= 	$row['nombre'];
			$domicilio 		= 	$row['domicilio'];
			$capturo 		= 	$row['capturo'];
			$fechareg 		= 	$row['fechareg'];

			echo "<tr>";
			echo "<td>{$id_subDiv2}</td>";
			echo "<td>{$descripcion}</td>";
			echo "<td>{$nombre}</td>";
			echo "<td>{$domicilio}</td>";

			unidades_id_subDiv2_id($id_subDiv2);
			echo "<td>{$unidadesDiv2}</td>";

			areasDeSubDiv2($id_subDiv2);
			echo "<td><a href='clienteCtoAA_SD3.php?id_subDiv2=$id_subDiv2&id_contrato=$id_contrato' 
						 title='Ver Subáreas'>
						 {$tieneSubDiv3}</a></td>";
						 
			echo "<td>{$capturo}</td>";
			echo "<td>{$fechareg}</td>";

			// INICIO EDITAR INFORMACION LA PARTIDA
			if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 )
			{ // APERTURA PRIVILEGIOS	
				echo 	"<td>
						<FORM action='clienteCtoAAEditar.php' method='POST' id='entabla'>
							<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
							<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
							<INPUT TYPE='hidden' NAME='id_subDiv2' VALUE='$id_subDiv2'>
							<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
						</FORM>
						</td>";
			} // CIERRE PRIVILEGIOS
			// TERMINA EDITAR INFORMACION LA PARTIDA	

			// INICIO EDITAR INFORMACION LA PARTIDA
			if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 )
			{ // APERTURA PRIVILEGIOS	
				echo 	"<td>
						<FORM action='clienteCtoAA_SD3_Alta.php' method='POST' id='entabla'>
							<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
							<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
							<INPUT TYPE='hidden' NAME='id_subDiv2' VALUE='$id_subDiv2'>
							<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Crear Subárea'>
						</FORM>
						</td>";
			} // CIERRE PRIVILEGIOS
			// TERMINA EDITAR INFORMACION LA PARTIDA
			echo "</tr>";
		}
	}
echo "</table></section>"; // Cerrar tabla