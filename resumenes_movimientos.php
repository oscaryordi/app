<?php
include("1header.php");
include("nav_logistica.php");


if($_SESSION["gerencia"] > 0)
{  // APERTURA PRIVILEGIOS 
	include ("nav_gerencia.php"); 
} // CIERRE PRIVILEGIOS 

#####
// INICIA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO 
//$proyecto 		= '';
//$fechainicio 	= '';
//$fechafinal 	= '';
//$cuantosR 		= '';

//Proyecto Destino-> <input>
?>
<p>
<h3>Consulta de movimientos relativos a:</h3>
<form action='' action='' method='GET' >
Proyecto Origen/Destino->
<input type='text' name='proyecto'>

<!--
Fecha Inicio->
<input type='date' name='fechainicio'>
Fecha Final->
<input type='date' name='fechafinal'>
-->

Resultados por pagina->
<select name='cuantosR' >
<option>50</option>
<option>100</option>
<option>300</option>
<option>1000</option>
</select>

<input type='submit' value='consultar'>

</form>
<p/>

<?php 

$proyecto 		= @$_GET['proyecto'];
$fechainicio 	= @$_GET['fechainicio'];
$fechafinal 	= @$_GET['fechafinal'];
$cuantosR 		= @$_GET['cuantosR'];

// TERMINA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO
#####

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = $cuantosR; //RESULTADOS POR PAGINA

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

$cuenta_inventarios = " SELECT id_formato 
						FROM formato_inventario  
						WHERE  `proyecto_origen` LIKE '%$proyecto%' 
						OR `proyecto_destino` LIKE '%$proyecto%' 
/*		AND  '$fechainicio' < `fechaentrega` < '$fechafinal' 
		AND  '$fechainicio' < `fecharecepcion` < '$fechafinal'  */
		";
if(isset($proyecto) and $proyecto !=''){
$sacar_cuenta 	= mysqli_query($dbd2, $cuenta_inventarios);
}
@$cuenta 		= mysqli_num_rows($sacar_cuenta);
@$paginas 		= $cuenta/$rxpag;
@$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";
if($pagina == ""){$pagina = 1;}
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta RESULTADOS SEGUN CRITERIOS </h3>";
echo "<h3>PAGINA ACTUAL $pagina, RESULTADOS POR PAGINA $cuantosR </h3>";
echo "<p> <a href='RES_MOV_GET.php?pagina=$pagina&proyecto=$proyecto&cuantosR=$cuantosR' title='Descargar'><img src='img/Download1.gif' style='width:16px;height:16px;' alt='Descargar'></a></p>\n";
// FIN FASE 1 ALGORITMO DE PAGINACION

$sql_entradas = 'SELECT '
        . ' `id_formato`, '
        . ' `fechaentrega`, '
        . ' `fecharecepcion`, '
        . ' `numero_inventario`, '
        . ' `economico`, '
        . ' `placas`, '
        . ' `serie`, '
        . ' `tipo`, ' 
        . ' `razonsalida`, '
        . ' `proyecto_origen`, '
        . ' `proyecto_destino` '
        . ' FROM `formato_inventario` ';
$sql_entradas .= " WHERE 
		`proyecto_origen` LIKE '%$proyecto%' 
		OR `proyecto_destino` LIKE '%$proyecto%' 
		";
		
//		AND  `fechaentrega` > '$fechainicio' 
//		AND  `fechaentrega` < '$fechafinal' 
//		AND  `fecharecepcion` > '$fechainicio' 
//		AND  `fecharecepcion` < '$fechafinal' 
		
 $sql_entradas .= ' ORDER BY '
        . ' `id_formato` '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag"; 

//echo $sql_entradas;


echo "<fieldset><legend>Resumen de movimientos</legend>";
echo "<table >\n";
echo "<tr>
		<th>FECHA DE ENTRADA</th>
		<th>FECHA DE SALIDA</th>
		<th>INVENTARIO</th>
		<th>ECONOMICO</th>
		<th>PLACAS</th>
		<th>SERIE</th>
		<th>TIPO</th>

		<th>MOTIVO</th>
		<th>ORIGEN</th>
		<th>DESTINO</th>
		<th>VER DETALLE</th>
	  </tr>";


$res_entradas = mysqli_query($dbd2, $sql_entradas);

while(@$row = mysqli_fetch_assoc($res_entradas)){
	$id_inventario 	= $row['id_formato'];	
	$fechaentrega 	= $row['fechaentrega'];
	$fecharecepcion = $row['fecharecepcion'];	
	$inventario 	= $row['numero_inventario'];
	$economico 		= $row['economico'];
	$placas 		= $row['placas'];
	$serie 			= $row['serie'];
	$tipo 			= $row['tipo'];
	$razonsalida 	= $row['razonsalida'];
	$proyecto_origen = $row['proyecto_origen'];
	$proyecto_destino = $row['proyecto_destino'];
	//$pagado = $row['PAGADO'];
	
	echo "<tr>";
	echo "<td>{$fecharecepcion}</td>";	
	echo "<td>{$fechaentrega}</td>";
	echo "<td>{$inventario}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$placas}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$tipo}</td>";
	echo "<td>{$razonsalida}</td>";
	echo "<td>{$proyecto_origen}</td>";
	echo "<td>{$proyecto_destino}</td>";
	
	echo "<td><a href='formato_vista_id.php?id_inventario=".$id_inventario."'><button type='button' class='btn btn-success  btn-sm'>
	<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span> ver formato </button></a></td>";
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
		echo "<a href='?pagina=$i&proyecto=$proyecto&cuantosR=$cuantosR'
		style='color:$color;text-decoration: none; padding: 0px 5px; margin: 0px 1px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset>";

include ("1footer.php"); ?>