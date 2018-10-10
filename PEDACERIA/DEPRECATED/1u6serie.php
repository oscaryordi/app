<?
include '1header.php';
include ("base.inc.php");
$TipoBusqueda = 'FINAL SERIE';
echo "<title>Consulta por $TipoBusqueda</title>";
//$uFns = 'Z37423'; // solo hay uno
//$uFns = '126117'; // se repite tres veces
@$uFns = $_POST['uFns'];

//LIMPIAR PLACAS
$comillasimple = "'";
$espacio = " ";
$guion = "-";
$uFns = str_replace($comillasimple,"",$uFns);
$uFns = str_replace($guion,"",$uFns);
$uFns = str_replace($espacio,"",$uFns);
$uFns = trim($uFns);



echo "Valor buscado: <font size=3em><b>$uFns</b></font>";

$sqlFns = "SELECT  `Economico`, Vehiculo, Modelo, Color FROM `ubicacion` WHERE `Serie` LIKE '%$uFns' LIMIT 0, 5"; 
$rpFns = mysql_query($sqlFns);
$filasFns = mysql_num_rows($rpFns);

if($filasFns==1){
	$arrayFns = mysql_fetch_array($rpFns);
	@$uNEco = $arrayFns[Economico];
	
	include ("1datos.php");
	include ("1placas.php");
	include ("1ubicacion.php");
	include ("1factura.php");
	include ("1mantenimiento.php");
	include ("1documentos.php");
	mysql_close($conectar);
	include ("1footer.php");
	
}
else{
	//echo "son mas de 1, son: $filasFns";

	echo "<fieldset><legend>Finales de serie</legend>";

$camposFns = mysql_num_fields($rpFns);

echo "<a>Cantidad de unidades similares encontradas: <b>$filasFns</b></a>\n";
echo "<table>\n"; // Empezar tabla
	echo "<tr>"; // Crear fila
		for ($i = 0;$i < $camposFns;$i++) {
		$nombrecampo = mysql_field_name($rpFns, $i);
		echo "<th>$nombrecampo</th>";
	} 
	echo "</tr>\n"; // Cerrar fila
	while (@$row = mysql_fetch_assoc($rpFns)) {
    echo "<tr>"; // Crear fila
		$j=0;
		foreach ($row as $key => $value) {        
				$j++;
				if ($j==1){
					echo "<td><FORM action='ConsultaEconomico.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='uNEco' VALUE='$value'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Ver &#x25B8;'>
		</FORM><p id='pform'>$value&nbsp;</p> </td>";
				}else{
				echo "<td><a > $value&nbsp;</a></td>";
				}		
		}
    echo "</tr>\n"; // Cerrar fila
	} 
echo "</table>\n"; // Cerrar tabla

echo "</fieldset>";

include ("1footer.php");	
}
?>