<?php
include("1header.php");
echo "<meta charset='utf-8'>";
// ALTA DE SINIESTROS

if($_SESSION["siniestro"] > 0 ){  // APERTURA PRIVILEGIOS 
	
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);
unidadAsignacion($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);

?>
<table>
	<tr>
		<td>
			 
			<b>UNIDAD</b>
			<br>Economico: 
			<?php echo $Economico;?>
			<br>Serie: 
			<?php echo $Serie;?>
			<br>Placas: 
			<?php echo $Placas;?>
			 
		</td>
		<td>
			 
			<br>Tipo: 
			<?php echo $Vehiculo;?>
			<br>Color: 
			<?php echo $Color;?>
			<br>Modelo: 
			<?php echo $Modelo;?>
			 
		</td>

		<td>
			<b>PROYECTO-CLIENTE</b>  
			<br>Cliente:
			<?php echo   $razonSocial;?>
			<br>Contrato:
			<?php echo "id ::: ".$id_alan." ::: ".$numero;?>
		</td>

	</tr>
</table>
<?php	

$subido = ''; 

// FECHA DE MEXICO para utilizarla en lugar de la del servidor
date_default_timezone_set('America/Mexico_city');
// FECHA DE MEXICO para utilizarla en lugar de la del servidor

// $procederS = 1; && $procederS == 0

if(isset($_POST['Datos'])  ){

	$errorES = ''; 

/*	
	// MENSAJES DE ERROR
	$error1 = '';
//	if(isset($_POST['id_cliente']) && $_POST['id_cliente'] != 0 ){;}else{$error1 = ':: No indico cliente';}
	$error2 = '';
//	if(isset($_POST['id_contrato']) && $_POST['id_contrato'] != 0){;}else{$error2 = ':: No indico contrato';}
	$error3 = '';
	if($_POST['id_prov']!= 0 ){;}else{$error3= ':: No indico proveedor';}
	$error4 = '';
	if($_POST['estadoO']!= 0 ){;}else{$error4= ':: No indico Estado de Origen';}
	$error5 = '';
	if($_POST['estadoD']!= 0 ){;}else{$error5= ':: No indico Estado de Destino';}
	$error6 = '';
	if($_POST['domicilioD']!= '' ){;}else{$error6= ':: No indico Domicilio de Destino';}
	// MENSAJES DE ERROR

	$errorES = $error1.$error2.$error3.$error4.$error5.$error6;
*/

	if(
		$errorES == '' 
//		$_POST['id_contrato']!='' 
//		&& $_POST['folio_inv']!=''
//		&& $_POST['id_prov']!='' 
//		&& $_POST['facturaT']!='' 
	)
	{
		

			$id_cliente =mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
			$id_contrato=mysqli_real_escape_string($dbd2, $_POST['id_contrato']);

			$numPoliza  =mysqli_real_escape_string($dbd2, $_POST['numPoliza']); // OBLIGATORIO
			$numInciso	=mysqli_real_escape_string($dbd2, $_POST['numInciso']); // OBLIGATORIO
			
			$numSin		=mysqli_real_escape_string($dbd2, $_POST['numSin']); // OBLIGATORIO
			$numReporte	=strtoupper(mysqli_real_escape_string($dbd2, $_POST['numReporte'])); // OBLIGATORIO

			$fechaSin	=mysqli_real_escape_string($dbd2, $_POST['fechaSin']); // OBLIGATORIO
			$fechaRep	=mysqli_real_escape_string($dbd2, $_POST['fechaRep']); // OBLIGATORIO

			$tipoSin  	=strtoupper(mysqli_real_escape_string($dbd2, $_POST['tipoSin']));
			$domSin  	=strtoupper(mysqli_real_escape_string($dbd2, $_POST['domSin']));
			$cdSin  	=strtoupper(mysqli_real_escape_string($dbd2, $_POST['cdSin']));
			$edoSin 	=mysqli_real_escape_string($dbd2, $_POST['edoSin']);

			$agenciaTaller =strtoupper(mysqli_real_escape_string($dbd2, $_POST['agenciaTaller']));

			$nomConductor =strtoupper(mysqli_real_escape_string($dbd2, $_POST['nomConductor'])) ;
			$telCond  	=mysqli_real_escape_string($dbd2, $_POST['telCond']);
			$edadCond  	=mysqli_real_escape_string($dbd2, $_POST['edadCond']);

			$capturo = $_SESSION["id_usuario"];

			// QUERY CANDADO NO SE DUPLIQUE
				$sql_existe = "SELECT * FROM siniestro  
				WHERE 
				id_unidad = '$id_unidad' 
				AND 
				id_cliente = '$id_cliente' 
				AND 
				id_contrato = '$id_contrato' 
				AND 
				numPoliza = '$numPoliza' 
				AND 
				numInciso = '$numInciso' 
				AND 
				numSin = '$numSin' 
				AND 
				numReporte = '$numReporte' 
				AND 
				fechaSin = '$fechaSin'
				LIMIT 1 ";
				$sql_existe_resp = mysqli_query($dbd2, $sql_existe);
				if(mysqli_affected_rows($dbd2) > 0){
					$matrizE		= mysqli_fetch_array($sql_existe_resp);
					$id_siniestro 	= $matrizE['id_siniestro'];
				}
			// QUERY CANDADO NO SE DUPLIQUE

				if(mysqli_affected_rows($dbd2) == 0) // CANDADO PARA QUE NO SE DUPLIQUE captura de SINIESTRO
					{
						// INICIA INSERTAR DATOS DE SINIESTRO
						$sql_sin = " INSERT INTO `siniestro` 
						(`id_siniestro`, `id_unidad`, `id_cliente`, `id_contrato`, 
						`edoSin`, `cdSin`, `domSin`, `fechaSin`, 
						`numSin`, `numPoliza`, `numInciso`, `numReporte`, 
						`fechaRep`, `tipoSin`, 
						`telCond`, `edadCond`, `nomConductor`, 
						`agenciaTaller`, `capturo`  ) VALUES 
						( NULL, '$id_unidad',  '$id_cliente', '$id_contrato',
						'$edoSin', '$cdSin', '$domSin', '$fechaSin', 
						'$numSin', '$numPoliza', '$numInciso', '$numReporte', 
						'$fechaRep', '$tipoSin', 
						'$telCond', '$edadCond', '$nomConductor', 
						'$agenciaTaller', '$capturo' )
						";
						//echo $sql_traslado;
						$sql_sin_R 		= mysqli_query($dbd2, $sql_sin);
						$id_siniestroR 	= mysqli_insert_id($dbd2); // OBTIENE EL ID DE ESTA QUERY REALIZADA
						// TERMINA INSERTAR DATOS DE SINIESTRO

						if($sql_sin_R)
						{ 
							echo "<h2>SINIESTRO REGISTRADO CORRECTAMENTE, BD: $id_siniestroR </h2>";
							$subido = 'ok'	;
							//include('trasladoRegistrado.php');
						}
						else
						{
							echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2) . "\n"; // PARA DETECTAR ERROR EN QUERY
						}
	  				} // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
	  			else
	  				{
	  					echo "<p>Este SINIESTRO / INCIDENCIA ya fue registrado ::: BD-> $id_siniestro :::</p>";
	  				}
	}
	else
	{
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; $errorES </p>";
	}
}


