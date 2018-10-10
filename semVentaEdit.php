<?php
include("1header.php");

echo "<meta charset='utf-8'>";

if($_SESSION["seminuevos"] > 0){  // APERTURA PRIVILEGIOS 1 VER 2 CREAR 

// FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');

include ("nav_sem.php");

$pagina 		= $_GET['pagina'];   // PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE

// INICIA  OBTENER DATOS DE VENTA
$id_venta 	= mysqli_real_escape_string($dbd2, $_GET['id_venta'] );
$sql_venta 	= " SELECT * 
				FROM sem 
				WHERE id_venta = '$id_venta' 
				LIMIT 1 ";
$venta_R	= mysqli_query($dbd2, $sql_venta);
while($rowventa = mysqli_fetch_assoc($venta_R))
	{ 
		$id_unidad 	= $rowventa['id_unidad'];
		$vendedor 	= $rowventa['vendedor'];
		$fechaFact 	= $rowventa['fechaFact'];
		$folioF 	= $rowventa['folioF'];
		$importe 	= $rowventa['importe'];
		$precioT 	= $rowventa['precioT'];
		$clienteN 	= $rowventa['clienteN'];
		$obs 		= $rowventa['obs'];
		$fechaFact 	= $rowventa['fechaFact'];
		$fechaFact = strtotime($fechaFact); // CONVIERTE EN SEGUNDOS UNIX
		$fechaFact = date('Y-m-d', $fechaFact); // DA FORMATO QUE SE PRESENTARA
	}
$sql_dep 	= "	SELECT * 
				FROM semDep 
				WHERE id_venta = '$id_venta' ";
$dep_R 		= mysqli_query($dbd2, $sql_dep);
$depositos 	= mysqli_affected_rows($dbd2);
// TERMINA OBTENER DATOS DE VENTA

// ARRAY VIEJO
	$arrayviejo = 	'ID_UNIDAD:'.$id_unidad.
					', VENDEDOR:'.$vendedor.
					', FECHAFACT:'.$fechaFact.
					', FOLIOFACT:'.$folioF.
					', IMPORTEFACT:'.$importe.
					', PRECIOTIPO:'.$precioT.
					', CLIENTEN:'.$clienteN.
					', OBS:'.$obs
					;
	//echo $arrayviejo;
// ARRAY VIEJO	


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
        if($_POST['id_venta']!='' 
       // && $_POST['importe']!='' 
       // && $_POST['concepto']!='' 
       // && @$_POST['id_prov']!='' 
       // && $id_cuenta !='' 
        )
            {		
               	// INICIA limpiar y validad variables
               	$id_venta 	= mysqli_real_escape_string($dbd2, $_POST['id_venta']);
               	$vendedor 	= mysqli_real_escape_string($dbd2, $_POST['vendedor']);

                $fechaDep1  = mysqli_real_escape_string($dbd2, $_POST['fechaDep1']);
                $importeD1 	= mysqli_real_escape_string($dbd2, $_POST['importeD1']);
                @$id_dep1 	= mysqli_real_escape_string($dbd2, $_POST['id_dep1']);

                $fechaDep2  = mysqli_real_escape_string($dbd2, $_POST['fechaDep2']);
                $importeD2 	= mysqli_real_escape_string($dbd2, $_POST['importeD2']);
                @$id_dep2 	= mysqli_real_escape_string($dbd2, $_POST['id_dep2']);
				
				$fechaFact  = mysqli_real_escape_string($dbd2, $_POST['fechaFact']);
                $folioF 	= mysqli_real_escape_string($dbd2, $_POST['folioF']);
				$importe 	= mysqli_real_escape_string($dbd2, $_POST['importe']);
				$precioT 	= mysqli_real_escape_string($dbd2, $_POST['precioT']);
				$clienteN 	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['clienteN']));
				$obs 		= strtoupper(mysqli_real_escape_string($dbd2, $_POST['obs']));
                $capturo 	= $_SESSION["id_usuario"];
				// TERMINA limpiar y validad variables

                $arrayNuevo = 	'ID_UNIDAD:'.$id_unidad.
								', VENDEDOR:'.$vendedor.
								', FECHAFACT:'.$fechaFact.
								', FOLIOFACT:'.$folioF.
								', IMPORTEFACT:'.$importe.
								', PRECIOTIPO:'.$precioT.
								', CLIENTEN:'.$clienteN.
								', OBS:'.$obs.
								', ID_DEP1: '.$id_dep1.
								', IMPORTED1: '.$importeD1.
								', FECHAD1: '.$fechaDep1.
								', ID_DEP2: '.$id_dep2.
								', IMPORTED2: '.$importeD2.
								', FECHAD2: '.$fechaDep2
								;

				echo $arrayNuevo;				

				$semDep = '0';
				if($importeD1 > 0)
					{
						$semDep = 1;
					}
				if($importeD2 > 0)
					{
						$semDep = 1;
					}

				// INICIO Update BD
				$sql_vta_up = " UPDATE  `jetvantlc`.`sem`  
								SET 
								vendedor 	=  '$vendedor',  
								fechaFact 	=  '$fechaFact',  
								folioF 		=  '$folioF',  
								importe 	=  '$importe',  
								precioT 	=  '$precioT',  
								clienteN	=  '$clienteN',  
								obs 		=  '$obs', 
								semDep 		=  '$semDep',  
								capturo 	=  '$capturo'  
								WHERE id_venta = '$id_venta' 
								LIMIT 1 ";
				$vta_Rup = mysqli_query($dbd2, $sql_vta_up);
				// TERMINA Update DB

				$proceder = 1;

				########## ########## ######### AQUI EMPIEZA LA FIESTA
				if($proceder === 1)
					{ // INICIA ACTUALIZAR REGISTRO 
						
					// INICIA TRATAMIENTO A DEPOSITOS	
					if($id_dep1 > 0)
						{
							$sql_Dup = "UPDATE semDep SET 
										importeD	=  '$importeD1',  
										fechaD  	=  '$fechaDep1',  
										capturo 	=  '$capturo'  
										WHERE id_dep = '$id_dep1' 
										LIMIT 1 ";
							$Dup_R	= mysqli_query($dbd2, $sql_Dup);
							if(!$Dup_R){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR DEP 1 \n";}
						}

					if($id_dep2 > 0)
						{
							$sql_Dup2 = "UPDATE semDep SET 
										importeD	=  '$importeD2',  
										fechaD 		=  '$fechaDep2',  
										capturo 	=  '$capturo'  
										WHERE id_dep = '$id_dep2' 
										LIMIT 1 ";
							$Dup_R2	= mysqli_query($dbd2, $sql_Dup2);
							if(!$Dup_R2){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR DEP 2 \n";}
						}						
					
					if($importeD1 > 0 and !isset($_POST['id_dep1']) )
						{
							$sql_D1 = "	INSERT INTO semDep 
										(`id_dep`, `id_venta`, `importeD`, `fechaD`, `capturo`) 
										VALUES 
										(NULL, '$id_venta', '$importeD1', '$fechaDep1', '$capturo')";
							$D_R1	= mysqli_query($dbd2, $sql_D1);
							if(!$D_R1){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR DEP 1 \n";}
						}

					if($importeD2 > 0 and !isset($_POST['id_dep2']) )
						{
							$sql_D2 = "	INSERT INTO semDep 
										(`id_dep`, `id_venta`, `importeD`, `fechaD`, `capturo`) 
										VALUES 
										(NULL, '$id_venta', '$importeD2', '$fechaDep2', '$capturo')";
							$D_R2	= mysqli_query($dbd2, $sql_D2);
							if(!$D_R2){echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR DEP 2 \n";}
						}
					// TERMINA TRATAMIENTO A DEPOSITOS

						if(!$vta_Rup)
							{
								echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR VENTA \n";
							}
						else{
								echo "<h2>REGISTRO DE CAMBIOS EN VENTA EXITOSO CON ID <span style='color:red;'>$id_venta</span> </h2>";

								//INICIA Control Cambios
								$sql_up 	= mysqli_real_escape_string($dbd2, $arrayNuevo ); // array NUEVO
								$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo ); // array VIEJO
						
								$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
														(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
														VALUES 
														(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";

								$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
								//TERMINA Control Cambios

							}
	            	}// TERMINA  ACTUALIZAR REGISTRO
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
			echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
		}
	} // TERMINA PROCESO DE FORMULARIO 

if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->

<fieldset><legend><b>FORMULARIO EDITAR VENTA</b></legend>
	<form action="" method="POST"  >
		<table>

		<input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>"  >
		<input type="hidden" name="id_venta"  value="<?php echo $id_venta;?>"  >


<?php 
if($depositos == 0)
{ // INCIO MOSTRAR FORMULARIO DEPOSITO VACIO
?>
	<tr>
		<th>FECHA DEL DEPOSITO 1
		</th>
		<td>
		<input type="date" name="fechaDep1" style="text-align: right;" > 
		</td>
	</tr>

	<tr>
		<th>IMPORTE DEL DEPOSITO 1
		</th>
		<td>
			<b>$</b><input 	type="number" 
							name="importeD1" 
							lang="nb" 
							step="0.01" 
							min="0"  
							value="" style="text-align: right;" 
							max='1200000' > 0000.00 sin comas
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
			<b>$</b><input 	type="number" 
							name="importeD2" 
							lang="nb" 
							step="0.01" 
							min="0"  
							value="" 
							style="text-align: right;" 
							max='1200000' > 0000.00 sin comas
		</td>
	</tr>
<?php 
} // TERMINA MOSTRAR FORMULARIO DEPOSITO VACIO 
else
{
	$consecutivoDep = '';
	while($rowdep = mysqli_fetch_assoc($dep_R))
		{ 
			$consecutivoDep += 1;
			$id_dep 	= $rowdep['id_dep'];
			$importeD 	= $rowdep['importeD'];
			$fechaD 	= $rowdep['fechaD'];
			$fechaD 	= strtotime($fechaD); // CONVIERTE EN SEGUNDOS UNIX
			$fechaD 	= date('Y-m-d', $fechaD); // DA FORMATO QUE SE PRESENTARA

			?>
				<input type='hidden' name="id_dep<?php echo $consecutivoDep;?>" 
				value ="<?php echo $id_dep; ?>" >
				<tr>
					<th>FECHA DEL DEPOSITO <?php echo $consecutivoDep;?>
					</th>
					<td>
					<input type="date" name="fechaDep<?php echo $consecutivoDep;?>" 
					value ="<?php echo $fechaD; ?>"  style="text-align: right;" > 
					</td>
				</tr>

				<tr>
					<th>IMPORTE DEL DEPOSITO <?php echo $consecutivoDep;?>
					</th>
					<td>
						<b>$</b><input 	type="number" 
										name="importeD<?php echo $consecutivoDep;?>" 
										lang="nb" 
										step="0.01" 
										min="0"  
										value="<?php echo $importeD;?>" 
										style="text-align: right;" 
										max='1200000' > 0000.00 sin comas
					</td>
				</tr>
			<?php
			global $arrayviejo;
			$arrayviejo .= ", ID_DEP".$consecutivoDep.": ".$id_dep.", IMPORTED".$consecutivoDep.": ".$importeD.", FECHAD".$consecutivoDep.": ".$fechaD ; 
		}
	if($depositos == 1){
		?>
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
			<b>$</b><input 	type="number" 
							name="importeD2" 
							lang="nb" 
							step="0.01" 
							min="0"  
							value="" 
							style="text-align: right;" 
							max='1200000' > 0000.00 sin comas
		</td>
	</tr>

		<?php
	}
}
?>


<tr>
	<th>FECHA DE FACTURA
	</th>
	<td>
		<input type="date" name="fechaFact" 
		value="<?php echo $fechaFact; ?>" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>IMPORTE FACTURA IVA INCLUIDO
	</th>
	<td>
		<b>$</b><input type="number" name="importe" 
		value="<?php echo $importe; ?>" lang="nb" step="0.01" min="0"  
		style="text-align: right;" max='1200000' > 0000.00 sin comas
	</td>
</tr>

<tr>
	<th>FOLIO REFACTURA
	</th>
	<td>
		<input type="text" name="folioF" 
		value="<?php echo $folioF; ?>" style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>TIPO DE PRECIO
	</th>

<?php 
	$pisoT 		= '';
	$flotillaT 	= '';
	if($precioT == 1){$flotillaT = 'checked';}else{$pisoT='checked';}
?>

	<td>
		<input type="radio" name="precioT" value='0' id='piso' <?php echo $pisoT; ?> >
		<label for = "piso" >PISO</label> 
	 	<input type="radio" name="precioT" value='1' id='flotilla' <?php echo $flotillaT; ?> >
	 	<label for = "flotilla" >FLOTILLA</label>
	</td>
</tr>

<tr>
	<th>NOMBRE DEL CLIENTE
	</th>
	<td>
	<input type="text" name="clienteN" 
	value="<?php echo $clienteN; ?>" 
	style="text-align: right;" > 
	</td>
</tr>

<tr>
	<th>NOMBRE DEL VENDEDOR
	</th>

<?php 
$ninguno = '';
$acb = '';
$gvf = '';
$jvo = '';
$jmvo = '';
$rmr = '';
$tlc = '';
$plg = '';

	switch($vendedor){
		case '1':
			$acb  = 'selected';
			break;
		case '2':
			$gvf  = 'selected';
			break;
		case '3':
			$jvo  = 'selected';
			break;
		case '4':
			$jmvo = 'selected';
			break;
		case '5':
			$rmr  = 'selected';
			break;
		case '6':
			$tlc  = 'selected';
			break;
		case '7':
			$plg  = 'selected';
			break;
		default:
			$ninguno = 'selected';
			break;
	}
?>

	<td>
		<select name="vendedor" >
			<option value='0' <?php echo  $ninguno ;?> >--</option>
			<option value='1' <?php echo  $acb ;?> >Adrian Colin Batalla</option>
			<option value='2' <?php echo  $gvf ;?> >Graciela Vera Flores</option>
			<option value='3' <?php echo  $jvo ;?> >Joel Velasco Osornio</option>
			<option value='4' <?php echo  $jmvo ;?> >Juan Manuel Velasco Osornio</option>
			<option value='5' <?php echo  $rmr ;?> >Raymundo Maldonado Rodulfo</option>
			<option value='6' <?php echo  $tlc ;?> >Teresa López Castillejos</option>
			<option value='7' <?php echo  $plg ;?> >Pedro Labra Gaytan</option>
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
		onKeyDown="cuenta2()" onKeyUp="cuenta2()" 
		cols="50" rows="1" maxlength='250'  
		><?php echo $obs; ?></textarea><br>
		Máximo 250 caracteres
		<input type='text' id='conceptoCTA' name='conceptoCTA' size='4' disabled >
	</td>
</tr>	
<?php  /////////////////////////////////////////////TERMINA CUENTA CARACTERES ?>

<input type ='hidden' name='arrayviejo' value="<?php echo  $arrayviejo ;?>">

 <tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="DatosM" value="EDITAR registro de VENTA"> 
	</td>
</tr>

		</table>
	</form>
</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO
//echo $arrayviejo;


	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
	    echo "<p>
	        <a href='semResTodo.php?pagina=$pagina' style='text-decoration:none;'>
	        <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de Ventas Seminuevos'>
	        </a>
	        </p>";
	 // BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>