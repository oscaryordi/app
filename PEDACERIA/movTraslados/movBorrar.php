<?php
include_once ("base.inc.php");
//echo $_POST['id_docto'];

$id_movFor	= $_POST['id_movFor'];
$pagina		= $_POST['pagina'];
$capturo	= $_POST['id_usuario'];

//$id_errorexp= $_POST['id_errorexp'];


 // INICIO "BORRAR"
$sql_borrar = " UPDATE mov_traslados SET borrar = 1 WHERE id_movFor = '$id_movFor' LIMIT 1 " ;
$sql_borrar_R = mysql_query($sql_borrar);

if($sql_borrar_R)
{
	$sql_expBrr = "INSERT INTO controlcambios (id_cambios, capturo, updatequery, arrayviejo) VALUES (NULL, '$capturo', 'borrar traslado', '$id_movFor') ";
	$sql_expBrr_R = mysql_query($sql_expBrr);

	if($sql_expBrr)
		{
			header("Location: movResTodo.php?pagina=$pagina");
		}
}

// TERMINA "BORRAR"