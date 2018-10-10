<?php session_start();
include("seguridad.php");
include("caducidad.php"); ?>
<meta charset='utf-8'>
<?php
include_once ("base.inc.php");
include_once("funcion.php");


$insertado = '';
 
if(isset($_POST['submit'])){
// PREPARAR CODIGO PARA INSERCION	
 $numero_inventario = '';
// TEXTO TIEMPO Y DIFERENTES DE 1 Y 0
 $numero_inventario .= $_POST['numero_inventario'];
 $fecharecepcion = $_POST['fecharecepcion'];
 $marca 	= $_POST['marca'];
 $modelo 	= $_POST['modelo'];
 $economico = $_POST['economico'];
 $color 	= $_POST['color'];
 $tipo 		= $_POST['tipo'];
 $placas 	= $_POST['placas'];
 $serie 	= $_POST['serie'];
 
 $id_unidad = $_POST['id_unidad'];
 
 $kilometraje 	= $_POST['kilometraje'];
 $combustible 	= $_POST['combustible'];
 $hora_entrada 	= $_POST['hora_entrada'];
 @$razonentrada 	= $_POST['razonentrada'];
 $razonentradatexto = $_POST['razonentradatexto'];
 $proyecto_origen 	= $_POST['proyecto_origen'];
 $proyecto_destino 	= $_POST['proyecto_destino'];  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL

 $capturo    = $_SESSION["id_usuario"];

 $ubicacion_origen 	= $_POST['ubicacion_origen'];
 $ubicacion_destino = $_POST['ubicacion_destino'];  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
 $conductor_entrada 	= $_POST['conductor_entrada'];  
 $observaciones 		= $_POST['observaciones'];
 $realizo_inventario 	= $_POST['realizo_inventario'];
 $marca_de_llantas 		= $_POST['marca_de_llantas'];
 $traseros_derecha 		= $_POST['traseros_derecha'];
 $traseros_izquierda 	= $_POST['traseros_izquierda'];

 $fechaentrega 		= $_POST['fechaentrega']; // FORMATO SALIDA
 $hora_salida 		= $_POST['hora_salida'];  // FORMATO SALIDA
 @$razonsalida 		= $_POST['razonsalida'];  // FORMATO SALIDA
 $placasustituido 	= $_POST['placasustituido'];  // FORMATO SALIDA
 $conductor_salida 	= $_POST['conductor_salida'];  // FORMATO SALIDA
 $solicito_unidad 	= $_POST['solicito_unidad'];  // FORMATO SALIDA
 $autoriza_salida 	= $_POST['autoriza_salida'];  // FORMATO SALIDA
 $recibe_unidad 	= $_POST['recibe_unidad'];  // FORMATO SALIDA
 

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
id_unidad, 
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

 fechaentrega, 
 hora_salida, 
 razonsalida, 
 placasustituido, 
 conductor_salida, 
 solicito_unidad, 
 autoriza_salida, 
 recibe_unidad, 
 capturo, 
';

$sql_valores = "
'$numero_inventario', 
'$fecharecepcion', 
'$marca', 
'$modelo', 
'$economico', 
'$color', 
'$tipo', 
'$placas', 
'$serie', 
'$id_unidad', 
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

 '$fechaentrega', 
 '$hora_salida', 
 '$razonsalida', 
 '$placasustituido', 
 '$conductor_salida', 
 '$solicito_unidad', 
 '$autoriza_salida', 
 '$recibe_unidad', 
 '$capturo', 
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
}

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
	$sql_valores.= " '$g18c', ";
}


// ESPECIAL CAMPO PARA AUTO SUSTITUTO ENTRADA
//id_sustE
@$id_sustE = $_POST['id_sustE'];
if($id_sustE !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' id_sustE, ';
	$sql_valores.= " '$id_sustE', ";
	}
// ESPECIAL CAMPO PARA AUTO SUSTITUTO ENTRADA


// ESPECIAL CAMPO PARA AUTO SUSTITUTO SALIDA
//id_sustS
$id_sustS = $_POST['id_sustS'];
if($id_sustS !== ''){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' id_sustS, ';
	$sql_valores.= " '$id_sustS', ";
	}
// ESPECIAL CAMPO PARA AUTO SUSTITUTO SALIDA


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
if(!$sql_inserta_formato)
{
	echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "<br>\n";
}


// INICIO ACTUALIZAR TABLA AUTOSUSTITUTO
if($id_sustS !== ''){
		// OBTENER ULTIMO ID DE formato_inventario
		
		$sql_ultimo_formato = "SELECT MAX(id_formato) FROM formato_inventario ";
		$sql_ultimo_resultado = mysqli_query($dbd2, $sql_ultimo_formato );
		if($row_ultimo_formato = mysqli_fetch_row($sql_ultimo_resultado))
		{$id_formato_actual = trim($row_ultimo_formato[0]);}
	
		$sql_sustituto_salida = "UPDATE sustituto SET 
		id_formatoI = '$id_formato_actual', fechaI = '$fechaentrega', horaI = '$hora_salida' 
		WHERE id_sust = '$id_sustS' LIMIT 1 ";
		$sql_sust_dev_res = mysqli_query($dbd2, $sql_sustituto_salida );
		if(!$sql_sust_dev_res)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "<br>\n";
		}
}
// TERMINA ACTUALIZAR TABLA AUTOSUSTITUTO


// INICIO ACTUALIZAR TABLA KILOMETRAJESH
if($id_unidad !== '' AND $kilometraje !== '' ){
	$capturo 		= $_SESSION["id_usuario"];
	$kilometraje 	= mysqli_real_escape_string($dbd2, $kilometraje);
	
	$sql_kmH = "INSERT INTO kmH (id_km, id_unidad, km, capturo) VALUES (null, '$id_unidad', '$kilometraje', '$capturo')";
	$sql_kmH_R = mysqli_query($dbd2, $sql_kmH );
	if(!$sql_kmH_R)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "<br>\n";
		}
}// TERMINA ACTUALIZAR TABLA KILOMETRAJESH



// SOBRANTES NO OCUPADOS AQUI
//echo $id_formato = $_POST['id_formato']; // SE GENERA AL INSERTAR


	if(!$sql_inserta_formato)
	{
		echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
	}
	else
	{
		echo "<br><h2>FORMATO REGISTRADO CORRECTAMENTE</h2><br>";
		echo "<a href='registrofisico.php'>CAPTURAR OTRO</a>";
	}

	$insertado = 'si';

}
?>

<?php // AQUI INICIA LA CARGA DE LA PAGINA // SI HAY DATOS SE PROCESA SALIDA

@$numero_inventario = $_POST['numero_inventario'];
@$uPlacas = $_POST['uPlacas'];
@$uNEco = $_POST['uNEco'];
@$uSerie = $_POST['uSerie'];

