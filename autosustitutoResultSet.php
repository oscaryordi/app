<?php
$res_sust = mysqli_query($dbd2, $sql_sust);

$virtuales = '';
if($_SESSION["sustituto"] > 2)
	{ $virtuales = '<th>MOV VIRTUAL</th><th>OBS ENTREGA</th><th>OBS DEVOLUCION</th>';}
$encabezadoFalso = ($virtuales == '')?'<th></th><th></th>':'';
?>
<style>
.fa-upload{color:gray;font-size:16px;}
.fa-upload:hover{ color:green;}
.fa-file-alt{color:gray;font-size:16px;}
.fa-file-alt:hover{ color:green;}

</style>
<?php 
echo "<table class='ResTabla' >\n";
echo "<tr>
		<th>FOLIO<br>VER FORMATO</th>
		<th>FECHA SOLICITUD</th>

		<th>AUTO BASE</th>
		<th>AUTO SUSTITUTO</th>

		<th>MOTIVO</th>

		<th>CLIENTE/CONTRATO</th>

		<th>SALIDA CONFIRMADA</th>
		<th>DEVOLUCION CONFIRMADA</th>
		<th>STATUS</th>
		$virtuales
		$encabezadoFalso
		<th>SUBIR ESCANEO</th>
		<th>VER ESCANEO</th>
	</tr>";

//	 		<th>EJECUTIVO</th>


while($row = mysqli_fetch_assoc($res_sust))
{
	$id_sust 		= $row['id_sust'];

	$id_unidadF 	= $row['id_unidadF'];
	$id_unidadS 	= $row['id_unidadS'];

	$id_contrato 	= $row['id_contrato'];
	$proyecto 		= $row['proyecto'];

	$motivo 		= $row['motivo'];
	$fecharegistro 	= $row['fecharegistro'];

	$fechaInicio 	= $row['fechaI'];
	$fechaFinal 	= $row['fechaF'];

	$status 		= $row['status'];
	$virtualI 		= $row['virtualI'];
	$virtualF 		= $row['virtualF'];

	echo "<tr>";
	echo "<td><a href='AutoSustitutoVerId.php?id_sustituto=$id_sust' target='blank'>{$id_sust}</a></td>"; 
	echo "<td>{$fecharegistro}</td>"; 	

	datosxid($id_unidadF);
	echo "<td>
			<b><a href='u3index.php?id_unidad=$id_unidadF' title='Consultar UNIDAD'>{$Economico}</a></b>
				 ::: {$Serie} ::: {$Placas}  ::: {$Modelo} <br>
			{$Vehiculo}</td>";

	datosxid($id_unidadS);
	echo "<td>
			<b><a href='u3index.php?id_unidad=$id_unidadS' title='Consultar UNIDAD'>{$Economico}</a></b>
				 ::: {$Serie} ::: {$Placas}  ::: {$Modelo} <br>
			{$Vehiculo}</td>";
	
	echo "<td>{$motivo}</td>";

	contratoxid($id_contrato);
	clientexid($id_cliente);
	echo "<td>
		<b>ID<a href='ctoIndex.php?id_contrato=$id_contrato' 
				style='text-decoration:none;' title='VER CONTRATO' >
				=> {$id_alan}
				</a></b> ::: N.OFICIAL: {$numero} ::: ALIAS_CTO: {$aliasCto}<br>
		{$razonSocial}<br> 
		RFC:<b>{$rfc}</b> ::: ALIAS_CTE:{$alias}<br>
		{$proyecto}
		</td>";

	//echo "<td>{$proyecto}</td>";		

	echo "<td>{$fechaInicio}</td>";	
	echo "<td>{$fechaFinal}</td>";

	if($status == '1'){
		$statustexto = 'ACTIVA';
		echo "<td>".$statustexto;

		if($fechaInicio == '' && $fechaFinal == '' ){
			echo	" <FORM action='autosustitutoC.php' method='POST' >
					<INPUT TYPE='hidden' NAME='id_sust' value='$id_sust'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='CANCELAR' style='font-size:.8em;'>
					</FORM>";
		}
		echo "</td>";
	}else{$statustexto = 'CANCELADA';
	echo "<td>{$statustexto}</td>";
	}


	if($_SESSION["sustituto"] > 2)
	{  // APERTURA PRIVILEGIOS SUPERVISOR LOGISTICA
		if($status == '1')
		{
			//$statustexto = 'ACTIVA';
			echo "<td>";

			if($fechaInicio !== null && $fechaFinal == null)
				{
					echo	" <FORM action='autosustitutoDV.php' method='POST' >
							<INPUT TYPE='hidden' NAME='id_sust' value='$id_sust'>
							<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='TERMINAR' style='font-size:.8em;'>
							</FORM>";
				}
			elseif($fechaInicio == null && $fechaFinal == null )
				{	
					echo 	" <FORM action='autosustitutoEV.php' method='POST' >
							<INPUT TYPE='hidden' NAME='id_sust' value='$id_sust'>
							<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='INICIAR' style='font-size:.8em;'>
							</FORM>";
				}
			elseif($fechaInicio !== null && $fechaFinal !== null )
				{	
					echo 	"OK";
				}
			echo "</td>";
		}

		if($status == '0')
		{
			echo "<td>---</td>";
		}
	}

	$obsEV = '';
	if($virtualI == 1)
	{
	 	$sql_EV = " SELECT * FROM sustitutoVirtual 
					WHERE id_sust = '$id_sust' 
					AND tipoMV = 0 
					LIMIT 1 ";
		$ev_R 	= mysqli_query($dbd2, $sql_EV);
		while($rowev = mysqli_fetch_assoc($ev_R)){ 
			$obsEV = $rowev['obs'];
		}
		$tieneEV = mysqli_affected_rows($dbd2);
	 }
	echo "<td>$obsEV</td>";
	$obsEV = '';

	$obsDV = '';
	if($virtualF == 1)
	{
	 	$sql_DV = " SELECT * FROM sustitutoVirtual 
					WHERE id_sust = '$id_sust' 
					AND tipoMV = 1 
					LIMIT 1 ";
		$dv_R 	= mysqli_query($dbd2, $sql_DV);
		while($rowdv = mysqli_fetch_assoc($dv_R)){ 
			$obsDV = $rowdv['obs'];
		}
		$tieneDV = mysqli_affected_rows($dbd2);
	 }
	echo "<td>$obsDV</td>";
	$obsDV = '';

	echo "<td>";
	if($_SESSION["sustituto"] > 0)
	{
		echo "	<a href='autosustitutoDoctoAlta.php?id_sust=$id_sust' alt='SUBIR ARCHIVO' title='SUBIR ARCHIVO'  >
				<i class='fas fa-upload' alt='SUBIR ARCHIVO' title ='SUBIR ARCHIVO' >
				</i>
				</a>
			";
	}
	echo "</td>";


	echo "<td>";
	if($_SESSION["sustituto"] > 0)
	{
		echo "	<a href='autosustitutoDoctoAlta.php?id_sust=$id_sust' alt='VER ESCANEO' title ='VER ESCANEO'  >
				<i class='fas fa-file-alt' alt='VER ESCANEO' title ='VER ESCANEO' >
				</i>
				</a>
			";
	}
	echo "</td>";




	echo "</tr>";
}
echo "</table>";