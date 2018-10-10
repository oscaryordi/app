<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["mttoSol"] > 1){  // APERTURA PRIVILEGIOS 1 VER 2 CREAR 

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');


$id_mttoSol 	= $_GET['id_mttoSol'];
$pagina 		= $_GET['pagina'];   // PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE

$sql_mttoSol 	= "	SELECT * FROM `mttoSol` 
					WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_R 	= mysql_query($sql_mttoSol);
@$sql_mttoSol_M = mysql_fetch_array($sql_mttoSol_R);


@$id_unidad 	=	$sql_mttoSol_M['id_unidad'];
@$id_cliente 	=	$sql_mttoSol_M['id_cliente'];
@$id_contrato 	=	$sql_mttoSol_M['id_contrato'];
@$fechaEj		=	$sql_mttoSol_M['fechaEj'];
@$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
@$importe 		=	$sql_mttoSol_M['importe'];
@$km 			= 	$sql_mttoSol_M['km'];
@$obs 			=	strtoupper($sql_mttoSol_M['obs']);
@$id_provA 		= 	$sql_mttoSol_M['id_prov'];
@$id_prov_cA	= 	$sql_mttoSol_M['id_prov_c'];
@$id_prov_sA	= 	$sql_mttoSol_M['id_prov_s'];
@$capturo 		=	$sql_mttoSol_M['capturo'];
@$autorizadoS 	=	$sql_mttoSol_M['autorizadoS'];
@$pagado 		= 	$sql_mttoSol_M['pagado']; // tiene deposito

//@$deducible 	= 	$sql_mttoSol_M['deducible'];

$t1ckd 	= $sql_mttoSol_M['t1'];
$t2ckd 	= $sql_mttoSol_M['t2'];
$t3ckd 	= $sql_mttoSol_M['t3'];
$t4ckd 	= $sql_mttoSol_M['t4'];
$t5ckd 	= $sql_mttoSol_M['t5'];
$t6ckd 	= $sql_mttoSol_M['t6'];
$t7ckd 	= $sql_mttoSol_M['t7'];
$t8ckd 	= $sql_mttoSol_M['t8'];
$t9ckd 	= $sql_mttoSol_M['t9'];
$t10ckd = $sql_mttoSol_M['t10'];
$t11ckd = $sql_mttoSol_M['t11'];
$t12ckd = $sql_mttoSol_M['t12'];
$t13ckd = $sql_mttoSol_M['t13'];

if($t1ckd == 1){ $t1ckd = 'checked';} else {$t1ckd = '';}
if($t2ckd == 1){ $t2ckd = 'checked';} else {$t2ckd = '';}
if($t3ckd == 1){ $t3ckd = 'checked';} else {$t3ckd = '';}
if($t4ckd == 1){ $t4ckd = 'checked';} else {$t4ckd = '';}
if($t5ckd == 1){ $t5ckd = 'checked';} else {$t5ckd = '';}
if($t6ckd == 1){ $t6ckd = 'checked';} else {$t6ckd = '';}
if($t7ckd == 1){ $t7ckd = 'checked';} else {$t7ckd = '';}
if($t8ckd == 1){ $t8ckd = 'checked';} else {$t8ckd = '';}
if($t9ckd == 1){ $t9ckd = 'checked';} else {$t9ckd = '';}
if($t10ckd == 1){ $t10ckd = 'checked';} else {$t10ckd = '';}
if($t11ckd == 1){ $t11ckd = 'checked';} else {$t11ckd = '';}
if($t12ckd == 1){ $t12ckd = 'checked';} else {$t12ckd = '';}
if($t13ckd == 1){ $t13ckd = 'checked';} else {$t13ckd = '';}


datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
proveedorxid($id_provA);
provCtaxid($id_prov_cA);
reembxid($id_mttoSol);



$arrayviejo = 'importe  = '.$importe.',
				concepto = '.$concepto.',
				km 	= '.$km.',
				id_prov = '.$id_provA.',
				id_prov_c = '.$id_prov_cA.',
				obs = '.$obs.',
				t1 	='.$t1ckd.', 
				t2 	='.$t2ckd.', 
				t3 	='.$t3ckd.', 
				t4 	='.$t4ckd.', 
				t5 	='.$t5ckd.', 
				t6 	='.$t6ckd.', 
				t7 	='.$t7ckd.', 
				t8 	='.$t8ckd.', 
				t9 	='.$t9ckd.', 
				t10 ='.$t10ckd.', 
				t11 ='.$t11ckd.', 
				t12 ='.$t12ckd.', 
				t13 ='.$t13ckd.' 
				WHERE id_mttoSol = '.$id_mttoSol;


$id_usuario 	= $_SESSION["id_usuario"];
contratosDelEjecutivo($id_usuario);
$leCorresponde 	= in_array($id_contrato, $contratosArray);

// INICIA TE CORRESPONDE
if($capturo == $_SESSION["id_usuario"] OR $_SESSION["mttoSol"] > 3 OR $leCorresponde == true ){

echo "<h2><span style='color:blue;' >EDITAR SOLICITUD DE MANTENIMIENTO</span></h2>";
?>

<table>
	<tr>
		<td>
			
			<b>SOLICITUD DE CHEQUE</b>
			<br>Folio: 
			<?php echo $id_mttoSol; ?>
			<br>Fecha: 
			<?php echo $fechaEj;?>
			
		</td>
		<td>
			
			<b>PROYECTO-CLIENTE</b>  
			<br>Cliente:
			<?php echo   $razonSocial;?>
			<br>Contrato:
			<?php echo "id ::: ".$id_alan." ::: ".$numero;?>
			
		</td>
	</tr>
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
	</tr>
	<tr>
		<td style='vertical-align: top;'>
			
			<b>PROVEEDOR ACTUAL</b> 
			 <br>Razon Social:  
			<?php  if($esreembolso == 1){echo "REEMBOLSO :  $nombreR ";}else{echo "&nbsp". $PrazonSocial;} // PROVEEDOR ?>
			 <br>RFC:  
			<?php  if($esreembolso == 1){echo " &nbsp; Facturado por : $Prfc :::  $PrazonSocial ";}else{echo "&nbsp". $Prfc;} // PROVEEDOR ?>
			
		</td>
		<td>
 
			<b>DATOS PARA PAGO ACTUALES</b> 
			<br>Nombre: 
			<?php echo "&nbsp". $nombreR; // REEMBOLSO ?>
			<br>Clabe: 
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCclabe;} // PROVEEDOR ?>
			<?php echo "&nbsp". $clabeR; // REEMBOLSO ?>
			<br>Cuenta:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCcuenta;} // PROVEEDOR ?>
			<?php echo "&nbsp". $cuentaR; // REEMBOLSO ?>
			<br>Sucursal:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCsucursal;} // PROVEEDOR ?>
			<?php echo "&nbsp". $sucR; // REEMBOLSO ?>
			<br>Banco:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCbanco;} // PROVEEDOR ?>
			<?php echo "&nbsp". $bancoR; // REEMBOLSO ?>
 
		</td>
	</tr>
