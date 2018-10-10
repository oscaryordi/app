<?php

$Economico;
$Serie;
$Vehiculo;
$Modelo;
$Color;
$Motor;
$Placas;

function datosporeconomico($uNEco){
	global $dbd2;
	global $Economico;
	global $marca;
	global $Serie;
	global $Vehiculo;
	global $Modelo;
	global $Color;
	global $Motor;
	global $claveVehicular;
	global $Placas;
	
	$sql = 'SELECT u.Economico, u.marca, u.Serie, u.Vehiculo, 
			u.Modelo, u.Color, u.Motor, u.claveVehicular ';
	$sql .= ' FROM';
	$sql .= ' ubicacion u';
	$sql .= " WHERE u.Economico = '$uNEco' LIMIT 1 ";

	$resultado 	= mysqli_query($dbd2, $sql);
	$matriz 	= mysqli_fetch_array($resultado);
	
	$Economico 	= $matriz['Economico'];
	$marca 		= $matriz['marca'];	
	$Serie 		= $matriz['Serie'];
	$Vehiculo 	= $matriz['Vehiculo'];
	$Modelo 	= $matriz['Modelo'];
	$Color 		= $matriz['Color'];
	$Motor 		= $matriz['Motor'];
	$claveVehicular = $matriz['claveVehicular'];
	
	$sql5 		= " SELECT `Placas` FROM `placa` WHERE `Economico`=$uNEco 
					ORDER BY `fechaAsignacion` DESC LIMIT 1 ";
	$r5 		= mysqli_query($dbd2, $sql5);
	$matriz5	= mysqli_fetch_array($r5);
	
	$Placas 	= $matriz5['Placas'];
}

function datosporserie($uSerie){
	global $dbd2;
	$sqlNS 	= "SELECT `Economico` FROM `ubicacion` WHERE `Serie` = '$uSerie' LIMIT 1";
	$rpNS 	= mysqli_query($dbd2, $sqlNS);
	$arrayNS= mysqli_fetch_array($rpNS);
	
	$uNEco 	= $arrayNS['Economico'];
	
	datosporeconomico($uNEco);
}

function datosporplaca($uPlacas){
	global $dbd2;	
	$sqlp 	= "SELECT `Economico` FROM `placa` WHERE `Placas` = '$uPlacas' LIMIT 1";
	$rp 	= mysqli_query($dbd2, $sqlp);
	$arrayp = mysqli_fetch_array($rp);
	
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
	global $dbd2;
	global $id_unidad;
	$sqlip 		= "SELECT `id_unidad` FROM `placa` WHERE `Placas` = '$placas' LIMIT 1";
	$rip 		= mysqli_query($dbd2, $sqlip);
	$arrayip 	= mysqli_fetch_array($rip);
	$id_unidad 	= $arrayip['id_unidad'];
}

function idxserie($serie){
	global $dbd2;
	global $id_unidad;
	$sqlis 		= "SELECT `id` FROM `ubicacion` WHERE `Serie` = '$serie' LIMIT 1";
	$ris 		= mysqli_query($dbd2, $sqlis);
	$arrayis 	= mysqli_fetch_array($ris);
	$id_unidad 	= $arrayis['id'];
}

function idxeconomico($economico){
	global $dbd2;
	global $id_unidad;
	$sqlie 		= "SELECT `id` FROM `ubicacion` WHERE `Economico` = '$economico' LIMIT 1";
	$rie 		= mysqli_query($dbd2, $sqlie);
	$arrayie 	= mysqli_fetch_array($rie);
	$id_unidad 	= $arrayie['id'];
}

function datosxid($id_unidad){
	global $dbd2;
	//global $conectar;
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
	global $estadoEPA;
	
	$sql = 'SELECT u.Economico, u.marca, u.Serie, 
			u.Vehiculo, u.Modelo, u.Color, u.Motor, 
			u.Cilindros, u.Transmision, u.claveVehicular ';
	$sql .= ' FROM';
	$sql .= ' ubicacion u';
	$sql .= " WHERE u.id = '$id_unidad' LIMIT 1 ";

	$resultado 	= mysqli_query($dbd2, $sql);
	$matriz 	= mysqli_fetch_array($resultado);
	
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
	
	$sql5 		= " SELECT `Placas`, terminacionN, estadoE 
					FROM `placa` 
					WHERE id_unidad = '$id_unidad' 
					ORDER BY `fechaAsignacion` DESC LIMIT 1 ";
	$r5 		= mysqli_query($dbd2, $sql5);
	$matriz5 	= mysqli_fetch_array($r5);
	
	$Placas 	= $matriz5['Placas'];
	$terminacionN = $matriz5['terminacionN'];
	$estadoEPA 	= $matriz5['estadoE'];
}


function placaxid($id_unidad){
	global $dbd2;
	global $Placas;
	global $terminacionN;

	$sql5 		= " SELECT `Placas`, terminacionN 
					FROM `placa` 
					WHERE id_unidad = '$id_unidad' 
					ORDER BY `fechaAsignacion` DESC 
					LIMIT 1 ";
	$r5 		= mysqli_query($dbd2, $sql5 );
	$matriz5 	= mysqli_fetch_array($r5);
	$Placas 	= $matriz5['Placas'];
	$terminacionN 	= $matriz5['terminacionN'];
}


function placasHist($id_unidad){
	global $dbd2;
	global $PlacasH;
	$sql4 		= "	SELECT `Placas` 
					FROM `placa` 
					WHERE `id_unidad`= $id_unidad 
					ORDER BY `fechaAsignacion` DESC 
					LIMIT 1, 5 ";
	$res4 		= mysqli_query($dbd2, $sql4);
	@$campos4 	= mysqli_num_fields($res4);
	@$filas4 	= mysqli_num_rows($res4);

	if(mysqli_affected_rows($dbd2)>0)
	{
		while ($row4 = mysqli_fetch_assoc($res4)) 
		{
			foreach ($row4 as $key4 => $value4) 
			{
				$PlacasH .= $value4.", ";
			}
		}
	}
}


function ubicacionHistorico($id_unidad){
	global $dbd2;
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

	   . " SELECT CONCAT( fecharecepcion, ' ', `hora_entrada` ) fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion "
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `proyecto_destino` LIKE '%JETVAN%' "
		. ' UNION '
		
		. " SELECT CONCAT( fechaentrega, ' ', `hora_salida` ) fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion "
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `hora_salida` > '0:00' "
		. ' UNION '

		. " SELECT CONCAT( fechaD, ' ', `horaD` ) fecha, `id_contratoD` proyecto, `ciudadD` ubicacion "
		. ' FROM mov_traslados '
		. " WHERE `id_unidad`= $id_unidad AND  borrar = 0 "

		. ' ORDER BY fecha DESC LIMIT 1';
		
	$resultadouhf 	= mysqli_query($dbd2, $sqluhf );
	@$matrizuhf 	= mysqli_fetch_array($resultadouhf);

	$clienteA	=	$matrizuhf['proyecto'];
	$ubicacionA	=	$matrizuhf['ubicacion'];
	$fechaA 	=	$matrizuhf['fecha'];
}



##### ##### ##### ##### ##### establecer columna fuente
function ubicacionHistoricoM($id_unidad){
	// OBTIENE TODOS LOS REGISTROS DE UBICACION DE UN VEHICULO DEVUELVE UNA MATRIZ
	global $dbd2;
	//global $clienteA;
	//global $ubicacionA;
	//global $fechaA;
	global $resultadouhf;

	$sqluhf =   ' SELECT `mt_fecha_movimiento` fecha, `mt_proyecto_d` proyecto, `mt_ubicacion_d` ubicacion, 
			mt_id id, mt_id NroInventario, fuente   '
		. ' FROM `movimientos_tacuba` '
		. " WHERE `id_unidad`= $id_unidad "
		. ' UNION '

		. ' SELECT `fechaRegistro` fecha, `cliente` proyecto, `ubicacion` ubicacion,  
			id id,   id NroInventario, fuente   '
		. ' FROM movimientos '
		. " WHERE `id_unidad`= $id_unidad "
		. ' UNION '

	   . " SELECT CONCAT( fecharecepcion, ' ', `hora_entrada` ) fecha, `proyecto_destino` proyecto, 
	   		`ubicacion_destino` ubicacion,  
	   		id_formato id, numero_inventario NroInventario, fuente  "
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `proyecto_destino` LIKE '%JETVAN%' "
		. ' UNION '
		
		. " SELECT CONCAT( fechaentrega, ' ', `hora_salida` ) fecha, `proyecto_destino` proyecto, `ubicacion_destino` ubicacion,  
			id_formato id, numero_inventario NroInventario, fuente  "
		. ' FROM formato_inventario '
		. " WHERE `id_unidad`= $id_unidad AND `hora_salida` > '0:00' "
		. ' UNION '

		. " SELECT CONCAT( fechaD, ' ', `horaD` ) fecha, `id_contratoD` proyecto, `ciudadD` ubicacion, 
			id_movFor id,   folio_inv NroInventario, fuente  "
		. ' FROM mov_traslados '
		. " WHERE `id_unidad`= $id_unidad AND  borrar = 0 "

		. ' ORDER BY fecha DESC '; // LIMIT 1
		
	$resultadouhf 	= mysqli_query($dbd2, $sqluhf );
	//$matrizuhf 		= mysqli_fetch_array($resultadouhf);

/*	$clienteA	=	$matrizuhf['proyecto'];
	$ubicacionA	=	$matrizuhf['ubicacion'];
	$fechaA 	=	$matrizuhf['fecha'];*/
}





