<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");


if($_SESSION["infraccionH"] > 1){

$id_inf		= mysqli_real_escape_string($dbd2, $_GET['id_inf'] );
$id_docto	= mysqli_real_escape_string($dbd2, $_GET['id_docto'] );
$pagina		= mysqli_real_escape_string($dbd2, $_GET['pagina'] );
$capturo	= $_SESSION['id_usuario'];

// CONFIRMAR ACTUAL EVITAR REFRESH
$sql_ER 	= "SELECT borrado FROM infDocto WHERE id_docto = '$id_docto' LIMIT 1";
$sql_ER_R 	= mysqli_query($dbd2, $sql_ER);
$row_ER_R 	= mysqli_fetch_array($sql_ER_R);
$borrado 	= $row_ER_R['borrado'];

if($borrado == 0){

// INICIO BORRAR DOCUMENTO
$sql_TD 	= "UPDATE infDocto SET borrado = '1' WHERE id_docto = '$id_docto' LIMIT 1";
$sql_TD_R 	= mysqli_query($dbd2, $sql_TD);
// TERMINA BORRAR DOCUMENTO

if($sql_TD_R) // CONTROL DE CAMBIOS
	{
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_TD );
		$arrayviejo = mysqli_real_escape_string($dbd2, $sql_TD );
							
		$sql_control_cambios = "INSERT INTO controlcambios  
								(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
								VALUES 
								(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP )";
		$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
	}//CONTROL DE CAMBIOS

if($sql_TD_R)
	{
		header("Location: infResumen.php?pagina=".$pagina."");
	}
// TERMINA "BORRAR"
}
else
{
	header("Location: infResumen.php?pagina=".$pagina."");
}

}