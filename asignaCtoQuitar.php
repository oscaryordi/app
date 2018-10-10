<?php
session_start();
include("seguridad.php");
include("caducidad.php");
if($_SESSION["asigEctoSup"] > 0)
{ // INICIA PRIVILEGIO
	include_once ("base.inc.php");
	$pagina			= $_POST['pagina'];
	$ejecutivoID	= $_POST['ejecutivoID'];
	$id_a_contrato	= $_POST['id_a_contrato'];
	$quito			= $_SESSION['id_usuario'];

	 // INICIO "QUITAR"
	$sql_quitar = " UPDATE asignaEjecutivo 
					SET 
					fecha_final = CURRENT_TIMESTAMP, 
					quito = '$quito' 
					WHERE id_a_contrato = '$id_a_contrato' LIMIT 1 " ;
	$sql_quitar_R = mysqli_query($dbd2, $sql_quitar);

	if($sql_quitar_R)
	{
		header("Location: asignaEcons.php?pagina=$pagina&ejecutivoID=$ejecutivoID");
	}
	// TERMINA "QUITAR"
} // FIN PRIVILEGIO