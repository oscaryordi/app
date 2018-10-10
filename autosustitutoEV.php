<?php
include("1header.php"); 

if($_SESSION["sustituto"] > 0)
	{ //PRIVILEGIOS  VISTA A SUPERVISOR LOGISTICA
	 include ("nav_sust.php");  
	} // CIERRE PRIVILEGIOS
?>

</br>
</br>

<?php if($_SESSION["sustituto"] > 2)
{  // APERTURA PRIVILEGIOS 

	$capturoDV = $_SESSION["id_usuario"];

	@$id_sustituto 	= $_POST['id_sust'];

// INICIO Consultar FORMATO AUTO SUSTITUTO
$sql_sustituto = "SELECT * FROM `sustituto` WHERE `id_sust` = '$id_sustituto' LIMIT 1 "; 
$res_sustituto = mysqli_query($dbd2, $sql_sustituto);
@$matriz_r_sust = mysqli_fetch_array($res_sustituto);

@$serieF3 =			$matriz_r_sust[serieFallado];
@$serieS3 =			$matriz_r_sust[serieSustituto];
@$folioInventario =	$matriz_r_sust[id_formato];
@$fechaDevolucion =	$matriz_r_sust[fechaDev];
@$proyecto = 		$matriz_r_sust[proyecto];
@$motivo = 			$matriz_r_sust[motivo];
@$lugarResguardo = 	$matriz_r_sust[lugarResguardo];
@$capturo = 		$matriz_r_sust[capturo];
@$fecharegistro = 	$matriz_r_sust[fecharegistro];


idxserie($serieF3);
datosxid($id_unidad);
//datosporserie($serieF3);
$economicoF =	$Economico;
$serieF =		$Serie;
$placasF =		$Placas;
$tipoF =		$Vehiculo;


idxserie($serieS3);
datosxid($id_unidad);
//datosporserie($serieS3);
$economicoS =	$Economico;
$serieS =		$Serie;
$placasS =		$Placas;
$tipoS =		$Vehiculo;

$sql_ejec = "SELECT * FROM `usuarios` WHERE `id_usuario` = '$capturo' LIMIT 1 ";
$res_ejec = mysqli_query($dbd2, $sql_ejec);
@$matriz_ejec = mysqli_fetch_array($res_ejec);

@$nombreEjec = 	$matriz_ejec[nombre];
// TERMINA Consultar FORMATO AUTO SUSTITUTO

echo "<h2>REGISTRAR ENTREGA VIRTUAL <span style='color:blue;'>AL CLIENTE</span> </h2>";
echo "<table>";
echo "<tr>	<th>ID FORMATO SUSTITUTO</th>
			<td>$id_sustituto</td></tr>";
echo "<tr>	<th>FECHA</th>
			<td>$fecharegistro</td></tr>";
echo "<tr><th>PROYECTO</th>
			<td>$proyecto</td></tr>";
echo "<tr><th>MOTIVO</th>
			<td>$motivo</td></tr>";

echo "<tr><th>BASE</th>
			<td>$economicoF ::: $serieF ::: $placasF ::: $tipoF</td></tr>";

echo "<tr><th>SUSTITUTO</th>
			<td>$economicoS ::: $serieS ::: $placasS ::: $tipoS </td></tr>";

echo "<tr><th>DOMICILIO DE RESGUARDO</th>
			<td>$lugarResguardo</td></tr>";
echo "<tr><th>EJECUTIVO RESPONSABLE</th>
			<td>$nombreEjec</td></tr>";
echo "</table>";


########## ########## ########## ########## ########## 
// INICIO Procesar formulario
$actualizado = '';
if (isset($_POST['actualizar']) 
	&& $_POST['fechaI'] !== '' 
	)
	{ 
		// INICIO Formatear y limpiar datos
			$fechaI = 	mysqli_real_escape_string($dbd2, $_POST['fechaI']);
			$horaI 	= 	mysqli_real_escape_string($dbd2, $_POST['horaI']);
			$obs 	= 	strtoupper(mysqli_real_escape_string($dbd2, $_POST['obs']));
		// TERMINA Formatear y limpiar datos

			$capturo 	= $_SESSION["id_usuario"];
		
		// INICIO Update BD
			$formatoVirtual = 'DV'.$id_sustituto;
			$sql_sust_up = "UPDATE  `jetvantlc`.`sustituto`  SET 
			id_formatoI =   '$formatoVirtual',  
			fechaI 		=  '$fechaI',  
			horaI 		=   '$horaI',  
			virtualI 	=   '1'  
			WHERE id_sust = '$id_sustituto' LIMIT 1 ";
			$sust_R = mysqli_query($dbd2, $sql_sust_up );
			if(!$sust_R)
				{
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
				}
			$sql_sust_V = "	INSERT INTO  `jetvantlc`.`sustitutoVirtual` 
							(`id_sust_obs`, `id_sust`, `obs`, `capturo`)
							VALUES  (NULL, '$id_sustituto', '$obs', '$capturoDV') ";
			$sust_RV 	= mysqli_query($dbd2, $sql_sust_V );
			if(!$sust_RV)	
				{
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
				}					
		// TERMINA Update DB

		// INICIA Mensaje Exitoso
		if($sust_R && $sust_RV)
			{ 
				echo "<br><h2>REGISTRO DE ENTREGA VIRTUAL EXITOSA</h2><br>";
				$actualizado = 'si';
			}
		// TERMINA Mensaje Exitoso	
	}
// TERMINA Procesar formulario



########## ########## ########## ########## ########## 


if ($actualizado == ''){ // INICIA Mostrar Formulario
echo "<h3>FORMULARIO REGISTRAR ENTREGA VIRTUAL AL CLIENTE</h3>";
date_default_timezone_set('America/Mexico_city');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<fieldset>
<form action=" " method="POST">
	<table>
		<tr>
			<th colspan=2>FORMULARIO REGISTRAR ENTREGA VIRTUAL AL CLIENTE</th>
		</tr>
		
		<tr>
			<td>FECHA</td>
			<td>
				<input type="date" name="fechaI" value="<?php echo  date("Y-m-d"); ?>"  required >
				<input type="hidden" name="id_sust" value="<?php echo  $id_sustituto; ?>"   >
			</td>
		</tr>

		<tr>
			<td>HORA</td>
			<td>
				<input type="time" name="horaI" value="<?php  echo date("H:i:s"); ?>" >
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
	<td>OBSERVACIONES</td>
	<td>
		<textarea name="obs" id="concepto" 
		onKeyDown="cuenta2()" onKeyUp="cuenta2()" cols="50" rows="1" 
		value="<?php //echo $cuenta; ?>"  maxlength='150' ></textarea><br>
		Máximo 150 caracteres
		<input type='text' id='conceptoCTA' name='conceptoCTA' size='4' disabled >
	</td>
</tr>	
<?php  /////////////////////////////////////////////TERMINA CUENTA CARACTERES ?>



		<tr>
			<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="INICIAR SUSTITUTO"></td>
		</tr>

	</table>
</form>
</fieldset>

<?php };  // TERMINA Mostrar formulario

} // CIERRE PRIVILEGIOS 

include("1footer.php"); ?>