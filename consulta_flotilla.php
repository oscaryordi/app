<?php
include("1header.php");
include("nav_gerencia.php");

include'nav_compras.php';

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

$cuenta_inventarios = "SELECT COUNT(id) cuenta FROM ubicacion ";
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_inventarios);
$cuentaM 			= mysqli_fetch_assoc($sacar_cuenta);
$cuenta 			= $cuentaM['cuenta'];
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);

$sql_flotilla = 'SELECT 
				id id_unidad '
        . ' FROM ubicacion u '
        . ' ORDER BY '
        . ' u.id '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag" ; 

echo "<h2>$rxpag Resultados por pagina, $paginas_entero PÁGINAS</h2>";

#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
	$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
}
	
$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR

// IR APRIMERA PAGINA
echo "<a href='?pagina=1' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >Primera</a> ";
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
echo "<a href='?pagina=$pagina_maximo' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >Última</a> ";
// FIN ALGORITMO PAGINACION // 2da parte
#####
##### // FORMULARIO ELEGIR PAGINA
echo "  <br>ELEGIR PAGINA:";
echo "	<form action='' method='get' style='display: inline;'>
		<input type='text' name='pagina' maxlength='5' size='5' value='$pagina'>
		<input type='submit' name='submit' value='Ir'>
		</form>";
echo "";
##### // FORMULARIO ELEGIR PAGINA


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
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
	$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
}
	
$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
// IR APRIMERA PAGINA
echo "<a href='?pagina=1' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >Primera</a> ";
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
echo "<a href='?pagina=$pagina_maximo' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >Última</a> ";
// FIN ALGORITMO PAGINACION // 2da parte
#####
##### // FORMULARIO ELEGIR PAGINA
echo "  <br>ELEGIR PAGINA:";
echo "	<form action='' method='get' style='display: inline;'>
		<input type='text' name='pagina' maxlength='5' size='5' value='$pagina'>
		<input type='submit' name='submit' value='Ir'>
		</form>";
echo "";
##### // FORMULARIO ELEGIR PAGINA


echo "</fieldset>";

} // CIERRE PRIVILEGIOS
include("1footer.php");?>