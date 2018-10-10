<?php
include("1header.php");

if($_SESSION["movimientos"] > 2){  // APERTURA PRIVILEGIOS

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
	$pagina_1 = ($pagina * 15) - 15;
}
 
$cuenta_inventarios = "SELECT id_formato FROM formato_inventario  WHERE `proyecto_destino` LIKE '%JETVAN%' ";
$sacar_cuenta 	= mysqli_query($dbd2, $cuenta_inventarios);
$cuenta 		= mysqli_num_rows($sacar_cuenta);
$paginas 		= $cuenta/15;
$paginas_entero = ceil($cuenta/15);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";


$sql_entradas = 'SELECT '
        . ' `id_formato`, '
        . ' `fecharecepcion`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, '
        . ' `razonentrada`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE `proyecto_destino` LIKE '%JETVAN%' ";
$sql_entradas .= ' ORDER BY '
        . ' `numero_inventario` '
        . ' DESC '
        . " LIMIT $pagina_1, 15"; 

echo "<fieldset><legend>Resumen de ENTRADAS a la fecha <span  id='fecha_actual3' ></span></legend>\n";
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
<th>FECHA DE INGRESO</th>
<th>INVENTARIO</th>
<th>ECONOMICO</th>
<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>
<th>MOTIVO</th>
<th>ORIGEN</th>
<th>DESTINO</th>
<th>VER DETALLE</th></tr>";
$res_entradas = mysqli_query($dbd2, $sql_entradas);

while($row = mysqli_fetch_assoc($res_entradas))
{
	$id_inventario 	= $row['id_formato'];
	$fecharecepcion = $row['fecharecepcion'];
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];
	$razonentrada 	= $row['razonentrada'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$fecharecepcion}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonentrada}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";

	echo "<td><a href='formato_vista_id.php?id_inventario=".$id_inventario."'><button type='button' class='btn btn-success  btn-sm'>
	<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> ver formato </button></a></td>";
	echo "</tr>";
}
echo "</table></fieldset>";


// PAGINACION PIE
$color = '';
for($i=1; $i <= $paginas_entero; $i++)
{
	if($pagina == $i){
		$color = 'red';
	}else {$color='';}
	echo "<a href='paginacion_entradas.php?pagina=$i' style='color:$color;' >$i</a> ";
}

} // CIERRE PRIVILEGIOS


$res_entradas2 	= mysqli_query($dbd2, $sql_entradas);
$row3 			= mysqli_fetch_array($res_entradas2);
$row2 			= mysqli_fetch_assoc($res_entradas2);


echo " <br />";
echo " array <br />";
print_r($row3);

echo " <br />";
echo " assoc <br />";
print_r($row2);

include("1footer.php");?>