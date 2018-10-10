<?php
include '1header.php';

$id_mttoSol 	= $_GET['id_mttoSol'];
$id_mttoSolAut 	= $_GET['id_mttoSol'];

// if(){;}
$paginaR 	= $_GET['pagina'];   // PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE // paginaR pues en alguna parte se pierde el valor de la variable pagina
echo $paginaR;

//echo "$id_mttoSol ";

########## ########## ########## ########## ########## 
$sql_mttoSol 	= "SELECT * FROM `mttoSol` WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
$sql_mttoSol_M 	= mysqli_fetch_array($sql_mttoSol_R);

$id_unidad 		=	$sql_mttoSol_M['id_unidad'];
$id_cliente 	=	$sql_mttoSol_M['id_cliente'];
$id_contrato 	=	$sql_mttoSol_M['id_contrato'];
$fechaEj		=	$sql_mttoSol_M['fechaEj'];
$fechaAuANT		=	$sql_mttoSol_M['fechaAu']; // PARA REVERSO
$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
$importe 		=	$sql_mttoSol_M['importe'];
$km 			= 	$sql_mttoSol_M['km'];
$obs 			=	strtoupper($sql_mttoSol_M['obs']);
$id_prov 		= 	$sql_mttoSol_M['id_prov'];
$ESTE_id_prov	= 	$sql_mttoSol_M['id_prov'];
$id_prov_c		= 	$sql_mttoSol_M['id_prov_c'];
$id_prov_s		= 	$sql_mttoSol_M['id_prov_s'];
$capturo 		=	$sql_mttoSol_M['capturo'];
$autorizadoS 	=	$sql_mttoSol_M['autorizadoS'];
// TIENE DOCUMENTOS
$dC1 		=	$sql_mttoSol_M['dC1'];
$pagado 	=	$sql_mttoSol_M['pagado'];
$facturado 	=	$sql_mttoSol_M['facturado'];
$dF4 		=	$sql_mttoSol_M['dF4'];
$dM5 		=	$sql_mttoSol_M['autorizadoS']; // BUG??
// TIENE DOCUMENTOS
datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
proveedorxid($id_prov);
provCtaxid($id_prov_c);
reembxid($id_mttoSol);

// EJECUTIVO
$sql_ejec 		= "SELECT * FROM `usuarios` WHERE `id_usuario` = '$capturo' LIMIT 1 ";
$res_ejec 		= mysqli_query($dbd2, $sql_ejec);
$matriz_ejec 	= mysqli_fetch_array($res_ejec);
$nombreEjec 	= strtoupper($matriz_ejec['nombre']);
//echo "<br>".$nombreEjec;

usuarioxid($autorizadoS);
$autorizoNombreS = $nombre;
########## ########## ########## ########## ########## 

if($autorizadoS != 1){
echo "<h2><span style='color:blue;' >AUTORIZACION EN TRÁMITE</span></h2>";
}
else{
echo "<h2><span style='color:blue;' >AUTORIZADO $fechaAuANT </span></h2>";
}


?>
<style>
.resaltar	{color:blue;size:1.3em;};
td {padding:0px;margin:0px;}
</style>

<table style="padding:5px;">
	<tr>
		<td>
			
			<b>SOLICITUD DE CHEQUE</b>
			<br>Folio: 
			<span style='color:red;'><?php echo $id_mttoSol;?></span>
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
			 <table id='corta' >
			 <tr >
			 	<td ><b>UNIDAD</b></td>
			 	<td ></td></tr>
			 <tr><td>Economico: </td>
			 	<td><span class='resaltar'><?php echo $Economico;?></span></td></tr>
			 <tr>
			 	<td>Serie: </td>
			 	<td><?php echo $Serie;?></td></tr>
			 <tr>
			 	<td>Placas:</td>
			 	<td><?php echo $Placas;?></td></tr>
			 </table>
			 
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
			
			<b>PROVEEDOR</b> 
			 <br>Razon Social:  
			<?php  if($esreembolso == 1){echo "REEMBOLSO :  $nombreR ";}else{echo "&nbsp". $PrazonSocial;} // PROVEEDOR ?>
			 <br>RFC:  
			<?php  if($esreembolso == 1){echo " &nbsp; Facturado por : $Prfc :::  $PrazonSocial ";}else{echo "&nbsp". $Prfc;} // PROVEEDOR ?>
			
		</td>
		<td>
 
			<b>PAGO</b> 
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


	<tr>
		<td style='vertical-align: top;' colspan="2">
			<b>DETALLE</b>
			<br>Concepto:
			<?php echo $concepto;?>
			<br>Importe:  $ 
			<span class='resaltar'><?php echo number_format( $importe, 2);?></span>
			<br>Kilometraje:
			<span class='resaltar'><?php echo $km;?></span>
			<br>Observaciones: 
			<?php echo $obs;?>
		</td>
