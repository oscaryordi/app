<?php
include("1header.php");

if($_SESSION["seminuevos"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include ("nav_sem.php"); 

$id_usuario = $_SESSION["id_usuario"]; 

#####
// INICIA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO 

//$fechainicio 	= '';
//$fechafinal 	= '';
//$cuantosR 		= '';

//Proyecto Destino-> <input>
?>

<p>
<h3>Consutlar periodo:</h3>
<form action='' method='GET' >
<!-- -->
Fecha Inicio->
<input type='date' name='fechainicio'>
Fecha Final->
<input type='date' name='fechafinal'>


Resultados por pagina->
<select name='cuantosR' >
<option>50</option>
<option>100</option>
<option>300</option>
</select>

<input type='submit' value='consultar'>

</form>
<p/>


<?php 

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

$cuenta_gps;
$cuenta 	= '';
$paginas 	= '';
$paginas_entero = '';

$cuenta_gps = " SELECT id_venta 
				FROM sem 
				WHERE '$fechainicio' <= fechaFact 
				AND  fechaFact <= '$fechafinal'  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuantosFueron 		= mysqli_affected_rows($dbd2);

if($cuantosFueron > 0){
	$cuenta 	= mysqli_num_rows($sacar_cuentagps);
	$paginas 	= $cuenta/$rxpag;
	$paginas_entero = ceil($cuenta/$rxpag);
}
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE VENTA SEMINUEVOS</h2>";
echo "PERIODO DEL <b>$fechainicio</b> AL <b>$fechafinal</b><br>";
echo "".$paginas_entero." PAGINAS,  $cuenta VENTAS<br>";
echo "".$rxpag." Resultados por Pagina<br><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

// DESCARGA
echo "<p> <a href='semRes_GET.php?pagina=$pagina&fechainicio=$fechainicio&fechafinal=$fechafinal&cuantosR=$cuantosR' 
		title='Descargar'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='Descargar'>
		</a>
	</p>\n";
// DESCARGA



// SI CONSULTA GERENTE
	$sql_sem = 'SELECT * '
		. ' FROM sem '
		. " WHERE '$fechainicio' <= fechaFact 
			AND  fechaFact <= '$fechafinal' "
		. ' ORDER BY '
		. ' vendedor ASC, id_venta '
		. ' ASC '
		. " LIMIT $pagina_1, $rxpag " ;

		
echo "<section><fieldset><legend>RESUMEN</legend><table id='ResTabla' >";
echo "<tr>
		<th>ID VTA</th>
		<th>VENDEDOR</th>
		<th>UNIDAD</th>
		<th>DEPOSITO<BR>FECHA - IMPORTE</th>
		<th>FECHA FACTURA</th>
		<th>IMPORTE FACTURA</th>
		<th>PRECIO</th>
		<th>FOLIO FACTURA</th>
		<th>NOMBRE CLIENTE</th>
		<th>OBSERVACIONES</th>
		<th>EDITAR</th>
	  </tr>";

$sem_R = mysqli_query($dbd2, $sql_sem);

if($sem_R){ // INICIA hubo resultados
while($row = mysqli_fetch_assoc($sem_R)){ // INICIA PONER RESULTADOS

	$id_venta 	= $row['id_venta']; // 
	$id_unidad	= $row['id_unidad'];
	$vendedor 	= $row['vendedor'];

	$semDep 	= $row['semDep'];

	$fechaDep 	= $row['fechaDep'];
	$importeD	= $row['importeD'];
	$fechaFact 	= $row['fechaFact'];
	$folioF 	= $row['folioF'];
	$importe 	= $row['importe'];
	$precioT 	= $row['precioT'];
	$clienteN 	= $row['clienteN'];
	$obs 		= $row['obs'];

// DOCUMENTOS ASOCIADOS
	//$dM5 		= $row['dM5'];
	//$dF4 		= $row['dF4'];
	//$dC1 		= $row['dC1'];
	//$pagado 	= $row['pagado'];
	//$facturado 	= $row['facturado'];


// INICIO saber si tiene DEPOSITO
$tieneDep = 0;
if($semDep > 0){	
	$sql_D = "	SELECT * FROM semDep 
				WHERE id_venta = '$id_venta' 
				ORDER BY id_dep ASC ";
	$tD_R 		= mysqli_query($dbd2, $sql_D);
	$tieneDep 	= mysqli_affected_rows($dbd2);
}
// FIN saber si subio COTIZACION


// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_venta}</td>";

	switch($vendedor){
		case '1':
			$iniciales = 'ACB';
			break;
		case '2':
			$iniciales = 'GVF';
			break;
		case '3':
			$iniciales = 'JVO';
			break;
		case '4':
			$iniciales = 'JMVO';
			break;
		case '5':
			$iniciales = 'RMR';
			break;
		case '6':
			$iniciales = 'TLC';
			break;
		case '7':
			$iniciales = 'PLG';
			break;	
		default:
			$iniciales = 'ND';
			break;
	}

	echo "<td>{$iniciales}</td>";
	datosxid($id_unidad);
	echo "<td>{$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";

	// INICIO FECHA DE DEPOSITOS
	if($tieneDep > 0)
	{
	echo "<td><table style='width:100%;'>";
				while($rowtD = mysqli_fetch_assoc($tD_R))
				{ 
					$fechaD 	= $rowtD['fechaD'];
					$fechaD 	= strtotime($fechaD);
					$fechaD 	= date('Y-m-d', $fechaD);
					$importeD 	= $rowtD['importeD'];
					$importeD 	= number_format($importeD, 2);
					echo "<tr><td>{$fechaD}</td>  ";
					echo "<td style='text-align: right;' >$ {$importeD}</td></tr>";
				}
	echo "</table></td>";
	}
	else 
	{
		echo "<td></td>";
	}
	// TERMINA FECHA DE DEPOSITOS


	$fechaFact = strtotime($fechaFact); // CONVIERTE EN SEGUNDOS UNIX
	$fechaFact = date('Y-m-d', $fechaFact); // DA FORMATO QUE SE PRESENTARA
	echo "<td>{$fechaFact}</td>";
	$importe = number_format("$importe", 2 ,".",",");
	echo "<td style='text-align: right;' >$\t {$importe}</td>";

	$precioTipo = 'Piso';
	if($precioT == 1){$precioTipo = 'Flotilla';}
	echo "<td>{$precioTipo}</td>";

	echo "<td>{$folioF}</td>";	

	echo "<td>{$clienteN}</td>";
	echo "<td>{$obs}</td>";

	echo "<td><a href='semVentaEdit.php?id_venta=$id_venta'  
			style='text-decoration:none;' title='Editar Registro' >
			<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
			</a></td>";
	echo "</tr>";
	//RESETEAR VARIABLE
	$precioTipo = 'Piso';

// FIN poner renglon resultados

} // TERMINA PONER RESULTADOS
echo "</table>";
} // TERMINA hubo resultados



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
		echo "<a href='?pagina=$i&fechainicio=$fechainicio&fechafinal=$fechafinal&cuantosR=$cuantosR' 
		style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA
include("1footer.php");?>