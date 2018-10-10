<?php
session_start();
include("seguridad.php");
include("caducidad.php");
if($_SESSION["mttoSolPag"] > 0){

	// FECHA Y HORA DE CIUDAD DE MEXICO
	date_default_timezone_set('America/Mexico_city');
	$fechaPg = date("Y-m-d H:i:s");

	include_once ("base.inc.php");

	$id_mttoSol	= mysqli_real_escape_string($dbd2, $_GET['id_mttoSol']);
	$pagina		= mysqli_real_escape_string($dbd2, $_GET['pagina']);
	$capturo	= $_SESSION["id_usuario"];

	 // INICIO "CANCELAR"
	$sql_pagoInfo 	= " UPDATE mttoSol SET pagadoInfo = 1  WHERE id_mttoSol = '$id_mttoSol'  " ;


	$sql_pagoInfo_R = mysqli_query($dbd2, $sql_pagoInfo);

	if(mysqli_affected_rows($dbd2)>0)
	{
		$sql_CC = "INSERT INTO controlcambios (id_cambios, capturo, updatequery, arrayviejo) VALUES (NULL, '$capturo', 'pago realizado', '$id_mttoSol') ";
		$sql_CC_R = mysqli_query($dbd2, $sql_CC);

		if($sql_CC_R)
			{
				if($pagina>0)
				{
					header("Location: pagosResProg.php?pagina=$pagina");
				}
				else
				{
					header("Location: pagosindex.php");	
				}
			}
	}
	else
	{
		echo mysqli_error($dbd2);
		echo mysqli_errno($dbd2);
		echo "<a href='index.php'> QUIZA ALGO FALLO </a>";
	}
}
// TERMINA "CANCELAR"