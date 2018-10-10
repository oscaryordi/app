<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

//echo $_POST['id_docto'];

$id_docto		= $_POST['id_docto'];
$id_estimacion	= $_POST['id_estimacion'];
$id_contrato	= $_POST['id_contrato']; // para header redirect
$tipoA			= $_POST['tipoA'];
$borrado		= $_POST['borrado'];

$capturo	=	$_SESSION['id_usuario'];

// CAMBIAR TABLA DOCTO estima
// CAMBIAR TIPO EN TABLA estima
// BORRAR EL TIPO ANTERIOR
// SUMAR EL TIPO ANTERIOR

// CONFIRMAR ACTUAL EVITAR REFRESH
$sql_ER 	= "SELECT borrado FROM estimacionDocto WHERE id_docto = '$id_docto' LIMIT 1";
$sql_ER_R 	= mysqli_query($dbd2, $sql_ER);
$row_ER_R 	= mysqli_fetch_array($sql_ER_R);
$borrado 	= $row_ER_R['borrado'];

if($borrado == 0){

// INICIO BORRAR DOCUMENTO
$sql_TD 	= "UPDATE estimacionDocto SET borrado = '1' WHERE id_docto = '$id_docto' LIMIT 1";
$sql_TD_R 	= mysqli_query($dbd2, $sql_TD);
// TERMINA BORRAR DOCUMENTO

/*
// ACTUALIZAR TABLA DE LA ESTIMACION
$sql_tiposD 	= "	SELECT dM5, dF4, dC1, pagado, facturado 
					FROM mttoSol 
					WHERE id_mttoSol = '$id_mttoSol' LIMIT 1 ";
$sql_tiposD_R 	= mysqli_query($dbd2, $sql_tiposD);
$row_tiposD_R 	= mysqli_fetch_array($sql_tiposD_R);
// ACTUALIZAR TABLA DE LA ESTIMACION

$tipo1 	= $row_tiposD_R['dC1'];
$tipo2 	= $row_tiposD_R['pagado'];
$tipo3 	= $row_tiposD_R['facturado'];
$tipo4 	= $row_tiposD_R['dF4'];
$tipo5 	= $row_tiposD_R['dM5'];
*/

$ViejoTipo = '';

switch($tipoA)
	{
		case "1":
			$ViejoTipo = 'd1Factura';
			break;
		case "2":
			$ViejoTipo = 'd2Estimacion';
			break;
		case "3":
			$ViejoTipo = 'd3OtroSoporte';
			break;
		case "4":
			$ViejoTipo = 'd4Penaliza';
			break;
		case "5":
			$ViejoTipo = '';
			break;
		default:
			break;
	}

if($sql_TD_R){
	$sql_TMS = "UPDATE estimacion SET $ViejoTipo = $ViejoTipo - 1 WHERE  id_estimacion = '$id_estimacion' LIMIT 1 ";
	$sql_TMS_R = mysqli_query($dbd2, $sql_TMS);
}

if($sql_TMS_R) // CONTROL DE CAMBIOS
	{
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_TMS );
		$arrayviejo = mysqli_real_escape_string($dbd2, $sql_TD );
							
		$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
								(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
							VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
		$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
	}//CONTROL DE CAMBIOS

if($sql_TMS_R)
	{
		header("Location: estimacionAltaDocto.php?id_contrato=".$id_contrato."&id_estimacion=".$id_estimacion."");
	}
// TERMINA "BORRAR"
}
else
{
	header("Location: estimacionAltaDocto.php?id_contrato=".$id_contrato."&id_estimacion=".$id_estimacion."");
}