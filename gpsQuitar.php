<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php");
// GPS QUITAR // GPS QUITAR

$id_unidad	= mysqli_real_escape_string($dbd2, $_GET['id_unidad']); // PARA PODER REGRESAR
$id_gps		= mysqli_real_escape_string($dbd2, $_GET['id_gps']);
$fechaFinal	= mysqli_real_escape_string($dbd2, $_GET['fechaFinal']);
$capturo	= $_SESSION['id_usuario'];

if($fechaFinal == '' OR is_null($fechaFinal)){

	// INICIO EDITAR STATUS GPS
	$sql_GPSff 	= 	 " UPDATE gpsAsignado SET "
					." fechaFinal 	= CURRENT_TIMESTAMP , "
					." capturoff 	= '$capturo' "
					." WHERE id_gps = '$id_gps' LIMIT 1";
	$sql_GPSff_R 	= mysqli_query($dbd2, $sql_GPSff);
	// TERMINA EDITAR STATUS GPS

	if($sql_GPSff_R)
		{
			header("Location: u3index.php?id_unidad=".$id_unidad."");
		}
}
else
{
	header("Location: u3index.php?id_unidad=".$id_unidad."");
}