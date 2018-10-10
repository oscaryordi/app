<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

$id_cliente		= $_GET['id_cliente']; // PARA PODER REGRESAR
$id_contrato	= $_GET['id_contrato'];// PARA PODER REGRESAR
$id_docto 		= $_GET['id_docto'];
//$borrado		= $_GET['borrado']; // PARA NO CONSULTAR STATUS BORRADO

$capturo		= $_SESSION['id_usuario'];

$arrayviejo = $id_contrato."-".$id_estimacion."-".$id_docto ; // ARRAY ORIGINAL

if($borrado == 0) // SI NO ESTA BORRADO, PROCEDE
{
	// INICIO BORRADO
	$sql_BE 	= "	UPDATE clfDto SET borrado = '1' WHERE id_docto = '$id_docto' LIMIT 1";
	$sql_BE_R 	= 	mysqli_query($dbd2, $sql_BE);
	// TERMINA BORRADO
	if($sql_BE_R) // CONTROL DE CAMBIOS
	{
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_BE );
								
		$sql_control_cambios 	= "	INSERT INTO controlcambios  
									(id_cambios,  capturo,  updatequery,  arrayviejo,  
									fecharegistro) 
									VALUES 
									(NULL,  '$capturo',  '$sql_up',  '$arrayviejo', 
									 CURRENT_TIMESTAMP ) ";
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