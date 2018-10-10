<?php
$TipoBusqueda = "Histórico Km";
include '1header.php';

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");

// INICIA FORMULARIO REPORTAR KILOMETRAJE
##### ##### #####
$subido ='';
$error1 = '';
$error2 = '';
if(isset($_POST['kmActualizar']))
	{
		if($_POST['id_unidad']!='' 
		&& $_POST['km']!='' && $_POST['km'] > 0 
		  )
			{	   
				$id_unidad  = mysqli_real_escape_string($dbd2, $_POST['id_unidad'] );
				$km 	    = mysqli_real_escape_string($dbd2, $_POST['km'] );
				$capturo	= $_SESSION["id_usuario"];
				$fecharegHoy = date('Y-m-d H:i:s');



				// INICIO EVITAR REFRESH
				kmxid($id_unidad); // 
				// TERMINA EVITAR REFRESH


				// preparar insercion
				$sql_kmH	= "	INSERT INTO kmH 
								(id_km, id_unidad, km, capturo, fechareg) 
								VALUES 
								(null, '$id_unidad', '$km', '$capturo', '$fecharegHoy')";



				if($kmUltimo != $km and $kmUltimo < $km )
				{
					$sql_kmH_R  = mysqli_query($dbd2, $sql_kmH ); // ejecutar insercion
				
					if($sql_kmH_R  AND !is_null($kmUltimo) )
					{ 
						echo '<h2>KILOMETRAJE ACTUALIZADO CORRECTAMENTE</h2>';
						include('kmhlistado.php'); // LISTADO HISTORICO PARA CONFIRMAR INSERCION
						// INICIA  ALGORITMO DE ALERTA !!!
						// FECHA Y HORA DE CIUDAD DE MEXICO
						//date_default_timezone_set('America/Mexico_city');
						// datos viejos
						//echo $kmUltimo;
						//echo "<br>";
						//echo $fecharegU;
						//echo "<br>";
						$fecharegUUnix = strtotime("$fecharegU");
						//echo $fecharegUUnix;
						//echo "<br>";

						// datos nuevos
						//echo $km;
						//echo "<br>";
						$fecharegHoy = date('Y-m-d H:i:s');
						//echo $fecharegHoy;
						//echo "<br>";
						$fecharegHoyUnix = strtotime("$fecharegHoy");
						//echo $fecharegHoyUnix;
						//echo "<br>";

						// obtener intervalo siguiente para mtto
						$intervalo = 10000;
						$kmObjetivo = (ceil($km/$intervalo))*$intervalo;
						//echo "PROXIMO OBJETIVO KM: $kmObjetivo";
						//echo "<br>";
						// obtener tasa km/seg
						$kmDif	  = $km - $kmUltimo;
						//echo "DIFERENCIA KM: $kmDif";
						//echo "<br>";
						$fechaDif   = $fecharegHoyUnix - $fecharegUUnix;
						//echo "DIFERENCIA FECHA: $fechaDif";
						//echo "<br>";

						$tasaKmSeg = $kmDif/$fechaDif;
						//echo "TASA DE INCREMENTO KM/SEG : $tasaKmSeg";
						//echo "<br>";

						$kmObjetivoFalta = $kmObjetivo - $km;
						//echo "FALTAN $kmObjetivoFalta PARA LLEGAR AL SIGUIENTE MTTO";
						//echo "<br>";

						$tiempoFaltaSeg = $kmObjetivoFalta/$tasaKmSeg;
						//echo "DEBEN TRASNCURRIR $tiempoFaltaSeg SEGUNDOS PARA SIGUIENTE SERVICIO";
						//echo "<br>";

						$fechaSigServ = $fecharegHoyUnix + $tiempoFaltaSeg;

						echo "La fecha estimada para el siguiente servicio es: ".gmdate("Y-m-d\TH:i:s\Z", $fechaSigServ);

						$mensaje = "La fecha estimada para el siguiente servicio es: ".gmdate("Y-m-d\TH:i:s\Z", $fechaSigServ);
 

####					// CALCULO DE PRONOSTICO LLANTAS
						$intervaloLL	 = 40000;
						$kmObjetivoLL    = (ceil($km/$intervaloLL))*$intervaloLL;
						$kmDifLL 		 = $km - $kmUltimo;
						$fechaDifLL	     = $fecharegHoyUnix - $fecharegUUnix;
						$tasaKmSegLL	 = $kmDifLL/$fechaDifLL;
						$kmObjetivoFaltaLL = $kmObjetivoLL - $km;
						$tiempoFaltaSegLL = $kmObjetivoFaltaLL/$tasaKmSegLL;
						//echo "DEBEN TRASNCURRIR $tiempoFaltaSeg SEGUNDOS PARA SIGUIENTE SERVICIO";
						$fechaSigServLL = $fecharegHoyUnix + $tiempoFaltaSegLL;

						echo "<br>\nLa fecha estimada para el CAMBIO DE LLANTAS es: ".gmdate("Y-m-d\TH:i:s\Z", $fechaSigServLL).", Cuando se espera que la unidad llege a : $kmObjetivoLL KM Recorridos";

						$mensajeLL =	"<br>\nLa fecha estimada para el CAMBIO DE LLANTAS es: ".gmdate("Y-m-d\TH:i:s\Z", $fechaSigServLL);
####					// CALCULO DE PRONOSTICO LLANTAS


                        // ALERTA DE PERIODO DE VERIFICACION
                        placaxid($id_unidad);
                        periodosVerif($terminacionN);
                        $mensajeVerif = "<br>\nDE ACUERDO A LA TERMINACIÓN DE SUS PLACAS $Placas LOS PERIODOS DE VERIFICACION AMBIENTAL SON LOS SIGUIENTES: <br>\n".$periodos.". ";
                        echo $mensajeVerif;
                        // ALERTA DE PERIODO DE VERIFICACION

                        // ALERTA DE VENCIMIENTO DE DERECHOS VEHICULARES -- INICIA
                        $mensajeDerVeh = "	\n EL VENCIMIENTO DE LOS DERECHOS VEHICULARES ES EL 31 DE DICIEMBRE,  
                        					\n EL VENCIMIENTO PARA PAGO SIN ACTUALIZACION Y RECARGOS ES EL 31 DE MARZO, 
                        					\n LO ANTERIOR ESTA SUJETO A CAMBIOS DE LAS DISPOSICIONES, 
                        					\n POR PARTE DE LAS AUTORIDADES CORRESPONDIENTES. \n";
                        echo $mensajeDerVeh;
                        // ALERTA DE VENCIMIENTO DE DERECHOS VEHICULARES -- TERMINA


						if ($fechaSigServ != "") 
						{
							
							include('kmnotificacion.php');
							
							
							$mensajePS = $mensaje; // ANTES DE AUMENTARLE MAMADA Y MEDIA // SOLAMENTE PROXIMO SERVICIO
							/*
							$mensaje .= $mensajeLL; // CAMBIO DE LLANTAS
                            $mensaje .= $mensajeVerif; // PERIODO VERIFICACION
                            $mensaje .= $mensajeDerVeh; // VENCIMIENTO DERECHOS VEHICULARES
							$mensaje .= $mensajeLegal; // CONFIDENCIALIDAD
							$mensaje .= $mensajeInformativo; // CONTACTAR EJECUTIVO DE CUENTA
							mail($_SESSION["usuario"], 
								"Alerta jetvan.mx $Placas $Economico $Serie $Vehiculo ", 
								$mensaje, 
								"From: notificaciones@jetvan.mx");
							*/



							require("inc/class.phpmailer.php");
							$mail = new PHPMailer();

							$mail->isSMTP(); 
							$mail->Host = 'localhost'; 
							$mail->Port = 25;
							$mail->ssl = false; 
							$mail->authentication = false;  

							//recogemos las variables y configuramos PHPMailer
							$mail->From     = 'notificaciones@jetvan.mx';
							$mail->FromName = 'Jet Van WEB NOTIFICACIONES';
							$mail->AddAddress($_SESSION["usuario"], $_SESSION["nombre"]);
							$mail->Subject = "ALERTA $Placas $Economico $Serie $Vehiculo  ";
							$mail->IsHTML(true); // SE USA PARA ESTABLECER QUE EL CORREO TENDRA FORMATO HTML

							$path = 'img/logoMailCh.jpg';
							$cid = md5($path);
							$mail->AddEmbeddedImage($path, $cid, 'logo'); // ruta nombre apodo
							//$mail->AddEmbeddedImage('img/logoMailCh.jpg','logo'); data-embeded='auto' 

								$contenido = '<html><body>'; 
								$contenido .= "<h2 style='color:green;'><img src='cid:$cid'  data-embeded='auto' > ALERTA Jet Van WEB</h2>";
								$contenido .= "<h3 style='color:red;'>REPORTE DE KILOMETRAJE</h3>";
								$contenido .= '<p>Enviado el '.  date("d M Y").'</p>';


								$contenido .= '<hr />';

								$contenido .= "<style>
												table, th, td {border: 1px solid gray;}
												</style>
												<table >
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
								// SIGUIENTE SERVICIO
								$contenido .= "	<tr>
													<td colspan='2'>$mensajePS</td>
													
												</tr>";
								// CAMBIO DE LLANTAS
								$contenido .= "	<tr>
													<td colspan='2'>$mensajeLL</td>
												</tr>";
								// PERIODOS DE VERIFICACION
								$contenido .= " <tr>
													<td colspan='2'>$mensajeVerif</td>
												</tr>";
								// VENCIMIENTO DE DERECHOS
								$contenido .= " <tr>
													<td colspan='2'>$mensajeDerVeh</td>
												</tr>";
								// 
								$contenido .= "	<tr>
													<td colspan='2'></td>
												</tr>
												</table>";
								// <td></td>


								$contenido .= '<hr />';
								include('kmnotificacion.php');
								$contenido .= "<p style='font-size:11px;'><i>".$mensajeLegal; // CONFIDENCIALIDAD
								$contenido .= $mensajeInformativo."</i></p>"; // CONTACTAR EJECUTIVO DE CUENTA
								$contenido .= '<hr />';
								$contenido .= $mensajeJetVan;
								$contenido .= '</body></html>';

							$mail->Body    = $contenido;
							$mail->Send();

							echo '<h2>KILOMETRAJE ACTUALIZADO CORRECTAMENTE</h2>';
							echo "$contenido"; // PARA DEBUGGING

						}

						// TERMINA ALGORITMO DE ALERTA !!!
					}
					else
					{ // INICIA MOSTRAR FALLO TECNICO MYSQL
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR KILOMETRAJE \n";
					} // TERMINA MOSTRAR FALLO TECNICO MYSQL
					$subido = 'ok'  ;
				}
				else
				{
					if($kmUltimo > $km){ $error2 = 'KILOMETRAJE INGRESADO NO PUEDE SER MENOR AL ÚLTIMO REPORTADO';}
					if($kmUltimo == $km){ $error1 = "ESE KILOMETRAJE YA ESTA REGISTRADO";}
					echo "<BR><BR><span style='color:red;'>".$error1.$error2."</span><BR><BR>";
				}
			}
		else
			{
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; $proceder</p>";
			}
	}

 if($subido!='ok') {// INICIA MOSTRAR FORMULARIO
?>
<fieldset><legend><b>FORMULARIO</b></legend>
<form action="" method="POST"  enctype="multipart/form-data" >
	<h2>ACTUALIZAR KILOMETRAJE</h2>
<table>
		<input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>" 
		placeholder="Unidad" >
	<tr>
		<th>KILOMETRAJE ACTUAL <?php echo  DATE('Y-m-d');?>
		</th>
		<td>
		<input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="" 
			placeholder="0000" required style="text-align: right;" > 0000
		</td>
	</tr>
	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="kmActualizar" value="Reportar Kilometraje"> 
		</td>
	</tr>
	</table>
</form>
</fieldset>
<?php

// INICIA MOSTRAR HISTORIAL DE KILOMETRAJES
include('kmhlistado.php');
// TERMINA MOSTRAR HISTORIAL DE KILOMETRAJES

}// TERMINA MOSTRAR FORMULARIO
##### ##### #####
// TERMINA FORMULARIO REPORTAR KILOMETRAJE


// BOTON PARA VOLVER A LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<br><td>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</td>";
//<!--KILOMETRAJE HISTORICO-->

include '1footer.php'; ?>