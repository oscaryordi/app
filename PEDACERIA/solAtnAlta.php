<?php
$TipoBusqueda = "Solicitud de Atencion";
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

unidadAsignacion($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
partidaXid_partida($id_partida);
areaAXid_subDiv2($id_subDiv2);
areaAXid_subDiv3($id_subDiv3);

echo "<br>"; // partida
echo "CLIENTE:".$razonSocial."<br>"; 
echo "CONTRATO:".$numero."<br>"; 
echo "PARTIDA:".$mostrarPDesc."<br>"; // partida
echo "AREA:".$mostrarAAsn2."<br>"; // area administrativa
echo "SUBAREA:".$mostrarAAsn3."<br>"; // subarea
echo "<br>"; // subarea 2 SN4


// INICIA FORMULARIO REPORTAR KILOMETRAJE
##### ##### #####
$subido ='';
$error1 = '';
$error2 = '';
if(isset($_POST['Solicitar']))
	{
		if($_POST['id_unidad']!='' 
		&& $_POST['km']!='' && $_POST['km'] > 0 
		  )
			{	   
				$id_unidad   =mysql_real_escape_string($_POST['id_unidad'],$conectar);
				@$id_cliente =mysql_real_escape_string($_POST['id_cliente'],$conectar);
				$id_contrato =mysql_real_escape_string($_POST['id_contrato'],$conectar);
				$id_partida  =mysql_real_escape_string($_POST['id_partida'],$conectar);
				$id_subDiv2  =mysql_real_escape_string($_POST['id_subDiv2'],$conectar);
				$id_subDiv3  =mysql_real_escape_string($_POST['id_subDiv3'],$conectar);

				$km 		 =mysql_real_escape_string($_POST['km'],$conectar);
				$descripcion =mysql_real_escape_string($_POST['descripcion'],$conectar);
				$ubicacion 	 =mysql_real_escape_string($_POST['ubicacion'],$conectar);

				@$preventivo =mysql_real_escape_string($_POST['preventivo'],$conectar);
				@$correctivo =mysql_real_escape_string($_POST['correctivo'],$conectar);
				@$siniestro  =mysql_real_escape_string($_POST['siniestro'],$conectar);
				@$otro 		 =mysql_real_escape_string($_POST['otro'],$conectar);

				$tipo = 0;

				$capturo	 = $_SESSION["id_usuario"];
				$fecharegHoy = date('Y-m-d H:i:s');

				$sql_SAtn	= "	INSERT INTO solAtn 
								(`id_solAtn`, `id_contrato`, `id_subDiv2`, `id_subDiv3`, 
								`id_unidad`, `capturo`, `km`, `descripcion`, ubicacion, 
								`tipo`, `sa1`, `sa2`, `sa3`, `sa4`, 
								`fechareg`) 
								VALUES 
								(NULL, '$id_contrato', '$id_subDiv2', '$id_subDiv3', 
								'$id_unidad', '$capturo', '$km', '$descripcion','$ubicacion', 
								'$tipo', '$preventivo', '$correctivo', '$siniestro', '$otro', 
								'$fecharegHoy') ";
								// `id_mttoSol`, '$id_mttoSol',

				// INICIO EVITAR REFRESH
				//kmxid($id_unidad);
				// TERMINA EVITAR REFRESH
				$noProcede = 0;
				if($noProcede == 0 )
				{
					$sql_SAtn_R  = mysql_query($sql_SAtn, $conectar);
				
					if($sql_SAtn_R)
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

						$contenido = '<html><body>';
						$contenido .= "<h2 style='color:green;'>Acuse Jet Van WEB</h2>";
						$contenido .= "<h3 style='color:red;'>SOLICITUD  {$sa1t} {$sa2t} {$sa3t} {$sa4t}  </h3>";
						$contenido .= '<p>Enviado el '.  date("d M Y").'</p>';

						$contenido .= '<hr />';
						$contenido .= "<p>UNIDAD: $Economico <strong>$Placas</strong> $Serie <br>
										<strong>$Vehiculo</strong> $Modelo</p>";
						$contenido .= "<p>KILOMETRAJE: $km  </p>";
						$contenido .= "<p>PARTIDA:".$mostrarPDesc."</p>";
						$contenido .= "<p>AREA:".$mostrarAAsn2."</p>";
						$contenido .= "<p>SUBAREA:".$mostrarAAsn3."</p>";
						$contenido .= "<p>DETALLE/COMENTARIO: $descripcion </p>";
						$contenido .= "<p>UBICACION: $ubicacion </p>";

						$contenido .= '<hr />';
						include('kmnotificacion.php');
						$contenido .= "<p style='font-size:10px;'><i>".$mensajeLegal; // CONFIDENCIALIDAD
						$contenido .= $mensajeInformativo."</i></p>"; // CONTACTAR EJECUTIVO DE CUENTA
						$contenido .= '<hr />';
						$contenido .= '</body></html>';

					$mail->Body    = $contenido;
					// si todos los campos fueron completados enviamos el mail
					$mail->Send();

					echo '<h2>SOLICITUD DE ATENCION REGISTRADA CORRECTAMENTE</h2>';
					echo "$contenido"; // PARA DEBUGGING
						/*
						$mensajeU = "UNIDAD: $Economico $Placas $Serie $Vehiculo $Modelo ::: ";
						$mensajeU .= "PARTIDA:".$mostrarPDesc." , ";
						$mensajeU .= "AREA:".$mostrarAAsn2." , ";
						$mensajeU .= "SUBAREA:".$mostrarAAsn3." , ";
						$mensajeU .= "KILOMETRAJE: $km ::: ";
						$mensajeU .= "COMENTARIO: $descripcion ::: ";
						$mensajeU .= "UBICACION: $ubicacion ::: ";
						include('kmnotificacion.php');
						$mensaje = $mensajeU; // 
						$mensaje .= $mensajeLegal; // CONFIDENCIALIDAD
						$mensaje .= $mensajeInformativo; // CONTACTAR EJECUTIVO DE CUENTA

						if($sql_SAtn_R) 
						{
						mail($_SESSION["usuario"], 
							"ACUSE $Placas $Serie SOLICITUD {$sa1t} {$sa2t} {$sa3t} {$sa4t} ", 
							$mensaje, 
							"From: notificaciones@jetvan.mx");
						echo "$mensaje";
						}
						*/

						// TERMINA ALGORITMO DE ALERTA !!!
					}
					else
					{ // INICIA MOSTRAR FALLO TECNICO MYSQL
						echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR SOLICITUD \n";;
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


<tr><th>TIPO DE SOLICITUD</th><td>
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
</td></tr>



	<tr>
		<th>KILOMETRAJE ACTUAL <?ECHO DATE('Y-m-d');?>
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
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Solicitar" value="Registrar Solicitud"> 
		</td>
	</tr>
	</table>
</form>
</fieldset>
<?php

// INICIA MOSTRAR HISTORIAL DE KILOMETRAJES
//include('kmhlistado.php');
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