function clientexid($id_cliente){
	global $dbd2;
	global $razonSocial;
	global $rfc;
	global $alias;

	$sql_cliente 		= "SELECT * FROM claCliente WHERE id_cliente = '$id_cliente' ";
	$sql_cliente_res 	= mysqli_query($dbd2, $sql_cliente );
	$cliente_matriz		= mysqli_fetch_array($sql_cliente_res);

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
	global $dbd2;
	global $id_cliente;
	global $id_alan;
	global $numero;
	global $aliasCto;
	global $fechainicioCTO;
	global $fechafinCTO;
	global $min;
	global $max;
	global $borrado;


	$sql_contrato 		= "SELECT * FROM clbCto WHERE id_contrato = '$id_contrato' ";
	$sql_contrato_res 	= mysqli_query($dbd2, $sql_contrato );
	$contrato_matriz	= mysqli_fetch_array($sql_contrato_res);

	$id_cliente 	= $contrato_matriz['id_cliente'];
	$id_alan	 	= $contrato_matriz['id_alan'];
	$numero 		= $contrato_matriz['numero'];
	$aliasCto 		= $contrato_matriz['aliasCto'];
	$fechainicioCTO = $contrato_matriz['fechainicio'];
	$fechafinCTO 	= $contrato_matriz['fechafin'];
	$min 			= $contrato_matriz['min'];
	$max 			= $contrato_matriz['max'];
	$borrado		= $contrato_matriz['borrado'];
}

/**/

function conveniosxid($id_contrato){
	global $dbd2;
	global $minSC;
	global $maxSC;

	$sql_convenios 		= " SELECT SUM(min) minSC,  SUM(max) maxSC 
							FROM clbCtoConv 
							WHERE id_contrato = '$id_contrato' ";
	$sql_convenios_res 	= mysqli_query($dbd2, $sql_convenios);
	$convenios_matriz	= mysqli_fetch_array($sql_convenios_res);

	$minSC 	= $convenios_matriz['minSC'];
	$maxSC	= $convenios_matriz['maxSC'];
}

function usuarioxid($id_usuario){ // PARA ENVIO DE NOTIFICACIONES
	global $dbd2;
	global $id_usuario;
	global $nombre;
	global $usuario;
	global $puestoUSR;

	$sql_usuario 		= "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario' ";
	$sql_usuario_res 	= mysqli_query($dbd2, $sql_usuario );
	$usuario_matriz		= mysqli_fetch_array($sql_usuario_res);

	$id_usuario 	= $usuario_matriz['id_usuario'];
	$nombre	 		= $usuario_matriz['nombre'];
	$usuario 		= $usuario_matriz['usuario']; // tambien es el email
	$puestoUSR 		= $usuario_matriz['puesto'];
}

function usuarioxidC($id_usuarioC){ // PARA LISTADO CONSULTA
	global $dbd2;
	global $id_usuarioC;
	global $nombreC;
	global $usuarioC;

	$sql_usuario 		= "SELECT * FROM usuarios WHERE id_usuario = '$id_usuarioC' ";
	$sql_usuario_res 	= mysqli_query($dbd2, $sql_usuario );
	$usuario_matriz		= mysqli_fetch_array($sql_usuario_res);

	$id_usuarioC 	= $usuario_matriz['id_usuario'];
	$nombreC	 	= $usuario_matriz['nombre'];
	$usuarioC 		= $usuario_matriz['usuario']; // tambien es el email
}

function gpsxid($id_unidad){
	global $dbd2;
	global $tienegps;
	global $gpsAvisa;
	global $gpsImeiActual;
	global $gpsfechaFinal;

	$sql_gps = 'SELECT * '
		. ' FROM gpsAsignado '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY '
		. ' id_gps '
		. ' DESC LIMIT 1 ' ;

	$res_GPS 	= mysqli_query($dbd2, $sql_gps);
	$gps_matriz	= mysqli_fetch_array($res_GPS);
	$id_gps 	= $gps_matriz['id_gps'];
	$id_imeiA 	= $gps_matriz['id_imei'];
	$gpsfechaFinal = $gps_matriz['fechaFinal'];

	// INICIO sacar imei
	$sql_imei = "SELECT imei FROM gpsImei WHERE id_imei = '$id_imeiA' LIMIT 1 ";
	$res_imei = mysqli_query($dbd2, $sql_imei);
	while($rowimei = mysqli_fetch_assoc($res_imei)){ $gpsImeiActual = $rowimei['imei'];}
	// FIN sacar imei	


	if($id_gps > 0 &&  is_null($gpsfechaFinal))
	{
		$tienegps = 'Si';
		$gpsAvisa = "<span style='color:white;background-color:green;'>
					SI TIENE GPS</span>";
	}
	else
	{
		$tienegps = 'No';
		$gpsAvisa = "<span style='color:white;background-color:red;'>
					NO TIENE GPS</span>";
	}
}


function gpsAxid($id_unidad){
	global $dbd2;
	global $tieneAlerta;
	global $gpsAmensaje;
	global $gpsAtexto;

	global $gpsAid_unidad;
	global $gpsAfechaReg;

	global $id_alertaGps;
	global $gpsAtendido; 

	$sql_gps = 'SELECT * '
		. ' FROM gpsAlerta '
		. " WHERE id_unidad = '$id_unidad' AND atendido = 0 "
		. ' ORDER BY '
		. ' id_alertaGps '
		. ' DESC LIMIT 1 ' ;

	$res_GPS 	= mysqli_query($dbd2, $sql_gps);
	$gps_matriz	= mysqli_fetch_array($res_GPS);

	$id_alertaGps 	= $gps_matriz['id_alertaGps'];
	$gpsAid_unidad 	= $gps_matriz['id_unidad'];
	$gpsAfechaReg 	= $gps_matriz['fechaReg'];
	$gpsAmensaje 	= $gps_matriz['mensaje'];
	$gpsAtendido 	= $gps_matriz['atendido'];

	if($id_alertaGps > 0){
		$tieneAlerta = 'Si';
		$gpsAtexto = "<span style='color:red;background-color:YELLOW;'> 
						<h3 style='color:red;background-color:YELLOW;'>
						UNIDAD DEBE SER ENVIADA A MANTENIMIENTO DE GPS</h3>
						$gpsAmensaje </span>";
	}
	/*else
	{
		$tieneAlerta = 'No';
		$gpsAtexto 	= "<span style='color:white;background-color:red;'>NO TIENE GPS</span>";
	}*/
}


function gpsAxid_A($id_alertaGps){
	//global $conectar;
	global $dbd2;
	global $gpsAmensaje;

	global $gpsAid_unidad;
	global $gpsAfechaReg;
	global $gpsAfechaFin;
	global $gpsAatendido;

	$sql_gps = 'SELECT * '
		. ' FROM gpsAlerta '
		. " WHERE id_alertaGps = '$id_alertaGps' AND atendido = 0 "
		. ' ORDER BY '
		. ' id_alertaGps '
		. ' DESC LIMIT 1 ' ;

	$res_GPS 	= mysqli_query($dbd2,$sql_gps);
	$gps_matriz	= mysqli_fetch_array($res_GPS);

	$id_alertaGps 	= $gps_matriz['id_alertaGps'];
	$gpsAid_unidad 	= $gps_matriz['id_unidad'];
	$gpsAfechaReg 	= $gps_matriz['fechaReg'];
	$gpsAmensaje 	= $gps_matriz['mensaje'];
	$gpsAfechaFin 	= $gps_matriz['fechaFin'];
	$gpsAatendido 	= $gps_matriz['atendido'];

}


function gpsLinea($lineaB){
// OBTENER ID_LINEA DE UNA LINEA GPS 
	global $dbd2;
	global $id_linea;

	$sql_Linea = 'SELECT * '
		. ' FROM gpsLinea '
		. " WHERE numero = '$lineaB' "
		. ' LIMIT 1 ' ;

	$linea_R 	= mysqli_query($dbd2,$sql_Linea);
	$linea_Row	= mysqli_fetch_array($linea_R);

	$id_linea 	= $linea_Row['id_linea'];
}


function gpsxLinea($id_linea){
// OBTENER MATRIZ DE ASIGNACIONES DE UNA LINEA GPS	
	global $dbd2;
	global $res_GPSxLinea;

	$sql_gps = 'SELECT * '
		. ' FROM gpsAsignado '
		. " WHERE id_linea = '$id_linea' " 
		. ' ORDER BY '
		. ' id_gps '
		. ' DESC ' ;
//		. " LIMIT $pagina_1, $rxpag " ;
	$res_GPSxLinea 	= mysqli_query($dbd2,$sql_gps);
}


function gpsIMEI($imei){
// OBTENER ID_LINEA DE UNA LINEA GPS 
	global $dbd2;
	global $id_imei;

	$sql_imei = 'SELECT * '
		. ' FROM gpsImei '
		. " WHERE imei = '$imei' "
		. ' LIMIT 1 ' ;

	$imei_R 	= mysqli_query($dbd2,$sql_imei);
	$imei_Row	= mysqli_fetch_array($imei_R);

	$id_imei 	= $imei_Row['id_imei'];
}


function gpsxIMEI($id_imei){
// OBTENER MATRIZ DE ASIGNACIONES DE UNA LINEA GPS	
	global $dbd2;
	global $res_GPSxIMEI;

	$sql_gpsIMEI = 'SELECT * '
		. ' FROM gpsAsignado '
		. " WHERE id_imei = '$id_imei' " 
		. ' ORDER BY '
		. ' id_gps '
		. ' DESC ' ;
//		. " LIMIT $pagina_1, $rxpag " ;
	$res_GPSxIMEI 	= mysqli_query($dbd2,$sql_gpsIMEI);
}


