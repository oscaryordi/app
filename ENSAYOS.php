<?php
include('1header.php');

//$id_usuario = $_SESSION['id_usuario'];


echo "<B>ARRAY MULTIDIMENSIONAL</B> <BR>";
echo "<br>";

if(isset($_POST['checkBoxArray']))
{
	print_r(($_POST['checkBoxArray'])) ;
	echo "<br>";
	echo "<br>";
	var_dump($_POST['checkBoxArray']) ;
	echo "<br>";
	echo "<br>";
	
	foreach ($_POST['checkBoxArray'] as $key ) 
	{
		echo "TIPO DE ANIMAL:".$key[0].", TIPO DE RUIDO:".$key[1].", CANTIDAD:".$key[2].",<BR>";
	}
}
?>
<form action='' method="post" >


<!-- RENGON 1 -->
<input class='checkBoxes' type='text' name='checkBoxArray[0][0]' value='gato' id='$id_unidad' >
<input class='checkBoxes' type='text' name='checkBoxArray[0][1]' value='maulla' id='$id_unidad' >
<select name='checkBoxArray[0][2]'  >CANTIDAD
<option value='1'>1</option>
<option value='2'>2</option>
<select>


<br>
<!-- RENGLON 2 -->
<input class='checkBoxes' type='text' name='checkBoxArray[1][0]' value='perro' id='$id_unidad' >
<input class='checkBoxes' type='text' name='checkBoxArray[1][1]' value='ladra' id='$id_unidad' >
<select name='checkBoxArray[1][2]'  >CANTIDAD
<option value='1'>1</option>
<option value='2'>2</option>
<select>


<br>

<input type='submit'  name='Probar'  value="Probar" >
</form>
<?php


echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";




$sql_prueba = "SELECT * FROM usuarios where nombre like '%yordi%'";

//$pruebaR 	= mysqli_query($zj, $sql_prueba);

$pruebaR 	= mysqli_query($ZanJayna, $sql_prueba);
$pruebaM 	= mysqli_fetch_array($pruebaR);
$nombres 	= $pruebaM['nombres'];
echo $nombres;

echo "<br>";
echo "<br> ESTRUCTURA PRIVILEGIOS";
echo "<br> VER";
echo "<br> CREAR";
echo "<br> EDITAR";
echo "<br> BORRAR";

echo "<br>";
echo "<br> SUPERVISAR";
echo "<br> ";
echo "<br> ";
echo "<br> ";


?>
<!--
<iframe src="https://www.w3schools.com">
  <p>Your browser does not support iframes.</p>
</iframe>
<iframe src="http://187.188.203.80:8080/last/conn.aspx?uuid=864495030143926">
  <p>Your browser does not support iframes.</p>
</iframe>
<embed src="http://187.188.203.80:8080/last/conn.aspx?uuid=864495030143926" style="width:500px; height: 300px;">
<object type="text/html" data="http://187.188.203.80:8080/last/conn.aspx?uuid=864495030143926">
</object>	
-->
<?php



//http://187.188.203.80:8080/last/conn.aspx?uuid=".$gpsImeiActual.""




/*

function finalplaca($placa1){
// INICIA OBTENER FINAL DE LA PLACA
global $largoplaca; 
$largoplaca = strlen($placa1);
global $numeros;
$numeros = array('1','2','3','4','5','6','7','8','9','0');
global $finalPlaca;
$posicion = $largoplaca - 1;
for($i = 0; $i < $largoplaca ; $i++)
	{
		$comparar = $posicion - $i;
		if(in_array($placa1[$comparar], $numeros))
			{
				$finalPlaca = $placa1[$comparar];
				break;
			}
	}
// TERMINA OBTENER FINAL DE LA PLACA	
}
*/
//1520603
//1520603
//$claveVehicular = '1520603' ;

$claveVehicular = '0000603' ;
$empresaId 	= substr($claveVehicular,0,3);
$modeloId 	= substr($claveVehicular,0,5);

