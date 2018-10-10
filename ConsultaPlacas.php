<?php
include '1header.php';
include ("base.inc.php");
$TipoBusqueda = 'PLACAS';
echo "<title>Consulta por $TipoBusqueda</title>";
$uPlacas = $_POST['uPlacas'];

//LIMPIAR PLACAS
$comillasimple = "'";
$espacio = " ";
$guion = "-";
$guionBajo = "_";
$uPlacas = str_replace($comillasimple,"",$uPlacas);
$uPlacas = str_replace($guion,"",$uPlacas);
$uPlacas = str_replace($guionBajo,"",$uPlacas);
$uPlacas = str_replace($espacio,"",$uPlacas);
$uPlacas = trim($uPlacas);
//LIMPIAR PLACAS
echo	'<h3>RESULTADO DE LA CONSULTA</h3>';
echo	"<h4>por $TipoBusqueda</h4>";

echo "Valor buscado: <font size=3em><b>$uPlacas</b></font>";

$sqlp = "SELECT `Economico` FROM `placa` WHERE `Placas` = '$uPlacas' LIMIT 1";
$rp = mysqli_query($dbd2, $sqlp);
$arrayp = mysqli_fetch_array($rp);
@$uNEco = $arrayp[Economico];

include ("1datos.php");
include ("1placas.php");
include ("1ubicacion.php");
include ("1factura.php");
include ("1mantenimiento.php");
include ("1documentos.php");
mysqli_close($dbd2);
include ("1footer.php");
?>