<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

if($_SESSION["movForaneo"] > 0)
{
	$id_movFor		= mysqli_real_escape_string($dbd2, $_GET['id_movFor'] );
	$id_doctoTra	= mysqli_real_escape_string($dbd2, $_GET['id_doctoTra'] );
	$pagina			= mysqli_real_escape_string($dbd2, $_GET['pagina'] );
	$capturo		= $_SESSION['id_usuario'];

	// CONFIRMAR ACTUAL EVITAR REFRESH
	$sql_ER 	= "SELECT borrado FROM movDocto WHERE id_docto = '$id_doctoTra' LIMIT 1";
	$sql_ER_R 	= mysqli_query($dbd2, $sql_ER);
	$row_ER_R 	= mysqli_fetch_array($sql_ER_R);
	$borrado 	= $row_ER_R['borrado'];

	if($borrado == 0)
	{
		// INICIO BORRAR DOCUMENTO
		$sql_TD 	= "UPDATE movDocto SET borrado = '1' WHERE id_docto = '$id_doctoTra' LIMIT 1";
		$sql_TD_R 	= mysqli_query($dbd2, $sql_TD);
		// TERMINA BORRAR DOCUMENTO

		if($sql_TD_R) // CONTROL DE CAMBIOS
		{
			$sql_up 	= mysqli_real_escape_string($dbd2, $sql_TD );
			$arrayviejo = mysqli_real_escape_string($dbd2, $sql_TD );
									
			$sql_control_cambios = "INSERT INTO controlcambios  
									(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
									VALUES 
									(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
			$cambio_registrado 	= mysqli_query($dbd2, $sql_control_cambios);
		}//CONTROL DE CAMBIOS

		if($sql_TD_R)
		{
			header("Location: movResTodo.php?pagina=".$pagina."");
		}
		// TERMINA "BORRAR"
	}
	else
	{
		header("Location: movResTodo.php?pagina=".$pagina."");
	}
} // CIERRE PRIVILEGIOS