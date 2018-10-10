<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

$id_docto		= $_POST['id_docto'];
$id_estimacion	= $_POST['id_estimacion'];
$id_contrato	= $_POST['id_contrato']; // para header redirect
$tipoA			= $_POST['tipoA'];
$tipoN			= $_POST['tipoN'];
$importeDto		= mysqli_real_escape_string($dbd2, $_POST['importeDto']);
$obsEA			= mysqli_real_escape_string($dbd2, strtoupper($_POST['obsEd']));

$capturo	=	$_SESSION['id_usuario'];

// CONFIRMAR ACTUAL EVITAR REFRESH
$sql_ER 	= "	SELECT * FROM estimacionDocto 
				WHERE id_docto = '$id_docto' 
				AND tipo = '$tipoN' 
				AND obs = '$obsEA' 
				AND importeDto = '$importeDto' 
				LIMIT 1";
$sql_ER_R 	= mysqli_query($dbd2, $sql_ER);
//$row_ER_R 	= mysqli_fetch_array($sql_ER_R);
$esIgual 	= mysqli_affected_rows($dbd2); // O (ZERO) NO EXISTE, 1 (UNO) EXISTE UNO IGUAL


if($esIgual == 0){

// INICIO EDITAR DOCUMENTO
$sql_TD 	= 	 " UPDATE estimacionDocto SET "
				." tipo = '$tipoN', "
				." obs = '$obsEA' , "
				." importeDto = '$importeDto' "
				." WHERE id_docto = '$id_docto' LIMIT 1";
$sql_TD_R 	= mysqli_query($dbd2, $sql_TD);
// TERMINA EDITAR DOCUMENTO


$NuevoTipo = '';
switch($tipoN)
	{
		case "1":
			$NuevoTipo = 'd1Factura';
			break;
		case "2":
			$NuevoTipo = 'd2Estimacion';
			break;
		case "3":
			$NuevoTipo = 'd3OtroSoporte';
			break;
		case "4":
			$NuevoTipo = 'd4Penaliza';
			break;
		case "5":
			$NuevoTipo = '';
			break;
		default:
			break;
	}

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
	$sql_TMS = "UPDATE estimacion SET $ViejoTipo = $ViejoTipo - 1, $NuevoTipo = $NuevoTipo + 1 
				WHERE  id_estimacion = '$id_estimacion' LIMIT 1 ";
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