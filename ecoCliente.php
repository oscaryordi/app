<?php 
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php");

$ecoCliente = $_POST['ecoCliente'];

//echo $ecoCliente;

$sql_EcoCte 	= "SELECT id_unidad, id_contrato FROM ecoCliente WHERE EcoCliente = '$ecoCliente' LIMIT 1 ";
$sql_EcoCte_R 	= mysqli_query($dbd2, $sql_EcoCte);
$sql_EcoCte_M 	= mysqli_fetch_assoc($sql_EcoCte_R);
$id_unidad		= $sql_EcoCte_M['id_unidad'];

//echo "<br>";
//echo $id_unidad;

if($id_unidad != '' AND $id_unidad != NULL )
	{
		header("Location: u3index.php?id_unidad=".$id_unidad."");
	}
else{
		header("Location: u1consulta.php?resultado=NO_HAY_COINCIDENCIA_PARA_".$ecoCliente."" );
	}
?>