function gpsXid_gps($id_gps){
//OBTWNWE DATOS LEGIBLES DE UNA ASIGNACION
	global $dbd2; // CONEXION MY_SQLi
	global $imei;
	global $linea;
	global $sim;
	global $id_unidad;
	global $fechaInicio;
	global $fechaFinal;
	global $bloqueo;
	global $obs;

	$sql_gps = 'SELECT * '
		. ' FROM gpsAsignado '
		. " WHERE id_gps = '$id_gps' "; 

	$res_GPS 	= mysqli_query($dbd2,$sql_gps);
	$gps_Row	= mysqli_fetch_array($res_GPS);

	$id_imei 	= $gps_Row['id_imei'];
	$id_linea 	= $gps_Row['id_linea'];
	$id_sim 	= $gps_Row['id_sim'];
	$id_unidad 	= $gps_Row['id_unidad'];
	$fechaInicio= $gps_Row['fechaInicio'];
	$fechaFinal = $gps_Row['fechaFinal'];
	$bloqueo 	= $gps_Row['bloqueo'];
	$obs 		= $gps_Row['obs'];

	// INICIO sacar imei
	$sql_imei = "SELECT imei FROM gpsImei WHERE id_imei = '$id_imei' LIMIT 1 ";
	$res_imei = mysqli_query($dbd2,$sql_imei);
	while($rowimei = mysqli_fetch_assoc($res_imei)){ $imei = $rowimei['imei'];}
	// FIN sacar imei

	// INICIO sacar linea
	$sql_linea = "SELECT numero FROM gpsLinea WHERE id_linea = '$id_linea' LIMIT 1 ";
	$res_linea = mysqli_query($dbd2,$sql_linea);
	while($rowlinea = mysqli_fetch_assoc($res_linea)){ $linea = $rowlinea['numero'];}
	// FIN sacar linea

	// INICIO sacar sim
	$sql_sim = "SELECT numeroSim FROM gpsSim WHERE id_sim = '$id_sim' LIMIT 1 ";
	$res_sim = mysqli_query($dbd2,$sql_sim);
	while($rowsim = mysqli_fetch_assoc($res_sim)){ $sim = $rowsim['numeroSim'];}
	// FIN sacar sim
}


function unidadesContratoxid($id_contrato){ // SIN CORTESIAS
	global $dbd2;
	global $unidadesCto;

	$sql_unidades 		= " SELECT count( id_unidad ) unidades FROM asignaUactual "
						. "	WHERE id_contrato = '$id_contrato' AND tipoAsig != 3 " ;
	$sql_unidades_res 	= mysqli_query($dbd2, $sql_unidades);
	$unidades_matriz	= mysqli_fetch_array($sql_unidades_res);

	$unidadesCto 		= $unidades_matriz['unidades'];
}


function unidades_id_subDiv2_id($id_subDiv2){ // SIN CORTESIAS // UNIDADES SUBAREA
	global $dbd2;
	global $unidadesDiv2;

	$sql_unidadesDiv2 		= " SELECT count( id_unidad ) unidades FROM asignaUactual "
							. "	WHERE id_subDiv2 = '$id_subDiv2' AND tipoAsig != 3 " ;
	$sql_unidadesDiv2_res 	= mysqli_query($dbd2, $sql_unidadesDiv2);
	$unidades_matriz		= mysqli_fetch_array($sql_unidadesDiv2_res);

	$unidadesDiv2 			= $unidades_matriz['unidades'];
}


// PENDIENTE
function unidadVistaAutorizada($id_unidad, $id_usuario){
	global $dbd2;
	global $vistaAutorizada;

	$vistaAutorizada = 'no';

	// INICIO OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA
	$sql_cto_de_unidad 		= "SELECT id_contrato FROM asignaUactual 
								WHERE id_unidad = '$id_unidad' LIMIT 1 ";
	$sql_cto_de_unidad_res 	= mysqli_query($dbd2, $sql_cto_de_unidad);
	$cto_de_unidad_matriz	= mysqli_fetch_array($sql_cto_de_unidad_res);
	$id_contrato 			= $cto_de_unidad_matriz['id_contrato'];
	// TERMINA OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA

	// INICIO UBICAR CONTRATO EN ASIGNACION DE EJECUTIVO
	$sql_ejec_cto 		= "SELECT id_contrato FROM asignaEjecutivo 
							WHERE id_usuario = '$id_usuario' 
							AND id_contrato = '$id_contrato' 
							AND fecha_final IS NULL LIMIT 1 ";
	$sql_ejec_cto_res 	=  mysqli_query($dbd2, $sql_ejec_cto);
	// TERMINA UBICAR CONTRATO EN ASIGNACION DE EJECUTIVO

	if( mysqli_affected_rows($dbd2) == 1 ){ 
		$vistaAutorizada = 'si';
	}
	else{
		$vistaAutorizada = 'no';
	}
}

// PENDIENTE
function unidadVistaAutorizadaSN2($id_unidad, $id_usuario){
	global $dbd2;
	global $vistaAutorizada;

	$vistaAutorizada = 'no';

	// INICIO OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA
	$sql_cto_de_unidad 		= "SELECT id_asignacion FROM asignaUactual 
								WHERE id_unidad = '$id_unidad' LIMIT 1 ";
	$sql_cto_de_unidad_res 	= mysqli_query($dbd2,$sql_cto_de_unidad);
	$cto_de_unidad_matriz	= mysqli_fetch_array($sql_cto_de_unidad_res);
	$id_asignacion 			= $cto_de_unidad_matriz['id_asignacion'];
	// TERMINA OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA

	// INICIO OBTENER SUB2 Y SUB3
	$sql_asgsU 		= "SELECT id_contrato, id_subDiv2, id_subDiv3 FROM asignaUnidad 
								WHERE id_asignacion = '$id_asignacion' LIMIT 1 ";
	$sql_asgsU_R 	= mysqli_query($dbd2,$sql_asgsU);
	$sql_asgsU_M	= mysqli_fetch_array($sql_asgsU_R);
	$id_contrato 	= $sql_asgsU_M['id_contrato'];
	$id_subDiv2 	= $sql_asgsU_M['id_subDiv2'];
	$id_subDiv3 	= $sql_asgsU_M['id_subDiv3'];
	// TERMINA OBTENER SUB2 Y SYB3

	// INICIO UBICAR CONTRATO, SUBDIV2 Y SUBDIV3 EN ASIGNACION DE EJECUTIVO
	$sql_ejec_cto 		= "SELECT id_contrato FROM asignaEjecutivo " 
						."	WHERE id_usuario = '$id_usuario' "
						."	AND id_contrato = '$id_contrato' "
						."	AND id_subDiv2 = '$id_subDiv2' "
//						."	AND id_subDiv3 = '$id_subDiv3' "
						."	AND fecha_final IS NULL LIMIT 1 ";
	$sql_ejec_cto_res 	=  mysqli_query($dbd2,$sql_ejec_cto);
	// TERMINA UBICAR CONTRATO, SUBDIV2 Y SUBDIV3 EN ASIGNACION DE EJECUTIVO

	if( mysqli_affected_rows($dbd2) == 1 ){ 
		$vistaAutorizada = 'si';
	}
	else{
		$vistaAutorizada = 'no';
	}
}

// PENDIENTE
function unidadVistaAutorizadaSN3($id_unidad, $id_usuario){
	global $dbd2;
	global $vistaAutorizada;

	$vistaAutorizada = 'no';

	// INICIO OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA
	$sql_cto_de_unidad 		= " SELECT id_asignacion FROM asignaUactual 
								WHERE id_unidad = '$id_unidad' LIMIT 1 ";
	$sql_cto_de_unidad_res 	= mysqli_query($dbd2, $sql_cto_de_unidad);
	$cto_de_unidad_matriz	= mysqli_fetch_array($sql_cto_de_unidad_res);
	$id_asignacion 			= $cto_de_unidad_matriz['id_asignacion'];
	// TERMINA OBTENER CONTRATO DONDE UNIDAD ESTA ASIGNADA

	// INICIO OBTENER SUB2 Y SUB3
	$sql_asgsU 		= " SELECT id_contrato, id_subDiv2, id_subDiv3 FROM asignaUnidad 
						WHERE id_asignacion = '$id_asignacion' LIMIT 1 ";
	$sql_asgsU_R 	= mysqli_query($dbd2, $sql_asgsU);
	$sql_asgsU_M	= mysqli_fetch_array($sql_asgsU_R);
	$id_contrato 	= $sql_asgsU_M['id_contrato'];
	$id_subDiv2 	= $sql_asgsU_M['id_subDiv2'];
	$id_subDiv3 	= $sql_asgsU_M['id_subDiv3'];
	// TERMINA OBTENER SUB2 Y SYB3

	// INICIO UBICAR CONTRATO, SUBDIV2 Y SUBDIV3 EN ASIGNACION DE EJECUTIVO
	$sql_ejec_cto 		= " SELECT id_contrato FROM asignaEjecutivo 
							WHERE id_usuario 	= '$id_usuario' 
							AND id_contrato 	= '$id_contrato' 
							AND id_subDiv2 		= '$id_subDiv2' 
							AND id_subDiv3 		= '$id_subDiv3' 
							AND fecha_final IS NULL LIMIT 1 ";
	$sql_ejec_cto_res 	=  mysqli_query($dbd2, $sql_ejec_cto );
	// TERMINA UBICAR CONTRATO, SUBDIV2 Y SUBDIV3 EN ASIGNACION DE EJECUTIVO

	if( mysqli_affected_rows($dbd2) == 1 ){ 
		$vistaAutorizada = 'si';
	}
	else{
		$vistaAutorizada = 'no';
	}
}

function usuarioFiltradoInfo($id_usuario){
	// AQUI VAMOS A PONER LOS SUBSECUENTES // CONTRATO-FEDERAL, ESTATAL, MUNICIPAL, JEFTURA, OFICINA
	global $dbd2;
	global $id_contrato;
	global $id_subDiv2;
	global $id_subDiv3;

	// INICIO OBTENER SUB2 Y SUB3
	$sql_asgsU 		= "	SELECT id_contrato, id_subDiv2, id_subDiv3 
						FROM asignaEjecutivo  
						WHERE id_usuario = '$id_usuario' 
						LIMIT 1 ";
	$sql_asgsU_R 	= mysqli_query($dbd2, $sql_asgsU);
	$sql_asgsU_M	= mysqli_fetch_array($sql_asgsU_R);
	$id_contrato 	= $sql_asgsU_M['id_contrato'];
	$id_subDiv2 	= $sql_asgsU_M['id_subDiv2'];
	$id_subDiv3 	= $sql_asgsU_M['id_subDiv3'];
	// TERMINA OBTENER SUB2 Y SYB3
}


