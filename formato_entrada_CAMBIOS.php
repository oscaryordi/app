<?php session_start(); ?>
<?php include("seguridad.php"); ?>
<?php include("caducidad.php"); ?>
<meta charset='utf-8'>
<?php include_once ("base.inc.php"); ?>
<?php include_once("funcion.php"); ?>
<?php

$insertado = '';
 
if(isset($_POST['submit'])){
// PREPARAR CODIGO PARA INSERCION	
 $numero_inventario = 0;
// TEXTO TIEMPO Y DIFERENTES DE 1 Y 0
 $numero_inventario .= $_POST['numero_inventario'];
 $fecharecepcion = $_POST['fecharecepcion'];
 $marca = $_POST['marca'];
 $modelo = $_POST['modelo'];
 $economico = $_POST['economico'];
 $color = $_POST['color'];
 $tipo = $_POST['tipo'];
 $placas = $_POST['placas'];
 $serie = $_POST['serie'];
 $kilometraje = $_POST['kilometraje'];
 $combustible = $_POST['combustible'];
 $hora_entrada = $_POST['hora_entrada'];
 $razonentrada = $_POST['razonentrada'];
 $razonentradatexto = $_POST['razonentradatexto'];
 $proyecto_origen = $_POST['proyecto_origen'];
 $proyecto_destino = 'JETVAN TEMPORAL';  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
 $ubicacion_origen = $_POST['ubicacion_origen'];
 $ubicacion_destino = 'CALZADA MEXICO - TACUBA';  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
 $conductor_entrada = $_POST['conductor_entrada'];  
 $observaciones = $_POST['observaciones'];
 $realizo_inventario = $_POST['realizo_inventario'];
 $marca_de_llantas = $_POST['marca_de_llantas'];
 $traseros_derecha = $_POST['traseros_derecha'];
 $traseros_izquierda = $_POST['traseros_izquierda'];

$sql_campos= ' 
numero_inventario, 
fecharecepcion, 
marca, 
modelo, 
economico, 
color, 
tipo, 
placas, 
serie, 
kilometraje, 
combustible, 
hora_entrada, 
razonentrada, 
razonentradatexto, 
proyecto_origen, 
proyecto_destino, 
ubicacion_origen, 
ubicacion_destino, 
conductor_entrada, 
observaciones, 
realizo_inventario, 
marca_de_llantas, 
traseros_derecha, 
traseros_izquierda, 
';

$sql_valores = "
$numero_inventario, 
'$fecharecepcion', 
'$marca', 
'$modelo', 
'$economico', 
'$color', 
'$tipo', 
'$placas', 
'$serie', 
$kilometraje, 
$combustible, 
'$hora_entrada', 
'$razonentrada', 
'$razonentradatexto', 
'$proyecto_origen', 
'$proyecto_destino', 
'$ubicacion_origen', 
'$ubicacion_destino', 
'$conductor_entrada', 
'$observaciones', 
'$realizo_inventario', 
'$marca_de_llantas', 
$traseros_derecha, 
$traseros_izquierda,
";

// echo '<br><br><br>'.$sql_campos.'<br>CAMPOS OBLIGATORIOS<br><br>'; // TOTAL DE CAMPOS PREDETERMINADOS
// echo $sql_valores.'<br>VALORES OBLIGATORIOS<br><br>';

// SEUDO BOLEANOS 1 Y 0, SI/NO
// PREDETERMINADO SI UNO 1
 $poliza = $_POST['poliza'];
if($poliza == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' poliza, ';
	$sql_valores.= " $poliza, ";
}

 $manual = $_POST['manual'];
if($manual == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' manual, ';
	$sql_valores.= " $manual, ";
}

 $tarjeta = $_POST['tarjeta'];
if($tarjeta == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' tarjeta, ';
	$sql_valores.= " $tarjeta, ";
}

 $poliza_mtto = $_POST['poliza_mtto'];
if($poliza_mtto == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' poliza_mtto, ';
	$sql_valores.= " $poliza_mtto, ";
}

 $defensa_delantera = $_POST['defensa_delantera'];
if($defensa_delantera == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' defensa_delantera, ';
	$sql_valores.= " $defensa_delantera, ";
}

 $brazos_limpiadores = $_POST['brazos_limpiadores'];
if($brazos_limpiadores == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' brazos_limpiadores, ';
	$sql_valores.= " $brazos_limpiadores, ";
}

 $tapones_de_llantas = $_POST['tapones_de_llantas'];
if($tapones_de_llantas == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' tapones_de_llantas, ';
	$sql_valores.= " $tapones_de_llantas, ";
}

 $defensa_trasera = $_POST['defensa_trasera'];
if($defensa_trasera == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' defensa_trasera, ';
	$sql_valores.= " $defensa_trasera, ";
}

 $espejos_laterales = $_POST['espejos_laterales'];
if($espejos_laterales == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' espejos_laterales, ';
	$sql_valores.= " $espejos_laterales, ";
}

 $tapon_de_aceite = $_POST['tapon_de_aceite'];
if($tapon_de_aceite == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' tapon_de_aceite, ';
	$sql_valores.= " $tapon_de_aceite, ";
}

 $parabrisas = $_POST['parabrisas'];
if($parabrisas == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' parabrisas, ';
	$sql_valores.= " $parabrisas, ";
}

 $antena = $_POST['antena'];
if($antena == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' antena, ';
	$sql_valores.= " $antena, ";
}

 $tapon_de_agua = $_POST['tapon_de_agua'];
if($tapon_de_agua == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' tapon_de_agua, ';
	$sql_valores.= " $tapon_de_agua, ";
}

 $medallon = $_POST['medallon'];
if($medallon == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' medallon, ';
	$sql_valores.= " $medallon, ";
}

 $calaveras = $_POST['calaveras'];
if($calaveras == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' calaveras, ';
	$sql_valores.= " $calaveras, ";
}

 $tapon_de_gasolina = $_POST['tapon_de_gasolina'];
if($tapon_de_gasolina == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' tapon_de_gasolina, ';
	$sql_valores.= " $tapon_de_gasolina, ";
}

 $radio_am_fm = $_POST['radio_am_fm'];
if($radio_am_fm == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' radio_am_fm, ';
	$sql_valores.= " $radio_am_fm, ";
}

 $gato = $_POST['gato'];
if($gato == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' gato, ';
	$sql_valores.= " $gato, ";
}

 $elevadores = $_POST['elevadores'];
if($elevadores == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' elevadores, ';
	$sql_valores.= " $elevadores, ";
}

 $llave_auxiliar = $_POST['llave_auxiliar'];
if($llave_auxiliar == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' llave_auxiliar, ';
	$sql_valores.= " $llave_auxiliar, ";
}

 $delantero_der = $_POST['delantero_der'];
if($delantero_der == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' delantero_der, ';
	$sql_valores.= " $delantero_der, ";
}

 $espejo_retrovisor = $_POST['espejo_retrovisor'];
if($espejo_retrovisor == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' espejo_retrovisor, ';
	$sql_valores.= " $espejo_retrovisor, ";
}

 $senal_de_carretera = $_POST['senal_de_carretera'];
if($senal_de_carretera == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' senal_de_carretera, ';
	$sql_valores.= " $senal_de_carretera, ";
}

 $delantero_izquierdo = $_POST['delantero_izquierdo'];
if($delantero_izquierdo == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' delantero_izquierdo, ';
	$sql_valores.= " $delantero_izquierdo, ";
}

 $clima = $_POST['clima'];
if($clima == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' clima, ';
	$sql_valores.= " $clima, ";
}

 $herramienta = $_POST['herramienta'];
if($herramienta == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' herramienta, ';
	$sql_valores.= " $herramienta, ";
}

 $cinturones_de_seguridad = $_POST['cinturones_de_seguridad'];
if($cinturones_de_seguridad == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' cinturones_de_seguridad, ';
	$sql_valores.= " $cinturones_de_seguridad, ";
}

 $extinguidor = $_POST['extinguidor'];
if($extinguidor == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' extinguidor, ';
	$sql_valores.= " $extinguidor, ";
}

 $tapete = $_POST['tapete'];
if($tapete == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' tapete, ';
	$sql_valores.= " $tapete, ";
}

 $cables_pasa_corriente = $_POST['cables_pasa_corriente'];
if($cables_pasa_corriente == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' cables_pasa_corriente, ';
	$sql_valores.= " $cables_pasa_corriente, ";
}

 $refaccion = $_POST['refaccion'];
if($refaccion == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' refaccion, ';
	$sql_valores.= " $refaccion, ";
}




// PREDETERMINADO CERO 0
 @$g1 = $_POST['g1'];
if($g1 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g1, ';
	$sql_valores.= " $g1, ";
}

 @$g2 = $_POST['g2'];
if($g2 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g2, ';
	$sql_valores.= " $g2, ";
}

 @$g3 = $_POST['g3'];
if($g3 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g3, ';
	$sql_valores.= " $g3, ";
}

 @$g4 = $_POST['g4'];
if($g4 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g4, ';
	$sql_valores.= " $g4, ";
}

 @$g5 = $_POST['g5'];
if($g5 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g5, ';
	$sql_valores.= " $g5, ";
}

 @$g6 = $_POST['g6'];
if($g6 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g6, ';
	$sql_valores.= " $g6, ";
}

 @$g7 = $_POST['g7'];
if($g7 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g7, ';
	$sql_valores.= " $g7, ";
}

 @$g8 = $_POST['g8'];
if($g8 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g8, ';
	$sql_valores.= " $g8, ";
}

 @$g9 = $_POST['g9'];
if($g9 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g9, ';
	$sql_valores.= " $g9, ";
}

 @$g10 = $_POST['g10'];
if($g10 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g10, ';
	$sql_valores.= " $g10, ";
}

 @$g11 = $_POST['g11'];
if($g11 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g11, ';
	$sql_valores.= " $g11, ";
}

 @$g12 = $_POST['g12'];
if($g12 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g12, ';
	$sql_valores.= " $g12, ";
}

 @$g13 = $_POST['g13'];
if($g13 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g13, ';
	$sql_valores.= " $g13, ";
}

 @$g14 = $_POST['g14'];
if($g14 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g14, ';
	$sql_valores.= " $g14, ";
}

 @$g15 = $_POST['g15'];
if($g15 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g15, ';
	$sql_valores.= " $g15, ";
}

 @$g16 = $_POST['g16'];
if($g16 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g16, ';
	$sql_valores.= " $g16, ";
}

 @$g17 = $_POST['g17'];
if($g17 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g17, ';
	$sql_valores.= " $g17, ";
}

 @$g18 = $_POST['g18'];
if($g18 == 1){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g18, ';
	$sql_valores.= " $g18, ";
}



// COMENTARIO GOLPES
 $g1c = $_POST['g1c'];
if($g1c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g1c, ';
	$sql_valores.= " '$g1c', ";
}
 $g2c = $_POST['g2c'];
if($g2c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g2c, ';
	$sql_valores.= " '$g2c', ";
}
 $g3c = $_POST['g3c'];
if($g3c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g3c, ';
	$sql_valores.= " '$g3c', ";
}
 $g4c = $_POST['g4c'];
if($g4c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g4c, ';
	$sql_valores.= " '$g4c', ";
}
 $g5c = $_POST['g5c'];
if($g5c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g5c, ';
	$sql_valores.= " '$g5c', ";
}
 $g6c = $_POST['g6c'];
if($g6c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g6c, ';
	$sql_valores.= " '$g6c', ";
}
 $g7c = $_POST['g7c'];
if($g7c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g7c, ';
	$sql_valores.= " '$g7c', ";
}
 $g8c = $_POST['g8c'];
if($g8c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g8c, ';
	$sql_valores.= " '$g8c', ";
}
 $g9c = $_POST['g9c'];
if($g9c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g9c, ';
	$sql_valores.= " '$g9c', ";

 $g10c = $_POST['g10c'];
if($g10c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g10c, ';
	$sql_valores.= " '$g10c', ";
}
 $g11c = $_POST['g11c'];
if($g11c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g11c, ';
	$sql_valores.= " '$g11c', ";
}
 $g12c = $_POST['g12c'];
if($g12c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g12c, ';
	$sql_valores.= " '$g12c', ";
}
 $g13c = $_POST['g13c'];
if($g13c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g13c, ';
	$sql_valores.= " '$g13c', ";
}
 $g14c = $_POST['g14c'];
if($g14c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g14c, ';
	$sql_valores.= " '$g14c', ";
}
 $g15c = $_POST['g15c'];
if($g15c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g15c, ';
	$sql_valores.= " '$g15c', ";
}
 $g16c = $_POST['g16c'];
if($g16c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g16c, ';
	$sql_valores.= " '$g16c', ";
}
 $g17c = $_POST['g17c'];
if($g17c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g17c, ';
	$sql_valores.= " '$g17c', ";
}
 $g18c = $_POST['g18c'];
if($g18c !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' g18c, ';
	$sql_valores.= " '$g18c', ";}
}

// echo '<br><br><br>'.$sql_campos.'<br>CAMPOS ADICIONALES<br><br>'; // PARA VERIFICAR SI SE SUMARON LOS NO PREDETERMINADOS
// echo $sql_valores.'<br>VALORES ADICIONALES<br><br>';

$sql_inicio = 'INSERT INTO `jetvantlc`.`formato_inventario` (';
$sql_medio = 'id_formato) VALUES (';
$sql_fin = ' NULL);';

$sql_full = $sql_inicio;
$sql_full .= $sql_campos; 
$sql_full .= $sql_medio;
$sql_full .= $sql_valores;
$sql_full .= $sql_fin;


//echo $sql_full;

$sql_inserta_formato = mysqli_query($dbd2, $sql_full );


// SOBRANTES NO OCUPADOS AQUI
// echo $id_formato = $_POST['id_formato']; // SE GENERA AL INSERTAR
// echo $fechaentrega = $_POST['fechaentrega']; // FORMATO SALIDA
//echo $hora_salida = $_POST['hora_salida'];  // FORMATO SALIDA
//echo $razonsalida = $_POST['razonsalida'];  // FORMATO SALIDA
//echo $placasustituido = $_POST['placasustituido'];  // FORMATO SALIDA
//echo $proyecto_destino = $_POST['proyecto_destino'];  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
//echo $ubicacion_destino = $_POST['ubicacion_destino'];  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
//echo $conductor_salida = $_POST['conductor_salida'];  // FORMATO SALIDA
//echo $solicito_unidad = $_POST['solicito_unidad'];  // FORMATO SALIDA
//echo $autoriza_salida = $_POST['autoriza_salida'];  // FORMATO SALIDA
//echo $recibe_unidad = $_POST['recibe_unidad'];  // FORMATO SALIDA


	if(!$sql_inserta_formato){
	echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
	}
	else{
		echo "<br><h2>FORMATO REGISTRADO CORRECTAMENTE</h2><br>";
		echo "<a href='registrofisico.php'>CAPTURAR OTRO</a>";
	}

	$insertado = 'si';

}
?>

