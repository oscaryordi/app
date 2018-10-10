<?php include_once ("base.inc.php"); ?>
<!-- ESTILO -->
<style>
td{ font-size:.85em;}
a img {width:163px;height:70px;}
th {background-color:#016155;FONT-SIZE: .65em; FONT-FAMILY: Arial; COLOR: white; padding: 1px 4px;border-radius: 5px;}
</style>
<!-- Entradas -->

<script type="text/javascript">
function display_cc(){
var refresh1=60000; // Refresh rate in milli seconds
mytime1=setTimeout('display_cts()',refresh1)}
function display_cts() {
var strcount
var xfa3 = new Date()

var mes1 = xfa3.getMonth();
var montharray1=new Array("01","02","03","04","05","06","07","08","09","10","11","12");

var x3 =  xfa3.getFullYear()+ "-" + montharray1[mes1]+ "-" + xfa3.getDate();
var x4 = xfa3.getHours()+ ":" + xfa3.getMinutes() + ":" + xfa3.getSeconds();

document.getElementById('fecha_actual3').innerHTML = x3;
document.getElementById('hora_entrada2').value = x4;
tt3=display_cc();
}
</script>
<body onload=display_cts(); > <!----> 
<?

$sql_entradas = 'SELECT '
        . ' `id_unidad`, '
        . ' `fechaentrega`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo` ' // SE QUITO COMA
        // . ' `razonsalida`, '
        // . ' `proyecto_origen`, '
        // . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE `hora_salida` > '0:00' ";
 $sql_entradas .= ' ORDER BY '
        . '  fechaentrega DESC, `id_formato` '
        . ' DESC '
        . ' LIMIT 20'; 

echo "<fieldset><legend>Resumen de salidas a la fecha <span  id='fecha_actual3' ></span></legend>\n";
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
<th>FECHA DE SALIDA</th>
<th>INVENTARIO</th>
<th>ECONOMICO</th>
<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>";

if($_SESSION["gps"] > 0){
	echo "<th>GPS</th>";
}

echo "</tr>";


$res_entradas = mysqli_query($dbd2, $sql_entradas);

while($row = mysqli_fetch_assoc($res_entradas)){
	$id_unidad 		= $row['id_unidad'];	
	$fechaentrega 	= $row['fechaentrega'];
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];

	echo "<tr>";
	echo "<td>{$fechaentrega}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";

if($_SESSION["gps"] > 0)
{
	gpsxid($id_unidad);

	$color = '';
	if($tienegps == 'No'){$color = 'red';}
	echo "<td style='color:$color;'>{$tienegps}</td>";
}
	echo "</tr>";	

}
echo "</table></fieldset>";
?>