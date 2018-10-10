<?php

$Economico;
$Serie;
$Vehiculo;
$Modelo;
$Color;
$Motor;
$Placas;

function datosporeconomico($uNEco){
	global $conectar;
	global $Economico;
	global $marca;
	global $Serie;
	global $Vehiculo;
	global $Modelo;
	global $Color;
	global $Motor;
	global $claveVehicular;
	global $Placas;
	
	$sql = 'SELECT u.Economico, u.marca, u.Serie, u.Vehiculo, u.Modelo, u.Color, u.Motor, u.claveVehicular ';
	$sql .= ' FROM';
	$sql .= ' ubicacion u';
	$sql .= " WHERE u.Economico = '$uNEco' LIMIT 1 ";

	$resultado 	= mysql_query($sql, $conectar);
	$matriz 	= mysql_fetch_array($resultado);
	
	$Economico 	= $matriz['Economico'];
	$marca 		= $matriz['marca'];	
	$Serie 		= $matriz['Serie'];
	$Vehiculo 	= $matriz['Vehiculo'];
	$Modelo 	= $matriz['Modelo'];
	$Color 		= $matriz['Color'];
	$Motor 		= $matriz['Motor'];
	$claveVehicular = $matriz['claveVehicular'];
	
	$sql5 	= "SELECT `Placas` FROM `placa` WHERE `Economico`=$uNEco ORDER BY `fechaAsignacion` DESC LIMIT 1 ";
	$r5 	= mysql_query($sql5, $conectar);
	$matriz5= mysql_fetch_array($r5);
	
	$Placas = $matriz5['Placas'];
}

function datosporserie($uSerie){
	$sqlNS 	= "SELECT `Economico` FROM `ubicacion` WHERE `Serie` = '$uSerie' LIMIT 1";
	$rpNS 	= mysql_query($sqlNS);
	$arrayNS= mysql_fetch_array($rpNS);
	
	$uNEco 	= $arrayNS['Economico'];
	
	datosporeconomico($uNEco);
}

function datosporplaca($uPlacas){
	$sqlp = "SELECT `Economico` FROM `placa` WHERE `Placas` = '$uPlacas' LIMIT 1";
	$rp = mysql_query($sqlp);
	$arrayp = mysql_fetch_array($rp);
	
	$uNEco = $arrayp['Economico'];

	datosporeconomico($uNEco);
}


//$VariableDisponible;
function limpiarVariable($VariableDisponible){
	//global $VariableDisponible;
	$VariableDisponible  = trim($VariableDisponible, "' -_");
	$comillasimple 	= "'";
	$espacio 		= " ";
	$guion 			= "-";
	$guionBajo 		= "_";
	$VariableDisponible  = str_replace($comillasimple,"",$VariableDisponible);
	$VariableDisponible  = str_replace($guion,"",$VariableDisponible);
	$VariableDisponible  = str_replace($guionBajo,"",$VariableDisponible);
	$VariableDisponible  = str_replace($espacio,"",$VariableDisponible);
	$VariableDisponible  = trim($VariableDisponible);
	return $VariableDisponible;
	}


function limpiarVariableRFC($VariableDisponible){
	//global $VariableDisponible;
	$VariableDisponible  = trim($VariableDisponible, "' -_");
	$comillasimple 	= "'";
	$espacio 		= " ";
	$guion 			= "-";
	$guionBajo 		= "_";
	$VariableDisponible = str_replace($comillasimple,"",$VariableDisponible);
	$VariableDisponible = str_replace($guion,"",$VariableDisponible);
	$VariableDisponible = str_replace($guionBajo,"",$VariableDisponible);
	$VariableDisponible = str_replace($espacio,"",$VariableDisponible);
	$VariableDisponible = trim($VariableDisponible);
	$VariableDisponible = strtoupper($VariableDisponible);
	return $VariableDisponible;
	}

// para limpiar entrada input de texto	
function limpiarVariableTexto($VariableDisponible){
	//global $VariableDisponible;
	$VariableDisponible  = trim($VariableDisponible, "'-_");
	$comillasimple = "'";
	$guion = "-";
	$guionBajo = "_";
	$VariableDisponible = str_replace($comillasimple,"",$VariableDisponible);
	$VariableDisponible = str_replace($guion,"",$VariableDisponible);
	$VariableDisponible = str_replace($guionBajo,"",$VariableDisponible);
	$VariableDisponible = trim($VariableDisponible);
	$VariableDisponible = strtoupper($VariableDisponible);
	return $VariableDisponible;
	}

function limpiarVariableGC($VariableDisponible){
	$VariableDisponible = trim($VariableDisponible, "'");
	$comillasimple 		= "'";
	$VariableDisponible = str_replace($comillasimple,"",$VariableDisponible);
	$VariableDisponible = trim($VariableDisponible);
	$VariableDisponible = strtoupper($VariableDisponible);
	return $VariableDisponible;
	}

function idxplaca($placas){
	global $id_unidad;
	$sqlip 		= "SELECT `id_unidad` FROM `placa` WHERE `Placas` = '$placas' LIMIT 1";
	$rip 		= mysql_query($sqlip);
	$arrayip 	= mysql_fetch_array($rip);
	$id_unidad 	= $arrayip['id_unidad'];
}