function usuarioAsigns($id_usuario){
	global $dbd2;
	global $asigArray;

	$sqlAsigs = ' SELECT `id_a_contrato` '
					. ' FROM asignaEjecutivo '
					. " WHERE `id_usuario` = $id_usuario AND fecha_final IS NULL" ;

	$sqlAs_R		= mysqli_query($dbd2, $sqlAsigs);

	while ($fila = mysqli_fetch_array($sqlAs_R, MYSQL_ASSOC))
		{
			$asigArray[] = $fila["id_a_contrato"];
		}
	mysqli_free_result($sqlAs_R);
}


function usuarioAsig($id_a_contrato){ // usuarioFiltradoInfo($id_usuario) es la misma
	// AQUI VAMOS A PONER LOS SUBSECUENTES // CONTRATO-FEDERAL, ESTATAL, MUNICIPAL, JEFTURA, OFICINA
	global $dbd2;
	global $id_contrato;
	global $id_subDiv2;
	global $id_subDiv3;

	// INICIO OBTENER SUB2 Y SUB3
	$sql_asgsU 		= "	SELECT id_contrato, id_subDiv2, id_subDiv3 
						FROM asignaEjecutivo  
						WHERE id_a_contrato = '$id_a_contrato' 
						LIMIT 1 ";
	$sql_asgsU_R 	= mysqli_query($dbd2, $sql_asgsU);
	$sql_asgsU_M	= mysqli_fetch_array($sql_asgsU_R);
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
	global $dbd2;
	global $miflotilla;
	$sql_tiene_contrato = "	SELECT * 
							FROM asignaEjecutivo 
							WHERE id_usuario = '$id_usuario' 
							AND fecha_final IS NULL 
							limit 1 ";
	$sql_tiene_contrato_R	= @mysqli_query($dbd2, $sql_tiene_contrato);
	
	if( @mysqli_affected_rows($dbd2) > 0 )
		{ 
			$miflotilla = 1;
		}
	else
		{
			$miflotilla = 0;
		}
}


function tieneEsteContrato($id_usuario, $id_contrato, $filtroFlotilla)
{
	global $dbd2;
	global $tieneEsteContrato;

	if($filtroFlotilla < 2 ){
		$sql_tiene_contrato = "	SELECT * FROM asignaEjecutivo 
								WHERE id_usuario = '$id_usuario' 
								AND id_contrato = '$id_contrato' 
								AND fecha_final IS NULL limit 1 ";
		$sql_tiene_contrato_R	= @mysqli_query($dbd2, $sql_tiene_contrato);
		
		if( @mysqli_affected_rows($dbd2) > 0 )
			{ 
				$tieneEsteContrato = 1;
			}
		else
			{
				$tieneEsteContrato = 0;
			}
	}
}

// pendiente
// OBTENER EJECUTIVOS PROPIOS INTERNOS DE JET VAN
function contratoEjecutivos($id_contrato) // OBTENER EJECUTIVOS DEL CONTRATO
{
	global $dbd2;
	global $sql_cto_ejecs_R;

	$sql_cto_ejecs 		= "	SELECT 
							ae.id_a_contrato, ae.id_usuario, ae.fecha_inicio, ae.fecha_final,
							u.nombre, u.externo 
							FROM 
							asignaEjecutivo  ae 
							JOIN 
							usuarios u 
							ON ae.id_usuario = u.id_usuario 
							WHERE ae.id_contrato = '$id_contrato' 
							AND ae.fecha_final IS NULL 
							AND u.externo = 0 
							ORDER BY u.nombre ASC ";
	$sql_cto_ejecs_R	= mysqli_query($dbd2, $sql_cto_ejecs );
}

//pendiente
// OBTENER EJECUTIVOS PROPIOS INTERNOS DE JET VAN ########## HISTORICO ##########
function contratoEjecutivosH($id_contrato) // OBTENER EJECUTIVOS DEL CONTRATO
{
	global $dbd2;
	global $sql_cto_ejecs_RH;

	$sql_cto_ejecsH 		= "	SELECT 
							ae.id_a_contrato, ae.id_usuario, ae.fecha_inicio, 
							ae.fecha_final, u.nombre, u.externo 
							FROM 
							asignaEjecutivo  ae 
							JOIN 
							usuarios u 
							ON ae.id_usuario = u.id_usuario 
							WHERE ae.id_contrato = '$id_contrato' 
							AND u.externo = 0 
							ORDER BY u.nombre ASC ";
	$sql_cto_ejecs_RH	= mysqli_query($dbd2, $sql_cto_ejecsH );
}



// OBTENER EJECUTIVOS EXTERNOS / USUARIOS EXTERNOS ########## HISTORICO ##########
function contratoEjecutivosE_H($id_contrato) // OBTENER EJECUTIVOS DEL CONTRATO
{
	global $dbd2;
	global $sql_cto_ejecs_ReH;

	$sql_cto_ejecsEH 	= "	SELECT 
							ae.id_a_contrato, ae.id_usuario, ae.fecha_inicio, 
							ae.fecha_final, u.nombre, u.externo, 
							u.filtroFlotilla 
							FROM 
							asignaEjecutivo  ae 
							JOIN 
							usuarios u 
							ON ae.id_usuario = u.id_usuario 
							WHERE ae.id_contrato = '$id_contrato' 
							AND u.externo = 1 
							ORDER BY u.nombre ASC ";
	$sql_cto_ejecs_ReH	= mysqli_query($dbd2, $sql_cto_ejecsEH );
}


function contratoContactos($id_contrato)
{
// OBTENER CONTACTO CON CLIENTE	
	//global $conectar;
	global $dbd2;
	global $sql_ctoContactoR;

	$sql_ctoContactoR 		= "	SELECT id_contacto, nombre, correo, cargo, telefono, 
							direccion, rollCargo, r1, r2, r3 FROM 
							clgContacto   
							WHERE id_contrato = '$id_contrato' 
							ORDER BY nombre ASC ";
	$sql_ctoContactoR	= mysqli_query($dbd2, $sql_ctoContactoR);
}


function contratoContacto($id_contacto)
{
// OBTENER CONTACTO CON CLIENTE	
	global $dbd2;
	//global $sql_ctoContacto1R;

	global $id_contacto ;
	global $id_contrato ; // CTO
	global $nombre 		;
	global $correo 		;
	global $cargo 		;
	global $telefono	;
	global $direccion	;

	global $r1 ;
	global $r2 ;
	global $r3 ;

	//global $sql_ctoContacto1R;

	$sql_ctoContacto 	= "	SELECT * FROM 
							clgContacto 
							WHERE id_contacto = '$id_contacto' 
							";
	$sql_ctoContacto1R	= mysqli_query( $dbd2, $sql_ctoContacto);
	$contacto_M			= mysqli_fetch_array($sql_ctoContacto1R);

	$id_contacto 		= $contacto_M['id_contacto'];
	$id_contrato 		= $contacto_M['id_contrato'];
	$nombre 			= $contacto_M['nombre'];
	$correo 			= $contacto_M['correo'];
	$cargo 				= $contacto_M['cargo'];
	$telefono			= $contacto_M['telefono'];
	$direccion			= $contacto_M['direccion'];
	$r1 				= $contacto_M['r1'];
	$r2 				= $contacto_M['r2'];
	$r3 				= $contacto_M['r3'];
}

/**/
function contratoContactoARRAY($id_contacto)
{
// OBTENER CONTACTO CON CLIENTE	
	global $dbd2;
	global $sql_ctoContacto1R;

	$sql_ctoContacto 	= "	SELECT * FROM 
							clgContacto 
							WHERE id_contacto = '$id_contacto' 
							";
	$sql_ctoContacto1R	= mysqli_query( $dbd2, $sql_ctoContacto);
}


function proveedorxid($id_prov){
	//global $conectar;
	global $dbd2;
	global $Prfc;
	global $PrazonSocial;

	global $PaliasProv;

	global $PcalleNumero;
	global $Pcolonia;
	global $Pmunicipio;
	global $Pestado;
	global $Pcp;
	global $Pcredito ;
	global $PcapturoC ;
	global $PdesdeC ;

	$sql_prov 	= "SELECT * FROM provAlta WHERE id_prov = '$id_prov' ";
	$sql_prov_R	= mysqli_query($dbd2, $sql_prov);
	$prov_M		= mysqli_fetch_array($sql_prov_R);

	$id_prov 		= $prov_M['id_prov'];
	$Prfc 			= $prov_M['rfc'];
	$PrazonSocial 	= $prov_M['razonSocial'];
	$PaliasProv		= $prov_M['aliasProv'];
	$PcalleNumero	= $prov_M['calleNumero'];
	$Pcolonia 		= $prov_M['colonia'];
	$Pmunicipio 	= $prov_M['municipio'];
	$Pestado 		= $prov_M['estado'];
	$Pcp 			= $prov_M['cp'];
	$Pcredito 		= $prov_M['credito'];
	@$PcapturoC 	= $prov_M['PcapturoC'];
	@$PdesdeC 		= $prov_M['PdesdeC'];
}


function provXrfc($rfc){
	global $dbd2;	
	global $id_prov;
	$sql_pid = 'SELECT id_prov '
			. ' FROM '
			. ' provAlta '
			. " WHERE rfc = '$rfc' LIMIT 1";
	$resultado_pid 	= mysqli_query($dbd2, $sql_pid);
	$matriz_pid 	= mysqli_fetch_array($resultado_pid);

	$id_prov 		= $matriz_pid['id_prov'];
}


function sucursalxid($id_sucursal){
	global $dbd2;
	global $id_prov 	;
	global $id_sucursal ;
	global $nombreSucursal;
	global $calleNumeroS;
	global $coloniaS	;
	global $municipioS	;
	global $estadoS		;
	global $cpS			;

	$sql37 =  ' SELECT * '
			. ' FROM '
			. ' provSucursal '
			. " WHERE id_sucursal = '$id_sucursal' ";

	$sql37_R	= mysqli_query($dbd2, $sql37);
	$row		= mysqli_fetch_array($sql37_R);

	$id_prov 		= $row['id_prov'];
	$id_sucursal 	= $row['id_sucursal'];
	$nombreSucursal	= $row['nombreSucursal'];
	$calleNumeroS	= $row['calleNumero'];
	$coloniaS		= $row['colonia'];
	$municipioS		= $row['municipio'];
	$estadoS		= $row['estado'];
	$cpS			= $row['cp'];
}


