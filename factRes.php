<?php
include("1header.php");

if($_SESSION["facturacionV"] > 0){ // 
include("nav_fact.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 50; //RESULTADOS POR PAGINA 
//$rxpag = 10; //RESULTADOS POR PAGINA PARA PRUEBAS


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

$cuenta_gps;
$cuenta_gps 		= " SELECT id_docto FROM estimacionDocto  
						WHERE tipo = 1  
						AND extension = 'pdf' 
						AND borrado = 0  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";




echo "<h2>RESUMEN DE FACTURACION</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta FACTURAS REGISTRADAS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION



include('1paginacion.php');


##### INICIAR ARRAY DE CONTRATOS
$contratosArray[] = '';
$clientesArray[] = '';
##### INICIAR ARRAY DE CONTRATOS



/*
$inicio 	= 1;
$fin 		= 500;
$contador 	= 1;
	echo "<p> 
		<a href='gpsresumen_GET.php?contador=$contador' 
		title='DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio AL $fin'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio A MAXIMO $fin INMEDIATOS ANTERIORES </a>
		</p>";
*/



	$sql_fact = 'SELECT * '
        . ' FROM estimacionDocto '
        . " WHERE tipo = 1 AND extension = 'pdf' AND borrado = 0 "       
        . ' ORDER BY '
        . ' nombreO '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
	$res_fact = mysqli_query($dbd2, $sql_fact);


echo "<section><fieldset><legend>RESUMEN DE FACTURAS</legend>";		
echo "<table class='ResTabla'>\n";
echo "<tr>
<th>DOCUMENTO_ID</th>
<th>ESTIMACION_ID</th>
<th>FOLIO FACTURA</th>
<th>VER</th>
<th>IMPORTE</th>
<th>CLIENTE</th>
<th>CONTRATO</th>
</tr>";



while($row = mysqli_fetch_assoc($res_fact))
{

	$id_docto 		= $row['id_docto']; // asignacion corresponde al equipo configurado
	$id_estimacion 	= $row['id_estimacion'];
	$importeDto 	= $row['importeDto'];
	$nombreO 		= $row['nombreO'];

	$archivo 		= $row['archivo'];
	$ruta 			= $row['ruta'];

/*
	// INICIO sacar imei
	$sql_imei = "SELECT imei FROM gpsImei WHERE id_imei = '$id_imei' LIMIT 1 ";
	$res_imei = mysqli_query($dbd2, $sql_imei);
	while($rowimei = mysqli_fetch_assoc($res_imei)){ $imei = $rowimei['imei'];}
	// FIN sacar imei
*/

	// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_docto}</td>";
	echo "<td>{$id_estimacion}</td>";
	echo "<td>{$nombreO}</td>";
	echo "<td><a href='http://sistema.jetvan.com.mx/exp/estima/$ruta/$archivo' target='_blank'>FA</a></td>";
	echo "<td>".number_format($importeDto,2)."</td>";

    estimacionDts($id_estimacion);

/*
//CHECAR SI YA EXISTE EN ARRAY
	$cAexiste = '';
	if( @$contratosArray[$id_contrato] != '' )
	{
		$cAexiste = 'Ya existe JAJA';
	}
//CHECAR SI YA EXISTE EN ARRAY// $cAexiste.
*/

/*

	if ($id_asignacion=='')
	{
		$asinacionTXT = ($id_asignacion=='')?'NO HAY ASIGNACION FORMAL':'';
		echo "<td>$asinacionTXT</td><td></td><td></td>";
	}
*/
	if (@$contratosArray[$id_contrato] != '') {
		echo '<td>'.$id_cliente.'::: '.$clientesArray[$id_cliente][0].' <br> '.$clientesArray[$id_cliente][1].'</td>';
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$contratosArray[$id_contrato][0].' ALAN ::: No. OFICIAL '.$contratosArray[$id_contrato][1].'</td>';
		//echo '<td>'.$fecha_inicioASG.'</td>';
	}
	else
	{
		contratoxid($id_contrato);
		clientexid($id_cliente);
		echo '<td>'.$id_cliente.'::: '.$rfc.' <br> '.$razonSocial.'</td>';
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$id_alan.' ALAN ::: No. OFICIAL '.$numero.'</td>';
		//echo '<td>'.$fecha_inicioASG.'</td>';

		$contratosArray[$id_contrato][0] = $id_alan;
		$contratosArray[$id_contrato][1] = $numero;
		$contratosArray[$id_contrato][2] = $aliasCto;

		$clientesArray[$id_cliente][0] = $rfc;
		$clientesArray[$id_cliente][1] = $razonSocial;
		//$clientesArray[$id_cliente][2] = $aliasCto;
	}
	
	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";


/* // PARA CONTROLAR PRUEBAS
print_r($contratosArray) ;
echo "<br>";
echo "<br>";
var_dump($contratosArray) ;
echo "<br>";
echo "<br>";
*/


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
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";
} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>