function idxserie($serie){
	global $id_unidad;
	$sqlis 		= "SELECT `id` FROM `ubicacion` WHERE `Serie` = '$serie' LIMIT 1";
	$ris 		= mysql_query($sqlis);
	$arrayis 	= mysql_fetch_array($ris);
	$id_unidad 	= $arrayis['id'];
}

function idxeconomico($economico){
	global $id_unidad;
	$sqlie 		= "SELECT `id` FROM `ubicacion` WHERE `Economico` = '$economico' LIMIT 1";
	$rie 		= mysql_query($sqlie);
	$arrayie 	= mysql_fetch_array($rie);
	$id_unidad 	= $arrayie['id'];
}

function datosxid($id_unidad){
	global $conectar;
	global $Economico;
	global $Marca;
	global $Serie;
	global $Vehiculo;
	global $Modelo;
	global $Color;
	global $Motor;
	global $Cilindros;
	global $Transmision;
	global $ClaveVehicular;

	global $Placas;
	global $terminacionN;
	
	$sql = 'SELECT u.Economico, u.marca, u.Serie, u.Vehiculo, u.Modelo, u.Color, u.Motor, u.Cilindros, u.Transmision, u.claveVehicular ';
	$sql .= ' FROM';
	$sql .= ' ubicacion u';
	$sql .= " WHERE u.id = '$id_unidad' LIMIT 1 ";

	$resultado 	= mysql_query($sql, $conectar);
	$matriz 	= mysql_fetch_array($resultado);
	
	$Economico 	= $matriz['Economico'];
	$Marca 		= $matriz['marca'];	
	$Serie 		= $matriz['Serie'];
	$Vehiculo 	= $matriz['Vehiculo'];
	$Modelo 	= $matriz['Modelo'];
	$Color 		= $matriz['Color'];
	$Motor 		= $matriz['Motor'];
	$Cilindros 	= $matriz['Cilindros'];
	$Transmision= $matriz['Transmision'];
	$ClaveVehicular = $matriz['claveVehicular'];
	
	$sql5 		= "SELECT `Placas`, terminacionN FROM `placa` WHERE id_unidad = '$id_unidad' ORDER BY `fechaAsignacion` DESC LIMIT 1 ";
	$r5 		= mysql_query($sql5, $conectar);
	$matriz5 	= mysql_fetch_array($r5);
	
	$Placas 	= $matriz5['Placas'];
	$terminacionN 	= $matriz5['terminacionN'];
}


function placaxid($id_unidad){
	global $conectar;
	global $Placas;
	$sql5 		= "SELECT `Placas` FROM `placa` WHERE id_unidad = '$id_unidad' ORDER BY `fechaAsignacion` DESC LIMIT 1 ";
	$r5 		= mysql_query($sql5, $conectar);
	$matriz5 	= mysql_fetch_array($r5);
	$Placas 	= $matriz5['Placas'];
}


function placasHist($id_unidad){
	global $conectar;
	global $PlacasH;
	$sql4 		= "SELECT `Placas` FROM `placa` WHERE `id_unidad`= $id_unidad ORDER BY `fechaAsignacion` DESC LIMIT 1, 5 ";
	$res4 		= mysql_query($sql4);
	$campos4 	= mysql_num_fields($res4);
	$filas4 	= mysql_num_rows($res4);

	if(mysql_affected_rows()>0)
	{
		while ($row4 = mysql_fetch_assoc($res4)) 
		{
			foreach ($row4 as $key4 => $value4) 
			{
				$PlacasH .= $value4.", ";
			}
		}
	}
}


function ubicacionHistorico($id_unidad){
	global $conectar;
	global $clienteA;
	global $ubicacionA;
	global $fechaA;

	$sqluhf =   ' SELECT `mt_fecha_movimiento` fecha, `mt_proyecto_d` proyecto, `mt_ubicacion_d` ubicacion '
		. ' FROM `movimientos_tacuba` '
		. " WHERE `id_unidad`= $id_unidad "
		. ' UNION '

		. ' SELECT `fechaRegistro` fecha, `cliente` proyecto, `ubicacion` ubicacion '
		. ' FROM movimientos '
		. " WHERE `id_unidad`= $id_unidad "
		. ' UNION '

		. ' SELECT `fecharecepcion` fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion '
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `proyecto_destino` LIKE '%JETVAN%' "
		. ' UNION '
		
		. ' SELECT `fechaentrega` fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion '
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `hora_salida` > '0:00' "

		. ' ORDER BY fecha DESC LIMIT 1';
		
	$resultadouhf 	= mysql_query($sqluhf, $conectar);
	$matrizuhf 		= mysql_fetch_array($resultadouhf);

	$clienteA	=	$matrizuhf['proyecto'];
	$ubicacionA	=	$matrizuhf['ubicacion'];
	$fechaA 	=	$matrizuhf['fecha'];
}

function clientexid($id_cliente){
	global $conectar;
	global $razonSocial;
	global $rfc;
	global $alias;

	$sql_cliente 		= "SELECT * FROM claCliente WHERE id_cliente = '$id_cliente' ";
	$sql_cliente_res 	= mysql_query($sql_cliente, $conectar);
	$cliente_matriz		= mysql_fetch_array($sql_cliente_res);

	$id_cliente 	= $cliente_matriz['id_cliente'];
	$rfc 			= $cliente_matriz['rfc'];
	$razonSocial 	= $cliente_matriz['razonSocial'];
	$alias		 	= $cliente_matriz['alias'];
	$calleNumero	= $cliente_matriz['calleNumero'];
	$colonia 		= $cliente_matriz['colonia'];
	$municipio 		= $cliente_matriz['municipio'];
	$estado 		= $cliente_matriz['estado'];
	$cp 			= $cliente_matriz['cp'];
}


