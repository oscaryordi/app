<?php 
include("1header.php");

if($_SESSION["asigcto"] > 1){ // INICIO PRIVILEGIO VISTA A ASIGNACION

include ("nav_asigna.php");


// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 30; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = "";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta_ctoa;
$cuenta_ctoa 		= " SELECT id_a_contrato FROM asignaEjecutivo  ";
$sacar_cuentactoa 	= mysqli_query($dbd2, $cuenta_ctoa);
$cuenta 			= mysqli_num_rows($sacar_cuentactoa);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta CONTRATOS ASIGNADOS</h3><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION




// BOTON DE DESCARGA
echo "<p> 
	<a href='asignaTETC_GET.php' 
	title='DESCARGAR LISTADO DE CONTRATOS DE CADA EJECUTIVO'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR LISTADO'>
	DESCARGAR LISTADO DE EJECUTIVOS Y SUS CONTRATOS ASIGNADOS
	</a>
	</p>";
// BOTON DE DESCARGA






echo "<section><fieldset><legend>RESUMEN DE CONTRATOS ASIGNADOS</legend>";

// SI CONSULTA GERENTE
	$sql_ctoa = 'SELECT * '
        . ' FROM asignaEjecutivo '
        . ' ORDER BY '
        . ' id_usuario '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

		
echo "<table >\n";
echo "<tr>
		<th>CONTRATO</th>
		<th>CLIENTE</th>
		<th>EJECUTIVO</th>
		<th>EJECUTIVO DESDE</th>
		<th>HASTA</th>
		<th>UNIDADES ACTUALES</th>
	  </tr>";

$res_ctoa = mysqli_query($dbd2, $sql_ctoa);

while($row = mysqli_fetch_assoc($res_ctoa)){

	$id_a_contrato 	= $row['id_a_contrato']; // asignacion ejecutivo/contrato
	$id_usuario 	= $row['id_usuario'];
	$id_cliente 	= $row['id_cliente'];
	$id_contrato 	= $row['id_contrato'];
	$fecha_inicio	= $row['fecha_inicio']; // de la asignacion ejecutivo/contrato
	$fecha_final 	= $row['fecha_final']; // de la asignacion ejecutivo/contrato


// INICIO poner renglon resultados
	echo "<tr>";

	contratoxid($id_contrato);
	echo "<td>{$id_alan} ::: {$numero} ::: {$aliasCto}</td>";

	clientexid($id_cliente);
	echo "<td>{$rfc} ::: {$razonSocial}</td>";

	usuarioxid($id_usuario);
	echo "<td>{$nombre}</td>";
	echo "<td>{$fecha_inicio}</td>";
	echo "<td>{$fecha_final}</td>";

	unidadesContratoxid($id_contrato);
	echo "<td>{$unidadesCto}</td>";
	
	echo "</tr>";
// FIN poner renglon resultados
}
echo "</table>";



#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
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
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 6px; margin: 0px 3px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####


echo "</fieldset></section>";

} // FIN PRIVILEGIO VISTA A ASIGNACION

include("1footer.php");?>