<?php
$sql_AA = 	  ' SELECT * '
			. ' FROM '
			. ' clbSubDiv3 '
			. " WHERE id_subDiv2 = '$id_subDiv2' "
			. "	ORDER BY descripcion ASC ";
$sql_AA_R 		= mysqli_query($dbd2, $sql_AA);
$campos_ptds 	= mysqli_num_fields($sql_AA_R);
$filas_ptds 	= mysqli_num_rows($sql_AA_R);

echo "<section><p>SUBAREAS ADMINISTRATIVAS $subDiv2Desc, DEL  CONTRATO <b>$id_alan</b>, CANTIDAD: $filas_ptds"; 
echo "</p><table class='ResTabla'>"; 
if($filas_ptds > 0)
	{
		echo "<tr>
				<th>ID_SD3</th>
				<th>DESCRIPCION</th>
				<th>CAPTURO</th>
				<th>FECHA REGISTRO</th>
				<th>EDITAR</th>
			  </tr>";

	while($row = mysqli_fetch_assoc($sql_AA_R))
		{
			$id_subDiv3 	= 	$row['id_subDiv3'];
			$descripcion 	= 	$row['descripcion'];
			$capturo 		= 	$row['capturo'];
			$fechareg 		= 	$row['fechareg'];

			echo "<tr>";
			echo "<td>{$id_subDiv3}</td>";
			echo "<td>{$descripcion}</td>";
			echo "<td>{$capturo}</td>";
			echo "<td>{$fechareg}</td>";

			// INICIO EDITAR INFORMACION LA PARTIDA
			if(($_SESSION["verAAdvas"] > 0 AND $tieneEsteContrato == 1) OR  $_SESSION["clientes"] > 1 )
			{ // APERTURA PRIVILEGIOS	
				echo 	"<td>
						<FORM action='clienteCtoAA_SD3_Editar.php' method='POST' id='entabla'>
							<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
							<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
							<INPUT TYPE='hidden' NAME='id_subDiv2' VALUE='$id_subDiv2'>
							<INPUT TYPE='hidden' NAME='id_subDiv3' VALUE='$id_subDiv3'>
							<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
						</FORM>
						</td>";
			} // CIERRE PRIVILEGIOS
			// TERMINA EDITAR INFORMACION LA PARTIDA	
			echo "</tr>";
		}
	}
echo "</table></section>"; // Cerrar tabla