// VARIABLES DE FORMULARIO EN BLANCO
// VARIABLES DEFINIDAS PARA FORMULARIO EN BLANCO VFB 
$vfb_numero_inventario = '0';
$vfb_fecharecepcion = '';
$vfb_fechaentrega = '';
$vfb_marca = '';
$vfb_modelo = '';
$vfb_economico = '';
$vfb_color = '';
$vfb_tipo = '';
$vfb_placas = '';
$vfb_serie = '';

$vfb_id_unidad = '';

$vfb_hora_entrada = '';
$vfb_hora_salida = '';

$vfb_razonsalida = '';
$vfb_rs_aspr='';
$vfb_rs_sust='';
$vfb_rs_cort='';
$vfb_rs_vnta='';
$vfb_rs_rnps='';

$vfb_placasustituido = '';

$vfb_razonentrada = '';
$vfb_re_mtto='';
$vfb_re_rsgd='';
$vfb_re_rgrs='';
$vfb_re_otro='';
$vfb_re_fue_sust='';

$vfb_id_sustE = '';

$vfb_razonentradatexto = '';
$vfb_proyecto_origen = '';
$vfb_proyecto_destino = '';
$vfb_ubicacion_origen = '';
$vfb_ubicacion_destino = '';
$vfb_conductor_entrada = '';
$vfb_conductor_salida = '';
$vfb_observaciones = '';
$vfb_realizo_inventario = '';
$vfb_solicito_unidad = '';
$vfb_autoriza_salida = '';
$vfb_recibe_unidad = '';

$vfb_kilometraje = 0;
$vfb_combustible = 'checked';
$vfb_gas0 = 'checked';
$vfb_gas1 = '';
$vfb_gas2 = ''; 
$vfb_gas3 = '';
$vfb_gas4 = '';
$vfb_gas5 = '';
$vfb_gas6 = '';
$vfb_gas7 = '';
$vfb_gas8 = '';

$vfb_marca_de_llantas = '';
$vfb_traseros_derecha = 'checked';
$vfb_traseros_derecha_2 = '';
$vfb_traseros_izquierda = 'checked';
$vfb_traseros_izquierda_2 = '';

$vfb_poliza = 'checked';
$vfb_manual = 'checked';
$vfb_tarjeta = 'checked';
$vfb_poliza_mtto = 'checked';
$vfb_poliza_no = '';
$vfb_manual_no = '';
$vfb_tarjeta_no = '';
$vfb_poliza_mtto_no = '';

$vfb_defensa_delantera = 'checked';
$vfb_brazos_limpiadores = 'checked';
$vfb_tapones_de_llantas = 'checked';
$vfb_defensa_trasera = 'checked';
$vfb_espejos_laterales = 'checked';
$vfb_tapon_de_aceite = 'checked';
$vfb_parabrisas = 'checked';
$vfb_antena = 'checked';
$vfb_tapon_de_agua = 'checked';
$vfb_medallon = 'checked';
$vfb_calaveras = 'checked';
$vfb_tapon_de_gasolina = 'checked';
$vfb_radio_am_fm = 'checked';
$vfb_gato = 'checked';
$vfb_elevadores = 'checked';
$vfb_llave_auxiliar = 'checked';
$vfb_delantero_derecho = 'checked';
$vfb_espejo_retrovisor = 'checked';
$vfb_senal_de_carretera = 'checked';
$vfb_delantero_izquierdo = 'checked';
$vfb_clima = 'checked';
$vfb_herramienta = 'checked';
$vfb_cinturones_de_seguridad = 'checked';
$vfb_extinguidor = 'checked';
$vfb_tapete = 'checked';
$vfb_cables_pasa_corriente = 'checked';
$vfb_refaccion = 'checked';

$vfb_defensa_delantera_no = '';
$vfb_brazos_limpiadores_no = '';
$vfb_tapones_de_llantas_no = '';
$vfb_defensa_trasera_no = '';
$vfb_espejos_laterales_no = '';
$vfb_tapon_de_aceite_no = '';
$vfb_parabrisas_no = '';
$vfb_antena_no = '';
$vfb_tapon_de_agua_no = '';
$vfb_medallon_no = '';
$vfb_calaveras_no = '';
$vfb_tapon_de_gasolina_no = '';
$vfb_radio_am_fm_no = '';
$vfb_gato_no = '';
$vfb_elevadores_no = '';
$vfb_llave_auxiliar_no = '';
$vfb_delantero_derecho_no = '';
$vfb_espejo_retrovisor_no = '';
$vfb_senal_de_carretera_no = '';
$vfb_delantero_izquierdo_no = '';
$vfb_clima_no = '';
$vfb_herramienta_no = '';
$vfb_cinturones_de_seguridad_no = '';
$vfb_extinguidor_no = '';
$vfb_tapete_no = '';
$vfb_cables_pasa_corriente_no = '';
$vfb_refaccion_no = '';

$vfb_g1 = '';
$vfb_g2 = '';
$vfb_g3 = '';
$vfb_g4 = '';
$vfb_g5 = '';
$vfb_g6 = '';
$vfb_g7 = '';
$vfb_g8 = '';
$vfb_g9 = '';
$vfb_g10 = '';
$vfb_g11 = '';
$vfb_g12 = '';
$vfb_g13 = '';
$vfb_g14 = '';
$vfb_g15 = '';
$vfb_g16 = '';
$vfb_g17 = '';
$vfb_g18 = '';

$vfb_g1c = '';
$vfb_g2c = '';
$vfb_g3c = '';
$vfb_g4c = '';
$vfb_g5c = '';
$vfb_g6c = '';
$vfb_g7c = '';
$vfb_g8c = '';
$vfb_g9c = '';
$vfb_g10c = '';
$vfb_g11c = '';
$vfb_g12c = '';
$vfb_g13c = '';
$vfb_g14c = '';
$vfb_g15c = '';
$vfb_g16c = '';
$vfb_g17c = '';
$vfb_g18c = '';
// FIN DE VARIABLES DE FORMULARIO EN BLANCO

