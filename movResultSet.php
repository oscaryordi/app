<?php

$movFor_R = mysqli_query($dbd2, $sql_movFor);

if(mysqli_affected_rows($dbd2) > 0 ){
?>
<style>
.fa-trash-alt{color:gray;font-size:16px;}
.fa-trash-alt:hover{ color:green;}
.fa-file-pdf{color:gray;font-size:16px;}
.fa-file-pdf:hover{ color:green;}
.fa-file-alt{color:gray;font-size:16px;}
.fa-file-alt:hover{ color:green;}
.fa-upload{color:gray;font-size:16px;}
.fa-upload:hover{ color:green;}
.fa-times-circle{color:gray;font-size:16px;}
.fa-times-circle:hover{ color:green;}
.fa-edit{color:gray;font-size:16px;}
.fa-edit:hover{ color:green;}
</style>
<?php

$borrarTxtIcon = "<i class='fas fa-trash-alt'   
					alt='ELIMINAR' ></i>";
$verPdf 	= "<i class='fas fa-file-pdf'  
					alt='PDF' ></i>";
$verDto 	= "<i class='fas fa-file-alt'  
					alt='DETALLE' ></i>";
$iconoS		= "<i class='fas fa-upload' 
					alt='SUBIR' ></i>";
$iconoErase	= "<i class='far fa-times-circle' 
					alt='BORRAR' ></i>";
$iconEdit	= "<i class='fas fa-edit' 
					alt='EDITAR' ></i>";


//echo $iconEdit;

echo "<section><fieldset><legend>RESUMEN DE TRASLADOS</legend>";		
echo "<table id='ResTabla' >";
echo "<tr>
		<th>id_M</th>
		<th>MOTIVO</th>
		<th>FECHA SALIDA</th>
		<th>UNIDAD</th>

		<th>PROYECTO ORIGEN</th>
		<th>LUGAR</th>
		<th>PROYECTO DESTINO</th>
		<th>LUGAR</th>
		<th>FECHA LLEGADA</th>
		<th>FOLIO INVENTARIO</th>

		<th>EDITAR</th>
		<th>Ver detalle</th>
		<th>Ver escaneo</th>
		<th>BORRAR TODO</th>";
//<th>Editar</th>
//<th>Borrar</th>
echo "</tr>";

//<th>PROVEEDOR</th> <th>DOMICILIO DESTINO</th><th>F</th>




while($row = mysqli_fetch_assoc($movFor_R)){

	$id_movFor 	= $row['id_movFor'];
//	$id_cliente = $row['id_cliente'];
	$id_contrato= $row['id_contrato'];
//	$id_clienteD = $row['id_clienteD'];
	$id_contratoD= $row['id_contratoD'];
	$id_unidad 	= $row['id_unidad'];
	$folio_inv 	= $row['folio_inv'];
	$facturaT 	= $row['facturaT'];
	$costoT 	= $row['costoT'];

	$motivoM 	= $row['motivoM'];

//	$aliasEmergente 	= $row['aliasEmergente'];

	$kmO 		= $row['kmO'];
	$fechaO 	= $row['fechaO'];
	$horaO 		= $row['horaO'];
	$domicilioO = $row['domicilioO'];
	$ciudadO	= $row['ciudadO'];
	$estadoO 	= $row['estadoO'];
	$entregaNO 	= $row['entregaNO'];
	$telO 		= $row['telO'];

	$kmD 		= $row['kmD'];
	$fechaD 	= $row['fechaD'];
	$horaD 		= $row['horaD'];
	$domicilioD	= $row['domicilioD'];
	$ciudadD	= $row['ciudadD'];
	$estadoD 	= $row['estadoD'];
	$recibeND 	= $row['recibeND'];
	$telD 		= $row['telD'];

	$id_prov 	= $row['id_prov'];
	$conductor 	= $row['conductor'];

	$falso 		= $row['falso'];

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$id_movFor}</td>";


	motivoMov($motivoM);
	$motivoTxt = strtoupper($motivoTxt);
	echo "<td style='color:green;'>$motivoTxt</td>";

	echo "<td>{$fechaO}</td>";
	datosxid($id_unidad);
	echo "<td><a href='u3index.php?id_unidad=$id_unidad' title='Consultar UNIDAD'>{$Economico}</a> ::: {$Serie} ::: {$Placas}  ::: <br>
			{$Vehiculo}</td>";

//	provTxid($id_prov); // proveedor traslado
//	echo "<td>{$provTN}</td>";
//	$aE = '';
//	if($aliasEmergente != '0'){$aE = 'ae: '.$aliasEmergente;};{$aE} ;{$aE} ;

	contratoxid($id_contrato);
	clientexid($id_cliente);
	echo "<td>
		<b>ID <a href='ctoIndex.php?id_contrato=$id_contrato' 
				style='text-decoration:none;' title='VER CONTRATO' >
				=> {$id_alan}
				</a></b> ::: N.OFICIAL: {$numero} ::: ALIAS_CTO: {$aliasCto}<br>
		<b>{$razonSocial}</b><br> 
		RFC:{$rfc} ::: ALIAS_CTE:{$alias}
		</td>";
	echo "<td>{$ciudadO}</td>";


	contratoxid($id_contratoD);
	clientexid($id_cliente);
	echo "<td>
		<b>ID <a href='ctoIndex.php?id_contrato=$id_contratoD' 
				style='text-decoration:none;' title='VER CONTRATO' >
				=> {$id_alan}
				</a></b> ::: N.OFICIAL: {$numero} ::: ALIAS_CTO: {$aliasCto}<br>
		<b>{$razonSocial}</b><br> 
		RFC:{$rfc} ::: ALIAS_CTE:{$alias}
		</td>";
	$id_contrato 	='';
	$id_cliente 	='';
	echo "<td>{$ciudadD}</td>";
	echo "<td>{$fechaD}</td>";



	echo "<td style='color:red;'>{$folio_inv}</td>";
//	echo "<td>{$domicilioD}</td>";
//	echo "<td>{$falso}</td>";

	echo "<td><a href='movEdit.php?id_movFor=$id_movFor' title='Editar'>$iconEdit</a></td>";

	echo "<td>";
	echo " <a href='movVerxId.php?id_movFor=$id_movFor&pagina=$pagina'  
			style='text-decoration:none;'  title='Ver Detalle' >
			$verDto
		</a> ";
	echo "</td>";
//<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver detalle' >


	echo "<td>"; // ESCANEO
	buscaDocTra($id_movFor);
	$icono = ($extension == 'pdf')? $verPdf: 'V';
	if($ArchivoTra != ''){
	echo "<a href='http://sistema.jetvan.com.mx/exp/traslados/$rutaTra/$ArchivoTra' target='_blank' title='Ver Escaneo'>$icono</a> ";	

	echo "<a href='movTrasladoDoctoBorrar.php?id_movFor=$id_movFor&id_doctoTra=$id_doctoTra&pagina=$pagina' title='Borrar Escaneo'>$iconoErase</a>";
	}
	else
	{
	echo "<a href='movTrasladoDoctoAlta.php?id_movFor=$id_movFor' title='Subir Escaneo'>$iconoS</a>";
	}


	/*	echo " <a href='movVerxId.php?id_movFor=$id_movFor&pagina=$pagina'  
			style='text-decoration:none;'  title='Ver detalle' >
			<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver detalle' >
		</a> ";*/
	echo "</td>";



/* // EDITAR
	echo "<td>";
	echo " 	<a href='movEdit.php?id_movFor=$id_movFor&pagina=$pagina'  
				style='text-decoration:none;'  title='Editar' >
			<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
			</a> ";
	echo "</td>";
*/


/**/ // BORRAR
	echo "<td>";
	echo " 	<form action='movBorrar.php' method='post'>
				<input type='hidden' value='$id_movFor' name='id_movFor'>
				<input type='hidden' value='$pagina' name='pagina'>
				<input type='hidden' value='$id_usuario' name='id_usuario'>
		 ";
		?>
			<a onClick="javascript: return confirm('Confirma proceder a BORRAR TRASLADO'); " >
		<?php
	echo "  <button type='submit' alt='BORRAR TODO' title='BORRAR TODO' >
    		$borrarTxtIcon
			</button>	 
			</a>
			</form> ";
	echo "</td>";





/*

<input type='submit' value='Borrar' name='borrar' title='Borrar' >

*/





/*

// borrar			<input type='hidden' value='$id_unidad' name='id_unidad'>
// borrar			<input type='hidden' value='$id_usuario' name='id_usuario'>



	echo "<td>";
	// INICIA EDITAR DATOS SOLICITUD
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
	// TERMINA EDITAR DATOS SOLICITUD
	echo "</td>";
	// TERMINA EDITAR SOLICITUD
*/


	echo "</tr>";
// FIN poner renglon resultados
}
echo "</table>";



#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo 	= 1;
$pagina_maximo 	= @$paginas_entero;

$paginas_intervalo 		= 5;
$pagina_vista_inicio 	= $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = @$paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
	$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
}
	
$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
		{
			$color = 'red';
		}
		else {$color='';}
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####
	

echo "</fieldset></section>";

} // SI HAY RESULTADOS
else{
	echo "<fieldset>";
	ECHO "<h3>NO HAY REGISTROS DE TRASLADOS</h3>";
	echo "</fieldset>";
}