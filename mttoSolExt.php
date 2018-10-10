<?php
include('1header.php');

// INICIA PRIVILEGIO VISTA EJECUTIVOS
if($_SESSION["mttoSol"] > 1 ){

include ("nav_mtto.php");
$id_usuario = $_SESSION['id_usuario'];

contratosDelEjecutivo($id_usuario);

if($contratosArray) // OBTIENE UN ARRAY PARA HACER UN SELECT QUE INCLUYA LOS CONTRATOS DEL EJECUTIVO
{
	$todosMisContratos = '';
	$cuantos 	= sizeof($contratosArray);
	$contador 	= 1;
	foreach( $contratosArray as $key => $value)
	{
		$todosMisContratos.=" id_contrato = $value ";
		if($cuantos > $contador)
		{
			$todosMisContratos.=" OR ";
		}
		$contador++;
	}
}
else
{
	echo "NO TIENE CONTRATOS ASIGNADOS";
}
// QUERY PARA OBTENER INFORMACION
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE ($todosMisContratos) AND externo = 1 "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC ';
//        . " LIMIT $pagina_1, $rxpag " ;
// QUERY PARA OBTENER INFORMACION

echo "<h2>SERVICIOS SOLICITADOS DIRECTAMENTE EN SISTEMA POR USUARIOS</h2>";
$pagina = '';
include('mttoSolResultSet.php'); // AQUI VIENE LA TABLA DE RESULTADOS

} // TERMINA PRIVILEGIO VISTA EJECUTIVOS
include('1footer.php');