<?php 
if($_SESSION["mttos"] > 1){  // APERTURA PRIVILEGIOS

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
	$pagina_1 = ($pagina * 15) - 15;
}

$cuenta_proveedores = "SELECT id_prov FROM provAlta ";
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_proveedores);
$cuenta 			= mysqli_num_rows($sacar_cuenta);
$paginas 			= $cuenta/15;
$paginas_entero 	= ceil($cuenta/15);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";


echo "<h2>LISTADO DE PROVEEDORES</h2>";
echo "<fieldset><legend>ORDENADOS POR ENTIDAD FEDERATIVA A-Z</legend>";


$sql_proveedores = 'SELECT * '
        . ' FROM provAlta '
        . ' ORDER BY '
        . ' estado '
        . ' ASC '
		. ' , `razonSocial` ASC '
        . " LIMIT $pagina_1, 15" ; 

		
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
		<th>RFC</th>
		<th>RAZON SOCIAL</th>
		<th>MUNICIPIO</th>
		<th>ESTADO</th>
		<th>VER</th>
	  </tr>";

$res_proveedores = mysqli_query($dbd2, $sql_proveedores);

while($row = mysqli_fetch_assoc($res_proveedores)){
	$id_prov = $row['id_prov'];
	$rfc = $row['rfc'];
	$razonSocial = $row['razonSocial'];
	$municipio = $row['municipio'];
	$estado = $row['estado'];
	
	echo "<tr>";
	echo "<td>{$rfc}</td>";
	echo "<td>{$razonSocial}</td>";
	echo "<td>{$municipio}</td>";
	echo "<td>{$estado}</td>"; 
	echo "<td>
		<FORM action='provindex.php' method='POST'>
			<INPUT TYPE='hidden' NAME='rfc' value='$rfc'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ver'>
		</FORM>	
		</td>"; 
	echo "</tr>";
}
echo "</table>";

$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if($pagina_vista_inicio < ($pagina_vista_inicio - $paginas_intervalo)){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if($pagina_vista_inicio < ($pagina_vista_inicio + $paginas_intervalo)){
	$$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
}
	
$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
for($i=$min_mostrar; $i <= ($max_mostrar); $i++)
	{ 
		if($pagina == $i)
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?pagina=$i' style='color:$color;' >$i</a> ";
	}


echo "</fieldset>";

} // CIERRE PRIVILEGIOS ?>