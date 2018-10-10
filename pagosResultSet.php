<?php
$mttoSol_R = mysqli_query($dbd2, $sql_mttoSol);

if(mysqli_num_rows($mttoSol_R) > 0 ){ // INICIO SI HAY RESULTADOS 
echo "<table id='ResTabla' >";
echo "<tr>
		<th>CHECK</th>
		<th>PROGRAMAR PAGO</th>
		<th>FOLIO</th>

		<th>FECHA Vo.Bo.</th>
		<th>UNIDAD</th>
		<th>IMPORTE</th>
		<th>PROVEEDOR</th>
		<th>CLABE</th>
		<th>CONCEPTO</th>
		<th>KM</th>
		<th>ED</th>

		<th>AUT</th>
		<th>MAIL</th>
		<th>Fotos</th>
		<th>COT</th>
		<th>DEP</th>
		<th>FACT</th>
		<th>FORM</th>
		<th>CLIENTE</th>
	  </tr>";

// <th>FECHA SOLICITUD</th>
// <th>SD</th>

?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php


while($row = mysqli_fetch_assoc($mttoSol_R)){

	$id_mttoSol 	= $row['id_mttoSol']; // 
	$fechaEj 		= $row['fechaEj'];
	$fechaAu 		= $row['fechaAu'];

	$id_unidad		= $row['id_unidad'];
	$id_contrato 	= $row['id_contrato'];

	$id_cliente 	= $row['id_cliente'];

	$id_prov 		= $row['id_prov'];
	$id_prov_c 		= $row['id_prov_c'];

	$concepto 		= $row['concepto'];
	$importe 		= $row['importe'];
	$km 			= $row['km'];

	$autorizadoS 	= $row['autorizadoS'];

	$programadoPago = $row['programadoPago'];
	$pagadoInfo 	= $row['pagadoInfo'];

	$cancelado 		= $row['cancelado'];
	$capturo 		= $row['capturo'];

// DOCUMENTOS ASOCIADOS
	$dM5 		= $row['dM5']; 		// tiene mail ------5
	$dF4 		= $row['dF4']; 		// tiene fotos -----4
	$dC1 		= $row['dC1']; 		// tiene cotizacion 1
	$pagado 	= $row['pagado']; 	// tiene deposito --2
	$facturado 	= $row['facturado']; // tiene factura --3

// TRAMITE
	$autorizadoS 	= $row['autorizadoS'];

	$rbolso 	= $row['rbolso'];

// INICIO es REEMBOLSO
$esrbolso = '';
$nombreR = '';
$esrbolso2 = '';
if($rbolso > 0){
	reembxid($id_mttoSol);
	$esrbolso = "<span style='color:blue;'>REEMBOLSO : </span>";
	$esrbolso2 = ', facturado por: ';
}
// TERMINA  es REEMBOLSO

// INICIO poner renglon resultados
	echo "<tr>";

	// INICIO CHECK PARA SELECCION MULTIPLE
	echo "<td style='text-align:center;'>";
	if($pagadoInfo == 1){
		echo "";
		}
	else{
		echo " <input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$id_mttoSol' id='$id_mttoSol' > ";
		}
	echo "</td>";
	// TERMINA CHECK PARA SELECCION MULTIPLE


	// INICIA TEXTO STATUS PROGRAMADO
	echo "<td style='text-align:center;'>";
	if($programadoPago == 1 AND $pagadoInfo == 0 ){
		echo "<span style='color:green;font-size:.8em;'>PROGRAMADO<span>";


		echo " <a href='pagosInformarPago.php?id_mttoSol=$id_mttoSol&pagina=$pagina&id_usuario=$capturo'  
				style='text-decoration:none;'  title='InformarPago' onClick= ";
				?> "javascript: return confirm('Confirma proceder a MARCAR COMO PAGADO');" > <?php
		echo "<input type ='button' value='MARCAR COMO PAGADO' style='font-size:.9em;'>
				</a> ";

		}
	elseif( $pagadoInfo == 0 ){
		echo " <a href='pagosProgramarPago.php?id_mttoSol=$id_mttoSol&pagina=$pagina&id_usuario=$capturo'  
				style='text-decoration:none;'  title='CANCELAR' onClick= ";
				?> "javascript: return confirm('Confirma proceder a PROGRAMAR PAGO');" > <?php
		echo "<input type ='button' value='PROGRAMAR PAGO'>
				</a> ";
		}
	echo "</td>";
	// TERMINA TEXTO STATUS PROGRAMADO


	echo "<td><label for='$id_mttoSol'>{$id_mttoSol}</label></td>";
	
//	echo "<td>{$fechaEj}</td>";
	echo "<td><label for='$id_mttoSol'>{$fechaAu}</label></td>";
	
	datosxid($id_unidad);
	echo "<td><a href='u3index.php?id_unidad=$id_unidad&pagina=$pagina' title='Consultar UNIDAD'>
	{$Economico}</a><label for='$id_mttoSol'> ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</label></td>";
	
	echo "<td style='text-align:right;'><label for='$id_mttoSol'>$".number_format($importe, 2)."</label></td>";
	
	proveedorxid($id_prov);
	echo "<td><label for='$id_mttoSol'>{$esrbolso}{$nombreR}{$esrbolso2}{$PrazonSocial}</label></td>";

	// INICIA MOSTRAR NUMERO CLABE
	$clabeMostrar = '';
	if($rbolso > 0){ // ES REEMBOLSO
		reembxid($id_mttoSol);
		$clabeMostrar = $clabeR;
	}
	else{ // ES PAGO AL PROVEEDOR
		provCtaxid($id_prov_c);
		$clabeMostrar = $PCclabe;
	}
	echo "<td><label for='$id_mttoSol'>{$clabeMostrar}</label></td>";
	// TERMINA MOSTRAR NUMERO CLABE

	echo "<td><label for='$id_mttoSol'>{$concepto}</label></td>";
	echo "<td><label for='$id_mttoSol'>{$km}</label></td>";

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

/*
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
*/

/*
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
*/


	echo "</td>";
	// TERMINA EDITAR SOLICITUD

/*
	// INICIA SUBIR CUALQUIER ARCHIVO
	if($cancelado > 0){echo " <td><a title='CANCELADO' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='CANCELADO' ></a></td>";}
	else {	
	echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=0&pagina=$pagina&id_usuario=$capturo'  
				style='text-decoration:none;'  title='SUBIR ARCHIVO' >
				<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='SUBIR ARCHIVO' >
		</a></td>"; 
	}
	// TERMINA SUBIR CUALQUIER ARCHIVO
*/

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
        		$statusA = "<img src='img/Apply.gif' style='width:16px;height:16px;'  alt='AUTORIZACION TECNICA OK' title='VO.BO. TECNICO OK'>";
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
			echo "<td><a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=5'  
					style='text-decoration:none;' target='_blank' title='Ver MAIL' >
					<img src='img/Mail.gif' style='width:16px;height:16px;'  alt='Ver MAIL' >
				</a></td>"; // COTIZACION
		}
else // SUBIR // TESORERIA NO REQUIERE SUBIR MAIL
		{echo "<td></td>";}
/*		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=5&pagina=$pagina'  
					style='text-decoration:none;' title='Subir MAIL' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir MAIL' >
				</a></td>"; // COTIZACION
		} */ // TESORERIA NO REQUIERE SUBIR MAIL
	// TERMINA ANALIZA SI TIENE MAIL

	// INICIO ANALIZA SI TIENE FOTOS
	if($dF4 > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $dF4; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=4&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title=Ver FOTO' >
					<img src='img/foto.jpg' style='width:16px;height:16px;'  alt='Ver FOTO' >
				</a>"; // COTIZACION
				}
			echo "</td>";
		}
	else // SUBIR
		{echo "<td></td>";}	