function asesorxid($id_contacto){
	global $dbd2;
	global $id_prov 	;
	global $id_contacto ;
	global $nombreCP 	;
	global $correoCP 	;
	global $telefonoCP 	;
	global $extensionCP 	;

$sql38 =  ' SELECT * '
		. ' FROM '
		. ' provContacto '
		. " WHERE id_contacto = '$id_contacto' ";

	$sql38_R	= mysqli_query($dbd2, $sql38);
	$row		= mysqli_fetch_array($sql38_R);

	$id_prov 		= $row['id_prov'];
	$id_contacto 	= $row['id_contacto'];
	$nombreCP 		= $row['nombre'];
	$correoCP		= $row['correo'];
	$telefonoCP		= $row['telefono'];
	$extensionCP	= $row['extension'];
}







function provCtaxid($id_cuenta){
	//global $conectar;
	global $dbd2;
	global $PCclabe;
	global $PCcuenta;
	global $PCsucursal;
	global $PCbanco;
	global $PCid_prov; 

	$sql_pCta 	= "SELECT * FROM provBanco WHERE id_cuenta = '$id_cuenta' ";
	$sql_pCta_R	= mysqli_query($dbd2, $sql_pCta );
	$pCta_M		= mysqli_fetch_array($sql_pCta_R);

	$PCid_prov 	= $pCta_M['id_prov']; // para validar que cuenta es de proveedor MtoSol
	$PCbanco 	= $pCta_M['banco'];
	$PCcuenta 	= $pCta_M['cuenta'];
	$PCclabe	= $pCta_M['clabe'];
	$PCsucursal = $pCta_M['sucursal'];
}


function reembxid($id_mttoSol){
	//global $conectar;
	global $dbd2;
	global $esreembolso; // MARCADOR BANDERA FLAG
	global $nombreR;
	global $clabeR;
	global $cuentaR;
	global $sucR;
	global $bancoR;

	$sql_ReembMS 	= "SELECT * FROM mttoSolRemb WHERE id_mttoSol = '$id_mttoSol' ";
	$sql_ReembMS_R	= mysqli_query($dbd2, $sql_ReembMS);
	$ReembMS_M		= mysqli_fetch_array($sql_ReembMS_R);

	$nombreR 	= $ReembMS_M['nombreR'];
	$clabeR		= $ReembMS_M['clabeR'];
	$cuentaR 	= $ReembMS_M['cuentaR'];
	$sucR 		= $ReembMS_M['sucR'];
	$bancoR 	= $ReembMS_M['bancoR'];

	if( @mysqli_affected_rows($dbd2) > 0 )
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
			case "0":
				$provTN = 'NO SE INDICO EL PROVEEDOR';
				break;			
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
				$provTN = 'TRASLADOS SHEKINA';
				break;
			case "5":
				$provTN = 'J.V. CANCUN';
				break;
			case "6":
				$provTN = 'J.V. CUERNAVACA';
				break;
			case "7":
				$provTN = 'J.V. GUANAJUATO';
				break;
			case "8":
				$provTN = 'J.V. JUCHITAN';
				break;
			case "9":
				$provTN = 'J.V. QUERETARO';
				break;
			case "10":
				$provTN = 'J.V. TULANCINGO';
				break;
			case "11":
				$provTN = 'J.V. POZA RICA';
				break;
			case "12":
				$provTN = 'OTROS';
				break;
			case "13":
				$provTN = 'JET VAN CAR RENTAL, S.A. DE C.V.';
				break;
			case "14":
				$provTN = 'TRASLADOS VISA';
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
	//global $conectar;
	global $dbd2;
	global $id_asignacion;
	global $id_cliente;
	global $id_contrato;
	global $id_partida;
	global $id_subDiv2;
	global $id_subDiv3;
	global $fecha_inicioASG;
	global $tipoAsig;

	$sql_asgU = 'SELECT * '
		. ' FROM asignaUnidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY id_asignacion DESC LIMIT 1 ' ;
	$res_asgU 	= mysqli_query($dbd2, $sql_asgU);
	$rowU 		= mysqli_fetch_array($res_asgU);

	$id_asignacion 	= $rowU['id_asignacion']; 
	$id_cliente 	= $rowU['id_cliente']; 
	$id_contrato 	= $rowU['id_contrato'];
	$id_partida 	= $rowU['id_partida'];
	$id_subDiv2 	= $rowU['id_subDiv2'];
	$id_subDiv3 	= $rowU['id_subDiv3'];
	$fecha_inicio 	= $rowU['fecha_inicio'];
	$fecha_inicioASG 	= $rowU['fecha_inicio'];
	$tipoAsig 		= $rowU['tipoAsig'];
}


function unidadAsignacionHR($id_unidad, $fechaResumen){ // HISTORICO PARA RESUMEN
// ES MEJOR GUARDARLA EN LA TABLA DE MTTO
	//global $conectar;
	global $dbd2;
	global $id_cliente;
	global $id_contrato;
	global $id_partida;
	global $id_subDiv2;
	global $id_subDiv3;
	global $fecha_inicioASG;
	global $tipoAsig;

	$sql_asgU = 'SELECT * '
		. ' FROM asignaUnidad '
		. " WHERE id_unidad = '$id_unidad' 
			AND (( fecha_inicio < '$fechaResumen') 
			AND ( '$fechaResumen' < fecha_final OR fecha_final IS NULL ))"
		. ' ORDER BY id_asignacion DESC LIMIT 1 ' ;
	$res_asgU 	= mysqli_query($dbd2, $sql_asgU);
	$rowU 		= mysqli_fetch_array($res_asgU);

	$id_cliente 	= $rowU['id_cliente']; 
	$id_contrato 	= $rowU['id_contrato'];
	$id_partida 	= $rowU['id_partida'];
	$id_subDiv2 	= $rowU['id_subDiv2'];
	$id_subDiv3 	= $rowU['id_subDiv3'];
	$fecha_inicio 	= $rowU['fecha_inicio'];
	$fecha_inicioASG 	= $rowU['fecha_inicio'];
	$tipoAsig 		= $rowU['tipoAsig'];
}

function partidaXid_partida($id_partida){ 
	//global $conectar;
	global $dbd2;
	global $mostrarPDesc;

	$sql_asgAA 		= 'SELECT * '
					. ' FROM ctoPartidas '
					. " WHERE id_partida = '$id_partida' " ;
	$res_asgAA 		= mysqli_query($dbd2, $sql_asgAA);
	$rowAA 			= mysqli_fetch_array($res_asgAA);
	$mostrarPDesc 	= $rowAA['descripcion'];
}


function areaAXid_subDiv2($id_subDiv2){ 
	global $dbd2;
	global $mostrarAAsn2;

	$sql_asgAA 		= 'SELECT * '
					. ' FROM clbSubDiv2 '
					. " WHERE id_subDiv2 = '$id_subDiv2' " ;
	$res_asgAA 		= mysqli_query($dbd2, $sql_asgAA);
	$rowAA 			= mysqli_fetch_array($res_asgAA);
	$mostrarAAsn2 	= $rowAA['descripcion'];
}


function areaAXid_subDiv3($id_subDiv3){ 
	global $dbd2;
	global $mostrarAAsn3;

	$sql_asgAA 		= 'SELECT * '
					. ' FROM clbSubDiv3 '
					. " WHERE id_subDiv3 = '$id_subDiv3' " ;
	$res_asgAA 		= mysqli_query($dbd2, $sql_asgAA);
	$rowAA 			= mysqli_fetch_array($res_asgAA);
	$mostrarAAsn3 	= $rowAA['descripcion'];
}

// pendiente // crea array
function partidasDelContrato($id_contrato){
	global $dbd2;
	global $partidasArray;

	$sqlPartidas 	= " SELECT id_partida, descripcion FROM ctoPartidas 
						WHERE id_contrato = '$id_contrato' ";
	$sqlP_R			= mysqli_query($dbd2, $sqlPartidas);

	while ($fila = mysqli_fetch_array($sqlP_R	, MYSQL_ASSOC))
		{
			$partidasArray[$fila["id_partida"]] = $fila["descripcion"];
		}
	mysqli_free_result($sqlP_R);
}

// pendiente // crea array
function areasAdmDelContrato($id_contrato){ // OBTENER SUBDIV2
	global $dbd2;
	global $areasAdmArray;

	$sqlAreas 	= " SELECT id_subDiv2, concepto FROM clbSubDiv2 
					WHERE id_contrato = '$id_contrato' ";
	$sqlA_R		= mysqli_query($dbd2, $sqlAreas);

	while ($fila = mysqli_fetch_array($sqlA_R	, MYSQL_ASSOC))
		{
			$areasAdmArray[$fila["id_subDiv2"]] = $fila["concepto"];
		}
	mysqli_free_result($sqlA_R);
}


function descId_partida($id_partida){
	//global $conectar;
	global $dbd2;
	global $ptdDesc;

	$sql_DP = 'SELECT descripcion '
		. ' FROM ctoPartidas '
		. " WHERE id_partida = '$id_partida' "
		. ' LIMIT 1 ' ;
	$sql_DP_R 	= mysqli_query($dbd2, $sql_DP);
	$rowDP_R 	= mysqli_fetch_array($sql_DP_R);
			
	$ptdDesc = $rowDP_R['descripcion'];
}

// crea array
function descId_subDiv2($id_subDiv2){
	//global $conectar;
	global $dbd2;
	global $subDiv2Desc;
	global $subDiv2nombre;
	global $subDiv2domicilio;

	$sql_Sd2 = 'SELECT concepto, descripcion , nombre, domicilio '
		. ' FROM clbSubDiv2 '
		. " WHERE id_subDiv2 = '$id_subDiv2' "
		. ' LIMIT 1 ' ;
	$sql_Sd2_R 	= mysqli_query($dbd2, $sql_Sd2);
	$rowSd2_R 	= mysqli_fetch_array($sql_Sd2_R);
			
	$subDiv2Desc = $rowSd2_R['concepto'];
	$subDiv2nombre = $rowSd2_R['nombre'];
	$subDiv2domicilio = $rowSd2_R['domicilio'];
	if($subDiv2Desc == '' OR is_null($subDiv2Desc))
	{
		$subDiv2Desc = $rowSd2_R['descripcion'];
	}
}