function contratoxid($id_contrato){
	global $conectar;
	global $id_cliente;
	global $id_alan;
	global $numero;
	global $aliasCto;

	$sql_contrato 		= "SELECT * FROM clbCto WHERE id_contrato = '$id_contrato' ";
	$sql_contrato_res 	= mysql_query($sql_contrato, $conectar);
	$contrato_matriz	= mysql_fetch_array($sql_contrato_res);

	$id_cliente 	= $contrato_matriz['id_cliente'];
	$id_alan	 	= $contrato_matriz['id_alan'];
	$numero 		= $contrato_matriz['numero'];
	$aliasCto 		= $contrato_matriz['aliasCto'];
}


function usuarioxid($id_usuario){ // PARA ENVIO DE NOTIFICACIONES
	global $conectar;
	global $id_usuario;
	global $nombre;
	global $usuario;

	$sql_usuario 		= "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario' ";
	$sql_usuario_res 	= mysql_query($sql_usuario, $conectar);
	$usuario_matriz		= mysql_fetch_array($sql_usuario_res);

	$id_usuario 	= $usuario_matriz['id_usuario'];
	$nombre	 		= $usuario_matriz['nombre'];
	$usuario 		= $usuario_matriz['usuario']; // tambien es el email
}

function usuarioxidC($id_usuarioC){ // PARA LISTADO CONSULTA
	global $conectar;
	global $id_usuarioC;
	global $nombreC;
	global $usuarioC;

	$sql_usuario 		= "SELECT * FROM usuarios WHERE id_usuario = '$id_usuarioC' ";
	$sql_usuario_res 	= mysql_query($sql_usuario, $conectar);
	$usuario_matriz		= mysql_fetch_array($sql_usuario_res);

	$id_usuarioC 	= $usuario_matriz['id_usuario'];
	$nombreC	 	= $usuario_matriz['nombre'];
	$usuarioC 		= $usuario_matriz['usuario']; // tambien es el email
}

function gpsxid($id_unidad){
	global $conectar;
	global $tienegps;

	$sql_gps = 'SELECT * '
		. ' FROM gpsAsignado '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY '
		. ' id_gps '
		. ' DESC LIMIT 1 ' ;

	$res_GPS 	= mysql_query($sql_gps);
	$gps_matriz	= mysql_fetch_array($res_GPS);
	$id_gps 	= $gps_matriz['id_gps'];

	if($id_gps > 0){
		$tienegps = 'Si';
	}
	else
	{
		$tienegps = 'No';
	}
}


function unidadesContratoxid($id_contrato){
	global $conectar;
	global $unidadesCto;

	$sql_unidades 		= "SELECT count( id_unidad ) unidades FROM asignaUactual 
							WHERE id_contrato = '$id_contrato' ";
	$sql_unidades_res 	= mysql_query($sql_unidades, $conectar);
	$unidades_matriz	= mysql_fetch_array($sql_unidades_res);

	$unidadesCto 		= $unidades_matriz['unidades'];
}


function unidadVistaAutorizada($id_unidad, $id_usuario){
	global $conectar;
	global $vistaAutorizada;

	$vistaAutorizada = 'no';

	// INICIO OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA
	$sql_cto_de_unidad 		= "SELECT id_contrato FROM asignaUactual 
								WHERE id_unidad = '$id_unidad' LIMIT 1 ";
	$sql_cto_de_unidad_res 	= mysql_query($sql_cto_de_unidad, $conectar);
	$cto_de_unidad_matriz	= mysql_fetch_array($sql_cto_de_unidad_res);
	$id_contrato 			= $cto_de_unidad_matriz['id_contrato'];
	// TERMINA OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA

	// INICIO UBICAR CONTRATO EN ASIGNACION DE EJECUTIVO
	$sql_ejec_cto 		= "SELECT id_contrato FROM asignaEjecutivo 
							WHERE id_usuario = '$id_usuario' 
							AND id_contrato = '$id_contrato' 
							AND fecha_final IS NULL LIMIT 1 ";
	$sql_ejec_cto_res 	=  mysql_query($sql_ejec_cto, $conectar);
	// TERMINA UBICAR CONTRATO EN ASIGNACION DE EJECUTIVO

	if( mysql_affected_rows() == 1 ){ 
		$vistaAutorizada = 'si';
	}
	else{
		$vistaAutorizada = 'no';
	}
}


