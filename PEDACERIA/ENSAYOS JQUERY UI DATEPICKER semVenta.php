<?php include("1header.php");?>
<meta charset='utf-8'>
<?php  if($_SESSION["mttoSol"] > 1){  // APERTURA PRIVILEGIOS 1 VER 2 CREAR 

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

include_once ("base.inc.php");
include_once("funcion.php");
    
$id_unidad 	= mysql_real_escape_string($_GET['id_unidad'], $conectar);

datosxid($id_unidad);

echo "<h3>REGISTRAR VENTA DE UNIDAD VEHICULAR</h3>";
echo " Economico : ".$Economico."";
echo "</br> Serie : ".$Serie."";    
echo "</br> Modelo : ".$Modelo."";   
echo "</br> Color : ".$Color."";   
echo "</br> Tipo : ".$Vehiculo."";   
echo "</br> Placas <b>: ".$Placas."</b> </br></br>";   


$subido = ''; // CONDICION PARA MOSTRAR FORMULARIO

// INICIA PROCESO DE FORMULARIO
if(isset($_POST['DatosM']))
    {
        if($_POST['id_unidad']!='' 
       // && $_POST['importe']!='' 
       // && $_POST['concepto']!='' 
       // && @$_POST['id_prov']!='' 
       // && $id_cuenta !='' 
        )
            {		
               	// INICIA limpiar y validad variables
               	$vendedor 	= mysql_real_escape_string($_POST['vendedor'],$conectar);
                $fechaDep   = mysql_real_escape_string($_POST['fechaDep'],$conectar);
                $importeD 	= mysql_real_escape_string($_POST['importeD'],$conectar);
                $fechaDep2  = mysql_real_escape_string($_POST['fechaDep'],$conectar);
                $importeD2 	= mysql_real_escape_string($_POST['importeD'],$conectar);
				$fechaFact  = mysql_real_escape_string($_POST['fechaFact'],$conectar);
                $folioF 	= mysql_real_escape_string($_POST['folioF'],$conectar);
				$importe 	= mysql_real_escape_string($_POST['importe'],$conectar);
				$clienteN 	= strtoupper(mysql_real_escape_string($_POST['clienteN'],$conectar));
				$obs 		= strtoupper(mysql_real_escape_string($_POST['obs'],$conectar));
                $capturo 	= $_SESSION["id_usuario"];
				// TERMINA limpiar y validad variables

				// INICIA VALIDAR QUE NO HAYA DUPLICIDAD
					$sql_vendido = "SELECT id_venta FROM sem WHERE id_unidad = '$id_unidad' ";
					$vendido_R 	= mysql_query($sql_vendido);
					$proceder 	= 0;
					if(mysql_affected_rows() === 0)
					{
						$proceder = 1;
					}
				// TERMINA VALIDAR QUE NO HAYA DUPLICIDAD
				
				########## ########## ######### AQUI EMPIEZA LA FIESTA
				if($proceder === 1)
					{ // INICIA si no esta duplicado le damos PALANTE 
						// INICIA insertar venta
						$sql_sem = "INSERT INTO sem (
						`id_venta`, `id_unidad`, `vendedor`, 
						`fechaDep`, `fechaFact`, `folioF`, 
						`importe`, `clienteN`, `obs`, 
						`capturo`
						) 
						VALUES ( 
						NULL, '$id_unidad', '$vendedor', 
						'$fechaDep', '$fechaFact', '$folioF', 
						'$importe', '$clienteN', '$obs', 
						'$capturo'
						)";
						$sem_R = mysql_query($sql_sem);
						$id_venta = mysql_insert_id(); // ESTE PARECE SER EL METODO MAS EFECTIVO DE OBTENER EL ULTIMO ID
						// TERMINA insertar solicitud en tabla mttoSol

						if(!$sem_R)
							{
								echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR VENTA \n";
							}
						else{
								echo "<h2>REGISTRO DE VENTA EXITOSO CON ID <span style='color:red;'>$id_venta</span> </h2>";
							}
	            	}// TERMINA  si no esta duplicado le damos PALANTE
            	else
	            	{
	            		echo "<p style='background-color:#FFFF99; color:blue;'>Se ha registrado previamente la venta de esta UNIDAD, favor de verificar.</p>";
	            	}

				$subido = 'ok'	;
			}
		else
		{	
			echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos , SE DEBE INDICAR PROVEEDOR, UNA CUENTA VÁLIDA Y EL TIPO DE MANTENIMIENTO &#9786;</p>";
		}
	} // TERMINA PROCESO DE FORMULARIO 
?>

<?php 
	if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>

<style>
	#alta input {min-width:200px;} #alta #gobutton {width:auto;}
	#datepicker {background-color: black;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->

<fieldset><legend><b>FORMULARIO</b></legend>
	<form action="" method="POST"  >
		<table>

		<input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>" placeholder="Unidad" >

<tr>
	<th>FECHA DEL DEPOSITO 1
	</th>
	<td>
	<input type="text" id="datepicker" name="fechaDep" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>IMPORTE DEL DEPOSITO 1
	</th>
	<td>
		<b>$</b><input type="number" name="importeD" lang="nb" step="0.01" min="0"  value="" style="text-align: right;" max='1200000' > 0000.00 sin comas
	</td>
</tr>

<tr>
	<th>FECHA DEL DEPOSITO 2
	</th>
	<td>
	<input type="date" name="fechaDep2" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>IMPORTE DEL DEPOSITO 2
	</th>
	<td>
		<b>$</b><input type="number" name="importeD2" lang="nb" step="0.01" min="0"  value="" style="text-align: right;" max='1200000' > 0000.00 sin comas
	</td>
</tr>

<tr>
	<th>FECHA DE FACTURA
	</th>
	<td>
	<input type="date" name="fechaFact" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>IMPORTE FACTURA IVA INCLUIDO
	</th>
	<td>
		<b>$</b><input type="number" name="importe" lang="nb" step="0.01" min="0"  value="" style="text-align: right;" max='1200000' > 0000.00 sin comas
	</td>
</tr>

<tr>
	<th>FOLIO REFACTURA
	</th>
	<td>
	<input type="text" name="folioF" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>NOMBRE DEL CLIENTE
	</th>
	<td>
	<input type="text" name="clienteN" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>NOMBRE DEL VENDEDOR
	</th>
	<td>
		<select name="vendedor" >
			<option value='0' >--</option>
			<option value='1' >Adrian Colin Batalla</option>
			<option value='2' >Graciela Vera Flores</option>			
			<option value='3' >Joel Velasco Osornio</option>
			<option value='4' >Juan Manuel Velasco Osornio</option>
			<option value='5' >Raymundo Maldonado Rodulfo</option>
			<option value='6' ></option>
		</select>

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
	<th>OBSERVACIONES</th>
	<td>
		<textarea name="obs" id="concepto" 
		onKeyDown="cuenta2()" onKeyUp="cuenta2()" cols="50" rows="1" 
		value="<?php //echo $cuenta; ?>"  maxlength='250'  ></textarea><br>
		Máximo 250 caracteres
		<input type='text' id='conceptoCTA' name='conceptoCTA' size='4' disabled >
	</td>
</tr>	
<?php  /////////////////////////////////////////////TERMINA CUENTA CARACTERES ?>

 <tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="DatosM" value="Registrar VENTA"> 
	</td>
</tr>

		</table>
	</form>
</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO?>

<?php 
	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 
} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>