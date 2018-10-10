<?php
if($_SESSION["solAtn"] > 0)
{
	$sql_SA =   ' SELECT * '
				. ' FROM solAtn '
				. " WHERE id_unidad = '$id_unidad' "
				. " ORDER BY fechareg ASC ";
	$sql_SA_R 	= mysqli_query($dbd2,$sql_SA);
	@$camposuh  = mysqli_num_fields($sql_SA_R);
	@$filasuh   = mysqli_num_rows($sql_SA_R);


	include 'solAtnResultSet.php';
}