<?php

@$uPlacas = $_POST['uPlacas'];
@$uNEco = $_POST['uNEco'];
@$uSerie = $_POST['uSerie'];


if(isset($uPlacas) && $uPlacas !== ''){
	datosporplaca($uPlacas);
	}
elseif(isset($uNEco) && $uNEco !== ''){
	datosporeconomico($uNEco);
	}
elseif(isset($uSerie) && $uSerie !== ''){
	datosporserie($uSerie);
	}
?>

<html>
<head>
<meta charset='utf-8'>
	<style>
	table{font-size:.7em;font-family:arial;width:950px;}
	table th{background: #5db45d;color:white;}
	.obs{width:100%;}
	</style>
</head>

<?php if ($insertado == ''){?>

<body onload=display_ct(); >
<style>
#logo {width:201px;height:81px;background-image: url('logo_i2.jpg');background-size:100%;}
.logo {width:201px;height:81px;}
#domicilio{font-size:1.7em;}
.razon{width:600px;}
.folio{width:149px;font-size:1.2em;}
#folio{color:red;text-align:center;font-weight:bold;font-size:1.5em;}
</style>
<table class="encabezado">
<tr>
<td>
<table class = "logo"> 
<td id ="logo"></td> 
</table>
</td>
<td>
<table class = "razon">
<tr><td><h1>INVENTARIO FISICO DEL VEHICULO</h1></td></tr>
<tr><td><h2>JET VAN CAR RENTAL, S.A. DE C.V.</h2></td></tr>
<tr><td id="domicilio">Pensilvania 131 local 1, Col. Napoles, Del. Benito Juárez, México, D.F. <br>Tel 5523-1346 Call Center 01 800 822 7737</td></tr>
</table>
</td>
<td>
<table class = "folio">
<tr><th class = "folio">NUMERO DE INVENTARIO</th></tr>

<!-- AQUI INICIA EL FORMULARIO -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
<tr><td class = "folio" id="folio"><INPUT TYPE="text" NAME="numero_inventario" placeholder="PROCESANDO"></td></tr>
</table>
</td>
</tr>
</table>
<br>

<table>
<tr> 
<th> FECHA DE RECEPCION VEHICULO </th> <td><INPUT TYPE="text" NAME=" fecharecepcion" placeholder=" fecha "   value= "<?php echo date("Y-n-j");?>"></td>
<th> FECHA DE ENTREGA VEHICULO</th> <td><INPUT TYPE="text" NAME=" fechaentrega" placeholder=" fecha "   value= "" disabled ></td>
</tr>
</table>

<!-- AQUI VAN LOS VALORES PRINCIPALES  -->
<br>
<table>
<tr><th colspan=8>CARACTERISTICAS DEL VEHICULO</th></tr>
<tr>
<td>MARCA</td> <td><INPUT TYPE="text" NAME="marca"  placeholder="marca"  ></td>
<td>MODELO</td> <td><INPUT TYPE="text" NAME="modelo" placeholder="modelo"   value="<?php echo @$Modelo;?>" ></td>
<td>ECONOMICO</td> <td><INPUT TYPE="text" NAME="economico" placeholder="economico"   value="<?php echo @$Economico;?>" ></td>
<td>COLOR</td> <td><INPUT TYPE="text" NAME="color" placeholder="color"   value="<?php echo @$Color;?>" ></td>
</tr>
<tr>
<td>TIPO</td> <td><INPUT TYPE="text" NAME="tipo" placeholder="tipo"   value="<?php echo @$Vehiculo;?>" ></td>
<td>PLACAS</td> <td><INPUT TYPE="text" NAME="placas" placeholder="placas"   value="<?php echo @$Placas;?>" ></td>
<td>SERIE</td> <td colspan=3><INPUT TYPE="text" NAME="serie" placeholder="serie"   value="<?php echo @$Serie;?>" ></td>
</tr>
</table>
<br>

<table>
<tr><th colspan=12>DOCUMENTOS DEL VEHICULO</th></tr>
<tr>
<td>POLIZA SEGURO</td>
<td><input type="radio" name="poliza" value="1" checked >Si</td>
<td><input type="radio" name="poliza" value="0" > No</td>
<td>MANUAL USUARIO</td>
<td><input type="radio" name="manual" value="1" checked >Si</td>
<td><input type="radio" name="manual" value="0" > No</td>
<td>TARJETACIRCULACION</td>
<td><input type="radio" name="tarjeta" value="1" checked >Si</td>
<td><input type="radio" name="tarjeta" value="0" > No</td>
<td>POLIZA MTTO</td>
<td><input type="radio" name="poliza_mtto" value="1" checked >Si</td>
<td><input type="radio" name="poliza_mtto" value="0" > No</td>
</tr>

<tr>
<td>KILOMETRAJE</td> 
<td colspan=5><INPUT TYPE="text" NAME="kilometraje" placeholder="kilometraje" value=0 ></td>

<td colspan=6>
<style>
.tablerob{width: 200px;}
.tablerob td{text-align:center;}
</style>
<table class="tablerob">
<tr><th colspan=9>Nivel de Combustible</th></tr>
<tr>
<td><input type="radio" name="combustible" value="0" checked >V</td>
<td><input type="radio" name="combustible" value="1">1/8</td>
<td><input type="radio" name="combustible" value="2">1/4</td>
<td><input type="radio" name="combustible" value="3">3/8</td>
<td><input type="radio" name="combustible" value="4">1/2</td>
<td><input type="radio" name="combustible" value="5">5/8</td>
<td><input type="radio" name="combustible" value="6">3/4</td>
<td><input type="radio" name="combustible" value="7">7/8</td>
<td><input type="radio" name="combustible" value="8">F</td>
</tr>
</table>
</td>


</tr>
</table>
<!--<td>ASEGURADORA</td><td><INPUT TYPE="text" NAME="aseguradora" placeholder="aseguradora"  ></td>-->
<br>
<table>
<tr><th colspan=2>CONDICIONES EXTERIORES DEL VEHICULO</th></tr>
<tr>
<td>
<style>
.esquema{width:312px;height:146px;background-image: url('auto_.jpg');background-size:100%;}.esquema td{text-align:center;color:blue;font-weight:bold;font-size:1.5em;}
</style>
<table class="esquema">
<tr><td><input type="checkbox" name="g1" value="1">1</td><td><input type="checkbox" name="g2" value="1">2</td><td><input type="checkbox" name="g3" value="1">3</td><td><input type="checkbox" name="g4" value="1">4</td><td><input type="checkbox" name="g5" value="1">5</td><td><input type="checkbox" name="g6" value="1">6</td></tr>
<tr><td><input type="checkbox" name="g7" value="1">7</td><td><input type="checkbox" name="g8" value="1">8</td><td><input type="checkbox" name="g9" value="1">9</td><td><input type="checkbox" name="g10" value="1">10</td><td><input type="checkbox" name="g11" value="1">11</td><td><input type="checkbox" name="g12" value="1">12</td></tr>
<tr><td><input type="checkbox" name="g13" value="1">13</td><td><input type="checkbox" name="g14" value="1">14</td><td><input type="checkbox" name="g15" value="1">15</td><td><input type="checkbox" name="g16" value="1">16</td><td><input type="checkbox" name="g17" value="1">17</td><td><input type="checkbox" name="g18" value="1">18</td></tr>
</table>
</td>
<td>
<style>
.esquema2{width:600px;} .esquema2 input {width:100px; height:48px;} .esquema2 td {height:48px;} .esquema2 textarea{width:100px; height:48px;font-size:1.1em;}
</style>
<table class="esquema2">
<tr>
<td><textarea type="text" name="g1c" value="1" placeholder = "1" ></textarea></td>
<td><textarea type="text" name="g2c" value="2" placeholder="2" ></textarea></td>
<td><textarea type="text" name="g3c" value="3" placeholder="3" ></textarea></td>
<td><textarea type="text" name="g4c" value="4" placeholder="4" ></textarea></td>
<td><textarea type="text" name="g5c" value="5" placeholder="5" ></textarea></td>
<td><textarea type="text" name="g6c" value="6" placeholder="6" ></textarea></td>
</tr>
<tr>
<td><textarea type="text" name="g7c" value="7" placeholder = "7" ></textarea></td>
<td><textarea type="text" name="g8c" value="8" placeholder="8" ></textarea></td>
<td><textarea type="text" name="g9c" value="9" placeholder="9" ></textarea></td>
<td><textarea type="text" name="g10c" value="10" placeholder="10" ></textarea></td>
<td><textarea type="text" name="g11c" value="11" placeholder="11" ></textarea></td>
<td><textarea type="text" name="g12c" value="12" placeholder="12" ></textarea></td>
</tr>
<tr>
<td><textarea type="text" name="g13c" value="13" placeholder= "13" ></textarea></td>
<td><textarea type="text" name="g14c" value="14" placeholder="14" ></textarea></td>
<td><textarea type="text" name="g15c" value="15" placeholder="15" ></textarea></td>
<td><textarea type="text" name="g16c" value="16" placeholder="16" ></textarea></td>
<td><textarea type="text" name="g17c" value="17" placeholder="17" ></textarea></td>
<td><textarea type="text" name="g18c" value="18" placeholder="18" ></textarea></td>
</tr>
</table>
</td>
</tr>
</table>

<br>
<table>
<tr><th colspan=9>REVISION EXTERIOR DEL VEHICULO</th></tr>
<tr>
<td>DEFENSA DELANTERA</td><td><input type="radio" name="defensa_delantera" value="1" checked >Si</td><td><input type="radio" name="defensa_delantera" value="0" > No</td>
<td>BRAZOS LIMPIADORES</td><td><input type="radio" name="brazos_limpiadores" value="1" checked >Si</td><td><input type="radio" name="brazos_limpiadores" value="0" > No</td>
<td>TAPONES DE LLANTAS</td><td>
<select>
<option value=0 >0</option>
<option value=1 >1</option>
<option value=2 >2</option>
<option value=3 >3</option>
<option value=4 >4</option>
</select>


<input type="radio" name="tapones_de_llantas" value="1" checked >Si</td><td><input type="radio" name="tapones_de_llantas" value="0" > No</td>
</tr>
<tr>
<td>DEFENSA TRASERA</td><td><input type="radio" name="defensa_trasera" value="1" checked >Si</td><td><input type="radio" name="defensa_trasera" value="0" > No</td>
<td>ESPEJOS LATERALES</td><td><input type="radio" name="espejos_laterales" value="1" checked >Si</td><td><input type="radio" name="espejos_laterales" value="0" > No</td>
<td>TAPON DE ACEITE</td><td><input type="radio" name="tapon_de_aceite" value="1" checked >Si</td><td><input type="radio" name="tapon_de_aceite" value="0" > No</td>
</tr>
<tr>
<td>PARABRISAS</td><td><input type="radio" name="parabrisas" value="1" checked >Si</td><td><input type="radio" name="parabrisas" value="0" > No</td>
<td>ANTENA</td><td><input type="radio" name="antena" value="1" checked >Si</td><td><input type="radio" name="antena" value="0" > No</td>
<td>TAPON DE AGUA</td><td><input type="radio" name="tapon_de_agua" value="1" checked >Si</td><td><input type="radio" name="tapon_de_agua" value="0" > No</td><td>
</tr>
<tr>
<td>MEDALLON</td><td><input type="radio" name="medallon" value="1" checked >Si</td><td><input type="radio" name="medallon" value="0" > No</td>
<td>CALAVERAS</td><td><input type="radio" name="calaveras" value="1" checked >Si</td><td><input type="radio" name="calaveras" value="0" > No</td>
<td>TAPON DE GASOLINA</td><td><input type="radio" name="tapon_de_gasolina" value="1" checked >Si</td><td><input type="radio" name="tapon_de_gasolina" value="0" > No</td>
</tr>
</table>
<br>
<table>
<tr><th colspan=9>REVISION INTERIOR DEL VEHICULO</th></tr>
<tr>
<td>RADIO AM/FM</td><td><input type="radio" name="radio_am_fm" value="1" checked >Si</td><td><input type="radio" name="radio_am_fm" value="0" > No</td>
<td>GATO</td><td><input type="radio" name="gato" value="1" checked >Si</td><td><input type="radio" name="gato" value="0" > No</td>
<td>MARCA DE LLANTAS</td> <td colspan =2><INPUT TYPE="text" NAME="marca_de_llantas" placeholder="marca de llantas"  ></td>
</tr>
<tr>
<td>ELEVADORES</td><td><input type="radio" name="elevadores" value="1" checked >Si</td><td><input type="radio" name="elevadores" value="0" > No</td>
<td>LLAVE AUXILIAR</td><td><input type="radio" name="llave_auxiliar" value="1" checked >Si</td><td><input type="radio" name="llave_auxiliar" value="0" > No</td>
<td>DELANTERO DERECHO</td><td><input type="radio" name="delantero_der" value="1" checked >Si</td><td><input type="radio" name="delantero_der" value="0" > No</td>
</tr>
<tr>
<td>ESPEJO RETROVISOR</td><td><input type="radio" name="espejo_retrovisor" value="1" checked >Si</td><td><input type="radio" name="espejo_retrovisor" value="0" > No</td>
<td>SEÑAL DE CARRETERA</td><td><input type="radio" name="senal_de_carretera" value="1" checked >Si</td><td><input type="radio" name="senal_de_carretera" value="0" > No</td>
<td>DELANTERO IZQUIERDO</td><td><input type="radio" name="delantero_izquierdo" value="1" checked >Si</td><td><input type="radio" name="delantero_izquierdo" value="0" > No</td>
</tr>
<tr>
<td>A/C</td><td><input type="radio" name="clima" value="1" checked >Si</td><td><input type="radio" name="clima" value="0" > No</td>
<td>HERRAMIENTA</td><td><input type="radio" name="herramienta" value="1" checked >Si</td><td><input type="radio" name="herramienta" value="0" > No</td>
<td>TRASEROS DERECHA</td><td><input type="radio" name="traseros_derecha" value="1" checked >1</td><td><input type="radio" name="traseros_derecha" value="2" > 2</td>
</tr>
<tr>
<td>CINTURONES DE SEGURIDAD</td><td><input type="radio" name="cinturones_de_seguridad" value="1" checked >Si</td><td><input type="radio" name="cinturones_de_seguridad" value="0" > No</td>
<td>EXTINGUIDOR</td><td><input type="radio" name="extinguidor" value="1" checked >Si</td><td><input type="radio" name="extinguidor" value="0" > No</td>
<td>TRASEROS IZQUIERDA</td><td><input type="radio" name="traseros_izquierda" value="1" checked >1</td><td><input type="radio" name="traseros_izquierda" value="2" > 2</td>
</tr>
<tr>
<td>TAPETE</td><td>
<select>
<option value=0 >0</option>
<option value=1 >1</option>
<option value=2 >2</option>
<option value=3 >3</option>
<option value=4 >4</option>
</select>
<input type="radio" name="tapete" value="1" checked >Si</td><td><input type="radio" name="tapete" value="0" > No</td>
<td>CABLES PASA CORRIENTE</td><td><input type="radio" name="cables_pasa_corriente" value="1" checked >Si</td><td><input type="radio" name="cables_pasa_corriente" value="0" > No</td>
<td>REFACCION</td><td><input type="radio" name="refaccion" value="1" checked >Si</td><td><input type="radio" name="refaccion" value="0" > No</td>
</tr>
</table>
<br>
<table>

<tr><th colspan=6>MOTIVO ENTRADA / SALIDA DEL VEHICULO</th></tr>
<tr>

<script type="text/javascript">
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)}
function display_ct() {
var strcount
var x = new Date()
var x1 = x.getHours( )+ ":" + x.getMinutes() + ":" + x.getSeconds();
document.getElementById('hora_entrada').value = x1;
tt=display_c();
}
</script>

