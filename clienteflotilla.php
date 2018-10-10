<?php
include("1header.php");
echo "<meta charset='utf-8'>";

// CANDADO PRIVILEGIO 
// INICIO privilegio ejecutivo
$id_contrato 	= mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
$id_usuario 	= $_SESSION['id_usuario'];

$sql_asignado 	= 	 " SELECT * FROM asignaEjecutivo "
					." WHERE id_contrato = '$id_contrato'  "
					." AND id_usuario = '$id_usuario' "
					." AND fecha_final IS NULL limit 1 "; 
$sql_asignado_R 	= mysqli_query($dbd2, $sql_asignado);
$cuentaCorrespondio = mysqli_num_rows($sql_asignado_R);
echo $cuentaCorrespondio;
$autorizado = 0;
if($cuentaCorrespondio == 1){$autorizado = 1;}
// TERMINA privilegio ejecutivo


if($_SESSION["clientes"] > 0 || $autorizado == 1){  // APERTURA PRIVILEGIOS 
include("nav_cliente.php");

$id_contrato = mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
//echo "<h1>$id_contrato</h1>";

contratoxid($id_contrato);
clientexid($id_cliente);
include("clienteEncabezado.php");

echo "<p> 
		<a href='clienteflotilla_GET.php?id_contrato=$id_contrato' 
		title='DESCARGAR FLOTILLA'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR FLOTILLA'>
		DESCARGAR FLOTILLA</a>
	  </p>";

include("clienteflotillacuadro.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 30; //RESULTADOS POR PAGINA

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

$cuenta_inventarios = "SELECT id_unidad FROM asignaUactual WHERE id_contrato = '$id_contrato' " ;
$sacar_cuenta 		= mysqli_query($dbd2, $cuenta_inventarios);
$cuenta 			= mysqli_num_rows($sacar_cuenta);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta UNIDADES DEL CONTRATO, $rxpag RESULTADOS POR PAGINA</h3><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

// INICIA RESULTADOS DE FLOTILLA
$sql_flotilla = " SELECT au.id_unidad id_unidad, "
		." au.id_asignacion id_asignacion, "  
		." u.id, u.Economico Economico, u.marca Marca, "
		." u.Serie Serie, u.Vehiculo Vehiculo, u.Modelo Modelo, "
		." u.Color Color  "

        . ' FROM asignaUactual au '
        . ' JOIN '
        . ' ubicacion u '
        . ' ON '
        . ' au.id_unidad = u.id '
        . " WHERE  id_contrato = '$id_contrato' "          
        . ' ORDER BY '
        . ' u.id '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag" ;

// PINTAR RESULTADOS
echo "<fieldset><legend>Resumen de flotilla</legend>";
echo "<table  class='ResTabla'>\n";
echo "<tr>
		<th>ID en BD</th>
		<th>ECONOMICO</th>
		<th>MARCA</th>
		<th>SERIE</th>
		<th>VEHICULO</th>
		<th>MODELO</th>
		<th>COLOR</th>
		<th>PLACAS</th>
	  </tr>";

$res_flotilla = mysqli_query($dbd2, $sql_flotilla);

while($row = mysqli_fetch_assoc($res_flotilla)){
	$id_asignacion = $row['id_asignacion'];
	$id 		= $row['id_unidad'];
	$id_unidad 	= $row['id_unidad']; // PARA QUE FUNCIONE LA QUERY DEL HISTORICO
	$economico 	= $row['Economico'];
	$marca 		= $row['Marca'];
	$serie 		= $row['Serie'];
	$vehiculo 	= $row['Vehiculo'];
	$modelo 	= $row['Modelo'];
	$color 		= $row['Color'];

	echo "<tr>";
	echo "<td>{$id}</td>";
	echo "<td><a href='u3index.php?id_unidad=$id_unidad&pagina=$pagina' 
				 title='Consultar UNIDAD'>{$economico}</a>
		  </td>";
	echo "<td>{$marca}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$vehiculo}</td>";
	echo "<td>{$modelo}</td>";
	echo "<td>{$color}</td>";

	placaxid($id_unidad);
	echo "<td>{$Placas}</td>";

	// SUPERVISOR LOGISTICA
	if($_SESSION["superLog"] > 0){
		// FECHA ASIGNACION
		$sql_FA 	= "	SELECT fecha_inicio 
						FROM asignaUnidad 
						WHERE id_asignacion = $id_asignacion 
						LIMIT 1";
		$FA_R 		= mysqli_query($dbd2, $sql_FA);
		$arrayFA_R 	= mysqli_fetch_array($FA_R);
		$fechaAsignacion = $arrayFA_R['fecha_inicio'];
		// FECHA ASIGNACION
		echo "<td>{$fechaAsignacion}</td>";
	}
	// SUPERVISOR LOGISTICA

	buscaDocPS($id_unidad);
	$psTXT = ($ArchivoPS != '')? 'PS': '' ;
	echo "<td>";
	echo "<a 	href='$urlPrincipal/exp/$rutaPS/$ArchivoPS' target='_blank'
				title='POLIZA DE SEGURO'	>$psTXT</a>";
	echo "</td>";
	echo "</tr>";
}
echo "</table></fieldset>";
// PINTAR RESULTADOS
// TERMINA RESULTADOS DE FLOTILLA

#####
// INICIO ALGORITMO PAGINACION // 2da parte
echo "<div>";
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
		echo "<a href='?pagina=$i&id_contrato=$id_contrato' style='color:$color;text-decoration: none; padding: 0px 5px; margin: 0px 1px; background-color: #F8F8F8 ;' >$i</a> ";
	}
echo "</div>";
// FIN ALGORITMO PAGINACION // 2da parte
#####

// VOLVER
echo"
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";
//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al contrato</a>";
if($_SESSION["clientes"] > 0  )
{
echo"	<p>
		  <FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CLIENTE'>
		  </FORM>
		</p>";
	//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al cliente</a>";
}
// VOLVER


} // CIERRE PRIVILEGIOS 
include("1footer.php");?>