function unidadVistaAutorizadaSN3($id_unidad, $id_usuario){
	global $conectar;
	global $vistaAutorizada;

	$vistaAutorizada = 'no';

	// INICIO OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA
	$sql_cto_de_unidad 		= "SELECT id_asignacion FROM asignaUactual 
								WHERE id_unidad = '$id_unidad' LIMIT 1 ";
	$sql_cto_de_unidad_res 	= mysql_query($sql_cto_de_unidad, $conectar);
	$cto_de_unidad_matriz	= mysql_fetch_array($sql_cto_de_unidad_res);
	$id_asignacion 			= $cto_de_unidad_matriz['id_asignacion'];
	// TERMINA OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA

	// INICIO OBTENER SUB2 Y SUB3
	$sql_asgsU 		= "SELECT id_contrato, id_subDiv2, id_subDiv3 FROM asignaUnidad 
								WHERE id_asignacion = '$id_asignacion' LIMIT 1 ";
	$sql_asgsU_R 	= mysql_query($sql_asgsU, $conectar);
	$sql_asgsU_M	= mysql_fetch_array($sql_asgsU_R);
	$id_contrato 	= $sql_asgsU_M['id_contrato'];
	$id_subDiv2 	= $sql_asgsU_M['id_subDiv2'];
	$id_subDiv3 	= $sql_asgsU_M['id_subDiv3'];
	// TERMINA OBTENER SUB2 Y SYB3

	// INICIO UBICAR CONTRATO, SUBDIV2 Y SUBDIV3 EN ASIGNACION DE EJECUTIVO
	$sql_ejec_cto 		= "SELECT id_contrato FROM asignaEjecutivo 
							WHERE id_usuario = '$id_usuario' 
							AND id_contrato = '$id_contrato' 
							AND id_subDiv2 = '$id_subDiv2' 
							AND id_subDiv3 = '$id_subDiv3' 
							AND fecha_final IS NULL LIMIT 1 ";
	$sql_ejec_cto_res 	=  mysql_query($sql_ejec_cto, $conectar);
	// TERMINA UBICAR CONTRATO, SUBDIV2 Y SUBDIV3 EN ASIGNACION DE EJECUTIVO

	if( mysql_affected_rows() == 1 ){ 
		$vistaAutorizada = 'si';
	}
	else{
		$vistaAutorizada = 'no';
	}
}

function usuarioFiltradoInfo($id_usuario){
	// AQUI VAMOS A PONER LOS SUBSECUENTES // CONTRATO-FEDERAL, ESTATAL, MUNICIPAL, JEFTURA, OFICINA
	global $conectar;
	global $id_contrato;
	global $id_subDiv2;
	global $id_subDiv3;

		// INICIO OBTENER SUB2 Y SUB3
	$sql_asgsU 		= "SELECT id_contrato, id_subDiv2, id_subDiv3 FROM asignaEjecutivo  
								WHERE id_usuario = '$id_usuario' LIMIT 1 ";
	$sql_asgsU_R 	= mysql_query($sql_asgsU, $conectar);
	$sql_asgsU_M	= mysql_fetch_array($sql_asgsU_R);
	$id_contrato 	= $sql_asgsU_M['id_contrato'];
	$id_subDiv2 	= $sql_asgsU_M['id_subDiv2'];
	$id_subDiv3 	= $sql_asgsU_M['id_subDiv3'];
	// TERMINA OBTENER SUB2 Y SYB3
}


function clientexidcontrato($id_contrato){

}


// OBTENER TEXTO DE TIPO DE ERROR EN DOCUMENTO
function doctipoerror($tipoerror){
	global $tipoerrorDescripcion;
		switch($tipoerror)
		{
			case "1":
				$tipoerrorDescripcion = 'ES DE OTRA UNIDAD';
				break;
			case "2":
				$tipoerrorDescripcion = 'NO ES EL DOCUMENTO DESCRITO';
				break;
			case "3":
				$tipoerrorDescripcion = 'NO ES LEGIBLE';
				break;
			case "4":
				$tipoerrorDescripcion = 'REPETIDO';
				break;
			case "5":
				$tipoerrorDescripcion = 'NO ABRE';
				break;
			case "6":
				$tipoerrorDescripcion = 'OTRO';
				break;
			default:
				;
		}
}


function dictipoxclave($d_tipoclave){
	global $d_tipo;
		switch($d_tipoclave)
		{
			case "1":
				$d_tipo = 'FACTURA';
				break;
			case "2":
				$d_tipo = 'POLIZA DE SEGURO';
				break;
			case "3":
				$d_tipo = 'TARJETA DE CIRCULACION';
				break;
			case "4":
				$d_tipo = 'VERIFICACION AMBIENTAL';
				break;
			case "5":
				$d_tipo = 'TENENCIA';
				break;
			case "6":
				$d_tipo = 'OTRO';
				break;
			default:
				;
		}
}


function tienecontrato($id_usuario)
{
	global $conectar;
	global $miflotilla;
	$sql_tiene_contrato = "	SELECT * FROM 
							asignaEjecutivo WHERE id_usuario = '$id_usuario' 
							AND fecha_final IS NULL limit 1 ";
	$sql_tiene_contrato_R	= @mysql_query($sql_tiene_contrato, $conectar);
	
	if( @mysql_affected_rows() > 0 )
		{ 
			$miflotilla = 1;
		}
	else
		{
			$miflotilla = 0;
		}
}


function proveedorxid($id_prov){
	global $conectar;
	global $Prfc;	
	global $PrazonSocial;

	global $PaliasProv;

	global $PcalleNumero;
	global $Pcolonia;
	global $Pmunicipio;
	global $Pestado;
	global $Pcp;

	$sql_prov 	= "SELECT * FROM provAlta WHERE id_prov = '$id_prov' ";
	$sql_prov_R	= mysql_query($sql_prov, $conectar);
	$prov_M		= mysql_fetch_array($sql_prov_R);

	$id_prov 		= $prov_M['id_prov'];
	$Prfc 			= $prov_M['rfc'];
	$PrazonSocial 	= $prov_M['razonSocial'];
	$PaliasProv		= $prov_M['aliasProv'];
	$PcalleNumero	= $prov_M['calleNumero'];
	$Pcolonia 		= $prov_M['colonia'];
	$Pmunicipio 	= $prov_M['municipio'];
	$Pestado 		= $prov_M['estado'];
	$Pcp 			= $prov_M['cp'];
}


