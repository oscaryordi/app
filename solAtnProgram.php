<?php
$TipoBusqueda = "Solicitud de Atencion";
include '1header.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
		 $('#search36').keyup(function()
		{
		 var search36 = $('#search36').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search36:search36},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result36').html(data);
					}
				}
			});
		});

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
 function buscaDomicilio()
		{
		 var search37 = $('#search37').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search37:search37},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result37').html(data);
					}
				}
			});
		};

 function buscaContacto() // buscar contacto con search anterior
		{
		 var search38 = $('#search37').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search38:search38},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result38').html(data);
					}
				}
			});
		};
</script>

<?php

$id_solAtn = mysqli_real_escape_string($dbd2, $_GET['id_solAtn']);

	$sql_SA =   ' SELECT * '
				. ' FROM solAtn '
				. " WHERE id_solAtn = '$id_solAtn' ";
	$sql_SA_R 	= mysqli_query($dbd2,$sql_SA);
	$row 		= mysqli_fetch_assoc($sql_SA_R);
	$id_unidad 	= $row['id_unidad'];

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

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

echo "<br>";
echo "<fieldset><table>"; // partida
echo "<tr><th>CLIENTE</th>	<td>$razonSocial</td></tr>"; 
echo "<tr><th>CONTRATO</th>	<td>$numero</td></tr>"; 
echo "<tr><th>PARTIDA</th>	<td>$mostrarPDesc</td></tr>"; // partida
echo "<tr><th>AREA</th>		<td>$mostrarAAsn2</td></tr>"; // area administrativa
echo "<tr><th>SUBAREA</th>	<td>$mostrarAAsn3</td></tr>"; // subarea
echo "</table></fieldset>"; // subarea 2 SN4
echo "<br>";


	$sql_SA =     ' SELECT * '
				. ' FROM solAtn '
				. " WHERE id_solAtn = '$id_solAtn' ";
				//. " ORDER BY fechareg ASC LIMIT  $pagina_1, $rxpag ";

	$sql_SA_R 	= mysqli_query($dbd2,$sql_SA);
	//@$camposuh  = mysqli_num_fields($sql_SA_R);
	//@$filasuh   = mysqli_num_rows($sql_SA_R);
	$row 		= mysqli_fetch_assoc($sql_SA_R);

	$km 		= $row['km'];
	$descripcion= $row['descripcion'];
	$ubicacion 	= $row['ubicacion'];
	$sa1 		= $row['sa1'];
	$sa2 		= $row['sa2'];
	$sa3 		= $row['sa3'];
	$sa4 		= $row['sa4'];
	$fechareg 	= $row['fechareg'];

	$emailU 	= $row['emailU'];
	$emailS 	= $row['emailS'];

echo "<fieldset><table>"; // 
echo "<tr><th>FECHA DE SOLICITUD</th><td>{$fechareg}</td></tr>"; 
echo "<tr><th>KILOMETRAJE</th><td>{$km}</td></tr>"; 
echo "<tr><th>DESCRIPCION</th><td>{$descripcion}</td></tr>"; // 
echo "<tr><th>UBICACION</th><td>{$ubicacion}</td></tr>"; //  

	$sa1t = ($sa1==1)?'PREVENTIVO':'';
	$sa2t = ($sa2==1)?'CORRECTIVO':'';
	$sa3t = ($sa3==1)?'SINIESTRO':'';
	$sa4t = ($sa4==1)?'OTRO':'';
echo "<tr><th>TIPO</th><td>{$sa1t} {$sa2t} {$sa3t} {$sa4t}</td></tr>"; // 

echo "<tr><th>CORREO Usuario</th><td>{$emailU}</td></tr>"; //  
echo "<tr><th>CORREO Supervisor</th><td>{$emailS}</td></tr>"; //  

echo "<tr><th>ARCHIVO ADJUNTO</th>";
	solAtnAnexo($id_solAtn);
	if($archivoSA != '')
	{
		echo "<td><a href='https://sistema.jetvan.com.mx/exp/mtto/$rutaSA/$archivoSA' target='_blank''>
					VER</a>
			  </td>";
	}
	else
	{
		echo "<td></td>";	
	}
echo "</tr>";

echo "</table></fieldset>"; // 

echo "<br>";

/*
?>
<table>
	<tr><th></th><td></td></tr>
	<tr><th></th><td></td></tr>
</table>
<?php
*/

// INICIA FORMULARIO REPORTAR KILOMETRAJE
##### ##### #####

