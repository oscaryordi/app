<?php
// UTILIZADO EN VARIAS BUSQUEDAS AJAX
// referido en asignaejecutivo.php
// referido en mttoSol.php

include_once('base.inc.php');
include_once('funcion.php');
// BUSCAR SERIE DE AUTO

@$search1 = mysqli_real_escape_string($dbd2, $_POST['search1']);
if(!empty($search1)) 	
	{
		$sql3 = 'SELECT id, Serie, Economico, Vehiculo, Modelo, Color '
		. ' FROM '
		. ' ubicacion '
		. " WHERE Serie LIKE '$search1%' LIMIT 10 ";
		
		$search_query = mysqli_query($dbd2, $sql3);
		if(!$search_query) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_unidad'>";   
			while($row = mysqli_fetch_array($search_query)) 
			{
				$id 		= $row['id'];
				$Serie 		= $row['Serie'];
				$Economico 	= $row['Economico'];
				$Vehiculo 	= $row['Vehiculo'];
				$Modelo 	= $row['Modelo'];
				$Color 		= $row['Color'];

				echo "<option value='{$id}'>{$Economico} ::: {$Serie} ::: {$Vehiculo} ::: {$Modelo} ::: {$Color}</option>";
			}
		echo "</select>"; 
	$filas = mysqli_num_rows($search_query);
	$xz = ($filas > 0)?"":"No hay coincidencias en BD";
	echo $xz;
	}


// inicio BUSCAR RFC CLIENTE
@$search5 = mysqli_real_escape_string($dbd2, $_POST['search5']);
if(!empty($search5)) 	
	{
		$sql4 = 'SELECT id_cliente, rfc, razonSocial, alias '
		. ' FROM '
		. ' claCliente '
		. " WHERE rfc LIKE '$search5%' LIMIT 10 ";
		
		$search_query2 = mysqli_query($dbd2, $sql4);
		if(!$search_query2) 
		{
		   die('QUERY FAILED' . mysqli_error($dbd2));
		}
		$mensajeSelect = '';
		$mensajeSelect = ( mysqli_num_rows($search_query2) == 0 )?' -- No hay coincidencias -- ':' -- Elija una opción -- ';

		echo "<select name='id_cliente' id='search6' onchange='buscaContratos(this);' >"; 
		echo "<option  value='0'>$mensajeSelect</option>";	 
		while($row = mysqli_fetch_array($search_query2))
		{
			
			$id_cliente 	= $row['id_cliente'];
			$rfc 			= $row['rfc'];
			$alias 			= $row['alias'];
			$razonSocial 	= $row['razonSocial'];

			echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
		}
		echo "</select>"; 
	$filas2 = mysqli_num_rows($search_query2);
	$xz2 = ($filas2 > 0)?"":"No hay coincidencias en BD";
	echo $xz2;
	}	
// fin BUSCAR RFC CLIENTE


// inicio BUSCAR CONTRATO
@$search6 = mysqli_real_escape_string($dbd2, $_POST['search6']);
if(!empty($search6))
	{
		$sql5 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_cliente = '$search6' AND tipoC = 0 ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query3 = mysqli_query($dbd2, $sql5);
		if(!$search_query3) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato' id='search26' onchange='buscaAreaAd(this);buscaPartida(this);' >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query3)) 
		{
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan 		= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

				$sql_unidades 		= "	SELECT count( id_unidad ) unidades FROM asignaUactual 
										WHERE id_contrato = '$id_contrato' ";
				$sql_unidades_res 	= mysqli_query($dbd2, $sql_unidades);
				$unidades_matriz	= mysqli_fetch_array($sql_unidades_res);
				$unidadesCto 		= $unidades_matriz['unidades'];



				echo "<option value='{$id_contrato}'>ctebd-{$id_cliente} ctobd-{$id_contrato} ::: IdAlan {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin} ::: UNIDADES  <b>{$unidadesCto}</b> </option>";
		}
		echo "</select>"; 
	$filas3 = mysqli_num_rows($search_query3);
	$xz3 = ($filas3 > 0)?"":"No hay coincidencias en BD";
	echo $xz3;
	}	
// fin BUSCAR CONTRATO



// inicio BUSCAR EJECUTIVO
@$search7 = mysqli_real_escape_string($dbd2, $_POST['search7']);
if(!empty($search7)) 	
	{
		$sql7 = 'SELECT id_usuario, nombre, usuario '
		. ' FROM '
		. ' usuarios '
		. " WHERE nombre LIKE '%$search7%' LIMIT 10 ";
		
		$search_query7 = mysqli_query($dbd2, $sql7);
		if(!$search_query7) 
		   {
		   die('QUERY FAILED ' . mysqli_error($dbd2));
		   }
		echo "<select name='id_usuario'>";   
		while($row = mysqli_fetch_array($search_query7)) 
		{
			
			$id_usuario = $row['id_usuario'];
			$nombre 	= $row['nombre'];
			$usuario 	= $row['usuario'];

			echo "<option value='{$id_usuario}'>{$id_usuario} ::: {$nombre} :: {$usuario} </option>";
		}
			echo "</select>"; 
	$filas7 = mysqli_num_rows($search_query7);
	$xz7 = ($filas7 > 0)?"":"No hay coincidencias en BD";
	echo $xz7;
	}	
// fin BUSCAR EJECUTIVO


// inicio BUSCAR RAZON SOCIAL CLIENTE
@$search8 = mysqli_real_escape_string($dbd2, $_POST['search8']);
if(!empty($search8)) 	
	{
		
		$sql8 = 'SELECT id_cliente, rfc, razonSocial, alias '
		. ' FROM '
		. ' claCliente '
		. " WHERE razonSocial LIKE '%$search8%' LIMIT 10 ";
		
		$search_query8 = mysqli_query($dbd2, $sql8);
		if(!$search_query8) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_cliente' id='search8' onchange='buscaContratos(this);' >"; 
		echo "<option value='0'> -- </option>";	 
		while($row = mysqli_fetch_array($search_query8)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$rfc 			= $row['rfc'];
			$alias 			= $row['alias'];
			$razonSocial 	= $row['razonSocial'];

			echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
		}
		echo "</select>"; 
	$filas8 = mysqli_num_rows($search_query8);
	$xz8 = ($filas8 > 0)?"":"No hay coincidencias en BD";
	echo $xz8;
	}	