function provXrfc($rfc){
	global $id_prov;
	$sql_pid = 'SELECT id_prov '
			. ' FROM '
			. ' provAlta '
			. " WHERE rfc = '$rfc' LIMIT 1";
	$resultado_pid 	= mysql_query($sql_pid);
	$matriz_pid 	= mysql_fetch_array($resultado_pid);

	$id_prov 		= $matriz_pid['id_prov'];
}


function provCtaxid($id_cuenta){
	global $conectar;
	global $PCclabe;
	global $PCcuenta;
	global $PCsucursal;
	global $PCbanco;

	$sql_pCta 	= "SELECT * FROM provBanco WHERE id_cuenta = '$id_cuenta' ";
	$sql_pCta_R	= mysql_query($sql_pCta, $conectar);
	$pCta_M		= mysql_fetch_array($sql_pCta_R);

	$PCbanco 	= $pCta_M['banco'];
	$PCcuenta 	= $pCta_M['cuenta'];
	$PCclabe	= $pCta_M['clabe'];
	$PCsucursal = $pCta_M['sucursal'];
}


function reembxid($id_mttoSol){
	global $conectar;
	global $esreembolso; // MARCADOR BANDERA FLAG
	global $nombreR;
	global $clabeR;
	global $cuentaR;
	global $sucR;
	global $bancoR;

	$sql_ReembMS 	= "SELECT * FROM mttoSolRemb WHERE id_mttoSol = '$id_mttoSol' ";
	$sql_ReembMS_R	= mysql_query($sql_ReembMS, $conectar);
	$ReembMS_M		= mysql_fetch_array($sql_ReembMS_R);

	$nombreR 	= $ReembMS_M['nombreR'];
	$clabeR		= $ReembMS_M['clabeR'];
	$cuentaR 	= $ReembMS_M['cuentaR'];
	$sucR 		= $ReembMS_M['sucR'];
	$bancoR 	= $ReembMS_M['bancoR'];

	if( @mysql_affected_rows() > 0 )
		{ 
			$esreembolso = 1;
		}
	else
		{
			$esreembolso = 0;
		}
}


// PROVEEDOR TRASLADO
function provTxid($id_provT){
	global $provTN;
		switch($id_provT)
		{
			case "1":
				$provTN = 'FENIX SERVICIOS DE TRASLADOS, S.A. DE C.V.';
				break;
			case "2":
				$provTN = 'TRASLADOS PREMIER, S.A. DE C.V.';
				break;
			case "3":
				$provTN = 'VITAL TRASLADO AUTOMOTRIZ, S.A. DE C.V.';
				break;
			case "4":
				$provTN = 'JET VAN CAR RENTAL, S.A. DE C.V.';
				break;
			default:
			break;
		}
}


function estadoT($estadoN){
	global $estadoTN;
		switch($estadoN)
		{
			case "1":
				$estadoTN = 'Aguascalientes';
				break;
			case "2":
				$estadoTN = 'Baja California';
				break;
			case "3":
				$estadoTN = 'Baja California Sur';
				break;
			case "4":
				$estadoTN = 'Campeche';
				break;
			case "5":
				$estadoTN = 'Chiapas';
				break;
			case "6":
				$estadoTN = 'Chihuahua';
				break;
			case "7":
				$estadoTN = 'Ciudad de México';
				break;
			case "8":
				$estadoTN = 'Coahuila de Zaragoza';
				break;
			case "9":
				$estadoTN = 'Colima';
				break;
			case "10":
				$estadoTN = 'Durango';
				break;
			case "11":
				$estadoTN = 'Estado de México';
				break;
			case "12":
				$estadoTN = 'Guanajuato';
				break;
			case "13":
				$estadoTN = 'Guerrero';
				break;
			case "14":
				$estadoTN = 'Hidalgo';
				break;
			case "15":
				$estadoTN = 'Jalisco';
				break;
			case "16":
				$estadoTN = 'Michoacán de Ocampo';
				break;
			case "17":
				$estadoTN = 'Morelos';
				break;
			case "18":
				$estadoTN = 'Nayarit';
				break;
			case "19":
				$estadoTN = 'Nuevo León';
				break;
			case "20":
				$estadoTN = 'Oaxaca';
				break;
			case "21":
				$estadoTN = 'Puebla';
				break;
			case "22":
				$estadoTN = 'Querétaro';
				break;
			case "23":
				$estadoTN = 'Quintana Roo';
				break;
			case "24":
				$estadoTN = 'San Luis Potosí';
				break;
			case "25":
				$estadoTN = 'Sinaloa';
				break;
			case "26":
				$estadoTN = 'Sonora';
				break;
			case "27":
				$estadoTN = 'Tabasco';
				break;
			case "28":
				$estadoTN = 'Tamaulipas';
				break;
			case "29":
				$estadoTN = 'Tlaxcala';
				break;
			case "30":
				$estadoTN = 'Veracruz de Ignacio de la Llave';
				break;
			case "31":
				$estadoTN = 'Yucatán';
				break;
			case "32":
				$estadoTN = 'Zacatecas';
				break;
			default:
				break;
		}
}