<td>HORA ENTRADA</td>
<td colspan=2 ><INPUT TYPE="text" NAME="hora_entrada" id='hora_entrada' ></td>
<!-- <td colspan=2 ><INPUT TYPE="text" NAME="hora_entrada" value="<?php // echo date("H:m:s");?>" ></td> -->

<td>HORA SALIDA</td>  <!-- SALIDA -->
<td colspan=2><INPUT TYPE="text" NAME="hora_salida" value="" disabled  ></td>
</tr>

<tr>
<td>MANTENIMIENTO</td>
<td><input type="radio" name="razonentrada" value="Mantenimiento" checked >Si</td>
<td></td>
<td>ASIGNADO A PROYECTO</td> <!-- SALIDA -->
<td><input type="radio" name="razonsalida" value="Asignado a proyecto"  disabled  >Si</td>
<td></td>
</tr>

<tr>
<td>RESGUARDO</td>
<td><input type="radio" name="razonentrada" value="Resguardo"  >Si</td>
<td></td>
<td>SUSTITUTO</td><td><input type="radio" name="razonsalida" value="Sustituto"  disabled  >Si</td> <!-- SALIDA -->
<td><INPUT TYPE="text" NAME="placasustituido" placeholder="placa unidad sustituida"   disabled ></td>
</tr>

