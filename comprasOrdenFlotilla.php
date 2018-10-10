<?php
include("1header.php");
include'nav_compras.php';


$nOrdenC = mysqli_real_escape_string($dbd2, $_GET['nOrdenC']);


echo "<h3>FLOTILLA VEHICULAR COMPRADA </h3>";
echo "<h2>$nOrdenC </h2>";


if($_SESSION["datos"] > 1 || $_SESSION["gerencia"] > 0){  // APERTURA PRIVILEGIOS

$rxpag = 60; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
	$pagina = $_GET['pagina'];
}
else{
	$pagina = "";
}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

$cuenta_inventarios = "SELECT COUNT(id_unidad) cuenta FROM facturaunidad WHERE nOrdenC = '$nOrdenC' ";
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_inventarios);
$cuentaM 			= mysqli_fetch_assoc($sacar_cuenta);
$cuenta 			= $cuentaM['cuenta'];
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);



$sql_flotilla = 'SELECT 
				id_unidad '
        . ' FROM facturaunidad u '
        . "  WHERE nOrdenC = '$nOrdenC'  "
        . ' ORDER BY '
        . ' id_unidad '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag" ; 

echo "<h2>$rxpag Resultados por pagina, $paginas_entero PÁGINAS</h2>";

$variablesGet = "nOrdenC=$nOrdenC&";
include'1paginacion.php';

echo "<h3>RESUMEN FLOTILLA</h3>";
echo "<fieldset><legend>Resumen de flotilla</legend>";
echo "<table class='ResTabla'>\n";
echo "<tr>
		<th>ID en BD</th>
		<th>ECONOMICO</th>
		<th>PLACAS</th>
		<th>MARCA</th>
		<th>SERIE</th>
		<th>VEHICULO</th>
		<th>MODELO</th>
		<th>COLOR</th>
		<th>PROVEEDOR</th>
		<th>FECHA FACTURA</th>
		<th>FOLIO FACTURA</th>
		<th>IMPORTE</th>
		<th>PROYECTO</th>
		<th>UBICACION</th>
		<th>ORDEN DE COMPRA</th>
	  </tr>";

$res_flotilla = mysqli_query($dbd2, $sql_flotilla);

while($row = mysqli_fetch_assoc($res_flotilla)){
	$id 		= $row['id_unidad'];
	$id_unidad 	= $row['id_unidad']; // PARA QUE FUNCIONE LA QUERY DEL HISTORICO

	echo "<tr>";
	echo "<td>{$id}</td>";

	datosxid($id_unidad);
	echo "<td><a href='u3index.php?id_unidad=$id_unidad'>
				{$Economico}
			  </a>
		  </td>";
	echo "<td>{$Placas}</td>";
	echo "<td>{$Marca}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Modelo}</td>";
	echo "<td>{$Color}</td>";

	facturaUxid($id_unidad);	
	echo "<td>{$ProveedorU}</td>";
	echo "<td>{$FechaFacturaU}</td>";
	echo "<td>{$FolioFacturaU}</td>";
	echo "<td>{$ImporteU}</td>";
	
	ubicacionHistorico($id_unidad);

	if(is_numeric($clienteA))
	{
		contratoxid($clienteA);
		clientexid($id_cliente);
		$clienteA = $razonSocial;
	}

	echo "<td>{$clienteA}</td>";
	echo "<td>{$ubicacionA}</td>";

	echo "<td>{$nOrdenCU}</td>";
	echo "</tr>";
}
echo "</table>";



#####
include'1paginacion.php';
##### // FORMULARIO ELEGIR PAGINA


echo "</fieldset>";

} // CIERRE PRIVILEGIOS
include("1footer.php");?>