echo "<br>CLAVE VEHICULAR<br>";
echo $empresaId."<br>";
echo $modeloId ."<br>";
echo $claveVehicular."<br>";


/*
##### CONTRATO DEL EJECUTIVO MANTENIMIENTOS INICIO
$id_usuario = 3;

contratosDelEjecutivo($id_usuario);

print_r($contratosArray) ;
echo "<br/>";
var_dump($contratosArray) ;

if($contratosArray) // OBTIENE UN ARRAY PARA HACER UN SELECT QUE INCLUYA LOS CONTRATOS DEL EJECUTIVO
{
	$todosMisContratos='';
	$cuantos 	= sizeof($contratosArray);
	$contador 	= 1;
	foreach( $contratosArray as $key => $value){
		$todosMisContratos.=" id_contrato = $value ";
		if($cuantos > $contador){
			$todosMisContratos.=" OR ";
		}
		$contador++;
	}
	echo "<br>";
	echo $todosMisContratos;
}else{
	echo "NO TIENE CONTRATOS ASIGNADOS";
}

// QUERY PARA OBTENER INFORMACION
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE ($todosMisContratos) AND externo = 1 "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC ';
//        . " LIMIT $pagina_1, $rxpag " ;
// QUERY PARA OBTENER INFORMACION

echo "<h2>SERVICIOS SOLICITADOS DIRECTAMENTE EN SISTEMA POR USUARIOS</h2>";
$pagina = '';
include('mttoSolResultSet.php'); // AQUI VIENE LA TABLA DE RESULTADOS
echo "<h2>CONTRATOS DEL EJECUTIVO</h2>";
##### CONTRATO DEL EJECUTIVO MANTENIMIENTOS TERMINA
*/




/*
echo "FUNCION CUENTA DE SOPORTES USUARIO";
//$id_usuarioS 	= 50; // ALDO
//$id_usuarioS 	= 5; // ERIKA
$id_usuarioS 	= 51; // ALEJANDRO SUAREZ
$fechainicio 	= '2017-03-01';
//$fechafinalQ3 	= '2017-03-31';
$fechafinalQ3 	= '2017-04-01';

mttoSoportesUsuario($id_usuarioS, $fechainicio, $fechafinalQ3);

echo "<br>";
echo "<br>";
echo "<br>";

ECHO $facturadosMtto."\t FACTURADO<br>";
ECHO $sinfacturaMtto."\t SIN FACTURA<br>";
ECHO $pagadosMtto."\t PAGADOS<br>";
ECHO $sumaPagado."\t IMPORTE TOTAL PAGADO<br>";
ECHO $promedioPagado."\t PROMEDIO PAGO<br>";
*/

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<hr>";





/*
if($_SESSION['clientes'] > 3)
{
	// OBTENER COSTO TOTAL DE FLOTILLA INVOLUCRADA EN CONTRATO
	$id_contrato = 99;
	unidadesDelContrato($id_contrato);
	//print_r($unidadesArray) ;
	echo "<br/>";
	//var_dump($unidadesArray) ; // TRAE MAS TEXTO
	// OBTENER COSTO TOTAL DE FLOTILLA INVOLUCRADA EN CONTRATO

	if($unidadesArray) 
	// OBTIENE UN ARRAY PARA HACER UN SELECT 
	// QUE INCLUYA LAS UNIDADES DEL CONTRATO
	{
		$todasUnidades='';
		$cuantas 	= sizeof($unidadesArray);
		$contador 	= 1;
		foreach( $unidadesArray as $key => $value){
			$todasUnidades.=" id_unidad = $value ";
			if($cuantas > $contador){
				$todasUnidades.=" OR ";
			}
			$contador++;
		}
		//echo "<br>".$todasUnidades; // PARA VER CONSTRUCCION DEL WHERE
	}else{
		echo "NO TIENE UNIDADES ASIGNADOS";
	}

	$valorFlotilla 	= "SELECT SUM(Importe) suma FROM facturaunidad WHERE ($todasUnidades) ";
	$valorFlotillaR = mysqli_query($dbd2, $valorFlotilla);
	$vFM 			= mysqli_fetch_assoc($valorFlotillaR);
	$valorFlotilla 	= $vFM['suma'];

	echo "<hr>";
	echo "<br>";
	echo number_format($valorFlotilla,2);
	echo "<br>";
	echo "<hr>";
}
*/




