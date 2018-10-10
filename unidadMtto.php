<?php include '1header.php'; ?>
<style>
#header{
	margin: 10px;
}
#bloque {
	display: inline-block;
	float: left ;
	margin: 10px;
}
#bloque2 {
	display: inline-block;
	float: left ;
	margin: 10px;
	clear: both;
}

#footer{
	margin: 10px;
	clear: left;
}
</style>
<?php
$TipoBusqueda = 'ECONOMICO';
echo "<div id=header>";



include_once ("base.inc.php");
$uNEco = $_GET['uNEco'];

echo "Valor buscado: <font size=3em><b>$uNEco</b></font></br>";
echo "</div>";


echo "<div id=contenido>";
echo "<div id=bloque>";
include ("1datos.php");
echo "</div>";

echo "<div id=bloque>";
include ("1placas.php");
echo "</div>";

echo "<div id=bloque2>";
include ("1mantenimiento.php");
echo "</div>";
echo "</div>";

mysqli_close($dbd2);

echo "<div id=footer>";
include ("1footer.php");
echo "</div>";
?>