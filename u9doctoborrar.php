<?php
include_once ("base.inc.php");
//echo $_POST['id_docto'];

$id_docto	= $_POST['id_docto'];
$id_unidad	= $_POST['id_unidad'];
$capturo	= $_POST['id_usuario'];

$id_errorexp= $_POST['id_errorexp'];


 // INICIO "BORRAR"
$sql_borrar = " UPDATE expedientes SET borrar = 1 WHERE id = '$id_docto' LIMIT 1 " ;
$sql_borrar_R = mysqli_query($dbd2, $sql_borrar);

if($sql_borrar_R)
{
	$sql_expBrr = "INSERT INTO expBrrd (id_borrado, id_docto, id_borro, fecha) VALUES (NULL, '$id_docto', '$capturo', CURRENT_TIMESTAMP) ";
	$sql_expBrr_R = mysqli_query($dbd2, $sql_expBrr);

	// INICIA ACTUALIZAR TABLA DE ERRORES REPORTADOS
	if( $id_errorexp!='' && $id_errorexp!= null && $id_errorexp > 0)
	{  // 1 Ed, 2 B, 3 Ca, 4 Np
		$sql_atendido = "UPDATE  expError SET 
					atendido = '$capturo', 
					fechaatnd = CURRENT_TIMESTAMP , 
					accion = '2' 
					WHERE id_errorexp = '$id_errorexp' 
					LIMIT 1 
					";
					$R_sql_atendido = mysqli_query($dbd2, $sql_atendido);
	}
	// TERMINA ACTUALIZAR TABLA DE ERRORES REPORTADOS
	if($sql_expBrr)
	{
		header("Location: u3index.php?id_unidad=$id_unidad");
	}
}

// TERMINA "BORRAR"