<?php
include("1header.php");

if($_SESSION["movimientos"] > 2){  // APERTURA PRIVILEGIOS

if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}
else
{
	$pagina = "";
}

if($pagina == "" || $pagina == 1)
{ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else
{
	$pagina_1 = ($pagina * 15) - 15;
}

$cuenta_inventarios = "SELECT id_formato FROM formato_inventario  WHERE `hora_salida` > '0:00' ";
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_inventarios);
$cuenta 			= mysqli_num_rows($sacar_cuenta);
$paginas 			= $cuenta/15;
$paginas_entero 	= ceil($cuenta/15);

$sql_entradas = 'SELECT '
        . ' `fechaentrega`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, ' 
        . ' `razonsalida`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE `hora_salida` > '0:00' ";
$sql_entradas .= ' ORDER BY '
        . '  fechaentrega DESC, `id_formato` '
        . ' DESC '
        . " LIMIT $pagina_1, 15"; 

echo "<fieldset><legend>Resumen de salidas a la fecha</legend>";
echo "<table class='ResTabla'>\n";
echo "<tr>
		<th>FECHA DE SALIDA</th>
		<th>INVENTARIO</th>
		<th>ECONOMICO</th>
		<th>PLACAS</th>
		<th>SERIE</th>
		<th>TIPO</th>
	  </tr>";

$res_entradas = mysqli_query($dbd2, $sql_entradas);

while($row = mysqli_fetch_assoc($res_entradas)){
	$fechaentrega 	= $row['fechaentrega'];
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];
	$razonsalida 	= $row['razonsalida'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	
	echo "<tr>";
	echo "<td>{$fechaentrega}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonsalida}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";
	
	echo "<td><a href='formato_vista.php?numero_inventario=".$inventario."'>
				<button type='button' class='btn btn-success  btn-sm'>
				<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span>
				 ver formato 
				</button>
				</a>
		  </td>";
	echo "</tr>";
}
echo "</table></fieldset>";

include('1paginacion.php');

} // CIERRE PRIVILEGIOS
include("1footer.php");?>