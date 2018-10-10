<style>
	#ResTabla tr:hover {background-color: #ddd;}
</style>
<section><fieldset><legend>RESUMEN DE SOLICITUDES DE MANTENIMIENTO</legend>

<?php

$sql_mttoSol = '';

$pagina = '';

/*
if($_SESSION["mttoSol"] == 2){
// SI CONSULTA EJECUTIVO
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE capturo = '$id_usuario' "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " WHERE id_unidad = '$id_unidad' " ;
}

if($_SESSION["mttoSol"] > 2){
// SI CONSULTA SUPERVISOR
}
*/

	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . " WHERE id_unidad = '$id_unidad'  AND cancelado = 0   "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC ' ;
 //       . " WHERE id_unidad = '$id_unidad' " ;

$mttoSol_R = mysql_query($sql_mttoSol);

if(mysql_affected_rows() > 0){


		
echo "<table id='ResTabla' >";
echo "<tr>
<th>FOLIO</th>
<th>FECHA</th>

<th>IMPORTE</th>
<th>PROVEEDOR</th>
<th>CONCEPTO</th>
<th>KM</th>
<th>STATUS</th>";



// VISTA PARA EJECUTIVOS QUE OPEREN LA SOLICITUD
if($_SESSION["mttoSol"] > 1){
echo "
<th>ED</th>
<th>SD</th>
<th>AUT</th>
<th>MAIL</th>
<th>Fotos</th>
<th>COT</th>
<th>DEP</th>
<th>FACT</th>
<th>FORM</th>
";
// <th>UNIDAD</th>
}
// VISTA PARA EJECUTIVOS QUE OPEREN LA SOLICITUD

echo "</tr>";





while($row = mysql_fetch_assoc($mttoSol_R)){

	$id_mttoSol 	= $row['id_mttoSol']; // 
	$fechaEj 		= $row['fechaEj'];
	$id_unidad		= $row['id_unidad'];
	$id_contrato 	= $row['id_contrato'];

	$id_prov 		= $row['id_prov'];

	$concepto 		= $row['concepto'];
	$importe 		= $row['importe'];
	$km 			= $row['km'];

	$capturoMS 		= $row['capturo'];

	$autorizadoS 	= $row['autorizadoS'];

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

// INICIO saber si tiene FOTOS
if($dF4 > 0){
	$sql_fot = "SELECT * FROM mttoDocto 
				WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = 4  
				ORDER BY id_docto DESC LIMIT 5 ";
	$fot_R 	= mysql_query($sql_fot);
}
// FIN saber si tiene FOTOS

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$id_mttoSol}</td>";
	echo "<td>{$fechaEj}</td>";
//	datosxid($id_unidad);
//	echo "<td>{$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";
	number_format($importe, 2);
	echo "<td>{$importe}</td>";
	proveedorxid($id_prov);
	echo "<td>{$esrbolso}{$nombreR}{$esrbolso2}{$PrazonSocial}</td>";
	echo "<td>{$concepto}</td>";
	echo "<td>{$km}</td>";

$status = 'En trámite';
if($pagado > 0){$status = 'Pagado';}
if($pagado > 0 and $facturado > 0){$status = 'Pagado y Facturado';}

	echo "<td>{$status}</td>";



$verEditables = 0;
if($_SESSION["mttoSol"] > 1 AND $_SESSION["id_usuario"] == $capturoMS ){$verEditables = 1;}
if($_SESSION["mttoSol"] > 2){$verEditables = 1;}

if($verEditables == 1 ){ // INICIA LO QUE PUEDE VER EJECUTIVO


	echo "<td>";
	// INICIA EDITAR FORMA DE PAGO
	if( $pagado > 0 )
		{ // SI YA FUE PAGADO SE BLOQUE LA OPCION DE EDITAR
			echo " <a title='PAGADO' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='PAGADO' ></a>
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

	// INICIA EDITAR SOLICITUD
	if($autorizadoS > 0 OR $pagado > 0 )
		{ // SI YA FUE AUTORIZADO O PAGADO SE BLOQUE LA OPCION DE EDITAR
			echo " <a title='AUTORIZADO' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='AUTORIZADO' ></a>
				 ";
		}
	else
		{
			echo " <a href='mttoSolEditar.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
						style='text-decoration:none;'  title='Editar' >
						<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
				</a> ";
		}
	// TERMINA EDITAR SOLICITUD

	echo "</td>";




	// INICIA SUBIR CUALQUIER ARCHIVO
	echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=0&pagina=$pagina'  
				style='text-decoration:none;'  title='Subir Archivo' >
				<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
		</a></td>"; 
	// TERMINA SUBIR CUALQUIER ARCHIVO


	##### ##### ##### ##### ##### ##### ##### #####
	// INICIO ESTA AUTORIZADO  
	// 0 INCOMPLETO, 1 PENDIENTE, 2 AUTORIZADO, 3 RECHAZADO, 4 CORREGIR, 0 incompleto, 1 en revision, 2 corregir, 3 rechazado, 4 autorizado VoBo S

		// PENDIENTE (NORMAL) 		DEBE TENER 1 COTIZACION, 0 FACTURA, 1 CORREO, 0 REEMBOLSO
		// PENDIENTE (REEMBOLSO) 	DEBE TENER 0 COTIZACION, 1 FACTURA, 1 CORREO, 1 REEMBOLSO


	if($autorizadoS == 1){$autorizado = 'Si';}else{$autorizado = 'Pendiente';}
	
	echo "<td>{$autorizado}</td>";
	
	// TERMINA ESTA AUTORIZADO
	##### ##### ##### ##### ##### ##### ##### #####


	// INICIO ANALIZA SI TIENE MAIL $dM5  ES EL TIPO 5
	if($dM5 > 0)
		{
			echo "<td><a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=5'  
					style='text-decoration:none;' target='_blank' title='Ver Mail' >
					<img src='img/Mail.gif' style='width:16px;height:16px;'  alt='Ver Mail' >
				</a></td>"; // COTIZACION
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=5'  
					style='text-decoration:none;' title='Subir Mail' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Mail' >
				</a></td>"; // COTIZACION
		}
	// TERMINA ANALIZA SI TIENE MAIL

	// INICIO ANALIZA SI TIENE FOTOS
	if($dF4 > 0)
		{
			echo "<td>";
			while($rowfot = mysql_fetch_assoc($fot_R)){ 
					$archivoFt 	= $rowfot['archivo'];
					$rutaFt 	= $rowfot['ruta'];
				echo " <a href='../exp/mtto/$rutaFt/$archivoFt'  
					style='text-decoration:none;' target='_blank' title='Ver Foto' >
					<img src='img/foto.jpg' style='width:16px;height:16px;'  alt='Ver Foto' >
				</a> ";
				}
			echo "</td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=4'  
					style='text-decoration:none;'  title='Subir Foto' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Foto' >
				</a></td>"; // FOTOS
		}
	// TERMINA ANALIZA SI TIENE FOTOS

	// INICIO ANALIZA SI ESTA SUBIDA LA COTIZACION
	if($dC1 > 0)
		{
			echo "<td><a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=1'  
					style='text-decoration:none;' target='_blank' title=Ver Cotización' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver Cotización' >
				</a></td>"; // COTIZACION
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=1'  
					style='text-decoration:none;' title='Subir Cotización' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Cotización' >
				</a></td>"; // COTIZACION
		}
	// TERMINA ANALIZA SI ESTA SUBIDA LA COTIZACION
	
	// INICIO ANALIZA SI ESTA HECHO EL PAGO DEPOSITO
	if($pagado > 0)
		{
			echo "<td><a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=2'  
					style='text-decoration:none;' target='_blank' title='Ver Deposito' >
					<img src='img/pagado.jpg' style='width:16px;height:16px;'  alt='Ver Deposito' >
				</a></td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=2'  
					style='text-decoration:none;'  title='Subir DEPOSITO' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir DEPOSITO' >
				</a></td>"; // PAGO
		}
	// TERMINA ANALIZA SI ESTA HECHO EL PAGO DEPOSITO

	// INICIO ANALIZA SI ESTA FACTURADO
	if($facturado > 0)
		{
			echo "<td><a href='mttoSolVerDocto.php?id_mtto=$id_mttoSol&tipo=3'  
					style='text-decoration:none;' target='_blank' title='Ver Factura' >
					<img src='img/th.jpg' style='width:16px;height:16px;'  alt='Ver Factura' >
				</a></td>";
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=3'  
					style='text-decoration:none;'  title='Subir FACTURA' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir FACTURA' >
				</a></td>"; // FACTURADO
		}
	// TERMINA ANALIZA SI ESTA FACTURADO

	echo "<td><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  
				style='text-decoration:none;' target='_blank' title='Ver Formato' >
				<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver Solicitud' >
				</a></td>";	


} // TERMINA LO QUE PUEDE VER EJECUTIVO


	// resetear variables de REEMBOLSO
	$esrbolso = '';
	$nombreR = '';
	$esrbolso2 = '';
	// resetear variables de REEMBOLSO

	echo "</tr>";
// FIN poner renglon resultados

}
echo "</table>";



}else{echo "NO HAY SOLICITUDES";}

?>
</fieldset></section>