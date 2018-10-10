<?php
include '1header.php';
// <!-- CANDADO PRIVILEGIO -->
if($_SESSION["placas"] > 1){  // APERTURA PRIVILEGIOS CREA PLACAS ?>
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
	$( "#fechaAsignacion" ).datepicker({changeYear: true, changeMonth: true});
	});
</script>
<script>
	$(function() {
	$( "#fechafinal" ).datepicker({changeYear: true, changeMonth: true});
	});
</script>
<?php
	
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";

$actualizado = '';


// INICIO PROCESAMIENTO DEL FORMULARIO
if (isset($_GET['actualizar']) && $_GET['PlacaNueva'] !== '' && strlen(limpiarVariableRFC($_GET['PlacaNueva'])) > 0  ){

	$FechaAsignacion = $_GET['fechaAsignacion'];
	// VALIDA FORMATO DE FECHA
	function validateDate($date, $format = 'Y-m-d H:i:s')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}

	if( validateDate($FechaAsignacion, 'Y-m-d') == true )
		{ ;}
	else
		{ 
			$date = str_replace('/', '-', $FechaAsignacion);
			$FechaAsignacion = date('Y-m-d', strtotime($date));
		}
	// VALIDA FORMATO DE FECHA

	// FORMATEAR Y LIMPIAR PLACA	
		$PlacaNueva = strtoupper(mysqli_real_escape_string($dbd2, $_GET['PlacaNueva'] ));
		$PlacaNueva = limpiarVariableRFC($PlacaNueva);
	//$economico 		= $_GET['economico'];

	// OBTENER TERMINACION NUMERICA DE PLACA
		$placa1 = $PlacaNueva;
		finalplaca($placa1); 


	$FechaAsignacion 	= mysqli_real_escape_string($dbd2, $FechaAsignacion );
	$estadoE 			= mysqli_real_escape_string($dbd2, $_GET['estadoE'] );
	$capturo 			= $_SESSION["id_usuario"];

	$sqlPlacaNueva 		= "INSERT INTO `jetvantlc`.`placa` (id, id_unidad,  Placas, terminacionN, fechaAsignacion, capturo, estadoE) VALUES  
						(NULL, '$id_unidad',  '$PlacaNueva', '$finalPlaca','$FechaAsignacion', '$capturo', '$estadoE') ";
	$resultadoPlacaNueva = mysqli_query($dbd2, $sqlPlacaNueva );

	if(!$resultadoPlacaNueva){
	echo "<span style='color:red;'>".mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "</span>\n";
	}
	else{
		echo "<br><h2>ACTUALIZACION EXITOSA DE PLACAS</h2><br>";
	}
$actualizado = 'si';
}
// TERMINA PROCESAMIENTO DEL FORMULARIO

include ("u4datos.php");
include ("u5placas.php");

if ($actualizado == ''){
?>

<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
<table>
<tr><th colspan=2>FORMULARIO ACTUALIZAR PLACAS</th>
</tr>
<tr>
	<td>Economico</td>
	<td><input type="text" name="economico" value="<?php echo $Economico; ?>" disabled >
	<!--   <input type="hidden" name="economico" value="<?php echo $Economico; ?>"> -->
		<input type="hidden" name="id_unidad" value="<?php echo $id_unidad; ?>"> 
	</td>
</tr>
<tr>
	<td>Número de Placas Nuevo</td>
	<td><INPUT TYPE="text" NAME="PlacaNueva" placeholder="Pon aqui las placas" autofocus required ></td>
</tr>
<tr>
	<td>Fecha de Expedición de la Tarjeta de Circulación</td>
	<td>
		<input type='text' id='fechaAsignacion' name='fechaAsignacion' placeholder='dd/mm/aaaa' />
	</td>
</tr>
<tr>
	<td>ESTADO DE EMPLACAMIENTO</td>
	<td>
		<select name = 'estadoE' >
			<option value = '0' >---</option>
			<option value = '1' >Aguascalientes</option>
			<option value = '2' >Baja California</option>
			<option value = '3' >Baja California Sur</option>
			<option value = '4' >Campeche</option>
			<option value = '5' >Chiapas</option>
			<option value = '6' >Chihuahua</option>
			<option value = '7' >Ciudad de México</option>
			<option value = '8' >Coahuila de Zaragoza</option>
			<option value = '9' >Colima</option>
			<option value = '10' >Durango</option>
			<option value = '11' >Estado de México</option>
			<option value = '12' >Guanajuato</option>
			<option value = '13' >Guerrero</option>
			<option value = '14' >Hidalgo</option>
			<option value = '15' >Jalisco</option>
			<option value = '16' >Michoacán de Ocampo</option>
			<option value = '17' >Morelos</option>
			<option value = '18' >Nayarit</option>
			<option value = '19' >Nuevo León</option>
			<option value = '20' >Oaxaca</option>
			<option value = '21' >Puebla</option>
			<option value = '22' >Querétaro</option>
			<option value = '23' >Quintana Roo</option>
			<option value = '24' >San Luis Potosí</option>
			<option value = '25' >Sinaloa</option>
			<option value = '26' >Sonora</option>
			<option value = '27' >Tabasco</option>
			<option value = '28' >Tamaulipas</option>
			<option value = '29' >Tlaxcala</option>
			<option value = '30' >Veracruz de Ignacio de la Llave</option>
			<option value = '31' >Yucatán</option>
			<option value = '32' >Zacatecas</option>
		</select>
	</td>
</tr>
<tr>
	<td colspan=2 align=center><INPUT id="gobutton" TYPE="submit" NAME="actualizar" VALUE="Actualizar"></td>
</tr>
</table>
</form>
</fieldset>

<?php };

	// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</p>";
} // CIERRE PRIVILEGIOS CREA PLACAS
include ("1footer.php"); ?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />