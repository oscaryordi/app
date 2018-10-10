<?php
include("1header.php");
echo "<meta charset='utf-8'>";
 
if($_SESSION["mttoSol"] > 1){  // APERTURA PRIVILEGIOS 1 VER 2 CREAR 

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

$id_unidad 		= mysqli_real_escape_string($dbd2, $_GET['id_unidad'] );
$id_cliente 	= mysqli_real_escape_string($dbd2, $_GET['id_cliente'] );
$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato'] );

unidadAsignacion($id_unidad);
$id_clienteM 	= $id_cliente;
$id_contratoM 	= $id_contrato;

echo "$id_cliente - $id_contrato <br>";

datosxid($id_unidad);
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

		<td style='background-color: #d2e0e0 ;'>
			<table >
				<tr style='background-color: #d2e0e0 ;'><td>Referencia rápida</td><td><b>CONSULTAR PROVEEDOR</b></td><td><b>RESULTADO</b></td></tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Nombre</td>
					<td><input type='text' id='search24'></td>
					<td><div id="result24"></div></td>
				</tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Alias</td>
					<td><input type='text' id='search25'></td>
					<td><div id="result25"></td></tr>
			</table>
		</td>

	</tr>
</table>   
<?php
include ("mttoSolCreaDir.php"); // Se obtiene la ruta y la crea si no existe

$cantidad_archivos = 1; //la cantidad máxima de archivos que se permitirá enviar.

$subido = ''; // CONDICION PARA MOSTRAR FORMULARIO

if(isset($_POST['DatosM']))
	{
		$haytipo = 	1 + @$_POST['preventivo']+
					 @$_POST['frenos']+
					 @$_POST['susp']+
					 @$_POST['dir']+

					 @$_POST['clima']+
					 @$_POST['motor']+
					 @$_POST['enfria']+
					 @$_POST['transmision']+

					 @$_POST['llantas']+
					 @$_POST['hojalateria']+
					 @$_POST['electrico']+
					 @$_POST['electron']+

					 @$_POST['deducible'];

		@$reembolso = @$_POST['reembolso']+0;
		@$id_cuenta = @$_POST['id_cuenta'];

		$siga = 1;

		$msgFile 	= '';
		$msgCta 	= '';

		if($reembolso == 1){ // EVALUA LOS PARAMETROS NECESARIOS EN CASO DE REEMBOLSO
			if(!$_POST['nombreR'])	{$siga += 1;}
			if(!$_POST['clabeR'])	{$siga += 1;}
			if(!$_POST['bancoR'])	{$siga += 1;}
			if( $_FILES['archivo']['tmp_name'][0] !="" )
				{	echo "ok";}
			else{	$siga += 1; 
					$msgFile = ', Es obligatorio subir FACTURA para tramitar reembolso';
				}
		}

		if($_POST['id_prov'] == 0){$siga += 1;} // FRENA CARGA SI EL PROVEEDOR NO TIENE DATO

		if($haytipo == 1){$siga += 1;} // FRENA CARGA SI NO SE HA DEFINIDO UN TIPO

		if($reembolso == 1){ $id_cuenta = '0';} // CUANDO ES REEMBOLSO LA CUENTA DEL PROVEEDOR SE VACIA
		else{ @$id_cuenta 	=mysqli_real_escape_string($dbd2, $_POST['id_cuenta'] );}

		// INICIA VALIDAR QUE CUENTA REALMENTE CORRESPONDE AL PROVEEDOR ELEGIDO	
		if($siga == 1 AND $reembolso != 1){
			provCtaxid($id_cuenta);
			if($_POST['id_prov'] != $PCid_prov){ $siga += 1 ; $msgCta = '::: LA CUENTA NO CONCIDE CON LOS REGISTROS DEL PROVEEDOR ::: ';} // PARA FRENAR REGISTRO INCORRECTO
		}
		// TERMINA VALIDAR QUE CUENTA REALMENTE CORRESPONDE AL PROVEEDOR ELEGIDO


		if($_POST['km']!='' 
		&& $_POST['importe']!='' 
		&& $_POST['concepto']!='' 
		&& @$_POST['id_prov']!='' 
		&& $id_cuenta !='' 
		&& $siga == 1 
		)
			{
			   	// INICIA limpiar y validad variables
			   	$importe 	= mysqli_real_escape_string($dbd2, $_POST['importe'] );
				$concepto   = strtoupper(mysqli_real_escape_string($dbd2, $_POST['concepto'] )) ;
				$km  		= mysqli_real_escape_string($dbd2, $_POST['km'] );
				$obs 		= strtoupper(mysqli_real_escape_string($dbd2, $_POST['obs'] )) ;

				$id_prov 	= mysqli_real_escape_string($dbd2, $_POST['id_prov'] );

				$id_sucursal = mysqli_real_escape_string($dbd2, $_POST['id_sucursal'] );

				@$preventivo 	= @$_POST['preventivo']+0;
				@$frenos 		= @$_POST['frenos']+0;
				@$susp 			= @$_POST['susp']+0;
				@$dir 			= @$_POST['dir']+0;

				@$clima 		= @$_POST['clima']+0;				
				@$motor 		= @$_POST['motor']+0;
				@$enfria 		= @$_POST['enfria']+0;
				@$transmision 	= @$_POST['transmision']+0;

				@$llantas 		= @$_POST['llantas']+0;
				@$hojalateria 	= @$_POST['hojalateria']+0;
				@$electrico 	= @$_POST['electrico']+0;
				@$electron 		= @$_POST['electron']+0;

				@$deducible 	= @$_POST['deducible']+0;

				$capturo	   	= $_SESSION["id_usuario"];
				$supPago 		= $_SESSION["supPago"];
				$externo 		= $_SESSION["externo"];


				// TIENE CREDITO
				provTieneCredito($id_prov); 
				if($credito == 1){$supPago = '898';} // si tiene credito lo ve Mary

				if($id_contrato == 29){$supPago = '121';} // si es pemex lo ve dulce
				if($id_contrato == 260){$supPago = '121';} // si es pemex lo ve dulce



				@$reembolso 	= @$_POST['reembolso']+0;
				$rbolso = 0;

				if($reembolso == 1)
				{
					$nombreR 	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['nombreR'] )) ;
					$clabeR   	= mysqli_real_escape_string($dbd2, $_POST['clabeR'] );
					$cuentaR  	= mysqli_real_escape_string($dbd2, $_POST['cuentaR'] );
					$sucR   	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['sucR'] )) ;
					$bancoR  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['bancoR'] )) ;
					$rbolso = 1;
				}
				// TERMINA limpiar y validad variables


				// INICIA VALIDAR QUE NO HAYA DUPLICIDAD
					$sql_id_mttoSol = "	SELECT id_mttoSol 
										FROM mttoSol 
										WHERE 
										id_unidad 	= '$id_unidad' 		AND 
										id_contrato = '$id_contrato' 	AND 
										id_prov 	= '$id_prov' 		AND 
										importe 	= '$importe' 		AND 
										km 			= '$km' ";
					$sql_id_mttoSol_R = mysqli_query($dbd2, $sql_id_mttoSol);
					$proceder = 0;
					if(mysqli_affected_rows($dbd2) == 0){	$proceder = 1;}
				// TERMINA VALIDAR QUE NO HAYA DUPLICIDAD


				########## ########## ######### AQUI EMPIEZA LA FIESTA
				if($proceder === 1)
				{ // INICIA si no esta duplicado le damos PALANTE 
					date_default_timezone_set('America/Mexico_city');
					//$fechaEj = date("Y-m-d H:i:s",time()+2*60*60);
					$fechaEj = date("Y-m-d H:i:s");
					// INICIA insertar solicitud en tabla mttoSol
					$sql_mttoSol = "INSERT INTO mttoSol (
					id_mttoSol, id_unidad, id_cliente, id_contrato, 
					fechaEj, supPago,
					concepto, importe, km, obs, 
					id_prov, id_prov_c, id_prov_s, 
					capturo, externo, rbolso, 
					t1, t2, t3, t4, 
					t5, t6, t7, t8, 
					t9, t10, t11, t12, t13
					) 
					VALUES ( 
					NULL, '$id_unidad','$id_cliente','$id_contrato',
					'$fechaEj', '$supPago', 
					'$concepto','$importe','$km','$obs',
					'$id_prov','$id_cuenta','$id_sucursal',
					'$capturo', '$externo', '$rbolso',
					'$preventivo','$frenos','$susp','$dir',
					'$clima','$motor','$enfria','$transmision',
					'$llantas','$hojalateria','$electrico','$electron', '$deducible'
					)";
					$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
					$id_mttoSol 	= mysqli_insert_id($dbd2); // ESTE PARECE SER EL METODO MAS EFECTIVO DE OBTENER EL ULTIMO ID
					// TERMINA insertar solicitud en tabla mttoSol

					if(!$sql_mttoSol_R) // SI NO HAY FALLA AL REGISTRAR
						{
							echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR LA SOLICITUD \n";
						}
					else{ // SI NO HUBO FALLA MUESTRA MENSAJE DE REGISTRO EXITOSO Y ACTUALIZA TABLA DE KILOMETRAJES
							// INICIO ACTUALIZAR TABLA KILOMETRAJESH
							if($id_unidad !== '' AND $km !== '' )
							{
								date_default_timezone_set('America/Mexico_city');
								$sql_kmH = "INSERT INTO kmH 
											(id_km, id_unidad, km, capturo) 
											VALUES 
											(null, '$id_unidad', '$km', '$capturo')";
								$sql_kmH_R = mysqli_query($dbd2, $sql_kmH );
							}// TERMINA ACTUALIZAR TABLA KILOMETRAJESH

							echo "<h2>REGISTRO DE SOLICITUD EXITOSO CON ID 
									<span style='color:red;'>$id_mttoSol</span> 
								  </h2>
								  <h4><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  target='blank' >
								  VER FORMATO</a>
								  </h4>";
							// SE DESCONECTA PUES ESTE FORMULARIO ES PARA CAPTURAR LO QUE YA SE PAGO
							/*if($id_prov == 81 && ($id_prov_s == 74 or $id_prov_s == 75 or $id_prov_s == 0  or $id_prov_s == '' ) )
							{
								include('mttoSolTallerMttoCnct.php');
							}
							*/
						}

					//echo "<BR> ULTIMO ID FORMULA DIRECTA: $id_mttoSol_FA , CON QUERY Y TODO EL ROLLO: $id_mttoSol <BR>";

					// INICIA capturar datos reembolso
					if($reembolso == 1)
					{
						$sql_reembolso = " INSERT INTO mttoSolRemb 
											(id_reembolso, id_mttoSol, nombreR, clabeR, cuentaR, sucR, bancoR) 
											VALUES 
											( NULL,   
										'$id_mttoSol', '$nombreR','$clabeR','$cuentaR','$sucR','$bancoR'
										)";
						$sql_reembolso_R = mysqli_query($dbd2, $sql_reembolso);
						if(!$sql_reembolso_R)
						{
							echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2)
							. " FALLO AL REGISTRAR DATOS DE REEMBOLSO \n";
						}
						else
						{
							echo "<h3>REGISTRO DE REEMBOLSO EXITOSO</h3>";
						}
					}
					// TERMINA capturar datos reembolso


					// SI SE REGISTRO LA SOLICITUD PROCEDEMOS A INTENTAR SUBIR EL ARCHIVO
					
					// INICIA PROCESO DE CARGA DE ARCHIVO	
					if($sql_mttoSol_R)
					{	
						//INICIA comprobamos si se seleccionaron archivos, los cargamos en el servidor
						if (isset($_FILES['archivo']['tmp_name'])) 
							{
								$i=0;
								do  {
										if($_FILES['archivo']['tmp_name'][$i] !="")
										{
											//INICIA VALIDAR FORMATO DE ARCHIVO
											$target_file	= basename($_FILES['archivo']['name'][$i]);
											$subirAutorizado = 1;
											$fileType 		= pathinfo($target_file, PATHINFO_EXTENSION);
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
													 )	{
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
											copy($_FILES['archivo']['tmp_name'][$i], '../exp/mtto/'.$rutaz.'/'.$nuevonombre);
											} 
											// TERMINA si el formato es correcto lo copiamos
										}	
										$i++;
									} while ($i < $cantidad_archivos);

								// INICIA SI LA CARGA FUE CORRECTA registramos en base de datos // TIPO 1 COTIZACION , 2 DEPOSITO, 3 FACTURA
								if(file_exists('../exp/mtto/'.$rutaz.'/'.@$nuevonombre) && @$nuevonombre != '')
								{
									$tipo = 1;
									if($reembolso == 1){$tipo = 3;}

									$sql_mttoSol_Cot = "INSERT INTO mttoDocto 
														(id_docto, id_mttoSol, archivo, tipo, ruta, 
														id_capturo, fechareg) 
														VALUES (
														NULL, '$id_mttoSol', '$nuevonombre', '$tipo', '$rutaz', 
														'$capturo', CURRENT_TIMESTAMP 
														)";
									$sql_mttoSol_Cot_R = mysqli_query($dbd2, $sql_mttoSol_Cot);
									
											// INICIO ACTUALIZAR INDICAR TIPO DE DOCUMENTO SUBIDO
											$tipoActualizar;
											switch($tipo)
											{
												case "1":
													$tipoActualizar = ' dC1 = 1 ';
													break;
												case "3":
													$tipoActualizar = ' facturado = 1, rbolso = 1 ';
													break;
										 		default:
													;
											}
											$sql_mS_tipoDoc = " UPDATE mttoSol SET ";
											$sql_mS_tipoDoc .= $tipoActualizar;
											$sql_mS_tipoDoc .= " WHERE id_mttoSol =  '$id_mttoSol' ";
											$tipoDoc_R = mysqli_query($dbd2, $sql_mS_tipoDoc);
											if($tipoDoc_R)
												$mttoSolUpR = "Update OK ".mysqli_affected_rows($dbd2)." ";
											else
												$mttoSolUpR = "Update Failed: ".mysqli_error($dbd2);
											// TERMINA ACTUALIZAR INDICAR TIPO DE DOCUME'NTO SUBIDO

									if(!$sql_mttoSol_Cot_R)
									{
										echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2)
										. " FALLO AL CARGAR ARCHIVO DE COTIZACIÓN $mttoSolUpR \n";
									}
									else
									{
										echo "<h3>ARCHIVO DE COTIZACIÓN SUBIDO Y REGISTRADO CORRECTAMENTE $mttoSolUpR </h3>";
									}
								} // TERMINA SI LA CARGA FUE CORRECTA registramos en base de datos
													
							} //TERMINA comprobamos si se seleccionaron archivos, los cargamos en el servidor
					} // TERMINA PROCESO DE CARGA DE ARCHIVO
				}// TERMINA  si no esta duplicado le damos PALANTE
				else
				{
					echo "<p style='background-color:#FFFF99; color:blue;'>
							El servicio ya ha sido solicitado previamente, favor de verificar.
						  </p>";
				}

// MOSTRAR VARIABLES PARA CONTROL DEL PROCESO
/*
				echo $importe.",".$concepto.",km".$km
				.",<br> P".$id_prov.",Pc".$id_cuenta.",Ps".$id_sucursal
				.",<br>Un".$id_unidad.",Cte".$id_cliente.",Cto".$id_contrato
				.",<br>b1".$preventivo.",".$frenos.",".$susp.",".$dir
				.",<br>b2".$clima.",".$motor.",".$enfria.",".$transmision
				.",<br>b3".$llantas.",".$hojalateria.",".$electrico.",".$electron
				.",<br>USR".$capturo 
				.",<br> R".$reembolso.",nR".$nombreR.",cR".$clabeR.",ctR".$cuentaR.",sR".$sucR.",bR".$bancoR
				.",<br> aN-".$nuevonombre.",aN".$rutaz
				;
*/
				$subido = 'ok'	;
			}
		else
		{	
			echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos , 
			SE DEBE INDICAR PROVEEDOR, 
			UNA CUENTA VÁLIDA Y 
			EL TIPO DE MANTENIMIENTO, en caso de REEMBOLSO nombre, cuenta y banco ... &#9786; $msgFile $msgCta</p>";
		}
	}  

if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>

<style>
	.cuadrotiposervicio, label {font-size: .8em;}
	.cuadrotiposervicio, select {font-size: 1em;}
	.cuadrotiposervicio, option {font-size: 1em;}
	.checkST {font-size: .8em;}
	#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
		 $('#search14').keyup(function()
		{
		 var search14 = $('#search14').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search14:search14},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result14').html(data);
					}
				}
			});
		});


	$('#hasPets').on('change', function(){
		if($(this).is(':checked')){
			$('#pets-row').show();
		}
		else{
			$('#pets-row').hide();
		}
	});
	$('#hasPets').trigger('change');



 	$('#search24').keyup(function()
		{
		 var search24 = $('#search24').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search24:search24},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result24').html(data);
					}
				}
			});
		});

 	$('#search25').keyup(function()
		{
		 var search25 = $('#search25').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search25:search25},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result25').html(data);
					}
				}
			});
		});

	
	 });