// INICIO OBTENCION DE VARIABLES DESDE INVENTARIO CAPTURADO Y ASIGNACION A VARIABLES DE FORMULARIO EN BLANCO
if(isset($numero_inventario) && $numero_inventario !== ''){
	global $conectar;
	$sql_obtener_formato = "SELECT * FROM `formato_inventario` WHERE `numero_inventario` = '$numero_inventario' LIMIT 1"; 
	$sql_formato = mysqli_query($dbd2, $sql_obtener_formato);

	while($row = mysqli_fetch_assoc($sql_formato)){
		// VARIABLES QUE VAN DIRECTAS
	$vfb_numero_inventario = $row['numero_inventario'];
	$vfb_fecharecepcion = $row['fecharecepcion'];
	$vfb_fechaentrega = $row['fechaentrega'];
	$vfb_marca = $row['marca'];
	$vfb_modelo = $row['modelo'];
	$vfb_economico = $row['economico'];
	$vfb_color = $row['color'];
	$vfb_tipo = $row['tipo'];
	$vfb_placas = $row['placas'];
	$vfb_serie = $row['serie'];
	
	$vfb_id_unidad = $row['id_unidad'];

	$vfb_hora_entrada = $row['hora_entrada'];
	$vfb_hora_salida = $row['hora_salida'];
	$vfb_placasustituido = $row['placasustituido'];

	$vfb_razonentradatexto = $row['razonentradatexto'];
	$vfb_proyecto_origen = $row['proyecto_origen'];
	$vfb_proyecto_destino = $row['proyecto_destino'];
	$vfb_ubicacion_origen = $row['ubicacion_origen'];
	$vfb_ubicacion_destino = $row['ubicacion_destino'];
	$vfb_conductor_entrada = $row['conductor_entrada'];
	$vfb_conductor_salida = $row['conductor_salida'];
	$vfb_observaciones = $row['observaciones'];
	$vfb_realizo_inventario = $row['realizo_inventario'];
	$vfb_solicito_unidad = $row['solicito_unidad'];
	$vfb_autoriza_salida = $row['autoriza_salida'];
	$vfb_recibe_unidad = $row['recibe_unidad'];
	$vfb_kilometraje = $row['kilometraje'];
	$vfb_marca_de_llantas = $row['marca_de_llantas'];

	$vfb_g1c = $row['g1c'];
	$vfb_g2c = $row['g2c'];
	$vfb_g3c = $row['g3c'];
	$vfb_g4c = $row['g4c'];
	$vfb_g5c = $row['g5c'];
	$vfb_g6c = $row['g6c'];
	$vfb_g7c = $row['g7c'];
	$vfb_g8c = $row['g8c'];
	$vfb_g9c = $row['g9c'];
	$vfb_g10c = $row['g10c'];
	$vfb_g11c = $row['g11c'];
	$vfb_g12c = $row['g12c'];
	$vfb_g13c = $row['g13c'];
	$vfb_g14c = $row['g14c'];
	$vfb_g15c = $row['g15c'];
	$vfb_g16c = $row['g16c'];
	$vfb_g17c = $row['g17c'];
	$vfb_g18c = $row['g18c'];
	
	// VARIABLES QUE SE PROCESAN
	// PREDEFINIDAS EN CERO
	if($row['g1'] == 1){$vfb_g1 = 'checked';}
	if($row['g2'] == 1){$vfb_g2 = 'checked';}
	if($row['g3'] == 1){$vfb_g3 = 'checked';}
	if($row['g4'] == 1){$vfb_g4 = 'checked';}
	if($row['g5'] == 1){$vfb_g5 = 'checked';}
	if($row['g6'] == 1){$vfb_g6 = 'checked';}
	if($row['g7'] == 1){$vfb_g7 = 'checked';}
	if($row['g8'] == 1){$vfb_g8 = 'checked';}
	if($row['g9'] == 1){$vfb_g9 = 'checked';}
	if($row['g10'] == 1){$vfb_g10 = 'checked';}
	if($row['g11'] == 1){$vfb_g11 = 'checked';}
	if($row['g12'] == 1){$vfb_g12 = 'checked';}
	if($row['g13'] == 1){$vfb_g13 = 'checked';}
	if($row['g14'] == 1){$vfb_g14 = 'checked';}
	if($row['g15'] == 1){$vfb_g15 = 'checked';}
	if($row['g16'] == 1){$vfb_g16 = 'checked';}
	if($row['g17'] == 1){$vfb_g17 = 'checked';}
	if($row['g18'] == 1){$vfb_g18 = 'checked';}

	//VARIABLES PREDEFINIDAS 1
	if($row['poliza'] == 0){$vfb_poliza = '';$vfb_poliza_no = 'checked';}
	if($row['manual'] == 0){$vfb_manual = '';$vfb_manual_no = 'checked';}
	if($row['tarjeta'] == 0){$vfb_tarjeta = '';$vfb_tarjeta_no = 'checked';}
	if($row['poliza_mtto'] == 0){$vfb_poliza_mtto = '';$vfb_poliza_mtto_no = 'checked';}

	if($row['defensa_delantera'] == 0){$vfb_defensa_delantera = '';$vfb_defensa_delantera_no = 'checked';}
	if($row['brazos_limpiadores'] == 0){$vfb_brazos_limpiadores = '';$vfb_brazos_limpiadores_no = 'checked';}
	if($row['tapones_de_llantas'] == 0){$vfb_tapones_de_llantas = '';$vfb_tapones_de_llantas_no = 'checked';}
	if($row['defensa_trasera'] == 0){$vfb_defensa_trasera = '';$vfb_defensa_trasera_no = 'checked';}
	if($row['espejos_laterales'] == 0){$vfb_espejos_laterales = '';$vfb_espejos_laterales_no = 'checked';}
	if($row['tapon_de_aceite'] == 0){$vfb_tapon_de_aceite = '';$vfb_tapon_de_aceite_no = 'checked';}
	if($row['parabrisas'] == 0){$vfb_parabrisas = '';$vfb_parabrisas_no = 'checked';}
	if($row['antena'] == 0){$vfb_antena = '';$vfb_antena_no = 'checked';}
	if($row['tapon_de_agua'] == 0){$vfb_tapon_de_agua = '';$vfb_tapon_de_agua_no = 'checked';}
	if($row['medallon'] == 0){$vfb_medallon = '';$vfb_medallon_no = 'checked';}
	if($row['calaveras'] == 0){$vfb_calaveras = '';$vfb_calaveras_no = 'checked';}
	if($row['tapon_de_gasolina'] == 0){$vfb_tapon_de_gasolina = '';$vfb_tapon_de_gasolina_no = 'checked';}
	if($row['radio_am_fm'] == 0){$vfb_radio_am_fm = '';$vfb_radio_am_fm_no = 'checked';}
	if($row['gato'] == 0){$vfb_gato = '';$vfb_gato_no = 'checked';}
	if($row['elevadores'] == 0){$vfb_elevadores = '';$vfb_elevadores_no = 'checked';}
	if($row['llave_auxiliar'] == 0){$vfb_llave_auxiliar = '';$vfb_llave_auxiliar_no = 'checked';}
	if($row['delantero_derecho'] == 0){$vfb_delantero_derecho = '';$vfb_delantero_derecho_no = 'checked';}
	if($row['espejo_retrovisor'] == 0){$vfb_espejo_retrovisor = '';$vfb_espejo_retrovisor_no = 'checked';}
	if($row['senal_de_carretera'] == 0){$vfb_senal_de_carretera = '';$vfb_senal_de_carretera_no = 'checked';}
	if($row['delantero_izquierdo'] == 0){$vfb_delantero_izquierdo = '';$vfb_delantero_izquierdo_no = 'checked';}
	if($row['clima'] == 0){$vfb_clima = '';$vfb_clima_no = 'checked';}
	if($row['herramienta'] == 0){$vfb_herramienta = '';$vfb_herramienta_no = 'checked';}
	if($row['cinturones_de_seguridad'] == 0){$vfb_cinturones_de_seguridad = '';$vfb_cinturones_de_seguridad_no = 'checked';}
	if($row['extinguidor'] == 0){$vfb_extinguidor = '';$vfb_extinguidor_no = 'checked';}
	if($row['tapete'] == 0){$vfb_tapete = '';$vfb_tapete_no = 'checked';}
	if($row['cables_pasa_corriente'] == 0){$vfb_cables_pasa_corriente = '';$vfb_cables_pasa_corriente_no = 'checked';}
	if($row['refaccion'] == 0){$vfb_refaccion = '';$vfb_refaccion_no = 'checked';}
	
	// VALORES CON TRATAMIENTO DIFERENTE ESPECIALES
	if($row['traseros_derecha']==2){$vfb_traseros_derecha_2="checked";$vfb_traseros_derecha = '';}
	if($row['traseros_izquierda']==2){$vfb_traseros_izquierda_2="checked";$vfb_traseros_izquierda = '';}

	$vfb_combustible = $row['combustible'];
	if($vfb_combustible==1 ){$vfb_gas1 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==2 ){$vfb_gas2 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==3 ){$vfb_gas3 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==4 ){$vfb_gas4 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==5 ){$vfb_gas5 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==6 ){$vfb_gas6 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==7 ){$vfb_gas7 = 'checked';$vfb_gas0 = '';}
	if($vfb_combustible==8 ){$vfb_gas8 = 'checked';$vfb_gas0 = '';}
	
	$vfb_razonsalida = $row['razonsalida'];	
	if($vfb_razonsalida == 'Asignado a proyecto'){$vfb_rs_aspr='checked';}
	if($vfb_razonsalida == 'Sustituto'){$vfb_rs_sust='checked';}
	if($vfb_razonsalida == 'Cortesia'){$vfb_rs_cort='checked';}
	if($vfb_razonsalida == 'Venta'){$vfb_rs_vnta='checked';}
	if($vfb_razonsalida == 'Renta de piso'){$vfb_rs_rnps='checked';}
	
	$vfb_razonentrada = $row['razonentrada'];	
	if($vfb_razonentrada=='Mantenimiento'){$vfb_re_mtto='checked';}
	if($vfb_razonentrada=='Resguardo'){$vfb_re_rsgd='checked';}
	if($vfb_razonentrada=='Reingreso'){$vfb_re_rgrs='checked';}
	if($vfb_razonentrada=='Otro'){$vfb_re_otro='checked';}
	if($vfb_razonentrada=='Fue Sustituto'){$vfb_re_fue_sust='checked';}

	$vfb_id_sustE = $row['id_sustE'];
	} // FIN CIERRA CONSULTA EN BD CON FOLIO PARA PONER DATOS PREEXISTENTES
}
else
{
if(isset($uPlacas) && $uPlacas !== ''){
	idxplaca($uPlacas);
	}
elseif(isset($uNEco) && $uNEco !== ''){
	idxeconomico($uNEco);
	}
elseif(isset($uSerie) && $uSerie !== ''){
	idxserie($uSerie);
	}

	
datosxid($id_unidad);
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

<?php 
// CHECAR SI CUENTA CON FOLIO DE SUSTITUTO
if(@$Serie == ''){ $SerieS = $vfb_serie;}
else{$SerieS = $Serie;}

$sql_tiene_folio_sust = "SELECT * FROM sustituto WHERE serieSustituto = '$SerieS' AND fechaI IS NULL AND fechaF IS NULL AND status = '1' ORDER BY id_sust DESC LIMIT 1 ";
$sql_tiene_folio_sust_res = mysqli_query($dbd2, $sql_tiene_folio_sust );
global $id_sust_pendiente;
while($row_tiene_folio = mysqli_fetch_assoc($sql_tiene_folio_sust_res)){
	$id_sust_pendiente = $row_tiene_folio['id_sust'];
	echo "<h2 style='color:red;'> Unidad esta contemplada como sustituto con folio $id_sust_pendiente FAVOR DE VERIFICAR </h2><br>";
}
// CHECAR SI CUENTA CON FOLIO DE SUSTITUTO
?>

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
				<tr><td class = "folio" id="folio"><INPUT TYPE="text" NAME="numero_inventario" placeholder="PROCESANDO" value="<?php echo $vfb_numero_inventario; ?>" ></td></tr>
			</table>
		</td>
	</tr>
</table>
<br>

<table>
<tr> 
<th> FECHA DE RECEPCION VEHICULO </th> 
<td>
<INPUT TYPE="text" NAME="fecharecepcion" placeholder=" fecha "   value= "<?php echo $vfb_fecharecepcion; ?>" disabled >
<INPUT TYPE="text" NAME="fecharecepcion" placeholder=" fecha "   value= "<?php echo $vfb_fecharecepcion; ?>" hidden >
</td>

<?php // FECHA DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>

<th> FECHA DE ENTREGA VEHICULO</th> <td><INPUT TYPE="text" NAME="fechaentrega" placeholder=" fecha "   value= "<?php echo date("Y-m-d");?>"  ></td>
</tr>
</table>

<!-- AQUI VAN LOS VALORES PRINCIPALES  -->
<br>
<table>
<tr><th colspan=8>CARACTERISTICAS DEL VEHICULO</th></tr>
<tr>
<td>MARCA</td> <td><INPUT TYPE="text" NAME="marca"  placeholder="marca" value="<?php echo $vfb_marca; ?>" ></td>
<td>MODELO</td> <td><INPUT TYPE="text" NAME="modelo" placeholder="modelo"   value="<?php echo $vfb_modelo; ?><?php echo @$Modelo;?>" ></td>
<td>ECONOMICO</td> <td><INPUT TYPE="text" NAME="economico" placeholder="economico"   value="<?php echo $vfb_economico; ?><?php echo @$Economico;?>" ></td>
<td>COLOR</td> <td><INPUT TYPE="text" NAME="color" placeholder="color"   value="<?php echo $vfb_color; ?><?php echo @$Color;?>" ></td>
</tr>
<tr>
<td>TIPO</td> <td><INPUT TYPE="text" NAME="tipo" placeholder="tipo"   value="<?php echo $vfb_tipo; ?><?php echo @$Vehiculo;?>" ></td>
<td>PLACAS</td> <td><INPUT TYPE="text" NAME="placas" placeholder="placas"   value="<?php echo $vfb_placas; ?><?php echo @$Placas;?>" ></td>
<td>SERIE</td> <td colspan=3><INPUT TYPE="text" NAME="serie" placeholder="serie"   value="<?php echo $vfb_serie; ?><?php echo @$Serie;?>" >
<INPUT TYPE="hidden" NAME="id_unidad" placeholder="id_unidad"   value="<?php echo $vfb_id_unidad; ?><?php echo @$id_unidad?>" >

<?php
if($_SESSION["gpsV"] > 0){
	$id_unidad = (@$id_unidad == '' OR $id_unidad == NULL )? $vfb_id_unidad : $id_unidad ;
	gpsxid($id_unidad);
	echo "<div>$gpsAvisa</div>";
}
?>
</td>
</tr>
</table>
<br>

<table>
<tr><th colspan=12>DOCUMENTOS DEL VEHICULO</th></tr>
<tr>
<td>POLIZA SEGURO</td>
<td><input type="radio" name="poliza" value="1" <?php echo $vfb_poliza; ?> >Si</td>
<td><input type="radio" name="poliza" value="0" <?php echo $vfb_poliza_no; ?>> No</td>
<td>MANUAL USUARIO</td>
<td><input type="radio" name="manual" value="1" <?php echo $vfb_manual; ?> >Si</td>
<td><input type="radio" name="manual" value="0" <?php echo $vfb_manual_no; ?>> No</td>
<td>TARJETACIRCULACION</td>
<td><input type="radio" name="tarjeta" value="1" <?php echo $vfb_tarjeta; ?> >Si</td>
<td><input type="radio" name="tarjeta" value="0" <?php echo $vfb_tarjeta_no; ?>> No</td>
<td>POLIZA MTTO</td>
<td><input type="radio" name="poliza_mtto" value="1" <?php echo $vfb_poliza_mtto; ?> >Si</td>
<td><input type="radio" name="poliza_mtto" value="0" <?php echo $vfb_poliza_mtto_no; ?>> No</td>
</tr>

<tr>
<td>KILOMETRAJE</td> 
<td colspan=5><INPUT TYPE="text" NAME="kilometraje" placeholder="kilometraje" value=0<?php echo $vfb_kilometraje; ?> ></td>

<td colspan=6>
<style>
.tablerob{width: 200px;}
.tablerob td{text-align:center;}
</style>
<table class="tablerob">
<tr><th colspan=9>Nivel de Combustible</th></tr>
<tr>
<td><input type="radio" name="combustible" value="0" <?php echo $vfb_gas0; ?> >V</td>
<td><input type="radio" name="combustible" value="1" <?php echo $vfb_gas1; ?> >1/8</td>
<td><input type="radio" name="combustible" value="2" <?php echo $vfb_gas2; ?> >1/4</td>
<td><input type="radio" name="combustible" value="3" <?php echo $vfb_gas3; ?> >3/8</td>
<td><input type="radio" name="combustible" value="4" <?php echo $vfb_gas4; ?> >1/2</td>
<td><input type="radio" name="combustible" value="5" <?php echo $vfb_gas5; ?> >5/8</td>
<td><input type="radio" name="combustible" value="6" <?php echo $vfb_gas6; ?> >3/4</td>
<td><input type="radio" name="combustible" value="7" <?php echo $vfb_gas7; ?> >7/8</td>
<td><input type="radio" name="combustible" value="8" <?php echo $vfb_gas8; ?> >F</td>
</tr>
</table>
</td>


</tr>
</table>
<br>
<table>
<tr><th colspan=2>CONDICIONES EXTERIORES DEL VEHICULO</th></tr>
<tr>
<td>
<style>
.esquema{width:312px;height:146px;background-image: url('auto_.jpg');background-size:100%;}.esquema td{text-align:center;color:blue;font-weight:bold;font-size:1.5em;}
</style>
<table class="esquema">
<tr>
	<td><input type="checkbox" name="g1" value="1" <?php echo $vfb_g1; ?> >1</td>
	<td><input type="checkbox" name="g2" value="1" <?php echo $vfb_g2; ?> >2</td>
	<td><input type="checkbox" name="g3" value="1" <?php echo $vfb_g3; ?> >3</td>
	<td><input type="checkbox" name="g4" value="1" <?php echo $vfb_g4; ?> >4</td>
	<td><input type="checkbox" name="g5" value="1" <?php echo $vfb_g5; ?> >5</td>
	<td><input type="checkbox" name="g6" value="1" <?php echo $vfb_g6; ?> >6</td>
</tr>
<tr>
	<td><input type="checkbox" name="g7" value="1" <?php echo $vfb_g7; ?> >7</td>
	<td><input type="checkbox" name="g8" value="1" <?php echo $vfb_g8; ?> >8</td>
	<td><input type="checkbox" name="g9" value="1" <?php echo $vfb_g9; ?> >9</td>
	<td><input type="checkbox" name="g10" value="1" <?php echo $vfb_g10; ?> >10</td>
	<td><input type="checkbox" name="g11" value="1" <?php echo $vfb_g11; ?> >11</td>
	<td><input type="checkbox" name="g12" value="1" <?php echo $vfb_g12; ?> >12</td>
</tr>
<tr>
	<td><input type="checkbox" name="g13" value="1" <?php echo $vfb_g13; ?> >13</td>
	<td><input type="checkbox" name="g14" value="1" <?php echo $vfb_g14; ?> >14</td>
	<td><input type="checkbox" name="g15" value="1" <?php echo $vfb_g15; ?> >15</td>
	<td><input type="checkbox" name="g16" value="1" <?php echo $vfb_g16; ?> >16</td>
	<td><input type="checkbox" name="g17" value="1" <?php echo $vfb_g17; ?> >17</td>
	<td><input type="checkbox" name="g18" value="1" <?php echo $vfb_g18; ?> >18</td>
</tr>
</table>
</td>
<td>
<style>
.esquema2{width:600px;} .esquema2 input {width:100px; height:48px;} .esquema2 td {height:48px;} .esquema2 textarea{width:100px; height:48px;font-size:1.1em;}
</style>
<table class="esquema2">
<tr>
<td><textarea type="text" name="g1c" value="" placeholder = "1" ><?php echo $vfb_g1c; ?></textarea></td>
<td><textarea type="text" name="g2c" value="" placeholder="2" ><?php echo $vfb_g2c; ?></textarea></td>
<td><textarea type="text" name="g3c" value="" placeholder="3" ><?php echo $vfb_g3c; ?></textarea></td>
<td><textarea type="text" name="g4c" value="" placeholder="4" ><?php echo $vfb_g4c; ?></textarea></td>
<td><textarea type="text" name="g5c" value="" placeholder="5" ><?php echo $vfb_g5c; ?></textarea></td>
<td><textarea type="text" name="g6c" value="" placeholder="6" ><?php echo $vfb_g6c; ?></textarea></td>
</tr>
<tr>
<td><textarea type="text" name="g7c" value="" placeholder = "7" ><?php echo $vfb_g7c; ?></textarea></td>
<td><textarea type="text" name="g8c" value="" placeholder="8" ><?php echo $vfb_g8c; ?></textarea></td>
<td><textarea type="text" name="g9c" value="" placeholder="9" ><?php echo $vfb_g9c; ?></textarea></td>
<td><textarea type="text" name="g10c" value="" placeholder="10" ><?php echo $vfb_g10c; ?></textarea></td>
<td><textarea type="text" name="g11c" value="" placeholder="11" ><?php echo $vfb_g11c; ?></textarea></td>
<td><textarea type="text" name="g12c" value="" placeholder="12" ><?php echo $vfb_g12c; ?></textarea></td>
</tr>
<tr>
<td><textarea type="text" name="g13c" value="" placeholder= "13" ><?php echo $vfb_g13c; ?></textarea></td>
<td><textarea type="text" name="g14c" value="" placeholder="14" ><?php echo $vfb_g14c; ?></textarea></td>
<td><textarea type="text" name="g15c" value="" placeholder="15" ><?php echo $vfb_g15c; ?></textarea></td>
<td><textarea type="text" name="g16c" value="" placeholder="16" ><?php echo $vfb_g16c; ?></textarea></td>
<td><textarea type="text" name="g17c" value="" placeholder="17" ><?php echo $vfb_g17c; ?></textarea></td>
<td><textarea type="text" name="g18c" value="" placeholder="18" ><?php echo $vfb_g18c; ?></textarea></td>
</tr>
</table>
</td>
</tr>
</table>

<br>
<table>
<tr><th colspan=9>REVISION EXTERIOR DEL VEHICULO</th></tr>
<tr>
	<td>DEFENSA DELANTERA</td>
	<td><input type="radio" name="defensa_delantera" value="1" <?php echo $vfb_defensa_delantera; ?>  >Si</td>
	<td><input type="radio" name="defensa_delantera" value="0" <?php echo $vfb_defensa_delantera_no; ?> > No</td>
	<td>BRAZOS LIMPIADORES</td>
	<td><input type="radio" name="brazos_limpiadores" value="1"  <?php echo $vfb_brazos_limpiadores; ?>  >Si</td>
	<td><input type="radio" name="brazos_limpiadores" value="0" <?php echo $vfb_brazos_limpiadores_no; ?> > No</td>
	<td>TAPONES DE LLANTAS</td>
	<td><input type="radio" name="tapones_de_llantas" value="1"  <?php echo $vfb_tapones_de_llantas; ?>  >Si</td>
	<td><input type="radio" name="tapones_de_llantas" value="0" <?php echo $vfb_tapones_de_llantas_no; ?> > No</td>
</tr>
<tr>
	<td>DEFENSA TRASERA</td>
	<td><input type="radio" name="defensa_trasera" value="1" <?php echo $vfb_defensa_trasera; ?>   >Si</td>
	<td><input type="radio" name="defensa_trasera" value="0" <?php echo $vfb_defensa_trasera_no; ?> > No</td>
	<td>ESPEJOS LATERALES</td>
	<td><input type="radio" name="espejos_laterales" value="1" <?php echo $vfb_espejos_laterales; ?>   >Si</td>
	<td><input type="radio" name="espejos_laterales" value="0" <?php echo $vfb_espejos_laterales_no; ?> > No</td>
	<td>TAPON DE ACEITE</td>
	<td><input type="radio" name="tapon_de_aceite" value="1" <?php echo $vfb_tapon_de_aceite; ?>   >Si</td>
	<td><input type="radio" name="tapon_de_aceite" value="0" <?php echo $vfb_tapon_de_aceite_no; ?> > No</td>
</tr>
<tr>
	<td>PARABRISAS</td>
	<td><input type="radio" name="parabrisas" value="1" <?php echo $vfb_parabrisas; ?>   >Si</td>
	<td><input type="radio" name="parabrisas" value="0" <?php echo $vfb_parabrisas_no; ?> > No</td>
	<td>ANTENA</td>
	<td><input type="radio" name="antena" value="1" <?php echo $vfb_antena; ?>   >Si</td>
	<td><input type="radio" name="antena" value="0" <?php echo $vfb_antena_no; ?> > No</td>
	<td>TAPON DE AGUA</td>
	<td><input type="radio" name="tapon_de_agua" value="1" <?php echo $vfb_tapon_de_agua; ?>   >Si</td>
	<td><input type="radio" name="tapon_de_agua" value="0" <?php echo $vfb_tapon_de_agua_no; ?> > No</td>
</tr>
<tr>
	<td>MEDALLON</td>
	<td><input type="radio" name="medallon" value="1"  <?php echo $vfb_medallon; ?>  >Si</td>
	<td><input type="radio" name="medallon" value="0" <?php echo $vfb_medallon_no; ?> > No</td>
	<td>CALAVERAS</td>
	<td><input type="radio" name="calaveras" value="1"  <?php echo $vfb_calaveras; ?>  >Si</td>
	<td><input type="radio" name="calaveras" value="0" <?php echo $vfb_calaveras_no; ?> > No</td>
	<td>TAPON DE GASOLINA</td>
	<td><input type="radio" name="tapon_de_gasolina" value="1"  <?php echo $vfb_tapon_de_gasolina; ?>  >Si</td>
	<td><input type="radio" name="tapon_de_gasolina" value="0" <?php echo $vfb_tapon_de_gasolina_no; ?> > No</td>
</tr>
</table>
<br>
<table>
<tr><th colspan=9>REVISION INTERIOR DEL VEHICULO</th></tr>
<tr>
	<td>RADIO AM/FM</td>
	<td><input type="radio" name="radio_am_fm" value="1" <?php echo $vfb_radio_am_fm; ?>   >Si</td>
	<td><input type="radio" name="radio_am_fm" value="0" <?php echo $vfb_radio_am_fm_no; ?> > No</td>
	<td>GATO</td>
	<td><input type="radio" name="gato" value="1" <?php echo $vfb_gato; ?>   >Si</td>
	<td><input type="radio" name="gato" value="0" <?php echo $vfb_gato_no; ?> > No</td>
	<td>MARCA DE LLANTAS</td> 
	<td colspan =2><INPUT TYPE="text" NAME="marca_de_llantas" placeholder="marca de llantas" value="<?php echo $vfb_marca_de_llantas; ?>" ></td>
</tr>
<tr>
	<td>ELEVADORES</td>
	<td><input type="radio" name="elevadores" value="1" <?php echo $vfb_elevadores; ?>   >Si</td>
	<td><input type="radio" name="elevadores" value="0" <?php echo $vfb_elevadores_no; ?> > No</td>
	<td>LLAVE AUXILIAR</td>
	<td><input type="radio" name="llave_auxiliar" value="1" <?php echo $vfb_llave_auxiliar; ?>   >Si</td>
	<td><input type="radio" name="llave_auxiliar" value="0" <?php echo $vfb_llave_auxiliar_no; ?> > No</td>
	<td>DELANTERO DERECHO</td>
	<td><input type="radio" name="delantero_der" value="1" <?php echo $vfb_delantero_derecho; ?>   >Si</td>
	<td><input type="radio" name="delantero_der" value="0" <?php echo $vfb_delantero_derecho_no; ?> > No</td>
</tr>
<tr>
	<td>ESPEJO RETROVISOR</td>
	<td><input type="radio" name="espejo_retrovisor" value="1" <?php echo $vfb_espejo_retrovisor; ?>   >Si</td>
	<td><input type="radio" name="espejo_retrovisor" value="0" <?php echo $vfb_espejo_retrovisor_no; ?> > No</td>
	<td>SEÑAL DE CARRETERA</td>
	<td><input type="radio" name="senal_de_carretera" value="1" <?php echo $vfb_senal_de_carretera; ?>   >Si</td>
	<td><input type="radio" name="senal_de_carretera" value="0" <?php echo $vfb_senal_de_carretera_no; ?> > No</td>
	<td>DELANTERO IZQUIERDO</td>
	<td><input type="radio" name="delantero_izquierdo" value="1" <?php echo $vfb_delantero_izquierdo; ?>   >Si</td>
	<td><input type="radio" name="delantero_izquierdo" value="0" <?php echo $vfb_delantero_izquierdo_no; ?> > No</td>
</tr>
<tr>
	<td>A/C</td>
	<td><input type="radio" name="clima" value="1"  <?php echo $vfb_clima; ?>  >Si</td>
	<td><input type="radio" name="clima" value="0" <?php echo $vfb_clima_no; ?> > No</td>
	<td>HERRAMIENTA</td>
	<td><input type="radio" name="herramienta" value="1"  <?php echo $vfb_herramienta; ?>  >Si</td>
	<td><input type="radio" name="herramienta" value="0" <?php echo $vfb_herramienta_no; ?> > No</td>
	<td>TRASEROS DERECHA</td>
	<td><input type="radio" name="traseros_derecha" value="1" <?php echo $vfb_traseros_derecha; ?>   >1</td> <!-- VALORES ESPECIAL -->
	<td><input type="radio" name="traseros_derecha" value="2" <?php echo $vfb_traseros_derecha_2; ?> > 2</td> <!-- VALORES ESPECIAL -->
</tr>
<tr>
	<td>CINTURONES DE SEGURIDAD</td>
	<td><input type="radio" name="cinturones_de_seguridad" value="1"  <?php echo $vfb_cinturones_de_seguridad; ?>  >Si</td>
	<td><input type="radio" name="cinturones_de_seguridad" value="0" <?php echo $vfb_cinturones_de_seguridad_no; ?> > No</td>
	<td>EXTINGUIDOR</td>
	<td><input type="radio" name="extinguidor" value="1" <?php echo $vfb_extinguidor; ?>   >Si</td>
	<td><input type="radio" name="extinguidor" value="0" <?php echo $vfb_extinguidor_no; ?> > No</td>
	<td>TRASEROS IZQUIERDA</td>
	<td><input type="radio" name="traseros_izquierda" value="1" <?php echo $vfb_traseros_izquierda; ?>   >1</td> <!-- VALORES ESPECIAL -->
	<td><input type="radio" name="traseros_izquierda" value="2" <?php echo $vfb_traseros_izquierda_2; ?> > 2</td> <!-- VALORES ESPECIAL -->
</tr>
<tr>
	<td>TAPETE</td>
	<td><input type="radio" name="tapete" value="1"  <?php echo $vfb_tapete; ?>  >Si</td>
	<td><input type="radio" name="tapete" value="0" <?php echo $vfb_tapete_no; ?> > No</td>
	<td>CABLES PASA CORRIENTE</td>
	<td><input type="radio" name="cables_pasa_corriente" value="1" <?php echo $vfb_cables_pasa_corriente; ?>   >Si</td>
	<td><input type="radio" name="cables_pasa_corriente" value="0" <?php echo $vfb_cables_pasa_corriente_no; ?> > No</td>
	<td>REFACCION</td>
	<td><input type="radio" name="refaccion" value="1"  <?php echo $vfb_refaccion; ?>  >Si</td>
	<td><input type="radio" name="refaccion" value="0" <?php echo $vfb_refaccion_no; ?> > No</td>
</tr>
</table>
<br>
<table>

<tr><th colspan=6>MOTIVO ENTRADA / SALIDA DEL VEHICULO</th></tr>
<tr>

<script type="text/javascript">
function display_c(){
var refresh=1200000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)}
function display_ct() {
var strcount
var x = new Date()
var x1 = x.getHours( )+ ":" + x.getMinutes() + ":" + x.getSeconds();
document.getElementById('hora_actual').value = x1;
tt=display_c();
}
</script>

