<?php
include('1header.php');

echo "DATOS DESDE ARRAY";

$sqlPartidas 	= "SELECT id_partida, descripcion FROM ctoPartidas WHERE id_contrato = 1 ";
$sqlP_R			= mysqli_query($dbd2, $sqlPartidas);

//$P_Array		= '';

echo "<br>";
echo "<br>";



echo "<br>";
echo "<br>";
echo "<br>";

/**/
$partidasArray[] = '';
while ($fila = mysqli_fetch_array($sqlP_R	, MYSQL_ASSOC)) {
    
//	array_push($partidasArray, $fila["id_partida"] => $fila["descripcion"]); 
//	$partidasArray[] = ( $fila["id_partida"] => $fila["descripcion"] );
$partidasArray[$fila["id_partida"]] = $fila["descripcion"];
//	printf("ID: %s  Nombre: %s", $fila["id_partida"], $fila["descripcion"]);
}
mysqli_free_result($sqlP_R);

print_r($partidasArray) ;
echo "<br>";
echo "<br>";
echo "<br>";

//print_r($partidasArray) ;


$valor 		= 1;
//@$mostrar 	= $partidasArray[$valor]; // si no existe marca error
$mostrar 	= $partidasArray[$valor]; // si no existe marca error

echo $mostrar;



echo "<br>";
echo "<br>";
echo "<br>";

$id_contrato = 1;



function partidasDelContrato($id_contrato){
global $conectar;
global $partidasArray;

$sqlPartidas 	= "SELECT id_partida, descripcion FROM ctoPartidas WHERE id_contrato = '$id_contrato' ";
$sqlP_R			= mysqli_query($dbd2, $sqlPartidas);

while ($fila = mysqli_fetch_array($sqlP_R	, MYSQL_ASSOC))
	{
		$partidasArray[$fila["id_partida"]] = $fila["descripcion"];
	}
mysqli_free_result($sqlP_R);
}


partidasDelContrato($id_contrato);

$valor 		= 3;
$mostrar 	= $partidasArray[$valor]; // si no existe marca error
echo $mostrar;


echo "<br>";
echo "<br>";
echo "<br>";



//$id_contrato = 99;
$id_contrato = 1;

function areasAdmDelContrato($id_contrato){ // OBTENER SUBDIV2
global $conectar;
global $areasAdmArray;

$sqlAreas 	= "SELECT id_subDiv2, concepto FROM clbSubDiv2 WHERE id_contrato = '$id_contrato' ";
$sqlA_R		= mysqli_query($dbd2, $sqlAreas);

while ($fila = mysqli_fetch_array($sqlA_R	, MYSQL_ASSOC))
	{
		$areasAdmArray[$fila["id_subDiv2"]] = $fila["concepto"];
	}
mysqli_free_result($sqlA_R);
}

areasAdmDelContrato($id_contrato);

$valorAA 	= 3;

$mostrarAAsn2 = 'ND';
if( in_array( $valorAA, $areasAdmArray)  )
{ $mostrarAAsn2 	= $areasAdmArray[$valorAA];}
echo $mostrarAAsn2;


//$mostrarAA 	= $areasAdmArray[$valorAA]; // si no existe marca error	

/*
if( isset($mostrarAA) ){
echo $mostrarAA;
}
else{
	echo "ND";
}
*/

//echo $mostrarAA;



/*
SELECT `autorizadoS`
STATUS , count( autorizadoS ) totales, sum( cancelado ) cancelados
FROM `mttoSol`
WHERE capturo =50
GROUP BY autorizadoS
*/




include('1footer.php');