<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php");
include_once("funcion.php"); 
//include '1header.php';

$TipoBusqueda = 'FINAL SERIE';

//$uFns = 'Z37423'; // solo hay uno
//$uFns = '126117'; // se repite tres veces

//ASIGNAR Y LIMPIAR FINAL DE SERIE
$uFns  		= limpiarVariable($_POST['uFns']);

$sqlFns 	= "	SELECT id as id_unidad 
				FROM `ubicacion` 
				WHERE `Serie` LIKE '%$uFns' LIMIT 0, 5"; 
$rpFns 		= mysqli_query($dbd2, $sqlFns);
$filasFns 	= mysqli_num_rows($rpFns);

if($filasFns==1)
{
	$arrayFns 	= mysqli_fetch_array($rpFns);
	$id_unidad 	= $arrayFns['id_unidad'];
   	header("Location: u3index.php?id_unidad=".$id_unidad."");
}

elseif($filasFns==0)
{
	include '1header.php';
	echo "<h3>El valor buscado no fue encontrado intenta con los ultimos 6 digitos de la serie </h3>";
	echo "<a href='u1consulta.php'>Consultar otro</a>";
	include ("1footer.php");
}

else
{
	include '1header.php';
	//echo "son mas de 1, son: $filasFns";
	echo "<title>Consulta por $TipoBusqueda</title>";
	echo '<h3>RESULTADO DE LA CONSULTA</h3>';
	echo "<h4>por $TipoBusqueda</h4>";
	echo "Valor buscado: <font size=3em><b>$uFns</b></font>";
	echo "<fieldset><legend>Finales de serie</legend>";
	echo "<a>Cantidad de unidades similares encontradas: <b>$filasFns</b></a>\n";
	echo "<table id='ResTabla'>\n"; // Empezar tabla
	echo "<tr>"; // Crear fila

	echo "<th>Economico</th>";
	echo "<th>Marca</th>";
	echo "<th>Vehiculo</th>";
	echo "<th>Serie</th>";
	echo "<th>Placas</th>";
	echo "<th>Modelo</th>";
	echo "<th>Color</th>";
	echo "<th>id_unidad</th>";
	echo "<th>VER</th>";

	echo "</tr>\n"; // Cerrar fila
	while (@$row = mysqli_fetch_assoc($rpFns))
	{
		$id_unidad 	= $row['id_unidad'];
		$vistaAutorizada = 'si'; // CUANDO FILTRO FLOTILLA ES 0 PUEDE VER TODO EN AUTOMATICO
		if($_SESSION["filtroFlotilla"] > 0)
		{ // no puede ver
			unidadVistaAutorizada($id_unidad, $_SESSION["id_usuario"]);
		}
		if($vistaAutorizada == 'si')
		{
	   	echo "<tr>"; // Crear fila
		datosxid($id_unidad);
		echo "<td>$Economico</td>";
		echo "<td>$Marca</td>";
		echo "<td>$Vehiculo</td>";
		echo "<td>$Serie</td>";
		echo "<td>$Placas</td>";
		echo "<td>$Modelo</td>";
		echo "<td>$Color</td>";
		echo "<td>$id_unidad</td>";
		echo " <td>
			   <FORM action='u3index.php' method='GET' >
			   <INPUT TYPE='hidden' NAME='id_unidad' VALUE='$id_unidad'>
			   <INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Ver &#x25B8;'id='gobutton' >
			   </FORM>
			   </td>";
		echo "</tr>\n"; // Cerrar fila
		}
	} 
	echo "</table>\n"; // Cerrar tabla
	echo "</fieldset>";
	include ("1footer.php");
}
/**/?>