function unidadAsignacion($id_unidad){
	global $conectar;
	global $id_cliente;
	global $id_contrato;
	global $id_partida;
	global $id_subDiv2;
	global $id_subDiv3;
	global $fecha_inicioASG;

	$sql_asgU = 'SELECT * '
		. ' FROM asignaUnidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY id_asignacion DESC LIMIT 1 ' ;
	$res_asgU 	= mysql_query($sql_asgU);
	$rowU 		= mysql_fetch_array($res_asgU);
			
	$id_cliente 	= $rowU['id_cliente']; 
	$id_contrato 	= $rowU['id_contrato'];
	$id_partida 	= $rowU['id_partida'];
	$id_subDiv2 	= $rowU['id_subDiv2'];
	$id_subDiv3 	= $rowU['id_subDiv3'];
	$fecha_inicio 	= $rowU['fecha_inicio'];
	$fecha_inicioASG 	= $rowU['fecha_inicio'];
}

function partidasDelContrato($id_contrato){
global $conectar;
global $partidasArray;

$sqlPartidas 	= "SELECT id_partida, descripcion FROM ctoPartidas WHERE id_contrato = '$id_contrato' ";
$sqlP_R			= mysql_query($sqlPartidas);

while ($fila = mysql_fetch_array($sqlP_R	, MYSQL_ASSOC))
	{
		$partidasArray[$fila["id_partida"]] = $fila["descripcion"];
	}
mysql_free_result($sqlP_R);
}


function areasAdmDelContrato($id_contrato){ // OBTENER SUBDIV2
global $conectar;
global $areasAdmArray;

$sqlAreas 	= "SELECT id_subDiv2, concepto FROM clbSubDiv2 WHERE id_contrato = '$id_contrato' ";
$sqlA_R		= mysql_query($sqlAreas);

while ($fila = mysql_fetch_array($sqlA_R	, MYSQL_ASSOC))
	{
		$areasAdmArray[$fila["id_subDiv2"]] = $fila["concepto"];
	}
mysql_free_result($sqlA_R);
}


function descId_partida($id_partida){
	global $conectar;
	global $ptdDesc;

	$sql_DP = 'SELECT descripcion '
		. ' FROM ctoPartidas '
		. " WHERE id_partida = '$id_partida' "
		. ' LIMIT 1 ' ;
	$sql_DP_R 	= mysql_query($sql_DP);
	$rowDP_R 	= mysql_fetch_array($sql_DP_R);
			
	$ptdDesc = $rowDP_R['descripcion'];
}


function descId_subDiv2($id_subDiv2){
	global $conectar;
	global $subDiv2Desc;

	$sql_Sd2 = 'SELECT concepto '
		. ' FROM clbSubDiv2 '
		. " WHERE id_subDiv2 = '$id_subDiv2' "
		. ' LIMIT 1 ' ;
	$sql_Sd2_R 	= mysql_query($sql_Sd2);
	$rowSd2_R 	= mysql_fetch_array($sql_Sd2_R);
			
	$subDiv2Desc = $rowSd2_R['concepto'];
}


function ecoClientexid($id_unidad){
	global $conectar;
	global $EcoCliente;

	$sql_EC = 'SELECT EcoCliente '
		. ' FROM ecoCliente '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY id_EC DESC LIMIT 1 ' ;
	$sql_EC_R 	= mysql_query($sql_EC);
	$rowEC_R 	= mysql_fetch_array($sql_EC_R);
			
	$EcoCliente = $rowEC_R['EcoCliente']; 
}


function finalplaca($placa1){
// INICIA OBTENER FINAL DE LA PLACA
global $largoplaca; 
$largoplaca = strlen($placa1);
global $numeros;
$numeros = array('1','2','3','4','5','6','7','8','9','0');
global $finalPlaca;
$posicion = $largoplaca - 1;
for($i = 0; $i < $largoplaca ; $i++)
	{
		$comparar = $posicion - $i;
		if(in_array($placa1[$comparar], $numeros))
			{
				$finalPlaca = $placa1[$comparar];
				break;
			}
	}
// TERMINA OBTENER FINAL DE LA PLACA	
}


function kmxid($id_unidad){
	global $conectar;
	global $kmUltimo;
	global $fecharegU;

	$sql_km = 'SELECT km, fechareg '
		. ' FROM kmH '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY fechareg DESC LIMIT 1 ' ;

	$sql_km_R 	= mysql_query($sql_km);
	$row_km_R 	= mysql_fetch_array($sql_km_R);
			
	$kmUltimo 	= $row_km_R['km'];
	$fecharegU 	= $row_km_R['fechareg']; 
}


function folioFxid($id_unidad){
	global $conectar;
	global $FolioFactura;

	$sql_folioF = 'SELECT FolioFactura '
		. ' FROM facturaunidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY FechaFactura DESC LIMIT 1 ' ;

	$sql_folioF_R 	= mysql_query($sql_folioF);
	$row_folioF_R 	= mysql_fetch_array($sql_folioF_R);
			
	$FolioFactura 	= $row_folioF_R['FolioFactura'];
}