/*
echo "<hr>";
echo "IF CUANDO NO EXISTE INFO";
echo "<hr>";

	$sql_km = 'SELECT km, fechareg '
		. ' FROM kmH ' 
		. " WHERE id_unidad = '50000' " // UNIDAD 50 000 NO EXISTE HOY 17 MAYO 2018
		. ' ORDER BY fechareg DESC LIMIT 1 ' ;

	$sql_km_R 	= mysqli_query($dbd2, $sql_km);
	$row_km_R 	= mysqli_fetch_array($sql_km_R);
			
	$kmUltimo 	= $row_km_R['km'];
	$fecharegU 	= $row_km_R['fechareg']; 

if( !is_null($kmUltimo)){
	echo "<br>SI HUBO RESULTADO1";
}
else
{
	echo "<br>NO HUBO RESULTADO2";
	echo $kmUltimo;
}
*/




########## DIFERENCIA DE FECHAS
echo "<hr>";
echo "<hr>";

$date1=date_create("2013-03-15");
$date2=date_create("2013-04-16");
$diff=date_diff($date1,$date2);
echo $diff->format("%R%a days");
echo "<hr>";

$date3=date_create("2018-06-15");
$date4=date_create("2018-06-16");
$diffB=date_diff($date3,$date4);

echo $date3->format('Y-m-d');
echo "<br>";
echo $date4->format('Y-m-d');
echo "<br>";
echo $diffB->format("%R%a days");

echo "<br>"; 

@$cuantosVan = $diffB + 1;
echo $cuantosVan;

echo "<hr>";


########## DIFERENCIA DE FECHAS
echo "<hr>";
echo "EJERCICIO FECHA DESDE BASE";
echo "<br>"; 

$sql_fechaS = "SELECT * FROM solAtn WHERE id_solAtn = 25 ";
$fechaSR 	= mysqli_query($dbd2, $sql_fechaS);
$fechaSRM 	= mysqli_fetch_assoc($fechaSR);

$fechareg 	= $fechaSRM['fechareg'];
$fechaRPg 	= $fechaSRM['fechaRPg'];

echo $fechareg;
echo "<br>"; 

$fechareg = substr($fechareg, 0, 10);
echo "FECHA DE SOLICITUD: ".$fechareg;
echo "<br>"; 
$fechaRPg = substr($fechaRPg, 0, 10);
echo "FECHA DE PROGRAMACION: ".$fechaRPg;

$fechareg=date_create("$fechareg");
$fechaRPg=date_create("$fechaRPg");

$diffZ = date_diff($fechareg, $fechaRPg);

echo "<br>"; 
echo $diffZ->format("%R%a days");
echo "<br>"; 

@$cuantosVanZ = $diffZ + 5;

@$cuantosVanZ = ($diffZ->format("%a")) + 5;

echo $cuantosVanZ;
echo "<br>"; 

/*
$cuantosInteger = days($diffZ);
echo $cuantosInteger + 1;
*/

echo "<br>"; 

echo "<hr>";
echo "<br>"; 

//$date_1 = $fechareg ;
//$date_2 = $fechaRPg ;

function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
	global $cuantosJueron;
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);
    $cuantosJueron = $interval->format($differenceFormat);
}

$fecharegX 	= $fechaSRM['fechareg'];
$fechaRPgX 	= $fechaSRM['fechaRPg'];
$fecharegX = substr($fecharegX, 0, 10);
$fechaRPgX = substr($fechaRPgX, 0, 10);
dateDifference($fecharegX , $fechaRPgX , $differenceFormat = '%a' );
echo  "<br>CJ: ".$cuantosJueron."<br>";
echo  $cuantosJueron + 1;

echo "<br>"; 
echo "<hr>";