// fin BUSCAR RAZON SOCIAL CLIENTE



// inicio BUSCAR ALIAS CLIENTE
@$search9 = mysqli_real_escape_string($dbd2, $_POST['search9']);
if(!empty($search9)) 	
	{
		$sql9 = 'SELECT id_cliente, rfc, razonSocial, alias '
		. ' FROM '
		. ' claCliente '
		. " WHERE alias LIKE '%$search9%' LIMIT 10 ";
		
		$search_query9 = mysqli_query($dbd2, $sql9);
		if(!$search_query9) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_cliente' id='search9' onchange='buscaContratos(this);' >"; 
		echo "<option value='0'> -- </option>";	 
		while($row = mysqli_fetch_array($search_query9)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$rfc 			= $row['rfc'];
			$alias 			= $row['alias'];
			$razonSocial 	= $row['razonSocial'];

			echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
		}
		echo "</select>"; 
	$filas9 = mysqli_num_rows($search_query9);
	$xz9 = ($filas9 > 0)?"":"No hay coincidencias en BD";
	echo $xz9;
	}	
// fin BUSCAR ALIAS CLIENTE


// inicio BUSCAR CONTRATO por id alan
@$search10 = mysqli_real_escape_string($dbd2, $_POST['search10']);
if(!empty($search10)) 	
	{
		$sql10 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_alan LIKE '$search10%' AND borrado = 0 ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query10 = mysqli_query($dbd2, $sql10);
		if(!$search_query10) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query10)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan	 	= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

					echo "<option value='{$id_contrato}'>ctobd{$id_contrato} ::: ID ALAN {$id_alan} 
					::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
			}
		echo "</select>"; 
	$filas10 = mysqli_num_rows($search_query10);
	$xz10 = ($filas10 > 0)?"":"No hay coincidencias en BD";
	echo $xz10;
	}	
// fin BUSCAR CONTRATO por id alan



// inicio BUSCAR CONTRATO por NUMERO OFICIAL
@$search11 = mysqli_real_escape_string($dbd2, $_POST['search11']);
if(!empty($search11)) 	
	{
		$sql11 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE numero LIKE '%$search11%'  AND borrado = 0 ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query11 = mysqli_query($dbd2, $sql11);
		if(!$search_query11) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query11)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$id_contrato 	= $row['id_contrato'];
			$id_alan	 	= $row['id_alan'];
			$numero 		= $row['numero'];
			$aliasCto 		= $row['aliasCto'];
			$fechainicio 	= $row['fechainicio'];
			$fechafin 		= $row['fechafin'];

			echo "<option value='{$id_contrato}'>ctobd{$id_contrato} ::: ID ALAN {$id_alan} 
				::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
		}
		echo "</select>"; 
	$filas11 = mysqli_num_rows($search_query11);
	$xz11 = ($filas11 > 0)?"":"No hay coincidencias en BD";
	echo $xz11;
	}	
// fin BUSCAR CONTRATO por NUMERO OFICIAL



// inicio BUSCAR CONTRATO por ALIAS
@$search12 = mysqli_real_escape_string($dbd2, $_POST['search12']);
if(!empty($search12)) 	
	{
		$sql12 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE aliasCto LIKE '%$search12%' AND borrado = 0  ORDER BY  id_alan DESC LIMIT 25 ";
		
		$search_query12 = mysqli_query($dbd2, $sql12);
		if(!$search_query12) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query12)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan	 	= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

					echo "<option value='{$id_contrato}'>ctobd{$id_contrato} ::: ID ALAN {$id_alan} 
					::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
				}
		echo "</select>"; 
	$filas12 	= mysqli_num_rows($search_query12);
	$xz12 		= ($filas12 > 0)?"":"No hay coincidencias en BD";
	echo $xz12;
	}	
// fin BUSCAR CONTRATO por ALIAS



// inicio BUSCAR CONTRATO por id alan OBTENER ID_CONTRATO
@$search13 = mysqli_real_escape_string($dbd2, $_POST['search13']);
if(!empty($search13)) 	
	{
		$sql13 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_alan LIKE '$search13%' ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query13 = mysqli_query($dbd2, $sql13);
		if(!$search_query13) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato' required>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query13)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$id_contrato 	= $row['id_contrato'];
			$id_alan	 	= $row['id_alan'];
			$numero 		= $row['numero'];
			$aliasCto 		= $row['aliasCto'];
			$fechainicio 	= $row['fechainicio'];
			$fechafin 		= $row['fechafin'];

			echo "<option value='{$id_contrato}'>{$id_cliente} ::: ID ALAN {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
		}
		echo "</select>"; 
	$filas13 = mysqli_num_rows($search_query13);
	$xz13 = ($filas13 > 0)?"":"No hay coincidencias en BD";
	echo $xz13;
	}	
// fin BUSCAR CONTRATO por id alan OBTENER ID_CONTRATO



// inicio BUSCAR PROVEEDOR CON EL RFC
@$search14 = mysqli_real_escape_string($dbd2, $_POST['search14']);
if(!empty($search14)) 	
	{
		$sql14 = 'SELECT id_prov, rfc, razonSocial '
		. ' FROM '
		. ' provAlta '
		. " WHERE rfc LIKE '$search14%' AND suspendido = 0 ORDER BY razonSocial DESC LIMIT 10 ";
		
		$search_query14 = mysqli_query($dbd2, $sql14);
		if(!$search_query14) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_prov' id='search15' onchange='buscaSucursal(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query14)) {
				$id_prov 		= $row['id_prov'];
				$rfc 			= $row['rfc'];
				$razonSocial	= $row['razonSocial'];
				

					echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} </option>";
 		}
		echo "</select>"; 
	$filas14 = mysqli_num_rows($search_query14);
	$xz14 = ($filas14 > 0)?"":"No hay coincidencias en BD";
	echo $xz14;
	}	