<!--		<td>
			<b>FIRMAS</b>
			<br>Solicita:  
			<?php echo $nombreEjec; ?>
			<br>Autoriza: 
			 <?php echo @$autorizoNombreG; // VOBO autoriza GERENTE ?> 
			<br>VO.BO.: 
			 <?php echo $autorizoNombreS; // VOBO autoriza SUPERVISOR ?> 
			<br>Recibio:	
			 <?php echo @$recibeNombre; // RECIBE CONTABILIDAD ?> 
		</td>
-->	</tr>

</table>


<?php
##### ##### #####
include('mttoSolObs.php');
##### ##### #####

//include('mttoSolAutRespResUnidad.php');


if($_SESSION["mttoSolAut"] == 0){
	include('mttoSolAutRespResUnidad.php');
}

// INICIO CONDICION PARA PERMITIR REVERSO
date_default_timezone_set('America/Mexico_city');
$ahora 		= new DateTime();
$fechaAuANT	= new DateTime("$fechaAuANT");
$fechaAuANT->modify('+3 minutes'); // DIEZ MINUTOS PARA REVERSO
$mostrar = 'si';
$mostrar = ($autorizadoS != 1)?"si":"no"; // OPERADOR TERNIARIO
if($autorizadoS == 1){ 	$mostrar = ($fechaAuANT > $ahora)?"si":"no";}// OPERADOR TERNIARIO
// TERMINA CONDICION PARA PERMITIR REVERSO

