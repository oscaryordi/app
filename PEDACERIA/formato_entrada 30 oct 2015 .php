<?php session_start(); ?>
<?php include("seguridad.php"); ?>
<?php include("caducidad.php"); ?>
<meta charset='utf-8'>
<?php 
include ("base.inc.php");
include("funcion.php");
?>

<?php 
if(isset($_POST['submit'])){
	foreach ($_POST as $key => $entry)
	{
	print $key . ": " . $entry . "<br>";
	}
	
// PREPARAR CODIGO PARA INSERCION	

// TEXTO TIEMPO Y DIFERENTES DE 1 Y 0
echo $numero_inventario = $_POST['numero_inventario'];
echo $fecharecepcion = $_POST['fecharecepcion'];
echo $marca = $_POST['marca'];
echo $modelo = $_POST['modelo'];
echo $economico = $_POST['economico'];
echo $color = $_POST['color'];
echo $tipo = $_POST['tipo'];
echo $placas = $_POST['placas'];
echo $serie = $_POST['serie'];
echo $kilometraje = $_POST['kilometraje'];
echo $combustible = $_POST['combustible'];
echo $hora_entrada = $_POST['hora_entrada'];
echo $razonentrada = $_POST['razonentrada'];
echo $razonentradatexto = $_POST['razonentradatexto'];
echo $proyecto_origen = $_POST['proyecto_origen'];
echo $proyecto_destino = 'JETVAN TEMPORAL';  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
echo $ubicacion_origen = $_POST['ubicacion_origen'];
echo $ubicacion_destino = 'CALZADA MEXICO - TACUBA';  // FORMATO SALIDA // A LA ENTRADA JETVAN TEMPORAL
echo $conductor_entrada = $_POST['conductor_entrada'];  
echo $observaciones = $_POST['observaciones'];
echo $realizo_inventario = $_POST['realizo_inventario'];
echo $marca_de_llantas = $_POST['marca_de_llantas'];
echo $traseros_derecha = $_POST['traseros_derecha'];
echo $traseros_izquierda = $_POST['traseros_izquierda'];

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
$fecharecepcion, 
$marca, 
$modelo, 
$economico, 
$color, 
$tipo, 
$placas, 
$serie, 
$kilometraje, 
$combustible, 
$hora_entrada, 
$razonentrada, 
$razonentradatexto, 
$proyecto_origen, 
$proyecto_destino, 
$ubicacion_origen, 
$ubicacion_destino, 
$conductor_entrada, 
$observaciones, 
$realizo_inventario, 
$marca_de_llantas, 
$traseros_derecha, 
$traseros_izquierda,
";

echo '<br><br><br>'.$sql_campos.'<br><br><br>';
echo $sql_valores.'<br><br><br>';

// SEUDO BOLEANOS 1 Y 0, SI/NO
// PREDETERMINADO SI UNO 1
echo $poliza = $_POST['poliza'];

if($poliza == 0){
	global $sql_campos;
	global $sql_valores;
	$sql_campos.= ' poliza, ';
	$sql_valores.= " $poliza, ";
}

echo '<br><br><br>'.$sql_campos.'<br><br><br>';
echo $sql_valores.'<br><br><br>';


echo $manual = $_POST['manual'];
echo $tarjeta = $_POST['tarjeta'];
echo $poliza_mtto = $_POST['poliza_mtto'];
echo $defensa_delantera = $_POST['defensa_delantera'];
echo $brazos_limpiadores = $_POST['brazos_limpiadores'];
echo $tapones_de_llantas = $_POST['tapones_de_llantas'];
echo $defensa_trasera = $_POST['defensa_trasera'];
echo $espejos_laterales = $_POST['espejos_laterales'];
echo $tapon_de_aceite = $_POST['tapon_de_aceite'];
echo $parabrisas = $_POST['parabrisas'];
echo $antena = $_POST['antena'];
echo $tapon_de_agua = $_POST['tapon_de_agua'];
echo $medallon = $_POST['medallon'];
echo $calaveras = $_POST['calaveras'];
echo $tapon_de_gasolina = $_POST['tapon_de_gasolina'];
echo $radio_am_fm = $_POST['radio_am_fm'];
echo $gato = $_POST['gato'];
echo $elevadores = $_POST['elevadores'];
echo $llave_auxiliar = $_POST['llave_auxiliar'];
echo $delantero_derecho = $_POST['delantero_derecho'];
echo $espejo_retrovisor = $_POST['espejo_retrovisor'];
echo $senal_de_carretera = $_POST['senal_de_carretera'];
echo $delantero_izquierdo = $_POST['delantero_izquierdo'];
echo $clima = $_POST['clima'];
echo $herramienta = $_POST['herramienta'];
echo $cinturones_de_seguridad = $_POST['cinturones_de_seguridad'];
echo $extinguidor = $_POST['extinguidor'];
echo $tapete = $_POST['tapete'];
echo $cables_pasa_corriente = $_POST['cables_pasa_corriente'];
echo $refaccion = $_POST['refaccion'];

// PREDETERMINADO CERO 0
echo $g1 = $_POST['g1'];
echo $g2 = $_POST['g2'];
echo $g3 = $_POST['g3'];
echo $g4 = $_POST['g4'];
echo $g5 = $_POST['g5'];
echo $g6 = $_POST['g6'];
echo $g7 = $_POST['g7'];
echo $g8 = $_POST['g8'];
echo $g9 = $_POST['g9'];
echo $g10 = $_POST['g10'];
echo $g11 = $_POST['g11'];
echo $g12 = $_POST['g12'];
echo $g13 = $_POST['g13'];
echo $g14 = $_POST['g14'];
echo $g15 = $_POST['g15'];
echo $g16 = $_POST['g16'];
echo $g17 = $_POST['g17'];
echo $g18 = $_POST['g18'];

// COMENTARIO GOLPES
echo $g1c = $_POST['g1c'];
echo $g2c = $_POST['g2c'];
echo $g3c = $_POST['g3c'];
echo $g4c = $_POST['g4c'];
echo $g5c = $_POST['g5c'];
echo $g6c = $_POST['g6c'];
echo $g7c = $_POST['g7c'];
echo $g8c = $_POST['g8c'];
echo $g9c = $_POST['g9c'];
echo $g10c = $_POST['g10c'];
echo $g11c = $_POST['g11c'];
echo $g12c = $_POST['g12c'];
echo $g13c = $_POST['g13c'];
echo $g14c = $_POST['g14c'];
echo $g15c = $_POST['g15c'];
echo $g16c = $_POST['g16c'];
echo $g17c = $_POST['g17c'];
echo $g18c = $_POST['g18c'];

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
<td colspan=5><INPUT TYPE="text" NAME="kilometraje" placeholder="kilometraje"  ></td>

<td colspan=6>
<style>
.tablerob{width: 200px;}
.tablerob td{text-align:center;}
</style>
<table class="tablerob">
<tr><th colspan=9>Nivel de Combustible</th></tr>
<tr>
<td><input type="radio" name="combustible" value="0">V</td>
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
<td>TAPONES DE LLANTAS</td><td><input type="radio" name="tapones_de_llantas" value="1" checked >Si</td><td><input type="radio" name="tapones_de_llantas" value="0" > No</td>
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
<td>DELANTERO DERECHO</td><td><input type="radio" name="delantero_derecho" value="1" checked >Si</td><td><input type="radio" name="delantero_derecho" value="0" > No</td>
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
<td>TAPETE</td><td><input type="radio" name="tapete" value="1" checked >Si</td><td><input type="radio" name="tapete" value="0" > No</td>
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
<!-- <td colspan=2 ><INPUT TYPE="text" NAME="hora_entrada" value="<?php echo date("H:m:s");?>" ></td> -->

<td>HORA SALIDA</td>  <!-- SALIDA -->
<td colspan=2><INPUT TYPE="text" NAME="hora_salida" value="" disabled  ></td>
</tr>

<tr>
<td>MANTENIMIENTO</td>
<td><input type="radio" name="razonentrada" value="mantenimiento" checked >Si</td>
<td></td>
<td>ASIGNADO A PROYECTO</td> <!-- SALIDA -->
<td><input type="radio" name="razonsalida" value="asignado a proyecto"  disabled  >Si</td>
<td></td>
</tr>

<tr>
<td>RESGUARDO</td>
<td><input type="radio" name="razonentrada" value="resguardo"  >Si</td>
<td></td>
<td>SUSTITUTO</td><td><input type="radio" name="razonsalida" value="sustituto"  disabled  >Si</td> <!-- SALIDA -->
<td><INPUT TYPE="text" NAME="placasustituido" placeholder="placa unidad sustituida"   disabled ></td>
</tr>

<tr>
<td>REINGRESO</td>
<td><input type="radio" name="razonentrada" value="reingreso"  >Si</td>
<td></td>
<td>CORTESIA</td>
<td><input type="radio" name="razonsalida" value="cortesia"  disabled  >Si</td> <!-- SALIDA -->
<td></td>
</tr>

<tr>
<td>OTRO</td>
<td><input type="radio" name="razonentrada" value="otro"  >Si</td>
<td><INPUT TYPE="text" NAME="razonentradatexto" placeholder="otro"  ></td>
<td>VENTA</td>
<td><input type="radio" name="razonsalida" value="venta"  disabled  >Si</td> <!-- SALIDA -->
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td>RENTA DE PISO</td>
<td><input type="radio" name="razonsalida" value="renta de piso"  disabled  >Si</td> <!-- SALIDA -->
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
<table><input type="submit" name="submit" value="Generar"></table>
</form>
</body>
</html>