</script>
<?php // FUNCION BUSCA SUCURSAL POR EL VALOR DEL ID_PROVEEDOR IGUALMENTE OBTIENE LAS CUENTAS BANCARIAS ?>
<script>
 function buscaSucursal()
		{
		 var search15 = $('#search15').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search15:search15},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result15').html(data);
					}
				}
			});
		};
</script>

<?php if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} ?>

<fieldset><legend><b>FORMULARIO</b></legend>

<form action="" method="POST"  enctype="multipart/form-data" >
	
	<h2 style="color:red;">FORMATO PARA RECUPERAR INFORMACIÓN DE MANTENIMIENTO PAGADO</h2>
	<h3 style="color:blue;">SE CAPTURARAN SOLO LOS SERVICIOS PAGADOS</h3>
<table>


<tr>
	<th>FOLIO DE SOLICITUD</th>
	<td>
		<input type="number" name="id_mttoSol" min="" max="" step="1" required="yes">

	</td>
</tr>

<tr>
	<th>TIPO DE SERVICIO

	<input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>" placeholder="Unidad" disabled >
	<input type="hidden" name="id_contrato"  value="<?php echo $id_cliente;?>" placeholder="Contrato" disabled >
	<input type="hidden" name="id_cliente"  value="<?php echo $id_contrato;?>" placeholder="Cliente" disabled >


	</th>
	<td>
		<table id='cuadrotiposervicio'>
		<tr>
			<td>
			<input type="checkbox" id="preventivo" name="preventivo" class = 'checkST' value="1" >
			<label for = "preventivo" >PREVENTIVO</label>
			</td><td>
			<input type="checkbox" id="frenos" name="frenos"  class = 'checkST' value="1">
			<label for = "frenos" >FRENOS</label>
			</td><td>
			<input type="checkbox" id="susp" name="susp"  class = 'checkST' value="1" >
			<label for = "susp" >SUSPENSION</label>
			</td><td>
			<input type="checkbox" id="dir" name="dir"  class = 'checkST' value="1" >
			<label for = "dir" >DIRECCION</label>
			</td>

			<td>
			<input type="checkbox" id="deducible" name="deducible"  class = 'checkST' value="1" >
			<label for = "deducible" ><span style='color:red;'>DEDUCIBLE</span></label>
			</td>

		</tr><tr>
			<td>
			<input type="checkbox" id="clima" name="clima"  class = 'checkST' value="1" >
			<label for = "clima" >CLIMA</label>
			</td><td>
			<input type="checkbox" id="motor" name="motor"  class = 'checkST' value="1" >
			<label for = "motor" >MOTOR</label>
			</td><td>
			<input type="checkbox" id="enfria" name="enfria"  class = 'checkST' value="1" >
			<label for = "enfria" >ENFRIAMIENTO</label>
			</td><td>
			<input type="checkbox" id="transmision" name="transmision"  class = 'checkST' value="1" >
			<label for = "transmision" >TRANSMISION</label>
			</td>
			<td></td>
		</tr><tr>
			<td>
			<input type="checkbox" id="llantas" name="llantas"  class = 'checkST' value="1" >
			<label for = "llantas" >LLANTAS</label>
			</td><td>
			<input type="checkbox" id="hojalateria" name="hojalateria"  class = 'checkST' value="1" >
			<label for = "hojalateria" >HOJALATERIA</label>
			</td><td>
			<input type="checkbox" id="electrico" name="electrico"  class = 'checkST' value="1" >
			<label for = "electrico" >ELECTRICO</label>
			</td><td>
			<input type="checkbox" id="electron" name="electron"  class = 'checkST' value="1" >
			<label for = "electron" >ELECTRONICO</label>
			</td>
			<td></td>
		</tr>




		</table>	
	</td>