</table>

<?php 

//include ("mttoSolCreaDir.php"); // Se obtiene la ruta y la crea si no existe

$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.

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

 //	   @$reembolso = @$_POST['reembolso']+0;
 //	   @$id_cuenta = @$_POST['id_cuenta'];

		$siga = 1;

/*	   if($reembolso == 1){
			if(!$_POST['nombreR']){$siga += 1;}
			if(!$_POST['clabeR']){$siga += 1;}
			if(!$_POST['bancoR']){$siga += 1;}
		}
*/ 
		if($haytipo == 1){$siga += 1;}

		$cambio = 0;

		if($concepto != strtoupper($_POST['concepto']))	{$cambio += 1;}
		if($importe != $_POST['importe'])	{$cambio += 1;}
		if($km 		!= $_POST['km'])		{$cambio += 1;}
		if($obs 	!= strtoupper($_POST['obs']))	{$cambio += 1;}
		
		if(isset($_POST['id_prov'])){
			if($id_provA != @$_POST['id_prov'])		{$cambio += 1;}
		}

		echo "cuenta".@$_POST['id_cuenta']."cuenta<br>";

		if(isset($_POST['id_cuenta'])){
			if($id_prov_cA != @$_POST['id_cuenta'])		{$cambio += 1;}
		}

		echo "<br>CAMBIO $cambio <br>";
		$nosehace = 0;
		if($cambio == 0){$nosehace = 1; }
		
		$concluido = '';
		if($autorizadoS == 1 OR $pagado > 0 ){$siga += 1; $concluido = 'No se puede editar ya fue pagado';}

		$siga += $nosehace;