// fin BUSCAR PROVEEDOR CON EL RFC



// inicio BUSCAR CUENTA
@$search16 = mysqli_real_escape_string($dbd2, $_POST['search15']);
if(!empty($search16)) 	
	{
		$sql16 = 'SELECT id_cuenta, cuenta, clabe, banco, sucursal '
		. ' FROM '
		. ' provBanco '
		. " WHERE id_prov = '$search16' AND suspendido = 0 ORDER BY fechareg DESC LIMIT 10 ";
		
		$search_query16 = mysqli_query($dbd2, $sql16);
		if(!$search_query16) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Cuenta ----->";   
		echo "<select name='id_cuenta' >";
		//echo "<option value = '0' > -- </option>"; 
		while($row = mysqli_fetch_array($search_query16)) 
		{
				$id_cuenta 	= $row['id_cuenta'];
				$cuenta 	= $row['cuenta'];
				$clabe		= $row['clabe'];
				$banco		= $row['banco'];
				$sucursal	= $row['sucursal'];

					echo "<option value='{$id_cuenta}'>Cta-{$cuenta} ::: Cbe-{$clabe} ::: Bco-{$banco} ::: Suc-{$sucursal}</option>";
  		}
			echo "</select>"; 
	$filas16 	= mysqli_num_rows($search_query16);
	$xz16 		= ($filas16 > 0)?"":"No hay coincidencias en BD"; // IF COMPACTADO , ES UN IF ABREVIADO
	echo $xz16;
	}
// fin BUSCAR CUENTA



// inicio BUSCAR SUCURSAL
@$search15 = mysqli_real_escape_string($dbd2, $_POST['search15']);
if(!empty($search15)) 	
	{
		$sql15 = 'SELECT id_sucursal, nombreSucursal, calleNumero, municipio, estado '
		. ' FROM '
		. ' provSucursal '
		. " WHERE id_prov = '$search15' ORDER BY fechareg DESC LIMIT 10 ";
		
		$search_query15 = mysqli_query($dbd2, $sql15);
		if(!$search_query15) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<br>Seleccione Sucursal --->";	  
		echo "<select name='id_sucursal' >";
		echo "<option value = '0' > -- </option>"; 
		while($row = mysqli_fetch_array($search_query15)) 
		{
				$id_sucursal 	= $row['id_sucursal'];
				$nombreSucursal = $row['nombreSucursal'];
				$calleNumero	= $row['calleNumero'];
				$municipio		= $row['municipio'];
				$estado			= $row['estado'];

				echo "<option value='{$id_sucursal}'>Sc-{$id_sucursal} ::: Nombre-{$nombreSucursal} ::: CyN-{$calleNumero} ::: Mpio-{$municipio} ::: Edo-{$estado} </option>";
		}
			echo "</select>"; 
	$filas15 = mysqli_num_rows($search_query15);
	$xz15 = ($filas15 > 0)?"":"No hay coincidencias en BD";
	echo $xz15;
	}
// fin BUSCAR SUCURSAL



// inicio BUSCAR PROVEEDOR CON EL NOMBRE PARCIAL
@$search17 = mysqli_real_escape_string($dbd2, $_POST['search17']);
if(!empty($search17)) 	
	{
		$sql17 = 'SELECT id_prov, rfc, razonSocial '
		. ' FROM '
		. ' provAlta '
		. " WHERE razonSocial LIKE '%$search17%' ORDER BY razonSocial ASC LIMIT 10 ";
		
		$search_query17 = mysqli_query($dbd2, $sql17);
		if(!$search_query17) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_prov' id='search15' onchange='buscaSucursal(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query17)) 
		{
				$id_prov 		= $row['id_prov'];
				$rfc 			= $row['rfc'];
				$razonSocial	= $row['razonSocial'];

				echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} </option>";
		}
			echo "</select>"; 
	$filas17 = mysqli_num_rows($search_query17);
	$xz17 = ($filas17 > 0)?"":"No hay coincidencias en BD";
	echo $xz17;
	}	
// fin BUSCAR PROVEEDOR CON EL NOMBRE PARCIAL



// inicio BUSCAR PROVEEDOR POR ESTADO
@$search18 = mysqli_real_escape_string($dbd2, $_POST['search18']);
if(!empty($search18)) 	
	{
		$sql18 = 'SELECT id_prov, rfc, razonSocial, municipio, estado '
		. ' FROM '
		. ' provAlta '
		. " WHERE estado LIKE '%$search18%' ORDER BY razonSocial ASC LIMIT 10 ";
		
		$search_query18 = mysqli_query($dbd2, $sql18);
		if(!$search_query18) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_prov' id='search15' onchange='buscaSucursal(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query18)) 
		{
			$id_prov 		= $row['id_prov'];
			$rfc 			= $row['rfc'];
			$razonSocial	= $row['razonSocial'];
			$municipio		= $row['municipio'];
			$estado			= $row['estado'];

			echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} ::: {$municipio} ::: {$estado} </option>";
		}
		echo "</select>"; 
	$filas18 = mysqli_num_rows($search_query18);
	$xz18 = ($filas18 > 0)?"":"No hay coincidencias en BD";
	echo $xz18;
	}	
// fin BUSCAR PROVEEDOR POR ESTADO



