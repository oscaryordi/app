<?php
include("1header.php");
echo "<meta charset='utf-8'>";



if(@$_POST['id_unidad']){
	$id_unidad = mysqli_real_escape_string($dbd2, $_POST['id_unidad']);
}

if(@$_GET['id_unidad']){
	$id_unidad = mysqli_real_escape_string($dbd2, $_GET['id_unidad']);
}

if($_SESSION["movForaneo"] > 0){  // APERTURA PRIVILEGIOS 
include ("nav_mov.php");

$cantidad_archivos = 1;
datosxid($id_unidad);

?>
<table>
	<tr>
		<td style='background-color: #d2e0e0 ;'>
			<table >
				<tr style='background-color: #d2e0e0 ;'>
					<td></td>
					<td><b>CONSULTAR CLIENTE</b></td>
					<td><b>RESULTADO</b></td>
				</tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Nombre</td>
					<td><input type='text' id='search19'></td>
					<td><div id="result19"></div></td>
				</tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Alias</td>
					<td><input type='text' id='search20'></td>
					<td><div id="result20"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php	

$subido = ''; 
include ("movCD.php");
// FECHA DE MEXICO para utilizarla en lugar de la del servidor
date_default_timezone_set('America/Mexico_city');
$fechareg 		= date("Y-m-d H:i:s");
// FECHA DE MEXICO para utilizarla en lugar de la del servidor

if(isset($_POST['Datos'])){
	
	// MENSAJES DE ERROR
	$error1 = '';
	if(isset($_POST['id_contrato']) && $_POST['id_contrato'] != 0 ){;}else{$error1 = ':: No indico contrato Origen<br>';}
	$error2 = '';
	if(isset($_POST['id_contratoD']) && $_POST['id_contratoD'] != 0){;}else{$error2 = ':: No indico contrato Destino<br>';}
	$error3 = '';
	if($_POST['id_prov']!= 0 ){;}else{$error3= ':: No indico proveedor<br>';}
	$error4 = '';
	if($_POST['estadoO']!= 0 ){;}else{$error4= ':: No indico Estado de Origen<br>';}
	$error5 = '';
	if($_POST['estadoD']!= 0 ){;}else{$error5= ':: No indico Estado de Destino<br>';}
	$error6 = '';
	if($_POST['id_unidad']!= '' && $_POST['id_unidad']!= 0 ){;}else{$error6= ':: No indico Unidad Vehicular';}
	// MENSAJES DE ERROR

	$errorES = $error1.$error2.$error3.$error4.$error5.@$error6;

	if(
		$errorES == '' 
	)
	{
			$id_contrato = mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
			$id_contratoD= mysqli_real_escape_string($dbd2, $_POST['id_contratoD']);
			$folio_inv  = mysqli_real_escape_string($dbd2, $_POST['folio_inv']);
			$facturaT	= mysqli_real_escape_string($dbd2, $_POST['facturaT']);
			$costoT		= mysqli_real_escape_string($dbd2, $_POST['costoT']);
			$id_prov	= mysqli_real_escape_string($dbd2, $_POST['id_prov']);
			$conductor	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['conductor']));

			$motivoM	= mysqli_real_escape_string($dbd2, $_POST['motivoM']);

			$kmO  		= mysqli_real_escape_string($dbd2, $_POST['kmO']);
			$fechaO  	= mysqli_real_escape_string($dbd2, $_POST['fechaO']);
			$horaO  	= mysqli_real_escape_string($dbd2, $_POST['horaO']);
			$ciudadO  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['ciudadO']));
			$cpO  		= mysqli_real_escape_string($dbd2, $_POST['cpO']);

			$estadoO   	= mysqli_real_escape_string($dbd2, $_POST['estadoO']);
			$entregaNO  = strtoupper(mysqli_real_escape_string($dbd2, $_POST['entregaNO'])) ;
			$telO  		= mysqli_real_escape_string($dbd2, $_POST['telO']);

			$kmD  		= mysqli_real_escape_string($dbd2, $_POST['kmD']);
			$fechaD  	= mysqli_real_escape_string($dbd2, $_POST['fechaD']);
			$horaD  	= mysqli_real_escape_string($dbd2, $_POST['horaD']);
			$ciudadD  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['ciudadD']));
			$cpD  		= mysqli_real_escape_string($dbd2, $_POST['cpD']);

			$estadoD   	= mysqli_real_escape_string($dbd2, $_POST['estadoD']);
			$recibeND	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['recibeND'])) ;
			$telD  		= mysqli_real_escape_string($dbd2, $_POST['telD']);

			$falso  	= mysqli_real_escape_string($dbd2, @$_POST['falso']);
			$falso 		+= 0;
			$observaciones  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['observaciones']));


			echo $falso."<br><hr>";

			$capturo = $_SESSION["id_usuario"];

			// QUERY CANDADO NO SE DUPLIQUE
				$sql_existe = "SELECT * FROM mov_traslados 
				WHERE 
				folio_inv = '$folio_inv' 
				AND 
				id_contrato = '$id_contrato' 
				AND 
				id_contratoD = '$id_contratoD' 
				AND 
				id_prov = '$id_prov' 
				AND 
				id_unidad = '$id_unidad' 
				AND 
				fechaO = '$fechaO' 
				AND 
				fechaD = '$fechaD' 
				AND 
				horaD = '$horaD' 
				LIMIT 1 ";
				$sql_existe_resp = mysqli_query($dbd2, $sql_existe );
				if(mysqli_affected_rows($dbd2) > 0)
				{
					$matrizE 	= mysqli_fetch_array($sql_existe_resp);
					$id_movFor 	= $matrizE['id_movFor'];
				}
			// QUERY CANDADO NO SE DUPLIQUE

				if(mysqli_affected_rows($dbd2) == 0) // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
				{
						// INICIA INSERTAR DATOS DE TRASLADO
						$sql_traslado = " INSERT INTO `mov_traslados` 
						(`id_movFor`, `id_contrato`, `id_contratoD`, 
						`id_unidad`, `folio_inv`, 
						`facturaT`, `costoT`, `id_prov`, 
						`conductor`, motivoM, 

						`kmO`, `fechaO`, `horaO`, ciudadO, cpO, `estadoO`, `entregaNO`, `telO`, 
						`kmD`, `fechaD`, `horaD`, ciudadD, cpD, `estadoD`, `recibeND`, `telD`, 
						`capturo`, falso, obs  ) VALUES 

						( NULL, '$id_contrato', '$id_contratoD', 
						'$id_unidad', '$folio_inv', 
						'$facturaT', '$costoT', '$id_prov',
						'$conductor', '$motivoM',

						'$kmO', '$fechaO', '$horaO', '$ciudadO', '$cpO', '$estadoO', '$entregaNO', '$telO', 
						'$kmD', '$fechaD', '$horaD', '$ciudadD', '$cpD', '$estadoD', '$recibeND', '$telD', 
						'$capturo', '$falso', '$observaciones' )
						";
						//echo $sql_traslado;
						$sql_traslado_R = mysqli_query($dbd2, $sql_traslado);
						$id_movForR 	= mysqli_insert_id($dbd2); // OBTIENE EL ID DE ESTA QUERY REALIZADA
						// TERMINA INSERTAR DATOS DE TRASLADO


					// ADJUNTAR ARCHIVO
					if($sql_traslado_R)
					{
						//INICIA comprobamos si se seleccionaron archivos, los cargamos en el servidor
						if (isset($_FILES['archivo']['tmp_name'])) 
						{
							$i=0;
							do  {
									if($_FILES['archivo']['tmp_name'][$i] !="")
									{
										//INICIA VALIDAR FORMATO DE ARCHIVO
										$target_file		= basename($_FILES['archivo']['name'][$i]);
										$subirAutorizado 	= 1;
										$fileType 			= pathinfo($target_file, PATHINFO_EXTENSION);
										// Algoritmo de validacion de extension
										if( $fileType != "png" &&
											$fileType != "jpg" &&
											$fileType != "tiff" &&
											$fileType != "xls" &&
											$fileType != "xlsx" &&
											$fileType != "doc" &&
											$fileType != "docx" &&
											$fileType != "odp" &&
											$fileType != "odg" &&
											$fileType != "pot" &&
											$fileType != "xml" &&
											$fileType != "pdf" &&
											$fileType != "bmp" &&
											$fileType != "gif" &&
											$fileType != "tif" &&
											$fileType != "ods" &&
											$fileType != "jpeg" &&
											$fileType != "odt" &&
											$fileType != "pptx" &&
											$fileType != "pptx" 
										 )	
										{
											echo "Formato de ARCHIVO ANEXADO NO VALIDO!!!";
											$subirAutorizado = 0;
										}
										//TERMINA VALIDAR FORMATO DE ARCHIVO

											// INICIA si el formato es correcto lo copiamos
										if($subirAutorizado == 1)
										{ 
											$fecha 			= time();
											$aleatorio1 	= rand();
											$aleatorio 		= $fecha.'-'.$aleatorio1;
											$nuevonombre 	= $aleatorio.'-'.$_FILES['archivo']['name'][$i];
											$nombreOriginal = $_FILES['archivo']['name'][$i];
											copy($_FILES['archivo']['tmp_name'][$i], '../exp/traslados/'.$rutaz.'/'.$nuevonombre);
										} 
											// TERMINA si el formato es correcto lo copiamos
									}	
								$i++;
								} while ($i < $cantidad_archivos);

								// INICIA SI LA CARGA FUE CORRECTA registramos en base de datos // TIPO 1 COTIZACION , 2 DEPOSITO, 3 FACTURA
								if(file_exists('../exp/traslados/'.$rutaz.'/'.@$nuevonombre) && @$nuevonombre != '')
								{
									
								//$id_estimacion; // DEFINIDA ARRIBA
								$archivo 	= $nuevonombre;
								$tipo 		= 0;//
								$obsD 		= 0;// // OBSERVACIONES DOCUMENTO
								$importeDto = 0;// // importe del DOCUMENTO
								$ruta 		= $rutaz;
								$extension 	= $fileType;
								$tamanio 	= filesize('../exp/traslados/'.$rutaz.'/'.$nuevonombre);
								$nombreO 	= $nombreOriginal;
								//$capturo 	= $_SESSION['id_usuario']; // DEFINIDA ARRIBA
								//$fechareg 	= ''; // DEFINIDA ARRIBA

								//INSERTA EN BD, INICIO, Aqui voy a poner el codigo de inserción a la BD
								//INSERCION EN BASE
								$sqlMovArch = 	"	INSERT INTO `movDocto` 
										(id_docto, id_movFor, archivo, tipo, 
										importeDto,
										obs, ruta, extension, tamanio, 
										nombreO, capturo, fechareg ) 
										VALUES 
										(NULL, '$id_movForR', '$archivo', '$tipo', 
										'$importeDto',
										'$obsD', '$ruta', '$extension', '$tamanio', 
										'$nombreO', '$capturo',  '$fechareg') "; 
								$sqlMovArchR 	= mysqli_query($dbd2, $sqlMovArch ); // conexion dio problemas al definir la correcta
								$sqlMovArchID 	= mysqli_insert_id($dbd2);

									if(!$sqlMovArchR)
									{
										echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL CARGAR ARCHIVO\n";
									}
									else
									{
										echo "<h3>ARCHIVO SUBIDO Y REGISTRADO CORRECTAMENTE $sqlMovArchID (docto) </h3>";
									}
								} // TERMINA SI LA CARGA FUE CORRECTA registramos en base de datos
						} // TERMINA SI EXISTE EL ARCHIVO
					} // TERMINA ADJUNTAR ARCHIVO // ADJUNTAR ARCHIVO


					if($sql_traslado_R)
					{ 
						echo "<h3>INVENTARIO DE TRASLADO REGISTRADO CORRECTAMENTE, BD: $id_movForR (id_M) </h3>";
						echo "<h2><a href='movTrasladoR.php' style='color:red;'>REGISTRAR OTRO</a></h2>";
						$subido = 'ok'	;
						include('trasladoRegistrado.php');
					}
					else
					{
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2) . "\n"; // PARA DETECTAR ERROR EN QUERY
					}
	  			} // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
	  			else
	  			{
	  				echo "<p>Este traslado con folio $folio_inv ya fue registrado ::: BD-> $id_movFor :::</p>";
	  			}
	}
	else
	{
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; <br> $errorES </p>";
	}
}


