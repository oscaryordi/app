<?
$TipoBusqueda = 'ECONOMICO';

include '1header.php';
include ("base.inc.php");

$uNEco = $_POST['uNEco'];
//$uNEco =212875 ;
echo "Valor buscado: <font size=3em><b>$uNEco</b></font>";

include ("1datos.php");
include ("1placas.php");
include ("1ubicacion.php");
include ("1factura.php");
include ("1mantenimiento.php");
include ("1documentos.php");
mysql_close($conectar);
include ("1footer.php");
?>