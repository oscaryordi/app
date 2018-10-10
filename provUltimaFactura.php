<?php
session_start();
include("seguridad.php");
include("caducidad.php");

if($_SESSION["proveedores"] > 0)
{
	include_once ("base.inc.php");

	$id_prov 	= $_GET['id_prov'];

	 // INICIO CONSULTA DOCTO
	$sql_prov 	= "SELECT * FROM mttoSol WHERE id_prov = '$id_prov' AND facturado > 0 ORDER BY id_mttoSol DESC LIMIT 1 ";
	$sql_prov_R = mysqli_query($dbd2, $sql_prov);
	$matrizPR	= mysqli_fetch_array($sql_prov_R);
	
	$id_mttoSol = $matrizPR['id_mttoSol'];



	$sql_MttoDoc 	= " SELECT * FROM  mttoDocto WHERE id_mttoSol = '$id_mttoSol' AND 
					tipo = 3 AND borrado = 0 ORDER BY id_docto DESC  LIMIT 1 " ;

	$sql_MttoDoc_R 	= mysqli_query($dbd2, $sql_MttoDoc);

	//global $archivo;
	//global $ruta;

	while($rowMD = mysqli_fetch_assoc($sql_MttoDoc_R))
		{ 
			$archivo 	= $rowMD['archivo'];
			$ruta		= $rowMD['ruta'];
		}

	if($sql_MttoDoc_R)
		{
			header('Location: ../exp/mtto/'.$ruta.'/'.$archivo.'');
		}
}