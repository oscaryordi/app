<?php
include("1header.php");

if($_SESSION["gps"] > 0){ // VISTA A C4
include("nav_gps.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 20; //RESULTADOS POR PAGINA 
//$rxpag = 10; //RESULTADOS POR PAGINA PARA PRUEBAS

if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}
else
{
	$pagina = "";
}
if($pagina == "" || $pagina == 1)
{ // AQUI SE CHECA SI TIENE DATO O NO
	$pagina_1 = 0;
}
else
{
	$pagina_1 = ($pagina * $rxpag) - $rxpag;
}

/* */
$cuentaTodo = " SELECT COUNT(id) cuenta FROM ubicacion ";
$cTR 		= mysqli_query($dbd2, $cuentaTodo);
$cTRM 		= mysqli_fetch_assoc($cTR);
$cuentaT 	= $cTRM['cuenta'];
echo $cuentaT;

$conGPS 	= " SELECT COUNT(DISTINCT id_unidad) cuenta FROM gpsAsignado ";
$cGR 		= mysqli_query($dbd2, $conGPS);
$cGM 		= mysqli_fetch_assoc($cGR);
$cuentaCG 	= $cGM['cuenta'];

/*
$cuenta_gps;
$cuenta_gps 		= "  SELECT u.id, g.id_imei     
						 FROM 
						 ubicacion u 
						 LEFT JOIN 
						 gpsAsignado g 
						 ON u.id = g.id_unidad 
						 WHERE id_imei IS NULL  ";
						 //ORDER BY 
						 //u.id DESC   
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
//$cuentaM			= mysqli_fetch_assoc($sacar_cuentagps);
//$cuenta 			= $cuentaM['cuenta'];
$cuenta 			= mysqli_affected_rows($dbd2);
*/

$cuenta = $cuentaT -  $cuentaCG ;
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);

// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>UNIDADES VEHICULARES SIN GPS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta UNIDADES SIN GPS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

/*
$contador = 0;
for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 1000 ) 
{
	$contador 	+= 1;
	$fin 		= $contador * 1000;
	$inicio 	= $fin - 999;
	// BOTON DE DESCARGA

	// BOTON DE DESCARGA
}
*/

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

// la query es correcta pero consume muchos recursos provoca error
$sql_gpsNO = "
 SELECT u.id id_unidad, g.id_imei 
 FROM 
 ubicacion u 
 LEFT JOIN 
 gpsAsignado g 
 ON u.id = g.id_unidad 
 WHERE g.id_imei IS NULL 
 ORDER BY 
 u.id DESC  
 LIMIT $pagina_1, $rxpag  ";

/*
	$sql_gps = 'SELECT * '
        . ' FROM gpsAsignado '
        . ' ORDER BY '
        . ' id_gps '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
*/


echo "<section><fieldset><legend>RESUMEN DE EQUIPOS ASIGNADOS</legend>";
echo "<table class='ResTabla'>\n";
echo "<tr>
		<th>ECONOMICO</th>
		<th>SERIE</th>
		<th>TIPO</th>
		<th>PLACAS</th>

		<th>ASG CLIENTE</th>
		<th>ASG CONTRATO</th>
		<th>ASG FECHA</th>
		<th>UB CLIENTE</th>
		<th>UB LUGAR</th>
		<th>UB FECHA</th>
		<th>FOTO</th>
	  </tr>";

/**/
$res_GPS = mysqli_query($dbd2, $sql_gpsNO);


while($row = mysqli_fetch_assoc($res_GPS))
{
	$id_unidad	= $row['id_unidad'];

	// INICIO poner renglon resultados
	echo "<tr>";

	datosxid($id_unidad);
	echo "<td>{$Economico}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Placas}</td>";
	//echo "<td>{$fechaInicio}</td>";


	unidadAsignacion($id_unidad);
/*
//CHECAR SI YA EXISTE EN ARRAY
	$cAexiste = '';
	if( @$contratosArray[$id_contrato] != '' )
	{
		$cAexiste = 'Ya existe JAJA';
	}
//CHECAR SI YA EXISTE EN ARRAY// $cAexiste.
*/
	if ($id_asignacion=='')
	{
		$asinacionTXT = ($id_asignacion=='')?'NO HAY ASIGNACION FORMAL':'';
		echo "<td>$asinacionTXT</td><td></td><td></td>";
	}
	elseif (@$contratosArray[$id_contrato] != '') {
		echo '<td>'.$id_cliente.'::: '.$clientesArray[$id_cliente][0].' <br> '.$clientesArray[$id_cliente][1].'</td>';
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$contratosArray[$id_contrato][0].' ALAN ::: No. OFICIAL '.$contratosArray[$id_contrato][1].'</td>';
		echo '<td>'.$fecha_inicioASG.'</td>';
	}
	else
	{
		clientexid($id_cliente);
		echo '<td>'.$id_cliente.'::: '.$rfc.' <br> '.$razonSocial.'</td>';
		contratoxid($id_contrato);
		echo '<td>  id_contrato '.$id_contrato.' ::: ALAN '.$id_alan.' ALAN ::: No. OFICIAL '.$numero.'</td>';
		echo '<td>'.$fecha_inicioASG.'</td>';

		$contratosArray[$id_contrato][0] = $id_alan;
		$contratosArray[$id_contrato][1] = $numero;
		$contratosArray[$id_contrato][2] = $aliasCto;

		$clientesArray[$id_cliente][0] = $rfc;
		$clientesArray[$id_cliente][1] = $razonSocial;
		//$clientesArray[$id_cliente][2] = $aliasCto;
	}


	ubicacionHistorico($id_unidad);
	if ($clienteA=='')
	{
		$ubicacionTXT = ($clienteA=='')?'NO HAY REPORTE':'';
		echo "<td>$ubicacionTXT</td><td></td><td></td>";
	}
	else
	{
		echo '<td>'.$clienteA.'</td>';
		echo '<td>'.$ubicacionA.'</td>';
		echo '<td>'.$fechaA.'</td>';
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