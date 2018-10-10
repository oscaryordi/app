<?php 
include("1header.php");?>
<meta charset='utf-8'>
<?php 

include("nav_mtto.php");

$id_usuario	= $_SESSION["id_usuario"];

if($_SESSION["mttos"] > 1 AND $_SESSION["ejecutivo"] > 0){  // APERTURA PRIVILEGIOS


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

$nivelusuario = $_SESSION["ejecutivo"];

if($nivelusuario == 1){// PARA EJECUTIVO
$cuenta_mjt = "SELECT id_mttoJ FROM mttoJtacuba WHERE ejecutivo = '$id_usuario'  ";
}
elseif($nivelusuario > 1){//PARA SUPERVISOR
$cuenta_mjt = "SELECT id_mttoJ FROM mttoJtacuba   ";
}

$sacar_cuenta = mysqli_query($dbd2, $cuenta_mjt);
$cuenta = mysqli_num_rows($sacar_cuenta);
$paginas = $cuenta/15;
$paginas_entero = ceil($cuenta/15);
// echo $cuenta."<br>";
// echo $paginas."<br>";
// echo $paginas_entero."<br>";



if($nivelusuario == 1){// PARA EJECUTIVO
$sql_MJT = 'SELECT * '
        . ' FROM mttoJtacuba '
        . " WHERE ejecutivo = '$id_usuario'  "
        . ' ORDER BY '
        . ' id_mttoJ '
        . ' DESC '
        . " LIMIT $pagina_1, 15" ;
}
elseif($nivelusuario > 1){//PARA SUPERVISOR
$sql_MJT = 'SELECT * '
        . ' FROM mttoJtacuba '
         . ' ORDER BY '
        . ' id_mttoJ '
        . ' DESC '
        . " LIMIT $pagina_1, 15" ; 
}


		
echo "	<fieldset><legend>LISTADO DE SERVICIOS JET VAN TACUBA</legend>
		<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
<th>Folio</th>
<th>FECHA DE INGRESO</th>
<th>HORA</th>

<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>
<th>COLOR</th>

<th>TIPO DE SERVICIO</th>

<th>KILOMETRAJE</th>
<th>EJECUTIVO</th>
<th>DEPENDENCIA</th>
<th>ESTATUS</th>
<th>ACTUALIZACION</th>
<th>EDITAR STATUS</th>
<th>ACUSE EJECUTIVO</th>

</tr>";

$res_MJT = mysqli_query($dbd2, $sql_MJT);

while($row = mysqli_fetch_assoc($res_MJT)){


	$id_mttoJ 	= $row['id_mttoJ'];
	$id_unidad 	= $row['id_unidad'];
	$fechaI 	= $row['fechaI'];
	$horaI 		= $row['horaI'];

	datosxid($id_unidad);

	$preventivo = $row['preventivo'];
	if($preventivo == 1){$preventivo = 'PREVENTIVO';} else {$preventivo = '';}

	$frenos = $row['frenos'];
	if($frenos == 1){$frenos = 'FRENOS';} else {$frenos = '';}

	$suspdir = $row['suspdir'];
	if($suspdir == 1){$suspdir = 'SUSPENSION/DIRECCION';} else {$suspdir = '';}

	$clima = $row['clima'];
	if($clima == 1){$clima = 'CLIMA';} else {$clima = '';}

	$motor = $row['motor'];
	if($motor == 1){$motor = 'MOTOR';} else {$motor = '';}

	$transm = $row['transm'];
	if($transm == 1){$transm = 'TRANSMISION';} else {$transm = '';}

	$llantas = $row['llantas'];
	if($llantas == 1){$llantas = 'LLANTAS';} else {$llantas = '';}

	$hojalateria = $row['hojalateria'];
	if($hojalateria == 1){$hojalateria = 'HOJALATERIA';} else {$hojalateria = '';}

	$electrico = $row['electrico'];
	if($electrico == 1){$electrico = 'ELECTRICO';} else {$electrico = '';}


	$status = $row['status'];
	if($status == 1){$status = 'POR ASIGNAR';} 
	elseif($status == 2) {$status = 'EN PROCESO';}
	elseif($status == 3) {$status = 'PENDIENTE/REFACCIONES';}
	elseif($status == 4) {$status = 'TALLER EXTERNO';}
	elseif($status == 5) {$status = 'TERMINADO';}

	$colort = '';
	if($row['status'] == 5){$colort = 'red';}else{$colort = 'black';}

	$ejecutivo = $row['ejecutivo'];

	// CONSULTAR EJECUTIVOS PARA NORMALIZAR TABLA MTTOJTACUBA
	$sql_mttoJt_ejec 	= "SELECT  nombre FROM usuarios WHERE  id_usuario = '$ejecutivo' ";
	$sql_mttoJt_ejec_r 	= mysqli_query($dbd2, $sql_mttoJt_ejec );
	while($row_ejec 	= mysqli_fetch_assoc($sql_mttoJt_ejec_r)){
		$ejecutivo 		= strtoupper($row_ejec['nombre']);
	}
	// CONSULTA EJECUTIVOS

	$cliente 		= $row['cliente'];
	$km 			= $row['km'];
	$actualizado 	= $row['fechareg'];
	$actualizado 	= date("d/m/Y H:i:s", strtotime("$actualizado + 2 hours"));

	
	echo "<tr>";
	echo "<td>{$id_mttoJ}</td>";
	echo "<td>{$fechaI}</td>";
	echo "<td>{$horaI}</td>";

	echo "<td>{$Placas}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Color}</td>";

	echo "<td style='font-size:.8em;'>{$preventivo}
		{$frenos}
		{$suspdir}
		{$clima}
		{$transm}
		{$llantas}
		{$hojalateria}
		{$electrico}
		</td>";
	echo "<td>{$km}</td>";


	echo "<td>{$ejecutivo}</td>";
	echo "<td>{$cliente}</td>"; 
	echo "<td><span style='color:{$colort};' >{$status}</span></td>";
	echo "<td>{$actualizado}</td>";	


	if($_SESSION["mttos"] > 2){ // SI TERMINADO, YA NO SE PUEDE ACTUALIZAR
	echo "<td >";	
		if($status == 'TERMINADO'){
			echo "TERMINADO";
		}
		else{
		echo "	
		<FORM action='mttoTacubaEditar.php' method='POST' >
			<INPUT TYPE='hidden' NAME='id_mttoJ' value='$id_mttoJ'>
			<INPUT TYPE='hidden' NAME='id_unidad' value='$id_unidad'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ACTUALIZAR' style='font-size:.8em;'>
		</FORM>	";			
		}
		echo "</td>"; 
	}else{echo "<td></td>";}


	// CHECAR ACUSE DE EJECUTIVO STATUS 6
	$sql_update = "	SELECT status, fechareg 
					FROM mttoJtacubaStatus 
					WHERE id_mttoJ = '$id_mttoJ' 
					ORDER BY status DESC LIMIT 1 ";
	$sql_update_r 	=  mysqli_query($dbd2, $sql_update );
	$statusUpdated 	= '';
	$fecharegStatus = '';
	while($row_update_r = mysqli_fetch_assoc($sql_update_r))
	{
		$statusUpdated 	=  $row_update_r['status'];
		$fecharegStatus =  $row_update_r['fechareg'];
		$fecharegStatus = date("d/m/Y H:i:s", strtotime("$fecharegStatus + 2 hours"));
	}
	// CHECAR ACUSE DE EJECUTIVO STATUS 6


	if($_SESSION["mttos"] > 1){ // SI $statusUpdated = 6, YA NO SE PUEDE ACTUALIZAR
	echo "<td >";	
		if($statusUpdated == '6')
		{
			echo "ENTERADO $fecharegStatus";
		}
		elseif($statusUpdated == '5')
		{
		echo "	
		<FORM action='mttoTacubaEditarAcuse.php' method='POST' >
			<INPUT TYPE='hidden' NAME='id_mttoJ' value='$id_mttoJ'>
			<INPUT TYPE='hidden' NAME='id_unidad' value='$id_unidad'>			
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ACUSE' style='font-size:.8em;'>
		</FORM>	";			
		}
		echo "</td>"; 
	}
	else
	{echo "<td></td>";}

	echo "</tr>";
}
echo "</table></fieldset>";



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
		echo "<a href='mttorestacuba.php?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 5px; margin: 0px 1px; background-color: #F8F8F8 ;' >$i</a> ";
	}


} // CIERRE PRIVILEGIOS
include ("1footer.php");?>