<?php
session_start();
include("seguridad.php");
include("caducidad.php");
if($_SESSION["estimacionH"] > 0 OR $_SESSION["estimacionV"] > 0)
{
	include_once ("base.inc.php");

	$id_estimacion 	= $_GET['id_estimacion'];
	$tipo 			= $_GET['tipo'];

	if($_GET['nodoc']){$nodoc = $_GET['nodoc'];}else{$nodoc = 1;}

	 // INICIO CONSULTA DOCTO
	$sql_MttoDoc 	= " SELECT * FROM  estimacionDocto 
						WHERE 	id_estimacion = '$id_estimacion' 
						AND 	tipo = '$tipo' 
						AND 	borrado = '0' 
						ORDER BY id_docto DESC  
						LIMIT 	$nodoc " ;

	$sql_MttoDoc_R 	= mysqli_query($dbd2, $sql_MttoDoc);

	while($rowMD 	= mysqli_fetch_assoc($sql_MttoDoc_R))
	{ 
		$archivo 	= $rowMD['archivo'];
		$ruta		= $rowMD['ruta'];
	}
	if($sql_MttoDoc_R)
	{
		header('Location: ../exp/estima/'.$ruta.'/'.$archivo.'');
	}
}
// TERMINA CONSULTA DOCTO 
// https://jetvan.mx/jetvan/app/mttoSolVerDocto.php?id_mtto=1&tipo=1
// http://localhost/APP/app/mttoSolVerDocto.php?id_mtto=1&tipo=1
// estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=2&nodoc=$x