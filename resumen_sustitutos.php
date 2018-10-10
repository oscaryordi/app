<?php
include("1header.php");?>
<meta charset='utf-8'>
<?php
if($_SESSION["gerencia"] > 0){  // APERTURA PRIVILEGIOS
	include("nav_gerencia.php");

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

$cuenta_sustitutos 		= "SELECT id_formato FROM formato_inventario  WHERE `razonsalida` = 'Sustituto' ";
$sacar_cuenta_sustitutos = mysqli_query($dbd2, $cuenta_sustitutos);
$cuenta_resultado 		= mysqli_num_rows($sacar_cuenta_sustitutos);
$paginas 				= $cuenta_resultado/15;
$paginas_entero 		= ceil($cuenta_resultado/15);


$sql_sustitutos = 'SELECT 
					`id_formato` IdBd, 
					`fechaentrega` FECHA, 
					`placasustituido` SUSTITUIDO, 
					`observaciones` RAZON, 
					`economico` SUSTITUTO, 
					`placas` PLACAS, 
					`modelo` MODELO, 
					`numero_inventario` FORMATO, 
					`solicito_unidad` RESPONSABLE 
					FROM `formato_inventario` ';
$sql_sustitutos .= "WHERE `razonsalida` = 'Sustituto' 
					ORDER BY `fechaentrega` DESC 
					LIMIT $pagina_1, 15"; 

echo "<fieldset><legend>Resumen de SUSTITUTOS a la fecha <span  id='fecha_actual3' ></span></legend>\n";
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
		<th>BD</th>
		<th>FECHA</th>
		<th>SUSTITUIDO</th>
		<th>SUSTITUIDO</th>
		<th>RAZON</th>
		<th>SUSTITUTO</th>
		<th>PLACAS</th>
		<th>SUSTITUTO</th>
		<th>MODELO</th>
		<th>FORMATO</th>
		<th>RESPONSABLE</th>
		<th>FORMATO</th>
	  </tr>";
//<th>VER DETALLE</th>

$res_sustitutos = mysqli_query($dbd2, $sql_sustitutos);
while($row = mysqli_fetch_assoc($res_sustitutos)){
	$id_inventario = $row['IdBd'];	
	$fechaentrega = $row['FECHA'];
	$placas_sustituido = $row['SUSTITUIDO'];
	$razon = $row['RAZON'];	
	$economico = $row['SUSTITUTO'];		
	$placas = $row['PLACAS'];	
	$modelo = $row['MODELO'];	
	$inventario = $row['FORMATO'];
	$responsable = $row['RESPONSABLE'];	

datosporplaca($placas_sustituido);
	$tipoSustituido = $Vehiculo;

datosporeconomico($economico);
	$tipoSustituto = $Vehiculo;

	echo "<tr>";
	echo "<td>{$id_inventario}</td>";
	echo "<td>{$fechaentrega}</td>";
	echo "<td>{$placas_sustituido}</td>";
	echo "<td>{$tipoSustituido}</td>";
	echo "<td>{$razon}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$tipoSustituto}</td>"; 
	echo "<td>{$modelo}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$responsable}</td>";

	echo "<td><a href='formato_vista_id.php?id_inventario=".$id_inventario."'><button type='button' class='btn btn-success  btn-sm'>
    <span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> ver formato </button></a></td>";
	echo "</tr>";

}
echo "</table>"; 

$color = '';
for($i=1; $i <= $paginas_entero; $i++){
	if($pagina == $i){
		$color = 'red';
	}else {$color='';}
	echo "<a href='resumen_sustitutos.php?pagina=$i' style='color:$color;' >$i</a> ";
}

?>
</fieldset>
<?php  } // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>