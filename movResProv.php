<?php
include("1header.php");

if($_SESSION["movForaneo"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include ("nav_mov.php");

$id_usuario = $_SESSION["id_usuario"]; 

?>

<p>
<h3>INDIQUE PROVEEDOR: </h3>
<form action='' method='GET' >
<!-- -->

<select name = 'id_prov' >
	<option value = '0' >---</option>
	<option value = '1' >FENIX SERVICIOS DE TRASLADOS, S.A. DE C.V.</option>
	<option value = '2' >TRASLADOS PREMIER, S.A. DE C.V.</option>
	<option value = '3' >VITAL TRASLADO AUTOMOTRIZ, S.A. DE C.V.</option>
	<option value = '4' >JET VAN CAR RENTAL, S.A. DE C.V.</option>
</select>



<!--
Fecha Inicio->
<input type='text' id='fechainicio' name='fechainicio' placeholder='dd/mm/aaaa' />
Fecha Final->
<input type='text' id='fechafinal' name='fechafinal' placeholder='dd/mm/aaaa' />
-->

Resultados por pagina->
<select name='cuantosR' >
<option>50</option>
<option>100</option>
<option>300</option>
</select>

<input type='submit' name='consultar' value='consultar'>

</form>
<p/>


<?php 

$id_prov 	= @$_GET['id_prov'];
//$fechainicio 	= @$_GET['fechainicio'];
//$fechafinal 	= @$_GET['fechafinal'];
$cuantosR 		= @$_GET['cuantosR'];

// TERMINA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO
#####


if(isset($_GET['consultar'])){// INICIA PROCESO DE FORMULARIO 





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

$cuenta_gps;

if($_SESSION["movForaneo"] == 0){
$cuenta_gps 		= " SELECT id_movFor FROM mov_traslados WHERE capturo = '$id_usuario' AND id_prov = '$id_prov' ";
}

if($_SESSION["movForaneo"] > 0){
$cuenta_gps 		= " SELECT id_movFor FROM mov_traslados WHERE id_prov = '$id_prov' ";	
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE TRASLADOS REGISTRADOS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta TRASLADOS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4>";
echo "Página $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION


/*
// BOTON DE DESCARGA
echo "<p> 
	<a href='mttoSolRes_GET.php?id_usuario=$id_usuario&pagina=$pagina' 
	title='DESCARGAR RESUMEN MANTENIMIENTO'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR FLOTILLA'>
	</a>
	</p>";
// BOTON DE DESCARGA
*/

$sql_movFor = '';

if($_SESSION["movForaneo"] == 0){
// SI CONSULTA EJECUTIVO
	$sql_movFor = 'SELECT * '
        . ' FROM mov_traslados '
        . "  WHERE capturo = '$id_usuario'  AND id_prov = '$id_prov'  "
        . ' ORDER BY '
        . ' id_movFor '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["movForaneo"] > 0){
// SI CONSULTA SUPERVISOR
	$sql_movFor = 'SELECT * '
        . ' FROM mov_traslados '
        . "  WHERE id_prov = '$id_prov' "
        . ' ORDER BY '
        . ' id_movFor '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}


		
echo "<section><fieldset><legend>RESUMEN DE TRASLADOS</legend>
<table id='ResTabla' >";
echo "<tr>
<th>BD_mov</th>
<th>FECHA</th>
<th>UNIDAD</th>
<th>PROVEEDOR</th>
<th>CLIENTE ORIGEN</th>
<th>CLIENTE DESTINO</th>
<th>FOLIO INVENTARIO</th>
<th>DOMICILIO DESTINO</th>
<th>F</th>
<th>Ver</th>
<th>Editar</th>
<th>Borrar</th>
</tr>";


$movFor_R = mysqli_query($dbd2, $sql_movFor);

while($row = mysqli_fetch_assoc($movFor_R))
{

	$id_movFor 	= $row['id_movFor'];
	$id_cliente = $row['id_cliente'];
	$id_contrato= $row['id_contrato'];
	$id_clienteD = $row['id_clienteD'];
	$id_contratoD= $row['id_contratoD'];
	$id_unidad 	= $row['id_unidad'];
	$folio_inv 	= $row['folio_inv'];
	$facturaT 	= $row['facturaT'];
	$costoT 	= $row['costoT'];

	$aliasEmergente 	= $row['aliasEmergente'];

	$kmO 		= $row['kmO'];
	$fechaO 	= $row['fechaO'];
	$horaO 		= $row['horaO'];
	$domicilioO = $row['domicilioO'];
	$estadoO 	= $row['estadoO'];
	$entregaNO 	= $row['entregaNO'];
	$telO 		= $row['telO'];

	$kmD 		= $row['kmD'];
	$fechaD 	= $row['fechaD'];
	$horaD 		= $row['horaD'];
	$domicilioD	= $row['domicilioD'];
	$estadoD 	= $row['estadoD'];
	$recibeND 	= $row['recibeND'];
	$telD 		= $row['telD'];

	$id_prov 	= $row['id_prov'];
	$conductor 	= $row['conductor'];

	$falso 		= $row['falso'];

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$id_movFor}</td>";
	echo "<td>{$fechaD}</td>";
	datosxid($id_unidad);
	echo "<td>{$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";

	provTxid($id_prov);
	echo "<td>{$provTN}</td>";

	$aE = '';
	if($aliasEmergente != '0'){$aE = 'ae: '.$aliasEmergente;};
	clientexid($id_cliente);
	echo "<td>{$aE} {$alias} ::: {$razonSocial} </td>";

	clientexid($id_clienteD);
	echo "<td>{$aE} {$alias} ::: {$razonSocial} </td>";


	echo "<td>{$folio_inv}</td>";
	echo "<td>{$domicilioD}</td>";
	echo "<td>{$falso}</td>";

	echo "<td>";
	echo " <a href='movVerxId.php?id_movFor=$id_movFor&pagina=$pagina'  
			style='text-decoration:none;'  title='Ver detalle' >
			<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver detalle' >
		</a> ";
	echo "</td>";

	echo "<td>";
	echo " 	<a href='movEdit.php?id_movFor=$id_movFor&pagina=$pagina'  
				style='text-decoration:none;'  title='Editar' >
			<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
			</a> ";
	echo "</td>";

	echo "<td>";
	echo " 	<form action='movBorrar.php' method='post'>
            	<input type='hidden' value='$id_movFor' name='id_movFor'>";
        ?>
            <a onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO'); " >
        <?php
    echo "  	<input type='submit' value='Borrar' name='borrar' title='Borrar' > </a>
        	</form> ";
	echo "</td>";
	echo "</tr>";
// FIN poner renglon resultados
}
echo "</table></fieldset></section>";



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
		echo "<a href='movResProv.php?pagina=$i&consultar=consultar&id_prov=$id_prov' 
		style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####
	
	}// TERMINA PROCESO DE FORMULARIO 


} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>