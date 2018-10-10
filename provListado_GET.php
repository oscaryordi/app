<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ListadoProveedores.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php"); 
include_once ("funcion.php");

//echo "<meta charset='utf-8'>";

?>
<style>
table{border:1px solid gray;}
td{border:1px solid gray;}
th{border:1px solid gray;}
</style>
<?php


if($_SESSION["proveedores"] > 1){ // INICIA PRIVILEGIOS

$sql_proveedores = 'SELECT * '
        . ' FROM provAlta pa '
        . ' LEFT JOIN provContacto pc '  
        . ' ON pa.id_prov = pc.id_prov '               
        . ' ORDER BY '
        . ' rfc '
        . ' ASC '
		. ' , `razonSocial` ASC ';
//        . " LIMIT $pagina_1, 15" ; 

		
echo "<table >\n";
echo "<tr>
		<th>RFC</th>
		<th>RAZON SOCIAL</th>
		<th>MUNICIPIO</th>
		<th>ESTADO</th>
		<th>TELEFONO</th>
	  </tr>";

//<th>VER</th>


$res_proveedores = mysqli_query($dbd2, $sql_proveedores);

while($row = mysqli_fetch_assoc($res_proveedores)){
	$id_prov 	= $row['id_prov'];
	$rfc 		= $row['rfc'];
	$razonSocial = $row['razonSocial'];
	$municipio 	= $row['municipio'];
	$estado 	= $row['estado'];
	$telefono 	= $row['telefono'];
	
	echo "<tr>";
	echo "<td>{$rfc}</td>";
	echo "<td>{$razonSocial}</td>";
	echo "<td>{$municipio}</td>";
	echo "<td>{$estado}</td>"; 
	echo "<td>{$telefono}</td>"; 

/*	echo "<td>
		<FORM action='provindex.php' method='POST'>
			<INPUT TYPE='hidden' NAME='rfc' value='$rfc'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ver'>
		</FORM>	
		</td>"; */
	echo "</tr>";
}
echo "</table>";



} // TERMINA PRIVILEGIOS