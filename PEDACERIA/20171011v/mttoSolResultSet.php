<?php
$mttoSol_R = mysql_query($sql_mttoSol);

if(mysql_num_rows($mttoSol_R) > 0 ){ // INICIO SI HAY RESULTADOS 

//<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
//<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
//<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
//
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<?php
// <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
//
//<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

$preAutorizado = "<i class='fa fa-smile-o'  style='font-size:16px; color:orange;'   alt='PRE-AUTORIZADO' ></i>";

//echo "<i class='fa fa-smile-o'  style='font-size:16px; color:orange;'   alt='PRE-AUTORIZADO' ></i>";
echo "<table id='ResTabla' >";
echo "<tr>
<th>FOLIO</th>
<th>FECHA</th>
<th>UNIDAD</th>
<th>IMPORTE</th>
<th>PROVEEDOR</th>
<th>CONCEPTO</th>
<th>KM</th>
<th>ED</th>
<th>SD</th>
<th>AUT</th>
<th>MAIL</th>
<th>Fotos</th>
<th>COT</th>
<th>DEP</th>
<th>FACT</th>
<th>FORM</th>
<th>CLIENTE  </th>
</tr>";

while($row = mysql_fetch_assoc($mttoSol_R)){

	$id_mttoSol 	= $row['id_mttoSol'];
	$fechaEj 		= $row['fechaEj'];

	$id_unidad		= $row['id_unidad'];
	$id_contrato 	= $row['id_contrato'];

	$id_cliente 	= $row['id_cliente'];

	$id_prov 		= $row['id_prov'];

	$hojalateria	= $row['t10'];
	$deducible		= $row['t13'];

	$concepto 		= $row['concepto'];
	$importe 		= $row['importe'];
	$km 			= $row['km'];

	$autorizadoS 	= $row['autorizadoS'];

	$programadoPago = $row['programadoPago'];
	$pagadoInfo 	= $row['pagadoInfo'];
	$bancoE 		= $row['bancoE'];

	$cancelado 		= $row['cancelado'];
	$capturo 		= $row['capturo'];

// DOCUMENTOS ASOCIADOS
	$dM5 		= $row['dM5']; 		// tiene mail ------5
	$dF4 		= $row['dF4']; 		// tiene fotos -----4
	$dC1 		= $row['dC1']; 		// tiene cotizacion 1
	$pagado 	= $row['pagado']; 	// tiene deposito --2
	$facturado 	= $row['facturado'];// tiene factura ---3

// TRAMITE
	$autorizadoS = $row['autorizadoS'];

	$rbolso 	= $row['rbolso'];

// INICIO es REEMBOLSO
$esrbolso 	= '';
$nombreR 	= '';
$esrbolso2 	= '';
if($rbolso > 0){
	reembxid($id_mttoSol);
	$esrbolso = "<span style='color:blue;'>REEMBOLSO : </span>";
	$esrbolso2 = ', facturado por: ';
}
// TERMINA  es REEMBOLSO

// ES DE CABO RENT // TERNIARIO
$esCR = ($capturo == 5 ) ? "<span style='color:red;'>CR</span>":''; 
// ES DE DIANA TULANCINGOT // TERNIARIO
$esTG = ($capturo == 93 ) ? "<span style='color:green;'>TGO</span>":''; 
// ES AUTORIZABLE POR GPEREZ (DEDUCIBLES Y HOJALATERIA)
$esDH = ($hojalateria + $deducible > 0 ) ? "<span style='color:#4169E1;'>DH</span>":''; 

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$esDH}{$esCR}{$esTG}{$id_mttoSol}</td>";
	echo "<td>{$fechaEj}</td>";
	
	datosxid($id_unidad);
	echo "<td><a href='u3index.php?id_unidad=$id_unidad&pagina=$pagina' title='Consultar UNIDAD'>
	{$Economico}</a> ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";
	echo "<td style='text-align:right;'>$".number_format($importe, 2)."</td>";
	proveedorxid($id_prov);
	echo "<td>{$esrbolso}{$nombreR}{$esrbolso2}{$PrazonSocial}</td>";
	echo "<td>{$concepto}</td>";
	echo "<td>{$km}</td>";

	// INICIA EDITAR SOLICITUD
	echo "<td>";
	// INICIA EDITAR FORMA DE PAGO
	if( $pagado > 0  OR $cancelado > 0 OR $programadoPago == 1 )
		{ // SI YA FUE PAGADO SE BLOQUE LA OPCION DE EDITAR
			echo " <a title='OPCION BLOQUEADA' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='OPCION BLOQUEADA' ></a>
				 ";
		}
	else
		{
			echo " <a href='mttoSolEditarPago.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
						style='text-decoration:none;'  title='Editar PAGO' >
						<img src='img/ModifyDP.gif' style='width:16px;height:16px;'  alt='Editar PAGO' >
				</a> ";
		}	

	// TERMINA EDITAR FORMA DE PAGO

	// INICIA EDITAR DATOS SOLICITUD
	if($autorizadoS == 1 OR $pagado > 0  OR $cancelado > 0 )
		{ // SI YA FUE AUTORIZADO O PAGADO SE BLOQUE LA OPCION DE EDITAR
			echo " <a title='OPCION BLOQUEADA' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='OPCION BLOQUEADA' ></a>
				 ";
		}
	else
		{
			echo " <a href='mttoSolEditar.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
						style='text-decoration:none;'  title='Editar' >
						<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
				</a> ";
		}
	// TERMINA EDITAR DATOS SOLICITUD

	// INICIA CANCELAR SOLICITUD
	if($cancelado > 0 OR $pagado > 0 OR $autorizadoS == 1 )
		{ // SI YA FUE AUTORIZADO O PAGADO SE BLOQUE LA OPCION DE EDITAR
			echo " <a title='OPCION BLOQUEADA' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='OPCION BLOQUEADA' ></a>
				 ";
		}
	else
		{
			echo " <a href='mttoSolCancelar.php?id_mttoSol=$id_mttoSol&pagina=$pagina&id_usuario=$capturo'  
						style='text-decoration:none;'  title='CANCELAR' onClick= ";
					?>
					"javascript: return confirm('Confirma proceder a CANCELAR SOLICITUD');" > 
					<?php
			echo "<img src='img/Delete.gif' style='width:12px;height:12px;'  alt='CANCELAR' >
				</a> ";
		}
	// TERMINA CANCELAR SOLICITUD

	echo "</td>";
	// TERMINA EDITAR SOLICITUD

	// INICIA SUBIR CUALQUIER ARCHIVO
	if($cancelado > 0){echo " <td><a title='CANCELADO' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='CANCELADO' ></a></td>";}
	else {	
	echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=0&pagina=$pagina&id_usuario=$capturo'  
				style='text-decoration:none;'  title='SUBIR ARCHIVO' >
				<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='SUBIR ARCHIVO' >
		</a></td>"; 
	}
	// TERMINA SUBIR CUALQUIER ARCHIVO

	##### ##### ##### ##### ##### ##### ##### #####
	##### ##### ##### ##### ##### ##### ##### #####
	// INICIO ESTA AUTORIZADO  
		// 0 PENDIENTE, EN ESPERA DE AUTORIZADO
		// 1 AUTORIZADO
		// 2 INCOMPLETO, EN ESPERA DE ACCION
		// 3 CORREGIR, EN ESPERA DE ACCION		
		// 4 RECHAZADO, EN ESPERA DE ACCION

		// PENDIENTE (NORMAL) DEBE TENER 1 COTIZACION, 1 CORREO
		// PENDIENTE (REEMBOLSO) DEBE TENER 1 FACTURA, 1 CORREO, 1 REEMBOLSO

		// ESTADO DE AUTORIZACION
		switch($autorizadoS)
		{
			case "0": // PENDIENTE
				$statusA = "<a href='mttoSolAutResp.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
							style='text-decoration:none;' title='VO.BO. PENDIENTE' >
							<img src='img/Clock.gif' style='width:16px;height:16px;'  alt='VO.BO. PENDIENTE' >";
				break;
			case "1": // AUTORIZADO
				$statusA = "<a href='mttoSolAutResp.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
							style='text-decoration:none;' title='HISTORIAL' >
							<img src='img/Apply.gif' style='width:16px;height:16px;'  alt='AUTORIZACION TECNICA OK' title='VO.BO. TECNICO OK'>";
				break;
			case "2": // INCOMPLETO
				$statusA = "<a href='mttoSolAutResp.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
							style='text-decoration:none;' title='INCOMPLETO' >
							<img src='img/Warning.gif' style='width:16px;height:16px;'  alt='INCOMPLETO' >";
				break;
			case "3": // CORREGIR
				$statusA = "<a href='mttoSolAutResp.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
							style='text-decoration:none;' title='CORREGIR' >
							<img src='img/Warning.gif' style='width:16px;height:16px;'  alt='CORREGIR' >";
				break;
			case "4": // RECHAZADO
				$statusA = "<a href='mttoSolAutResp.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
							style='text-decoration:none;' title='RECHAZADO' >
							<img src='img/Bad_mark.gif' style='width:16px;height:16px;'  alt='RECHAZADO' >";
				break;	
			case "6": // PREAUTORIZADO OK // CANCELADO ES STATUS 5
				$statusA = "<a href='mttoSolAutResp.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
							style='text-decoration:none;' title='REVISION OK' >
							$preAutorizado ";
				break;
			default:
				break;
		}

	if($cancelado == 1){$statusA = "<img src='img/cancelado.png' style='width:16px;height:16px;'  alt='CANCELADO' title='CANCELADO'>";}

	$progPgIcon = '';
	if($programadoPago == 1 ){$progPgIcon = "<img src='img/programpago.png' style='width:20px;height:20px;'  alt='PROGRAMADO PARA PAGO' title='PROGRAMADO PARA PAGO'>";}

	echo "<td>{$statusA} {$progPgIcon}</td>";
	
	// TERMINA ESTA AUTORIZADO
	##### ##### ##### ##### ##### ##### ##### #####
	##### ##### ##### ##### ##### ##### ##### #####


// INICIA BLOQUE SI CANCELADO
if($cancelado == 1){echo "<td></td><td></td><td></td><td></td><td></td>";}
else
{

	// INICIO ANALIZA SI TIENE MAIL $dM5  ES EL TIPO 5
	if($dM5 > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $dM5; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=5'  
					style='text-decoration:none;' target='_blank' title='Ver MAIL' >
					<img src='img/Mail.gif' style='width:16px;height:16px;'  alt='Ver MAIL' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=5&pagina=$pagina'  
					style='text-decoration:none;' title='Subir MAIL' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir MAIL' >
				</a></td>";
		}
	// TERMINA ANALIZA SI TIENE MAIL

	// INICIO ANALIZA SI TIENE FOTOS
	if($dF4 > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $dF4; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=4&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title=Ver FOTO' >
					<img src='img/foto.jpg' style='width:16px;height:16px;'  alt='Ver FOTO' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=4&pagina=$pagina'  
					style='text-decoration:none;'  title='Subir FOTO' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir FOTO' >
				</a></td>";
		}
	// TERMINA ANALIZA SI TIENE FOTOS

	// INICIO ANALIZA SI ESTA SUBIDA LA COTIZACION
	if($dC1 > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $dC1; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=1'  
					style='text-decoration:none;' target='_blank' title='Ver COTIZACION' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver COTIZACION' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=1&pagina=$pagina'  
					style='text-decoration:none;' title='Subir COTIZACION' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir COTIZACION' >
				</a></td>";
		}
	// TERMINA ANALIZA SI ESTA SUBIDA LA COTIZACION


	// INICIO  BUSCAR FORMATO DE DISPERSION SCOTIABANK
	$pagadoInfoMostrar = '';
	if($pagadoInfo == 1)
		{
		if($bancoE=="1") 
			{ //Es scotia
			$pagadoInfoMostrar = "<a href='http://jetvan.ddns.net:8021/pdfpagos/getfile.php?uuid=".$id_mttoSol."'  target='_blank'  ><span class='pagadoInfoM' title='VER AVISO DE PAGO' >$</span></a>";
			}
		if($bancoE=="2") 
			{ //Es santander
			$pagadoInfoMostrar = "<a href='http://jetvan.ddns.net:8021/santander/getfile.php?uuid=".$id_mttoSol."'  target='_blank'  ><span class='pagadoInfoM' title='VER AVISO DE PAGO' >$</span></a>";	
			}
			//$pagadoInfoMostrar = "<a href='http://jetvan.ddns.net:8021/pdfpagos/getfile.php?uuid=".$id_mttoSol."'  target='_blank'  ><span class='pagadoInfoM' title='VER AVISO DE PAGO' >$</span></a>";
		}
	// TERMINA BUSCAR FORMATO DE DISPERSION SCOTIABANK


	// INICIO ANALIZA SI ESTA HECHO EL PAGO DEPOSITO
	if($pagado > 0)
		{
			echo "<td>$pagadoInfoMostrar";
			for($x = 1; $x <= $pagado; $x++){ 
			echo "
				<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=2'  
					style='text-decoration:none;' target='_blank' title='Ver DEPOSITO' >
					<img src='img/pagado.jpg' style='width:16px;height:16px;'  alt='Ver DEPOSITO' >
				</a>";
				}
			echo "</td>";	
		}
	else // SUBIR
		{
			echo "<td>
				$pagadoInfoMostrar
					<a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=2&pagina=$pagina'  
					style='text-decoration:none;'  title='Subir DEPOSITO' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir DEPOSITO' >
				</a></td>";
		}
	// TERMINA ANALIZA SI ESTA HECHO EL PAGO DEPOSITO


	// INICIO ANALIZA SI ESTA FACTURADO
	if($facturado > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $facturado; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=3&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver FACTURA' >
					<img src='img/th.jpg' style='width:16px;height:16px;'  alt='Ver FACTURA' >
				</a>";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=3&pagina=$pagina'  
					style='text-decoration:none;'  title='Subir FACTURA' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir FACTURA' >
				</a></td>";
		}
	// TERMINA ANALIZA SI ESTA FACTURADO
} // TERMINA BLOQUE SI CANCELADO


	echo "<td><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  
				style='text-decoration:none;' target='_blank' title='VER SOLICITUD' >
				<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='VER SOLICITUD' >
				</a>
				<a 
				href='mttoSolPrint.php?id_mttoSol=$id_mttoSol' target='_blank' title='IMPRIMIR SOLICITUD' >
				<img src='img/print.png' style='width:16px;height:16px;'  alt='IMPRIMIR SOLICITUD' ></a>
				</td>";


	clientexid($id_cliente);
	echo "<td>$razonSocial</td>";
	$razonSocial = '';


	if($_SESSION["verPartidas"] > 0 OR $_SESSION["verAAdvas"] > 0)
	{
		unidadAsignacion($id_unidad);

		if($id_partida > 0  )
		{
			if($_SESSION["verPartidas"] > 0 )
			{
				descId_partida($id_partida);
				echo "<td>$ptdDesc</td>";
			}
		}

		if($id_subDiv2 > 0  )
		{
			if($_SESSION["verAAdvas"] > 0)
			{
				descId_subDiv2($id_subDiv2);
				echo "<td>$subDiv2Desc</td>";
			}
		}		
	}

	// resetear variables de REEMBOLSO
	$esrbolso 	= '';
	$nombreR 	= '';
	$esrbolso2 	= '';
	// resetear variables de REEMBOLSO

	echo "</tr>";
	// FIN poner renglon resultados

}
echo "</table>";
} // TERMINA SI HAY RESULTADOS
?>