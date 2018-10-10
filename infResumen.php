<?php
include("1header.php");
echo "<script defer src='https://use.fontawesome.com/releases/v5.0.9/js/all.js' 
	integrity='sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl' 
	crossorigin='anonymous'></script>";

$borrarTxtIcon = "<i class='fa fa-trash-o'  
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='ELIMINAR' ></i>";
$verPdf 	= "<i class='fa fa-file-pdf-o'  
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='PDF' ></i>";
$verDto 	= "<i class='fas fa-file-alt'  
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='DETALLE' ></i>";
$iconoS		= "<i class='fa fa-upload' 
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='SUBIR' ></i>";
$iconoErase	= "<i class='fa fa-times-circle' 
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='BORRAR' ></i>";
$iconEdit	= "<i class='fa fa-pencil' 
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='EDITAR' ></i>";


// <i class="fas fa-file-alt"></i>

if($_SESSION["infraccionH"] > 0){ // INICIO PRIVILEGIO VISTA INFRACCIONES
include ("nav_infraccion.php");

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
$cuenta_gps 		= " SELECT COUNT(id_inf) cuenta FROM infraccion  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
//$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$cuentaM 			= mysqli_fetch_assoc($sacar_cuentagps);
$cuenta 			= $cuentaM['cuenta'];
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE INFRACCIONES</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta INFRACCIONES REGISTRADAS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
echo "<p>Los datos son al momento de la captura, el importe actual debe consultarse en la página web del estado que impone la sanción.</p>";
// FIN FASE 1 ALGORITMO DE PAGINACION

/* DESCARGAR
$contador = 0;
for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 1000 ) 
{
	$contador 	+= 1;
	$fin 		= $contador * 1000;
	$inicio 	= $fin - 999;
	// BOTON DE DESCARGA
	echo "<p> 
		<a href='gpsresumen_GET.php?contador=$contador' 
		title='DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio AL $fin'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN GPS ASIGNADO DEL $inicio A MAXIMO $fin ANTERIORES </a>
		</p>";
	// BOTON DE DESCARGA
}
*/
	echo "<p> 
		<a href='#' 
		title='DESCARGAR RESUMEN'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN</a>
		</p>"; // href='infResumen_GET.php?contador=$contador'



// SI CONSULTA GERENTE
	$sql_gps = 'SELECT * '
        . ' FROM infraccion '
        . ' ORDER BY '
        . ' id_inf '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;

echo "<section><fieldset><legend>RESUMEN DE INFRACCIONES</legend>";		
echo "<table class='ResTabla'  id='ResTabla'  >\n";
echo "<tr>

<th>ECONOMICO</th>
<th>SERIE</th>
<th>TIPO</th>
<th>PLACAS</th>

<th>FECHA</th>
<th>FOLIO</th>
<th>DESCRIPCION</th>
<th>IMPORTE</th>
<th>ARCHIVO</th>

</tr>";

$res_GPS = mysqli_query($dbd2, $sql_gps);

while($row = mysqli_fetch_assoc($res_GPS))
{
	$id_inf 	= $row['id_inf'];
	$fechaInf 	= $row['fechaInf']; // asignacion corresponde al equipo configurado
	$folioInf 	= $row['folioInf'];
	$descripcion= $row['descripcion'];
	$importe 	= $row['importe'];
	$id_unidad	= $row['id_unidad'];


	// INICIO poner renglon resultados
	echo "<tr>";

	datosxid($id_unidad);
	echo "<td><a href='u3index.php?id_unidad=$id_unidad&pagina=$pagina' title='Consultar UNIDAD'>
	{$Economico}</a></td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Placas}</td>";

	echo "<td>{$fechaInf}</td>";
	echo "<td>{$folioInf}</td>";
	echo "<td>{$descripcion}</td>";
	echo "<td>{$importe}</td>";

	infDocto($id_inf);
	echo "<td>";
	if($nohubo == 0)
	{
	 	echo "<a href='http://sistema.jetvan.com.mx/exp/inf/$ruta/$Archivo' target='_blank' title='Ver Escaneo'>$verDto</a> -- ";
	 	
	 	if($_SESSION["infraccionH"] > 1){
		echo "<a href='infDoctoBorrar.php?id_inf=$id_inf&id_docto=$id_docto&pagina=$pagina' title='Borrar Escaneo'>$iconoErase</a>";
		}

	}
	else{
		if($_SESSION["infraccionH"] > 1){
		echo "<a  href='infDoctoAlta.php?id_inf=$id_inf'   ><i class='fas fa-upload'   style='font-size:16px; color:gray;font-weight: ;'   alt='SUBIR ARCHIVO' ></i></a>";
		}
	}
	echo "</td>";

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
} // FIN PRIVILEGIO INRACCIONES
include("1footer.php");?>