<?php
include("1header.php");
 
if($_SESSION["sustituto"] > 0){ //PRIVILEGIOS  VISTA A OPERADORES LOGISTICOS ENTRADA SALIDA 
	include ("nav_sust.php");
} // CIERRE PRIVILEGIOS

echo "</br></br><h2>SOLICITUD DE AUTO SUSTITUTO</h2></br>";

if($_SESSION["sustituto"] > 0){ //PRIVILEGIOS  VISTA A OPERADORES LOGISTICOS ENTRADA SALIDA 

?>
<style>
#Afallado 	{background-color:red; color: white;font-weight: bold;}
#Asustituto {background-color:yellow;  font-weight: bold;}
#Fundamentacion {background-color:#7CD612; color: white; font-weight: bold;}
</style>
<?php

global $id_clienteF;
global $id_contratoF;

global $AutoFallado;
global $economicoF;
global $serieF;
global $placasF;
global $tipoF;
global $colorF;
global $AutoSustituto; 

global $serieF3; // BASE
global $serieS3; // SUSTITUTO

global $id_unidadF; // BASE
global $id_unidadS; // SUSTITUTO

$AutoSustituto 	= 0; // NO SE HA INDICADO EL SUSTITUTO
$AutoFallado 	.= 0; // NO SE HA indicado AUTO FALLADO

// #######################################################################################################################
		if(isset($_POST['SustitoRegistrar'])
			&& $_POST['id_unidadF'] > 0 
			&& $_POST['id_unidadS'] > 0 
		)
		{ // SE HA INDICADO FUNDAMENTACION
				$AutoFallado 	= 1;
				$AutoSustituto 	= 1; 
				$serieF3 		= $_POST['serieF2']; // BASE
				$serieS3 		= $_POST['serieS1']; // SUSTITUTO
				$id_unidadF 	= $_POST['id_unidadF']; // BASE
				$id_unidadS 	= $_POST['id_unidadS']; // SUSTITUTO

				// echo $serieF3."<br>";
				// echo strlen($serieF3)."<br>";
				// echo $serieS3."<br>";				
				// echo strlen($serieS3)."<br>";
			if(	
				strlen($serieF3)==19 && 
				strlen($serieS3)==18 && 
//				$_POST['serieS1']!='' && 
				$_POST['folioInventario']!='' && 
				$_POST['fechaDevolucion']!='' && 
			//	$_POST['proyecto']!='' && 
				$_POST['motivo']!='' && 
				$_POST['lugarResguardo']!='' 
				)
				{
			
					// $serieF3 = $_POST['serieF2']; // BASE
					// $serieS3 = $_POST['serieS1']; // SUSTITUTO
					
					$id_clienteF 	= 	mysqli_real_escape_string($dbd2, $_POST['id_clienteF']);
					$id_contratoF 	= 	mysqli_real_escape_string($dbd2, $_POST['id_contratoF']);	
					$folioInventario = 	mysqli_real_escape_string($dbd2, $_POST['folioInventario']);
					$fechaDevolucion = 	mysqli_real_escape_string($dbd2, $_POST['fechaDevolucion']);
					$proyecto 		= 	mysqli_real_escape_string($dbd2, $_POST['proyecto']);
					$motivo 		= 	mysqli_real_escape_string($dbd2, $_POST['motivo']);
					$lugarResguardo = 	mysqli_real_escape_string($dbd2, $_POST['lugarResguardo']);

					$capturo = $_SESSION['id_usuario'];
					
					$sql_SR = "INSERT INTO sustituto  
					(id_sust, id_cliente, id_contrato, id_unidadF, serieFallado, id_unidadS, serieSustituto, id_formato, 
					fechaDev, proyecto, motivo, lugarResguardo, capturo ) 
					VALUES 
					(NULL, '$id_clienteF', '$id_contratoF', '$id_unidadF', '$serieF3',  '$id_unidadS', '$serieS3', '$folioInventario', 
					'$fechaDevolucion', '$proyecto', '$motivo', '$lugarResguardo', '$capturo')";

					$inserta_sustituto 	= mysqli_query($dbd2, $sql_SR);
					$id_sustituto 		= mysqli_insert_id($dbd2);
					
					//	echo $id_sustituto; CHECAR ULTIMO INSERTADO
					//	echo $sql_SR; VER LA QUERY ANTES DE EJECUTAR
					//?id_inventario=".$id_inventario."'
					
					if($id_sustituto > 0){ echo "<br>Formato llenado correctamente<br>";} // hacer validacion de real insercion
				
					 ?>
					<a href="AutoSustitutoVerId.php?id_sustituto=<?php echo $id_sustituto;?>" target='blank'>Ver formato</a>
					| <a href="autosustituto.php">Solicitar otro</a>
					| <a href="index.php">Ir a inicio</a>				
					<?php
				}
				else 
				{
					echo "<br><h3><a href = 'autosustituto.php'  style='text-decoration:none;' >Datos incompletos favor de volver a empezar</a></h3>";
				}
				
		} // CIERRE INSERCION Y MENSAJE EXITOSO
// #######################################################################################################################

		@$mal_llenado = $_POST['mal_llenado'];
		if($mal_llenado == 1){ // MAL LLENADO


		if($_POST['uPlacasS']!='' || $_POST['uNEcoS']!='' || $_POST['uSerieS']!='' && isset($_POST['AutoSustituto']) )
		{ // SE HA INDICADO AUTO SUSTITUTO
			$AutoFallado = 1;
			$AutoSustituto = 1; 

			@$uPlacasS 	= $_POST['uPlacasS'];
			@$uNEcoS 	= $_POST['uNEcoS'];
			@$uSerieS 	= $_POST['uSerieS'];

			$id_clienteF 	= $_POST['id_clienteF'];
			$id_contratoF 	= $_POST['id_contratoF'];
			$id_unidadF = $_POST['id_unidadF'];
			$economicoF = $_POST['economicoF1'];
			$serieF 	= $_POST['serieF1'];
			$placasF 	= $_POST['placasF1'];
			$tipoF 		= $_POST['tipoF1'];
			$colorF 	= $_POST['colorF1'];

				if(isset($uPlacasS) && $uPlacasS !== ''){
					//datosporplaca($uPlacasS);
					$placas = $uPlacasS;
					idxplaca($placas);
					}
				elseif(isset($uNEcoS) && $uNEcoS !== ''){
					//datosporeconomico($uNEcoS);
					$economico = $uNEcoS;
					idxeconomico($economico);
					}
				elseif(isset($uSerieS) && $uSerieS !== ''){
					//datosporserie($uSerieS);
					$serie = $uSerieS;
					idxserie($serie);
					}
				$id_unidadS		= $id_unidad;
				datosxid($id_unidad);

		if( trim($serieF) != trim($Serie) ){ //INICIA VALIDAR NO SEAN IGUALES
		?> 


			 <h3>PASO 3. Complete la informacion requerida</h3>
			<table><caption id='Afallado' >Auto FALLADO</caption>  
			<tr> 
			<th>ECONOMICO</th> <td><?php echo @$economicoF;?></td>
			<th>PLACAS</th> <td><?php echo @$placasF;?></td>
			<th>SERIE</th> <td ><?php echo @$serieF;?></td>
			<th>TIPO</th> <td><?php echo @$tipoF;?></td>
			<th>COLOR</th> <td><?php echo @$colorF;?></td>
			</tr>
			</table>
			
			<table><caption id='Asustituto'>Auto SUSTITUTO</caption>  
			<tr> 
			<th>ECONOMICO</th> <td><?php echo @$Economico;?></td>
			<th>PLACAS</th> <td><?php echo @$Placas;?></td>
			<th>SERIE</th> <td ><?php echo @$Serie;?></td>
			<th>TIPO</th> <td><?php echo @$Vehiculo;?></td>
			<th>COLOR</th> <td><?php echo @$Color;?></td>
			</tr>
			</table>

			<?php //FORMULARIO 3 FUNDAMENTACION
			//$id_clienteF 	= $id_cliente;  VIENE DE ABAJO
			//$id_contratoF 	= $id_contrato;   VIENE DE ABAJO

			contratoxid($id_contratoF); // para pintar datos de contrato
			clientexid($id_clienteF); // para pintar dstos de cliente

			?>

			<form action="" method="POST">
				<table><caption id='Fundamentacion'>Indique FUNDAMENTACION</caption> 
					<tr><th>1. Folio Inventario</th>
						<td>
							<input type="" name="folioInventario" value="<?php echo @$_POST['folioInventario'];?>" placeholder='Folio Inventario / Formato de salida' required >
						</td>
					</tr>
					<tr><th>2. Fecha Devolución</th>
						<td>  	
							<input type="date" name="fechaDevolucion" value="<?php echo @$_POST['fechaDevolucion'];?>" placeholder="aaaa-mm-dd"  required  >aaaa-mm-dd --- Fecha probable de devolucion de la unidad
						</td>
					</tr>
					<tr>
						<th>3. Proyecto</th>
						<td>
								<?php echo 
						  		"ID:".$id_alan
						  		."<BR> cte: ".$razonSocial
						  		."<BR> cto: ".$numero
						  		."  "; /*$proyecto*/  
						  		?>
						<!-- 	<input type="" name="proyecto" value="<?php echo @$_POST['proyecto'];?>" placeholder='Proyecto/Cliente'  disabled  >-->
						</td>
					</tr>

			<?php  /////////////////////////////////////////////CUENTA CARACTERES ?>
						<script>
							function cuenta(){
								document.getElementById("motivo1cta").value=document.getElementById("motivo1").value.length	
							}
						</script>
					<tr><th>4. Motivo</th><td>
							
							<textarea type="" id='motivo1' name="motivo"  placeholder='Motivo' 
								onKeyDown="cuenta()" onKeyUp="cuenta()" cols="40" rows="6" value="<?php echo @$_POST['motivo'];?>"  required  
							></textarea>

							<input type='text' id='motivo1cta' name='caracteres' size='4' disabled >Describir motivo, hasta 250 caracteres</td></tr>

			<?php  /////////////////////////////////////////////CUENTA CARACTERES ?>
						<script>
							function cuenta2(){
								document.getElementById("domicilio1cta").value=document.getElementById("domicilio1").value.length	
							}
						</script>
					<tr><th>5. Lugar de resguardo</th><td>
							<textarea type="" id='domicilio1' name="lugarResguardo" 
							onKeyDown="cuenta2()" onKeyUp="cuenta2()" cols="40" rows="6"
							value="<?php echo @$_POST['lugarResguardo'];?>" placeholder='Domicilio'  required  ></textarea>

							<input type='text' id='domicilio1cta' name='dom1cta' size='4' disabled >


							Indique ubicación (Domicilio) de unidad BASE, hasta 250 caracteres</td></tr>
					<tr>
							<INPUT   TYPE="hidden" NAME="id_clienteF" value="<?php echo $id_clienteF ;?> " >
							<INPUT   TYPE="hidden" NAME="id_contratoF" value="<?php echo $id_contratoF ;?> " >

							<INPUT   TYPE="hidden" NAME="id_unidadF" value="<?php echo $id_unidadF ;?> " >
							<INPUT   TYPE="hidden" NAME="economicoF2" value="<?php echo $economicoF ;?> " >
							<INPUT   TYPE="hidden" NAME="serieF2" value="<?php echo $serieF ;?> ">
							<INPUT   TYPE="hidden" NAME="placasF2" value="<?php echo $placasF ;?> ">
							<INPUT   TYPE="hidden" NAME="tipoF2" value="<?php echo $tipoF ;?> ">
							<INPUT   TYPE="hidden" NAME="colorF2" value="<?php echo $colorF ;?> ">

							<INPUT   TYPE="hidden" NAME="id_unidadS" value="<?php echo $id_unidadS ;?> " >
							<INPUT   TYPE="hidden" NAME="economicoS1" value="<?php echo $Economico ;?> " >
							<INPUT   TYPE="hidden" NAME="serieS1" value="<?php echo $Serie ;?> ">
							<INPUT   TYPE="hidden" NAME="placasS1" value="<?php echo $Placas ;?> ">
							<INPUT   TYPE="hidden" NAME="tipoS1" value="<?php echo $Vehiculo ;?> ">
							<INPUT   TYPE="hidden" NAME="colorS1" value="<?php echo $Color ;?> ">

					<td colspan=2 style="text-align:center;" >
					<a onClick="javascript: return confirm('Confirma proceder a registrar SOLICITUD DE UNIDAD SUSTITUTO'); " >
					<input id="gobutton2" type="submit" name="SustitoRegistrar" value="Hacer solicitud">
					</a>
					</td>
				</table>
			</form>

<?php		} // TERMINA VALIDADO NO SEAN IGUALES
			else {
					echo "<br><h3><a href = 'autosustituto.php' style='text-decoration:none;'>  ¡¡¡ &#9785; AUTOSUSTITUTO Y AUTOFALLADO NO PUEDE SER EL MISMO !!!   </a></h3>";
			}

		}	// CIERRE SE HA INDICADO AUTO SUSTITUTO SE ENVIA FUNDAMENTACION
		
			else {
					echo "<br><h3><a href = 'autosustituto.php'  style='text-decoration:none;' >Datos incompletos favor de volver a empezar NO INDICO SUSTITUTO </a></h3>";
				}
			
		
		} // MAL LLENADO

if(isset($_POST['AutoFallado'])){ // SE HA INDICADO AUTO FALLADO
$AutoFallado = 1; 

@$uPlacas 	= $_POST['uPlacas'];
@$uNEco 	= $_POST['uNEco'];
@$uSerie 	= $_POST['uSerie'];

if(isset($uPlacas) && $uPlacas !== ''){
	//datosporplaca($uPlacas);
	$placas = $uPlacas;
	idxplaca($placas);
	}
elseif(isset($uNEco) && $uNEco !== ''){
	//datosporeconomico($uNEco);
	$economico = $uNEco;
	idxeconomico($economico);
	}
elseif(isset($uSerie) && $uSerie !== ''){
	//datosporserie($uSerie);
	$serie = $uSerie;
	idxserie($serie);
	}
$id_unidadF		= $id_unidad;
unidadAsignacion($id_unidad);
datosxid($id_unidad);

$id_clienteF 	= $id_cliente; 
$id_contratoF 	= $id_contrato;
	
$economicoF 	= $Economico;
$serieF 		= $Serie;
$placasF 		= $Placas;
$tipoF 			= $Vehiculo;
$colorF 		= $Color;

?>
		<h3>PASO 2. Indique auto SUSTITUTO</h3>
		<table><caption id='Afallado' >Auto FALLADO</caption>  
		<tr> 
		<th>ECONOMICO</th> <td><?php echo @$economicoF;?></td>
		<th>PLACAS</th> <td><?php echo @$placasF;?></td>
		<th>SERIE</th> <td ><?php echo @$serieF;?></td>
		<th>TIPO</th> <td><?php echo @$tipoF;?></td>
		<th>COLOR</th> <td><?php echo @$colorF;?></td>
		</tr>
		</table>

	<?php 
	if($AutoSustituto == 0)
	{ // FORMULARIO AUTO SUSTITUTO
	// FORMULARIO AUTO SUSTITUTO ?>
		<br> 
		<fieldset><legend>Indique auto SUSTITUTO</legend>
		<table>
			<FORM action="" method="POST">
				<tr>
					<th colspan=4 >Indique uno de los 3 siguientes datos.</th>
				</tr>
				<tr>
					<td>Económico<INPUT TYPE="text" NAME="uNEcoS" placeholder="Pon aqui el economico" autofocus></td>
					<td>Placas<INPUT TYPE="text" NAME="uPlacasS" placeholder="Aqui van las placas"></td>
					<td>Serie<INPUT   TYPE="text" NAME="uSerieS" placeholder="Aqui la serie"></td>
					
					<INPUT   TYPE="hidden" NAME="id_clienteF" value="<?php echo $id_clienteF ;?> " >
					<INPUT   TYPE="hidden" NAME="id_contratoF" value="<?php echo $id_contratoF ;?> " >
					<INPUT   TYPE="hidden" NAME="id_unidadF" value="<?php echo $id_unidadF ;?> " >
					<INPUT   TYPE="hidden" NAME="economicoF1" value="<?php echo $economicoF ;?> " >
					<INPUT   TYPE="hidden" NAME="serieF1" value="<?php echo $serieF;?> ">
					<INPUT   TYPE="hidden" NAME="placasF1" value="<?php echo $placasF ;?> ">
					<INPUT   TYPE="hidden" NAME="tipoF1" value="<?php echo $tipoF ;?> ">
					<INPUT   TYPE="hidden" NAME="colorF1" value="<?php echo $colorF ;?> ">
					<INPUT   TYPE="hidden" NAME="mal_llenado" value="1">
					<td colspan=3 align=center ><INPUT id="gobutton2" TYPE="SUBMIT" NAME="AutoSustituto" VALUE="AUTO SUSTITUTO"></td>
				</tr>
			</FORM>
		</table>
		</fieldset> 
	<?php
	}	// CIERRE FORMULARIO AUTO SUSTITUTO

}	// CIERRE ENTRADA IF AUTO FALLADO

if($AutoFallado == 0)
	{ // FORMULARIO AUTO FALLADO ?>
		<h3>PASO 1. Indique auto a sustituir</h3>
		<fieldset><legend>Indique auto a SUSTITUIR</legend>
		<table>
			<FORM action="" method="POST">
				<tr>
					<th colspan=4 >Indique uno de los 3 siguientes datos.</th>
				</tr>
				<tr>
					<td>Económico<INPUT TYPE="text" NAME="uNEco" placeholder="Pon aqui el economico" autofocus></td>
					<td>Placas<INPUT TYPE="text" NAME="uPlacas" placeholder="Aqui van las placas"></td>
					<td>Serie<INPUT   TYPE="text" NAME="uSerie" placeholder="Aqui la serie"></td>
					<td colspan=3 align=center ><INPUT id="gobutton2" TYPE="SUBMIT" NAME="AutoFallado" VALUE="AUTO EN FALLA"></td>
				</tr>
			</FORM>
		</table>
		</fieldset>
	<?php
	} //FORMULARIO AUTO FALLADO 
} // CIERRE PRIVILEGIOS
echo "</br>";
include("1footer.php");?>