if($_SESSION["mttoSolAut"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO 
	if (!isset ($_POST['enviar'])) // MOSTRAMOS RESUMEN SI NO SE HA REGISTRADO RESP
		{
			include('mttoSolAutRespResUnidad.php');
		}
//proceso del formulario // si existe "enviar"...
if (isset ($_POST['enviar'])) 
{
	//comprobamos si todos los campos fueron completados
	if ($_POST['id_mttoSol']!='') 
	{
		$id_mttoSol 	= mysqli_real_escape_string($dbd2, $_POST['id_mttoSol'] );
		$autorizadoS 	= mysqli_real_escape_string($dbd2, $_POST['autorizadoS'] );
		$obsA	   		= mysqli_real_escape_string($dbd2, strtoupper(trim($_POST['obsA'])) );
		$autorizoT 		= $_SESSION['id_usuario'];

		//INSERCION EN BASE
		date_default_timezone_set('America/Mexico_city');
		$fechaAu = date("Y-m-d H:i:s");


		//VALIDAR NO ESTE CANCELADA
		$sqlCan 	= "SELECT cancelado, autorizadoS FROM mttoSol WHERE id_mttoSol = '$id_mttoSol' ";
		$sqlCanR 	= mysqli_query($dbd2, $sqlCan);
		$matrizCR 	= mysqli_fetch_array($sqlCanR);
		$canceladoR	= $matrizCR['cancelado'];
		$autorizadoSYa	= $matrizCR['autorizadoS'];
		//VALIDAR NO ESTE CANCELADA

		//PARA HABILITAR REVERSO
		$autorizadoSYa = ($mostrar == 'si')?0:$autorizadoSYa;

		if($canceladoR == 0 && $autorizadoSYa != 1 )
		{
/**/		$sql_MUp = "UPDATE  mttoSol SET 
						fechaAu = '$fechaAu', 
						autorizo = '$autorizoT', 
						autorizadoS = '$autorizadoS' 
			 			WHERE id_mttoSol = '$id_mttoSol' "; 
			$R_MUp	= mysqli_query($dbd2, $sql_MUp ); 

			if( $obsA != '' AND strlen($obsA)> 0 ){ // INSERTAR OBSERVACIONES

				$sql_Mobs = "INSERT INTO mttoSolObs 
							(`id_mttoSolOb`, `id_mttoSol`, `capturo`, `obsA`, `fechareg`, statusAu)
							VALUES 
							(NULL, '$id_mttoSol', '$autorizoT', '$obsA', '$fechaAu', '$autorizadoS')
							";
				$MobsR = mysqli_query($dbd2, $sql_Mobs);
			}
			else{
				echo "NO HAY OBSERVACIONES: ";
			}

			if($R_MUp)
				$anadido = "Registrada ".mysqli_affected_rows($dbd2)." respuesta"; // Mensaje confirmación de añadido un Registro a la Base de Datos
			else
				$anadido = "ERROR AL REGISTRAR: ".mysqli_error($dbd2);
		//INSERTA EN BD, FIN, Aqui termina le codigo de inserción a la BD
		}
		else{
			if($canceladoR == 1){
			echo "NO SE PUEDE AUTORIZAR PUES ESTA CANCELADA";
			}
			elseif($autorizadoSYa == 1){
			echo "NO SE PUEDE AUTORIZAR PUES YA ESTA AUTORIZADA";
			}
		}

		include('mttoSolAutRespResUnidad.php');
		//MENSAJE POR EL ENVIO EXITOSO Y LA INYECCION A LA BASE EXITOSO
		$flag='ok'; 
		$mensaje=	"<div id='ok'> Respuesta registrada con &eacute;xito<br />
					<br />Gracias <br /> <a href='mttoSolAutRT.php?pagina=".$paginaR."'>
					| Ir a RESUMEN AUTORIZACIONES | </a></div>";
	} else 
		{
			//si no todos los campos fueron completados se frena el envio y avisamos al usuario	
			$flag='err';
			$mensaje='<div id="error">- Falla al subir el archivo. '.@$error_archivo.$mttoSolUpR.'</div>';
		}
}



echo @$mensaje; /*mostramos el estado de envio del form */ 



if (@$flag!='ok' && $mostrar == 'si') {  // INICIA Mostrar formulario  ?>
	<div style="padding:5px;">
	<fieldset><legend>FORMULARIO AUTORIZAR</legend>


		<form action="" method="post" >
			
			<input type="hidden" name="id_mttoSol" value="<?php echo $id_mttoSolAut; ?>">
				
			<p><strong>RESPUESTA</strong>
			<select name = "autorizadoS" >
				  <option value='1' >AUTORIZADO</option>
				  <option value='2' >INCOMPLETO</option>
				  <option value='3' >CORREGIR</option>
				  <option value='4'	>RECHAZADO</option>
				  <option value='6'	>REVISION OK (PREAUTORIZADO)</option>
			</select></p>
			<p><strong>OBSERVACIONES</strong><br><textarea name='obsA' value='<?php echo $_PHP['obsA']; ?>' rows="4" cols="50" autofocus ></textarea>
			</p>

			
			<p><input  type="submit" name="enviar" value="Registrar" /></p>
		</form>

	</fieldset>
	</div> <!-- end form-->
<?php }  // TERMINA Mostrar formulario 
} // CIERRE PRIVILEGIOS 

echo '<p>';
/*
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
	   ";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 
*/

// BOTON REGRESAR AL RESUMEN // IR AL RESUMEN DE MANTENIMIENTO
$resumenRegresar = '';
if($_SESSION["mttoSolAut"] > 1){$resumenRegresar = 'mttoSolAutSR.php'; }else{$resumenRegresar = 'mttoSolRes.php'; }	  
	echo "
		<a href='$resumenRegresar?pagina=".$paginaR."' style='text-decoration:none;'>
		<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen'>
		</a>
		 ";
 // BOTON REGRESAR AL RESUMEN // IR AL RESUMEN DE MANTENIMIENTO



// BOTON REGRESAR AL RESUMEN // DEL PROVEEDOR
if($_SESSION["mttoSolAut"] > 0){  
	echo "
		<a href='
		mttoSolResSupProv.php?id_prov=".$ESTE_id_prov."' style='text-decoration:none;'>
		<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Ir a PROVEEDOR'>
		</a>
		 ";
 }	
 // BOTON REGRESAR AL RESUMEN // DEL PROVEEDOR



/*
// BOTON REGRESAR AL RESUMEN // IR AL RESUMEN DE DEPOSITOS
if($_SESSION["mttoSolDep"] > 0){	
	echo "
		<a href='mttoSolResDep.php?pagina=$pagina' style='text-decoration:none;'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a Depositos Pendientes'></a>
		 ";
}
// BOTON REGRESAR AL RESUMEN // IR AL RESUMEN DE DEPOSITOS
*/
		 echo '</p>';

include ("1footer.php"); ?>
<style>
#corta td {padding:0px;margin:0px;}
</style>