// inicio BUSCAR CLIENTE PARA REGISTRO DE TRASLADO
@$search19 = mysqli_real_escape_string($dbd2, $_POST['search19']);
if(!empty($search19)) 	
	{
		$sql19 = 'SELECT id_cliente, rfc, razonSocial, alias '
		. ' FROM '
		. ' claCliente '
		. " WHERE razonSocial LIKE '%$search19%' LIMIT 10 ";
		
		$search_query19 = mysqli_query($dbd2, $sql19);
		if(!$search_query19) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_clienteXR' id='search19' >"; 
		echo "<option value='0'> -- </option>";	 
		while($row = mysqli_fetch_array($search_query19)) 
		{
			$id_clienteXR 	= $row['id_cliente'];
			$rfcXR 			= $row['rfc'];
			$aliasXR 		= $row['alias'];
			$razonSocialXR 	= $row['razonSocial'];

			echo "<option value='{$id_clienteXR}'>{$id_clienteXR} ::: {$rfcXR} ::: {$aliasXR} ::: {$razonSocialXR}</option>";
		}
		echo "</select>"; 
	$filas19 = mysqli_num_rows($search_query19);
	$xz19 = ($filas19 > 0)?"":"No hay coincidencias en BD";
	echo $xz19;
	}	
// fin BUSCAR CLIENTE PARA REGISTRO DE TRASLADO



// inicio BUSCAR CLIENTE PARA REGISTRO DE TRASLADO
// inicio BUSCAR ALIAS CLIENTE
@$search20 = mysqli_real_escape_string($dbd2, $_POST['search20']);
if(!empty($search20)) 	
	{
		
		$sql20 = 'SELECT id_cliente, rfc, razonSocial, alias '
		. ' FROM '
		. ' claCliente '
		. " WHERE alias LIKE '%$search20%' LIMIT 10 ";
		
		$search_query20 = mysqli_query($dbd2, $sql20);
		if(!$search_query20) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_clienteXA' id='search20'  >"; 
		echo "<option value='0'> -- </option>";	 
		while($row = mysqli_fetch_array($search_query20)) 
		{
			$id_clienteXA 	= $row['id_cliente'];
			$rfcXA 			= $row['rfc'];
			$aliasXA 		= $row['alias'];
			$razonSocialXA 	= $row['razonSocial'];

			echo "<option value='{$id_clienteXA}'>{$id_clienteXA} ::: {$rfcXA} ::: {$aliasXA} ::: {$razonSocialXA}</option>";
		}
		echo "</select>"; 
	$filas20 	= mysqli_num_rows($search_query20);
	$xz20 		= ($filas20 > 0)?"":"No hay coincidencias en BD"; // IF ABREVIADO
	echo $xz20;
	}	
// fin BUSCAR ALIAS CLIENTE
// fin BUSCAR CLIENTE PARA REGISTRO DE TRASLADO



// inicio BUSCAR PROVEEDOR CON EL ALIAS
@$search21 = mysqli_real_escape_string($dbd2, $_POST['search21']);
if(!empty($search21)) 	
	{
		$sql21 = 'SELECT id_prov, rfc, razonSocial, aliasProv '
		. ' FROM '
		. ' provAlta '
		. " WHERE aliasProv LIKE '%$search21%' ORDER BY razonSocial ASC LIMIT 10 ";
		
		$search_query21 = mysqli_query($dbd2, $sql21);
		if(!$search_query21) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_prov' id='search21' onchange='buscaSucursal(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query21)) 
		{
			$id_prov 		= $row['id_prov'];
			$rfc 			= $row['rfc'];
			$razonSocial	= $row['razonSocial'];
			$aliasProv		= $row['aliasProv'];

			echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} ::: alias {$aliasProv} </option>";
		}
		echo "</select>"; 
	$filas21 = mysqli_num_rows($search_query21);
	$xz21 = ($filas21 > 0)?"":"No hay coincidencias en BD";
	echo $xz21;
	}	
// fin BUSCAR PROVEEDOR CON EL ALIAS





// inicio BUSCAR RFC CLIENTE // PARA DESTINO TRASLADO
@$search22 = mysqli_real_escape_string($dbd2, $_POST['search22']);
if(!empty($search22)) 	
	{
		$sql22 = 'SELECT id_cliente, rfc, razonSocial, alias '
		. ' FROM '
		. ' claCliente '
		. " WHERE rfc LIKE '$search22%' LIMIT 10 ";
		
		$search_query22 = mysqli_query($dbd2, $sql22);
		if(!$search_query22) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_clienteD' id='search23' onchange='buscaContratosD(this);' >"; 
		echo "<option value='0'> -- </option>";	 
		while($row = mysqli_fetch_array($search_query22)) 
		{
			
			$id_cliente 	= $row['id_cliente'];
			$rfc 			= $row['rfc'];
			$alias 			= $row['alias'];
			$razonSocial 	= $row['razonSocial'];

			echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
		}
		echo "</select>"; 
	$filas22 = mysqli_num_rows($search_query22);
	$xz22 = ($filas22 > 0)?"":"No hay coincidencias en BD";
	echo $xz22;
	}	
// fin BUSCAR RFC CLIENTE





// inicio BUSCAR CONTRATO // PARA DESTINO TRASLADO
@$search23 = mysqli_real_escape_string($dbd2, $_POST['search23']);
if(!empty($search23)) 	
	{
		$sql23 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_cliente = '$search23' ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query23 = mysqli_query($dbd2, $sql23);
		if(!$search_query23) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contratoD'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query23)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$id_contrato 	= $row['id_contrato'];
			$id_alan 		= $row['id_alan'];
			$numero 		= $row['numero'];
			$aliasCto 		= $row['aliasCto'];
			$fechainicio 	= $row['fechainicio'];
			$fechafin 		= $row['fechafin'];

			$sql_unidades 		= "SELECT count( id_unidad ) unidades FROM asignaUactual 
							WHERE id_contrato = '$id_contrato' ";
			$sql_unidades_res 	=  mysqli_query($dbd2, $sql_unidades);
			$unidades_matriz	= mysqli_fetch_array($sql_unidades_res);
			$unidadesCto 		= $unidades_matriz['unidades'];

			echo "<option value='{$id_contrato}'>ctebd-{$id_cliente} ctobd-{$id_contrato}::: IdAlan {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin} ::: UNIDADES  <b>{$unidadesCto}</b> </option>";
		}
		echo "</select>"; 
	$filas23 = mysqli_num_rows($search_query23);
	$xz23 = ($filas23 > 0)?"":"No hay coincidencias en BD";
	echo $xz23;
	}	