function areasDeSubDiv2($id_subDiv2){
//MOSTRAR AREAS DE SUBDIVISION	
	//global $conectar;
	global $dbd2;
	global $tieneSubDiv3;
	$sql_Sd3enSd2 	= 'SELECT COUNT(id_subDiv3) tieneSubDiv3 '
					. ' FROM clbSubDiv3 '
					. " WHERE id_subDiv2 = '$id_subDiv2' " ;
	$sql_Sd3enSd2_R 	= mysqli_query($dbd2, $sql_Sd3enSd2);
	$rowSd3enSd2 		= mysqli_fetch_array($sql_Sd3enSd2_R);
	$tieneSubDiv3 		= $rowSd3enSd2['tieneSubDiv3'];
}





function ecoClientexid($id_unidad){
	//global $conectar;
	global $dbd2;
	global $EcoCliente;

	$sql_EC = 'SELECT EcoCliente '
		. ' FROM ecoCliente '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY id_EC DESC LIMIT 1 ' ;
	$sql_EC_R 	= mysqli_query($dbd2, $sql_EC);
	$rowEC_R 	= mysqli_fetch_array($sql_EC_R);
			
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
	//global $conectar;
	global $dbd2;
	global $kmUltimo;
	global $fecharegU;

	$sql_km = 'SELECT km, fechareg '
		. ' FROM kmH '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY fechareg DESC LIMIT 1 ' ;

	$sql_km_R 	= mysqli_query($dbd2, $sql_km);
	$row_km_R 	= mysqli_fetch_array($sql_km_R);
			
	$kmUltimo 	= $row_km_R['km'];
	$fecharegU 	= $row_km_R['fechareg']; 
}


function folioFxid($id_unidad){
	//global $conectar;
	global $dbd2;
	global $FolioFactura;

	$sql_folioF = 'SELECT FolioFactura '
		. ' FROM facturaunidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY FechaFactura DESC LIMIT 1 ' ;

	$sql_folioF_R 	= mysqli_query($dbd2, $sql_folioF);
	$row_folioF_R 	= mysqli_fetch_array($sql_folioF_R);
			
	$FolioFactura 	= $row_folioF_R['FolioFactura'];
}



function facturaUxid($id_unidad){
	//global $conectar;
	global $dbd2;
	global $ProveedorU;
	global $FechaFacturaU;
	global $FolioFacturaU;
	global $ImporteU;
	global $nOrdenCU;

	$sql_folioF = 'SELECT * '
		. ' FROM facturaunidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' LIMIT 1 ' ;

	$sql_folioF_R 	= mysqli_query($dbd2, $sql_folioF);
	$row_folioF_R 	= mysqli_fetch_array($sql_folioF_R);
			
	$ProveedorU 	= $row_folioF_R['Proveedor'];
	$FechaFacturaU 	= $row_folioF_R['FechaFactura'];
	$FolioFacturaU 	= $row_folioF_R['FolioFactura'];
	$ImporteU 		= $row_folioF_R['Importe'];
	$nOrdenCU 		= $row_folioF_R['nOrdenC'];
}









function cVehicularxid($claveVehicular){
	//global $conectar;
	global $dbd2;
	global $cVempresaDescrip;
	global $cVmodeloDescrip;
	global $cVehicularDescrip;// VERSION

	$sql_cVeh = 'SELECT descripcion '
		. ' FROM cVehicular '
		. " WHERE claveVehicular like '%$claveVehicular' "
		. ' LIMIT 1 ' ;
	$sql_cVeh_R 	= mysqli_query($dbd2, $sql_cVeh);
	$row_cVeh_R 	= mysqli_fetch_array($sql_cVeh_R);
	$cVehicularDescrip 	= $row_cVeh_R['descripcion'];

	$id_empresa 	= substr($claveVehicular,0,3);
	$id_modelo 		= substr($claveVehicular,0,5);

	$sql_cVempresa = 'SELECT descripcion '
		. ' FROM cVempresa '
		. " WHERE id_empresa = '$id_empresa' "
		. ' LIMIT 1 ' ;
	$sql_cVempresa_R 	= mysqli_query($dbd2, $sql_cVempresa);
	$row_cVempresa_R 	= mysqli_fetch_array($sql_cVempresa_R);
	$cVempresaDescrip 	= $row_cVempresa_R['descripcion'];

	$sql_cVmodelo = 'SELECT descripcion '
		. ' FROM cVmodelo '
		. " WHERE id_modelo = '$id_modelo' "
		. ' LIMIT 1 ' ;
	$sql_cVmodelo_R 	= mysqli_query($dbd2, $sql_cVmodelo);
	$row_cVmodelo_R  	= mysqli_fetch_array($sql_cVmodelo_R);
	$cVmodeloDescrip 	= $row_cVmodelo_R['descripcion'];
}

function estadoxidEdo($id_estado){
	//global $conectar;
	global $dbd2;
	global $nombreE;
	global $iso31662E;

	$sql_E = 'SELECT * '
		. ' FROM estadosR '
		. " WHERE id_estado like '$id_estado' "
		. ' LIMIT 1 ' ;
	$sql_E_R 	= mysqli_query($dbd2, $sql_E);
	$row_E_R 	= mysqli_fetch_array($sql_E_R);
		
	$nombreE 	= $row_E_R['nombre'];
	$iso31662E 	= $row_E_R['iso31662'];
}


function buscaDocTC($id_unidad){
	global $dbd2;
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
		. ' ORDER BY expedicion DESC, fechareg DESC LIMIT 1 ';
	$sql_DTC_R 	= mysqli_query($dbd2, $sql_DTC);
	$row_DTC_R 	= mysqli_fetch_array($sql_DTC_R);

	$rutaTC 	= $row_DTC_R['ruta'];
	$ArchivoTC 	= $row_DTC_R['archivo'];
}


function buscaDocPS($id_unidad){
	global $dbd2;
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
	$sql_DPS_R 	= mysqli_query($dbd2, $sql_DPS);
	$row_DPS_R 	= mysqli_fetch_array($sql_DPS_R);

	$rutaPS 	= $row_DPS_R['ruta'];
	$ArchivoPS 	= $row_DPS_R['archivo'];
}


function buscaDocFA($id_unidad){
	global $dbd2;
	global $idFA;
	global $ArchivoFA;
	global $tipoFA;
	global $obsFA;
	global $rutaFA;

	$sql_DFA = 'SELECT id, archivo, tipo, obs, ruta ' 
		. ' FROM'
		. ' expedientes'
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND tipo = 1 '
		. " AND archivo LIKE '%.pdf' "
		. ' ORDER BY tipo ASC, fechareg DESC LIMIT 1 ';
	$sql_DFA_R 	= mysqli_query($dbd2, $sql_DFA);
	$row_DFA_R 	= mysqli_fetch_array($sql_DFA_R);

	$rutaFA 	= $row_DFA_R['ruta'];
	$ArchivoFA 	= $row_DFA_R['archivo'];
}


function buscaDocT($id_unidad, $anio){
	global $dbd2;
	global $idTN;
	global $ArchivoTN;
	global $tipoTN;
	global $obsTN;
	global $rutaTN;

	$sql_DTN = 'SELECT id, archivo, tipo, obs, ruta ' 
		. ' FROM'
		. ' expedientes'
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND tipo = 5 ' // tipo 5 es tenencia
		. " AND obs LIKE '%$anio%' "
		. ' LIMIT 1 ';
	$sql_DTN_R 	= mysqli_query($dbd2, $sql_DTN);
	$row_DTN_R 	= mysqli_fetch_array($sql_DTN_R);

	$rutaTN 	= $row_DTN_R['ruta'];
	$ArchivoTN 	= $row_DTN_R['archivo'];
}

function buscaDocIEU($id_unidad){ // INVENTARIO DE ENTREGA
	global $dbd2;
	global $idIEU;
	global $ArchivoIEU;
	global $tipoIEU;
	global $obsIEU;
	global $rutaIEU;

	$sql_Dieu = 'SELECT id, archivo, tipo, obs, ruta ' 
		. ' FROM'
		. ' expedientes'
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND tipo = 7 ' // INVENTARIO DE ENTREGA
		. ' ORDER BY fechareg DESC LIMIT 1 ';
	$sql_Dieu_R 	= mysqli_query($dbd2, $sql_Dieu);
	$row_Dieu_R 	= mysqli_fetch_array($sql_Dieu_R);

	$rutaIEU 		= $row_Dieu_R['ruta'];
	$ArchivoIEU 	= $row_Dieu_R['archivo'];
}


function buscaDocVA($id_unidad){ // VERIFICACION AMBIENTAL
	global $dbd2;
	global $idVA;
	global $ArchivoVA;
	global $tipoVA;
	global $obsVA;
	global $rutaVA;

	$sql_Dieu = ' SELECT id, archivo, tipo, obs, ruta ' 
		. ' FROM '
		. ' expedientes '
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND tipo = 4 ' // VERIFICACION AMBIENTAL
		. ' ORDER BY fechareg DESC LIMIT 1 ';
	$sql_Dieu_R 	= mysqli_query($dbd2, $sql_Dieu);
	$row_Dieu_R 	= mysqli_fetch_array($sql_Dieu_R);

	$rutaVA 		= $row_Dieu_R['ruta'];
	$ArchivoVA 		= $row_Dieu_R['archivo'];
}


