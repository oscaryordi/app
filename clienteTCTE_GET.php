<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ContratosConEjecutivos.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php"); 
include_once("funcion.php");
echo "<meta charset='utf-8'>";
?>
<style>
table{border:1px solid gray;}
td{border:1px solid gray;}
th{border:1px solid gray;}
</style>
<?php

if($_SESSION["clientes"] > 0){  // APERTURA PRIVILEGIOS

$sql_contratos = 'SELECT * '
        . ' FROM clbCto '
        . ' ORDER BY '
        . ' id_alan '
        . ' DESC '
		. '   ' ;
//        . " LIMIT 5 " ; // THERE'S NO LIMIT
$res_contratos 	 = mysqli_query($dbd2, $sql_contratos);
$contratosNumero = mysqli_affected_rows($dbd2);

echo "<b>".$contratosNumero." CONTRATOS REGISTRADOS</b><br/>";
echo "LISTADO DE CONTRATOS<br/>";

echo "<table>";
echo "<tr>
		<th>ID ALAN</th>
		<th>Numero de Contrato</th>
		<th>Alias CTO</th>

		<th>RFC</th>
		<th>CLIENTE</th>
		<th>Alias CTE</th>

		<th>Status</th>

		<th>Unidades Actuales</th>
		<th>Final de Vigencia</th>
		<th>Monto Máximo</th>

		<th>EJECUTIVOS</th>
	  </tr>";

while($row = mysqli_fetch_assoc($res_contratos))
{
	$id_contrato 	= $row['id_contrato'];
	$id_cliente 	= $row['id_cliente'];
	$id_alan 		= $row['id_alan'];
	$documento 		= $row['documento'];
	$fuente 		= $row['fuente'];
	$estatus 		= $row['estatus'];
	$numero 		= $row['numero'];
	$aliasCto 		= $row['aliasCto'];
	$fechacontrato 	= $row['fechacontrato'];
	$fechainicio 	= $row['fechainicio'];
	$fechafin 		= $row['fechafin'];
	$min 			= $row['min'];
	$max 			= $row['max'];
	@$max = number_format($max, 2);

	echo "<tr>";
	echo "<td>{$id_alan}</td>";
	echo "<td>{$numero}</td>";
	echo "<td>{$aliasCto}</td>";	

	clientexid($id_cliente);
	echo "<td>{$rfc}</td>";
	echo "<td>{$razonSocial}</td>";
	echo "<td>{$alias}</td>";

	echo "<td>{$estatus}</td>";

	unidadesContratoxid($id_contrato);
	echo "<td style='color:blue; font-size: 1.5em; text-align: center;'>
		{$unidadesCto}
		</td>";

	echo "<td>{$fechafin}</td>";
	echo "<td align='right' >{$max}</td>";

	echo "<td>"; // INICIO EJECUTIVOS
	########## ########## 
	contratoEjecutivosH($id_contrato);
	$sql_cto_ejecs_RH; // viene de la funcion ejecutada
	if(mysqli_num_rows($sql_cto_ejecs_RH)==0){echo "NO HAY EJECUTIVOS ASIGNADOS";}
	@$filas_ctoEjecs 	= mysqli_num_rows($sql_cto_ejecs_RH);

	if($filas_ctoEjecs > 0)
	{
		echo "<table class=''>
			<tr>
			<th>idAsgn</th>
			<th>NOMBRE</th>
			<th>PUESTO</th>
			<th>DESDE</th>
			<th>HASTA</th>
			</tr>";
		while($row = mysqli_fetch_assoc($sql_cto_ejecs_RH))
			{
				$id_a_contrato 	= 	$row['id_a_contrato'];
				$id_usuario 	= 	$row['id_usuario']; // ID de ejecutivo asignado
				$fecha_inicioEA	= 	$row['fecha_inicio'];
				$fecha_finalEA 	= 	$row['fecha_final'];

				echo "<tr>";
				echo "<td>{$id_a_contrato}</td>";
				usuarioxid($id_usuario);
				echo "<td>{$nombre}</td>";
				echo "<td>{$puestoUSR}</td>";
				echo "<td>{$fecha_inicioEA}</td>";
				echo "<td>{$fecha_finalEA}</td>";
				echo "</tr>";
				//resetear variables
				$id_usuario 	= '';
				$nombre 		= '';
				$fecha_inicio 	= '';
				$fecha_final 	= '';
				//resetear variables
			}
		echo "</table>"; // Cerrar tabla
	}
	########## ##########	
	echo "</td>"; // TERMINA EJECUTIVOS
	echo "</tr>";
}
echo "</table>";
echo "<br>Jet Van Car Rental, S.A. de C.V. &copy;  ".date('Y-m-d') ;
} // CIERRE PRIVILEGIOS