// fin BUSCAR CONTRATO


// inicio BUSCAR PROVEEDOR CON EL NOMBRE PARCIAL // PARA CONSULTA REFERENCIA
@$search24 = mysqli_real_escape_string($dbd2, $_POST['search24']);
if(!empty($search24)) 	
	{
		$sql24 = 'SELECT id_prov, rfc, razonSocial '
		. ' FROM '
		. ' provAlta '
		. " WHERE razonSocial LIKE '%$search24%' ORDER BY razonSocial ASC LIMIT 10 ";
		
		$search_query24 = mysqli_query($dbd2, $sql24);
		if(!$search_query24) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_provCR' >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query24)) 
		{
			$id_prov 		= $row['id_prov'];
			$rfc 			= $row['rfc'];
			$razonSocial	= $row['razonSocial'];

			echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} </option>";	
		}
		echo "</select>"; 
	$filas24 = mysqli_num_rows($search_query24);
	$xz24 = ($filas24 > 0)?"":"No hay coincidencias en BD";
	echo $xz24;
	}	
// fin BUSCAR PROVEEDOR CON EL NOMBRE PARCIAL // PARA CONSULTA REFERENCIA


// inicio BUSCAR PROVEEDOR CON EL ALIAS // PARA CONSULTA REFERENCIA
@$search25 = mysqli_real_escape_string($dbd2, $_POST['search25']);
if(!empty($search25)) 	
	{
		$sql25 = 'SELECT id_prov, rfc, razonSocial, aliasProv '
		. ' FROM '
		. ' provAlta '
		. " WHERE aliasProv LIKE '%$search25%' ORDER BY razonSocial ASC LIMIT 10 ";
		
		$search_query25 = mysqli_query($dbd2, $sql25);
		if(!$search_query25) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_provCRA' id='search25' >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query25)) 
		{
			$id_prov 		= $row['id_prov'];
			$rfc 			= $row['rfc'];
			$razonSocial	= $row['razonSocial'];
			$aliasProv		= $row['aliasProv'];

			echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} ::: alias {$aliasProv} </option>";
		}
		echo "</select>"; 
	$filas25 = mysqli_num_rows($search_query25);
	$xz25 = ($filas25 > 0)?"":"No hay coincidencias en BD";
	echo $xz25;
	}	
// fin BUSCAR PROVEEDOR CON EL ALIAS // PARA CONSULTA REFERENCIA





// inicio BUSCAR AREA ADMINISTRATIVA
@$search26 = mysqli_real_escape_string($dbd2, $_POST['search26']);
if(!empty($search26))
	{
		$sql26 = 'SELECT id_cliente, id_contrato, id_subDiv2, descripcion '
		. ' FROM '
		. ' clbSubDiv2 '
		. " WHERE id_contrato = '$search26' ORDER BY descripcion ASC LIMIT 200 ";
		
		$search_query26 = mysqli_query($dbd2, $sql26);
		if(!$search_query26) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_subDiv2'  id='search35'  onchange='buscaSubAreaAd(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query26)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_subDiv2 	= $row['id_subDiv2'];
				$descripcion 	= $row['descripcion'];

				$sql_unidadesSD 		= "SELECT count( id_unidad ) unidades "
										."	FROM asignaUactual "
										."	WHERE id_subDiv2 = '$id_subDiv2' ";
				$sql_unidadesSD_res 	=  mysqli_query($dbd2, $sql_unidadesSD);
				$unidades_matrizSD		= mysqli_fetch_array($sql_unidadesSD_res);
				$unidadesCtoSD 			= $unidades_matrizSD['unidades'];

					echo "<option value='{$id_subDiv2}'>ctebd-{$id_cliente} ctobd-{$id_contrato} ::: AreaAdva {$id_subDiv2} ::: UNIDADES  <b>{$unidadesCtoSD} ::: {$descripcion}</b> </option>";

		}
			echo "</select>"; 
	$filas26 = mysqli_num_rows($search_query26);
	$xz26 = ($filas26 > 0)?"":"No hay coincidencias en BD";
	echo $xz26;
	}	
// fin BUSCAR AREA ADMINISTRATIVA



// inicio BUSCAR PARTIDA
@$search27 = mysqli_real_escape_string($dbd2, $_POST['search27']);
if(!empty($search27))
	{
		$sql27 = 'SELECT id_cliente, id_contrato, id_partida, modelos, cilindros, clasif, descripcion, precioD, marcas '
		. ' FROM '
		. ' ctoPartidas '
		. " WHERE id_contrato = '$search27' ORDER BY clasif ASC LIMIT 200 ";
		
		$search_query27 = mysqli_query($dbd2, $sql27);
		if(!$search_query27) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_partida'  >"; // ID DEL ELEMENTO BUSCADO
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query27)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_partida 	= $row['id_partida'];
				$descripcion 	= $row['descripcion'];
				$precioD 		= $row['precioD'];
				$marcas 		= $row['marcas'];
				$modelos 		= $row['modelos'];
				$cilindros 		= $row['cilindros'];
				$clasif 		= $row['clasif'];

