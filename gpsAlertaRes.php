<?php
include("1header.php");
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
$edIcon = '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';

if($_SESSION["gps"] > 0){ // VISTA A C4
include("nav_gps.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 50; //RESULTADOS POR PAGINA

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
$cuenta_gps 		= " SELECT id_alertaGps FROM gpsAlerta  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE ALERTAS GPS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta ALERTAS</h3>";
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



/*
$inicio = 1;
$fin = 1000;
$contador = 1;
	echo "<p> 
		<a href='gpsresumen_GET.php?contador=$contador' 
		title='DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio AL $fin'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio A MAXIMO $fin INMEDIATOS ANTERIORES </a>
		</p>";
*/


// SI CONSULTA GERENTE
	$sql_gps = 'SELECT * '
        . ' FROM gpsAlerta '
        . ' ORDER BY '
        . ' id_alertaGps '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

echo "<section><fieldset><legend>RESUMEN DE ALERTAS</legend>";		
echo "<table id='ResTabla' >\n";
echo "<tr>
<th>FOLIO</th>
<th>FECHA ALERTA</th>
<th>ECONOMICO</th>
<th>SERIE</th>
<th>TIPO</th>
<th>PLACAS</th>
<th>MENSAJE</th>
<th>ATENDIDO</th>
<th>FECHA ATENCION</th>
<th>EDITAR</th>
</tr>";

$res_GPS = mysqli_query($dbd2, $sql_gps);

while($row = mysqli_fetch_assoc($res_GPS))
{

//	$id_gps 	= $row['id_gps']; // asignacion corresponde al equipo configurado
//	$id_imei 	= $row['id_imei'];
//	$id_linea 	= $row['id_linea'];
//	$id_sim 	= $row['id_sim'];
	$id_alertaGps = $row['id_alertaGps'];
	$id_unidad	= $row['id_unidad'];
	$fechaReg 	= $row['fechaReg'];
	$mensaje 	= $row['mensaje'];
	$atendido 	= $row['atendido'];	
	$fechaFin 	= $row['fechaFin'];
//	$fechaInicio = $row['fechaInicio'];




	// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$id_alertaGps}</td>";
	echo "<td>{$fechaReg}</td>";
//	echo "<td>{$id_gps}</td>";
//	echo "<td>{$imei}</td>";
//	echo "<td>{$linea}</td>";
//	echo "<td>{$sim}</td>";

	datosxid($id_unidad);
	echo "<td>{$Economico}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Placas}</td>";


	echo "<td>{$mensaje}</td>";
	$atendidoTxt = ($atendido==1)?'SI':'PENDIENTE';
	echo "<td>{$atendidoTxt}</td>";
	echo "<td>{$fechaFin}</td>";
	echo "<td style='text-align:center;'>";
	if($atendido==0)
	{
	echo "<a href='gpsAlertaE.php?
			id_alertaGps=$id_alertaGps
			&atendido=$atendido'  
			style='text-decoration:none; color:blue;'  title='Editar' >$edIcon
		  </a>";
	}	  
	echo "</td>";

//	echo "<td>{$fechaInicio}</td>";
	
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
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";
} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>