if($subido!='ok'){
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
 
		$('#search5').keyup(function()
		{
		 var search5 = $('#search5').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search5:search5},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result5').html(data);
					}
				}
			});
		});

		$('#search19').keyup(function()
		{
		 var search19 = $('#search19').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search19:search19},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result19').html(data);
					}
				}
			});
		});

		$('#search20').keyup(function()
		{
		 var search20 = $('#search20').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search20:search20},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result20').html(data);
					}
				}
			});
		});

		$('#search22').keyup(function()
		{
		 var search22 = $('#search22').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search22:search22},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result22').html(data);
					}
				}
			});
		});

		$('#search33').keyup(function()
		{
		 var search33 = $('#search33').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search33:search33},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result33').html(data);
					}
				}
			});
		});

		$('#search23').keyup(function()
		{
		 var search23 = $('#search23').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search23:search23},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result23').html(data);
					}
				}
			});
		});

		$('#search32').keyup(function()
		{
		 var search32 = $('#search32').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search32:search32},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result32').html(data);
					}
				}
			});
		});
 	});
</script>


<fieldset><legend>Registrar Traslado</legend>
<style>
#alta input {min-width:20px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST'  enctype="multipart/form-data" >
	<h2>SOLICITUD DE MANTENIMIENTO</h2>
	<h2>2. REGISTRAR TRASLADO</h2>

