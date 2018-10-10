<?php
	echo "<hr>";
	echo "TABLERO DE CONTROL";
	echo "<table  class='tablasimple'>";

	//<tr><th></th><td></td><tr>

	##### FACTURADO CONTRATO
	estimacionesDelContrato($id_contrato);
	if(sizeof($estimacionesArray)>0) 
	{
		$todasFacturas='';
		$cuantasF 	= sizeof($estimacionesArray);
		$contador 	= 1;
		foreach( $estimacionesArray as $key => $value)
		{
			$todasFacturas.=" id_estimacion = $value ";
			if($cuantasF > $contador)
			{
				$todasFacturas.=" OR ";
			}
			$contador++;
		}
	$sql_Fe = "	SELECT SUM(importeDto) totalFacturado 
				FROM estimacionDocto 
				WHERE ($todasFacturas) 
				AND tipo = 1 
				AND extension like '%pdf%'  
				AND borrado = 0 ";
	$sql_Fe_R 		= mysqli_query($dbd2, $sql_Fe);
	$facturado_M	= mysqli_fetch_array($sql_Fe_R);
	@$montoFactura 	+= $facturado_M['totalFacturado'];
	echo "	<tr>
				<th>TOTAL FACTURADO IVA INCLUIDO:</th>
				<td align='right'> $".@number_format($montoFactura, 2)."</td>
			</tr>";
	}
	else
	{
	echo "	<tr>
				<th>TOTAL FACTURADO IVA INCLUIDO:</th>
				<td>NO TIENE FACTURAS REGISTRADAS</td>
			</tr>";
	}
	##### FACTURADO CONTRATO


	##### FLOTILLA
	unidadesDelContrato($id_contrato);
	//print_r($unidadesArray) ;
	//echo "<br/>";
	//var_dump($unidadesArray) ; // TRAE MAS TEXTO
	// OBTENER COSTO TOTAL DE FLOTILLA INVOLUCRADA EN CONTRATO
	if(sizeof($unidadesArray)>0) 
	// OBTIENE UN ARRAY PARA HACER UN SELECT 
	// QUE INCLUYA LAS UNIDADES DEL CONTRATO
	{
		$todasUnidades='';
		$cuantas 	= sizeof($unidadesArray);
		$contador 	= 1;
		foreach( $unidadesArray as $key => $value){
			$todasUnidades.=" id_unidad = $value ";
			if($cuantas > $contador){
				$todasUnidades.=" OR ";
			}
			$contador++;
		}
		//echo "<br>".$todasUnidades; // PARA VER CONSTRUCCION DEL WHERE
	$valorFlotilla 	= "SELECT SUM(Importe) suma FROM facturaunidad WHERE ($todasUnidades) ";
	$valorFlotillaR = mysqli_query($dbd2, $valorFlotilla);
	$vFM 			= mysqli_fetch_assoc($valorFlotillaR);
	$valorFlotilla 	= $vFM['suma'];
	echo "	<tr>
				<th>VALOR DE FLOTILLA ACTUAL:</th>
				<td align='right'> $".number_format($valorFlotilla,2)."</td>
			</tr>";
	}
	else
	{
	echo "	<tr>
				<th>VALOR DE FLOTILLA ACTUAL:</th>
				<td>NO TIENE UNIDADES ASIGNADAS</td>
			</tr>";
	}
	##### FLOTILLA



	##### MANTENIMIENTOS
	$costoMttoSQL 	= "SELECT SUM(importe) importe FROM mttoSol WHERE id_contrato = '$id_contrato' ";
	$costoMttoR 	= mysqli_query($dbd2, $costoMttoSQL);
	$cMC			= mysqli_fetch_assoc($costoMttoR);
	$costoMtto 		= $cMC['importe'];
	
	if($costoMtto > 0)
	{
	echo "	<tr>
				<th>COSTO DE MANTENIMIENTOS:</th>
				<td align='right'> $".number_format($costoMtto,2)."</td>
			</tr>";
	}
	else
	{
	echo "	<tr>
				<th>COSTO DE MANTENIMIENTOS:</th>
				<td>NO TIENE MANTENIMIENTOS SOLICITADOS</td>
			</tr>";
	}
	##### MANTENIMIENTOS	




	##### TRASLADOS
	$costoTraslado 	= "SELECT SUM(costoT) costo FROM mov_traslados WHERE id_contratoD = '$id_contrato' ";
	$costoTrasladoR	= mysqli_query($dbd2, $costoTraslado);
	$cTM			= mysqli_fetch_assoc($costoTrasladoR);
	$costoTld 		= $cTM['costo'];
	
	if($costoTld > 0)
	{
	echo "	<tr>
				<th>COSTO DE TRASLADOS:</th>
				<td align='right'> $".number_format($costoTld,2)."</td>
			</tr>";
	}
	else
	{
	echo "	<tr>
				<th>COSTO DE TRASLADOS:</th>
				<td>NO TIENE TRASLADOS ASOCIADOS</td>
			</tr>";
	}
	##### TRASLADOS








	
	echo "</table>";	
	echo "<hr>";	
?>