/*		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=4&pagina=$pagina'  
					style='text-decoration:none;'  title='Subir FOTO' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir FOTO' >
				</a></td>"; // FOTOS
		} */
	// TERMINA ANALIZA SI TIENE FOTOS

	// INICIO ANALIZA SI ESTA SUBIDA LA COTIZACION
	if($dC1 > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $dC1; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=1&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver COTIZACION' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver COTIZACION' >
				</a>";
				}
			echo "</td>"; // COTIZACION
		}
	else // SUBIR
		{echo "<td></td>";}		
/*		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=1&pagina=$pagina'  
					style='text-decoration:none;' title='Subir COTIZACION' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir COTIZACION' >
				</a></td>"; // COTIZACION
		}*/
	// TERMINA ANALIZA SI ESTA SUBIDA LA COTIZACION

#####	
	// INICIO  BUSCAR FORMATO DE DISPERSION SCOTIABANK
	$pagadoInfoMostrar = '';
	if($pagadoInfo == 1)
		{
			$pagadoInfoMostrar = "<a href='http://jetvan.ddns.net:8021/pdfpagos/getfile.php?uuid=".$id_mttoSol."'  target='_blank'  ><span class='pagadoInfoM' title='VER AVISO DE PAGO' >$</span></a>";
		}
	// TERMINA BUSCAR FORMATO DE DISPERSION SCOTIABANK


	// INICIO ANALIZA SI ESTA HECHO EL PAGO DEPOSITO
	if($pagado > 0)
		{
			echo "<td>
				$pagadoInfoMostrar
				<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=2'  
					style='text-decoration:none;' target='_blank' title='Ver DEPOSITO' >
					<img src='img/pagado.jpg' style='width:16px;height:16px;'  alt='Ver DEPOSITO' >
				</a></td>";
		}
	else // SUBIR
		{
			echo "<td>
				$pagadoInfoMostrar
					<a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=2&pagina=$pagina'  
					style='text-decoration:none;'  title='Subir DEPOSITO' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir DEPOSITO' >
				</a></td>"; // PAGO
		}
	// TERMINA ANALIZA SI ESTA HECHO EL PAGO DEPOSITO
