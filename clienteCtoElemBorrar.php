<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

$id_cliente		= $_GET['id_cliente']; // PARA PODER REGRESAR
$id_contrato	= $_GET['id_contrato'];// PARA PODER REGRESAR
$id_elem 		= $_GET['id_elem']; // ID DEL ELEMENTO A BORRAR
$tabBD 			= $_GET['tabBD']; // TABLA DEL ELEMENTO
$borrado		= $_GET['borrado']; // PARA NO CONSULTAR STATUS BORRADO
$capturo		= $_SESSION['id_usuario'];

// DETERMINAR COLUMNA
//$tabBD 			= 'cleRc';
$columna = '';

switch($tabBD)
{
	case "cleRc":
		$columna = 'id_polrc';
		break;
	case "cldConfid":
		$columna = 'id_polconfid';
		break;
	case "clcCmpl":
		$columna = 'id_polcum';
		break;
	case "clbCtoConv":
		$columna = 'id_convenio';
		break;
	case "clbCto":
		$columna = 'id_contrato';
		break;
	default:
		break;
}

$arrayviejo = $id_contrato."-".$id_cliente."- $columna ".$id_elem."-".$tabBD ; // ARRAY ORIGINAL

if($borrado == 0) // SI NO ESTA BORRADO, PROCEDE
{
	// INICIO BORRADO
	$sql_BE 	= "	UPDATE $tabBD SET borrado = '1' WHERE $columna = '$id_elem' LIMIT 1";

	//echo $sql_BE;

	$sql_BE_R 	= 	mysqli_query($dbd2, $sql_BE);
	// TERMINA BORRADO
	if($sql_BE_R) // CONTROL DE CAMBIOS
		{
			$sql_up 	= mysqli_real_escape_string($dbd2, $sql_BE );
								
			$sql_control_cambios 	=" INSERT INTO controlcambios  "
									." (id_cambios,  capturo,  updatequery,  arrayviejo, "
									." fecharegistro) "
									." VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo', "
									." CURRENT_TIMESTAMP ) ";
			$cambio_registrado 		= mysqli_query($dbd2, $sql_control_cambios);
		}	//CONTROL DE CAMBIOS
	if($sql_BE_R)
		{
			header("Location: clienteindexuno.php?id_cliente=".$id_cliente."");
		}
}
else
{
	header("Location: clienteindexuno.php?id_cliente=".$id_cliente."");
}