</tr>
<tr>
	<th>KILOMETRAJE
	</th>
	<td>
	<input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="" placeholder="0000" required style="text-align: right;" > 0000
	</td>
</tr>
<tr>
<tr>
	<th>IMPORTE IVA INCLUIDO
	</th>
	<td>
		<b>$</b><input type="number" lang="nb" step="0.01" min="0" name="importe" value="<?php echo @$_POST['cuenta']; ?>"  required style="text-align: right;" max='200000' > 0000.00 sin comas
	</td>
</tr>


<?php  /////////////////////////////////////////////INICIA CUENTA CARACTERES ?>
	<script>
		function cuenta2()
		{
			document.getElementById("conceptoCTA").value=document.getElementById("concepto").value.length	
		}
	</script>
<tr>
	<th>DESCRIPCION/CONCEPTO</th>
	<td>
		<textarea name="concepto" id="concepto" 
		onKeyDown="cuenta2()" onKeyUp="cuenta2()" cols="50" rows="1" 
		value="<?php //echo $cuenta; ?>"  maxlength='350' required ></textarea><br>
		Máximo 250 caracteres
		<input type='text' id='conceptoCTA' name='conceptoCTA' size='4' disabled >
	</td>
</tr>	
<?php  /////////////////////////////////////////////TERMINA CUENTA CARACTERES ?>

