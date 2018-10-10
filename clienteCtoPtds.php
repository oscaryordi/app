<!--PARTIDAS DEL CONTRATO-->
<?php
$sql_ptds = 'SELECT * '
			. ' FROM '
			. ' ctoPartidas '
			. " WHERE id_cliente = '$id_cliente'  
				AND id_contrato = '$id_contrato' 
				ORDER BY clasif ASC, descripcion ASC ";		

$sql_ptds_R 	= mysqli_query($dbd2, $sql_ptds);
$campos_ptds 	= mysqli_num_fields($sql_ptds_R);
$filas_ptds 	= mysqli_num_rows($sql_ptds_R);


echo "<section><p>PARTIDAS DEL CONTRATO: <b>$filas_ptds</b>"; 

if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS
	echo " <a href='clienteCtoPtdsAlta.php?id_cliente=$id_cliente&id_contrato=$id_contrato'>
	<button>Nueva Partida</button></a>";
	} // CIERRE PRIVILEGIOS 

echo "</p><table class='tablasimple'>"; 
if($filas_ptds > 0)
{
		echo "
		<tr>
			<th>CLASIFICACION</th>
			<th>DESCRIPCION</th>

			<th>MARCAS</th>
			<th>MODELOS</th>
			<th>CILINDROS</th>

			<th>PRECIO DIARIO</th>
			<th></th>
			<th>PRECIO MENSUAL</th>
			<th></th>
			<th>MONTO MINIMO</th>
			<th>MONTO MAXIMO</th>

			<th>UNIDADES MINIMO</th>
			<th>UNIDADES MAXIMO</th>
		</tr>";

	while($row = mysqli_fetch_assoc($sql_ptds_R))
	{
		$id_partida 	= 	$row['id_partida'];
		$clasif 		= 	$row['clasif'];
		$descripcion 	= 	$row['descripcion'];

		$modelos 		= 	$row['modelos'];
		$marcas 		= 	$row['marcas'];
		$cilindros 		= 	$row['cilindros'];

		$precioD 		= 	$row['precioD'];
		$calculoPD 		= 	$row['calculoPD'];
		$precioM 		= 	$row['precioM'];
		$calculoPM 		= 	$row['calculoPM'];
		$minimoP 		= 	$row['minimoP'];
		$maximoP 		= 	$row['maximoP'];

		$minU 			= 	$row['minU'];
		$maxU 			= 	$row['maxU'];

		$precioD = number_format($precioD,2);
		$precioM = number_format($precioM,2);

		$minimoP = number_format($minimoP,2);
		$maximoP = number_format($maximoP,2);

		echo "<tr>";
		echo "<td>{$clasif}</td>";
		echo "<td>{$descripcion}</td>";

		echo "<td>{$marcas}</td>";
		echo "<td>{$modelos}</td>";
		echo "<td>{$cilindros}</td>";

		echo "<td>{$precioD}</td>";
		$calculoPDtxt = ($calculoPD == 1)?'R':'';
		$calculoPDtxt = ($calculoPD == 2)?'C':$calculoPDtxt;
		echo "<td>{$calculoPDtxt}</td>";
		echo "<td>{$precioM}</td>";
		$calculoPMtxt = ($calculoPM == 1)?'R':'';
		$calculoPMtxt = ($calculoPM == 2)?'C':$calculoPMtxt;
		echo "<td>{$calculoPMtxt}</td>";
		echo "<td>{$minimoP}</td>";
		echo "<td>{$maximoP}</td>";

		echo "<td>{$minU}</td>";
		echo "<td>{$maxU}</td>";

		// INICIO EDITAR INFORMACION LA PARTIDA
		if($_SESSION["clientes"] > 1)
		{ // APERTURA PRIVILEGIOS	
			echo 	"<td>
					<FORM action='clienteCtoPtdsEditar.php' method='POST' id='entabla'>
						<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
						<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
						<INPUT TYPE='hidden' NAME='id_partida' VALUE='$id_partida'>
						<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
					</FORM>
					</td>";
		} // CIERRE PRIVILEGIOS	  		
		// TERMINA EDITAR INFORMACION LA PARTIDA	
		echo "</tr>";
	}
}
echo "</table></section>"; // Cerrar tabla
?>
<!--PARITDAS DEL CONTRATO-->