/*
				$sql_unidadesSD 		= "SELECT count( id_unidad ) unidades "
										."	FROM asignaUactual "
										."	WHERE id_subDiv2 = '$id_subDiv2' ";
				$sql_unidadesSD_res 	=  mysqli_query($dbd2, $sql_unidadesSD);
				$unidades_matrizSD		= mysqli_fetch_array($sql_unidadesSD_res);
				$unidadesCtoSD 			= $unidades_matrizSD['unidades'];
*/
//		UNIDADES  <b>{$unidadesCtoSD} :::		
					echo "<option value='{$id_partida}'>ctebd-{$id_cliente} ctobd-{$id_contrato} ::: Partida {$id_partida} ::: Cil {$cilindros} ::: Modelos {$modelos} ::: Clasif {$clasif} ::: PrecioDiario {$precioD} ::: Marcas {$marcas} ::: Descripcion {$descripcion}</b> </option>";

		}
			echo "</select>"; 
	$filas27 	= mysqli_num_rows($search_query27);
	$xz27 		= ($filas27 > 0)?"":"No hay coincidencias en BD";
	echo $xz27;
	}	
// fin BUSCAR PARTIDA









// inicio BUSCAR UNIDAD POR ECONOMICO
@$search28 = mysqli_real_escape_string($dbd2, $_POST['search28']);
if(!empty($search28))
{
	$sql28 =  ' SELECT id '
			. ' FROM '
			. ' ubicacion '
			. " WHERE Economico = '$search28' ORDER BY id ASC LIMIT 5 ";

	$search_query28 = mysqli_query($dbd2, $sql28);

	if(!$search_query28) 
	{
	   die('QUERY FAILED' . mysqli_error($dbd2));
	}

	echo "<select name='id_unidad' >"; // ID DEL ELEMENTO BUSCADO
			echo "<option value='0'> -- </option>"; 
			while($row = mysqli_fetch_array($search_query28)) 
			{
				$id_unidad 		= $row['id'];
				datosxid($id_unidad);

				echo "<option value='".$id_unidad."'>
	 				Id en Bd: {$id_unidad}, Economico: {$Economico},
	 				Placas: {$Placas}, Serie: {$Serie}, Tipo: {$Vehiculo}, 
	 				Modelo: {$Modelo} </option>";
			}
	echo "</select>";
	$filas28 	= mysqli_num_rows($search_query28);
	$xz28 		= ($filas28 > 0)?"":"No hay coincidencias en BD";
	echo $xz28;
}
// fin BUSCAR UNIDAD POR ECONOMICO




// inicio BUSCAR UNIDAD POR PLACAS
@$search29 = mysqli_real_escape_string($dbd2, $_POST['search29']);
if(!empty($search29))
{
	$sql29 =  ' SELECT id_unidad '
			. ' FROM '
			. ' placa '
			. " WHERE Placas = '$search29' ORDER BY id ASC LIMIT 5 ";

	$search_query29 = mysqli_query($dbd2, $sql29);

	if(!$search_query29) 
	{
	   die('QUERY FAILED' . mysqli_error($dbd2));
	}

	echo "<select name='id_unidad'  >"; // ID DEL ELEMENTO BUSCADO
			echo "<option value='0'> -- </option>"; 
			while($row = mysqli_fetch_array($search_query29)) 
			{
				$id_unidad 		= $row['id_unidad'];
				datosxid($id_unidad);

				echo "<option value='{$id_unidad}'>
	 				Id en Bd: ".$id_unidad.", Economico: ".$Economico.",
	 				Placas: ".$Placas.", Serie: ".$Serie.", Tipo: ".$Vehiculo.", 
	 				Modelo: ".$Modelo."</option>";
			}
	echo "</select>";
	$filas29 	= mysqli_num_rows($search_query29);
	$xz29 		= ($filas29 > 0)?"":"No hay coincidencias en BD";
	echo $xz29;
}
// fin BUSCAR UNIDAD POR PLACAS


// inicio BUSCAR UNIDAD POR SERIE
@$search30 = mysqli_real_escape_string($dbd2, $_POST['search30']);
if(!empty($search30))
{
	$sql30 =  ' SELECT id '
			. ' FROM '
			. ' ubicacion '
			. " WHERE Serie = '$search30' ORDER BY id ASC LIMIT 5 ";

	$search_query30 = mysqli_query($dbd2, $sql30);

	if(!$search_query30) 
	{
	   die('QUERY FAILED' . mysqli_error($dbd2));
	}

	echo "<select name='id_unidad'  >"; // ID DEL ELEMENTO BUSCADO
			echo "<option value='0'> -- </option>"; 
			while($row = mysqli_fetch_array($search_query30)) 
			{
				$id_unidad 		= $row['id'];
				datosxid($id_unidad);

				echo "<option value='{$id_unidad}'>
	 				Id en Bd: ".$id_unidad.", Economico: ".$Economico.",
	 				Placas: ".$Placas.", Serie: ".$Serie.", Tipo: ".$Vehiculo.", 
	 				Modelo: ".$Modelo."</option>";
			}
	echo "</select>";
	$filas30 	= mysqli_num_rows($search_query30);
	$xz30 		= ($filas30 > 0)?"":"No hay coincidencias en BD";
	echo $xz30;
}
// fin BUSCAR UNIDAD POR SERIE


// inicio BUSCAR UNIDAD POR FINAL DE SERIE
@$search31 = mysqli_real_escape_string($dbd2, $_POST['search31']);
if(!empty($search31))
{
	$sql31 =  ' SELECT id '
			. ' FROM '
			. ' ubicacion '
			. " WHERE Serie LIKE '%$search31' ORDER BY id DESC LIMIT 5 ";

	$search_query31 = mysqli_query($dbd2, $sql31);

	if(!$search_query31) 
	{
	   die('QUERY FAILED' . mysqli_error($dbd2));
	}

	echo "<select name='id_unidad'  >"; // ID DEL ELEMENTO BUSCADO
	echo "<option value='0'> -- </option>"; 
	while($row = mysqli_fetch_array($search_query31)) 
	{
		$id_unidad 		= $row['id'];
		datosxid($id_unidad);

	echo "<option value='{$id_unidad}'>
			Id en Bd: ".$id_unidad.", Economico: ".$Economico.",
			Placas: ".$Placas.", Serie: ".$Serie.", Tipo: ".$Vehiculo.", 
			Modelo: ".$Modelo."</option>";
	}
	echo "</select>";
	$filas31 	= mysqli_num_rows($search_query31);
	$xz31 		= ($filas31 > 0)?"":"No hay coincidencias en BD";
	echo $xz31;
}
// fin BUSCAR UNIDAD POR FINAL DE SERIE







