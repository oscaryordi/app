<?php $TipoBusqueda = ""; ?>
<?php include ("base.inc.php"); ?>
<?php include ("1header.php"); ?>
<style>
td{ font-size:.85em;}
a img {width:163px;height:70px;}
th {background-color:#016155;FONT-SIZE: .65em; FONT-FAMILY: Arial; COLOR: white; padding: 1px 4px;border-radius: 5px;}
</style>
<!--BITACORA MANTENIMIENTO-->

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
document.getElementById('fecha_actual').value = x2;
document.getElementById('fecha_actual2').innerHTML = x2;
document.getElementById('hora_entrada').value = x1;
tt=display_c();
}
</script>
<body onload=display_ct(); >
<td>HORA ENTRADA</td>
<input type="text" name="hora_entrada" id='hora_entrada' >

<input type="text" name="fecha_actual" id='fecha_actual' >
<fieldset><legend>Entradas de Hoy <span name="fecha_actual2" id='fecha_actual2' ></span></legend>
<?

$sql_entradas = 'SELECT '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, '
        . ' `razonentrada`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` '
        . ' ORDER BY '
        . ' `fecharecepcion` '
        . ' DESC '
        . ' LIMIT 20'; 

echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr><th>INVENTARIO</th>
<th>ECONOMICO</th>
<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>
<th>MOTIVO</th>
<th>ORIGEN</th>
<th>DESTINO</th>
<th>OTRO</th><th>VER DETALLE</th></tr>";
$res_entradas = mysql_query($sql_entradas);

while($row = mysql_fetch_assoc($res_entradas)){
	$inventario = $row['numero_inventario'];
	$economico = $row['economico'];
	$placas = $row['placas'];
	$serie = $row['serie'];
	$tipo = $row['tipo'];
	$razonentrada = $row['razonentrada'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonentrada}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";

	// echo "<td><a href='#'><button type='button' class='";
	// if($autorizado == 'autorizado'){echo "btn btn-success  btn-sm";} 
	// else {echo "btn btn-warning  btn-sm";}
	// echo "'> $autorizado </button></a></td>";

	echo "<td><a href='#'><button type='button' class='";
	if($pagado == 'si'){echo "btn btn-success  btn-sm";} 
	else {echo "btn btn-warning  btn-sm";}
	echo "'> $pagado </button></a></td>";
	
	echo "<td><a href='unidadMtto.php?uNEco=".$economico."'><button type='button' class='btn btn-success  btn-sm'>
	<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> Bitacora</button></a></td>";
	echo "</tr>";
}
echo "</table>";

?>
</fieldset>
<br />
<form action="index.html"><input id="gobutton" type="submit" name="enviar" value="Consultar Otro" class='btn btn-primary ' ></form>
<br />
<hr/>
<address>&copy Jet Van Car Rental, S.A. de C.V.
<br /><font size=1.5>Pensilvania 131-1, Col. Napoles, Del. Benito Juárez, 
<br />México, D.F., C.P. 03810 
<br />Call-Center 01 800 822 7737, Tel. 01 55 5527 1161
<br /> RFC JCR040721NU2</font></address>
<br />
<br />
<?php include 'poweredby.php'; ?>
</body>
</html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>