$subido ='';
$error1 = '';
$error2 = '';
if 	(isset($_POST['SolicitarXXXy']) && 
	 isset($_POST['id_prov']) 		&& 
	 $_POST['id_prov'] != '' 		&& 
	 $_POST['id_prov'] > 0 
	)
	{
		if( $_POST['id_unidad']!='' 
		
		  )
			{	

				@$id_unidad   = mysqli_real_escape_string($dbd2,$_POST['id_unidad']);
				@$id_cliente  = mysqli_real_escape_string($dbd2,$_POST['id_cliente']);
				@$id_contrato = mysqli_real_escape_string($dbd2,$_POST['id_contrato']);
				@$id_partida  = mysqli_real_escape_string($dbd2,$_POST['id_partida']);
				@$id_subDiv2  = mysqli_real_escape_string($dbd2,$_POST['id_subDiv2']);
				@$id_subDiv3  = mysqli_real_escape_string($dbd2,$_POST['id_subDiv3']);

				//@$km 		 = mysqli_real_escape_string($dbd2,$_POST['km']);
				@$descripcion = mysqli_real_escape_string($dbd2,$_POST['descripcion']);
				@$ubicacion  = mysqli_real_escape_string($dbd2,$_POST['ubicacion']);

				@$preventivo = mysqli_real_escape_string($dbd2,$_POST['preventivo']);
				@$correctivo = mysqli_real_escape_string($dbd2,$_POST['correctivo']);
				@$siniestro  = mysqli_real_escape_string($dbd2,$_POST['siniestro']);
				@$otro 		 = mysqli_real_escape_string($dbd2,$_POST['otro']);


				@$id_prov 		= mysqli_real_escape_string($dbd2,$_POST['id_prov']);
				@$id_sucursal 	= mysqli_real_escape_string($dbd2,$_POST['id_sucursal']);
				@$id_contacto 	= mysqli_real_escape_string($dbd2,$_POST['id_contacto']);
				$id_contacto 	+= 0;

				//@$agencia 	= mysqli_real_escape_string($dbd2,$_POST['agencia']);
				//@$domicilio   = mysqli_real_escape_string($dbd2,$_POST['domicilio']);
				//@$asesor  	= mysqli_real_escape_string($dbd2,$_POST['asesor']);
				//@$telefono 	= mysqli_real_escape_string($dbd2,$_POST['telefono']);

				@$fechaC 		= mysqli_real_escape_string($dbd2,$_POST['fechaC']);
				@$horaC 		= mysqli_real_escape_string($dbd2,$_POST['horaC']);
				@$descripcionC 	= mysqli_real_escape_string($dbd2,$_POST['descripcionC']);

				//$tipo = 0;
				$capturoPg	 = $_SESSION["id_usuario"];
				$fechaRPg = date('Y-m-d H:i:s');


				date_default_timezone_set('America/Mexico_city');
				$fechareRPG = date('Y-m-d H:i:s'); // CURRENT_TIMESTAMP 
				/* */
				$sql_SAtnPG	= "	UPDATE solAtn 
								SET 
								id_prov 	= '$id_prov', 
								id_sucursal = '$id_sucursal', 
								id_contacto = '$id_contacto', 
								fechaPg 	= '$fechaC', 
								horaPg 		= '$horaC', 
								descPg 		= '$descripcionC', 
								capturoPg 	= '$capturoPg', 
								programado 	= '1' ,
								fechaRPg 	= '$fechaRPg'   
								WHERE id_solAtn = '$id_solAtn' 
								LIMIT 1 
								";
								// `id_mttoSol`, '$id_mttoSol',
				$sql_SAtnPGR = mysqli_query($dbd2, $sql_SAtnPG);
				if(!$sql_SAtnPGR){
				echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR PROGRAMACION \n281<br>";
				}

				$emailAC = '';
				if($id_contrato == 260)
				{
					$emailAC = 'mantto.vehicular.jetvan@pemex.com';
				}

				// INICIO EVITAR REFRESH
				//kmxid($id_unidad);

				// TERMINA EVITAR REFRESH
				$noProcede = 0;
				if($noProcede == 0 && $sql_SAtnPGR )
				{
					//$sql_SAtn_R  = mysqli_query($dbd2, $sql_SAtn); // $sql_SAtn_R

					if($noProcede == 0) // INICIA ACUSE EMAIL
					{ 
						$sa1t = ($preventivo==1)?'- M.PREVENTIVO ':'';
						$sa2t = ($correctivo==1)?'- M.CORRECTIVO ':'';
						$sa3t = ($siniestro==1)?'- SEGUIMIENTO A SINIESTRO ':'';
						$sa4t = ($otro==1)?'- OTRO ':'';
					require("inc/class.phpmailer.php");
					require("inc/class.smtp.php"); // nuevo servidor
					require 'inc/PHPMailerAutoload.php'; // nuevo servidor
					$mail = new PHPMailer();
					$mail->IsSMTP(); // nuevo servidor

					//recogemos las variables y configuramos PHPMailer
					$mail->From 	= 'notificaciones@jetvan.mx';
					$mail->FromName = 'Jet Van WEB';
					$mail->AddAddress($_SESSION["usuario"], $_SESSION["nombre"]);
					
					$mail->AddAddress($emailU,$emailU); // USUARIO
					$mail->AddAddress($emailS,$emailS); // SUPERVISOR
					$mail->AddAddress($emailAC,$emailAC); // SUPERVISOR

					$mail->Subject = "PROGRAMACION DE SERVICIO $Placas $Serie $Vehiculo";
					$mail->IsHTML(true); // ESTABLECER QUE EL CORREO TENDRA FORMATO HTML

					$path = 'img/logoMailCh.jpg';
					$cid = md5($path);
					$mail->AddEmbeddedImage($path, $cid, 'logo');
					//$mail->AddEmbeddedImage('img/logoMailCh.jpg','logo'); data-embeded='auto' 

						$contenido = '<html><body>'; 
						$contenido .= "<h2 style='color:green;'><img src='cid:$cid'  data-embeded='auto' > PROGRAMACION Jet Van WEB</h2>";
						$contenido .= "<h3 style='color:red;'>PROGRAMACION DE SERVICIO </h3>";
						$contenido .= '<p>Enviado el '.  date("d M Y").'</p>';

						$contenido .= '<hr />';
						$contenido .= "<table>
										<tr><td>UNIDAD:</td><td> $Economico <strong>$Placas</strong> $Serie <br>
										<strong>$Vehiculo</strong> $Modelo</td></tr>";
						$contenido .= "<tr><td>KILOMETRAJE:</td><td> $km  </td></tr>";
						
						proveedorxid($id_prov);
						$contenido .= "<tr><td>AGENCIA:</td><td>$PrazonSocial, $PaliasProv</td></tr>";
						
						sucursalxid($id_sucursal);
						$contenido .= "<tr><td>DOMICILIO:</td>
										<td>
										$nombreSucursal, 
										$calleNumeroS, 
										$coloniaS, 
										$municipioS, 
										$estadoS, 
										$cpS, 
										</td>
									   </tr>";
						
						asesorxid($id_contacto);
						$contenido .= "<tr><td>ASESOR:</td><td>$nombreCP, </td></tr>";
						$contenido .= "<tr><td>TELEFONO:</td><td>$telefonoCP , EXT $extensionCP </td></tr>";
						
						$contenido .= " <tr><td>FECHA:</td><td><b>$fechaC</b></td> </tr>
										<tr><td>HORA:</td><td><b>$horaC</b></td> </tr>
										<tr><td>DESCRIPCION:</td><td>$descripcionC</td> </tr>

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

					echo '<h2>PROGRAMACION REGISTRADA CORRECTAMENTE</h2>';
					echo "	<div>
							<fieldset>";
					echo " 	$contenido"; // PARA DEBUGGING
					echo "	</fieldset>
							</div>";

					} // TERMINA ACUSE EMAIL
					else
					{ // INICIA MOSTRAR FALLO TECNICO MYSQL
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR PROGRAMACION \n";
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
<br>
<fieldset>
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
</fieldset>
<br>
<fieldset><legend><b>FORMULARIO</b></legend>

<form action="" method="POST"  enctype="multipart/form-data" >
	<h2>PROGRAMAR SERVICIO</h2>
<table>
		<input type="hidden" name="id_unidad" 	value="<?php echo $id_unidad;?>" >
		<input type="hidden" name="id_contrato" value="<?php echo $id_contrato;?>" >
		<input type="hidden" name="id_subDiv2" 	value="<?php echo $id_subDiv2;?>" >
		<input type="hidden" name="id_subDiv3" 	value="<?php echo $id_subDiv3;?>" >
		<input type="hidden" name="id_partida" 	value="<?php echo $id_partida;?>" >
		<input type="hidden" name="id_solAtn" 	value="<?php echo $id_solAtn;?>" >


	<tr style='height: 7.5em;'>
		<th>PROVEEDOR</th>
		<td style='vertical-align: top;'>

			<table>
			<tr><td>
			Buscar-> &#128269;<input type='text' id='search36' maxlength='13' size='14' >
			Resultados:
			</td></tr>
			<tr><td>
			<div id="result36"></div>
			</td></tr>
			<tr><td>
			<div id="result37"></div>
			</td></tr>
			<tr><td>
			<div id="result38"></div>
			</td></tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>FECHA DE LA CITA
		</th>
		<td>
		<input type="date" name="fechaC"  value="" 
			 required > 
		</td>
	</tr>

	<tr>
		<th>HORA DE LA CITA
		</th>
		<td>
		<input type="time" name="horaC"  value="" 
			 required  > 
		</td>
	</tr>

	<tr>
		<th>DESCRIPCION DEL SERVICIO PROGRAMADO
		</th>
		<td>
			<textarea  name="descripcionC" rows="3" cols="50" required ></textarea>
		</td>
	</tr>

	<tr>
		<td colspan=2 style="text-align:center;" >
			<input id="gobutton2" type="submit" name="SolicitarXXXy" value="PROGRAMAR SERVICIO"> 
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
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad' id='gobutton'>
		</FORM>
		</td>";
//<!--KILOMETRAJE HISTORICO-->

include '1footer.php'; ?>