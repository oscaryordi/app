<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

//echo $_POST['id_docto'];

$id_docto	= $_POST['id_docto'];
$id_mttoSol	= $_POST['id_mttoSol'];
$tipoA		= $_POST['tipoA'];
$tipoN		= $_POST['tipoN'];

$capturo	=	$_SESSION['id_usuario'];

// CAMBIAR TABLA DOCTO MTTO
// CAMBIAR TIPO EN TABLA MTTO
// BORRAR EL TIPO ANTERIOR
// SUMAR EL TIPO ANTERIOR

// INICIO EDITAR TIPO
$sql_TD 	= "UPDATE mttoDocto SET tipo = '$tipoN' WHERE id_docto = '$id_docto' LIMIT 1";
$sql_TD_R 	= mysqli_query($dbd2, $sql_TD);
// TERMINA EDITAR TIPO

$sql_tiposD 	= "	SELECT dM5, dF4, dC1, pagado, facturado 
					FROM mttoSol 
					WHERE id_mttoSol = '$id_mttoSol' LIMIT 1 ";
$sql_tiposD_R 	= mysqli_query($dbd2, $sql_tiposD);
$row_tiposD_R 	= mysqli_fetch_array($sql_tiposD_R);

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
$NuevoTipo = '';
	switch($tipoN)
		{
			case "1":
				$NuevoTipo = 'dC1';
				$NuevoCuenta = $tipo1;
				break;
			case "2":
				$NuevoTipo = 'pagado';
				$NuevoCuenta = $tipo2;
				break;
			case "3":
				$NuevoTipo = 'facturado';
				$NuevoCuenta = $tipo3;
				break;
			case "4":
				$NuevoTipo = 'dF4';
				$NuevoCuenta = $tipo4;
				break;
			case "5":
				$NuevoTipo = 'dM5';
				$NuevoCuenta = $tipo5;
				break;
			default:
				;
		}

$ViejoRestado   = $ViejoCuenta - 1;
$NuevoSumado	= $NuevoCuenta + 1;

if($sql_TD_R){
	$sql_TMS = "UPDATE mttoSol SET $ViejoTipo = '$ViejoRestado', $NuevoTipo = '$NuevoSumado' WHERE  id_mttoSol = '$id_mttoSol' LIMIT 1 ";
	//echo "$sql_TMS";
	$sql_TMS_R = mysqli_query($dbd2, $sql_TMS);
}

if($sql_TMS_R) // CONTROL DE CAMBIOS
	{
		$sql_up 	= mysqli_real_escape_string($dbd2, $sql_TMS );
		$arrayviejo = mysqli_real_escape_string($dbd2, $sql_TD );
							
		$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
								(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
								VALUES 
								(NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
							
		$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
	}//CONTROL DE CAMBIOS

if($sql_TMS_R)
	{
		header("Location: mttoSolaltaDoc.php?id_mttoSol=".$id_mttoSol."");
	}
// TERMINA "BORRAR"