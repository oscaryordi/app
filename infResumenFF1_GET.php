<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Infracciones.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php"); 
include_once("funcion.php");
echo "<meta charset='utf-8'>";

if($_SESSION["infraccionV"] > 0  && $_SESSION["filtroFlotilla"] > 0 ){ 
// PRIVILEGIO VISTA EJECUTIVO

$id_usuario = $_SESSION["id_usuario"]; 
$pagina 	= 1;
$pagina_1 	= 0;
########## ########## ########## #########

##### // INICIA DEFINIR LOS CONTRATOS DEL EJECUTIVO
contratosDelEjecutivo($id_usuario);
if($contratosArray) // OBTIENE UN ARRAY PARA HACER UN SELECT QUE INCLUYA LOS CONTRATOS DEL EJECUTIVO
{
	$todosMisContratos='';
	$cuantos 	= sizeof($contratosArray);
	$contador 	= 1;
	foreach( $contratosArray as $key => $value){
		$todosMisContratos.=" id_contrato = $value ";
		if($cuantos > $contador){
			$todosMisContratos.=" OR ";
		}
		$contador++;
	}
	echo "<br>";
	//echo $todosMisContratos; // PARA VER CONSTRUCCION DEL WHERE
}else{
	echo "NO TIENE CONTRATOS ASIGNADOS";
}
##### // TERMINA DEFINIR LOS CONTRATOS DEL EJECUTIVO

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 1000; //RESULTADOS POR PAGINA // 50 truncado a 5 para razones de editar resumen como tal

$cuenta_gps;

if($_SESSION["infraccionV"] > 0 ){
$cuenta_gps 		= " SELECT id_inf FROM infraccion WHERE ($todosMisContratos)";
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE INFRACCIONES</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4>";
echo "Página $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION

$sql_mttoSol = '';

if($_SESSION["infraccionV"] > 0){
// SI CONSULTA EJECUTIVO
	$sql_gps = 'SELECT * '
        . ' FROM infraccion '
        . "  WHERE  ($todosMisContratos)  "
        . ' ORDER BY '
        . ' id_inf '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}
echo "<section><fieldset><legend>RESUMEN DE INFRACCIONES</legend>";
echo "<table  >\n";
echo "<tr>
		<th>ECONOMICO</th>
		<th>SERIE</th>
		<th>TIPO</th>
		<th>PLACAS</th>
		<th>FECHA</th>
		<th>FOLIO</th>
		<th>DESCRIPCION</th>
		<th>IMPORTE</th>
	  </tr>";

$res_GPS 	= mysqli_query($dbd2, $sql_gps);

while($row 	= mysqli_fetch_assoc($res_GPS))
{
	$fechaInf 	= $row['fechaInf']; // asignacion corresponde al equipo configurado
	$folioInf 	= $row['folioInf'];
	$descripcion= $row['descripcion'];
	$importe 	= $row['importe'];
	$id_unidad	= $row['id_unidad'];

	// INICIO poner renglon resultados
	echo "<tr>";
		datosxid($id_unidad);
		echo "<td>{$Economico}</td>";
		echo "<td>{$Serie}</td>";
		echo "<td>{$Vehiculo}</td>";
		echo "<td>{$Placas}</td>";
		echo "<td>{$fechaInf}</td>";
		echo "<td>{$folioInf}</td>";
		echo "<td>{$descripcion}</td>";
		echo "<td>{$importe}</td>";
	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "</fieldset></section>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
} // FIN PRIVILEGIO EJECUTIVO