if($subido!='ok'){
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->


<fieldset><legend>Registrar SINIESTRO</legend>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>REGISTRAR SINIESTRO</h2>

<table id='tablaformato' >

<?php // INICIA BLOQUE DATOS GENERALES ?>

<input type="hidden" name='id_cliente' value="<?php echo $id_cliente; ?>" >
<input type="hidden" name='id_contrato' value="<?php echo $id_contrato; ?>" >

		<tr>
			<th >POLIZA</th>
			<td>
				<input 
				type='text' 
				name='numPoliza' 
				value="<?php echo @$_POST['numPoliza'];?>" 
				placeholder=''  >
			</td>
		</tr>
		
		<tr>
			<th>INCISO</th>
			<td>
				<input 
				type='text' 
				name='numInciso' 
				value="<?php echo @$_POST['numInciso'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>NUMERO DE SINIESTRO</th>
			<td>
				<input 
				type='text' style='text-align: right;'
				name='numSin' 
				value="<?php echo @$_POST['numSin'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>NUMERO DE REPORTE</th>
			<td>
				<input 
				type="text" 
				name='numReporte' 
				value="<?php echo @$_POST['numReporte'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>FECHA Y HORA DE OCURRIDO</th>
			<td>
				<input 
				type="datetime-local"   style='text-align: right;' 
				name='fechaSin' 
				value="<?php echo @$_POST['fechaSin'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>FECHA Y HORA DE REPORTE</th>
			<td>
				<input 
				type="datetime-local"   style='text-align: right;' 
				name='fechaRep' 
				value="<?php echo @$_POST['fechaRep'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>TIPO DE SINIESTRO</th>
			<td>
				<input 
				type="text"  
				name='tipoSin' 
				value="<?php echo @$_POST['tipoSin'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>DONDE OCURRIO</th>
			<td>
				<input 
				type="text"  
				name='domSin' 
				value="<?php echo @$_POST['domSin'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>CIUDAD DEL SINIESTRO</th>
			<td>
				<input 
				type="text"  
				name='cdSin' 
				value="<?php echo @$_POST['cdSin'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>ESTADO DONDE OCURRIO</th>
			<td>
				<select name = 'edoSin' >
				<?php
					$sqlEstados = "SELECT * FROM estadosR";
					$sqlEstadosR = mysqli_query($dbd2, $sqlEstados);				

					while($row = mysqli_fetch_array($sqlEstadosR)) 
					{
					$id_estado 		= $row['id_estado'];
					$descripcion 	= $row['descripcion'];
					echo "<option value='{$id_estado}'>".$descripcion."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th>TALLER ASIGNADO</th>
			<td>
				<input 
				type="text"  
				name='agenciaTaller' 
				value="<?php echo @$_POST['agenciaTaller'];?>" 
				placeholder=''  >
			</td>
		</tr>



		<tr>
			<th style='color:black; background-color: #ff9966;' >CONDUCTOR NOMBRE</th>
			<td>
				<input 
				type="text"  
				name='nomConductor' 
				value="<?php echo @$_POST['nomConductor'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th style='color:black; background-color: #ff9966;' >TELEFONO</th>
			<td>
				<input 
				type="text"  
				name='telCond' 
				value="<?php echo @$_POST['telCond'];?>" 
				placeholder=''  >
			</td>
		</tr>

		<tr>
			<th style='color:black; background-color: #ff9966;' >EDAD</th>
			<td>
				<input 
				type="text"  
				name='edadCond' 
				value="<?php echo @$_POST['edadCond'];?>" 
				placeholder=''  >
			</td>
		</tr>

<tr>
	<td  colspan=2>
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id="gobutton2" type="submit" name="Datos" value="Registrar SINIESTRO"> 
				</td>
			</tr>
		</table>
	</td>
</tr>

</table>



</form>
</fieldset>

<?php } 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<br><table><tr><td>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</td></tr></table><br>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA ?

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>