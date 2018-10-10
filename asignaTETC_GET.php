<?php #############################################
header("Content-Type: application/vnd.ms-excel");header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=EjecutivosSusContratos.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php"); 
include_once ("funcion.php");

/*
RESUMEN QUE MUESTRA TODOS LOS EJECUTIVOS CON TODOS SUS CONTRATOS
*/

echo "<meta charset='utf-8'>";


if($_SESSION["asigEctoSup"] > 0){ // PRIVILEGIO SUPERVISOR

// OBTENER EJECUTIVOS
$sql_E = 'SELECT DISTINCT(ae.id_usuario) id_usuario, u.nombre nombre, u.usuario usuario '
        . ' FROM asignaEjecutivo ae '
        . ' JOIN usuarios u '
        . ' ON ae.id_usuario = u.id_usuario '
        . ' WHERE ae.fecha_final IS NULL '
        . ' AND u.externo = 0 '
        . ' ORDER BY nombre ASC '
        . ' ';
$sql_ER =  mysqli_query($dbd2, $sql_E);
// OBTENER EJECUTIVOS


// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 1000; //RESULTADOS POR PAGINA

if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}
else
{
	$pagina = "1";
}
if($pagina == "" || $pagina == 1)
{ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else
{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

	echo "<section><fieldset><legend>EJECUTIVOS Y SUS CONTRATOS</legend>";
	echo "<table id='ResTabla' >";
	echo "<tr>
	<th>Ejecutivo</th>
	<th>Puesto</th>	
	<th>IDasg</th>
	<th>CLIENTE</th>
	<th>ALIAS</th>
	<th>CONTRATO</th>
	<th>UNIDADES</th>
	<th>FECHA ASIGNACION</th>
	<th></th>
	<th></th>
	</tr>";



while($rowE = mysqli_fetch_assoc($sql_ER))
{ // TERMINA VER RESUMEN EJECUTIVO

	$ejecutivoID 	= $rowE['id_usuario'];

	$id_usuario = $ejecutivoID;
	usuarioxid($id_usuario);
	$nombre = strtoupper($nombre);

	$sql_ctoEjec = 'SELECT * '
	        . ' FROM asignaEjecutivo '
	        . " WHERE id_usuario = '$ejecutivoID' "
	        . " AND fecha_final IS NULL "
	        . ' ORDER BY '
	        . ' id_a_contrato '
	        . ' DESC '
	        . " LIMIT $pagina_1, $rxpag " ;

	$sql_CER = mysqli_query($dbd2, $sql_ctoEjec);
//	$flotillaSup = 0;

	while($row = mysqli_fetch_assoc($sql_CER)){

		$id_a_contrato 	= $row['id_a_contrato']; // 
		$id_cliente 	= $row['id_cliente'];
		$id_contrato	= $row['id_contrato'];
		$fecha_inicio 	= $row['fecha_inicio'];

		// INICIO poner renglon resultados
		echo "<tr>";

		echo "<td>{$nombre}</td>";
		echo "<td>{$puestoUSR}</td>";

		echo "<td>{$id_a_contrato}</td>";

		clientexid($id_cliente);
		echo "<td>$rfc ::: $razonSocial</td>";
		$razonSocial = '';
		echo "<td>$alias</td>";
		$alias = '';

		contratoxid($id_contrato);
		echo "<td>Alan->{$id_alan} ::: Numero->{$numero} ::: Alias->{$aliasCto} :::</td>";

		unidadesContratoxid($id_contrato);
			echo "<td style='font-size:1.5em; color:blue;'>
					{$unidadesCto}
					</td>";

		echo "<td>{$fecha_inicio}</td>";
	    echo "<td></td><td></td>";

		echo "</tr>";
		// FIN poner renglon resultados
		//$flotillaSup += $unidadesCto ;
	}

} // TERMINA VER RESUMEN EJECUTIVO

	echo "</table>";

//	echo "TOTAL FLOTILLA = $flotillaSup ";
//	$flotillaSup = '';
	echo "</fieldset></section><br>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA
?>