<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 0){  // APERTURA PRIVILEGIOS

include("nav_cliente.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION
$rxpag = 15; //RESULTADOS POR PAGINA

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

$cuenta_proveedores = "SELECT id_cliente FROM claCliente ";
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_proveedores);
$cuenta 			= mysqli_num_rows($sacar_cuenta);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";

echo "<h3>".$paginas_entero." PAGINAS,  $cuenta CLIENTES REGISTRADOS</h3><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

$sql_proveedores = 'SELECT * '
        . ' FROM claCliente '
        . ' ORDER BY '
        . ' rfc '
        . ' ASC '
		. ' , `razonSocial` ASC '
        . " LIMIT $pagina_1, 15" ; 
		
echo "<div><fieldset><legend>LISTADO DE CLIENTES</legend>
	<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
		<th>RFC</th>
		<th>RAZON SOCIAL</th>
		<th>MUNICIPIO</th>
		<th>ESTADO</th>
		<th>VER</th>
	  </tr>";

$res_proveedores = mysqli_query($dbd2, $sql_proveedores);

while($row = mysqli_fetch_assoc($res_proveedores)){
	$id_cliente 	= $row['id_cliente'];
	$rfc 			= $row['rfc'];
	$razonSocial 	= $row['razonSocial'];
	$municipio 		= $row['municipio'];
	$estado 		= $row['estado'];
	
	echo "<tr>";
	echo "<td>{$rfc}</td>";
	echo "<td>{$razonSocial}</td>";
	echo "<td>{$municipio}</td>";
	echo "<td>{$estado}</td>"; 
	echo "<td>
			<FORM action='clienteindexuno.php' method='POST'>
				<INPUT TYPE='hidden' NAME='rfc' value='$rfc'>
				<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ver'>
			</FORM>	
		  </td>"; 
	echo "</tr>";
}
echo "</table>";


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
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 5px; margin: 0px 1px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></div>";
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>