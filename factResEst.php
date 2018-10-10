<?php
include("1header.php");

echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
$borrarTxtIcon = "<i class='fa fa-trash-o'  style='font-size:16px; color:gray;font-weight: ;'   alt='ELIMINAR' ></i>";

if($_SESSION["facturacionV"] > 0){ // 
include("nav_fact.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 50; //RESULTADOS POR PAGINA 
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

$cuenta_gps;
$cuenta_gps 		= " SELECT COUNT(id_estimacion) cuenta FROM estimacion  
						WHERE 
						borrado = 0  ";
$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$row 				= mysqli_fetch_array($sacar_cuentagps);	
$cuenta 			= $row['cuenta'];
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE ESTIMACIONES</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta ESTIMACIONES REGISTRADAS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION


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


$sql_estRes 	= "	SELECT * FROM estimacion 
					WHERE borrado = 0 
					ORDER BY id_estimacion DESC "
				. " LIMIT $pagina_1, $rxpag " ;
$sql_estRes_R 	= mysqli_query($dbd2, $sql_estRes);


/*
	$sql_fact = 'SELECT * '
        . ' FROM estimacionDocto '
        . " WHERE tipo = 1 AND extension = 'pdf' AND borrado = 0 "       
        . ' ORDER BY '
        . ' nombreO '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
	$res_fact = mysqli_query($dbd2, $sql_fact);
*/

	echo "<fieldset><legend>RESUMEN DE ESTIMACIONES</legend>"; 

/*
	echo "<p> 
		<a href='estimacionResumen_GET.php?
					id_contrato=$id_contrato' 
		title='DESCARGAR RESUMEN'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
		DESCARGAR RESUMEN</a>
		</p>";
*/

	echo "<table id='ResTabla' >
	<tr>
	<th>FOLIO EST</th>
	<th>FECHA INICIO</th>
	<th>FECHA FINAL</th>
	<th>IMPORTE</th>

	<th>PENALIZACION</th>

	<th>IMPORTE A PAGAR</th>

	<th>OBSERVACIONES ESTIMACION</th>

	<th>EDITAR</th>

	<th>FACTURA</th>
	<th>ESTIMACION</th>
	<th>PENALIZACION</th>
	<th>OTRO</th>
	<th>SUBIR + </th>
	<th>BORRAR TODO</th>
	<th>CAPTURO</th>
	<th>CLIENTE</th>
	<th>CONTRATO</th>

	</tr>";



	while($row = mysqli_fetch_assoc($sql_estRes_R))
	{

		$id_estimacion 	= $row['id_estimacion'];
		$id_cliente 	= $row['id_cliente'];
		$id_contrato 	= $row['id_contrato'];
		$mesE 			= $row['mesE'];
		$anioE 			= $row['anioE'];

		$fechaIn 		= $row['fechaIn'];
		$fechaFn 		= $row['fechaFn'];

		$montoEiI 		= $row['montoEiI'];
		$d1 			= $row['d1Factura'];
		$d2 			= $row['d2Estimacion'];
		$d3 			= $row['d3OtroSoporte'];
		$d4 			= $row['d4Penaliza'];
		$d5 			= $row['d5CompPago'];
		$obs 			= $row['obs'];
		$fechareg 		= $row['fechareg'];
		$capturo 		= $row['capturo'];
		$borrado 		= $row['borrado'];

		echo "<tr>";
		echo "<td><a 	href='estimacionEditar.php?
					id_contrato=$id_contrato
					&id_cliente=$id_cliente
					&id_estimacion=$id_estimacion
					&borrado=$borrado'  
					style='text-decoration:none; color:blue;'  title='Editar' >
			{$id_estimacion}</a></td>";
		
		//mesTxtEsp($mesE);

		echo "<td>{$fechaIn}</td>";
		echo "<td>{$fechaFn}</td>";

		echo "<td style='text-align:right;'>$".number_format($montoEiI, 2)."</td>";

		montoPenaxid_estima($id_estimacion);
		echo "<td>$".number_format($montoP, 2)."</td>";
		$totalPagar = $montoEiI - $montoP;
		echo "<td>$".number_format($totalPagar, 2)."</td>";

		$montoEjercido += $totalPagar;

		echo "<td>{$obs}</td>";

		echo "<td style='text-align:center;'>
				<a 	href='estimacionEditar.php?
					id_contrato=$id_contrato
					&id_cliente=$id_cliente
					&id_estimacion=$id_estimacion
					&borrado=$borrado'  
					style='text-decoration:none;'  title='Editar' >
					<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
				</a>
			</td>";


	// ICONO GENERICO SUBIR ARCHIVO INICIA
	$irASubirA = "<td style='text-align:center;'><a href='estimacionAltaDocto.php?
						id_contrato=$id_contrato&
						id_estimacion=$id_estimacion&
						tipo=";

	$irASubirB = "' style='text-decoration:none;'  
					title='Subir FACTURA' >
					<img src='img/Upload.gif' 
					style='width:16px;height:16px;'  
					alt='Subir FACTURA' >
					</a></td>";
	// ICONO GENERICO SUBIR ARCHIVO TERMINA	


	// INICIO ANALIZA SI ESTA FACTURADO
	if($d1  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d1; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=1&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver FACTURA' >
					<img src='img/th.jpg' style='width:16px;height:16px;'  alt='Ver FACTURA' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 1;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA ANALIZA SI ESTA FACTURADO


	// INICIO ESTIMACION // echo "<td>{$d2}</td>";
	if($d2  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d2; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=2&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver ESTIMACION' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver ESTIMACION' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 2;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA ESTIMACION


	// INICIO PENALIZACION // echo "<td>{$d2}</td>";
	if($d4  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d4; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=4&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver PENALIZACION' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver PENALIZACION' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 2;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA PENALIZACION


	// INICIO OTRO // echo "<td>{$d3}</td>";
	if($d3  > 0)
		{
			echo "<td style='text-align:center;'>";
			for($x = 1; $x <= $d3; $x++){ 
			echo "<a href='estimacionVerDocto.php?id_estimacion=$id_estimacion&tipo=3&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver OTRO' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver OTRO' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			$tipo = 3;
			echo $irASubirA.$tipo.$irASubirB;
		} //&pagina=@$pagina
	// TERMINA OTRO

//	$id_estimacion = '';


			// FORMULARIO SUBIR OTRO PERMANENTE
			echo $irASubirA.'0'.$irASubirB;
			// FORMULARIO SUBIR OTRO PERMANENTE


##### INICIA BORRAR TODA LA ESTIMACION
?>
<script>
var folioEstimacion<?php echo $id_estimacion; ?> = <?php echo $id_estimacion; ?> ;
var mesEstimacion<?php echo $id_estimacion; ?> 	= '<?php echo $mesETxt; ?>' ;
var anioEstimacion<?php echo $id_estimacion; ?> 	= '<?php echo $anioE; ?>' ;
</script>
<?php
		echo "<td style='text-align:center;'>";
		echo "<a 	href='estimacionBorrar.php?
					id_contrato=$id_contrato
					&id_cliente=$id_cliente
					&id_estimacion=$id_estimacion
					&borrado=$borrado'   
					style='text-decoration:none;'  title='Borrar' ";
?>
					onClick="javascript: return confirm('Confirma proceder a BORRAR ESTIMACION, FOLIO:' 
					+ folioEstimacion<?php echo $id_estimacion; ?> 
					+ ', MES:' 
					+ mesEstimacion<?php echo $id_estimacion; ?> 
					+ ', AÑO: ' 
					+ anioEstimacion<?php echo $id_estimacion; ?>);"
<?php	echo "		>
					$borrarTxtIcon 
				</a>
			</td>";
##### TERMINA BORRAR TODA LA ESTIMACION


		$id_usuario = $capturo;
		usuarioxid($id_usuario); 
		echo "<td>{$nombre}</td>";
		$id_usuario = 0;


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