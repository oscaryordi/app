<?php
include("1header.php");

if($_SESSION["gps"] > 0){ // VISTA A C4
include ("nav_gps.php");

$id_alertaGps = mysqli_real_escape_string($dbd2, $_GET['id_alertaGps'] );


gpsAxid_A($id_alertaGps);
datosxid($gpsAid_unidad);
echo "<h2>EDITAR ALERTA DE MANTENIMIENTO GPS</h2>";
echo "	<table>
			<tr><td>
			<b>{$Economico}</b> ::: {$Serie} ::: {$Placas}  ::: <br>
				{$Vehiculo}
			</td>
			</tr>
			<tr>
				<td>
				Alerta Creada : $gpsAfechaReg
				</td>
			<tr>
		</table>";

$subido = '';

if(isset($_POST['Datos']))
{
	if(
		   $_POST['atendido']	!='' 
	   	&& $_POST['mensaje']!='' 
	    && $_POST['fechaFin']	!='' 
	   )
	{
	$mensaje 	= mysqli_real_escape_string($dbd2, $_POST['mensaje']);
	$fechaFin 	= mysqli_real_escape_string($dbd2, $_POST['fechaFin']);
	$atendido 	= mysqli_real_escape_string($dbd2, $_POST['atendido']);

	$capturo 	= $_SESSION["id_usuario"];

	// VALIDAR PASO DE ID's
	echo $mensaje." - ".$fechaFin." - ".$atendido ;

/*	// INICIO QUERY CANDADO NO SE DUPLIQUE
	$sql_existe = "SELECT * FROM gpsAsignado WHERE id_unidad = '$id_unidad' AND 
				id_imei = '$id_imei' AND 
				id_linea = '$id_linea' AND 
				fechaInicio = '$fechaInicio' LIMIT 1 ";

	//$sql_existe_resp = mysqli_query($dbd2, $sql_existe );
	// TERMINA QUERY CANDADO NO SE DUPLIQUE
 */ 
		$proceder = 1;

		// CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION 
		// FORMULA PARA SABER SI HUBO RESULTADOS //if(mysqli_affected_rows($dbd2) == 0) 
		if($proceder == 1) 
		{
		//date_default_timezone_set('America/Mexico_city');
		//$fechaReg = date("Y-m-d H:i:s");

		$gpsA_up = " UPDATE gpsAlerta SET 
					 mensaje 	= '$mensaje' , 
					 fechaFin 	= '$fechaFin', 
					 atendido 	= '$atendido' , 
					 capturoF	= '$capturo' 
					 WHERE id_alertaGps = '$id_alertaGps' ";
		$gpsA_up_R 	= mysqli_query($dbd2, $gpsA_up);

			if($gpsA_up_R)
			{ 
				echo '<h2>EDICION DE ALERTA CORRECTO</h2>';
				echo "<a href='gpsAlertaRes.php'>IR A RESUMEN DE ALERTAS</a>";
			}
 			$subido = 'ok'	;
		}
	  	else
	  	{
	  		echo "<p>ALERTA YA EXISTE</p>";
	  	}
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}

if($subido!='ok'){ ?>


<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
textarea{width:auto;}
</style>


<?php // FECHA DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>

<form id='alta'  action='' method='POST' > 

<table>
<h3>FORMULARIO DE EDICION</h3>

	<tr>
		<th>MENSAJE</th>
		<td >
			<textarea name='mensaje' ><?php echo $gpsAmensaje; ?></textarea>
		</td>
	</tr>

	<tr><th>FECHA DE ATENCION</th>
		<td><input type='date' name='fechaFin' value="<?php echo date("Y-m-d");?><?php echo $gpsAfechaFin;?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td>
 		</td>
		<td>	   
    <tr>

<?php 
$siChecked = ($gpsAatendido == 1)?'checked':'';
$noChecked = ($gpsAatendido == 0)?'checked':'';
?>

	<tr><th>ATENDIDO</th>
		<td >
			<table style='border: solid 0px;'>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='atendido' id='A0' value='1'  <?php echo $siChecked; ?>
					style='min-width: 30px;' >
				</td>
				<td style='text-align: left;border: solid 0px;'>
					<label for='A0'>SI</label>
				</td>
			</tr>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='atendido' id='A1' value='0' <?php echo $noChecked; ?>
					style='min-width: 30px;' >
				</td>
				<td style='text-align: left;border: solid 0px;'>
					<label for='A1'>NO</label><br>
				</td>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="EDITAR Alerta"> 
		</td>
	</tr>


</table>
</form>
<?php }
} // FIN PRIVILEGIO VISTA C4 
include("1footer.php");?>