function cVehicularxid($claveVehicular){
	global $conectar;
	global $cVehicularDescrip;

	$sql_cVeh = 'SELECT descripcion '
		. ' FROM cVehicular '
		. " WHERE claveVehicular like '%$claveVehicular' "
		. ' LIMIT 1 ' ;

	$sql_cVeh_R 	= mysql_query($sql_cVeh);
	$row_cVeh_R 	= mysql_fetch_array($sql_cVeh_R);
			
	$cVehicularDescrip 	= $row_cVeh_R['descripcion'];
}

function estadoxidEdo($id_estado){
	global $conectar;
	global $nombreE;
	global $iso31662E;

	$sql_E = 'SELECT * '
		. ' FROM estadosR '
		. " WHERE id_estado like '$id_estado' "
		. ' LIMIT 1 ' ;
	$sql_E_R 	= mysql_query($sql_E);
	$row_E_R 	= mysql_fetch_array($sql_E_R);
		
	$nombreE 	= $row_E_R['nombre'];
	$iso31662E 	= $row_E_R['iso31662'];
}


function buscaDocTC($id_unidad){
	global $conectar;
	global $idTC;
	global $ArchivoTC;
	global $tipoTC;
	global $obsTC;
	global $rutaTC;

	$sql_DTC = 'SELECT id, archivo, tipo, obs, ruta ' 
		. ' FROM'
		. ' expedientes'
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND tipo = 3 '
		. ' ORDER BY tipo ASC, fechareg DESC LIMIT 1 ';
	$sql_DTC_R 	= mysql_query($sql_DTC);
	$row_DTC_R 	= mysql_fetch_array($sql_DTC_R);

	$rutaTC 	= $row_DTC_R['ruta'];
	$ArchivoTC 	= $row_DTC_R['archivo'];
}


function buscaDocPS($id_unidad){
	global $conectar;
	global $idPS;
	global $ArchivoPS;
	global $tipoPS;
	global $obsPS;
	global $rutaPS;

	$sql_DPS = 'SELECT id, archivo, tipo, obs, ruta ' 
		. ' FROM'
		. ' expedientes'
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND tipo = 2 '
		. ' ORDER BY tipo ASC, fechareg DESC LIMIT 1 ';
	$sql_DPS_R 	= mysql_query($sql_DPS);
	$row_DPS_R 	= mysql_fetch_array($sql_DPS_R);

	$rutaPS 	= $row_DPS_R['ruta'];
	$ArchivoPS 	= $row_DPS_R['archivo'];
}


function mttoAPRCxU($id_usuarioM, $fechainicio, $fechafinalQ3){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $conectar;
global $mttoP; // O PENDIENTE
global $mttoA; // 1 AUTORIZADO
global $mttoR; // 2 3 4 INCOMPLETO REVISION RECHAZADO
global $mttoCC; // CANCELADOS STATUS 5

$mttoP = 0; // O PENDIENTE
$mttoA = 0; // 1 AUTORIZADO
$mttoR = 0; // 2 3 4 INCOMPLETO REVISION RECHAZADO
$mttoCC = 0;

$sql_mAPRC 	= "	SELECT `autorizadoS` status, "
			."	count( autorizadoS ) totales "
			."	FROM `mttoSol` "
			."	WHERE capturo = '$id_usuarioM'  "
			."	AND  '$fechainicio' <=  `fechaEj` AND   `fechaEj` <= '$fechafinalQ3' "
			."	GROUP BY autorizadoS";
$sql_mAPRC_R 	= mysql_query($sql_mAPRC);

while ($fila = mysql_fetch_assoc($sql_mAPRC_R) )
	{
		$status 	= $fila['status'];
		$totales 	= $fila['totales'];

		switch($status)
		{
			case "0":
				$mttoP += $totales;
				break;
			case "1":
				$mttoA += $totales;
				break;
			case "2":
				$mttoR += $totales;
				break;
			case "3":
				$mttoR += $totales;
				break;
			case "4":
				$mttoR += $totales;
				break;
			case "5":
				$mttoCC += $totales;
				break;	
			default:
			break;
		}
	}
mysql_free_result($sql_mAPRC_R);
}


function mttoAPRCxC($id_clienteM, $fechainicio, $fechafinalQ3){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $conectar;
global $mttoP; // O PENDIENTE
global $mttoA; // 1 AUTORIZADO
global $mttoR; // 2 3 4 INCOMPLETO REVISION RECHAZADO
global $mttoCC; // CANCELADOS STATUS 5

$mttoP = 0; // O PENDIENTE
$mttoA = 0; // 1 AUTORIZADO
$mttoR = 0; // 2 3 4 INCOMPLETO REVISION RECHAZADO
$mttoCC = 0;

$sql_mAPRC 	= "	SELECT `autorizadoS` status, "
			."	count( autorizadoS ) totales "
			."	FROM `mttoSol` "
			."	WHERE id_cliente = '$id_cliente'  "
			."	AND  '$fechainicio' <=  `fechaEj` AND   `fechaEj` <= '$fechafinalQ3' "
			."	GROUP BY autorizadoS";
$sql_mAPRC_R 	= mysql_query($sql_mAPRC);

while ($fila = mysql_fetch_assoc($sql_mAPRC_R) )
	{
		$status 	= $fila['status'];
		$totales 	= $fila['totales'];

		switch($status)
		{
			case "0":
				$mttoP += $totales;
				break;
			case "1":
				$mttoA += $totales;
				break;
			case "2":
				$mttoR += $totales;
				break;
			case "3":
				$mttoR += $totales;
				break;
			case "4":
				$mttoR += $totales;
				break;
			case "5":
				$mttoCC += $totales;
				break;	
			default:
			break;
		}
	}
mysql_free_result($sql_mAPRC_R);
}