#####		

	// INICIO ANALIZA SI ESTA FACTURADO
	if($facturado > 0)
		{
			echo "<td>";
			for($x = 1; $x <= $facturado; $x++){ 
			echo "<a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=3&nodoc=$x'  
					style='text-decoration:none;' target='_blank' title='Ver FACTURA' >
					<img src='img/th.jpg' style='width:16px;height:16px;'  alt='Ver FACTURA' >
				</a>"; // COTIZACION
				}
			echo "</td>";
		}
	else // SUBIR
		{echo "<td></td>";}	
/*		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=3&pagina=$pagina'  
					style='text-decoration:none;'  title='Subir FACTURA' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir FACTURA' >
				</a></td>"; // FACTURADO
		}*/
	// TERMINA ANALIZA SI ESTA FACTURADO
} // TERMINA BLOQUE SI CANCELADO


	echo "<td><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  
				style='text-decoration:none;' target='_blank' title='VER SOLICITUD' >
				<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='VER SOLICITUD' >
				</a>
				<a 
				href='mttoSolPrint.php?id_mttoSol=$id_mttoSol' target='_blank' title='IMPRIMIR SOLICITUD' >
				<img src='img/print.png' style='width:16px;height:16px;'  alt='IMPRIMIR SOLICITUD' ></a>
				<a 
				href='mttoSolPDF.php?id_mttoSol=$id_mttoSol' target='_blank' title='GENERAR PDF' >
				<i class='fa fa-file-pdf-o'  style='font-size:16px;'   alt='GENERAR PDF' ></i>
				</a>
				</td>";

	clientexid($id_cliente);
	echo "<td>$razonSocial</td>";
	$razonSocial = '';	

	// resetear variables de REEMBOLSO
	$esrbolso = '';
	$nombreR = '';
	$esrbolso2 = '';
	// resetear variables de REEMBOLSO

	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";

} // TERMINA SI HAY RESULTADOS
?>