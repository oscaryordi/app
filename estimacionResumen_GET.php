<?php #############################################
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Estimaciones.xls");

session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php"); 
include_once ("funcion.php");

echo "<meta charset='utf-8'>";

$id_contrato = $_GET['id_contrato'];

$sql_estRes 	= "	SELECT * FROM estimacion 
					WHERE id_contrato = '$id_contrato' 
					AND borrado = 0 
					ORDER BY fechaIn DESC ";

$sql_estRes_R 	= mysqli_query($dbd2, $sql_estRes);
$cuantasFueron 	= mysqli_affected_rows($dbd2);
$montoEjercido 	= 0;



if(mysqli_num_rows($sql_estRes_R) > 0 )
{ // INICIO SI HAY RESULTADOS 

// PINTAR ENCABEZADO
	echo "<fieldset><legend>RESUMEN DE ESTIMACIONES</legend>"; 
	echo "<table id='ResTabla' >
			<tr>
				<th>FOLIO EST</th>
				<th>FECHA INICIO</th>
				<th>FECHA FINAL</th>
				<th>IMPORTE</th>

				<th>PENALIZACION</th>

				<th>IMPORTE A PAGAR</th>

				<th>OBSERVACIONES ESTIMACION</th>

				<th>FACTURA</th>
				<th>ESTIMACION</th>
				<th>PENALIZACION</th>
				<th>OTRO</th>
			</tr>";

	while($row = mysqli_fetch_assoc($sql_estRes_R))
	{

		$id_estimacion 	= $row['id_estimacion'];
		$id_cliente 	= $row['id_cliente'];
		$id_contrato 	= $row['id_contrato'];
		$mesE 			= $row['mesE'];
		$anioE 			= $row['anioE'];

		$fechaIn 		= $row['fechaIn'];
		$fechaFn 		= $row['fechaFn'];

		$montoEiI 		= $row['montoEiI'];
		$d1 			= $row['d1Factura'];
		$d2 			= $row['d2Estimacion'];
		$d3 			= $row['d3OtroSoporte'];
		$d4 			= $row['d4Penaliza'];
		$d5 			= $row['d5CompPago'];
		$obs 			= $row['obs'];
		$fechareg 		= $row['fechareg'];
		$capturo 		= $row['capturo'];
		$borrado 		= $row['borrado'];

		echo "<tr>";
		echo "<td>{$id_estimacion}</td>";
		echo "<td>{$fechaIn}</td>";
		echo "<td>{$fechaFn}</td>";

		echo "<td style='text-align:right;'>$".number_format($montoEiI, 2)."</td>";

		montoPenaxid_estima($id_estimacion);
		echo "<td>$".number_format($montoP, 2)."</td>";
		$totalPagar = $montoEiI - $montoP;
		echo "<td>$".number_format($totalPagar, 2)."</td>";
		$montoEjercido += $totalPagar;
		echo "<td>{$obs}</td>";

		// INICIO ANALIZA SI ESTA FACTURADO
		echo "<td style='text-align:center;'>";
		if($d1  > 0)
		{
			for($x = 1; $x <= $d1; $x++)
			{ 
				echo "SI,";
			}
		}
		else // SUBIR
		{
			$tipo = 1;
			echo "No,";
		} //&pagina=@$pagina
		echo "</td>";	
		// TERMINA ANALIZA SI ESTA FACTURADO

		// INICIO ESTIMACION // echo "<td>{$d2}</td>";
		echo "<td style='text-align:center;'>";
		if($d2  > 0)
		{
			for($x = 1; $x <= $d2; $x++)
			{ 
			echo "SI,";
			}
		}
		else // SUBIR
		{
			$tipo = 2;
			echo "No,";
		} //&pagina=@$pagina
		echo "</td>";
		// TERMINA ESTIMACION

		// INICIO PENALIZACION // echo "<td>{$d2}</td>";
		echo "<td style='text-align:center;'>";
		if($d4  > 0)
		{
			for($x = 1; $x <= $d4; $x++)
			{ 
				echo "SI,";
			}
		}
		else // SUBIR
		{
			$tipo = 2;
			echo "No,";
		} //&pagina=@$pagina
		echo "</td>";
		// TERMINA PENALIZACION

		// INICIO OTRO // echo "<td>{$d3}</td>";
		echo "<td style='text-align:center;'>";
		if($d3  > 0)
			{
				for($x = 1; $x <= $d3; $x++){ 
				echo "SI,";
				}
			}
		else // SUBIR
			{
				$tipo = 3;
				echo "No,";
			} //&pagina=@$pagina
				echo "</td>";
		// TERMINA OTRO
//	$id_estimacion = '';
	echo "</tr>";
	}
	echo "</table>";
	echo "MONTO EJERCIDO IVA INCLUIDO: $".number_format($montoEjercido, 2)."";
	echo "</fieldset>";
}

if( $cuantasFueron == 0)
{
	echo "<fieldset><legend>RESUMEN DE ESTIMACIONES</legend>";	
	echo "<h3>AUN NO HAY ESTIMACIONES PARA ESTE CONTRATO</h3>";
	echo "</fieldset>";
}