<tr>
<td>REINGRESO</td>
<td><input type="radio" name="razonentrada" value="Reingreso"  >Si</td>
<td></td>
<td>CORTESIA</td>
<td><input type="radio" name="razonsalida" value="Cortesia"  disabled  >Si</td> <!-- SALIDA -->
<td></td>
</tr>

<tr>
<td>OTRO</td>
<td><input type="radio" name="razonentrada" value="Otro"  >Si</td>
<td><INPUT TYPE="text" NAME="razonentradatexto" placeholder="otro"  ></td>
<td>VENTA</td>
<td><input type="radio" name="razonsalida" value="Venta"  disabled  >Si</td> <!-- SALIDA -->
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td>RENTA DE PISO</td>
<td><input type="radio" name="razonsalida" value="Renta de piso"  disabled  >Si</td> <!-- SALIDA -->
<td></td>
</tr>
</table>
<br>

<table>
<tr><th colspan=4>DETALLE ENTRADA / SALIDA DEL VEHICULO</th></tr>
<tr>
<td>PROYECTO ORIGEN</td> <td><INPUT TYPE="text" NAME="proyecto_origen" placeholder="proyecto origen"   class='obs'></td>
<td>PROYECTO DESTINO</td> <td><INPUT TYPE="text" NAME="proyecto_destino" placeholder="proyecto destino"   class='obs' disabled ></td> <!-- SALIDA -->
</tr>
<tr>
<td>UBICACIÓN ORIGEN</td> <td><INPUT TYPE="text" NAME="ubicacion_origen" placeholder="ubicación origen"   class='obs'></td>
<td>UBICACIÓN DESTINO</td> <td><INPUT TYPE="text" NAME="ubicacion_destino" placeholder="ubicación destino"   class='obs' disabled ></td> <!-- SALIDA -->
</tr>
<tr>
<td>CONDUCTOR ENTRADA</td> <td><INPUT TYPE="text" NAME="conductor_entrada" placeholder="conductor entrada"   class='obs'></td>
<td>CONDUCTOR SALIDA</td> <td><INPUT TYPE="text" NAME="conductor_salida" placeholder="conductor salida"   class='obs' disabled ></td> <!-- SALIDA -->
</tr>
<tr><td colspan=4>OBSERVACIONES</td></tr> 
<tr><td colspan=4><INPUT TYPE="textarea" NAME="observaciones" placeholder="observaciones" class='obs' ></td></tr>
</table>
<br>