<?php
				echo "<h3>
	 				Id en Bd: {$id_unidad}, Economico: {$Economico},
	 				Placas: {$Placas}, Serie: {$Serie}, Tipo: {$Vehiculo}, 
	 				Modelo: {$Modelo} </h3>";
?>

<table id='tablaformato' >
<tr><td colspan=2>

<?php // INICIA BLOQUE DATOS GENERALES ?>

<table style="width:100%;">
		<input type='hidden' name='id_unidad' value="<?php echo $id_unidad;?>" >

		<tr>
			<th style="height: 20px;">ID CONTRATO <span style="color:orange;">ORIGEN</span><br>
				<input type='text' id='search33'>
			</th>
			<td>
					<div id="result33"></div>
			</td>
		</tr>

		<tr style="background-color: #ffe7b3;">
			<th style="height: 20px;">ID CONTRATO <span style="color:#d0e1e1;">DESTINO</span><br>
				<input type='text' id='search32'>
			</th>
			<td>
					<div id="result32"></div>
			</td>
		</tr>

<!-- 
		<tr>
			<th style="height: 20px;">ALIAS CONTRATO NO ENCONTRADO
			</th>
			<td>
				<input type='text' 
				name='aliasEmergente' value="<?php echo @$_POST['aliasEmergente'];?>" placeholder=''  >
			</td>
		</tr> 
