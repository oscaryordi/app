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

//$id_usuario = $_SESSION["id_usuario"];

if($_SESSION["sustituto"] > 2){ // PRIVILEGIO 

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
$cuenta 			= "SELECT COUNT(id_sust) cuenta FROM sustituto  ";
$sacar_cuenta 	 	= mysqli_query($dbd2, $cuenta);
$row_cuenta			= mysqli_fetch_array($sacar_cuenta);
$cuenta 			= $row_cuenta['cuenta'];

echo "<h2>RESUMEN DE SOLICITUDES DE SUSTITUTO</h2>";
echo "<h3>$cuenta REGISTROS</h3>";

?>
<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
</style>
<?php

	$sql_gps = 'SELECT * '
        . ' FROM sustituto '
        . ' ORDER BY '
        . ' id_sust '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

echo "<table>";
echo "<tr>
<th>FOLIO</th>
<th>RFC</th>
<th>CLIENTE</th>
<th>ID_CTO</th>
<th>CONTRATO</th>

<th style='color:red;'>ECONOMICO</th>
<th style='color:red;'>SERIE BASE</th>
<th style='color:red;'>PLACA</th>
<th style='color:red;'>TIPO BASE</th>
<th style='color:red;'>MODELO</th>

<th style='color:green;'>ECONOMICO</th>
<th style='color:green;'>SERIE SUSTITUTO</th>
<th style='color:green;'>PLACA</th>
<th style='color:green;'>TIPO SUSTITUTO</th>
<th style='color:green;'>MODELO</th>

<th>FORMATO_INVENTARIO</th>
<th>FECHA PROMESA DEVOLUCION</th>
<th>PROYECTO</th>
<th>MOTIVO</th>
<th>LUGAR</th>
<th>SOLICITO</th>
<th>FECHA SOLICITUD</th>
<th>FECHA DE ENTREGA DEL S</th>
<th>FECHA DE DEVOLUCION DEL S</th>
<th>STATUS</th>
</tr>";

$res_GPS = mysqli_query($dbd2, $sql_gps);

while($row = mysqli_fetch_assoc($res_GPS)){

$id_sust 		= $row['id_sust'];
$id_cliente 	= $row['id_cliente'];
$id_contrato 	= $row['id_contrato'];
$serieFallado 	= $row['serieFallado'];
$id_unidadF 	= $row['id_unidadF'];
$serieSustituto = $row['serieSustituto'];
$id_unidadS 	= $row['id_unidadS'];
$id_formato 	= $row['id_formato'];
$fechaDev 		= $row['fechaDev'];
$proyecto 		= $row['proyecto'];
$motivo 		= $row['motivo'];
$lugarResguardo = $row['lugarResguardo'];
$capturo 		= $row['capturo'];
$fecharegistro 	= $row['fecharegistro'];
$id_formatoI 	= $row['id_formatoI'];
$fechaI 		= $row['fechaI'];
$horaI 			= $row['horaI'];
$virtualI 		= $row['virtualI'];
$id_formatoF 	= $row['id_formatoF'];
$fechaF 		= $row['fechaF'];
$horaF 			= $row['horaF'];
$virtualF 		= $row['virtualF'];
$status 		= $row['status'];
$cancelo		= $row['cancelo'];


	// INICIO poner renglon resultados
	echo "<tr>";

	//$entradaSalidaTxt = (is_null($fechaentrega))?'ENTRADA':'SALIDA';
	echo "<td>{$id_sust}</td>";


	contratoxid($id_contrato);
	clientexid($id_cliente);
	echo "<td>{$rfc}</td>";
	echo "<td>{$razonSocial}, ALIAS_CTE: {$alias}</td>";
	echo "<td>{$id_alan}</td>";
	echo "<td> {$numero}, ALIAS_CTO: {$aliasCto}</td>";
	$rfc 		= '';
	$razonSocial= '';
	$alias 		= '';
	$id_alan 	= '';
	$numero 	= '';
	$aliasCto 	= '';
	
	datosxid($id_unidadF);
	echo "<td style='color:red;'>{$Economico}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Placas}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Modelo}</td>";

	datosxid($id_unidadS);
	echo "<td style='color:green;'>{$Economico}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Placas}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Modelo}</td>";
	$Economico 	= '';
	$Serie 		= '';
	$Placas 	= '';
	$Vehiculo 	= '';
	$Modelo 	= '';

	echo "<td>{$id_formato}</td>";
	echo "<td>{$fechaDev}</td>";
	echo "<td>{$proyecto}</td>";
	echo "<td>{$motivo}</td>";
	echo "<td>{$lugarResguardo}</td>";

	$id_usuario = $capturo;
	usuarioxid($id_usuario);
	echo "<td>{$nombre}</td>";
	$id_usuario = '';
	$nombre 	= '';

	echo "<td>{$fecharegistro}</td>";
	echo "<td>{$fechaI}</td>";
	echo "<td>{$fechaF}</td>";


	$statusTXT = '';
	if($cancelo>0)
		{$statusTXT = 'CANCELADO';}
	if(is_null($fechaI) &&	$cancelo == 0)
		{$statusTXT = 'PENDIENTE DE EJECUCION';}
	if(!is_null($fechaI) &&	is_null($fechaF))
		{$statusTXT = 'SUSTITUTO ENTREGADO AUN CON CLIENTE';}
	if(!is_null($fechaI) &&	!is_null($fechaF))
		{$statusTXT = 'SOLICITUD CONCLUIDA, SUSTITUTO DEVUELTO';}
	echo "<td>{$statusTXT}</td>";
	
	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
} // FIN PRIVILEGIO