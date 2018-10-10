<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php");

$id_usuario		= $_GET['id_usuario']; 
$suspendido		= $_GET['suspendido'];
$pagina			= $_GET['pagina']; // PARA PODER REGRESAR
$externo		= $_GET['externo']; // PARA PODER REGRESAR

$capturo		= $_SESSION['id_usuario'];

$arrayviejo 	= $id_usuario."-".$id_usuario."-".$suspendido ; // ARRAY ORIGINAL

$regreso = '';
switch($externo)
{
	case "0":
		$regreso .= 'RHinterno.php';
		break;
	case "1":
		$regreso .= 'RHexterno.php';
		break;
	case "2":
		$regreso .= 'RHasociado.php';
		break;
	default:
		break;
}

if($suspendido == 1) // SI NO ESTA BORRADO, PROCEDE
{
	// INICIO BORRADO
	$sql_BE 	= "	UPDATE usuarios SET suspendido = '0' 
					WHERE id_usuario = '$id_usuario' LIMIT 1";
	$sql_BE_R 	= 	mysqli_query($dbd2, $sql_BE);
	// TERMINA BORRADO
	if($sql_BE_R) // CONTROL DE CAMBIOS
	{
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_BE);
		$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo);

		$sql_control_cambios = "INSERT INTO controlcambios  
								(id_cambios,  capturo,  updatequery,  
								arrayviejo,  fecharegistro) 
								VALUES (NULL,  '$capturo',  '$sql_up',  
								'$arrayviejo',  CURRENT_TIMESTAMP ) ";

		$cambio_registrado 	 = mysqli_query($dbd2, $sql_control_cambios);
	}	//CONTROL DE CAMBIOS
	if($sql_BE_R)
	{
		header("Location: ".$regreso."?pagina=".$pagina."");
	}
}
else
{
	header("Location: ".$regreso."?pagina=".$pagina."");
}