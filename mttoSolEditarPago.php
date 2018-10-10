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
$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
@$sql_mttoSol_M = mysqli_fetch_array($sql_mttoSol_R);


@$id_unidad 	=	$sql_mttoSol_M['id_unidad'];
@$id_cliente 	=	$sql_mttoSol_M['id_cliente'];
@$id_contrato 	=	$sql_mttoSol_M['id_contrato'];
@$fechaEj		=	$sql_mttoSol_M['fechaEj'];
@$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
@$importe 		=	$sql_mttoSol_M['importe'];
@$km 			= 	$sql_mttoSol_M['km'];
@$obs 			=	strtoupper($sql_mttoSol_M['obs']);
@$id_prov 		= 	$sql_mttoSol_M['id_prov'];
@$id_prov_c		= 	$sql_mttoSol_M['id_prov_c'];
@$id_prov_s		= 	$sql_mttoSol_M['id_prov_s'];
@$capturo 		=	$sql_mttoSol_M['capturo'];
@$autorizadoS 	=	$sql_mttoSol_M['autorizadoS'];
@$pagado 		= 	$sql_mttoSol_M['pagado']; // tiene deposito

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

datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
proveedorxid($id_prov);
provCtaxid($id_prov_c);
reembxid($id_mttoSol);

$arrayviejo = 'id_prov_c  = '.$id_prov_c.',
				WHERE id_mttoSol = '.$id_mttoSol;