-->		
		<tr>
			<th>FOLIO INVENTARIO</th>
			<td>
				<input type='text' 
				name='folio_inv' value="<?php echo @$_POST['folio_inv'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>FOLIO FACTURA</th>
			<td>
				<input type='text' style='text-align: right;'
				name='facturaT' value="<?php echo @$_POST['facturaT'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>COSTO A/I</th>
			<td>
				<input type="number" lang="nb" step=".01" min="0"  style='text-align: right;' 
				name='costoT' value="<?php echo @$_POST['costoT'];?>" placeholder='0.00'  >
			</td>
		</tr>

		<tr>
			<th>PROVEEDOR DEL TRASLADO</th>
			<td>
		
				<select name = 'id_prov' >
					<option value = '0' >---</option>
					<option value = '1' >FENIX SERVICIOS DE TRASLADOS, S.A. DE C.V.</option>
					<option value = '2' >TRASLADOS PREMIER, S.A. DE C.V.</option>
					<option value = '3' >VITAL TRASLADO AUTOMOTRIZ, S.A. DE C.V.</option>
					<option value = '4' >TRASLADOS SHEKINA</option>
					<option value = '14' >TRASLADOS VISA</option>
					<option value = '5' >J.V. CANCUN</option>
					<option value = '6' >J.V. CUERNAVACA</option>
					<option value = '7' >J.V. GUANAJUATO</option>
					<option value = '8' >J.V. JUCHITAN</option>
					<option value = '9' >J.V. QUERETARO</option>
					<option value = '10' >J.V. TULANCINGO</option>
					<option value = '11' >J.V. POZA RICA</option>
					<option value = '12' >OTROS</option>
					<option value = '13' >JET VAN CAR RENTAL, S.A. DE C.V.</option>

				</select>

			</td>
		</tr>

		<tr>
			<th>CONDUCTOR</th>
			<td>
				<input type='text' 
				name='conductor' value="<?php echo @$_POST['conductor'];?>" placeholder='' 
				 size="55" >
			</td>
		</tr>

		<tr>
			<th>MOTIVO DEL MOVIMIENTO</th>
			<td>
				<select name = 'motivoM' >
					<option value = '0' >---</option>
					<option value = '1' >Cambio de patio </option>
					<option value = '2' >Camb​io de proyecto ​por sust.</option>
					<option value = '3' >Cortesía </option>
					<option value = '4' >Integración a proyecto </option>
					<option value = '5' >Recolección </option>
					<option value = '6' >​Resguardo​</option>
					<option value = '7' >Sustituto</option>
					<option value = '8' >Taller o servicio</option>
					<option value = '9' >Termino de proyecto </option>
					<option value = '10' >Verificación </option>
					<option value = '11' >Conversión/equipamiento</option>
					<option value = '12' >​Venta​</option>
					<option value = '13' >Regresa a Proyecto</option>
					<option value = '14' >Reubicación por Dependencia</option>
				</select>

			</td>
		</tr>
