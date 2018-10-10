<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

//echo $_POST['id_docto'];

$id_docto	= $_POST['id_docto'];
$id_mttoSol	= $_POST['id_mttoSol'];
$tipoA		= $_POST['tipoA'];
//$tipoN		= $_POST['tipoN'];

$capturo	=	$_SESSION['id_usuario'];

// CAMBIAR TABLA DOCTO MTTO
// CAMBIAR TIPO EN TABLA MTTO
// BORRAR EL TIPO ANTERIOR
// SUMAR EL TIPO ANTERIOR

// CONFIRMAR ACTUAL EVITAR REFRESH
$sql_ER 	= "SELECT borrado FROM mttoDocto WHERE id_docto = '$id_docto' LIMIT 1";
$sql_ER_R 	= mysql_query($sql_ER);
$row_ER_R 	= mysql_fetch_array($sql_ER_R);
$borrado 	= $row_ER_R['borrado'];

if($borrado == 0){

// INICIO BORRAR DOCUMENTO
$sql_TD 	= "UPDATE mttoDocto SET borrado = '1' WHERE id_docto = '$id_docto' LIMIT 1";
$sql_TD_R 	= mysql_query($sql_TD);
// TERMINA BORRAR DOCUMENTO

$sql_tiposD 	= "	SELECT dM5, dF4, dC1, pagado, facturado 
					FROM mttoSol 
					WHERE id_mttoSol = '$id_mttoSol' LIMIT 1 ";
$sql_tiposD_R 	= mysql_query($sql_tiposD);
$row_tiposD_R 	= mysql_fetch_array($sql_tiposD_R);

$tipo1 	= $row_tiposD_R['dC1'];
$tipo2 	= $row_tiposD_R['pagado'];
$tipo3 	= $row_tiposD_R['facturado'];
$tipo4 	= $row_tiposD_R['dF4'];
$tipo5 	= $row_tiposD_R['dM5'];

$ViejoTipo = '';
	switch($tipoA)
		{
		    case "1":
        		$ViejoTipo = 'dC1';
        		$ViejoCuenta = $tipo1;
        		break;
    		case "2":
        		$ViejoTipo = 'pagado';
        		$ViejoCuenta = $tipo2;
        		break;
    		case "3":
        		$ViejoTipo = 'facturado';
        		$ViejoCuenta = $tipo3;
        		break;
		    case "4":
        		$ViejoTipo = 'dF4';
        		$ViejoCuenta = $tipo4;
        		break;
    		case "5":
        		$ViejoTipo = 'dM5';
        		$ViejoCuenta = $tipo5;
        		break;
    		default:
        		;
		}
$ViejoRestado = $ViejoCuenta -1;
//$NuevoSumado = $NuevoCuenta + 1;

if($sql_TD_R){
	$sql_TMS = "UPDATE mttoSol SET $ViejoTipo = '$ViejoRestado' WHERE  id_mttoSol = '$id_mttoSol' LIMIT 1 ";
	$sql_TMS_R = mysql_query($sql_TMS);
}

if($sql_TMS_R) // CONTROL DE CAMBIOS
	{
		$sql_up 	= mysql_real_escape_string($sql_TMS,  $conectar);
		$arrayviejo = mysql_real_escape_string($sql_TD,  $conectar);
							
		$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
								(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
							VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
							
		$cambio_registrado = mysql_query($sql_control_cambios);
	}//CONTROL DE CAMBIOS

if($sql_TMS_R)
	{
		header("Location: mttoSolaltaDoc.php?id_mttoSol=".$id_mttoSol."");
	}
// TERMINA "BORRAR"

}else{
	header("Location: mttoSolaltaDoc.php?id_mttoSol=".$id_mttoSol."");
}