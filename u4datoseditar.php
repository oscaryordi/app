<?php
include("1header.php");

echo "<meta charset='utf-8'>";

if($_SESSION["datos"] > 2){  // APERTURA PRIVILEGIOS 

$id_unidad = $_GET['id_unidad'];

$subido = '';

datosxid($id_unidad);

$arrayviejo = "	economico = ".$Economico
			.", marca = ".$Marca
			.", serie ".$Serie
			.", vehiculo ".$Vehiculo
			.", modelo ".$Modelo
			.", color ".$Color
			.", motor ".$Motor
			.", clavevehicular ".$ClaveVehicular
			.", Cilindros ".$Cilindros
			.", Transmision ".$Transmision ;

echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";

echo "<h3>DATOS VIEJOS</h3>";
include ("u4datos.php");
//include ("u5placas.php");    
    
if(isset($_POST['Datos'])){
	
	if($_POST['economico']!='' 
    && $_POST['marca']!='' 
	&& $_POST['serie']!='' && strlen($_POST['serie'])==17 
	&& $_POST['tipo']!='' 
	&& $_POST['modelo']!='' 
	&& $_POST['color']!='' 
	&& $_POST['motor']!='' 
	&& $_POST['clavevehicular']!='' 	
	){
			$ECONOMICO =	mysqli_real_escape_string($dbd2, $_POST['economico']);
			$MARCA =		mysqli_real_escape_string($dbd2, $_POST['marca']);
			$SERIE =		mysqli_real_escape_string($dbd2, $_POST['serie']);
			$VEHICULO =		mysqli_real_escape_string($dbd2, $_POST['tipo']);
			$MODELO =		mysqli_real_escape_string($dbd2, $_POST['modelo']);
			$COLOR =		mysqli_real_escape_string($dbd2, $_POST['color']);
			$MOTOR =		mysqli_real_escape_string($dbd2, $_POST['motor']);
			$CLAVEVEHICULAR =mysqli_real_escape_string($dbd2, $_POST['clavevehicular']);
			$TRANSMISION =	mysqli_real_escape_string($dbd2, $_POST['transmision']);
			$CILINDROS =	mysqli_real_escape_string($dbd2, $_POST['cilindros']);

			$capturo = $_SESSION["id_usuario"];

			// hacer UPDATE para actualizar datos de factura			
			$sql_unidad_up = "	UPDATE `jetvantlc`.`ubicacion` 
								SET 
								 Economico 	='$ECONOMICO', 
								 marca 		='$MARCA', 
								 Serie 		='$SERIE', 
								 Vehiculo 	= '$VEHICULO', 
								 Modelo 	= '$MODELO', 
								 Color 		= '$COLOR', 
								 Motor 		='$MOTOR', 
								 claveVehicular = '$CLAVEVEHICULAR' , 
								 Transmision = '$TRANSMISION',
								 Cilindros 	= '$CILINDROS', 
								 capturo 	='$capturo' 
								 WHERE 
								 id = '$id_unidad' 
								 LIMIT 1 " ;

			$unidad_up = mysqli_query($dbd2, $sql_unidad_up); 

			if($unidad_up)
			{ 
				$sql_unidad_up 	= mysqli_real_escape_string($dbd2,  str_replace('	', '', $sql_unidad_up)  );
				$arrayviejo 	= mysqli_real_escape_string($dbd2, $arrayviejo );
				
				$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
				(id_cambios, capturo, updatequery, arrayviejo, fecharegistro) 
				VALUES 
				(NULL, '$capturo', '$sql_unidad_up', '$arrayviejo', CURRENT_TIMESTAMP ) ";
				
				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);

				//echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2) . "\n"; // PARA DETECTAR ERROR EN QUERY
				
				if($cambio_registrado)
				{
					echo '<h2>DATOS DE UNIDAD ACTUALIZADOS CORRECTAMENTE</h2>';
					echo "<h3>DATOS NUEVOS</h3>";
					include ("u4datos.php");
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
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<fieldset><legend>Editar datos de Unidad</legend>
<form id='alta'  action='' method='POST' > 
	<h2>ACTUALIZAR DATOS DE UNIDAD</h2>

<table>
    <tr><th>ECONOMICO</th>
	<td><input type='text' name='economico' value="<?php echo $Economico;?>" placeholder='economico'></td></tr>
	
    <tr><th>SERIE</th>
	<td><input type='text' name='serie' value="<?php echo $Serie;?>" placeholder='serie'></td></tr>
	
	<tr><th>MARCA</th>
	<td><input type='text' name='marca' value="<?php echo  $Marca;?>" placeholder='marca'></td></tr>
	
	<tr><th>VEHICULO / TIPO</th>
	<td><input type='text' name='tipo' value="<?php echo $Vehiculo;?>" placeholder='tipo'></td></tr>
	
	<tr><th>AÑO DEL MODELO</th>
	<td><input type='text' name='modelo' value="<?php echo $Modelo;?>" placeholder='año modelo'></td></tr>
	
	<tr><th>COLOR</th>
	<td><input type='text' name='color' value="<?php echo $Color;?>" placeholder='color'></td></tr>

	<tr><th>MOTOR SERIE</th>
	<td><input type='text' name='motor' value="<?php echo $Motor;?>" placeholder='motor'></td></tr>
	
	<tr><th>CLAVE VEHICULAR</th>
	<td><input type='text' name='clavevehicular' value="<?php echo $ClaveVehicular;?>" placeholder='clave vehicular'></td></tr>


	<tr><th>CILINDROS</th>
	<td><input type='text' name='cilindros' value="<?php echo $Cilindros;?>" placeholder='cilindros'></td></tr>

	<tr><th>TRANSMISION</th>
	<td>
			<table style='border: solid 0px;'>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='transmision' id='A0' value='1' <?php echo $chq = ($Transmision == 1)?'checked':'';?> 
					style='min-width: 30px;' >
				</td>
				<td style='text-align: left;border: solid 0px;'>
					<label for='A0'>AUTOMATICA</label>
				</td>
			</tr>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='transmision' id='A1' value='2'  <?php echo $chq = ($Transmision == 2)?'checked':'';?>
					style='min-width: 30px;' >
				</td>
				<td style='text-align: left;border: solid 0px;'>
					<label for='A1'>ESTANDAR</label><br>
				</td>
			</table>
	</td></tr>
	<tr>
		<td colspan=2 style="text-align:center;" >
			<input id="gobutton2" type="submit" name="Datos" value="Actualizar Datos de Unidad"> 
		</td>
	</tr>
</table>
</form>

</fieldset>

<?php } 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td>";

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>