<td>HORA ENTRADA</td>
<td colspan=2 >
<INPUT TYPE="text" NAME="hora_entrada"  disabled value='<?php echo $vfb_hora_entrada; ?>' >
<INPUT TYPE="text" NAME="hora_entrada"  hidden value='<?php echo $vfb_hora_entrada; ?>' >
</td>

<td>HORA SALIDA</td>  <!-- SALIDA -->
<td colspan=2><INPUT TYPE="text" NAME="hora_salida" id='hora_actual' value='<?php echo $vfb_hora_salida; ?>'  ></td>
</tr>

<tr>
<td>MANTENIMIENTO</td>
<td>
<input type="radio" name="razonentrada" value="Mantenimiento"  disabled <?php echo $vfb_re_mtto; ?> >
<input type="radio" name="razonentrada" value="Mantenimiento"  hidden <?php echo $vfb_re_mtto; ?> >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td></td>
<td>ASIGNADO A PROYECTO</td> <!-- SALIDA SALIDA SALIDA -->
<td><input type="radio" name="razonsalida" value="Asignado a proyecto"  <?php echo $vfb_rs_aspr; ?>  >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td></td>
</tr>

<tr>
<td>RESGUARDO</td>
<td>
<input type="radio" name="razonentrada" value="Resguardo" disabled <?php echo $vfb_re_rsgd; ?> >
<input type="radio" name="razonentrada" value="Resguardo" hidden <?php echo $vfb_re_rsgd; ?> >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td></td>
<td>SUSTITUTO</td><td><input type="radio" name="razonsalida" value="Sustituto"  <?php echo $vfb_rs_sust; ?>  >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td> <INPUT TYPE="text" NAME="placasustituido" placeholder="placa unidad sustituida"  value="<?php echo $vfb_placasustituido; ?>"  > PLACAS base


