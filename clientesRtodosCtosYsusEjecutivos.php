<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 0){  // APERTURA PRIVILEGIOS


// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 5; //RESULTADOS POR PAGINA

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


$cuenta_contratos = "SELECT id_contrato FROM clbCto ";
$sacar_cuenta 	= mysqli_query($dbd2, $cuenta_contratos);
$cuenta 		= mysqli_num_rows($sacar_cuenta);
$paginas 		= $cuenta/$rxpag;
$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";
// FIN FASE 1 ALGORITMO DE PAGINACION



echo "<h3>".$paginas_entero." PAGINAS,  $cuenta CONTRATOS REGISTRADOS</h3>";

echo "<p>LISTADO DE CONTRATOS</p>";

$sql_contratos = 'SELECT * '
        . ' FROM clbCto '
        . ' ORDER BY '
        . ' id_alan '
        . ' DESC '
		. '   '
        . " LIMIT $pagina_1, $rxpag" ;

		
echo "<table class='ResTabla'>\n";
echo "<tr>
		<th>ID ALAN</th>
		<th>Numero de Contrato</th>
		<th>Alias CTO</th>

		<th>RFC</th>
		<th>CLIENTE</th>
		<th>Alias CTE</th>

		<th>Unidades Actuales</th>
		<th>Final de Vigencia</th>
		<th>Monto Máximo</th>

		<th>EJECUTIVOS</th>
	  </tr>";
/*
<th>Alias Cto</th>
<th>Documento</th>
<th>Fuente</th>
<th>Estatus</th>
<th>Fecha formalización</th>
<th>Inicio</th>
<th>Monto Mínimo</th>
*/
$res_contratos = mysqli_query($dbd2, $sql_contratos);

while($row = mysqli_fetch_assoc($res_contratos)){
	
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

	unidadesContratoxid($id_contrato);
	echo "<td style='color:blue; font-size: 1.5em; text-align: center;'>
		<a href='clienteflotilla.php?id_contrato=$id_contrato' style='text-decoration: none;'>
		{$unidadesCto}
		</a>
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
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 5px; margin: 0px 1px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####
echo "<br>";

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>