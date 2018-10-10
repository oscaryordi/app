<?php
include("1header.php");

if($_SESSION["asigEctoSup"] > 0){ // PRIVILEGIO SUPERVISOR
include_once("nav_asigna.php");

//$id_usuario = $_SESSION["id_usuario"];

// INICIA FORMULARIO ELEGIR EJECUTIVO
// CONSULTAR EJECUTIVOS PARA NORMALIZAR CONSULTA
$sql_E = 'SELECT DISTINCT(ae.id_usuario) id_usuario, u.nombre nombre, u.usuario usuario  '
        . ' FROM asignaEjecutivo ae '
        . ' JOIN usuarios u '
        . ' ON ae.id_usuario = u.id_usuario '
        . ' WHERE ae.fecha_final IS NULL '
        . ' AND u.externo = 1 '
        . ' ORDER BY nombre ASC '
        . ' ';
$sql_ER =  mysqli_query($dbd2, $sql_E);

//echo mysqli_affected_rows($dbd2);
//echo $sql_ER;

// CONSULTA EJECUTIVOS

if(isset($_GET['ejecutivoID']))
{
	$ejecutivoID = $_GET['ejecutivoID'];
}
else{
	$ejecutivoID = '';
}

?>
<p>
<p>Consulta de CONTRATOS asignados a EJECUTIVO:</p>
<form action='' action='' method='GET' >
ELIJA EJECUTIVO->
	<select name="ejecutivoID" style='font-size:.9em;'>
		<?php 
			while($row = mysqli_fetch_assoc($sql_ER))
			{
				$id_usuarioE = 	$row['id_usuario'];	
				$nombreE 	=	strtoupper($row['nombre']);
				$usuarioE 	=	$row['usuario'];

				$checked = '';
				if($ejecutivoID == $id_usuarioE ){$checked = 'selected';}
				echo "<option value='$id_usuarioE' style='font-size:.9em;' $checked >";
				echo "{$nombreE} ::: {$usuarioE}";
				echo "</option>";
				$checked = '';
			}
		?>
	</select>
<input type='submit' value='consultar'>
</form>
<p/>
<?php
// TERMINA FORMULARIO ELEGIR EJECUTIVO

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 50; //RESULTADOS POR PAGINA

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


if($ejecutivoID != '' )
{ // TERMINA VER RESUMEN EJECUTIVO
	$cuenta_gps;
	$cuenta_gps 		= " SELECT id_a_contrato FROM asignaEjecutivo WHERE id_usuario = '$ejecutivoID' AND fecha_final IS NULL ";

	/*
	if($_SESSION["mttoSol"] == 2){
	}
	if($_SESSION["mttoSol"] > 2){
	$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol";	
	}
	*/

	$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
	$cuenta 			= mysqli_num_rows($sacar_cuentagps);
	$paginas 			= $cuenta/$rxpag;
	$paginas_entero 	= ceil($cuenta/$rxpag);
	// echo $cuenta."<br>";
	// echo $paginas."<br>";

	$id_usuario = $ejecutivoID;
	usuarioxid($id_usuario);
	$nombre 	= strtoupper($nombre);

//	echo "<p>RESUMEN DE CONTRATOS X EJECUTIVO :</p>";
	echo "<h2> $nombre </h2>";
	echo "<p>".$paginas_entero." PAGINAS,  $cuenta CONTRATOS<br>";
	echo "".$rxpag." Resultados por Pagina</p><br>";
	// FIN FASE 1 ALGORITMO DE PAGINACION

	?>
	<style>
		#ResTabla tr:hover {background-color: #ddd;}
	</style>
	<section><fieldset><legend>CONTRATOS</legend>

	<?php

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

			<th>QUITAR</th>
			<th>VER CLIENTE</th>
		  </tr>";

	$sql_CER = mysqli_query($dbd2, $sql_ctoEjec);
	$flotillaSup = 0;

	while($row = mysqli_fetch_assoc($sql_CER)){

		$id_a_contrato 	= $row['id_a_contrato']; // 
		$id_cliente 	= $row['id_cliente'];
		$id_contrato	= $row['id_contrato'];
		$fecha_inicio 	= $row['fecha_inicio'];

	// INICIO poner renglon resultados
		echo "<tr>";
		echo "<td>{$id_a_contrato}</td>";

		clientexid($id_cliente);
		echo "<td>$razonSocial</td>";
		$razonSocial = '';
		echo "<td>$alias</td>";
		$alias = '';

		contratoxid($id_contrato);
		echo "<td>Alan->{$id_alan} ::: Numero->{$numero} ::: Alias->{$aliasCto} :::</td>";

		unidadesContratoxid($id_contrato);
			echo "<td style='font-size:1.5em; color:blue;'>
					<a href='clienteflotilla.php?id_contrato=$id_contrato' style='text-decoration: none;'>
					{$unidadesCto}
					</a>
					</td>";

		echo "<td>{$fecha_inicio}</td>";


		// BORRAR
	    if($_SESSION["asigcto"] > 1) // INICIO privilegio borrar CONTRATO
	        {
	        echo "<td>
	                <form action='asignaCtoQuitar.php' method='post'>
	                <input type='hidden' value='$id_a_contrato' name='id_a_contrato'>
	                <input type='hidden' value='$ejecutivoID' name='ejecutivoID'>
	                <input type='hidden' value='$pagina' name='pagina'>";
	        ?>
	                <a onClick="javascript: return confirm('Confirma proceder a QUITAR : DESASIGNAR CONTRATO'); " >
	        <?php
	        echo "        
	                <input type='submit' value='Desasignar' name='Quitar' title='Quitar' >
	                </a>
	                </form>
	            </td>";
	        }       // TERMINA privilegio borrar CONTRATO



	    echo "<td>
	        <FORM action='clienteindexuno.php' method='POST' id='entabla'>
	            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
	            <INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Ver Cliente'>
	        </FORM>
	        </td>";


		echo "</tr>";
	// FIN poner renglon resultados
		$flotillaSup += $unidadesCto ;

	}
	echo "</table>";

	echo "TOTAL FLOTILLA = <span style='font-size:2em;'>$flotillaSup</span> ";

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
			echo "<a href='?pagina=$i&ejecutivoID=$ejecutivoID' 
					style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
		}
	// FIN ALGORITMO PAGINACION // 2da parte
	#####
} // TERMINA VER RESUMEN EJECUTIVO

echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>