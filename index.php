<?php
include("1header.php");
?>

<p>
	<a href='u1consulta.php'>Consultar unidad</a>
</p>

<p>
	<a href='index.php' target='blank'>Abrir otra ventana</a>
</p>
<?php


# inicia mensaje personalizado ine
$id_usuario 	= $_SESSION['id_usuario'];
$id_contrato 	= '99'; // $id_contrato INE grande actual
contratosDelEjecutivo($id_usuario);
if($contratosArray != '')
{
	$leCorresponde 	= in_array($id_contrato, $contratosArray);

	if($leCorresponde == TRUE )
	{
		echo "<h3>Se les informa que las nuevas pólizas de seguro están disponibles en la consulta de la unidad vehicular, las cuales cuentan con una vigencia al 01/10/2019</h3>";
	}
}
# termina mensaje personalizado ine




echo "<br>";
include('tutoriales.php');
echo "<br>";
include('politicas.php');
//include('solAtnResultSet.php');
include("1footer.php");
?>