function buscaDocTra($id_movFor){
	global $dbd2;
	global $id_doctoTra;
	global $ArchivoTra;
	//global $tipoTra;
	//global $obsTra;
	global $rutaTra;
	global $extension;

	$sql_DTra = 'SELECT id_docto, archivo, ruta, extension ' 
		. ' FROM '
		. ' movDocto '
		. " WHERE id_movFor = '$id_movFor' "
		. ' AND borrado = 0 '
//		. ' AND tipo = 3 '
		. ' ORDER BY fechareg DESC LIMIT 1 ';
	$sql_DTra_R 	= mysqli_query($dbd2, $sql_DTra);
	$row_DTra_R 	= mysqli_fetch_array($sql_DTra_R);

	$id_doctoTra = $row_DTra_R['id_docto'];
	$rutaTra 	= $row_DTra_R['ruta'];
	$ArchivoTra = $row_DTra_R['archivo'];
	$extension 	= $row_DTra_R['extension'];
}

// busca documento de una infraccion
function infDocto($id_inf){
	global $dbd2;
	global $id_docto;
	global $Archivo;
	//global $tipo;
	//global $obs;
	global $ruta;
	global $extension;
	global $nohubo;

	$sql_DTra = 'SELECT id_docto, archivo, ruta, extension ' 
		. ' FROM '
		. ' infDocto '
		. " WHERE id_inf = '$id_inf' "
		. ' AND borrado = 0 '
//		. ' AND tipo = 3 '
		. ' ORDER BY fechareg DESC LIMIT 1 ';
	$sql_DTra_R 	= mysqli_query($dbd2, $sql_DTra);
	$row_DTra_R 	= mysqli_fetch_array($sql_DTra_R);
	$nohubo 		= (mysqli_affected_rows($dbd2)==0)?'1':'0';

	$id_docto 	= $row_DTra_R['id_docto'];
	$ruta 		= $row_DTra_R['ruta'];
	$Archivo 	= $row_DTra_R['archivo'];
	$extension 	= $row_DTra_R['extension'];
}




// pendiente
function mttoAPRCxU($id_usuarioM, $fechainicio, $fechafinalQ3){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $dbd2;
global $mttoP; // O PENDIENTE
global $mttoA; // 1 AUTORIZADO
global $mttoR; // 2 3 4 INCOMPLETO REVISION RECHAZADO
global $mttoCC; // CANCELADOS STATUS 5

$mttoP  = 0; // O PENDIENTE
$mttoA  = 0; // 1 AUTORIZADO
$mttoR  = 0; // 2 3 4 INCOMPLETO REVISION RECHAZADO
$mttoCC = 0;

$sql_mAPRC 	= "	SELECT `autorizadoS` status, "
			."	count( autorizadoS ) totales "
			."	FROM `mttoSol` "
			."	WHERE capturo = '$id_usuarioM'  "
			."	AND  '$fechainicio' <=  `fechaEj` 
				AND   `fechaEj` <= '$fechafinalQ3' "
			."	GROUP BY autorizadoS";
$sql_mAPRC_R 	= mysqli_query($dbd2, $sql_mAPRC);

while ($fila = mysqli_fetch_assoc($sql_mAPRC_R) )
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
mysqli_free_result($sql_mAPRC_R);
}

//pendiente
function mttoAPRCxC($id_clienteM, $fechainicio, $fechafinalQ3){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $dbd2;
global $mttoP; // O PENDIENTE
global $mttoA; // 1 AUTORIZADO
global $mttoR; // 2 3 4 INCOMPLETO REVISION RECHAZADO
global $mttoCC; // CANCELADOS STATUS 5

$mttoP  = 0; // O PENDIENTE
$mttoA  = 0; // 1 AUTORIZADO
$mttoR  = 0; // 2 3 4 INCOMPLETO REVISION RECHAZADO
$mttoCC = 0;

	$sql_mAPRC 	= "	SELECT `autorizadoS` status, "
				."	count( autorizadoS ) totales "
				."	FROM `mttoSol` "
				."	WHERE id_cliente = '$id_cliente'  "
				."	AND  '$fechainicio' <=  `fechaEj` AND   `fechaEj` <= '$fechafinalQ3' "
				."	GROUP BY autorizadoS";
	$sql_mAPRC_R 	= mysqli_query($dbd2, $sql_mAPRC);

	while ($fila = mysqli_fetch_assoc($sql_mAPRC_R) )
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
mysqli_free_result($sql_mAPRC_R);
}

//pendiente
function mttoAPRCxP($id_provM, $fechainicio, $fechafinalQ3){ // AUTORIZADAS PENDIENTES RECHAZADAS CANCELADAS
global $dbd2;
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
$sql_mAPRC_R 	= mysqli_query($dbd2, $sql_mAPRC);

while ($fila = mysqli_fetch_assoc($sql_mAPRC_R) )
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
mysqli_free_result($sql_mAPRC_R);
}


function mttoSoportesUsuario($buscarUCP, $fechainicio, $fechafinalQ3, $tipoB){
// $buscarUCP ES EL VALOR BUSCADO
// $tipoB TIPO DE BUSQUEDA 1 USUARIO, 2 CLIENTE, 3 PROVEEDOR
	global $dbd2;
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
	$sql_Pg_R 	= mysqli_query($dbd2, $sql_Pg);
	$row_Pg_R 	= mysqli_fetch_array($sql_Pg_R);
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
	$sql_Fct_R 	= mysqli_query($dbd2, $sql_Fct);
	$row_Fct_R 	= mysqli_fetch_array($sql_Fct_R);
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
	$sql_SF_R 	= mysqli_query($dbd2, $sql_SF);
	$row_SF_R 	= mysqli_fetch_array($sql_SF_R);
	$sinfacturaMtto = $row_SF_R['NOfacturados'];

}

// pendiente // crea array
function contratosDelEjecutivo($id_usuario){
	global $dbd2;
	global $contratosArray;

	$sqlContratos 	= ' SELECT `id_contrato` '
					. ' FROM asignaEjecutivo '
					. " WHERE `id_usuario` = $id_usuario AND fecha_final IS NULL" ;

	$sqlCc_R		= mysqli_query($dbd2, $sqlContratos);

	while ($fila = mysqli_fetch_array($sqlCc_R	, MYSQL_ASSOC))
		{
			$contratosArray[] = $fila["id_contrato"];
		}
	mysqli_free_result($sqlCc_R);
}


// UNIDADES DEL CONTRATO
function unidadesDelContrato($id_contrato){
	global $dbd2;
	global $unidadesArray;

	$sqlUnidades 	= ' SELECT `id_unidad` '
					. ' FROM asignaUactual '
					. " WHERE `id_contrato` = $id_contrato " ;
					// AND fecha_final IS NULL" ;

	$sqlUs_R		= mysqli_query($dbd2, $sqlUnidades);

	while ($fila = mysqli_fetch_array($sqlUs_R	, MYSQL_ASSOC))
		{
			$unidadesArray[] = $fila["id_unidad"];
		}
	mysqli_free_result($sqlUs_R);
}


// ESTIMACIONES DEL CONTRATO
function estimacionesDelContrato($id_contrato){
	global $dbd2;
	global $estimacionesArray;

	$sqlEstimaciones 	= ' SELECT `id_estimacion` '
						. ' FROM estimacion '
						. " WHERE `id_contrato` = $id_contrato " ;
					// AND fecha_final IS NULL" ;

	$sqlEs_R		= mysqli_query($dbd2, $sqlEstimaciones);

	while ($fila = mysqli_fetch_array($sqlEs_R	, MYSQL_ASSOC))
		{
			$estimacionesArray[] = $fila["id_estimacion"];
		}
	mysqli_free_result($sqlEs_R);
}


function buscaFotoS($id_unidad){
	global $dbd2;
	global $idFS;
	global $ArchivoFS;
	global $tipoFS;
	global $obsFS;
	global $rutaFS;

	$sql_DFS = 'SELECT id_foto, archivo, tipo, obs, ruta ' 
		. ' FROM'
		. ' fotoUnidad'
		. " WHERE id_unidad = '$id_unidad ' "
		. ' AND borrar = 0 '
		. ' AND (tipo = 6 OR tipo = 7) '
		//. " AND archivo LIKE '%.pdf' "
		. ' ORDER BY tipo ASC, fechareg DESC LIMIT 1 ';
	$sql_DFS_R 	= mysqli_query($dbd2, $sql_DFS);
	$row_DFS_R 	= mysqli_fetch_array($sql_DFS_R);

	$rutaFS 	= $row_DFS_R['ruta'];
	$ArchivoFS 	= $row_DFS_R['archivo'];
}


