<?php
include("1header.php");
echo "<meta charset='utf-8'>"; 

if($_SESSION["seminuevos"] > 0){  // APERTURA PRIVILEGIOS 1 VER 2 CREAR 

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

include ("nav_sem.php");
    
$id_unidad 	= mysqli_real_escape_string($dbd2, $_GET['id_unidad'] );

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
               	$vendedor 	= mysqli_real_escape_string($dbd2, $_POST['vendedor'] );
                $fechaDep   = mysqli_real_escape_string($dbd2, $_POST['fechaDep'] );
                $importeD 	= mysqli_real_escape_string($dbd2, $_POST['importeD'] );
                $fechaDep2  = mysqli_real_escape_string($dbd2, $_POST['fechaDep2'] );
                $importeD2 	= mysqli_real_escape_string($dbd2, $_POST['importeD2'] );
				$fechaFact  = mysqli_real_escape_string($dbd2, $_POST['fechaFact'] );
                $folioF 	= mysqli_real_escape_string($dbd2, $_POST['folioF'] );
				$importe 	= mysqli_real_escape_string($dbd2, $_POST['importe'] );
				$precioT 	= mysqli_real_escape_string($dbd2, $_POST['precioT'] );
				$clienteN 	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['clienteN'] ));
				$obs 		= strtoupper(mysqli_real_escape_string($dbd2, $_POST['obs'] ));
                $capturo 	= $_SESSION["id_usuario"];
				// TERMINA limpiar y validad variables

				// INICIA VALIDAR QUE NO HAYA DUPLICIDAD
				$sql_vendido = "SELECT id_venta 
								FROM sem 
								WHERE id_unidad = '$id_unidad' ";
				$vendido_R 	= mysqli_query($dbd2, $sql_vendido);
				$proceder 	= 0;
				if(mysqli_affected_rows($dbd2) === 0) // SI NO EXISTE SE PROCEDE
					{
						$proceder = 1;
					}
				// TERMINA VALIDAR QUE NO HAYA DUPLICIDAD

				$semDep = '0';
				if($importeD > 0)
					{
						$semDep = 1;
					}
				if($importeD2 > 0)
					{
						$semDep = 1;
					}



				########## ########## ######### AQUI EMPIEZA LA FIESTA
				if($proceder === 1)
					{ // INICIA si no esta duplicado le damos PALANTE 
						// INICIA insertar venta
						$sql_sem = "INSERT INTO sem (
						`id_venta`, `id_unidad`, `vendedor`, 
						`semDep`, `fechaDep`, 
						`fechaFact`, `folioF`, 
						`importe`, `precioT`,
						`clienteN`, `obs`, 
						`capturo`
						) 
						VALUES ( 
						NULL, '$id_unidad', '$vendedor', 
						'$semDep', '$fechaDep', 
						'$fechaFact', '$folioF', 
						'$importe', '$precioT', 
						'$clienteN', '$obs', 
						'$capturo'
						)";
						$sem_R 		= mysqli_query($dbd2, $sql_sem);
						$id_venta 	= mysqli_insert_id($dbd2); // ESTE PARECE SER EL METODO MAS EFECTIVO DE OBTENER EL ULTIMO ID
						// TERMINA insertar solicitud en tabla mttoSol

					// INICIA TRATAMIENTO A DEPOSITOS	
					if($importeD > 0)
						{
							$sql_D = "	INSERT INTO semDep 
										(`id_dep`, `id_venta`, `importeD`, `fechaD`, `capturo`) 
										VALUES 
										(NULL, '$id_venta', '$importeD', '$fechaDep', '$capturo')";
							$D_R	= mysqli_query($dbd2, $sql_D);
							if(!$D_R){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR DEP 1 \n";}
						}
					if($importeD2 > 0)
						{
							$sql_D2 = "	INSERT INTO semDep 
										(`id_dep`, `id_venta`, `importeD`, `fechaD`, `capturo`) 
										VALUES 
										(NULL, '$id_venta', '$importeD2', '$fechaDep2', '$capturo')";
							$D_R2	= mysqli_query($dbd2, $sql_D2);
							if(!$D_R2){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR DEP 2 \n";}
						}
					// TERMINA TRATAMIENTO A DEPOSITOS	

						if(!$sem_R)
							{
								echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR VENTA \n";
							}
						else{
								echo "<h2>REGISTRO DE VENTA EXITOSO CON ID <span style='color:red;'>$id_venta</span> </h2>";
							// ASIGNACION VENDIDOS -- DESPUES DE CONFIRMADA VENTA
								$fecha_inicio 	= date('Y-m-d');
								$sql_aVta 		= "	INSERT INTO asignaUnidad 
													(`id_asignacion`, `id_unidad`, `id_cliente`, `id_contrato`, `fecha_inicio`, `capturo`) 
													VALUES 
													(NULL, '$id_unidad', '96', '161', '$fecha_inicio', '$capturo')
													";
								$aVta_R = mysqli_query($dbd2, $sql_aVta);
								if(!$aVta_R){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL ASIGNACION \n";}
							// ASIGNACION VENDIDOS -- DESPUES DE CONFIRMADA VENTA
							}
	            	}// TERMINA  si no esta duplicado le damos PALANTE
            	else
	            	{
	            		echo "<p style='background-color:#FFFF99; color:blue;'>
	            				Se ha registrado previamente la venta de esta UNIDAD, favor de verificar.
	            			  </p>";
	            	}

				$subido = 'ok'	;
			}
		else
		{	
			echo "<p style='background-color:#FFFF99;'>
					Favor de llenar datos completos , SE DEBE INDICAR PROVEEDOR, 
					UNA CUENTA VÁLIDA Y EL TIPO DE MANTENIMIENTO &#9786;
				  </p>";
		}
	} // TERMINA PROCESO DE FORMULARIO 


	if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>
<style>
	#alta input {min-width:200px;} #alta #gobutton {width:auto;}
	#datepicker {background-color: black;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->

<fieldset><legend><b>FORMULARIO</b></legend>
	<form action="" method="POST"  >
		<table>

		<input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>" placeholder="Unidad" >

<tr>
	<th>FECHA DEL DEPOSITO 1
	</th>
	<td>
	<input type="date" name="fechaDep" style="text-align: right;" > 
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
	<th>TIPO DE PRECIO
	</th>
	<td>
		<input type="radio" name="precioT" value='0' id='piso' checked >
		<label for = "piso" >PISO</label> 
	 	<input type="radio" name="precioT" value='1' id='flotilla'>
	 	<label for = "flotilla" >FLOTILLA</label>
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
			<option value='6' >Teresa López Castillejos</option>
			<option value='7' >Pedro Labra Gaytan</option>
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

<?php } //CIERRE MOSTRAR FORMULARIO

	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php?' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 


	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
	    echo "
	        <a href='semResTodo.php' style='text-decoration:none;'>
	        <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de Ventas Seminuevos'>
	        </a>
	        </p>";
	 // BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA

} // CIERRE PRIVILEGIOS 
include("1footer.php"); ?>