/*		if($reembolso == 1){
			$id_cuenta = '0';
		}
		else
		{
			@$id_cuenta 	=mysql_real_escape_string($_POST['id_cuenta'],$conectar);
		}	
*/
		echo "<br>SIGA $siga<br>";
		echo "<br>proveedor ".@$_POST['id_prov']."<br>";
		echo "<br>cuenta ".@$_POST['id_cuenta']."<br>";
		// INICIA VALIDAR QUE CUENTA REALMENTE CORRESPONDE AL PROVEEDOR ELEGIDO	
		if($siga == 1 )
		{ // NO VALIDA QUE SEA REEMBOLSO
		   	provCtaxid(@$_POST['id_cuenta']);
		   	if(@$_POST['id_prov'] != $PCid_prov){ $siga += 1 ; $msgCta = '::: LA CUENTA NO CONCIDE CON LOS REGISTROS DEL PROVEEDOR ::: ';} // PARA FRENAR REGISTRO INCORRECTO
		}
		// TERMINA VALIDAR QUE CUENTA REALMENTE CORRESPONDE AL PROVEEDOR ELEGIDO

	   echo "<br>SIGA $siga<br>";

		if($_POST['km']!='' 
		&& $_POST['importe']!='' 
		&& $_POST['concepto']!='' 
 //	   && @$_POST['id_prov']!='' 
 //	   && $id_cuenta !='' 
		&& $siga == 1 
		)
			{		
			   	// INICIA limpiar y validad variables
			   	$importe 	=mysql_real_escape_string($_POST['importe'],$conectar);
				$concepto   =strtoupper(mysql_real_escape_string($_POST['concepto'],$conectar)) ;
				$km  		=mysql_real_escape_string($_POST['km'],$conectar);
				$obs 		=strtoupper(mysql_real_escape_string($_POST['obs'],$conectar)) ;



				@$id_sucursal =mysql_real_escape_string($_POST['id_sucursal'],$conectar);


			   // @$id_prov 	=mysql_real_escape_string($_POST['id_prov'],$conectar);

				if(isset($_POST['id_prov'])){
					if($id_provA != @$_POST['id_prov'])
					{
						@$id_prov 	=mysql_real_escape_string($_POST['id_prov'],$conectar);
					}
					else
					{
						$id_prov 	= $id_provA;
					}
				}
				else
				{
					$id_prov 	= $id_provA;
				}
				echo "PROVEEDOR".@$id_prov;





				if(isset($_POST['id_cuenta'])){
					if($id_prov_cA != @$_POST['id_cuenta'])
					{
						@$id_prov_c 	=mysql_real_escape_string($_POST['id_cuenta'],$conectar);
					}
					else
					{
						$id_prov_c 	= $id_prov_cA;
					}
				}
				else
				{
					$id_prov_c 	= $id_prov_cA;
				}
				echo "CUENTA".@$id_prov_c;







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

				//@$reembolso 	= @$_POST['reembolso']+0;
				//$rbolso = 0;

/*				if($reembolso == 1)
				{
					$nombreR 	= strtoupper(mysql_real_escape_string($_POST['nombreR'],$conectar)) ;
					$clabeR   	= mysql_real_escape_string($_POST['clabeR'],$conectar);
					$cuentaR  	= mysql_real_escape_string($_POST['cuentaR'],$conectar);
				   	$sucR   	= strtoupper(mysql_real_escape_string($_POST['sucR'],$conectar)) ;
					$bancoR  	= strtoupper(mysql_real_escape_string($_POST['bancoR'],$conectar)) ;
					$rbolso = 1;
				}
*/
				// TERMINA limpiar y validad variables



/*
				// INICIA VALIDAR QUE NO HAYA DUPLICIDAD
					$sql_id_mttoSol = "SELECT id_mttoSol FROM mttoSol WHERE id_unidad = '$id_unidad' AND id_contrato = '$id_contrato' AND id_prov = '$id_prov' 
					AND importe = '$importe' AND km = '$km' ";
					$sql_id_mttoSol_R = mysql_query($sql_id_mttoSol);
					$proceder = 0;
					if(mysql_affected_rows() == 0)
					{
						$proceder = 1;
					}
				// TERMINA VALIDAR QUE NO HAYA DUPLICIDAD
*/


				########## ########## ######### AQUI EMPIEZA LA FIESTA
				$proceder = 1; ################ DESACTIVADA ACTUALIZACION CON CERO 0 , 1 PARA ACTIVAR
				if($proceder === 1)
				{ // INICIA si no esta duplicado le damos PALANTE 
					date_default_timezone_set('America/Mexico_city');
					//$fechaEj = date("Y-m-d H:i:s",time()+2*60*60);
					$fechaEj = date("Y-m-d H:i:s");
					$actualizaAS = 0; // ACTUALIZA STATUS DE AUTORIZACION A 0 = PENDIENTE
					// INICIA insertar solicitud en tabla mttoSol
					$sql_mttoSol_UP = "	UPDATE mttoSol SET 
										id_prov  = '$id_prov',
										id_prov_c  = '$id_prov_c',
										id_prov_s  = '0',
										importe  = '$importe',
										concepto = '$concepto',
										km 	= '$km',
										obs = '$obs',
										autorizadoS = '$actualizaAS',
										t1 	='$preventivo', 
										t2 	='$frenos', 
										t3 	='$susp', 
										t4 	='$dir', 
										t5 	='$clima', 
										t6 	='$motor', 
										t7 	='$enfria', 
										t8 	='$transmision', 
										t9 	='$llantas', 
										t10 ='$hojalateria', 
										t11 ='$electrico', 
										t12 ='$electron',
										t13 ='$deducible'  
										WHERE id_mttoSol = '$id_mttoSol'
										";

					$sql_mttoSol_R = mysql_query($sql_mttoSol_UP);
					//$id_mttoSol 	= mysql_insert_id(); // ESTE PARECE SER EL METODO MAS EFECTIVO DE OBTENER EL ULTIMO ID
					// TERMINA insertar solicitud en tabla mttoSol

					if(!$sql_mttoSol_R)
						{
							echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR ACTUALIZACION \n";

						}
					else{
							echo "<h2>REGISTRO DE ACTUALIZACION EXITOSO</h2> <h4><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  target='blank' >VER FORMATO</a></h4>";

							// INICIA Control Cambios
							if($sql_mttoSol_R)
								{
									$sql_mttoSol_UP = trim($sql_mttoSol_UP);
									//$sql_mttoSol_UP = trim(preg_replace('/\s\s+/', '', $sql_mttoSol_UP));
									$sql_mttoSol_UP = str_replace(array("\n", "\t", " "),"",$sql_mttoSol_UP); 
									
									$sql_up 	= mysql_real_escape_string($sql_mttoSol_UP,  $conectar);

									$arrayviejo = trim($arrayviejo);
									//$arrayviejo = trim(preg_replace('/\s\s+/', '', $arrayviejo));
									$arrayviejo = str_replace(array("\n", "\t", " "),"",$arrayviejo);

									$arrayviejo = mysql_real_escape_string($arrayviejo,  $conectar);
									
									$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
									(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
									VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
									$cambio_registrado = mysql_query($sql_control_cambios);
								}
							//TERMINA Control Cambios
							include('mttoSolRR.php');
						}

					//echo "<BR> ULTIMO ID FORMULA DIRECTA: $id_mttoSol_FA , CON QUERY Y TODO EL ROLLO: $id_mttoSol <BR>";

/*					// INICIA capturar datos reembolso
					if($reembolso == 1)
					{
						$sql_reembolso = "INSERT INTO mttoSolRemb (id_reembolso, id_mttoSol, nombreR, clabeR, cuentaR, sucR, bancoR) 
										VALUES ( NULL,   
										'$id_mttoSol', '$nombreR','$clabeR','$cuentaR','$sucR','$bancoR'
										)";
						$sql_reembolso_R = mysql_query($sql_reembolso);
						if(!$sql_reembolso_R)
											{
												echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR DATOS DE REEMBOLSO \n";
											}
										else{
												echo "<h3>REGISTRO DE REEMBOLSO EXITOSO</h3>";
											}
					}
					// TERMINA capturar datos reembolso
*/

					// SI SE REGISTRO LA SOLICITUD PROCEDEMOS A INTENTAR SUBIR EL ARCHIVO
					
######
/*					// INICIA PROCESO DE CARGA DE ARCHIVO	
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
											if($subirAutorizado == 1){ 
											$fecha = time();
											$aleatorio1 = rand();
											$aleatorio = $fecha.'-'.$aleatorio1;
											$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
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

									$sql_mttoSol_Cot = "INSERT INTO mttoDocto (id_docto, id_mttoSol, archivo, tipo, ruta, id_capturo, fechareg) 
														VALUES (
														NULL, '$id_mttoSol', '$nuevonombre', '$tipo', '$rutaz', '$capturo', CURRENT_TIMESTAMP 
														)";
									$sql_mttoSol_Cot_R = mysql_query($sql_mttoSol_Cot);
									
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
											$sql_mS_tipoDoc = "UPDATE mttoSol SET ";
											$sql_mS_tipoDoc .= $tipoActualizar;
											$sql_mS_tipoDoc .= " WHERE id_mttoSol =  '$id_mttoSol' ";
											$tipoDoc_R = mysql_query($sql_mS_tipoDoc);
											if($tipoDoc_R)
												$mttoSolUpR = "Update OK ".mysql_affected_rows()." ";
											else
												$mttoSolUpR = "Update Failed: ".mysql_error();
											// TERMINA ACTUALIZAR INDICAR TIPO DE DOCUME'NTO SUBIDO

									if(!$sql_mttoSol_Cot_R)
									{
										echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL CARGAR ARCHIVO DE COTIZACIÓN $mttoSolUpR \n";
									}
									else
									{
											echo "<h3>ARCHIVO DE COTIZACIÓN SUBIDO Y REGISTRADO CORRECTAMENTE $mttoSolUpR </h3>";
									}
								} // TERMINA SI LA CARGA FUE CORRECTA registramos en base de datos
													
							} //TERMINA comprobamos si se seleccionaron archivos, los cargamos en el servidor
					} // TERMINA PROCESO DE CARGA DE ARCHIVO
*/

				}// TERMINA  si no esta duplicado le damos PALANTE
				else
				{
					echo "<p style='background-color:#FFFF99; color:blue;'>Llene los datos completos, Gracias 437.</p>";
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
			DEBE INDICAR 
			EL TIPO DE MANTENIMIENTO ...  &#9786; 457</p>";
			if($cambio == 0){ echo "<p style='background-color:#FFFF99;'>NO HA INDICADO DATOS DIFERENTES</p>";}
			if($concluido != ''){ echo "<p style='background-color:#FFFF99;'>$concluido 507</p>";}
		}
	}  



	if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>

<style>
	.cuadrotiposervicio, label {font-size: .8em; vertical-align: middle;}
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

<table>
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
			<input type="checkbox" id="preventivo" name="preventivo" class = 'checkST' value="1" <?php echo $t1ckd;?> >
			<label for = "preventivo" >PREVENTIVO</label>
			</td><td>
			<input type="checkbox" id="frenos" name="frenos"  class = 'checkST' value="1"  <?php echo $t2ckd;?> >
			<label for = "frenos" >FRENOS</label>
			</td><td>
			<input type="checkbox" id="susp" name="susp"  class = 'checkST' value="1"  <?php echo $t3ckd;?> >
			<label for = "susp" >SUSPENSION</label>
			</td><td>
			<input type="checkbox" id="dir" name="dir"  class = 'checkST' value="1"  <?php echo $t4ckd;?> >
			<label for = "dir" >DIRECCION</label>
			</td>
			<td>
			<input type="checkbox" id="deducible" name="deducible"  class = 'checkST' value="1" <?php echo $t13ckd;?> >
			<label for = "deducible" ><span style='color:red;'>DEDUCIBLE</span></label>
			</td>
		</tr><tr>
			<td>
			<input type="checkbox" id="clima" name="clima"  class = 'checkST' value="1"  <?php echo $t5ckd;?> >
			<label for = "clima" >CLIMA</label>
			</td><td>
			<input type="checkbox" id="motor" name="motor"  class = 'checkST' value="1"  <?php echo $t6ckd;?> >
			<label for = "motor" >MOTOR</label>
			</td><td>
			<input type="checkbox" id="enfria" name="enfria"  class = 'checkST' value="1"  <?php echo $t7ckd;?> >
			<label for = "enfria" >ENFRIAMIENTO</label>
			</td><td>
			<input type="checkbox" id="transmision" name="transmision"  class = 'checkST' value="1"  <?php echo $t8ckd;?> >
			<label for = "transmision" >TRANSMISION</label>
			</td>
			<td></td>
		</tr><tr>
			<td>
			<input type="checkbox" id="llantas" name="llantas"  class = 'checkST' value="1"  <?php echo $t9ckd;?> >
			<label for = "llantas" >LLANTAS</label>
			</td><td>
			<input type="checkbox" id="hojalateria" name="hojalateria"  class = 'checkST' value="1"  <?php echo $t10ckd;?> >
			<label for = "hojalateria" >HOJALATERIA</label>
			</td><td>
			<input type="checkbox" id="electrico" name="electrico"  class = 'checkST' value="1"  <?php echo $t11ckd;?> >
			<label for = "electrico" >ELECTRICO</label>
			</td><td>
			<input type="checkbox" id="electron" name="electron"  class = 'checkST' value="1"  <?php echo $t12ckd;?> >
			<label for = "electron" >ELECTRONICO</label>
			</td>
			<td></td>
		</tr>
		</table>	
	</td>
</tr>





	<tr style='height: 7.5em;'><th>CAMBIAR PROVEEDOR</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search14' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result14"></div>
			<div id="result15"></div>
		</td>
	</tr>






<tr>
	<th>KILOMETRAJE
	</th>
	<td>
	<input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="<?php echo $km;?>" placeholder="0000" required style="text-align: right;" > 0000
	</td>
</tr>
<tr>

<tr>
	<th>IMPORTE IVA INCLUIDO
	</th>
	<td>
		<b>$</b><input type="number" lang="nb" step="0.01" min="0" name="importe" value="<?php echo $importe;?>"  required style="text-align: right;" max='200000' > 0000.00 sin comas
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
		value=""  maxlength='250' required ><?php echo $concepto;?></textarea><br>
		Máximo 250 caracteres
		<input type='text' id='conceptoCTA' name='conceptoCTA' size='4' disabled >
	</td>
</tr>	
<?php  /////////////////////////////////////////////TERMINA CUENTA CARACTERES ?>

<tr>
	<th>OBSERVACIONES</th>
	<td>
		<textarea name="obs"  cols="50" rows="1" 
		value=""  maxlength='250' ><?php echo $obs;?></textarea>
		<br>Máximo 250 caracteres
	</td>
</tr>

<!--
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
-->

<tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="DatosM" value="Editar Mantenimiento"> 
	</td>
</tr>


</table>
</form>

</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO




} // TERMINA TE CORRESPONDE

include ("u8mtto.php");  

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
	   ";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
	echo "
		<a href='mttoSolRes.php?pagina=$pagina' style='text-decoration:none;'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de Mantenimiento'></a>
		 </p>";
 // BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA

} // CIERRE PRIVILEGIOS 

include ("1footer.php"); ?>