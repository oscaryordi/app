<section><fieldset><legend>RESUMEN DE SOLICITUDES DE MANTENIMIENTO</legend>
<?php
$sql_mttoSol 	= '';
$pagina 		= '';

	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . " WHERE id_unidad = '$id_unidad'  AND cancelado = 0   "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC ' ;

include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
if(mysqli_num_rows($mttoSol_R) < 1 ){echo "NO HAY SOLICITUDES";}
?>
</fieldset></section>