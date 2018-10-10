<?php
session_start();
include("seguridad.php");
include("caducidad.php");
if($_SESSION["mttoSol"] > 1){

	include_once ("base.inc.php");

	$id_mttoSol	= mysqli_real_escape_string($dbd2, $_GET['id_mttoSol']);
	$pagina		= mysqli_real_escape_string($dbd2, $_GET['pagina']);
	$capturo	= $_SESSION["id_usuario"];

	 // INICIO "CANCELAR"
	$sql_cancelar = " UPDATE mttoSol SET cancelado = 1, autorizadoS = 5 WHERE id_mttoSol = '$id_mttoSol'  " ;

	if($_SESSION["mttoSol"] < 3){
		$sql_cancelar .= "AND capturo = '$capturo' ";
	}

	$sql_cancelar_R = mysqli_query($dbd2, $sql_cancelar);

	if( mysqli_affected_rows($dbd2)>0 )
	{
		$sql_expBrr = "	INSERT INTO controlcambios 
						(id_cambios, capturo, updatequery, arrayviejo) 
						VALUES 
						(NULL, '$capturo', 'cancelar solicitud', '$id_mttoSol') ";
		$sql_expBrr_R = mysqli_query($dbd2, $sql_expBrr);

		if($sql_expBrr)
			{
				if($pagina>0)
				{
					header("Location: mttoSolRes.php?pagina=$pagina");
				}
				else
				{
					header("Location: mttoindex.php");	
				}
			}
	}
	else
	{
		echo mysqli_error($dbd2);
		echo mysqli_errno($dbd2);
		echo "<a href='index.php'> CANCELACION DEBE REALIZARSE POR EL MISMO USUARIO QUE HIZO LA SOLICITUD  </a>";
	}
}
// TERMINA "CANCELAR"