</table>

<?php // TERMINA BLOQUE DATOS GENERALES ?>

</td></tr>
<tr><td>


<?php // INICIA BLOQUE DATOS ORIGEN ?>
<table>
		<tr><th colspan=2>ORIGEN</th></tr>
		<tr>
			<th>KILOMETRAJE</th>
			<td>
				<input type="number" lang="nb" step="1" min="0" 
				name='kmO' value="<?php echo @$_POST['kmO'];?>" placeholder='0000'  >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaO' value="<?php 

				if(isset($_POST['fechaO']) &&  $_POST['fechaO'] != ''){echo @$_POST['fechaO'];} else {echo date("Y-m-d");}


				//echo date("Y-m-d");?><?php //echo @$_POST['fechaO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaO' value="<?php 

				if(isset($_POST['horaO']) &&  $_POST['horaO'] != ''){echo @$_POST['horaO'];} else {echo "12:00:00";}
//echo date("h:i:s");

				?>" placeholder=''  >
			</td>
		</tr>

<!--
		<tr>
			<th>DOMICILIO SALIDA</th>
			<td>
				<input type='text' 
				name='domicilioO' value="<?php echo @$_POST['domicilioO'];?>" placeholder=''  >
			</td>
		</tr>
-->

		<tr>
			<th>CIUDAD</th>
			<td>
				<input type='text' 
				name='ciudadO' value="<?php echo @$_POST['ciudadO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>CODIGO POSTAL</th>
			<td>
				<input type='number' 
				name='cpO' value="<?php echo @$_POST['cpO'];?>" placeholder='' 
				step="1" min="0" max="100000"  >
			</td>
		</tr>		

		<tr>
			<th>ESTADO</th>
			<td>
				<select name = 'estadoO' >
				<?php
					$sqlEstados 	= "SELECT * FROM estadosR";
					$sqlEstadosR 	= mysqli_query($dbd2, $sqlEstados);
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
			<th>PERSONA QUE ENTREGA</th>
			<td>
				<input type='text' 
				name='entregaNO' value="<?php echo @$_POST['entregaNO'];?>" placeholder='' >
			</td>
		</tr>

		<tr>
			<th>TELEFONO</th>
			<td>
				<input type='text' 
				name='telO' value="<?php echo @$_POST['telO'];?>" placeholder=''  >
			</td>
		</tr>
