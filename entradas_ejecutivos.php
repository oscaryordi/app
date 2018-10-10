<?php
include_once ("base.inc.php");
include_once ("funcion.php");
?>
<!-- ESTILO -->
<style>
td{ font-size:.85em;}
a img {width:163px;height:70px;}
th {background-color:#016155;FONT-SIZE: .65em; FONT-FAMILY: Arial; COLOR: white; padding: 1px 4px;border-radius: 5px;}
</style>
<!-- Entradas -->

<script type="text/javascript">
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)}
function display_ct() {
var strcount
var x = new Date()

var mes = x.getMonth();
var montharray=new Array("01","02","03","04","05","06","07","08","09","10","11","12");

var x2 =  x.getFullYear()+ "-" + montharray[mes]+ "-" + x.getDate();
var x1 = x.getHours()+ ":" + x.getMinutes() + ":" + x.getSeconds();

document.getElementById('fecha_actual2').innerHTML = x2;
document.getElementById('hora_entrada').value = x1;
tt=display_c();
}
</script>
<meta charset='utf-8'>
<body onload=display_ct(); >
<?php
$sql_entradas = 'SELECT '
        . ' `id_unidad`, '
        . ' `fecharecepcion`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, '
        . ' `razonentrada` ' // , SE QUITO COMA
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE `proyecto_destino` LIKE '%JETVAN TEMPORAL%' ";
$sql_entradas .= ' ORDER BY '
        . ' `numero_inventario` '
        . ' DESC '
        . ' LIMIT 20'; 

echo "<fieldset>
		<legend>Resumen de entradas a la fecha
		<span  id='fecha_actual2' ></span>
		</legend>
		<table class='ResTabla'>\n";
echo "<tr>
		<th>FECHA DE INGRESO</th>
		<th>INVENTARIO</th>
		<th>ECONOMICO</th>
		<th>PLACAS</th>
		<th>SERIE</th>
		<th>TIPO</th>
		<th>MOTIVO</th>";

		if($_SESSION["gps"] > 0){
			echo "<th>GPS</th>";
		}
echo "</tr>";

$res_entradas = mysqli_query($dbd2, $sql_entradas);

while($row = mysqli_fetch_assoc($res_entradas)){
	$id_unidad 		= $row['id_unidad'];	
	$fecharecepcion = $row['fecharecepcion'];
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];
	$razonentrada 	= $row['razonentrada'];

	echo "<tr>";
	echo "<td>{$fecharecepcion}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonentrada}</td>";

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