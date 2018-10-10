<?php
include("1header.php");

echo "<meta charset='utf-8'>"; 

if($_SESSION["datos"] > 2){  // APERTURA PRIVILEGIOS

$uNEco = $_GET['uNEco'];
echo "<h2>".$uNEco."</h2><br />";

echo "<h3>DATOS VIEJOS</h3>";
include ("1datos.php");
include ("1placas.php");
$subido = ''; 

datosporeconomico($uNEco);

$marca;
$Serie;
$Vehiculo;
$Modelo;
$Color;
$Motor;
$claveVehicular;

$arrayviejo = 	"	marca = ".$marca
				.", serie ".$Serie
				.", vehiculo ".$Vehiculo
				.", modelo ".$Modelo
				.", color ".$Color
				.", motor ".$Motor
				.", clavevehicular ".$claveVehicular ;

//echo $arrayviejo;

if(isset($_POST['Datos'])){
	
	if($_POST['marca']!='' 
	&& $_POST['serie']!='' && strlen($_POST['serie'])==17 
	&& $_POST['tipo']!='' 
	&& $_POST['modelo']!='' 
	&& $_POST['color']!='' 
	&& $_POST['motor']!='' 
	&& $_POST['clavevehicular']!='' 	
	){

			$MARCA =	mysqli_real_escape_string($dbd2, $_POST['marca'] );
			$SERIE =	mysqli_real_escape_string($dbd2, $_POST['serie'] );
			$VEHICULO =	mysqli_real_escape_string($dbd2, $_POST['tipo'] );
			$MODELO =	mysqli_real_escape_string($dbd2, $_POST['modelo'] );
			$COLOR =	mysqli_real_escape_string($dbd2, $_POST['color'] );
			$MOTOR =	mysqli_real_escape_string($dbd2, $_POST['motor'] );
			$CLAVEVEHICULAR =	mysqli_real_escape_string($dbd2, $_POST['clavevehicular'] );

			$capturo = $_SESSION["id_usuario"];
			

			// hacer UPDATE para actualizar datos de factura			
			$sql_unidad_up = "UPDATE `jetvantlc`.`ubicacion` SET 
							 marca 		= '$MARCA', 
							 Serie 		= '$SERIE', 
							 Vehiculo 	= '$VEHICULO', 
							 Modelo 	= '$MODELO', 
							 Color 		= '$COLOR', 
							 Motor 		= '$MOTOR', 
							 claveVehicular = '$CLAVEVEHICULAR' , 
							 capturo 	= '$capturo' 
							 WHERE 
							 Economico 	= '$uNEco' 
							 LIMIT 1 " ;

			//echo $sql_unidad_up;
			 
			$unidad_up = mysqli_query($dbd2, $sql_unidad_up); 
			/*
			UPDATE `jetvantlc`.`facturaunidad` SET `Proveedor` = 'VAMSA  AGUASCALIENTES, S.A. DE C.V.',
			`FechaFactura` = 'miércoles,  04 de mayo de 2011',
			`FolioFactura` = '3 1078',
			`Importe` = '106628.01',
			`capturo` = '1' WHERE `facturaunidad`.`id` =1 LIMIT 1 ;
			*/

			if($unidad_up)
			{ 
				$sql_unidad_up 	= mysqli_real_escape_string($dbd2, $sql_unidad_up );
				$arrayviejo 	= mysqli_real_escape_string($dbd2, $arrayviejo );
				
				$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
				(id_cambios, capturo, updatequery, arrayviejo, fecharegistro) 
				VALUES 
				(NULL, '$capturo', '$sql_unidad_up', '$arrayviejo', CURRENT_TIMESTAMP ) ";
				
				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);

				//echo mysql_errno($conectar) . ": " . mysql_error($conectar) . "\n"; // PARA DETECTAR ERROR EN QUERY
				
				if($cambio_registrado)
				{
				echo '<h2>DATOS DE FACTURA ACTUALIZADOS CORRECTAMENTE</h2>';
				echo "<h3>DATOS NUEVOS</h3>";
				include ("1datos.php");
				}
			}
			$subido = 'ok'	;			
			}
			else
			{	
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
			}
}


if($subido!='ok'){?>

<fieldset><legend>Editar datos de Unidad</legend>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>ACTUALIZAR DATOS DE UNIDAD</h2>
	
<table>
<table>
	<tr><th>SERIE</th>
	<td><input type='text' name='serie' value="<?php echo $Serie;?>" placeholder='serie'></td></tr>
	
	<tr><th>MARCA</th>
	<td><input type='text' name='marca' value="<?php echo  $marca;?>" placeholder='marca'></td></tr>
	
	<tr><th>VEHICULO / TIPO</th>
	<td><input type='text' name='tipo' value="<?php echo $Vehiculo;?>" placeholder='tipo'></td></tr>
	
	<tr><th>AÑO DEL MODELO</th>
	<td><input type='text' name='modelo' value="<?php echo $Modelo;?>" placeholder='año modelo'></td></tr>
	
	<tr><th>COLOR</th>
	<td><input type='text' name='color' value="<?php echo $Color;?>" placeholder='color'></td></tr>

	<tr><th>MOTOR SERIE</th>
	<td><input type='text' name='motor' value="<?php echo $Motor;?>" placeholder='motor'></td></tr>
	
	<tr><th>CLAVE VEHICULAR</th>
	<td><input type='text' name='clavevehicular' value="<?php echo $claveVehicular;?>" placeholder='clave vehicular'></td></tr>

	<tr>
		<td colspan=2 style="text-align:center;" >
			<input id="gobutton2" type="submit" name="Datos" value="Actualizar Datos de Unidad"> 
		</td>
	</tr>
</table>
</form>

</fieldset>

<?php }
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>