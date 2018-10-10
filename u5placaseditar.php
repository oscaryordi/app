<?php
include("1header.php");
echo "<meta charset='utf-8'>"; 

if($_SESSION["placas"] > 2){  // APERTURA PRIVILEGIOS

$id_unidad 		= $_GET['id_unidad'];
$placaEditar 	= $_GET['placas'];
//$estadoEmplaca 	= $_GET['estadoEmplaca'];

// TRATAMIENTO DE FECHA
?>
<!--<script src="js/jquery-1.11.2.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--<script src="js/jquery-ui.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'dd/mm/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
		};
	$.datepicker.setDefaults($.datepicker.regional['es']);

	$(function() {
	$( "#fechaAsignacionN" ).datepicker({changeYear: true, changeMonth: true});
	});
</script>
<?php
// TRATAMIENTO DE FECHA

// INICIA OBTENER ENTIDAD ACTUAL
$sqlEP 		= "SELECT estadoE, fechaAsignacion FROM `placa` WHERE Placas = '$placaEditar' LIMIT 1 ";
$sqlEP_R 	= mysqli_query($dbd2, $sqlEP);
$sqlEP_R_m 	= mysqli_fetch_array($sqlEP_R);
$id_estadoEP 		= $sqlEP_R_m['estadoE'];
$fechaAsignacionV 	= $sqlEP_R_m['fechaAsignacion'];
// TERMINA OBTENER ENTIDAD ACTUAL

$subido = '';

datosxid($id_unidad);
$arrayviejo = "id_unidad = ".$id_unidad.", placas = ".$placaEditar ;

echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";
include ("u4datos.php");
	
if(isset($_POST['Datos']))
{
	$proceder = 1;
	if(  strlen(limpiarVariableRFC($_POST['placaCorregida'])) > 0 ){$proceder = 1;} else {$proceder = 0;}

	if($_POST['placaCorregida']!='' && $proceder == 1 )
	{
		$placaCorregida 	= limpiarVariableRFC(mysqli_real_escape_string($dbd2, $_POST['placaCorregida'] ));
		$estadoE 			= mysqli_real_escape_string($dbd2, $_POST['estadoE'] );
		$fechaAsignacionN 	= mysqli_real_escape_string($dbd2, $_POST['fechaAsignacionN'] );
		$capturo 			= $_SESSION["id_usuario"];

		// VALIDA FORMATO DE FECHA
		function validateDate($date, $format = 'Y-m-d H:i:s')
			{
				$d = DateTime::createFromFormat($format, $date);
				return $d && $d->format($format) == $date;
			}

		if( validateDate($fechaAsignacionN, 'Y-m-d') == true )
			{ ;}
		else
			{ 
				$date = str_replace('/', '-', $fechaAsignacionN);
				$fechaAsignacionN = date('Y-m-d', strtotime($date));
			}
		// VALIDA FORMATO DE FECHA

		
		// OBTENER TERMINACION NUMERICA DE PLACA
		$placa1 		= $placaCorregida;
		finalplaca($placa1);

		// hacer UPDATE para actualizar datos de factura			
		$sql_placas_up 	= "	UPDATE `jetvantlc`.`placa` 
							SET 
		 					Placas 			= '$placaCorregida',  
		 					terminacionN 	= '$finalPlaca',
		 					estadoE 		= '$estadoE', 
		 					fechaAsignacion = '$fechaAsignacionN', 
							capturo 		= '$capturo' 
							WHERE 
							id_unidad = '$id_unidad' 
							AND 
							Placas = '$placaEditar' 
							LIMIT 1 " ;

		$placas_up = mysqli_query($dbd2, $sql_placas_up); 

		if($placas_up)
		{ 
			$sql_placas_up 	= mysqli_real_escape_string($dbd2, $sql_placas_up );
			$arrayviejo 	= mysqli_real_escape_string($dbd2, $arrayviejo );

			$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
				(id_cambios, capturo, updatequery, arrayviejo, fecharegistro) 
				VALUES (NULL, '$capturo', '$sql_placas_up', '$arrayviejo', CURRENT_TIMESTAMP ) ";
				
			$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
			if($cambio_registrado)
			{
				echo '<h2>PLACA CORREGIDA CORRECTAMENTE</h2>';
				echo "<h3>DATOS NUEVOS</h3>";
				include ("u5placas.php");
			}
		}
		else
		{
			echo "<span style='color:red;'>".mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "</span>\n";
		}
		$subido = 'ok'	;			
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}

if($subido!='ok'){
include ("u5placas.php"); ?>

<h3>PLACAS A EDITAR</h3>

<fieldset><legend>-</legend>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
<table>
<tr><td>PLACAS</td>
	<td><input type='text' name='placaCorregida' value="<?php echo $placaEditar;?>" placeholder='Placa a editar'></td>
</tr>

<?php 
// INICIO FORMATO DE FECHA ANTIGUA
$fechaAsignacionV = date('d/m/Y', strtotime($fechaAsignacionV));
// TERMINA FORMATO DE FECHA ANTIGUA
?>

<tr>
	<td>Fecha de Expedición de la Tarjeta de Circulación</td>
	<td>
		<input type='text' id='fechaAsignacionN' name='fechaAsignacionN' value='<?php echo $fechaAsignacionV;?>' placeholder='dd/mm/aaaa' />
	</td>
</tr>

<?php
##### ##### ##### ##### #####
// INICIA SELECT OPTION AUTOMATICO DE ESTADOS
$sqlE 		= "SELECT * FROM `estadosR` LIMIT 0, 33 ";
$sqlE_R 	= mysqli_query($dbd2, $sqlE);
echo "<tr>";
echo "<td>ENTIDAD DE EMPLACAMIENTO</td>";
echo "<td><select name='estadoE'>";
while ($sqlE_R_m = mysqli_fetch_array($sqlE_R))
{
	$id_estado 	= $sqlE_R_m['id_estado'];
	$nombre 	= $sqlE_R_m['nombre'];
	$selectedE 	= '';
	if($id_estadoEP == $id_estado){$selectedE = 'selected';}
	echo "<option value = '$id_estado' $selectedE  >$nombre</option>";
	$selectedE 	= '';
}
echo "</select></td>";
echo "<tr>"; 
// TERMINA SELECT OPTION AUTOMATICO DE ESTADOS
##### ##### ##### ##### #####
?>

<tr>
	<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Editar"> 
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
<!-- <link rel="stylesheet" href="js/jquery-ui.min.css" /> -->
<!-- <link rel="stylesheet" href="js/jquery-ui.theme.min.css" />  hot-sneaks -->	
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />