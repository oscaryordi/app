<?php
include '1header.php';
include_once ("base.inc.php");
$TipoBusqueda = 'SERIE';
echo "<title>Consulta por $TipoBusqueda</title>";
$uSerie = $_POST['uSerie'];
//$uSerie = "1GCDS9C92C8126067";

//LIMPIAR SERIE
$comillasimple = "'";
$espacio = " ";
$guion = "-";
$guionBajo = "_";
$uSerie = str_replace($comillasimple,"",$uSerie);
$uSerie = str_replace($guion,"",$uSerie);
$uSerie = str_replace($guionBajo,"",$uSerie);
$uSerie = str_replace($espacio,"",$uSerie);
$uSerie = trim($uSerie);
//LIMPIAR SERIE
echo	'<h3>RESULTADO DE LA CONSULTA</h3>';
echo	"<h4>por $TipoBusqueda</h4>";

echo "Valor buscado: <font size=3em><b>$uSerie</b></font>";

$sqlNS 		= "SELECT `Economico` FROM `ubicacion` WHERE `Serie` = '$uSerie' LIMIT 1";
$rpNS 		= mysqli_query($dbd2, $sqlNS);
$arrayNS 	= mysqli_fetch_array($rpNS);
@$uNEco 	= $arrayNS[Economico];

include ("1datos.php");
include ("1placas.php");
include ("1ubicacion.php");
include ("1factura.php");
include ("1mantenimiento.php");
include ("1documentos.php");
mysqli_close($dbd2);
include ("1footer.php");
?>