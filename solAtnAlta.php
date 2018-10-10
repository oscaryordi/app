<?php
$TipoBusqueda = "Solicitud de Atencion";
include '1header.php';

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

include ("mttoSolCreaDir.php"); // Se obtiene la ruta y la crea si no existe

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");

unidadAsignacion($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
partidaXid_partida($id_partida);
areaAXid_subDiv2($id_subDiv2);
areaAXid_subDiv3($id_subDiv3);

echo "<br>"; // 
echo "<table>"; // 
echo "<tr><th>CLIENTE</th><td>$razonSocial</td></tr>"; 
echo "<tr><th>CONTRATO</th><td>$numero</td></tr>"; 
echo "<tr><th>PARTIDA</th><td>$mostrarPDesc</td></tr>"; // partida
echo "<tr><th>AREA</th><td>$mostrarAAsn2</td></tr>"; // area administrativa
echo "<tr><th>SUBAREA</th><td>$mostrarAAsn3</td></tr>"; // subarea
echo "</table>"; //
echo "<br>";
echo "<br>"; //


// INICIA FORMULARIO REPORTAR KILOMETRAJE
##### ##### #####
$subido ='';
$error1 = '';
$error2 = '';
if(isset($_POST['Solicitar']))
	{
		$errorArchivo 		= 0; //$i=0;
		$target_file		= basename($_FILES['archivo']['name'][0]); // basename($_FILES['archivo']['name'][$i]);
		$fileType 			= pathinfo($target_file, PATHINFO_EXTENSION);
		// Algoritmo de validacion de extension
		if( $fileType != "PDF" &&
			$fileType != "pdf" 
		  )	
		{
			echo "Formato de ARCHIVO ANEXADO NO VALIDO!!!";
			$errorArchivo = 1;
		}

		if(
			$_POST['id_unidad'] !='' &&
		 	$_POST['km'] !='' && 
		 	$_POST['km'] > 0 && 
			$errorArchivo == 0
		  )
			{	   
				$id_unidad   = mysqli_real_escape_string($dbd2,$_POST['id_unidad']);
				@$id_cliente = mysqli_real_escape_string($dbd2,$_POST['id_cliente']);
				$id_contrato = mysqli_real_escape_string($dbd2,$_POST['id_contrato']);
				$id_partida  = mysqli_real_escape_string($dbd2,$_POST['id_partida']);
				$id_subDiv2  = mysqli_real_escape_string($dbd2,$_POST['id_subDiv2']);
				$id_subDiv3  = mysqli_real_escape_string($dbd2,$_POST['id_subDiv3']);

				$emailU  	= mysqli_real_escape_string($dbd2,$_POST['emailU']);
				$emailS  	= mysqli_real_escape_string($dbd2,$_POST['emailS']);

				$km 		 = mysqli_real_escape_string($dbd2,$_POST['km']);
				$descripcion = mysqli_real_escape_string($dbd2,$_POST['descripcion']);
				$ubicacion 	 = mysqli_real_escape_string($dbd2,$_POST['ubicacion']);

				@$preventivo = mysqli_real_escape_string($dbd2,$_POST['preventivo']);
				@$correctivo = mysqli_real_escape_string($dbd2,$_POST['correctivo']);
				@$siniestro  = mysqli_real_escape_string($dbd2,$_POST['siniestro']);
				@$otro 		 = mysqli_real_escape_string($dbd2,$_POST['otro']);


				if(empty($preventivo)){$preventivo = 0;}
				if(empty($correctivo)){$correctivo = 0;}
				if(empty($siniestro)){$siniestro = 0;}
				if(empty($otro)){$otro = 0;}



				$tipo = 0;

				$capturo	 = $_SESSION["id_usuario"];
				$fecharegHoy = date('Y-m-d H:i:s');

				$sql_SAtn	= "	INSERT INTO solAtn 
								(`id_solAtn`, `id_contrato`, `id_subDiv2`, `id_subDiv3`, 
								`id_unidad`, `capturo`, `km`, `descripcion`, ubicacion, 
								`tipo`, `sa1`, `sa2`, `sa3`, `sa4`, 
								emailU, emailS, 
								`fechareg`) 
								VALUES 
								(NULL, '$id_contrato', '$id_subDiv2', '$id_subDiv3', 
								'$id_unidad', '$capturo', '$km', '$descripcion','$ubicacion', 
								'$tipo', '$preventivo', '$correctivo', '$siniestro', '$otro', 
								'$emailU', '$emailS', 
								'$fecharegHoy') ";
								// `id_mttoSol`, '$id_mttoSol',

				echo $sql_SAtn;

				// INICIO EVITAR REFRESH
				//kmxid($id_unidad);
				// TERMINA EVITAR REFRESH
				$noProcede = 0;
				if($noProcede == 0 )
				{
					$sql_SAtn_R  	= mysqli_query($dbd2, $sql_SAtn);
					$id_solAtn 		= mysqli_insert_id($dbd2);

					##### INICIA CARGA DE ARCHIVO
					if($sql_SAtn_R)
					{	
						//INICIA comprobamos si se seleccionaron archivos, los cargamos en el servidor
						if (isset($_FILES['archivo']['tmp_name'])) 
							{
								$cantidad_archivos = 1;
								$i=0;
								do  {
										if($_FILES['archivo']['tmp_name'][$i] !="")
										{
											//INICIA VALIDAR FORMATO DE ARCHIVO
											$target_file		= basename($_FILES['archivo']['name'][$i]);
											$subirAutorizado 	= 1;
											$fileType 			= pathinfo($target_file, PATHINFO_EXTENSION);
											// Algoritmo de validacion de extension
											if( $fileType != "PDF" &&
												$fileType != "pdf" && 
												$fileType != "doc" && 
												$fileType != "DOC" && 
												$fileType != "docx" && 
												$fileType != "DOCX" && 
												$fileType != "odt" && 
												$fileType != "ODT" &&
												$fileType != "xps" &&
												$fileType != "XPS" 
											  )	
											{
												echo "Formato de ARCHIVO ANEXADO NO VALIDO!!!";
												$subirAutorizado = 0;
											}
											//TERMINA VALIDAR FORMATO DE ARCHIVO

											// INICIA si el formato es correcto lo copiamos
											if($subirAutorizado == 1){ 
											$fecha 		= time();
											$aleatorio1 = rand();
											$aleatorio 	= $fecha.'-'.$aleatorio1;
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
									/* $tipo = 1;
									if($reembolso == 1){$tipo = 3;} */
									$tipo = 5; // para que suba como correo electronico
									$id_mttoSol = 0; // aun no existe solicitud para asociar

									$sql_mttoSol_Cot = "INSERT INTO mttoDocto 
														(id_docto, id_mttoSol, id_solAtn, archivo, tipo, 
														ruta, id_capturo, fechareg) 
														VALUES 
														(NULL, '$id_mttoSol', '$id_solAtn','$nuevonombre', '$tipo', 
														'$rutaz', '$capturo', CURRENT_TIMESTAMP)";
									$sql_mttoSol_Cot_R 	= mysqli_query($dbd2, $sql_mttoSol_Cot);
									$id_docto 			= mysqli_insert_id($dbd2);
									
									if(!$sql_mttoSol_Cot_R)
									{
										echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL CARGAR ARCHIVO DE COTIZACIÓN $id_solAtn \n";
									}
									else
									{
										echo "<h3>ARCHIVO ANEXADO SUBIDO Y REGISTRADO CORRECTAMENTE folio Solicitud $id_solAtn , folio documento $id_docto  </h3>";
									}
								} // TERMINA SI LA CARGA FUE CORRECTA registramos en base de datos
													
							} //TERMINA comprobamos si se seleccionaron archivos, los cargamos en el servidor
					} // TERMINA PROCESO DE CARGA DE ARCHIVO
					##### TERMINA CARGA DE ARCHIVO
					$adjunto = '';
					if(file_exists('../exp/mtto/'.$rutaz.'/'.@$nuevonombre) && @$nuevonombre != '')
					{
						$adjunto = "<a href='https://jetvan.mx/jetvan/exp/mtto/$rutaz/$nuevonombre' > Adjunto </a>";
					}


					if($sql_SAtn_R) // INICIA ACUSE EMAIL
					{ 

						$sa1t = ($preventivo==1)?'- M.PREVENTIVO ':'';
						$sa2t = ($correctivo==1)?'- M.CORRECTIVO ':'';
						$sa3t = ($siniestro==1)?'- SEGUIMIENTO A SINIESTRO ':'';
						$sa4t = ($otro==1)?'- OTRO ':'';

					require("inc/class.phpmailer.php");
					$mail = new PHPMailer();

					//recogemos las variables y configuramos PHPMailer
					$mail->From     = 'notificaciones@jetvan.mx';
					$mail->FromName = 'Jet Van WEB';
					$mail->AddAddress($_SESSION["usuario"], $_SESSION["nombre"]);
					$mail->Subject = "ACUSE $Placas $Serie SOLICITUD {$sa1t} {$sa2t} {$sa3t} {$sa4t} ";
					$mail->IsHTML(true); // SE USA PARA ESTABLECER QUE EL CORREO TENDRA FORMATO HTML

					$path = 'img/logoMailCh.jpg';
					$cid = md5($path);
					$mail->AddEmbeddedImage($path, $cid, 'logo'); // ruta nombre apodo
					//$mail->AddEmbeddedImage('img/logoMailCh.jpg','logo'); data-embeded='auto' 

						$contenido = '<html><body>'; 
						$contenido .= "<h2 style='color:green;'><img src='cid:$cid'  data-embeded='auto' > Acuse Jet Van WEB</h2>";
						$contenido .= "<h3 style='color:red;'>SOLICITUD {$sa1t} {$sa2t} {$sa3t} {$sa4t} </h3>";
						$contenido .= '<p>Enviado el '.  date("d M Y").'</p>';

						$contenido .= '<hr />';
						$contenido .= "<table>
										<tr>
											<td>UNIDAD:
											</td>
											<td> $Economico <strong>$Placas</strong> $Serie <br>
											<strong>$Vehiculo</strong> $Modelo
											</td>
										</tr>";
						$contenido .= "	<tr>
											<td>KILOMETRAJE:</td>
											<td>$km </td>
										</tr>";
						$contenido .= "	<tr>
											<td>PARTIDA:</td>
											<td>$mostrarPDesc</td>
										</tr>";
						$contenido .= "	<tr>
											<td>AREA:</td>
											<td>$mostrarAAsn2</td>
										</tr>";
						$contenido .= " <tr>
											<td>SUBAREA:</td>
											<td>$mostrarAAsn3</td>
										</tr>";
						$contenido .= " <tr>
											<td>DETALLE/COMENTARIO:</td>
											<td>$descripcion</td>
										</tr>";
						$contenido .= "	<tr>
											<td>UBICACION:</td>
											<td>$ubicacion</td>
										</tr>
										<tr>
											<td colspan='2'> $adjunto </td>
										</tr>
										</table>";

						$contenido .= '<hr />';
						include('kmnotificacion.php');
						$contenido .= "<p style='font-size:11px;'><i>".$mensajeLegal; // CONFIDENCIALIDAD
						$contenido .= $mensajeInformativo."</i></p>"; // CONTACTAR EJECUTIVO DE CUENTA
						$contenido .= '<hr />';
						$contenido .= $mensajeJetVan;
						$contenido .= '</body></html>';

					$mail->Body    = $contenido;
					$mail->Send();

					echo '<h2>SOLICITUD DE ATENCION REGISTRADA CORRECTAMENTE</h2>';
					echo "$contenido"; // PARA DEBUGGING

					} // TERMINA ACUSE EMAIL
					else
					{ // INICIA MOSTRAR FALLO TECNICO MYSQL
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR SOLICITUD \n";
					} // TERMINA MOSTRAR FALLO TECNICO MYSQL
					$subido = 'ok'  ;
				}
				else
				{
					echo "<BR><BR><span style='color:red;'>hubo un error</span><BR><BR>";
				}
			}
		else
			{
				echo "<p style='background-color:#FFFF99;'>
				Favor de llenar datos completos &#9786; </p>"; //$proceder
			}
	}

 if($subido!='ok') {// INICIA MOSTRAR FORMULARIO
?>
<fieldset><legend><b>FORMULARIO</b></legend>
<form action="" method="POST"  enctype="multipart/form-data" >
	<h2>SOLICITAR ATENCION</h2>
<table>
		<input type="hidden" name="id_unidad" value="<?php echo $id_unidad;?>" >
		<input type="hidden" name="id_contrato" value="<?php echo $id_contrato;?>" >		
		<input type="hidden" name="id_subDiv2" value="<?php echo $id_subDiv2;?>" >
		<input type="hidden" name="id_subDiv3" value="<?php echo $id_subDiv3;?>" >
		<input type="hidden" name="id_partida" value="<?php echo $id_partida;?>" >

	<tr>
	<th>TIPO DE SOLICITUD</th>
	<td>
		<table id='cuadrotiposervicio'>
		<tr>
			<td>
			<input type="checkbox" id="preventivo" name="preventivo" class = 'checkST' value="1" >
			<label for = "preventivo" >PREVENTIVO</label>
			</td><td>
			<input type="checkbox" id="correctivo" name="correctivo"  class = 'checkST' value="1">
			<label for = "correctivo" >CORRECTIVO</label>
			</td><td>
			<input type="checkbox" id="siniestro" name="siniestro"  class = 'checkST' value="1" >
			<label for = "siniestro" >SINIESTRO</label>
			</td><td>
			<input type="checkbox" id="otro" name="otro"  class = 'checkST' value="1" >
			<label for = "otro" >OTRO</label>
			</td>
		</tr>
		</table>
	</td>
	</tr>

	<tr>
		<th>KILOMETRAJE ACTUAL <?php echo  DATE('Y-m-d');?>
		</th>
		<td>
		<input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="" 
			placeholder="0000" required style="text-align: right;" > 0000
		</td>
	</tr>

	<tr>
		<th>OBSERVACIONES
		</th>
		<td>
			<textarea  name="descripcion" rows="4" cols="50" required ></textarea>
		</td>
	</tr>

	<tr>
		<th>UBICACION DE LA UNIDAD<br>(ciudad, municipio, entidad federativa, cp)
		</th>
		<td>
			<textarea  name="ubicacion" rows="2" cols="50" required ></textarea>
		</td>
	</tr>

	<tr>
		<th>E-MAIL USUARIO
		</th>
		<td>
			<input type='mail'  name="emailU"  size='50' >
		</td>
	</tr>

	<tr>
		<th>E-MAIL ENLACE
		</th>
		<td>
			<input type='mail'  name="emailS"  size='50' >
		</td>
	</tr>

	<tr>
		<th>
			ANEXAR ARCHIVO
		</th>
		<td>
				Puede adjutnar 1 archivo
 			<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
		</td>
	</tr>

	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Solicitar" value="Registrar Solicitud"> 
		</td>
	</tr>
	</table>
</form>
</fieldset>
<?php

}// TERMINA MOSTRAR FORMULARIO
##### ##### #####
// TERMINA FORMULARIO 


// BOTON PARA VOLVER A LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<br><td>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</td>";
//<!--KILOMETRAJE HISTORICO-->

include '1footer.php'; ?>