function mttoAPRCxP($id_provM, $fechainicio, $fechafinalQ3){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $conectar;
global $mttoP; // O PENDIENTE
global $mttoA; // 1 AUTORIZADO
global $mttoR; // 2 3 4 INCOMPLETO REVISION RECHAZADO
global $mttoCC; // CANCELADOS STATUS 5

$mttoP = 0; // O PENDIENTE
$mttoA = 0; // 1 AUTORIZADO
$mttoR = 0; // 2 3 4 INCOMPLETO REVISION RECHAZADO
$mttoCC = 0;

$sql_mAPRC 	= "	SELECT `autorizadoS` status, "
			."	count( autorizadoS ) totales "
			."	FROM `mttoSol` "
			."	WHERE id_prov = '$id_prov'  "
			."	AND  '$fechainicio' <=  `fechaEj` AND   `fechaEj` <= '$fechafinalQ3' "
			."	GROUP BY autorizadoS";
$sql_mAPRC_R 	= mysql_query($sql_mAPRC);

while ($fila = mysql_fetch_assoc($sql_mAPRC_R) )
	{
		$status 	= $fila['status'];
		$totales 	= $fila['totales'];

		switch($status)
		{
			case "0":
				$mttoP += $totales;
				break;
			case "1":
				$mttoA += $totales;
				break;
			case "2":
				$mttoR += $totales;
				break;
			case "3":
				$mttoR += $totales;
				break;
			case "4":
				$mttoR += $totales;
				break;
			case "5":
				$mttoCC += $totales;
				break;	
			default:
			break;
		}
	}
mysql_free_result($sql_mAPRC_R);
}


function mttoSoportesUsuario($buscarUCP, $fechainicio, $fechafinalQ3, $tipoB){
// $buscarUCP ES EL VALOR BUSCADO
// $tipoB TIPO DE BUSQUEDA 1 USUARIO, 2 CLIENTE, 3 PROVEEDOR

	global $conectar;
	global $pagadosMtto;
	global $facturadosMtto;
	global $sinfacturaMtto;
	global $sumaPagado;
	global $promedioPagado;

$pagadosMtto 	= 0;
$facturadosMtto = 0;
$sinfacturaMtto = 0;
$sumaPagado 	= 0;
$promedioPagado = 0;

$sqlTipo = '';
switch($tipoB)
{
	case "1":
		$sqlTipo .= 'capturo'; // USUARIO
		break;
	case "2":
		$sqlTipo .= 'id_cliente'; // CLIENTE
		break;
	case "3":
		$sqlTipo .= 'id_prov'; // PROVEEDOR
		break;
	default:
		break;
}

// QUERY PARA SACAR CUENTA DE CUANTOS HAN SIDO PAGADOS
$sql_Pg	= "
SELECT count( `id_mttoSol` ) pagados , 	sum( `importe` ) suma 
FROM `mttoSol`
WHERE ".$sqlTipo." = '$buscarUCP' 
AND pagadoInfo + pagado !=0 
AND `fechaEj` 
BETWEEN '$fechainicio' 
AND '$fechafinalQ3' ";
$sql_Pg_R 	= mysql_query($sql_Pg);
$row_Pg_R 	= mysql_fetch_array($sql_Pg_R);
$pagadosMtto = $row_Pg_R['pagados'];
if($row_Pg_R['suma']>0){	$sumaPagado = $row_Pg_R['suma'];}
if($pagadosMtto>0){$promedioPagado = $sumaPagado/$pagadosMtto;} 

// QUERY PARA OBTENER CUENTA DE FACTURADOS
$sql_Fct	= "
SELECT count( `id_mttoSol` ) facturados 
FROM `mttoSol` 
WHERE ".$sqlTipo." = '$buscarUCP' 
AND facturado > 0 AND pagadoInfo + pagado !=0 
AND `fechaEj` 
BETWEEN '$fechainicio' 
AND '$fechafinalQ3' ";
$sql_Fct_R 	= mysql_query($sql_Fct);
$row_Fct_R 	= mysql_fetch_array($sql_Fct_R);
$facturadosMtto = $row_Fct_R['facturados'];

// QUERY PARA OBTENER CUENTA DE NO FACTURADOS
$sql_SF	= "
SELECT count( `id_mttoSol` ) NOfacturados 
FROM `mttoSol` 
WHERE ".$sqlTipo." = '$buscarUCP' 
AND facturado = 0 AND pagadoInfo + pagado !=0 
AND `fechaEj` 
BETWEEN '$fechainicio' 
AND '$fechafinalQ3' ";
$sql_SF_R 	= mysql_query($sql_SF);
$row_SF_R 	= mysql_fetch_array($sql_SF_R);
$sinfacturaMtto = $row_SF_R['NOfacturados'];

}


?>_SF);
$row_SF_R 	= mysql_fetch_array($sql_SF_R);
$sinfacturaMtto = $row_SF_R['NOfacturados'];

}


?>