// inicio BUSCAR CONTRATO // PARA DESTINO TRASLADO
@$search32 = mysqli_real_escape_string($dbd2, $_POST['search32']);
if(!empty($search32)) 	
	{
		$sql32 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_alan = '$search32' ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query32 = mysqli_query($dbd2, $sql32);
		if(!$search_query32) 
		{
		   die('QUERY FAILED' . mysqli_error($dbd2));
		}
		echo "<select name='id_contratoD'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query32))
		{
			$id_cliente 	= $row['id_cliente'];
			$id_contrato 	= $row['id_contrato'];
			$id_alan 		= $row['id_alan'];
			$numero 		= $row['numero'];
			$aliasCto 		= $row['aliasCto'];
			$fechainicio 	= $row['fechainicio'];
			$fechafin 		= $row['fechafin'];

			$sql_unidades 		= "SELECT count( id_unidad ) unidades FROM asignaUactual 
									WHERE id_contrato = '$id_contrato' ";
			$sql_unidades_res 	= mysqli_query($dbd2, $sql_unidades);
			$unidades_matriz	= mysqli_fetch_array($sql_unidades_res);
			$unidadesCto 		= $unidades_matriz['unidades'];

			echo "<option value='{$id_contrato}'>ctebd-{$id_cliente} ctobd-{$id_contrato}
			::: IdAlan {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} 
			::: {$fechafin} ::: UNIDADES  <b>{$unidadesCto}</b> </option>";
		}
			echo "</select>"; 
	$filas32 	= mysqli_num_rows($search_query32);
	$xz32 		= ($filas32 > 0)?"":"No hay coincidencias en BD";
	echo $xz32;
	}	
// fin BUSCAR CONTRATO // PARA DESTINO TRASLADO


// inicio BUSCAR CONTRATO por id alan // PARA ORIGEN TRASLADO
@$search33 = mysqli_real_escape_string($dbd2, $_POST['search33']);
if(!empty($search33)) 	
	{
		$sql33 = 'SELECT id_cliente, id_contrato, id_alan, numero, aliasCto, fechainicio, fechafin '
		. ' FROM '
		. ' clbCto '
		. " WHERE id_alan = '$search33' ORDER BY id_alan DESC LIMIT 25 ";
		
		$search_query33 = mysqli_query($dbd2, $sql33);
		if(!$search_query33) 
		{
		   die('QUERY FAILED' . mysqli_error($dbd2));
		}
		echo "<select name='id_contrato'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query33)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$id_contrato 	= $row['id_contrato'];
			$id_alan 		= $row['id_alan'];
			$numero 		= $row['numero'];
			$aliasCto 		= $row['aliasCto'];
			$fechainicio 	= $row['fechainicio'];
			$fechafin 		= $row['fechafin'];

			$sql_unidades 		= "SELECT count( id_unidad ) unidades FROM asignaUactual 
									WHERE id_contrato = '$id_contrato' ";
			$sql_unidades_res 	= mysqli_query($dbd2, $sql_unidades);
			$unidades_matriz	= mysqli_fetch_array($sql_unidades_res);
			$unidadesCto 		= $unidades_matriz['unidades'];

			echo "<option value='{$id_contrato}'>ctebd-{$id_cliente} ctobd-{$id_contrato}
			::: IdAlan {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} 
			::: {$fechafin} ::: UNIDADES  <b>{$unidadesCto}</b> </option>";
		}
		echo "</select>"; 
	$filas33 	= mysqli_num_rows($search_query33);
	$xz33 		= ($filas33 > 0)?"":"No hay coincidencias en BD";
	echo $xz33;
	}	
// fin BUSCAR CONTRATO por id alan // PARA ORIGEN TRASLADO







// inicio BUSCAR SUB AREA ADMINISTRATIVA // ejecutivos
@$search34 = mysqli_real_escape_string($dbd2, $_POST['search34']);
if(!empty($search34)) 	
	{
		$sql34 = 'SELECT id_subDiv3, descripcion, id_subDiv2 '
		. ' FROM '
		. ' clbSubDiv3 '
		. " WHERE id_subDiv2 = '$search34' ORDER BY descripcion ASC LIMIT 25 ";
		
		$search_query34 = mysqli_query($dbd2, $sql34);
		if(!$search_query34) 
		{
		   die('QUERY FAILED' . mysqli_error($dbd2));
		}
		echo "<select name='id_subDiv3'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query34)) 
		{
			$id_subDiv3 	= $row['id_subDiv3'];
			$descripcion 	= $row['descripcion'];
			$id_subDiv2 	= $row['id_subDiv2'];
			
			$selected	= ($id_subDiv3Esta == $id_subDiv3)? 'selected':'';

			echo "<option value='{$id_subDiv3}'  $selected   >AreaAdva {$id_subDiv2} ::: {$descripcion}</option>";
		}
		echo "</select>"; 
	$filas34 	= mysqli_num_rows($search_query34);
	$xz34 		= ($filas34 > 0)?"":"No hay coincidencias en BD";
	echo $xz34;
	}	
// fin BUSCAR SUB AREA ADMINISTRATIVA // ejecutivos





