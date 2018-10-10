<?php session_start(); ?>
<?php include("seguridad.php"); ?>
<?php include("caducidad.php"); ?>
<meta charset='utf-8'>
<?php include_once ("base.inc.php"); ?>
<?php include_once("funcion.php"); ?>
<?php $insertado = ''; ?>

<?php
@$id_inventario = $_GET['id_inventario'];
@$numero_inventario = $_GET['numero_inventario'];

// VARIABLES DE FORMULARIO EN BLANCO
// VARIABLES DEFINIDAS PARA FORMULARIO EN BLANCO VFB 
$vfb_numero_inventario = 0;
$vfb_fecharecepcion = '';
$vfb_fechaentrega = '';
$vfb_marca = '';
$vfb_modelo = '';
$vfb_economico = '';
$vfb_color = '';
$vfb_tipo = '';
$vfb_placas = '';
$vfb_serie = '';

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
$vfb_id_sustS = '';

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

//OBTENCION DE VARIABLES DESDE INVENTARIO CAPTURADO Y ASIGNACION A VARIABLES DE FORMULARIO EN BLANCO
if(isset($id_inventario) && $id_inventario !== ''){
	global $conectar;
	$sql_obtener_formato = "SELECT * FROM `formato_inventario` WHERE `id_formato` = $id_inventario ORDER BY fechaentrega DESC LIMIT 1"; 
	$sql_formato = mysqli_query($dbd2, $sql_obtener_formato );

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
	
	$vfb_razonentrada = trim($row['razonentrada']);
	if(strpos($vfb_razonentrada, 'Mantenimiento') !== false){global $vfb_re_mtto; $vfb_re_mtto='checked';}
	if($vfb_razonentrada=='Resguardo'){$vfb_re_rsgd='checked';}
	if($vfb_razonentrada=='Reingreso'){$vfb_re_rgrs='checked';}
	if($vfb_razonentrada=='Otro'){$vfb_re_otro='checked';}
	if($vfb_razonentrada=='Fue Sustituto'){$vfb_re_fue_sust='checked';}

	$vfb_id_sustE = $row['id_sustE'];

	$vfb_id_sustS = $row['id_sustS'];
	}
}
else
{
	if(isset($uPlacas) && $uPlacas !== ''){
		datosporplaca($uPlacas);
		}
	elseif(isset($uNEco) && $uNEco !== ''){
		datosporeconomico($uNEco);
		}
	elseif(isset($uSerie) && $uSerie !== ''){
		datosporserie($uSerie);
	}
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

<?php 
//echo "<h1>$vfb_razonentrada</h1>" ;
//echo "<h1>$vfb_re_mtto</h1>";
//echo "<h1>$vfb_re_rsgd</h1>";
//echo "<h1>$vfb_re_rgrs</h1>";
//echo "<h1>$vfb_re_otro</h1>";
//echo "<h1>$vfb_re_fue_sust</h1>";
?>

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
				<tr><td class = "folio" id="folio">
				<INPUT TYPE="text" NAME="numero_inventario" placeholder="PROCESANDO" value="<?php echo $vfb_numero_inventario; ?>"  disabled ></td></tr>
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
<th> FECHA DE ENTREGA VEHICULO</th> <td><INPUT TYPE="text" NAME="fechaentrega" placeholder=" fecha "   value= "<?php echo $vfb_fechaentrega; ?>"   disabled ></td>
</tr>
</table>

<!-- AQUI VAN LOS VALORES PRINCIPALES  -->
<br>
<table>
<tr><th colspan=8>CARACTERISTICAS DEL VEHICULO</th></tr>
<tr>
<td>MARCA</td> <td><INPUT TYPE="text" NAME="marca"  placeholder="marca" value="<?php echo $vfb_marca; ?>"  disabled ></td>
<td>MODELO</td> <td><INPUT TYPE="text" NAME="modelo" placeholder="modelo"   value="<?php echo $vfb_modelo; ?><?php echo @$Modelo;?>"  disabled ></td>
<td>ECONOMICO</td> <td><INPUT TYPE="text" NAME="economico" placeholder="economico"   value="<?php echo $vfb_economico; ?><?php echo @$Economico;?>"  disabled ></td>
<td>COLOR</td> <td><INPUT TYPE="text" NAME="color" placeholder="color"   value="<?php echo $vfb_color; ?><?php echo @$Color;?>"  disabled ></td>
</tr>
<tr>
<td>TIPO</td> <td><INPUT TYPE="text" NAME="tipo" placeholder="tipo"   value="<?php echo $vfb_tipo; ?><?php echo @$Vehiculo;?>"  disabled ></td>
<td>PLACAS</td> <td><INPUT TYPE="text" NAME="placas" placeholder="placas"   value="<?php echo $vfb_placas; ?><?php echo @$Placas;?>"  disabled ></td>
<td>SERIE</td> <td colspan=3><INPUT TYPE="text" NAME="serie" placeholder="serie"   value="<?php echo $vfb_serie; ?><?php echo @$Serie;?>"  disabled ></td>
</tr>
</table>
<br>

<table>
<tr><th colspan=12>DOCUMENTOS DEL VEHICULO</th></tr>
<tr>
<td>POLIZA SEGURO</td>
<td><input type="radio" name="poliza" value="1" <?php echo $vfb_poliza; ?>  disabled >Si</td>
<td><input type="radio" name="poliza" value="0" <?php echo $vfb_poliza_no; ?> disabled > No</td>
<td>MANUAL USUARIO</td>
<td><input type="radio" name="manual" value="1" <?php echo $vfb_manual; ?>  disabled >Si</td>
<td><input type="radio" name="manual" value="0" <?php echo $vfb_manual_no; ?> disabled > No</td>
<td>TARJETACIRCULACION</td>
<td><input type="radio" name="tarjeta" value="1" <?php echo $vfb_tarjeta; ?>  disabled >Si</td>
<td><input type="radio" name="tarjeta" value="0" <?php echo $vfb_tarjeta_no; ?> disabled > No</td>
<td>POLIZA MTTO</td>
<td><input type="radio" name="poliza_mtto" value="1" <?php echo $vfb_poliza_mtto; ?>  disabled >Si</td>
<td><input type="radio" name="poliza_mtto" value="0" <?php echo $vfb_poliza_mtto_no; ?> disabled > No</td>
</tr>

<tr>
<td>KILOMETRAJE</td> 
<td colspan=5><INPUT TYPE="text" NAME="kilometraje" placeholder="kilometraje" value=0<?php echo $vfb_kilometraje; ?>  disabled ></td>

<td colspan=6>
<style>
.tablerob{width: 200px;}
.tablerob td{text-align:center;}
</style>
<table class="tablerob">
<tr><th colspan=9>Nivel de Combustible</th></tr>
<tr>
<td><input type="radio" name="combustible" value="0" <?php echo $vfb_gas0; ?>  disabled >V</td>
<td><input type="radio" name="combustible" value="1" <?php echo $vfb_gas1; ?>  disabled >1/8</td>
<td><input type="radio" name="combustible" value="2" <?php echo $vfb_gas2; ?>  disabled >1/4</td>
<td><input type="radio" name="combustible" value="3" <?php echo $vfb_gas3; ?>  disabled >3/8</td>
<td><input type="radio" name="combustible" value="4" <?php echo $vfb_gas4; ?>  disabled >1/2</td>
<td><input type="radio" name="combustible" value="5" <?php echo $vfb_gas5; ?>  disabled >5/8</td>
<td><input type="radio" name="combustible" value="6" <?php echo $vfb_gas6; ?>  disabled >3/4</td>
<td><input type="radio" name="combustible" value="7" <?php echo $vfb_gas7; ?>  disabled >7/8</td>
<td><input type="radio" name="combustible" value="8" <?php echo $vfb_gas8; ?>  disabled >F</td>
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
	<td><input type="checkbox" name="g1" value="1" <?php echo $vfb_g1; ?>  disabled >1</td>
	<td><input type="checkbox" name="g2" value="1" <?php echo $vfb_g2; ?>  disabled >2</td>
	<td><input type="checkbox" name="g3" value="1" <?php echo $vfb_g3; ?>  disabled >3</td>
	<td><input type="checkbox" name="g4" value="1" <?php echo $vfb_g4; ?>  disabled >4</td>
	<td><input type="checkbox" name="g5" value="1" <?php echo $vfb_g5; ?>  disabled >5</td>
	<td><input type="checkbox" name="g6" value="1" <?php echo $vfb_g6; ?>  disabled >6</td>
</tr>
<tr>
	<td><input type="checkbox" name="g7" value="1" <?php echo $vfb_g7; ?>  disabled >7</td>
	<td><input type="checkbox" name="g8" value="1" <?php echo $vfb_g8; ?>  disabled >8</td>
	<td><input type="checkbox" name="g9" value="1" <?php echo $vfb_g9; ?>  disabled >9</td>
	<td><input type="checkbox" name="g10" value="1" <?php echo $vfb_g10; ?> disabled  >10</td>
	<td><input type="checkbox" name="g11" value="1" <?php echo $vfb_g11; ?>  disabled >11</td>
	<td><input type="checkbox" name="g12" value="1" <?php echo $vfb_g12; ?>  disabled >12</td>
</tr>
<tr>
	<td><input type="checkbox" name="g13" value="1" <?php echo $vfb_g13; ?>  disabled >13</td>
	<td><input type="checkbox" name="g14" value="1" <?php echo $vfb_g14; ?>  disabled >14</td>
	<td><input type="checkbox" name="g15" value="1" <?php echo $vfb_g15; ?>  disabled >15</td>
	<td><input type="checkbox" name="g16" value="1" <?php echo $vfb_g16; ?>  disabled >16</td>
	<td><input type="checkbox" name="g17" value="1" <?php echo $vfb_g17; ?>  disabled >17</td>
	<td><input type="checkbox" name="g18" value="1" <?php echo $vfb_g18; ?>  disabled >18</td>
</tr>
</table>
</td>
<td>
<style>
.esquema2{width:600px;} .esquema2 input {width:100px; height:48px;} .esquema2 td {height:48px;} .esquema2 textarea{width:100px; height:48px;font-size:1.1em;}
</style>
<table class="esquema2">
<tr>
<td><textarea type="text" name="g1c" value="" placeholder = "1"  disabled ><?php echo $vfb_g1c; ?></textarea></td>
<td><textarea type="text" name="g2c" value="" placeholder="2"  disabled ><?php echo $vfb_g2c; ?></textarea></td>
<td><textarea type="text" name="g3c" value="" placeholder="3"  disabled ><?php echo $vfb_g3c; ?></textarea></td>
<td><textarea type="text" name="g4c" value="" placeholder="4"  disabled ><?php echo $vfb_g4c; ?></textarea></td>
<td><textarea type="text" name="g5c" value="" placeholder="5"  disabled ><?php echo $vfb_g5c; ?></textarea></td>
<td><textarea type="text" name="g6c" value="" placeholder="6" disabled ><?php echo $vfb_g6c; ?></textarea></td>
</tr>
<tr>
<td><textarea type="text" name="g7c" value="" placeholder = "7"  disabled ><?php echo $vfb_g7c; ?></textarea></td>
<td><textarea type="text" name="g8c" value="" placeholder="8"  disabled ><?php echo $vfb_g8c; ?></textarea></td>
<td><textarea type="text" name="g9c" value="" placeholder="9"  disabled ><?php echo $vfb_g9c; ?></textarea></td>
<td><textarea type="text" name="g10c" value="" placeholder="10"  disabled ><?php echo $vfb_g10c; ?></textarea></td>
<td><textarea type="text" name="g11c" value="" placeholder="11"  disabled ><?php echo $vfb_g11c; ?></textarea></td>
<td><textarea type="text" name="g12c" value="" placeholder="12"  disabled ><?php echo $vfb_g12c; ?></textarea></td>
</tr>
<tr>
<td><textarea type="text" name="g13c" value="" placeholder= "13"  disabled ><?php echo $vfb_g13c; ?></textarea></td>
<td><textarea type="text" name="g14c" value="" placeholder="14"  disabled ><?php echo $vfb_g14c; ?></textarea></td>
<td><textarea type="text" name="g15c" value="" placeholder="15"  disabled ><?php echo $vfb_g15c; ?></textarea></td>
<td><textarea type="text" name="g16c" value="" placeholder="16"  disabled ><?php echo $vfb_g16c; ?></textarea></td>
<td><textarea type="text" name="g17c" value="" placeholder="17"  disabled ><?php echo $vfb_g17c; ?></textarea></td>
<td><textarea type="text" name="g18c" value="" placeholder="18"  disabled ><?php echo $vfb_g18c; ?></textarea></td>
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
	<td><input type="radio" name="defensa_delantera" value="1" <?php echo $vfb_defensa_delantera; ?>   disabled >Si</td>
	<td><input type="radio" name="defensa_delantera" value="0" <?php echo $vfb_defensa_delantera_no; ?>  disabled > No</td>
	<td>BRAZOS LIMPIADORES</td>
	<td><input type="radio" name="brazos_limpiadores" value="1"  <?php echo $vfb_brazos_limpiadores; ?>   disabled >Si</td>
	<td><input type="radio" name="brazos_limpiadores" value="0" <?php echo $vfb_brazos_limpiadores_no; ?>  disabled > No</td>
	<td>TAPONES DE LLANTAS</td>
	<td><input type="radio" name="tapones_de_llantas" value="1"  <?php echo $vfb_tapones_de_llantas; ?>   disabled >Si</td>
	<td><input type="radio" name="tapones_de_llantas" value="0" <?php echo $vfb_tapones_de_llantas_no; ?>  disabled > No</td>
</tr>
<tr>
	<td>DEFENSA TRASERA</td>
	<td><input type="radio" name="defensa_trasera" value="1" <?php echo $vfb_defensa_trasera; ?>    disabled >Si</td>
	<td><input type="radio" name="defensa_trasera" value="0" <?php echo $vfb_defensa_trasera_no; ?>  disabled > No</td>
	<td>ESPEJOS LATERALES</td>
	<td><input type="radio" name="espejos_laterales" value="1" <?php echo $vfb_espejos_laterales; ?>    disabled >Si</td>
	<td><input type="radio" name="espejos_laterales" value="0" <?php echo $vfb_espejos_laterales_no; ?>  disabled > No</td>
	<td>TAPON DE ACEITE</td>
	<td><input type="radio" name="tapon_de_aceite" value="1" <?php echo $vfb_tapon_de_aceite; ?>    disabled >Si</td>
	<td><input type="radio" name="tapon_de_aceite" value="0" <?php echo $vfb_tapon_de_aceite_no; ?>  disabled > No</td>
</tr>
<tr>
	<td>PARABRISAS</td>
	<td><input type="radio" name="parabrisas" value="1" <?php echo $vfb_parabrisas; ?>    disabled >Si</td>
	<td><input type="radio" name="parabrisas" value="0" <?php echo $vfb_parabrisas_no; ?>  disabled > No</td>
	<td>ANTENA</td>
	<td><input type="radio" name="antena" value="1" <?php echo $vfb_antena; ?>    disabled >Si</td>
	<td><input type="radio" name="antena" value="0" <?php echo $vfb_antena_no; ?>  disabled > No</td>
	<td>TAPON DE AGUA</td>
	<td><input type="radio" name="tapon_de_agua" value="1" <?php echo $vfb_tapon_de_agua; ?>    disabled >Si</td>
	<td><input type="radio" name="tapon_de_agua" value="0" <?php echo $vfb_tapon_de_agua_no; ?>  disabled > No</td>
</tr>
<tr>
	<td>MEDALLON</td>
	<td><input type="radio" name="medallon" value="1"  <?php echo $vfb_medallon; ?>   disabled >Si</td>
	<td><input type="radio" name="medallon" value="0" <?php echo $vfb_medallon_no; ?>  disabled > No</td>
	<td>CALAVERAS</td>
	<td><input type="radio" name="calaveras" value="1"  <?php echo $vfb_calaveras; ?>   disabled >Si</td>
	<td><input type="radio" name="calaveras" value="0" <?php echo $vfb_calaveras_no; ?>  disabled > No</td>
	<td>TAPON DE GASOLINA</td>
	<td><input type="radio" name="tapon_de_gasolina" value="1"  <?php echo $vfb_tapon_de_gasolina; ?>   disabled >Si</td>
	<td><input type="radio" name="tapon_de_gasolina" value="0" <?php echo $vfb_tapon_de_gasolina_no; ?>  disabled > No</td>
</tr>
</table>
<br>
<table>
<tr><th colspan=9>REVISION INTERIOR DEL VEHICULO</th></tr>
<tr>
	<td>RADIO AM/FM</td>
	<td><input type="radio" name="radio_am_fm" value="1" <?php echo $vfb_radio_am_fm; ?>    disabled >Si</td>
	<td><input type="radio" name="radio_am_fm" value="0" <?php echo $vfb_radio_am_fm_no; ?>  disabled > No</td>
	<td>GATO</td>
	<td><input type="radio" name="gato" value="1" <?php echo $vfb_gato; ?>    disabled >Si</td>
	<td><input type="radio" name="gato" value="0" <?php echo $vfb_gato_no; ?>  disabled > No</td>
	<td>MARCA DE LLANTAS</td> 
	<td colspan =2><INPUT TYPE="text" NAME="marca_de_llantas" placeholder="marca de llantas" value="<?php echo $vfb_marca_de_llantas; ?>"  disabled ></td>
</tr>
<tr>
	<td>ELEVADORES</td>
	<td><input type="radio" name="elevadores" value="1" <?php echo $vfb_elevadores; ?>    disabled >Si</td>
	<td><input type="radio" name="elevadores" value="0" <?php echo $vfb_elevadores_no; ?>  disabled > No</td>
	<td>LLAVE AUXILIAR</td>
	<td><input type="radio" name="llave_auxiliar" value="1" <?php echo $vfb_llave_auxiliar; ?>    disabled >Si</td>
	<td><input type="radio" name="llave_auxiliar" value="0" <?php echo $vfb_llave_auxiliar_no; ?>  disabled > No</td>
	<td>DELANTERO DERECHO</td>
	<td><input type="radio" name="delantero_der" value="1" <?php echo $vfb_delantero_derecho; ?>    disabled >Si</td>
	<td><input type="radio" name="delantero_der" value="0" <?php echo $vfb_delantero_derecho_no; ?>  disabled > No</td>
</tr>
<tr>
	<td>ESPEJO RETROVISOR</td>
	<td><input type="radio" name="espejo_retrovisor" value="1" <?php echo $vfb_espejo_retrovisor; ?>    disabled >Si</td>
	<td><input type="radio" name="espejo_retrovisor" value="0" <?php echo $vfb_espejo_retrovisor_no; ?>  disabled > No</td>
	<td>SEÑAL DE CARRETERA</td>
	<td><input type="radio" name="senal_de_carretera" value="1" <?php echo $vfb_senal_de_carretera; ?>    disabled >Si</td>
	<td><input type="radio" name="senal_de_carretera" value="0" <?php echo $vfb_senal_de_carretera_no; ?>  disabled > No</td>
	<td>DELANTERO IZQUIERDO</td>
	<td><input type="radio" name="delantero_izquierdo" value="1" <?php echo $vfb_delantero_izquierdo; ?>    disabled >Si</td>
	<td><input type="radio" name="delantero_izquierdo" value="0" <?php echo $vfb_delantero_izquierdo_no; ?>  disabled > No</td>
</tr>
<tr>
	<td>A/C</td>
	<td><input type="radio" name="clima" value="1"  <?php echo $vfb_clima; ?>   disabled >Si</td>
	<td><input type="radio" name="clima" value="0" <?php echo $vfb_clima_no; ?>  disabled > No</td>
	<td>HERRAMIENTA</td>
	<td><input type="radio" name="herramienta" value="1"  <?php echo $vfb_herramienta; ?>   disabled >Si</td>
	<td><input type="radio" name="herramienta" value="0" <?php echo $vfb_herramienta_no; ?>  disabled > No</td>
	<td>TRASEROS DERECHA</td>
	<td><input type="radio" name="traseros_derecha" value="1" <?php echo $vfb_traseros_derecha; ?>    disabled >1</td> <!-- VALORES ESPECIAL -->
	<td><input type="radio" name="traseros_derecha" value="2" <?php echo $vfb_traseros_derecha_2; ?>  disabled > 2</td> <!-- VALORES ESPECIAL -->
</tr>
<tr>
	<td>CINTURONES DE SEGURIDAD</td>
	<td><input type="radio" name="cinturones_de_seguridad" value="1"  <?php echo $vfb_cinturones_de_seguridad; ?>   disabled >Si</td>
	<td><input type="radio" name="cinturones_de_seguridad" value="0" <?php echo $vfb_cinturones_de_seguridad_no; ?>  disabled > No</td>
	<td>EXTINGUIDOR</td>
	<td><input type="radio" name="extinguidor" value="1" <?php echo $vfb_extinguidor; ?>    disabled >Si</td>
	<td><input type="radio" name="extinguidor" value="0" <?php echo $vfb_extinguidor_no; ?>  disabled > No</td>
	<td>TRASEROS IZQUIERDA</td>
	<td><input type="radio" name="traseros_izquierda" value="1" <?php echo $vfb_traseros_izquierda; ?>    disabled >1</td> <!-- VALORES ESPECIAL -->
	<td><input type="radio" name="traseros_izquierda" value="2" <?php echo $vfb_traseros_izquierda_2; ?>  disabled > 2</td> <!-- VALORES ESPECIAL -->
</tr>
<tr>
	<td>TAPETE</td>
	<td><input type="radio" name="tapete" value="1"  <?php echo $vfb_tapete; ?>   disabled >Si</td>
	<td><input type="radio" name="tapete" value="0" <?php echo $vfb_tapete_no; ?>  disabled > No</td>
	<td>CABLES PASA CORRIENTE</td>
	<td><input type="radio" name="cables_pasa_corriente" value="1" <?php echo $vfb_cables_pasa_corriente; ?>    disabled >Si</td>
	<td><input type="radio" name="cables_pasa_corriente" value="0" <?php echo $vfb_cables_pasa_corriente_no; ?>  disabled > No</td>
	<td>REFACCION</td>
	<td><input type="radio" name="refaccion" value="1"  <?php echo $vfb_refaccion; ?>   disabled >Si</td>
	<td><input type="radio" name="refaccion" value="0" <?php echo $vfb_refaccion_no; ?>  disabled > No</td>
</tr>
</table>
<br>
<table>

<tr><th colspan=6>MOTIVO ENTRADA / SALIDA DEL VEHICULO</th></tr>
<tr>

<script type="text/javascript">
// function display_c(){
// var refresh=1000; // Refresh rate in milli seconds
// mytime=setTimeout('display_ct()',refresh)}
// function display_ct() {
// var strcount
// var x = new Date()
// var x1 = x.getHours( )+ ":" + x.getMinutes() + ":" + x.getSeconds();
// document.getElementById('hora_actual').value = x1;
// tt=display_c();
// }
</script>

<td>HORA ENTRADA</td>
<td colspan=2 >
<INPUT TYPE="text" NAME="hora_entrada"   value='<?php echo $vfb_hora_entrada; ?>'  disabled >
</td>

<td>HORA SALIDA</td>  <!-- SALIDA -->
<td colspan=2><INPUT TYPE="text" NAME="hora_salida" id='hora_actual' value='<?php echo $vfb_hora_salida; ?>'  disabled  ></td>
</tr>

<tr>
<td>MANTENIMIENTO</td>
<td>
<input type="radio" name="razonentrada" value="Mantenimiento"   <?php echo $vfb_re_mtto; ?>  disabled >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td></td>
<td>ASIGNADO A PROYECTO</td> <!-- SALIDA SALIDA SALIDA -->
<td><input type="radio" name="razonsalida" value="Asignado a proyecto"  <?php echo $vfb_rs_aspr; ?>   disabled >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td></td>
</tr>

<tr>
<td>RESGUARDO</td>
<td>
<input type="radio" name="razonentrada" value="Resguardo" disabled <?php echo $vfb_re_rsgd; ?>  disabled >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td></td>
<td>SUSTITUTO</td>
<td><input type="radio" name="razonsalida" value="Sustituto"  <?php echo $vfb_rs_sust; ?>   disabled >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td><INPUT TYPE="text" NAME="placasustituido" placeholder="placa unidad sustituida"  value="<?php echo $vfb_placasustituido; ?>"   disabled ></td> <!-- SALIDA SALIDA SALIDA -->
</tr>

<tr>
<td>REINGRESO</td>
<td>
<input type="radio" name="razonentrada" value="Reingreso" disabled <?php echo $vfb_re_rgrs; ?>  disabled >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td></td>
<td>CORTESIA</td>
<td><input type="radio" name="razonsalida" value="Cortesia" <?php echo $vfb_rs_cort; ?>   disabled  >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td>
	<!--###################### FOLIO SUSTITUTO SALIDA ######################-->	  
<INPUT TYPE="number" NAME="id_sustS" placeholder="folio solicitud sustituto"  value="<?php echo $vfb_id_sustS; ?>"  disabled > FOLIO sustituto S

</td>
</tr>

<tr>
<td>OTRO</td>
<td>
<input type="radio" name="razonentrada" value="Otro" disabled <?php echo $vfb_re_otro; ?>  disabled >
Si
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>
<INPUT TYPE="text" NAME="razonentradatexto" placeholder="otro" disabled value="<?php echo $vfb_razonentradatexto; ?>"  disabled >
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>VENTA</td>
<td><input type="radio" name="razonsalida" value="Venta" <?php echo $vfb_rs_vnta; ?>    disabled >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td></td>
</tr>
<tr>

<td>FUE SUSTITUTO</td>
<td>
<input type="radio" name="razonentrada" disabled value="Fue Sustituto" <?php echo $vfb_re_fue_sust; ?>  >Si

</td>
<td>
<!--##########################################################################################################################################3-->	
<input type="text" name="id_sustE" placeholder="folio solicitud sustituto"  value="<?php echo $vfb_id_sustE; ?>" disabled > FOLIO sustituto E


</td>

<td>RENTA DE PISO</td>
<td><input type="radio" name="razonsalida" value="Renta de piso"  <?php echo $vfb_rs_rnps; ?>   disabled >Si</td> <!-- SALIDA SALIDA SALIDA -->
<td></td>
</tr>
</table>
<br>

<table>
<tr><th colspan=4>DETALLE ENTRADA / SALIDA DEL VEHICULO</th></tr>
<tr>
<td>PROYECTO ORIGEN</td> 
<td>
<INPUT TYPE="text" NAME="proyecto_origen" placeholder="proyecto origen"   class='obs' disabled value="<?php echo $vfb_proyecto_origen; ?>"  disabled >
<INPUT TYPE="text" NAME="proyecto_origen" placeholder="proyecto origen"   class='obs' hidden value="<?php echo $vfb_proyecto_origen; ?>"  disabled >
</td> <!-- ENTRADA ENTRADA ENTRADA -->

<td>PROYECTO DESTINO</td> <td><INPUT TYPE="text" NAME="proyecto_destino" placeholder="proyecto destino"   class='obs'  value="<?php echo $vfb_proyecto_destino; ?>"   disabled ></td> <!-- SALIDA -->
</tr>
<tr>
<td>UBICACIÓN ORIGEN</td> 
<td>
<INPUT TYPE="text" NAME="ubicacion_origen" placeholder="ubicación origen"   class='obs' disabled  value="<?php echo $vfb_ubicacion_origen; ?>"  disabled >
<INPUT TYPE="text" NAME="ubicacion_origen" placeholder="ubicación origen"   class='obs' hidden  value="<?php echo $vfb_ubicacion_origen; ?>"  disabled >
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>UBICACIÓN DESTINO</td> <td><INPUT TYPE="text" NAME="ubicacion_destino" placeholder="ubicación destino"   class='obs'   value="<?php echo $vfb_ubicacion_destino; ?>"  disabled ></td> <!-- SALIDA -->
</tr>
<tr>
<td>CONDUCTOR ENTRADA</td> 
<td>
<INPUT TYPE="text" NAME="conductor_entrada" placeholder="conductor entrada"   class='obs' disabled  value="<?php echo $vfb_conductor_entrada; ?>"  disabled >
<INPUT TYPE="text" NAME="conductor_entrada" placeholder="conductor entrada"   class='obs' hidden  value="<?php echo $vfb_conductor_entrada; ?>"  disabled >
</td> <!-- ENTRADA ENTRADA ENTRADA -->
<td>CONDUCTOR SALIDA</td> <td><INPUT TYPE="text" NAME="conductor_salida" placeholder="conductor salida"   class='obs'  value="<?php echo $vfb_conductor_salida; ?>"   disabled ></td> <!-- SALIDA -->
</tr>
<tr><td colspan=4>OBSERVACIONES</td></tr> 
<tr><td colspan=4><INPUT TYPE="textarea" NAME="observaciones" placeholder="observaciones" class='obs'  value="<?php echo $vfb_observaciones; ?>"  disabled ></td></tr>
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
<td><INPUT TYPE="text" NAME="realizo_inventario" placeholder="realizo inventario"  class='obs' value='<?php echo $vfb_realizo_inventario; ?>' disabled ></td>
<td><INPUT TYPE="text" NAME="solicito_unidad" placeholder="solicito unidad"  class='obs'  value="<?php echo $vfb_solicito_unidad; ?>"   disabled ></td>
<td><INPUT TYPE="text" NAME="autoriza_salida" placeholder="autoriza salida"  class='obs'  value="<?php echo $vfb_autoriza_salida; ?>"   disabled ></td>
<td><INPUT TYPE="text" NAME="recibe_unidad" placeholder="recibe unidad"  class='obs'  value="<?php echo $vfb_recibe_unidad; ?>"   disabled ></td>
</tr>
</table>
<style>.nota {font-size:.7em;}</style>
<p class="nota">LA EMPRESA JET VAN CAR RENTAL, S.A. DE C.V., NO SE HACE RESPONSABLE POR OBJETOS EXTRAVIADOS O PERDIDOS</p>

<!--
<table>
<a onClick="javascript: return confirm('Confirma proceder a registrar la SALIDA'); " >
<input type="submit" name="submit" value="Generar">
</a>
</table>
-->

</form>

<form action="registrofisico.php" ><input id="gobutton2" type="submit" name="Regresar" value="Regresar"></form>
</body>
</html>
<?php }; ?>