########## DIFERENCIA DE FECHAS




########## DIFERENCIA DE FECHAS FORMULA RESUMIDA INICIO
echo "<hr>";
echo "<br> DIFERENCIA FECHAS CON FORMULA"; 
echo "<br> "; 
function diferenciaFechas($id_solAtn){
	global $dbd2;
	global $diferenciaDias;
	
	$sql_fechaS = "SELECT * FROM solAtn WHERE id_solAtn = '$id_solAtn' ";
	$fechaSR 	= mysqli_query($dbd2, $sql_fechaS);
	$fechaSRM 	= mysqli_fetch_assoc($fechaSR);

	$fechareg 	= $fechaSRM['fechareg'];
	$fechaRPg 	= $fechaSRM['fechaRPg'];
	$fechaRPg 	= ($fechaRPg != null)? $fechaRPg : date('Y-m-d') ;

	$fechareg 	= substr($fechareg, 0, 10);
	$fechaRPg 	= substr($fechaRPg, 0, 10);

	$fechareg 	= date_create("$fechareg");
	$fechaRPg 	= date_create("$fechaRPg");

	$diffZ 		= date_diff($fechareg, $fechaRPg);
	
	$diferenciaDias = ($diffZ->format("%a")) + 1;
}

$id_solAtn = 25;

diferenciaFechas($id_solAtn);
echo $diferenciaDias;

echo "<hr>";
########## DIFERENCIA DE FECHAS FORMULA RESUMIDA TERMINA





########## POBLAR DATOS DE CLIENTE DESDE MATRIZ
# 1. REVISAR QUE EXISTA EN MATRIZ
# 2. SI EXISTE UTILIZAR ESA INFORMACION DE MATRIZ
# 3. SI NO EXISTE CONSULTAR LA BASE
# 4. POBLAR LA MATRIZ CON LA INFO
# 5. USUAR DATOS DE MATRIZ
$id_cliente 	= 61; // 61 99
$id_contrato 	= 99;
##### INICIAR ARRAY DE CONTRATOS Y CLIENTES
$contratosArray[] 	= ''; // se inicializa fuera del ciclo
$clientesArray[] 	= ''; // se inicializa fuera del ciclo
##### INICIAR ARRAY DE CONTRATOS Y CLIENTES
if ( @$contratosArray[$id_contrato] == ''){ // dentro del ciclo
// SI NO EXISTE
	// CONSULTAR BASE
	clientexid($id_cliente); // CONSULTAR BASE
	contratoxid($id_contrato); // CONSULTAR BASE
	// POBLAR MATRIZ
	$contratosArray[$id_contrato][0] = $id_alan;
	$contratosArray[$id_contrato][1] = $numero;
	$contratosArray[$id_contrato][2] = $aliasCto;
	$clientesArray[$id_cliente][0]   = $rfc;
	$clientesArray[$id_cliente][1]   = $razonSocial;
	//$clientesArray[$id_cliente][2] = $aliasCto;
}
# UNA VEZ ALIMENTADA LA MATRIZ ARRAY USAR LA INFO DEL ARRAY
echo $contratosArray[$id_contrato][0].", ID CONTRATO<br>";
echo $contratosArray[$id_contrato][1].", NUMERO OFICIAL<br>";
echo $contratosArray[$id_contrato][2].", ALIAS CTO<br>";
echo $clientesArray[$id_cliente][0].", RFC CLIENTE<br>";
echo $clientesArray[$id_cliente][1].", RAZON SOCIAL<br>";
########## POBLAR DATOS DE CLIENTE DESDE MATRIZ

########## PROVEEDORES
$id_prov 	= 236;
$provArray[] 	= '';
if ( @$provArray[$id_prov] == ''){ // dentro del ciclo
	proveedorxid($id_prov); // CONSULTAR BASE
	$provArray[$id_prov][1] = $PrazonSocial;
}
echo $provArray[$id_prov][1].", RAZON SOCIAL proveedor <br>";
########## PROVEEDORES

include('1footer.php');