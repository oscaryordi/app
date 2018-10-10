<?php #############################################
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ProgramadosPago.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php"); 

if($_SESSION["mttoSolPag"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include_once("funcion.php");

$id_usuario = $_SESSION["id_usuario"]; 

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 500; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
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

$cuenta_gps;

if($_SESSION["mttoSolPag"] == 1){
$cuenta_gps 		= "  SELECT id_mttoSol FROM mttoSol WHERE autorizadoS = 1 AND programadoPago = 1 AND pagadoInfo = 0 AND supPago = '$id_usuario'";
}

if($_SESSION["mttoSolPag"] > 1){
$cuenta_gps 		= "  SELECT id_mttoSol FROM mttoSol WHERE autorizadoS = 1 AND programadoPago = 1 AND pagadoInfo = 0 ";	
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "RESUMEN DE SOLICITUDES PROGRAMADAS PARA PAGO<br/>";
echo "".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES<br/>";
echo "".$rxpag." Resultados por Pagina<br/>";
echo "Pag. $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION
?>

<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
.xl676914
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border:1.0pt solid #DDDDDD;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
</style>

<?php

$sql_mttoSol = '';

if($_SESSION["mttoSolPag"] == 1){
// SI CONSULTA EJECUTIVO
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE autorizadoS = 1 AND programadoPago = 1 AND pagadoInfo = 0 AND supPago = '$id_usuario'"
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["mttoSolPag"] > 1){
// SI CONSULTA SUPERVISOR
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE  autorizadoS = 1 AND programadoPago = 1 AND pagadoInfo = 0 "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' ASC '
        . " LIMIT $pagina_1, $rxpag " ;
}
		
echo "<table>";
echo "<tr>
<th>FOLIO SOLICITUD</th>
<th>RFC PROVEEDOR</th>
<th>NOMBRE DEL BENEFICIARIO</th>
<th>CLABE DEL BENEFICIARIO</th>
<th>REFERENCIA DE PAGO</th>
<th>FECHA DE ABONO</th>
<th>NOMBRE DEL BANCO</th>
<th>IMPORTE</th>
<th>CONCEPTO DE PAGO</th>
</tr>";

$mttoSol_R = mysqli_query($dbd2, $sql_mttoSol);

while($row = mysqli_fetch_assoc($mttoSol_R)){

	$id_mttoSol = $row['id_mttoSol'];

	$id_prov 	= $row['id_prov'];
	$rbolso 	= $row['rbolso'];
	$id_prov_c 	= $row['id_prov_c'];

	$importe 	= $row['importe'];

	$id_unidad	= $row['id_unidad'];
	$km 		= $row['km'];
	$concepto 	= $row['concepto'];
	$id_cliente = $row['id_cliente'];

// INICIO poner renglon resultados
	echo "<tr>";
	// FOLIO SOLICITUD
	echo "<td>{$id_mttoSol}</td>";

	// RFC PROVEEDOR
	proveedorxid($id_prov);
	echo "<td>{$Prfc}</td>";

	$nombreBeneficiario = '';
	$clabeMostrar = '';
	$bancoMostrar = '';

	if($rbolso > 0){ // ES REEMBOLSO
		reembxid($id_mttoSol);
		$clabeMostrar = $clabeR;
		$bancoMostrar = $bancoR;
		$nombreBeneficiario = $nombreR;
	}
	else{ // ES PAGO AL PROVEEDOR
		provCtaxid($id_prov_c);
		$clabeMostrar = $PCclabe;
		$bancoMostrar = $PCbanco;
		$nombreBeneficiario = $PrazonSocial;
	}

	// NOMBRE DEL BENEFICIARIO
	echo "<td>$nombreBeneficiario</td>";

	// CLABE DEL BENEFICIARIO
	$clabeMostrar = "'".$clabeMostrar;
//	$clabeMostrar = (string)$clabeMostrar;
//	$clabeMostrar = str_replace("'", "", $clabeMostrar);
	echo "<td  class=xl676914 >{$clabeMostrar}</td>";

	// REFERENCIA DE PAGO
	echo "<td>{$id_mttoSol}</td>";	

	// FECHA DE ABONO
	echo "<td>".date('d/m/Y')."</td>";

	// NOMBRE DEL BANCO
	echo "<td>{$bancoMostrar}</td>";	

	// IMPORTE
	echo "<td>".number_format($importe, 2)."</td>";

	// CONCEPTO DE PAGO
	datosxid($id_unidad);
	clientexid($id_cliente);

	echo "<td>|{$id_mttoSol} ::: {$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo} ::: KM{$km} ::: {$concepto} ::: {$razonSocial}
	</td>";

	// resetear variables de REEMBOLSO
	$razonSocial = '';	
	$esrbolso 	= '';
	$nombreR 	= '';
	$esrbolso2 	= '';
	// resetear variables de REEMBOLSO

	echo "</tr>";
// FIN poner renglon resultados
}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. 2008 - ".date('Y')."</p>";
} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA