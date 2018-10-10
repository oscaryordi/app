<?php
include '1header.php'; 

$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";	

include ("u4datos.php");
include ("u5placas.php");

if($_SESSION["asigna"] > 1){  // APERTURA PRIVILEGIOS 
// INICIO consulta asignacion ACTUAL
	$sql_asg = 'SELECT * '
		. ' FROM asignaUnidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY id_asignacion DESC LIMIT 100 ';
	$res_asg	= mysqli_query($dbd2, $sql_asg);
	$filas_asg  = mysqli_num_rows($res_asg);

	if($filas_asg > 0)
	{ // APERTURA ejecutar si hubo algo

		if($_SESSION["filtroFlotilla"] < 2)
		{
		echo "<fieldset><legend>ASIGNACION</legend>";
		echo "<table >\n";
		echo	"<tr>
				<th>DESDE</th>
				<th>HASTA</th>
				<th>ID_ALAN</th>
				<th>CONTRATO</th>
				<th>RFC</th>
				<th>CLIENTE</th>
				</tr>";
		}

		while($row = mysqli_fetch_assoc($res_asg))
		{
			$id_cliente  = $row['id_cliente']; 
			$id_contrato	= $row['id_contrato'];
			$fecha_final	= $row['fecha_final'];
			$fecha_inicio   = $row['fecha_inicio'];

			if($_SESSION["filtroFlotilla"] < 2)
			{
				// sacar rfc y cliente
				clientexid($id_cliente);

				// sacar numero contrato
				contratoxid($id_contrato);

				// INICIO poner renglon resultados
				echo "<tr>";
				echo "<td>{$fecha_inicio}</td>";
				echo "<td>{$fecha_final}</td>";
				echo "<td>{$id_alan}</td>";
				echo "<td>{$numero}</td>";
				echo "<td>{$rfc}</td>";
				echo "<td>{$razonSocial}</td>";

				if($_SESSION["asigna"] > 1){  // VER HISTORICO // APERTURA PRIVILEGIOS  
				echo "
					<td>
					<a href='asignaHistorico.php?id_unidad=$id_unidad' >
					<button type='button' title='Historico Asignación'>
					Historico Asignación</button></a>
					</td>";
				} // VER HISTORICO // CIERRE PRIVILEGIOS 
				echo "</tr>";
				// FIN poner renglon resultados
			}
		}
		echo "</table></fieldset>";
	} // CIERRE ejecutar si hubo algo

// BOTON PARA VOLVER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' >
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</p>";

} // CIERRE PRIVILEGIOS
include '1footer.php'; ?>