/**/ // crea array
function mesTxtEsp($mesE){
	global $mesETxt;
$arrayMes = array('ENERO','FEBRERO','MARZO','ABRIL',
			'MAYO','JUNIO','JULIO','AGOSTO',
			'SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
$mesETxt = $arrayMes[$mesE - 1];
}



function estimacionxid($id_estimacion){
	global 	$dbd2 			;
	global 	$id_estimacion 	;
	global 	$id_cliente 	;
	global 	$id_contrato 	;
	global 	$mesE 			;
	global 	$anioE 			;
	global 	$montoEiI 		;
	global 	$fechaIn 		;
	global 	$fechaFn 		;
	global 	$d1 			;
	global 	$d2 			;
	global 	$d3 			;
	global 	$d4 			;
	global 	$d5 			;
	global 	$obs 			;
	global 	$fechareg 		;
	global 	$capturo 		;
	global 	$borrado 		;

	$sql_estRes = "	SELECT * FROM estimacion WHERE 
					id_estimacion = '$id_estimacion' 
				 	";
	// ORDER BY anioE DESC, mesE DESC 
					
	$sql_estRes_R 	= mysqli_query($dbd2, $sql_estRes);
	$row			= mysqli_fetch_array($sql_estRes_R);

	$id_estimacion 	= $row['id_estimacion'];
	$id_cliente 	= $row['id_cliente'];
	$id_contrato 	= $row['id_contrato'];
	$mesE 			= $row['mesE'];
	$anioE 			= $row['anioE'];
	$fechaIn 		= $row['fechaIn'];
	$fechaFn 		= $row['fechaFn'];
	$montoEiI 		= $row['montoEiI'];
	$d1 			= $row['d1Factura'];
	$d2 			= $row['d2Estimacion'];
	$d3 			= $row['d3OtroSoporte'];
	$d4 			= $row['d4Penaliza'];
	$d5 			= $row['d5CompPago'];
	$obs 			= $row['obs'];
	$fechareg 		= $row['fechareg'];
	$capturo 		= $row['capturo'];
	$borrado 		= $row['borrado'];
}


function montoPenaxid_estima($id_estimacion)
{
	global 	$dbd2 			;
	global 	$montoP 		;

	$sql_estPena = "	SELECT * FROM estimacionDocto WHERE 
					id_estimacion = '$id_estimacion' 
					AND tipo = 4 
					LIMIT 1
				 	";
	// ORDER BY anioE DESC, mesE DESC 

	$sql_estPena_R 	= mysqli_query($dbd2, $sql_estPena);
	$row			= mysqli_fetch_array($sql_estPena_R);
	$montoP 		= ($row['importeDto'] > 0)? $row['importeDto']: 0;
}


function estimacionArchivos($id_estimacion){

}


function descripPartida(){
	; //partidaXid_partida
}


function descripSubDiv2(){
	; //areaAXid_subDiv2
}


function descripSubDiv3(){
	; //areaAXid_subDiv3
}


// PARA PERIODOS DE VERIFICACION
function periodosVerif($terminacionN){
global 	$periodos 	;

$periodos1=' PRIMER PERIODO: ENERO A FEBRERO, SEGUNDO PERIODO:JULIO A AGOSTO';
$periodos2=' PRIMER PERIODO: FEBRERO A MARZO, SEGUNDO PERIODO:AGOSTO A SEPTIEMBRE';
$periodos3=' PRIMER PERIODO: MARZO A ABRIL, SEGUNDO PERIODO:SEPTIEMBRE A OCTUBRE';
$periodos4=' PRIMER PERIODO: ABRIL A MAYO, SEGUNDO PERIODO:OCTUBRE A NOVIEMBRE';
$periodos5=' PRIMER PERIODO: MAYO A JUNIO, SEGUNDO PERIODO:NOVIEMBRE A DICIEMBRE';

	$periodos = '';
	switch($terminacionN)
	{
		case "5":
			$periodos .= $periodos1;
			break;
		case "6":
			$periodos .= $periodos1;
			break;
		case "7":
			$periodos .= $periodos2;
			break;
		case "8":
			$periodos .= $periodos2;
			break;
		case "3":
			$periodos .= $periodos3;
			break;
		case "4":
			$periodos .= $periodos3;
			break;
		case "1":
			$periodos .= $periodos4;
			break;
		case "2":
			$periodos .= $periodos4;
			break;
		case "9":
			$periodos .= $periodos5;
			break;
		case "0":
			$periodos .= $periodos5;
			break;
		default:
			break;
	}
}


function sustitutosContratoDesgloce($id_contrato, $colDesgloce, $colDesgloceDet){
global 	$dbd2		;
global 	$subTotalS 	;

$sql_DesgloceS = " SELECT $colDesgloce tipoDesgloce, COUNT($colDesgloce) subTotalS "
			." FROM `asignaUactual` "
			." WHERE id_contrato = $id_contrato "
			." AND $colDesgloce = $colDesgloceDet  "
			." AND tipoAsig = 2 " ;
// GROUP BY $colDesgloce

	$sql_DesgloceS_R 	= mysqli_query($dbd2, $sql_DesgloceS);
	$row				= mysqli_fetch_array($sql_DesgloceS_R);
	$subTotalS 			= $row['subTotalS'];
}


function infraccionesXid_unidad($id_unidad){
global 	$dbd2			;
global 	$infracciones 	;

	$sql_infS =   'SELECT COUNT(id_inf) infracciones '
				. ' FROM infraccion '
		 		. " WHERE id_unidad = '$id_unidad' " ;

	$sql_infS_R 	= mysqli_query($dbd2, $sql_infS);
	$row			= mysqli_fetch_array($sql_infS_R);
	$infracciones 	= $row['infracciones'];
}


function fechaExtendidaXid_contrato($id_contrato){
	global 	$dbd2			;
	global 	$fechaExtendida ;

	$sql_fE =   'SELECT fechafin as fechaExtendida '
				. ' FROM clbCtoConv '
		 		. " WHERE id_contrato = '$id_contrato' " 
		 		. " ORDER BY fechafin DESC LIMIT 1 " ;

	$sql_fE_R 		= mysqli_query($dbd2, $sql_fE);
	$row			= mysqli_fetch_array($sql_fE_R);
	$fechaExtendida = $row['fechaExtendida'];
}


function provTieneCredito($id_prov){
	global 	$dbd2	;
	global 	$credito ;

	$sql_pTc =   'SELECT credito  '
				. ' FROM provAlta '
		 		. " WHERE id_prov = '$id_prov' " ;
		 		//. " ORDER BY fechafin DESC LIMIT 1 " ;

	$sql_pTc_R 		= mysqli_query($dbd2, $sql_pTc);
	$row			= mysqli_fetch_array($sql_pTc_R);
	$credito 		= $row['credito'];
}



// hacer array de motivo de traslado
function motivoMov($motivoM){
	global 	$motivoTxt ;

	$arrayMtv = array(
			"NO SE INDICO", 
			"Cambio de patio", 
			"Camb​io de proyecto ​por sust.",
			"Cortesía",
			"Integración a proyecto",
			"Recolección",
			"​Resguardo​",
			"Sustituto",
			"Taller o servicio",
			"Termino de proyecto",
			"Verificación",
			"Conversión/equipamiento",
			"​Venta​",
			"Regresa a Proyecto",
			"Reubicación por Dependencia"
			);

	$motivoTxt = $arrayMtv[$motivoM];
}


function estimacionDts($id_estimacion){
	global 	$dbd2	;
	global 	$id_contrato 	;
	global 	$id_cliente 	;

	$sql_Est =   'SELECT id_contrato, id_cliente  '
				. ' FROM estimacion '
		 		. " WHERE id_estimacion = '$id_estimacion' " ;
		 		//. " ORDER BY fechafin DESC LIMIT 1 " ;

	$sql_Est_R 		= mysqli_query($dbd2, $sql_Est);
	$row			= mysqli_fetch_array($sql_Est_R);
	$id_contrato 	= $row['id_contrato'];
	$id_cliente 	= $row['id_cliente'];
}


// JADE FOX, AUNQUE LEAS BIEN NO SABES COMO FUNCIONA JAJAJAJA

function sgtoMtto($id_mttoSol){
	global 	$dbd2	;
	global 	$fechaET ;
	global 	$horaET ;
	global 	$fechaST ;
	global 	$horaST ;
	global 	$fechaAP ;
	global 	$horaAP ;
	global 	$fechaTT ;
	global 	$horaTT ;
	global 	$fechaPg ;
	global 	$horaPg ;
	global 	$fechaSol ;
	global 	$horaSol ;

	$sql_Sgto =    ' SELECT *  '
				. ' FROM mttoSolSgto '
		 		. " WHERE id_mttoSol = '$id_mttoSol' limit 1 " ;
		 		//. " ORDER BY fechafin DESC LIMIT 1 " ;

	$sql_Sgto_R 	= mysqli_query($dbd2, $sql_Sgto);
	$row			= mysqli_fetch_array($sql_Sgto_R);

	$fechaET 	= $row['fechaET'];
	$horaET 	= $row['horaET'];
	$fechaST 	= $row['fechaST'];
	$horaST 	= $row['horaST'];
	$fechaAP 	= $row['fechaAP'];
	$horaAP 	= $row['horaAP'];
	$fechaTT 	= $row['fechaTT'];
	$horaTT 	= $row['horaTT'];
	$fechaPg 	= $row['fechaPg'];
	$horaPg 	= $row['horaPg'];
	$fechaSol 	= $row['fechaSol'];
	$horaSol 	= $row['horaSol'];
}

function sgtoMttoExiste($id_mttoSol){
global $dbd2;
global $id_sgto;

$sql_SgtoE   = "SELECT id_sgto 
				FROM mttoSolSgto 
				WHERE id_mttoSol = '$id_mttoSol' 
				limit 1 ";
$sql_SgtoE_R = mysqli_query($dbd2, $sql_SgtoE);
$existe 	 = mysqli_affected_rows($dbd2);

	if( $existe == 0 )
	{
		$sql_SgtoI 		= "	INSERT INTO mttoSolSgto 
							(id_sgto, id_mttoSol) 
							VALUES 
							(NULL, '$id_mttoSol')";
		$sql_SgtoI_R 	= mysqli_query($dbd2, $sql_SgtoI);
		$id_sgto 		= mysqli_insert_id($dbd2);
	}
	else
	{
		$sql_SgtoE_M = mysqli_fetch_assoc($sql_SgtoE_R);
		$id_sgto 	 = $sql_SgtoE_M['id_sgto'];
	}
}



function solAtnAnexo($id_solAtn){
	global $dbd2;

	global $archivoSA;
	global $rutaSA;

	$sql_DTC = 'SELECT id_docto, archivo, ruta ' 
		. ' FROM '
		. ' mttoDocto '
		. " WHERE id_solAtn = '$id_solAtn' "
		. ' AND borrado = 0 '
		. ' AND tipo = 5 '
		. ' ORDER BY id_docto ASC LIMIT 1 ';

	$sql_DTC_R 	= mysqli_query($dbd2, $sql_DTC);
	$row_DTC_R 	= mysqli_fetch_array($sql_DTC_R);

	$rutaSA 	= $row_DTC_R['ruta'];
	$archivoSA 	= $row_DTC_R['archivo'];
}


function mttoSolSgto($id_mttoSol){
	global $dbd2;
	global $fechaST;

	$sql_mSS =    ' SELECT fechaST ' 
				. ' FROM '
				. ' mttoSolSgto '
				. " WHERE id_mttoSol = '$id_mttoSol' ";
		//. ' AND borrado = 0 '
		//. ' AND tipo = 5 '
	//	. ' ORDER BY id_docto ASC LIMIT 1 ';

	$sql_mSS_R 	= mysqli_query($dbd2, $sql_mSS);
	$row_mSS_R 	= mysqli_fetch_array($sql_mSS_R);

	$fechaST 	= $row_mSS_R['fechaST'];
}




?>