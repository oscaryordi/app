<?php
include '1header.php';

if($_SESSION["placas"] > 1){  // APERTURA PRIVILEGIOS

$TipoBusqueda = 'Actualizar Placas';
$uNEco = $_GET['uNEco'];

echo "<h2>".$uNEco."</h2><br />";

$actualizado = '';

if (isset($_GET['actualizar']) && $_GET['PlacaNueva'] !== '' ){

//echo $_GET['uNEco'];
//echo $_GET['PlacaNueva'];
$FechaS = $_GET['anioS'].$_GET['mesS'].$_GET['diaS'];
//echo $FechaS = $_GET['anioS'].$_GET['mesS'].$_GET['diaS'];
	
	global $conectar;
	
	$PlacaNueva = mysqli_real_escape_string($dbd2, $_GET['PlacaNueva']);
	// FORMATEAR Y LIMPIAR PLACA
		$comillasimple = "'";
		$espacio = " ";
		$guion = "-";
		$guionBajo = "_";
		$diagonal = "/";
		$PlacaNueva = str_replace($comillasimple,"",$PlacaNueva);
		$PlacaNueva = str_replace($guion,"",$PlacaNueva);
		$PlacaNueva = str_replace($guionBajo,"",$PlacaNueva);
		$PlacaNueva = str_replace($espacio,"",$PlacaNueva);
		$PlacaNueva = str_replace($diagonal,"",$PlacaNueva);
		$PlacaNueva = trim($PlacaNueva);
		$PlacaNueva = strtoupper($PlacaNueva);
	
	
	
	
	$uNEco = $_GET['uNEco'];
	//$PlacaNueva = $_GET['PlacaNueva'];
	$FechaAsignacion = $FechaS;
	$capturo = $_SESSION["id_usuario"];

	$sqlPlacaNueva = "INSERT INTO `jetvantlc`.`placa` (id, Economico, Placas, fechaAsignacion, capturo) VALUES  
					(NULL, '$uNEco', '$PlacaNueva', '$FechaAsignacion', '$capturo') ";
					

	$resultadoPlacaNueva = mysqli_query($dbd2, $sqlPlacaNueva );

	if(!$resultadoPlacaNueva){
	echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
	}
	else{
		echo "<br><h2>ACTUALIZACION EXITOSA</h2><br>";
	}
$actualizado = 'si';
}

include ("1datos.php");
include ("1placas.php");


if ($actualizado == ''){
?>


<fieldset>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
		<table>
		<tr><th colspan=2>FORMULARIO ACTUALIZAR PLACAS</th>
		</tr>
		
		<tr>
		<td>Economico</td>
		<td><INPUT TYPE="text" NAME="uNEco" VALUE="<?php echo $uNEco; ?>" disabled >
		 <input type="hidden" name="uNEco" value="<?php echo $uNEco; ?>"> 
		</td>
		</tr>
		
		<tr>
		<td>Número de Placas Nuevo</td>
		<td><INPUT TYPE="text" NAME="PlacaNueva" placeholder="Pon aqui las placas" autofocus></td>
		</tr>
		<tr>
		<td>Fecha de Expedición de la Tarjeta de Circulación</td>
<td>
<select NAME = "diaS" id=select>

<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
</select>
<select NAME = "mesS" id=select>
<option value='-01-'>ENERO</option>
<option value='-02-'>FEBRERO</option>
<option value='-03-'>MARZO</option>
<option value='-04-'>ABRIL</option>
<option value='-05-'>MAYO</option>
<option value='-06-'>JUNIO</option>
<option value='-07-'>JULIO</option>
<option value='-08-'>AGOSTO</option>
<option value='-09-'>SEPTIEMBRE</option>
<option value='-10-'>OCTUBRE</option>
<option value='-11-'>NOVIEMBRE</option>
<option value='-12-'>DICIEMBRE</option>
</select>
<select NAME = "anioS" id=select>
<option>2018</option>
<option>2017</option>
<option>2016</option>
<option>2015</option>
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
} // CIERRE PRIVILEGIOS 
include ("1footer.php");