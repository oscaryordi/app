<?php
include("1header.php");
include'nav_compras.php';

echo "<h2>ORDENES DE COMPRA DE UNIDADES VEHICULARES</h2>";

if($_SESSION["datos"] > 1 || $_SESSION["gerencia"] > 0){  // APERTURA PRIVILEGIOS

$rxpag = 20; //RESULTADOS POR PAGINA

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

$cuenta_inventarios = "SELECT `nOrdenC` FROM facturaunidad  GROUP BY nOrdenC "; //  
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_inventarios);
$cuentaM 			= mysqli_fetch_assoc($sacar_cuenta);
$cuenta 			= mysqli_affected_rows($dbd2);//$cuentaM['cuenta'];
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);

$sql_flotilla = '	SELECT COUNT( id_unidad ) cuentaF,  `nOrdenC` 
					FROM  `facturaunidad` 
					GROUP BY  `nOrdenC` 
					ORDER BY  `nOrdenC` DESC '
        		. " LIMIT $pagina_1, $rxpag" ; 

echo "<h2>$rxpag Resultados por pagina, $paginas_entero PÁGINAS</h2>";

/*
SELECT COUNT( id_unidad ) cuenta,  `nOrdenC` 
FROM  `facturaunidad` 
GROUP BY  `nOrdenC` 
ORDER BY  `nOrdenC` DESC 
LIMIT 0 , 30
*/

include'1paginacion.php';


echo "<h3>RESUMEN FLOTILLA</h3>";
echo "<fieldset><legend>Resumen de flotilla</legend>";
echo "<table class='ResTabla'>\n";
echo "<tr>
		<th>NUMERO DE ORDEN</th>
		<th>UNIDADES VEHICULARES COMPRADAS</th>
	  </tr>";

$res_flotilla = mysqli_query($dbd2, $sql_flotilla);

	while($row = mysqli_fetch_assoc($res_flotilla))
	{
		$nOrdenC 	= $row['nOrdenC'];
		$cuentaF 	= $row['cuentaF']; // PARA QUE FUNCIONE LA QUERY DEL HISTORICO

		echo "<tr>";
		echo "<td>{$nOrdenC}</td>";

		//datosxid($id_unidad);
		echo "<td><a href='comprasOrdenFlotilla.php?nOrdenC=$nOrdenC'>
					{$cuentaF}
				  </a>
			  </td>";
		echo "</tr>";
	}
	echo "</table>";
	//echo "<fieldset>";
} // cierre privilegios

include'1paginacion.php';
include("1footer.php");?>