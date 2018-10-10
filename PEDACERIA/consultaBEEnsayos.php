<?php
include("1header.php");
include("nav_consultaB.php");

if($_SESSION["consultaB"] > 0){ // APERTURA PRIVILEGIO

$terminacionPV 	= 0;
$placasHV 		= 0;
$kmV 			= 0;
$asignacionV 	= 0;
$ubicacionV 	= 0;
$gpsV 			= 0;
$tarjetaV 		= 0;
$polizaV 		= 0;
$facturaV 		= 0;
$fotoSV 		= 0;

$id_unidadV 	= 0;
$folioFV	 	= 0;
$estadoEV	 	= 0;

$tn2017 		= 0;
$tn2016 		= 0;
$tn2015 		= 0;
$tn2014 		= 0;
$tn2013 		= 0;

?>
<meta charset='utf-8'>
<div style='padding: 5px;'>
<h2>CONSULTA POR ECONOMICOS</h2>

<form action="consultaBEEnsayos.php" method="post">
<table>
	<tr><td>

<p><label>Escribe en el siguiente campo los ECONOMICOS a buscar separados por comas (,) :</label></p>
<p><textarea name="celulas" rows="7" cols="40"><?php echo @$_POST['celulas']; ?></textarea></p>
<p>	<input type="submit" name="search" value="Buscar" />
	<a href='consultaBEEnsayos.php' style='text-decoration: none;'>
	<input type="button" value="BORRAR" >
	</a>
</p>


</td><td>


	<table>
	<tr><td colspan='3'>
	SELECCIONE LOS ELEMENTOS QUE DESEA EN RESUMEN:	
	</td></tr>

	<tr>
		<td>
		<input type="checkbox" value='1' name='terminacionPV' id='terminacionPV' > 
		<label for='terminacionPV' >Terminación de Placa</label>	
		</td><td>
		<input type="checkbox" value='1' name='kmV' id='kmV' > 
		<label for='kmV' >Último Kilometraje</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='asignacionV' id='asignacionV' > 
		<label for='asignacionV' >Asignación Actual</label>	
		</td>

		<td>
		<input type="checkbox" value='1' name='tn2017' id='tn2017' > 
		<label for='tn2017' >Tenencia 2017</label>			
		</td>
	</tr>


	<tr>
		<td>
		<input type="checkbox" value='1' name='ubicacionV' id='ubicacionV' > 
		<label for='ubicacionV' >Último Reporte de Ubicación</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='gpsV' id='gpsV' > 
		<label for='gpsV' >GPS</label>
		</td>
		<td>
		<input type="checkbox" value='1' name='tarjetaV' id='tarjetaV' > 
		<label for='tarjetaV' >Tarjeta de Circulación</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='tn2016' id='tn2016' > 
		<label for='tn2016' >Tenencia 2016</label>			
		</td>
	</tr>

	<tr>
		<td>
		<input type="checkbox" value='1' name='polizaV' id='polizaV' > 
		<label for='polizaV' >Póliza de Seguro</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='facturaV' id='facturaV' > 
		<label for='facturaV' >Factura</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='fotoSV' id='fotoSV' > 
		<label for='fotoSV' >Serie Foto</label>
		</td>
		<td>
		<input type="checkbox" value='1' name='tn2015' id='tn2015' > 
		<label for='tn2015' >Tenencia 2015</label>			
		</td>
	</tr>

	<tr>
		<td>
		<input type="checkbox" value='1' name='placasHV' id='placasHV' > 
		<label for='placasHV' >Placas Histórico</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='id_unidadV' id='id_unidadV' > 
		<label for='id_unidadV' >id_unidad</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='folioFV' id='folioFV' > 
		<label for='folioFV' >Folio Factura O</label>	
		</td>
		<td>
		<input type="checkbox" value='1' name='tn2014' id='tn2014' > 
		<label for='tn2014' >Tenencia 2014</label>			
		</td>
	</tr>

	<tr>
		<td>
		<input type="checkbox" value='1' name='estadoEV' id='estadoEV' > 
		<label for='estadoEV' >Estado Emplacamiento</label>
		</td>
		<td>
		</td>
		<td></td>
		<td>
		<input type="checkbox" value='1' name='tn2013' id='tn2013' > 
		<label for='tn2013' >Tenencia 2013</label>			
		</td>
	</tr>

	</table>

</td>
</tr>
</table>

</form>

<?php
if (isset($_POST['search'])) {
//	$celulasSC = mysql_real_escape_string($_POST['celulas']);
//	echo $celulasSC;
	$celulas = trim($_POST['celulas']);
	$celulas = trim(preg_replace('/\s\s+/', '', $celulas));
	$celulas = str_replace(array("\n", "\t", " "),"",$celulas);
	$celulas = mysql_real_escape_string($celulas);
	$celulasDescarga = $celulas;// PARA FORMATO DESCARGA PREVIO AL EXPLODE
	$celulas = explode(',', $celulas);

/*
	echo "<br> CELULAS:: ";
	print_r($celulas);
	echo "<br>";

	echo "<br> CELULAS:: ";
	var_dump($celulas) ;
	echo "<br>";
*/

	foreach ($celulas as $key => $value) 
	{
		global $conectar;
//		$array_bidimensional[$key][0] =  $value;
		$sql_idUnidad 	= "SELECT id FROM ubicacion WHERE Economico = '$value' ";
		$sql_idUnidad_R = mysql_query($sql_idUnidad);
		$renglon		= mysql_fetch_assoc($sql_idUnidad_R);
		$id_unidadXXX 	= $renglon['id'];
		$array_bidimensional[$key][0] = $value; // VALOR BUSCADO
		$array_bidimensional[$key][1] = $id_unidadXXX; // ID EN BASE DEL VALOR BUSCADO

//				$id_unidad =  $renglon['id'];
	}

/*
	echo "<br> array_bidimensional:: ";
	var_dump($array_bidimensional) ;
	echo "<br>";
*/

	$consecutivo = 0;
	echo '<table id="ResTabla" class="ResTabla" border="1" cellpadding="5" cellspacing="5">';
	foreach ($array_bidimensional as $key => $value) {
		//echo  $array_bidimensional[$key][1]."<br>";
		$id_unidad 		= $array_bidimensional[$key][1];
		$valorBuscado 	= $array_bidimensional[$key][0];
		$consecutivo++;

		echo '<tr>';
		echo '<td>'.$valorBuscado.'</td>';
		echo '<td>'.$consecutivo.'</td>';
		echo '<td>'.$id_unidad.'</td>';
		datosxid($id_unidad);
		echo "<td><a href='u3index.php?id_unidad=$id_unidad' 
		title='Consultar UNIDAD'>".$Economico.'</a></td>';
		echo '<td>'.$Serie.'</td>';
		echo '<td>'.$Vehiculo.'</td>';
		echo '<td>'.$Modelo.'</td>';
		echo '<td>'.$Placas.'</td>';
		echo '</tr>';
	}
	echo '</table >';



//	$array_bidimensional[0][1] = '1234';

/*
	echo "<br> ARRAY BIDIMENSIONAL:: con id ";
	print_r($array_bidimensional) ;
	echo "<br>";

	echo "ID 3ER VALOR  ".$array_bidimensional[2][1]." <BR>";
	echo "ID 4TO VALOR  ".$array_bidimensional[3][1]." <BR>";


	if( $array_bidimensional[3][1] == ''  ){
		echo "NO HUBO EXITO EN RESULTADO <BR>";
	}
*/



	$query_search = 'SELECT id, Economico, Serie, Vehiculo, Modelo, Color FROM ubicacion WHERE ';
	for ($i=0; $i<count($celulas); $i++) {
		if ($i == 0)
			$query_search .= 'Economico = "'.$celulas[$i].'"';
		else
			$query_search .= ' OR Economico = "'.$celulas[$i].'"  '; //ORDER BY Economico ASC
	}
//	$query_search .= ' ORDER BY Economico ASC ';


##### // INICIA ASIGNACION A VARIABLES SEMAFORO
$terminacionPV 	= (isset($_POST['terminacionPV']) 	&& $_POST['terminacionPV'] == 1)? 1:0 ;
$placasHV 		= (isset($_POST['placasHV']) 		&& $_POST['placasHV'] == 1) 	? 1:0 ;
$kmV 			= (isset($_POST['kmV']) 			&& $_POST['kmV'] == 1)			? 1:0 ;
$asignacionV 	= (isset($_POST['asignacionV']) 	&& $_POST['asignacionV'] == 1)	? 1:0 ;
$ubicacionV 	= (isset($_POST['ubicacionV']) 		&& $_POST['ubicacionV'] == 1)	? 1:0 ;
$gpsV 			= (isset($_POST['gpsV']) 			&& $_POST['gpsV'] == 1)			? 1:0 ;
$tarjetaV 		= (isset($_POST['tarjetaV']) 		&& $_POST['tarjetaV'] == 1)		? 1:0 ;
$polizaV 		= (isset($_POST['polizaV']) 		&& $_POST['polizaV'] == 1)		? 1:0 ;
$facturaV 		= (isset($_POST['facturaV']) 		&& $_POST['facturaV'] == 1)		? 1:0 ;
$fotoSV 		= (isset($_POST['fotoSV']) 			&& $_POST['fotoSV'] == 1)		? 1:0 ;
$id_unidadV 	= (isset($_POST['id_unidadV']) 		&& $_POST['id_unidadV'] == 1)	? 1:0 ;
$folioFV 		= (isset($_POST['folioFV']) 		&& $_POST['folioFV'] == 1)		? 1:0 ;
$estadoEV 		= (isset($_POST['estadoEV']) 		&& $_POST['estadoEV'] == 1)		? 1:0 ;

$tn2017 		= (isset($_POST['tn2017']) 			&& $_POST['tn2017'] == 1)		? 1:0 ;
$tn2016 		= (isset($_POST['tn2016']) 			&& $_POST['tn2016'] == 1)		? 1:0 ;
$tn2015 		= (isset($_POST['tn2015']) 			&& $_POST['tn2015'] == 1)		? 1:0 ;
$tn2014 		= (isset($_POST['tn2014']) 			&& $_POST['tn2014'] == 1)		? 1:0 ;
$tn2013 		= (isset($_POST['tn2013']) 			&& $_POST['tn2013'] == 1)		? 1:0 ;

/*
echo $terminacionPV."terminacionPV<br>";
echo $kmV."kmV<br>" 			;
echo $asignacionV."asignacionV<br>" 	;
echo $ubicacionV."ubicacionV<br>" 	;
echo $gpsV."gpsV<br>" 			;
echo $tarjetaV."tarjetaV<br>" 		;
echo $polizaV."polizaV<br>" 		;
echo $facturaV."facturaV<br>" 		;
echo $fotoSV."fotoSV<br>" 		;
*/
##### // TERMINA ASIGNACION A VARIABLES SEMAFORO

/*
	// INICIO BOTON DESCARGA
	echo "<p>
		<FORM action='consultaBP_GET.php' method='POST'>
			<INPUT TYPE='hidden' NAME='celulasDescarga' VALUE='$celulasDescarga'>
			<INPUT TYPE='hidden' NAME='busqueda' VALUE='economicos'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Descargar Resultado'>
		</FORM>
		</p>";
	// TERMINA BOTON DESCARGA	
*/

	$search = $conexion4->query($query_search);

	$consecutivo = 0;
	if ($search->num_rows > 0) {
			// INICIA ENCABEZADOS
			echo '<table id="ResTabla" class="ResTabla" border="1" cellpadding="5" cellspacing="5">';
			echo '<tr>';
			echo '<th>LISTADO</th>';
			if($id_unidadV == 1){echo '<th>ID_UNIDAD</th>';}
			echo '<th>ECONOMICO</th>';
			echo '<th>SERIE</th>';
			echo '<th>VEHICULO</th>';
			echo '<th>MODELO</th>';
			echo '<th>PLACAS</th>';
			if($terminacionPV == 1){echo '<th>TERMINACION</th>';}
			if($estadoEV == 1){echo '<th>ENTIDAD EP</th>';}
			if($placasHV == 1){echo '<th>HISTORICO PLACAS</th>';}
			if($kmV == 1){echo '<th>KILOMETRAJE</th>';}
			if($asignacionV == 1){
			echo '<th>ASG CLIENTE</th>';
			echo '<th>ASG CONTRATO</th>';
			echo '<th>ASG FECHA</th>';}
			if($ubicacionV == 1){
			echo '<th>UB CLIENTE</th>';
			echo '<th>UB LUGAR</th>';
			echo '<th>UB FECHA</th>';
			}
			if($gpsV == 1){
				if($_SESSION["gps"] > 0)
				{echo '<th>GPS</th>';}}
			if($tarjetaV == 1){echo '<th>TARJETA C</th>';}
			if($polizaV == 1){echo '<th>POLIZA SEGURO</th>';}
			if($facturaV == 1){
				if($_SESSION["factura"] > 0 )
				{echo '<th>FACTURA</th>';}}


			if($tn2017 == 1){
				if($_SESSION["tenencia"] > 0 )
				{echo '<th>TENENCIA 2017</th>';}}

			if($tn2016 == 1){
				if($_SESSION["tenencia"] > 0 )
				{echo '<th>TENENCIA 2016</th>';}}

			if($tn2015 == 1){
				if($_SESSION["tenencia"] > 0 )
				{echo '<th>TENENCIA 2015</th>';}}

			if($tn2014 == 1){
				if($_SESSION["tenencia"] > 0 )
				{echo '<th>TENENCIA 2014</th>';}}

			if($tn2013 == 1){
				if($_SESSION["tenencia"] > 0 )
				{echo '<th>TENENCIA 2013</th>';}}


			if($folioFV == 1){
				if($_SESSION["factura"] > 0 )
				{echo '<th>FOLIO FA O</th>';}}
			if($fotoSV == 1){echo '<th>FOTO SERIE</th>';}
			echo '</tr>';
			// TERMINA ENCABEZADOS


			// INICIA RESULTADOS				
			while ($row_searched = $search->fetch_array()) { 
				$consecutivo++ ;
				echo '<tr>';
				$id_unidad = $row_searched['id'];
				echo '<td>'.$consecutivo.'</td>';

				if($id_unidadV == 1){
				echo '<td>'.$id_unidad.'</td>';
				}

				datosxid($id_unidad);
				echo "<td><a href='u3index.php?id_unidad=$id_unidad' 
				title='Consultar UNIDAD'>".$Economico.'</a></td>';

				echo '<td>'."<label for='$id_unidad' >".$Serie."</label>".'</td>';
				echo '<td>'.$Vehiculo.'</td>';
				echo '<td>'.$Modelo.'</td>';
				echo '<td>'."<label for='$id_unidad' >".$Placas."</label>".'</td>';

				// INICIA RESULTADOS ON DEMAND	
				if($terminacionPV == 1){
				echo '<td>'.$terminacionN.'</td>';
				}

				if($estadoEV == 1){
				$id_estado 	= $estadoEPA;
				estadoxidEdo($id_estado);
				echo '<td>'.$iso31662E.'</td>';
				}

				if($placasHV == 1){
				// INICIO HISTORICO DE PLACAS
				if($_SESSION["documentos"] > 2){
				placasHist($id_unidad);
				echo '<td>'.$PlacasH.'</td>';
				$PlacasH = ''; // RESETEAR VARIABLE GLOBAL
				}
				// TERMINA HISTORICO DE PLACAS
				}

				if($kmV == 1){
				kmxid($id_unidad);
				echo '<td>'.number_format($kmUltimo).'</td>';
				}

				if($asignacionV == 1){				
				unidadAsignacion($id_unidad);
				clientexid($id_cliente);
				echo '<td>'.$id_cliente.'::: '.$rfc.' <br> '.$razonSocial.'</td>';
				contratoxid($id_contrato);
				echo '<td> id_contrato '.$id_contrato.' ::: ALAN '.$id_alan.' ALAN ::: No. OFICIAL '.$numero.'</td>';
				echo '<td>'.$fecha_inicioASG.'</td>';
				}

				if($ubicacionV == 1){
				ubicacionHistorico($id_unidad);
				echo '<td>'.$clienteA.'</td>';
				echo '<td>'.$ubicacionA.'</td>';
				echo '<td>'.$fechaA.'</td>';
				}

				// INICIA PUEDE VER GPS
				if($gpsV == 1){
					if($_SESSION["gps"] > 0){ 
					gpsxid($id_unidad);
					$color = '';
					if($tienegps == 'No'){$color = 'red';}
					echo "<td style='color:$color;'>{$tienegps}</td>";
					} 
				}// TERMINA PUEDE VER GPS

				// LINKS A TARJETA DE CIRCULACION
				if($tarjetaV == 1){
				buscaDocTC($id_unidad);
				$tcTXT = ($ArchivoTC != '')? 'TC': '' ;
				echo "<td>";
				echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaTC/$ArchivoTC' target='_blank'>$tcTXT</a>";
				echo "</td>";
				}
				// LINKS A TARJETA DE CIRCULACION

				// LINKS A POLIZA DE SEGURO
				if($polizaV == 1){
				buscaDocPS($id_unidad);
				$psTXT = ($ArchivoPS != '')? 'PS': '' ;
				echo "<td>";
				echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaPS/$ArchivoPS' target='_blank'>$psTXT</a>";
				echo "</td>";
				}// LINKS A POLIZA DE SEGURO

				// LINKS A FACTURA
				if($facturaV == 1)
				{
					if($_SESSION["factura"] > 0 )
					{

					buscaDocFA($id_unidad);
					$faTXT = ($ArchivoFA != '')? 'FA': '' ;
					echo "<td>";
					echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaFA/$ArchivoFA' target='_blank'>$faTXT</a>";
					echo "</td>";
					$rutaFA = '';
					$ArchivoFA = '';
					}
				}// LINKS A FACTURA


				// LINKS A TENENCIA 2017
				if($tn2017 == 1)
				{
					if($_SESSION["tenencia"] > 0 )
					{
					$anio = 2017;
					buscaDocT($id_unidad, $anio);
					$tnTXT = ($ArchivoTN != '')? 'T2017': '' ;
					echo "<td>";
					echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaTN/$ArchivoTN' target='_blank'>$tnTXT</a>";
					echo "</td>";
					}
				}// LINKS A TENENCIA 2017


				// LINKS A TENENCIA 2016
				if($tn2016 == 1)
				{
					if($_SESSION["tenencia"] > 0 )
					{
					$anio = 2016;
					buscaDocT($id_unidad, $anio);
					$tnTXT = ($ArchivoTN != '')? 'T2016': '' ;
					echo "<td>";
					echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaTN/$ArchivoTN' target='_blank'>$tnTXT</a>";
					echo "</td>";
					}
				}// LINKS A TENENCIA 2016


				// LINKS A TENENCIA 2015
				if($tn2015 == 1)
				{
					if($_SESSION["tenencia"] > 0 )
					{
					$anio = 2015;
					buscaDocT($id_unidad, $anio);
					$tnTXT = ($ArchivoTN != '')? 'T2015': '' ;
					echo "<td>";
					echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaTN/$ArchivoTN' target='_blank'>$tnTXT</a>";
					echo "</td>";
					}
				}// LINKS A TENENCIA 2015


				// LINKS A TENENCIA 2014
				if($tn2014 == 1)
				{
					if($_SESSION["tenencia"] > 0 )
					{
					$anio = 2014;
					buscaDocT($id_unidad, $anio);
					$tnTXT = ($ArchivoTN != '')? 'T2014': '' ;
					echo "<td>";
					echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaTN/$ArchivoTN' target='_blank'>$tnTXT</a>";
					echo "</td>";
					}
				}// LINKS A TENENCIA 2014


				// LINKS A TENENCIA 2013
				if($tn2013 == 1)
				{
					if($_SESSION["tenencia"] > 0 )
					{
					$anio = 2013;
					buscaDocT($id_unidad, $anio);
					$tnTXT = ($ArchivoTN != '')? 'T2013': '' ;
					echo "<td>";
					echo "<a href='http://www.jetvan.mx/jetvan/exp/$rutaTN/$ArchivoTN' target='_blank'>$tnTXT</a>";
					echo "</td>";
					}
				}// LINKS A TENENCIA 2013



				if($folioFV == 1)
				{
					if($_SESSION["factura"] > 0 )
					{
						folioFxid($id_unidad);
						echo "<td>{$FolioFactura}</td>";
					}
				}// LINKS A FACTURA

				// LINKS A FOTO SERIE
				if($fotoSV == 1){
				buscaFotoS($id_unidad);
				$fsTXT = ($ArchivoFS != '')? 'FS': '' ;
				echo "<td>";
				echo "<a href='http://www.jetvan.mx/jetvan/exp/fotos/$rutaFS/$ArchivoFS' target='_blank'>$fsTXT</a>";
				echo "</td>";
				}// LINKS A FOTO SERIE
				// TERMINA RESULTADOS ON DEMAND	

				echo '</tr>';
				$id_unidad = '';
				@$id_cliente = '';
				@$id_contrato = '';
				@$fecha_inicioASG = '';
				@$id_unidad = '';
			}
			echo '</table><br/>';
	}
	else 
	{
		echo '<div class="info">No hay resultados para los criterios de búsqueda.</div>';
	}
}

echo "</div>";

} // CIERRE PRIVILEGIO
include("1footer.php");?>