<tr>
	<th>OBSERVACIONES</th>
	<td>
		<textarea name="obs"  cols="50" rows="1" 
		value="<?php //echo $cuenta; ?>"  maxlength='250' ></textarea><br>
		Máximo 250 caracteres
	</td>
</tr>



	<tr style='height: 7.5em;'><th>PROVEEDOR</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search14' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result14"></div>
			<div id="result15"></div>
		</td>
	</tr>




<?php // INICIO DATOS PARA REEMBOLSO ?>

<tr>
	<th>
		<label>REEMBOLSO</label>
		<input type="checkbox" id="hasPets" name="reembolso"  value="1" />
	</th>   
	<td>
		<div id="pets-row">
		<table>
			<tr>
				<td colspan='2'>Llenar los siguientes datos:  </td>
			</tr><tr>
				<td><label for = "nombreR">NOMBRE:</label></td>
				<td><input type='text' id="pet" name="nombreR" >Obligatorio</td>
			</tr><tr>
				<td><label for = "clabeR">CLABE-:</label></td><td>
				<input type='number' id="pet" name="clabeR" >Obligatorio</td>
			</tr><tr>
				<td><label for = "cuentaR">CUENTA:</label></td><td>
				<input type='number' id="pet" name="cuentaR" > </td>
			</tr><tr>
				<td><label for = "sucR">SUCURSAL:</label></td><td>
				<input type='text' id="pet" name="sucR" ></td>
			</tr><tr>
				<td><label for = "bancoR">BANCO-:</label></td><td>
				<input type='text' id="pet" name="bancoR" >Obligatorio</td>
			</tr>
		</table>
		</div>
	</td>
</tr>

<?php // TERMINA DATOS PARA REEMBOLSO ?>



<?php // INICIO CARGA DE COTIZACION ?>

<tr><th>
			ANEXAR COTIZACION <BR>FACTURA EN CASO<BR> DE REEMBOLSO
</th><td>
				Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
			<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
</td></tr>

<?php // TERMINA CARGA DE COTIZACION ?>


 <tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="DatosM" value="Registrar Mantenimiento"> 
	</td>
</tr>


</table>
</form>

</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO
include ("u8mtto.php");  
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad' id='gobutton2' >
		</FORM>
		</p>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 
 } // CIERRE PRIVILEGIOS 
 include ("1footer.php"); ?>