</td> <!-- SALIDA SALIDA SALIDA -->
</tr>

<tr>
<td>REINGRESO</td>
<td>
<input type="radio" name="razonentrada" value="Reingreso" disabled <?php echo $vfb_re_rgrs; ?> >
<input type="radio" name="razonentrada" value="Reingreso" hidden <?php echo $vfb_re_rgrs; ?> >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td></td>
<td>CORTESIA</td>
<td><input type="radio" name="razonsalida" value="Cortesia" <?php echo $vfb_rs_cort; ?>   >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td>
<!--###################### FOLIO SUSTITUTO SALIDA ######################-->	  
<INPUT TYPE="number" NAME="id_sustS" placeholder="folio solicitud sustituto"  value="<?php echo $id_sust_pendiente; ?>"  > FOLIO sustituto S

</td>
</tr>

<tr>
<td>OTRO</td>
<td>
<input type="radio" name="razonentrada" value="Otro" disabled <?php echo $vfb_re_otro; ?> >
<input type="radio" name="razonentrada" value="Otro" hidden <?php echo $vfb_re_otro; ?> >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>
<INPUT TYPE="text" NAME="razonentradatexto" placeholder="otro" disabled value="<?php echo $vfb_razonentradatexto; ?>" >
<INPUT TYPE="text" NAME="razonentradatexto" placeholder="otro" hidden value="<?php echo $vfb_razonentradatexto; ?>" >
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>VENTA</td>
<td><input type="radio" name="razonsalida" value="Venta" <?php echo $vfb_rs_vnta; ?>   >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td></td>
</tr>
<tr>
<td>FUE SUSTITUTO</td>
<td><input type="radio" name="razonentrada" disabled value="Fue Sustituto" <?php echo $vfb_re_fue_sust; ?>  >Si
<input type="radio" name="razonentrada" hidden value="Fue Sustituto" <?php echo $vfb_re_fue_sust; ?>  disabled>


