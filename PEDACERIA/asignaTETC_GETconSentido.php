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
$sql_ER =  mysql_query($sql_E, $conectar);
// OBTENER EJECUTIVOS


// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 100; //RESULTADOS POR PAGINA


if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = "1";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}



while($rowE = mysql_fetch_assoc($sql_ER))
{ // TERMINA VER RESUMEN EJECUTIVO
	
	$ejecutivoID 	= $rowE['id_usuario'];
	$cuenta_gps 		= " SELECT id_a_contrato FROM asignaEjecutivo WHERE id_usuario = '$ejecutivoID' AND fecha_final IS NULL ";

	/*
	if($_SESSION["mttoSol"] == 2){
	}
	if($_SESSION["mttoSol"] > 2){
	$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol";	
	}
	*/

	$sacar_cuentagps 	= mysql_query($cuenta_gps);
	$cuenta 			= mysql_num_rows($sacar_cuentagps);
	$paginas 			= $cuenta/$rxpag;
	$paginas_entero 	= ceil($cuenta/$rxpag);
	// echo $cuenta."<br>";
	// echo $paginas."<br>";

	$id_usuario = $ejecutivoID;
	usuarioxid($id_usuario);
	$nombre = strtoupper($nombre);

//	echo "<p>RESUMEN DE CONTRATOS X EJECUTIVO :</p>";
	echo "<h2> $nombre , $puestoUSR</h2>";
	echo "".$paginas_entero." PAGINAS,  $cuenta CONTRATOS<br>";
	//echo "".$rxpag." Resultados por Pagina";
	// FIN FASE 1 ALGORITMO DE PAGINACION


	echo "<section><fieldset><legend>CONTRATOS</legend>";

	$sql_ctoEjec = 'SELECT * '
	        . ' FROM asignaEjecutivo '
	        . " WHERE id_usuario = '$ejecutivoID' "
	        . " AND fecha_final IS NULL "
	        . ' ORDER BY '
	        . ' id_a_contrato '
	        . ' DESC '
	        . " LIMIT $pagina_1, $rxpag " ;

			
	echo "<table id='ResTabla' >";
	echo "<tr>
	<th>IDasg</th>
	<th>CLIENTE</th>
	<th>ALIAS</th>
	<th>CONTRATO</th>
	<th>UNIDADES</th>
	<th>FECHA ASIGNACION</th>

	<th></th>
	<th></th>
	</tr>";

	$sql_CER = mysql_query($sql_ctoEjec);
	$flotillaSup = 0;

	while($row = mysql_fetch_assoc($sql_CER)){

		$id_a_contrato 	= $row['id_a_contrato']; // 
		$id_cliente 	= $row['id_cliente'];
		$id_contrato	= $row['id_contrato'];
		$fecha_inicio 	= $row['fecha_inicio'];

	// INICIO poner renglon resultados
		echo "<tr>";
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
		$flotillaSup += $unidadesCto ;

	}
	echo "</table>";

	echo "TOTAL FLOTILLA = $flotillaSup ";
	$flotillaSup = '';
	echo "</fieldset></section><br>";

/*
	#####
	// INICIO ALGORITMO PAGINACION // 2da parte
	$pagina_minimo = 1;
	$pagina_maximo = $paginas_entero;

	$paginas_intervalo 	= 5;
	$pagina_vista_inicio = $pagina;

	$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
	if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
		$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
	}

	$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
	if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
		$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
	}
		
	$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
	for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
		{
			if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
				{
					$color = 'red';
				}
			else {$color='';}
			echo "<a href='asignaEcons.php?pagina=$i&ejecutivoID=$ejecutivoID' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
		}
	// FIN ALGORITMO PAGINACION // 2da parte
	#####
*/



} // TERMINA VER RESUMEN EJECUTIVO



} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

?>