// inicio BUSCAR SUB AREA ADMINISTRATIVA
@$search35 = mysqli_real_escape_string($dbd2, $_POST['search35']);
if(!empty($search35))
	{
		$sql35 = 'SELECT id_cliente, id_contrato, id_subDiv2, id_subDiv3, descripcion '
		. ' FROM '
		. ' clbSubDiv3 '
		. " WHERE id_subDiv2 = '$search35' ORDER BY descripcion ASC LIMIT 200 ";
		
		$search_query35 = mysqli_query($dbd2, $sql35);
		if(!$search_query35) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_subDiv3'  >";
			echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query35)) 
		{
			$id_cliente 	= $row['id_cliente'];
			$id_contrato 	= $row['id_contrato'];
			$id_subDiv2 	= $row['id_subDiv2'];
			$id_subDiv3 	= $row['id_subDiv3'];
			$descripcion 	= $row['descripcion'];

			$sql_unidadesSD 		= " SELECT count( id_unidad ) unidades "
									. "	FROM asignaUactual "
									. "	WHERE id_subDiv3 = '$id_subDiv3' ";
			$sql_unidadesSD_res 	= mysqli_query($dbd2, $sql_unidadesSD);
			$unidades_matrizSD		= mysqli_fetch_array($sql_unidadesSD_res);
			$unidadesCtoSD 			= $unidades_matrizSD['unidades'];

				echo "<option value='{$id_subDiv3}'>ctebd-{$id_cliente} ctobd-{$id_contrato} ::: AreaAdva {$id_subDiv2} ::: SUBAREA {$id_subDiv3} ::: UNIDADES  <b>{$unidadesCtoSD} ::: {$descripcion}</b> </option>";
		}
		echo "</select>"; 
	$filas35 = mysqli_num_rows($search_query35);
	$xz35 = ($filas35 > 0)?"":"No hay coincidencias en BD";
	echo $xz35;
	}
// fin BUSCAR SUB AREA ADMINISTRATIVA









// inicio BUSCAR PROVEEDOR CON EL RFC PARA PROGRAMACION
@$search36 = mysqli_real_escape_string($dbd2, $_POST['search36']);
if(!empty($search36)) 	
	{
		$sql36 = 'SELECT id_prov, rfc, razonSocial '
		. ' FROM '
		. ' provAlta '
		. " WHERE rfc LIKE '$search36%' AND suspendido = 0 ORDER BY razonSocial DESC LIMIT 10 ";
		
		$search_query36 = mysqli_query($dbd2, $sql36);
		if(!$search_query36) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_prov' id='search37' onchange='buscaDomicilio(this);buscaContacto(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query36)) 
		{
				$id_prov 		= $row['id_prov'];
				$rfc 			= $row['rfc'];
				$razonSocial	= $row['razonSocial'];

					echo "<option value='{$id_prov}'>pv{$id_prov} ::: {$rfc} ::: {$razonSocial} </option>";
		}
		echo "</select>"; 
	$filas36 = mysqli_num_rows($search_query36);
	$xz36 = ($filas36 > 0)?"":"No hay coincidencias en BD";
	echo $xz36;
	}
// fin BUSCAR PROVEEDOR CON EL RFC PARA PROGRAMACION


// inicio BUSCAR sucursal CON EL RFC PARA PROGRAMACION
@$search37 = mysqli_real_escape_string($dbd2, $_POST['search37']);
if(!empty($search37))
	{
		$sql37 = 'SELECT * '
		. ' FROM '
		. ' provSucursal '
		. " WHERE id_prov = '$search37' ORDER BY tipo ASC LIMIT 100 ";

		$search_query37 = mysqli_query($dbd2, $sql37);
		if(!$search_query37) 
		{
		   die('QUERY FAILED' . mysqli_error($dbd2));
		}

		echo "Seleccione Direccion -->";   
		echo "<select name='id_sucursal'  >";
		//echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query37)) 
		{
			$id_prov 		= $row['id_prov'];
			$id_sucursal 	= $row['id_sucursal'];
			$nombreSucursal	= $row['nombreSucursal'];
			$calleNumero	= $row['calleNumero'];
			$colonia		= $row['colonia'];
			$municipio		= $row['municipio'];
			$estado			= $row['estado'];
			$cp				= $row['cp'];

			echo "<option value='{$id_sucursal}'>
					pv{$id_prov} sc{$id_sucursal} ::: {$nombreSucursal}, {$calleNumero}, {$colonia}, {$municipio}, {$estado}, {$cp}
				  </option>";
		}
		echo "</select>"; 
	$filas37 	= mysqli_num_rows($search_query37);
	$xz37 		= ($filas37 > 0)?"":"No hay coincidencias en BD";
	echo $xz37;
	}
// fin BUSCAR sucursal CON EL RFC PARA PROGRAMACION


// inicio BUSCAR contacto proveedor CON EL RFC PARA PROGRAMACION
@$search38 = mysqli_real_escape_string($dbd2, $_POST['search37']);
if(!empty($search38))
	{
		$sql38 =  ' SELECT * '
				. ' FROM '
				. ' provContacto '
				. " WHERE id_prov = '$search38' "
				. " ORDER BY id_contacto DeSC LIMIT 100 ";

		$search_query38 = mysqli_query($dbd2, $sql38);
		if(!$search_query38) 
		{
		   die('QUERY FAILED' . mysqli_error($dbd2));
		}
		echo "<br><br>";
		echo "Seleccione Contacto -->";  
		echo "<select name='id_contacto'  >";
		//echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query38)) 
		{
			$id_prov 		= $row['id_prov'];
			$id_contacto 	= $row['id_contacto'];
			$nombre 		= $row['nombre'];
			$correo			= $row['correo'];
			$telefono		= $row['telefono'];
			$extension		= $row['extension'];

			echo "<option value='{$id_contacto}'>
					pv{$id_prov} ct{$id_contacto} ::: {$nombre}, {$correo}, {$telefono}, EXT{$extension} 
				  </option>";
		}
		echo "</select>"; 
	$filas38 	= mysqli_num_rows($search_query38);
	$xz38 		= ($filas38 > 0)?"":"No hay coincidencias en BD";
	echo $xz38;
	}
// fin BUSCAR contacto proveedor CON EL RFC PARA PROGRAMACION
?>