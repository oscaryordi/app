<?php
// UTILIZADO EN VARIAS BUSQUEDAS AJAX
// referido en asignaejecutivo.php
// referido en mttoSol.php

//$connection = mysqli_connect('localhost', 'root', '','ajax');
@$dbd2 = mysqli_connect("50.63.236.78", "jetvantlc", "Jetvan12#","jetvantlc");


// BUSCAR SERIE DE AUTO

@$search1 = mysqli_real_escape_string($dbd2, $_POST['search1']);
if(!empty($search1)) 	
	{
		//$query = "SELECT * FROM cars WHERE cars LIKE '$search%' ORDER BY cars ASC LIMIT 10";
		
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
			while($row = mysqli_fetch_array($search_query)) {
			
				$id 		= $row['id'];
				$Serie 		= $row['Serie'];
				$Economico 	= $row['Economico'];
				$Vehiculo 	= $row['Vehiculo'];
				$Modelo 	= $row['Modelo'];
				$Color 		= $row['Color'];

				 ?>
				
				<?php
					echo "<option value='{$id}'>{$Economico} ::: {$Serie} ::: {$Vehiculo} ::: {$Modelo} ::: {$Color}</option>";
					//<a href='http://www.jetvan.mx/exp/archivos/$value' target='_blank'> $value&nbsp;</a>
				?>  
				
			<?php  }
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
		echo "<select name='id_cliente' id='search6' onchange='buscaContratos(this);' >"; 
		echo "<option> -- </option>";     
		while($row = mysqli_fetch_array($search_query2)) {
			
				$id_cliente 	= $row['id_cliente'];
				$rfc 			= $row['rfc'];
				$alias 			= $row['alias'];
				$razonSocial 	= $row['razonSocial'];
				 ?>
				
				<?php
					echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
					//<a href='http://www.jetvan.mx/exp/archivos/$value' target='_blank'> $value&nbsp;</a>
				?>  
				
			<?php  }
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
        . " WHERE id_cliente = '$search6' ORDER BY fechafin DESC LIMIT 10 ";
		
		$search_query3 = mysqli_query($dbd2, $sql5);
		if(!$search_query3) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query3)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan 		= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];


				 ?>
				
				<?php
					echo "<option value='{$id_contrato}'>{$id_cliente} ::: IdAlan {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
				?>  
				
			<?php  }
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
		$sql7 = 'SELECT id_usuario, nombre '
        . ' FROM '
        . ' usuarios '
        . " WHERE nombre LIKE '%$search7%' LIMIT 10 ";
		
		$search_query7 = mysqli_query($dbd2, $sql7);
		if(!$search_query7) 
		   {
		   die('QUERY FAILED ' . mysqli_error($dbd2));
		   }
		echo "<select name='id_usuario'>";   
		while($row = mysqli_fetch_array($search_query7)) {
			
				$id_usuario = $row['id_usuario'];
				$nombre 	= $row['nombre'];
				 ?>
				
				<?php
					echo "<option value='{$id_usuario}'>{$id_usuario} ::: {$nombre}</option>";
				?>  
				
			<?php  }
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
		echo "<option> -- </option>";     
		while($row = mysqli_fetch_array($search_query8)) {
			
				$id_cliente 	= $row['id_cliente'];
				$rfc 			= $row['rfc'];
				$alias 			= $row['alias'];
				$razonSocial 	= $row['razonSocial'];
				 ?>
				
				<?php
					echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
					//<a href='http://www.jetvan.mx/exp/archivos/$value' target='_blank'> $value&nbsp;</a>
				?>  
				
			<?php  }
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
		echo "<option> -- </option>";     
		while($row = mysqli_fetch_array($search_query9)) {
			
				$id_cliente 	= $row['id_cliente'];
				$rfc 			= $row['rfc'];
				$alias 			= $row['alias'];
				$razonSocial 	= $row['razonSocial'];
				 ?>
				
				<?php
					echo "<option value='{$id_cliente}'>{$id_cliente} ::: {$rfc} ::: {$alias} ::: {$razonSocial}</option>";
					//<a href='http://www.jetvan.mx/exp/archivos/$value' target='_blank'> $value&nbsp;</a>
				?>  
				
			<?php  }
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
        . " WHERE id_alan LIKE '$search10%' ORDER BY fechafin DESC LIMIT 10 ";
		
		$search_query10 = mysqli_query($dbd2, $sql10);
		if(!$search_query10) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_cliente'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query10)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan	 	= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

				 ?>
				
				<?php
					echo "<option value='{$id_cliente}'>{$id_cliente} ::: ID ALAN {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
				?>  
				
			<?php  }
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
        . " WHERE numero LIKE '%$search11%' ORDER BY fechafin DESC LIMIT 10 ";
		
		$search_query11 = mysqli_query($dbd2, $sql11);
		if(!$search_query11) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_cliente'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query11)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan	 	= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

				 ?>
				
				<?php
					echo "<option value='{$id_cliente}'>{$id_cliente} ::: ID ALAN {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
				?>  
				
			<?php  }
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
        . " WHERE aliasCto LIKE '%$search12%' ORDER BY fechafin DESC LIMIT 10 ";
		
		$search_query12 = mysqli_query($dbd2, $sql12);
		if(!$search_query12) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_cliente'>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query12)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan	 	= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

				 ?>
				
				<?php
					echo "<option value='{$id_cliente}'>{$id_cliente} ::: ID ALAN {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
				?>  
				
			<?php  }
			echo "</select>"; 
	$filas12 = mysqli_num_rows($search_query12);
	$xz12 = ($filas12 > 0)?"":"No hay coincidencias en BD";
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
        . " WHERE id_alan LIKE '$search13%' ORDER BY fechafin DESC LIMIT 10 ";
		
		$search_query13 = mysqli_query($dbd2, $sql13);
		if(!$search_query13) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_contrato' required>";
		//echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query13)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_alan	 	= $row['id_alan'];
				$numero 		= $row['numero'];
				$aliasCto 		= $row['aliasCto'];
				$fechainicio 	= $row['fechainicio'];
				$fechafin 		= $row['fechafin'];

				 ?>
				
				<?php
					echo "<option value='{$id_contrato}'>{$id_cliente} ::: ID ALAN {$id_alan} ::: {$numero} ::: {$aliasCto} ::: {$fechainicio} ::: {$fechafin}</option>";
				?>  
				
			<?php  }
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
        . " WHERE rfc LIKE '$search14%' ORDER BY razonSocial DESC LIMIT 10 ";
		
		$search_query14 = mysqli_query($dbd2, $sql14);
		if(!$search_query14) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Proveedor ->";   
		echo "<select name='id_prov' id='search15' onchange='buscaSucursal(this);'  onchange='buscaCuenta(this);'   required >";
		echo "<option> -- </option>"; 
		while($row = mysqli_fetch_array($search_query14)) {
				$id_prov 		= $row['id_prov'];
				$rfc 			= $row['rfc'];
				$razonSocial	= $row['razonSocial'];
				
				?>
				
				<?php
					echo "<option value='{$id_prov}'>PV{$id_prov} ::: {$rfc} ::: {$razonSocial} </option>";
				?>  
				
			<?php  }
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
		$sql16 = 'SELECT id_cuenta, cuenta, clabe, banco '
        . ' FROM '
        . ' provBanco '
        . " WHERE id_prov = '$search16' ORDER BY fechareg DESC LIMIT 10 ";
		
		$search_query16 = mysqli_query($dbd2, $sql16);
		if(!$search_query16) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "Seleccione Cuenta ----->";   
		echo "<select name='id_cuenta' required>";
		//echo "<option value = '0' > -- </option>"; 
		while($row = mysqli_fetch_array($search_query16)) {
				$id_cuenta 	= $row['id_cuenta'];
				$cuenta 	= $row['cuenta'];
				$clabe		= $row['clabe'];
				$banco		= $row['banco'];
				
				?>
				
				<?php
					echo "<option value='{$id_cuenta}'>Cta-{$cuenta} ::: Cbe-{$clabe} ::: Bco-{$banco} </option>";
				?>  
				
			<?php  }
			echo "</select>"; 
	$filas16 = mysqli_num_rows($search_query16);
	$xz16 = ($filas16 > 0)?"":"No hay coincidencias en BD"; // IF COMPACTADO , ES UN IF ABREVIADO
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
		echo "<select name='id_sucursal' required>";
		echo "<option value = '0' > -- </option>"; 
		while($row = mysqli_fetch_array($search_query15)) {
				$id_sucursal 	= $row['id_sucursal'];
				$nombreSucursal = $row['nombreSucursal'];
				$calleNumero	= $row['calleNumero'];
				$municipio		= $row['municipio'];
				$estado			= $row['estado'];
				?>
				
				<?php
					echo "<option value='{$id_sucursal}'>Sc-{$id_sucursal} ::: Nombre-{$nombreSucursal} ::: CyN-{$calleNumero} ::: Mpio-{$municipio} ::: Edo-{$estado} </option>";
				?>  
				
			<?php  }
			echo "</select>"; 
	$filas15 = mysqli_num_rows($search_query15);
	$xz15 = ($filas15 > 0)?"":"No hay coincidencias en BD";
	echo $xz15;
	}
// fin BUSCAR SUCURSAL






?>