// INICIA TE CORRESPONDE
if($capturo == $_SESSION["id_usuario"] OR $_SESSION["mttoSol"] > 3){

echo "<h2><span style='color:blue;' >EDITAR CUENTA DE DEPOSITO</span></h2>";
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
		<td colspan='2' >
			<b>DETALLE</b> 
			<br>Tipo de Servicio: 
<?php 

$t1 	= '';
$t2 	= '';
$t3 	= '';
$t4 	= '';
$t5 	= '';
$t6 	= '';
$t7 	= '';
$t8 	= '';
$t9 	= '';
$t10 	= '';
$t11 	= '';
$t12 	= '';

if($sql_mttoSol_M['t1'] == 1) {$t1 	= 'PREVENTIVO';}
if($sql_mttoSol_M['t2'] == 1) {$t2 	= 'FRENOS';}
if($sql_mttoSol_M['t3'] == 1) {$t3 	= 'SUSPENSION';}
if($sql_mttoSol_M['t4'] == 1) {$t4 	= 'DIRECCION';}
if($sql_mttoSol_M['t5'] == 1) {$t5 	= 'CLIMA';}
if($sql_mttoSol_M['t6'] == 1) {$t6 	= 'MOTOR';}
if($sql_mttoSol_M['t7'] == 1) {$t7 	= 'ENFRIAMIENTO';}
if($sql_mttoSol_M['t8'] == 1) {$t8 	= 'TRANSMISION';}
if($sql_mttoSol_M['t9'] == 1) {$t9 	= 'LLANTAS';}
if($sql_mttoSol_M['t10'] == 1) {$t10 	= 'HOJALATERIA';}
if($sql_mttoSol_M['t11'] == 1) {$t11 	= 'ELECTRICO';}
if($sql_mttoSol_M['t12'] == 1) {$t12 	= 'ELECTRONICO';}


echo 	" &nbsp ".$t1. 
		" &nbsp ".$t2.
		" &nbsp ".$t3.
		" &nbsp ".$t4.
		" &nbsp ".$t5.
		" &nbsp ".$t6.
		" &nbsp ".$t7.
		" &nbsp ".$t8.
		" &nbsp ".$t9.
		" &nbsp ".$t10.
		" &nbsp ".$t11.
		" &nbsp ".$t12 ;
?>

			<br>Kilometraje: 
			<?php echo $km;?>
			<br>Importe IVA Incluido:
			<?php echo number_format( $importe, 2);?>
			<br>Concepto:
			<?php echo $concepto;?>
			<br>Observaciones:
			<?php echo $obs;?>
		</td>
	</tr>

</table>

<?php 

$subido = ''; // CONDICION PARA MOSTRAR FORMULARIO

if(isset($_POST['DatosM']))
    {

 //       @$reembolso = @$_POST['reembolso']+0;
        $id_cuenta = $_POST['id_cuenta'];

        $siga = 1;

/*       if($reembolso == 1){
        	if(!$_POST['nombreR']){$siga += 1;}
        	if(!$_POST['clabeR']){$siga += 1;}
        	if(!$_POST['bancoR']){$siga += 1;}
        }
*/ 
        $cambio = 0;
        $nocambio = '';

echo $id_cuenta."-";
echo $id_prov_c."comparacion";

		if($id_cuenta != $id_prov_c)	{$cambio += 1;} 
		if($id_cuenta == $id_prov_c)	{$nocambio = 'Indica la misma cuenta';} 

		echo $cambio;

		$nosehace = 0;
		if($cambio == 0){$nosehace = 1; }
		
		$concluido = '';

		if($pagado > 0 ){$siga += 1; $concluido = 'No se puede editar ya fue pagado';}

		$siga += $nosehace;



        if($_POST['id_cuenta']!='' 
        && $_POST['id_mttoSol']!='' 
 //       && $_POST['concepto']!='' 
 //       && @$_POST['id_prov']!='' 
 //       && $id_cuenta !='' 
        && $siga == 1 
        )
            {		
               	// INICIA limpiar y validad variables
               	$id_cuenta 	= mysqli_real_escape_string($dbd2, $_POST['id_cuenta'] );
                $id_mttoSol = mysqli_real_escape_string($dbd2, $_POST['id_mttoSol'] );
				 
 

				$capturo       	= $_SESSION["id_usuario"];

				// TERMINA limpiar y validad variables
				

				########## ########## ######### AQUI EMPIEZA LA FIESTA
				$proceder = 1;
				if($proceder === 1)
				{ // INICIA si no esta duplicado le damos PALANTE 
					date_default_timezone_set('America/Mexico_city');
					//$fechaEj = date("Y-m-d H:i:s",time()+2*60*60);
					$fechaEj = date("Y-m-d H:i:s");
					// INICIA insertar solicitud en tabla mttoSol
					$sql_mttoSol_UP = "	UPDATE mttoSol SET 
										id_prov_c  = '$id_cuenta' 
										WHERE id_mttoSol = '$id_mttoSol'
										";					

					$sql_mttoSol_R = mysqli_query($dbd2, $sql_mttoSol_UP);
					// TERMINA insertar solicitud en tabla mttoSol

					if(!$sql_mttoSol_R)
					{
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR ACTUALIZACION \n";
						
					}
					else
					{
						echo "<h2>REGISTRO DE ACTUALIZACION EXITOSO</h2> <h4><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  target='blank' >VER FORMATO</a></h4>";
						
						// INICIA Control Cambios
						if($sql_mttoSol_R)
						{ 
							$sql_up 	= mysqli_real_escape_string($dbd2, $sql_mttoSol_UP );
							$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
									
							$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
									(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
									VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
									$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
						}
							
						//TERMINA Control Cambios
						include('mttoSolEPR.php');
					}
            	}
            	else
            	{
            		echo "<p style='background-color:#FFFF99; color:blue;'>Llene los datos completos, Gracias 353.</p>";
            	}

				$subido = 'ok'	;
			}
		else
		{	
			
//			echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos , 
//			DEBE INDICAR 
//			LA CUENTA DESTINO ...  &#9786; $nocambio 362</p>";
			if($cambio == 0){ echo "<p style='background-color:#FFFF99;'>NO HA INDICADO DATOS DIFERENTES</p>";}
			if($concluido != ''){ echo "<p style='background-color:#FFFF99;'>$concluido 364</p>";}
		}
	}  


	if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>

<style>
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

<fieldset><legend><b>FORMULARIO</b></legend>

<form action="" method="POST"   >

<table>
<tr>
	<th>

	<input type="hidden" name="id_mttoSol"  value="<?php echo $id_mttoSol;?>" >

	ELEGIR CUENTA DEL PROVEEDOR

	</th>
	<td>

<?php

	$sql_pCtasP 	= "SELECT * FROM provBanco WHERE id_prov = '$id_prov' AND suspendido = 0 ";
	$sql_pCtasP_R	= mysqli_query($dbd2, $sql_pCtasP );

	echo "<select name='id_cuenta' >";
	while($pCta_M = mysqli_fetch_assoc($sql_pCtasP_R)){ 
		$id_esta_cta = $pCta_M['id_cuenta'];
		$PCbanco 	= $pCta_M['banco'];
		$PCcuenta 	= $pCta_M['cuenta'];
		$PCclabe	= $pCta_M['clabe'];
		$PCsucursal = $pCta_M['sucursal'];
		
		echo "<option value='{$id_esta_cta}'>id- $id_esta_cta ::: Bco-{$PCbanco} ::: Cta-{$PCcuenta} ::: Cbe-{$PCclabe} ::: Suc-{$PCsucursal} </option>";
	}
	echo "</select >";
?>
		
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
	<input id="gobutton2" type="submit" name="DatosM" value="Editar CUENTA"> 
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