<table>
<tr><th colspan=4>PERSONAL RESPONSABLE</th></tr>
<tr>
<td>REALIZO INVENTARIO</td> 
<td>SOLICITO UNIDAD</td> 
<td>AUTORIZA SALIDA</td> 
<td>RECIBE UNIDAD</td> 
</tr>
<tr>
<td><INPUT TYPE="text" NAME="realizo_inventario" placeholder="realizo inventario"  class='obs' value='<?php echo $_SESSION['nombre']; ?>'></td>
<td><INPUT TYPE="text" NAME="solicito_unidad" placeholder="solicito unidad"  class='obs' disabled ></td>
<td><INPUT TYPE="text" NAME="autoriza_salida" placeholder="autoriza salida"  class='obs' disabled ></td>
<td><INPUT TYPE="text" NAME="recibe_unidad" placeholder="recibe unidad"  class='obs' disabled ></td>
</tr>
</table>
<style>.nota {font-size:.7em;}</style>
<p class="nota">LA EMPRESA JET VAN CAR RENTAL, S.A. DE C.V., NO SE HACE RESPONSABLE POR OBJETOS EXTRAVIADOS O PERDIDOS</p>
<table>
<a onClick="javascript: return confirm('Confirma proceder a registrar la ENTRADA'); " >
<input type="submit" name="submit" value="Generar">
</a>
</table> 
</form>
<form action="registrofisico.php" ><input id="gobutton2" type="submit" name="Regresar" value="Regresar"></form>
</body>
</html>
<?php }; ?>