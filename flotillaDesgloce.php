<?php
include("1header.php");

$id_usuario = $_SESSION["id_usuario"];
tienecontrato($_SESSION["id_usuario"]);

if($_SESSION["filtroFlotilla"] <= 1){ //INICIO  VISTA EJECUTIVOS jet van y administradores de contrato

$tipoDesgloce 	= $_GET['tipoDesgloce'];
$id_contrato 	= $_GET['id_contrato'];

contratoxid($id_contrato);
clientexid($id_cliente);

echo "<p>RFC ::: $rfc , Razon Social ::: 
		<span style='font-weight:bold;'>$razonSocial</span> , Alias ::: $alias</p>";
echo "<p>Id_Alan ::: $id_alan , #Cto ::: 
		<span style='font-weight:bold;'>$numero</span>, Alias ::: $aliasCto</p>";

switch($tipoDesgloce)
{
	case "1":
		$tDesgloceTxt 	= 'ORDEN DE SERVICIO';
		$colDesgloce 	= 'id_orden';
		$tablaDesgloce 	= 'ctoOrden';
		break;
	case "2":
		$tDesgloceTxt 	= 'PARTIDA';
		$colDesgloce 	= 'id_partida';
		$tablaDesgloce 	= 'ctoPartidas';
		break;
	case "3":
		$tDesgloceTxt 	= 'AREA ADMINISTRATIVA';
		$colDesgloce 	= 'id_subDiv2';
		$tablaDesgloce 	= 'clbSubDiv2';
		break;
	case "4":
		$tDesgloceTxt 	= 'ENTIDAD FEDERATIVA';
		$colDesgloce 	= 'id_estado';
		$tablaDesgloce 	= 'estadosR';
		break;
	default:
		break;
}

// ACCESO PARA VER Y CREAR AREAS ADMNISTRATIVAS
echo "<p><a href='clienteCtoAA.php?id_contrato=$id_contrato&id_cliente=$id_cliente' 
		style='text-decoration: none;' title='VER AREAS ADMINISTRATIVAS'>
		VER AREAS ADMINISTRATIVAS</a></p>";
// ACCESO PARA VER Y CREAR AREAS ADMINISTRATIVAS

echo "<h3>DESGLOCE DE FLOTILLA POR $tDesgloceTxt </h3><br>";
echo "<div><fieldset><legend>DESGLOCE</legend>";

$sql_Desgloce 	=" SELECT $colDesgloce tipoDesgloce, COUNT($colDesgloce) SUBTOTAL "
				.' FROM `asignaUactual` '
				." WHERE id_contrato = $id_contrato 
				   AND tipoAsig = 1 
				   GROUP BY $colDesgloce" ;
		
echo "<table >";
echo "<tr>
		<th>$tDesgloceTxt</th>
		<th>Base</th>
		<th>Sustitutos</th>
	  </tr>";

$R_Desgloce = mysqli_query($dbd2, $sql_Desgloce);

$total_unidades 	= 0;
$totalSustitutos 	= 0;

while($row = mysqli_fetch_assoc($R_Desgloce)){
	
	$colDesgloceDet = $row['tipoDesgloce'];
	$subTotal 		= $row['SUBTOTAL'];

	// DESCRIPCION DESGLOCE
	$sql_DD	= "SELECT * FROM $tablaDesgloce WHERE $colDesgloce = $colDesgloceDet LIMIT 1 ";
	$R_DD 	= mysqli_query($dbd2, $sql_DD);
	$R_DD_M	= mysqli_fetch_array($R_DD);
	$descripcion = $R_DD_M['descripcion']; // DESCRIPCION // DESCRIPCION // DESCRIPCION // DESCRIPCION

	sustitutosContratoDesgloce($id_contrato, $colDesgloce, $colDesgloceDet);

	echo "<tr>";
	echo "<td>{$colDesgloceDet}:::{$descripcion}</td>";
	echo "<td><a href='flotillaDesgloceDetalle.php?id_contrato=$id_contrato&tipoDesgloce=$tipoDesgloce&tipoDesgDet=$colDesgloceDet&tipoAsig=1' 
				style='text-decoration: none;'>{$subTotal}</a></td>";

	echo "<td><a href='flotillaDesgloceDetalle.php?id_contrato=$id_contrato&tipoDesgloce=$tipoDesgloce&tipoDesgDet=$colDesgloceDet&tipoAsig=2' 
				style='text-decoration: none;'>{$subTotalS}</a></td>";
	echo "</tr>";

	$totalSustitutos 	+= $subTotalS;
	$total_unidades 	+=  $subTotal; 
	$totalFlotilla 		= $total_unidades+$totalSustitutos;
}
echo "</table>";
echo "<span style='color:white; background: gray; font-size: 1em; text-align: center;' >TS: ".$totalSustitutos."</span><br>";
echo "<span style='color:white; background: gray; font-size: 1em; text-align: center;' >TB: ".$total_unidades."</span><br>";
echo "<span style='color:white; background: gray; font-size: 1em; text-align: center;' >TF: ".$totalFlotilla."</span><br>";


########## ########## ######### ##########
echo "</fieldset></div>";

} // TERMINA VISTA EJECUTIVOS jet van y administradores de contrato

// VOLVER
echo"<br>
	<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";
//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al contrato</a>";
if($_SESSION["clientes"] > 0  )
{
	echo"<br>
		<p>
		  <FORM action='clienteindexuno.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CLIENTE'>
		  </FORM>
		</p>";
	//echo "<a href='clienteindexuno.php?id_cliente='$id_cliente'>Volver al cliente</a>";
}
// VOLVER

include("1footer.php");?>