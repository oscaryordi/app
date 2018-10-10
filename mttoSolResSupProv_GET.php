<?php #############################################
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Mantenimiento.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php"); 
include_once ("funcion.php");
?>
<meta charset='utf-8'>
<?php

$id_usuario = $_SESSION["id_usuario"];


// id_prov

if(isset($_GET['id_prov']))
{
	$id_prov = $_GET['id_prov'];
}
else{
	$id_prov = '';
}

tienecontrato($id_usuario);
if($miflotilla == 1 OR $_SESSION["mttoSolSup"] > 0 ){ // PRIVILEGIO EJECUTIVO// PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 


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

$cuenta_gps;
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol WHERE id_prov = '$id_prov'  AND cancelado = 0 ";

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<b>RESUMEN DE MANTENIMIENTO</b><br/>";
//echo "".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES<br/>";
echo "$cuenta SOLICITUDES, Hasta".$rxpag." Resultados<br/>";
//echo "Pag. $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION

?>
<style>
	table, th, td {border: 1px solid #ddd; font-size: 10px;}
</style>
<?php


// OBTENER ARRAY DE PARTIDAS Y AREAS ADMINISTRATIVAS
partidasDelContrato($id_contrato);
areasAdmDelContrato($id_contrato);
//print_r($partidasArray) ;
//echo "<br>";
//print_r($areasAdmArray) ;
//echo "<br>";
//  OBTENER ARRAY DE PARTIDAS Y AREAS ADMINISTRATIVAS

	$sql_mttoSol = '';

	$sql_mttoSol = 'SELECT * '
		. ' FROM mttoSol '
		 . "  WHERE id_prov = '$id_prov' AND cancelado = 0 "

		. ' ORDER BY '
		. ' id_mttoSol '
		. ' DESC '
		. " LIMIT $pagina_1, $rxpag " ;
		
echo "<table>";
echo "<tr>
		<th>FOLIO</th>
		<th>FECHA</th>
		<th>ECONOMICO</th>
		<th>SERIE</th>
		<th>PLACAS</th>
		<th>VEHICULO</th>
		<th>IMPORTE</th>
		<th>PROVEEDOR</th>
		<th>CONCEPTO</th>
		<th>KM</th>

	  </tr>";
/*
<th>MAIL</th>
<th>Fotos</th>
<th>COTIZACION</th>
<th>DEPOSITO</th>
<th>FACTURA</th>
<th>CLIENTE</th>
*/


$mttoSol_R = mysqli_query($dbd2, $sql_mttoSol);

while($row = mysqli_fetch_assoc($mttoSol_R)){

	$id_mttoSol 	= $row['id_mttoSol']; // 
	$fechaEj 		= $row['fechaEj'];
	$id_unidad		= $row['id_unidad'];
	$id_contrato 	= $row['id_contrato'];

	$id_cliente 	= $row['id_cliente'];

	$id_prov 		= $row['id_prov'];

	$concepto 		= $row['concepto'];
	$importe 		= $row['importe'];
	$km 			= $row['km'];

	$autorizadoS 	= $row['autorizadoS'];

/*
// DOCUMENTOS ASOCIADOS
	$dM5 		= $row['dM5']; 		// tiene mail ------5
	$dF4 		= $row['dF4']; 		// tiene fotos -----4
	$dC1 		= $row['dC1']; 		// tiene cotizacion 1
	$pagado 	= $row['pagado']; 	// tiene deposito --2
	$facturado 	= $row['facturado']; // tiene factura --3
*/
// TRAMITE
	$autorizadoS 	= $row['autorizadoS'];

	$rbolso 	= $row['rbolso'];

// INICIO es REEMBOLSO
$esrbolso = '';
$nombreR = '';
$esrbolso2 = '';
if($rbolso > 0){
	reembxid($id_mttoSol);
	$esrbolso = "<span style='color:blue;'>REEMBOLSO : </span>";
	$esrbolso2 = ', facturado por: ';
}
// TERMINA  es REEMBOLSO

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$id_mttoSol}</td>";
	echo "<td>{$fechaEj}</td>";
	datosxid($id_unidad);
	echo "<td>{$Economico}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Placas}</td>";
	echo "<td>{$Vehiculo}</td>";
	number_format($importe, 2);
	echo "<td>{$importe}</td>";
	proveedorxid($id_prov);
	echo "<td>{$esrbolso}{$nombreR}{$esrbolso2}{$PrazonSocial}</td>";
	echo "<td>{$concepto}</td>";
	echo "<td>{$km}</td>";

	// INICIA  PONER PARTIDAS Y ADREAS ADMINISTRATIVAS
	if($_SESSION["verPartidas"] > 0 OR $_SESSION["verAAdvas"] > 0)
	{
		unidadAsignacion($id_unidad);

		if($id_partida > 0  )
		{
			if($_SESSION["verPartidas"]  > 0 )
			{
				//global $partidasArray;
				$mostrarPDesc = 'ND';
				//$mensaje = '';
				//if( in_array( $id_partida, $partidasArray)  )
				//{	$mensaje = "si esta"; 
					$mostrarPDesc 	= $partidasArray["$id_partida"];
					//}
				//echo "<td>$id_partida , $mostrarPDesc , $mensaje, $partidasArray</td>";
				echo "<td>$mostrarPDesc</td>";
			}
		}

		if($id_subDiv2 > 0  )
		{
			if($_SESSION["verAAdvas"] > 0)
			{
				$mostrarAAsn2 = 'ND';
				//if( in_array( "$id_subDiv2", $areasAdmArray)  )
				//{ 
					$mostrarAAsn2 	= $areasAdmArray["$id_subDiv2"];
				//}
				echo "<td>$mostrarAAsn2</td>";
			}
		}
	}
	// TERMINA PONER PARTIDAS Y ADREAS ADMINISTRATIVAS

/*
	// INICIO ANALIZA SI TIENE MAIL $dM5  ES EL TIPO 5
	if($dM5 > 0)
		{
			echo "<td>SI</td>"; // COTIZACION
		}
	else // SUBIR
		{
			echo "<td>NO</td>"; // COTIZACION
		}
	// TERMINA ANALIZA SI TIENE MAIL

	// INICIO ANALIZA SI TIENE FOTOS
	if($dF4 > 0)
		{
			echo "<td>SI";
			echo "</td>";
		}
	else // SUBIR
		{
			echo "<td>NO</td>"; // FOTOS
		}
	// TERMINA ANALIZA SI TIENE FOTOS

	// INICIO ANALIZA SI ESTA SUBIDA LA COTIZACION
	if($dC1 > 0)
		{
			echo "<td>SI</td>"; // COTIZACION
		}
	else // SUBIR
		{
			echo "<td>NO</td>"; // COTIZACION
		}
	// TERMINA ANALIZA SI ESTA SUBIDA LA COTIZACION
	
	// INICIO ANALIZA SI ESTA HECHO EL PAGO DEPOSITO
	if($pagado > 0)
		{
			echo "<td>SI</td>";
		}
	else // SUBIR
		{
			echo "<td>NO</td>"; // PAGO
		}
	// TERMINA ANALIZA SI ESTA HECHO EL PAGO DEPOSITO

	// INICIO ANALIZA SI ESTA FACTURADO
	if($facturado > 0)
		{
			echo "<td>SI</td>";
		}
	else // SUBIR
		{
			echo "<td>NO</td>"; // FACTURADO
		}
	// TERMINA ANALIZA SI ESTA FACTURADO

	clientexid($id_cliente);
	echo "<td>$razonSocial</td>";
	$razonSocial = '';
*/
	// resetear variables de REEMBOLSO
	$esrbolso = '';
	$nombreR = '';
	$esrbolso2 = '';
	// resetear variables de REEMBOLSO

	echo "</tr>";
// FIN poner renglon resultados

}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA
