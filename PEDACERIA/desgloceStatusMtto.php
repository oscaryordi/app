<?php
include('1header.php');

echo "FUNCION RESUMEN STATUS AUTORIZACION Y CANCELADAS";

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

/**/

echo "<br>";
echo "<br>";
echo "<br>";

echo "<br>";
echo "<br>";
echo "<br>";

$id_usuario = 50;



function mttoAPRCxU($id_usuario){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $conectar;
global $mttoP; // O PENDIENTE
global $mttoA; // 1 AUTORIZADO
global $mttoR; // 2 3 4 INCOMPLETO REVISION RECHAZADO
global $mttoC; //  CANCELADOS

$sql_mAPRC 	= "	SELECT `autorizadoS` status, "
			."	count( autorizadoS ) totales, "
			."	sum( cancelado ) cancelados "
			."	FROM `mttoSol` "
			."	WHERE capturo = '$id_usuario' "
			."	GROUP BY autorizadoS";
$sql_mAPRC_R 	= mysql_query($sql_mAPRC);

while ($fila = mysql_fetch_assoc($sql_mAPRC_R) )
	{
		$status 	= $fila['status'];
		$totales 	= $fila['totales'];
		$cancelados = $fila['cancelados'];

		switch($status)
		{
			case "0":
				$mttoP += $totales;
				break;
			case "1":
				$mttoA += $totales;
				break;
			case "2":
				$mttoR += $totales;
				break;
			case "3":
				$mttoR += $totales;
				break;
			case "4":
				$mttoR += $totales;
				break;
			default:
			break;
		}
		$mttoC += $cancelados;
	}
mysql_free_result($sql_mAPRC_R);
}


mttoAPRCxU($id_usuario);

echo "<br>";
echo "<br>";
echo "<br>";

ECHO $mttoP."EN TRAMITE<br>";
ECHO $mttoA."AUTORIZADOS<br>";
ECHO $mttoR."CORREGIR<br>";
ECHO $mttoC."CANCELADOS<br>";

include('1footer.php');