</td>
<td>
<!--##########################################################################################################################################3-->	
<input type="text" name="id_sustE" placeholder="folio solicitud sustituto"  value="<?php echo $vfb_id_sustE; ?>" disabled > FOLIO sustituto E


</td>
<td>RENTA DE PISO</td>
<td><input type="radio" name="razonsalida" value="Renta de piso"  <?php echo $vfb_rs_rnps; ?>  >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td></td>
</tr>
</table>
<br>

<table>
<tr><th colspan=4>DETALLE ENTRADA / SALIDA DEL VEHICULO</th></tr>
<tr>
<td>PROYECTO ORIGEN</td> 
<td>
<INPUT TYPE="text" NAME="proyecto_origen" placeholder="proyecto origen"   class='obs' disabled value="<?php echo $vfb_proyecto_origen; ?>" >
<INPUT TYPE="text" NAME="proyecto_origen" placeholder="proyecto origen"   class='obs' hidden value="<?php echo $vfb_proyecto_origen; ?>" >
</td> <!-- ENTRADA ENTRADA ENTRADA -->

<td>PROYECTO DESTINO</td> <td><INPUT TYPE="text" NAME="proyecto_destino" placeholder="proyecto destino"   class='obs'  value="<?php echo $vfb_proyecto_destino; ?>"  ></td> <!-- SALIDA -->
</tr>
<tr>
<td>UBICACIÓN ORIGEN</td> 
<td>
<INPUT TYPE="text" NAME="ubicacion_origen" placeholder="ubicación origen"   class='obs' disabled  value="<?php echo $vfb_ubicacion_origen; ?>" >
<INPUT TYPE="text" NAME="ubicacion_origen" placeholder="ubicación origen"   class='obs' hidden  value="<?php echo $vfb_ubicacion_origen; ?>" >
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>UBICACIÓN DESTINO</td> <td><INPUT TYPE="text" NAME="ubicacion_destino" placeholder="ubicación destino"   class='obs'   value="<?php echo $vfb_ubicacion_destino; ?>" ></td> <!-- SALIDA -->
</tr>
<tr>
<td>CONDUCTOR ENTRADA</td> 
<td>
<INPUT TYPE="text" NAME="conductor_entrada" placeholder="conductor entrada"   class='obs' disabled  value="<?php echo $vfb_conductor_entrada; ?>" >
<INPUT TYPE="text" NAME="conductor_entrada" placeholder="conductor entrada"   class='obs' hidden  value="<?php echo $vfb_conductor_entrada; ?>" >
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>CONDUCTOR SALIDA</td> <td><INPUT TYPE="text" NAME="conductor_salida" placeholder="conductor salida"   class='obs'  value="<?php echo $vfb_conductor_salida; ?>"  ></td> <!-- SALIDA -->
</tr>
<tr><td colspan=4>OBSERVACIONES</td></tr> 
<tr><td colspan=4><INPUT TYPE="textarea" NAME="observaciones" placeholder="observaciones" class='obs'  value="<?php echo $vfb_observaciones; ?>" ></td></tr>
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
<td><INPUT TYPE="text" NAME="solicito_unidad" placeholder="solicito unidad"  class='obs'  value="<?php echo $vfb_solicito_unidad; ?>"  ></td>
<td><INPUT TYPE="text" NAME="autoriza_salida" placeholder="autoriza salida"  class='obs'  value="<?php echo $vfb_autoriza_salida; ?>"  ></td>
<td><INPUT TYPE="text" NAME="recibe_unidad" placeholder="recibe unidad"  class='obs'  value="<?php echo $vfb_recibe_unidad; ?>"  ></td>
</tr>
</table>
<style>.nota {font-size:.7em;}</style>
<p class="nota">LA EMPRESA JET VAN CAR RENTAL, S.A. DE C.V., NO SE HACE RESPONSABLE POR OBJETOS EXTRAVIADOS O PERDIDOS</p>
<table><a onClick="javascript: return confirm('Confirma proceder a registrar la SALIDA'); " >
<input type="submit" name="submit" value="Generar">
</a></table>
</form>
<form action="registrofisico.php" ><input id="gobutton2" type="submit" name="Regresar" value="Regresar"></form>
</body>
</html>
<?php }; ?>