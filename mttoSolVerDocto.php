<?php
session_start();
include("seguridad.php");
include("caducidad.php");
if($_SESSION["mttoSol"] > 0){
include_once ("base.inc.php");

//$id_mttoSol 	= $_POST['id_mtto'];
//$tipo 	= $_POST['tipo'];

$id_mttoSol = mysqli_real_escape_string($dbd2, $_GET['id_mtto']);
$tipo 		= mysqli_real_escape_string($dbd2, $_GET['tipo']);

if($_GET['nodoc']){$nodoc = $_GET['nodoc'];}else{$nodoc = 1;}

// INICIO CONSULTA DOCTO
$sql_MttoDoc 	= " SELECT * FROM  mttoDocto 
					WHERE id_mttoSol = '$id_mttoSol' 
					AND tipo = '$tipo' 
					AND borrado = '0' 
					ORDER BY id_docto DESC LIMIT $nodoc " ;

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
// TERMINA CONSULTA DOCTO 
// https://jetvan.mx/jetvan/app/mttoSolVerDocto.php?id_mtto=1&tipo=1
// http://localhost/APP/app/mttoSolVerDocto.php?id_mtto=1&tipo=1