<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

$id_cuenta	= $_POST['id_cuenta'];
$id_prov	= $_POST['id_prov'];
$suspendido = $_POST['suspendido'];
$capturo	= $_SESSION['id_usuario'];

$sql_AC = $id_cuenta."-".$id_prov."-".$suspendido ; // ARRAY ORIGINAL

if($suspendido == 0) // SI NO ESTA SUSPENDIDO, PROCEDE
{
	// INICIO SUSPENDER
	$sql_SC 	= "	UPDATE provBanco SET suspendido = '1' WHERE id_cuenta = '$id_cuenta' LIMIT 1";
	$sql_SC_R 	= 	mysqli_query($dbd2, $sql_SC);
	// TERMINA SUSPENDER
	if($sql_SC_R) // CONTROL DE CAMBIOS
		{
			$sql_up 	= mysqli_real_escape_string($dbd2, $sql_SC );
			$arrayviejo = mysqli_real_escape_string($dbd2, $sql_AC );
								
			$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
									(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
								VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
								
			$cambio_registrado 	= mysqli_query($dbd2, $sql_control_cambios);
		}	//CONTROL DE CAMBIOS
	if($sql_SC_R)
		{
			header("Location: provindex.php?id_prov=".$id_prov."");
		}
}else{
	header("Location: provindex.php?id_prov=".$id_prov."");}