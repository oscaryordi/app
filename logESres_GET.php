<?php #############################################
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=BitacoraEntradasSalidas.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php"); 
include_once("funcion.php");
echo "<meta charset='utf-8'>";

$id_usuario = $_SESSION["id_usuario"];


if($_SESSION["superLog"] > 0 ){ // PRIVILEGIO EJECUTIVO// PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 


// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 1000; //RESULTADOS POR PAGINA

if(isset($_GET['contador'])){
		$pagina = $_GET['contador'];
	}
else{
		$pagina = "1";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta;
$cuenta 			= "SELECT COUNT(id_formato) cuenta FROM formato_inventario  ";
$sacar_cuenta 	 	= mysqli_query($dbd2, $cuenta);
$row_cuenta			= mysqli_fetch_array($sacar_cuenta);
$cuenta 			= $row_cuenta['cuenta'];

echo "<h2>BITACORA DE ENTRADAS Y SALIDAS A PATIOS DE JET VAN</h2>";
echo "<h3>$cuenta REGISTROS</h3>";

?>
<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
</style>
<?php

	$sql_gps = 'SELECT 
				id_formato	,
				id_unidad	,
				id_sustE	,
				id_sustS	,
				numero_inventario	,
				fecharecepcion	,
				fechaentrega	,
				marca	,
				modelo	,
				economico	,
				color	,
				tipo	,
				placas	,
				serie	,
				kilometraje	,
				hora_entrada	,
				hora_salida	,
				razonsalida	,
				placasustituido	,
				razonentrada	,
				razonentradatexto	,
				proyecto_origen	,
				proyecto_destino	,
				ubicacion_origen	,
				ubicacion_destino	,
				conductor_entrada	,
				conductor_salida	,
				observaciones	,
				realizo_inventario	,
				solicito_unidad	,
				autoriza_salida	,
				recibe_unidad	 '
        . ' FROM formato_inventario '
        . ' ORDER BY '
        . ' id_formato '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

echo "<section><fieldset><legend>RESUMEN DE EQUIPOS ASIGNADOS</legend>";		
echo "<table>";
echo "<tr>
<th>ENTRADA/SALIDA</th>
<th>id_formato</th>
<th>id_unidad</th>
<th>id_sustE</th>
<th>id_sustS</th>
<th>numero_inventario</th>
<th>fecharecepcion</th>
<th>fechaentrega</th>
<th>marca</th>
<th>modelo</th>
<th>economico</th>
<th>color</th>
<th>tipo</th>
<th>placas</th>
<th>serie</th>
<th>kilometraje</th>
<th>hora_entrada</th>
<th>hora_salida</th>
<th>razonsalida</th>
<th>placasustituido</th>
<th>razonentrada</th>
<th>razonentradatexto</th>
<th>proyecto_origen</th>
<th>proyecto_destino</th>
<th>ubicacion_origen</th>
<th>ubicacion_destino</th>
<th>conductor_entrada</th>
<th>conductor_salida</th>
<th>observaciones</th>
<th>realizo_inventario</th>
<th>solicito_unidad</th>
<th>autoriza_salida</th>
<th>recibe_unidad</th>
</tr>";

$res_GPS = mysqli_query($dbd2, $sql_gps);

while($row = mysqli_fetch_assoc($res_GPS)){

$id_formato 	= $row['id_formato'];
$id_unidad 		= $row['id_unidad'];
$id_sustE 		= $row['id_sustE'];
$id_sustS 		= $row['id_sustS'];
$numero_inventario = $row['numero_inventario'];
$fecharecepcion = $row['fecharecepcion'];
$fechaentrega 	= $row['fechaentrega'];
$marca 			= $row['marca'];
$modelo 		= $row['modelo'];
$economico 		= $row['economico'];
$color 			= $row['color'];
$tipo 			= $row['tipo'];
$placas 		= $row['placas'];
$serie 			= $row['serie'];
$kilometraje 	= $row['kilometraje'];
$hora_entrada 	= $row['hora_entrada'];
$hora_salida 	= $row['hora_salida'];
$razonsalida 	= $row['razonsalida'];
$placasustituido = $row['placasustituido'];
$razonentrada 		= $row['razonentrada'];
$razonentradatexto 	= $row['razonentradatexto'];
$proyecto_origen 	= $row['proyecto_origen'];
$proyecto_destino 	= $row['proyecto_destino'];
$ubicacion_origen 	= $row['ubicacion_origen'];
$ubicacion_destino 	= $row['ubicacion_destino'];
$conductor_entrada 	= $row['conductor_entrada'];
$conductor_salida 	= $row['conductor_salida'];
$observaciones 		= $row['observaciones'];
$realizo_inventario = $row['realizo_inventario'];
$solicito_unidad 	= $row['solicito_unidad'];
$autoriza_salida 	= $row['autoriza_salida'];
$recibe_unidad 		= $row['recibe_unidad'];



	// INICIO poner renglon resultados
	echo "<tr>";

$entradaSalidaTxt = (is_null($fechaentrega))?'ENTRADA':'SALIDA';
echo "<td>{$entradaSalidaTxt}</td>";
echo "<td>{$id_formato}</td>";
echo "<td>{$id_unidad}</td>";
echo "<td>{$id_sustE}</td>";
echo "<td>{$id_sustS}</td>";
echo "<td>{$numero_inventario}</td>";
echo "<td>{$fecharecepcion}</td>";
echo "<td>{$fechaentrega}</td>";
echo "<td>{$marca}</td>";
echo "<td>{$modelo}</td>";
echo "<td>{$economico}</td>";
echo "<td>{$color}</td>";
echo "<td>{$tipo}</td>";
echo "<td>{$placas}</td>";
echo "<td>{$serie}</td>";
echo "<td>{$kilometraje}</td>";
echo "<td>{$hora_entrada}</td>";
echo "<td>{$hora_salida}</td>";
echo "<td>{$razonsalida}</td>";
echo "<td>{$placasustituido}</td>";
echo "<td>{$razonentrada}</td>";
echo "<td>{$razonentradatexto}</td>";
echo "<td>{$proyecto_origen}</td>";
echo "<td>{$proyecto_destino}</td>";
echo "<td>{$ubicacion_origen}</td>";
echo "<td>{$ubicacion_destino}</td>";
echo "<td>{$conductor_entrada}</td>";
echo "<td>{$conductor_salida}</td>";
echo "<td>{$observaciones}</td>";
echo "<td>{$realizo_inventario}</td>";
echo "<td>{$solicito_unidad}</td>";
echo "<td>{$autoriza_salida}</td>";
echo "<td>{$recibe_unidad}</td>";

	
	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA