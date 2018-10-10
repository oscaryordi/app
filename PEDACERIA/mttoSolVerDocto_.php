<?php
include_once ("base.inc.php");

//$id_mttoSol 	= $_POST['id_mtto'];
//$tipo 	= $_POST['tipo'];

$id_mttoSol = $_GET['id_mtto'];
$tipo 		= $_GET['tipo'];

 // INICIO CONSULTA DOCTO
$sql_MttoDoc 	= " SELECT * FROM  mttoDocto WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = '$tipo' ORDER BY id_docto DESC  LIMIT 1 " ;

$sql_MttoDoc_R 	= mysql_query($sql_MttoDoc);

//global $archivo;
//global $ruta;

while($rowMD = mysql_fetch_assoc($sql_MttoDoc_R))
	{ 
		$archivo 	= $rowMD['archivo'];
		$ruta		= $rowMD['ruta'];
	}

if($sql_MttoDoc_R)
	{
		header('Location: ../exp/mtto/'.$ruta.'/'.$archivo.'');
	}

// TERMINA CONSULTA DOCTO 
// https://jetvan.mx/jetvan/app/mttoSolVerDocto.php?id_mtto=1&tipo=1
// http://localhost/APP/app/mttoSolVerDocto.php?id_mtto=1&tipo=1