</table>
<?php // TERMINA BLOQUE DATOS ORIGEN ?>


</td><td>


<?php // INICIA BLOQUE DATOS DESTINO  ?>
<table>
		<tr><th colspan=2>DESTINO</th></tr>
		<tr>
			<th>KILOMETRAJE</th>
			<td>
				<input type="number" lang="nb" step="1" min="0" 
				name='kmD' value="<?php echo @$_POST['kmD'];?>" placeholder='0000'  >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaD' value="<?php if(isset($_POST['fechaD']) &&  $_POST['fechaD'] != ''){echo @$_POST['fechaD'];} else {echo date("Y-m-d");}?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaD' value="<?php 

				if(isset($_POST['horaD']) &&  $_POST['horaD'] != ''){echo @$_POST['horaD'];} else {echo "12:00:00";}


				?>" placeholder=''  >
			</td>
		</tr>		
<!--
		<tr>
			<th>DOMICILIO LLEGADA</th>
			<td>
				<input type='text' 
				name='domicilioD' value="<?php echo @$_POST['domicilioD'];?>" placeholder=''   >
			</td>
		</tr>
-->

		<tr>
			<th>CIUDAD</th>
			<td>
				<input type='text' 
				name='ciudadD' value="<?php echo @$_POST['ciudadD'];?>" placeholder=''  >
			</td>
		</tr>


		<tr>
			<th>CODIGO POSTAL</th>
			<td>
				<input type='number' 
				name='cpD' value="<?php echo @$_POST['cpD'];?>" placeholder='' 
				step="1" min="0" max="100000"  >
			</td>
		</tr>		



		<tr>
			<th>ESTADO</th>
			<td>
				<select name = 'estadoD' >
				<?php
					$sqlEstados 	= "SELECT * FROM estadosR";
					$sqlEstadosR 	= mysqli_query($dbd2, $sqlEstados);
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
			<th>PERSONA QUE RECIBE</th>
			<td>
				<input type='text' 
				name='recibeND' value="<?php echo @$_POST['recibeND'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>TELEFONO</th>
			<td>
				<input type='text' 
				name='telD' value="<?php echo @$_POST['telD'];?>" placeholder=''  >
			</td>
		</tr>
</table>
<?php // TERMINA BLOQUE DATOS DESTINO  ?>

</td></tr>


<tr>	
	<td colspan="2">
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id='falso' type="checkbox" name="falso" value="1">
					<label for='falso'><b>REGISTRAR FALSO</b></label> 
				</td>
				<td>
				<b>OBSERVACIONES</b>
				</td>
				<td>
				<input type='text' 
				name='observaciones' value="<?php echo @$_POST['observaciones'];?>" placeholder='' maxlength='100'  >
				</td>
			</tr>
		</table>
	</td>
</tr>


<tr>
	<td colspan="2">
		<table style="width:100%;">
		<tr>	
			<th>
				ASIGNACION DE DOCUMENTO
			</th>
			<td colspan="3">
				Puede subir hasta <?=@$cantidad_archivos?> archivo<?=@$plural?> a la vez.
				<input 
				type="file" 
				class="multi max-<?=$cantidad_archivos?>"  
				name="archivo[]" 
				value="<?=$_FILES['archivos']?>">
			</td>
		</tr>
		</table>
	</td>
</tr>


<tr>
	<td  colspan=2>
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id="gobutton2" type="submit" name="Datos" value="GUARDAR"> 
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
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</td></tr></table><br>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA ?

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>