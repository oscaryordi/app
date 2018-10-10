<?php
include '1header.php';
include ("base.inc.php");
$TipoBusqueda = 'ECONOMICO';
echo "<title>Consulta por $TipoBusqueda</title>";
$uNEco = $_POST['uNEco'];

// LIMPIAR ECONOMICO
$comillasimple = "'";
$espacio = " ";
$guion = "-";
$guionBajo = "_";
$uNEco  = str_replace($comillasimple,"",$uNEco);
$uNEco  = str_replace($guion,"",$uNEco);
$uNEco  = str_replace($guionBajo,"",$uNEco);
$uNEco = str_replace($espacio,"",$uNEco);
$uNEco  = trim($uNEco);
//LIMPIAR ECONOMICO

echo	'<h3>RESULTADO DE LA CONSULTA</h3>';
echo	"<h4>por $TipoBusqueda</h4>";

echo "Valor buscado: <font size=3em><b>$uNEco</b></font>";

include ("1datos.php");
include ("1placas.php");
include ("1ubicacion.php");
include ("1factura.php");
include ("1mantenimiento.php");
include ("1documentos.php");
mysqli_close($dbd2);
include ("1footer.php");
?>