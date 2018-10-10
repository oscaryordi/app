<?php
include("1header.php");
?>
<script language="JavaScript">
var TRange=null;

function findString (str) {
 if (parseInt(navigator.appVersion)<4) return;
 var strFound;
 if (window.find) {

  // CODE FOR BROWSERS THAT SUPPORT window.find

  strFound=self.find(str);
  if (!strFound) {
   strFound=self.find(str,0,1);
   while (self.find(str,0,1)) continue;
   if(!strFound)alert("No se encontro"+str);//yo
  }
 }
 else if (navigator.appName.indexOf("Microsoft")!=-1) {

  // EXPLORER-SPECIFIC CODE // todo este pedazo no sirve, no se por que
	var TRange = document.body.createTextRange(); //yo
	var sBookMark = TRange.getBookmark(); //yo
	var strFound=self.find(str,0,1); //yo
	
  if (TRange!=null) {
   TRange.collapse(false);
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
  if (TRange==null || strFound==0) {
   TRange=self.document.body.createTextRange();
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
 }
 else if (navigator.appName=="Opera") {
  alert ("Opera browsers not supported, sorry...")
  return;
 }
 if (!strFound)
 var TRange = document.body.createTextRange();
 strFound=TRange.findText(str);
 if (strFound) TRange.select();
 else alert("No se encontro"+str);
 return;
}
</script>

<table border=0 cellpadding=1 cellspacing=1>
	<tr>
		<td>
			<iframe id="srchform2"
			 src="javascript:'<html><body style=margin:0px; >
			 <form action=\'javascript:void();\' onSubmit=if(this.t1.value!=\'\')parent.findString(this.t1.value);return(false); >
			 Busqueda en misma hoja<br/>
			 <table>
			 	<tr>
			 		<td>
			 			<input type=text id=t1 name=t1 placeholder=EscribeAqui size=20>
			 		</td>
			 		<td>
						<input type=submit name=b1 value=Buscar>
					</td>
				</tr>
			</table>
			</form>
			'" 
			 width=95%  border=0 height=46pt frameborder=0 scrolling=no>
			</iframe> <!-- height=23pt -->
		</td>
	</tr>
</table>
<?php


$id_usuario = $_SESSION["id_usuario"];

tienecontrato($_SESSION["id_usuario"]);
if($miflotilla > 0){;}

// INICIO VISTA A USUARIOS CON FILTRO FLOTILLA 3
if($_SESSION["filtroFlotilla"] == 3)
	{
		usuarioAsigns($id_usuario);
		foreach ($asigArray as $key => $id_a_contrato)
		{
			usuarioAsig($id_a_contrato);
			include('flotillaSubDiv3.php');	
		}
	}
// TERMINA VISTA A USUARIOS CON FILTRO FLOTILLA 3


// INICIO VISTA A USUARIOS CON FILTRO FLOTILLA 2
if($_SESSION["filtroFlotilla"] == 2)
	{
		usuarioAsigns($id_usuario);
		foreach ($asigArray as $key => $id_a_contrato)
		{
			usuarioAsig($id_a_contrato);
			include('flotillaSubDiv2.php');		
		}
	}
// TERMINA VISTA A USUARIOS CON FILTRO FLOTILLA 2


if($_SESSION["filtroFlotilla"] <= 1){ //INICIO  VISTA EJECUTIVOS jet van y administradores de contrato

//include ("nav_flotilla.php");

$id_usuario = $_SESSION['id_usuario'];
########## ########## ######### ##########

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

$cuenta_contratos = ' SELECT
				c.`id_contrato` '
				.' FROM `clbCto` c JOIN asignaEjecutivo a '
				.' ON c.`id_contrato` = a.`id_contrato` '
				." WHERE a.`id_usuario` = $id_usuario AND fecha_final IS NULL" ;
$sacar_cuenta 	= mysqli_query($dbd2, $cuenta_contratos);
$cuenta 		= mysqli_num_rows($sacar_cuenta);
$paginas 		= $cuenta/$rxpag;
$paginas_entero = ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta CONTRATOS REGISTRADOS</h3><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

echo "<div><fieldset><legend>LISTADO DE CONTRATOS</legend>";

$sql_contratos = ' SELECT
			c.`id_contrato`, 
			c.`id_cliente`, 
			c.`id_alan`, 
			c.`documento`, 
			c.`fuente`, 
			c.`estatus`, 
			c.`numero`, 
			c.`aliasCto`, 
			c.`fechacontrato`, 
			c.`fechainicio`, 
			c.`fechafin`, 
			c.`min`, 
			c.`max` '
			.' FROM `clbCto` c JOIN asignaEjecutivo a '
			.' ON c.`id_contrato` = a.`id_contrato` '
			." WHERE a.`id_usuario` = $id_usuario AND fecha_final IS NULL" ;
		
echo "<table class='ResTabla'>\n";

echo "<tr>
		<th>CLIENTE</th>
		<th>CONTRATO</th>
		<th>Unidades Actuales</th>
		<th>Mantenimiento</th>
		<th>Final de Vigencia</th>
		<th>Vigencia Extendida</th> 
	</tr>";

$res_contratos  = mysqli_query($dbd2, $sql_contratos);

$total_unidades = 0;

while($row = mysqli_fetch_assoc($res_contratos)){
	
	$id_contrato 	= $row['id_contrato'];
	$id_cliente 	= $row['id_cliente'];
	$id_alan 		= $row['id_alan'];
	$documento 		= $row['documento'];
	$fuente 		= $row['fuente'];
	$estatus 		= $row['estatus'];
	$numero 		= $row['numero'];
	$aliasCto 		= $row['aliasCto'];
	$fechacontrato 	= $row['fechacontrato'];
	$fechainicio 	= $row['fechainicio'];
	$fechafin 		= $row['fechafin'];
	$min 			= $row['min'];
	$max 			= $row['max'];
	@$max = number_format($max, 2);

	echo "<tr>";

	clientexid($id_cliente);
	echo "<td title='$razonSocial'>RFC: <b>{$rfc}</b> <br>";
	
	$razonSocialM = substr($razonSocial,0,20);

	echo "RAZON SOCIAL: {$razonSocialM} <br>";
	echo "ALIAS_CTE: {$alias}</td>";

	echo "<td>ID: 
				<b>  
				<a href='ctoIndex.php?id_contrato=$id_contrato' 
				style='text-decoration:none;' title='IR A INICIO' >
				=> {$id_alan}
				</a> 
				</b> <br>";
	echo "NO.OFICIAL: {$numero} <br>
			ALIAS_CTO:  {$aliasCto} </td>";

	unidadesContratoxid($id_contrato);
	echo "<td style='color:blue; font-size: 1.5em; text-align: center;'>
		<a href='clienteflotilla.php?id_contrato=$id_contrato' style='text-decoration: none;'>
		{$unidadesCto}
		</a>
		</td>";

	echo  "<td style='color:blue; font-size: 1em; text-align: center;'>
		<a href='mttoSolResSupCteCTO.php?id_contrato=$id_contrato' style='text-decoration: none;'>
		Mtto
		</a>
		</td>";	

	echo "<td>{$fechafin}</td>";

	fechaExtendidaXid_contrato($id_contrato);
	echo "<td>{$fechaExtendida}</td>";

	echo "<td><a href='estimacionSubir.php?id_contrato=$id_contrato&id_cliente=$id_cliente' 
				style='text-decoration: none;' 
				title='SUBIR ESTIMACION'>SE</a>
		  </td>";


	echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=1' style='text-decoration: none;'>O</a></td>";
	echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=2' style='text-decoration: none;'>P</a></td>";
	echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=3' style='text-decoration: none;'>AA</a></td>";
	echo "<td><a href='flotillaDesgloce.php?id_contrato=$id_contrato&tipoDesgloce=4' style='text-decoration: none;'>EF</a></td>";



// VER CONTRATO
	echo "	<td><a href='flotillaCto.php?id_contrato=$id_contrato' 
			style='text-decoration: none;'   title='VER CONTRATO'  >VC</a>
			</td>";
// VER CONTRATO

	echo "</tr>";

	$total_unidades +=  $unidadesCto; 
}
echo "</table>";
echo "<span style='color:white; background: gray; font-size: 1em; text-align: center;' >TF".$total_unidades."</span><br>";

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
########## ########## ######### ##########
echo "</fieldset></div>";







} // TERMINA VISTA EJECUTIVOS jet van y administradores de contrato
include("1footer.php");?>