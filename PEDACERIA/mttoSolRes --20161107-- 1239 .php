<?php include("1header.php");
include_once ("base.inc.php"); 

if($_SESSION["mttoSol"] > 1){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include ("nav_mtto.php"); 

include_once("funcion.php");

$id_usuario = $_SESSION["id_usuario"]; 

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 50; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = "1";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta_gps;

if($_SESSION["mttoSol"] == 2){
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol WHERE capturo = '$id_usuario' ";
}

if($_SESSION["mttoSol"] > 2){
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol";	
}

$sacar_cuentagps 	= mysql_query($cuenta_gps);
$cuenta 			= mysql_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE MANTENIMIENTO SOLICITADO</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION

?>
<style>
	#ResTabla tr:hover {background-color: #ddd;}
</style>
<section><fieldset><legend>RESUMEN DE MANTENIMIENTO</legend>

<?php


$sql_mttoSol = '';

if($_SESSION["mttoSol"] == 2){
// SI CONSULTA EJECUTIVO
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
        . "  WHERE capturo = '$id_usuario' "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["mttoSol"] > 2){
// SI CONSULTA SUPERVISOR
	$sql_mttoSol = 'SELECT * '
        . ' FROM mttoSol '
 //       . "  WHERE capturo = '$id_usuario' "
        . ' ORDER BY '
        . ' id_mttoSol '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}



		
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
</tr>";

$mttoSol_R = mysql_query($sql_mttoSol);

while($row = mysql_fetch_assoc($mttoSol_R)){

	$id_mttoSol 	= $row['id_mttoSol']; // 
	$fechaEj 		= $row['fechaEj'];
	$id_unidad		= $row['id_unidad'];
	$id_contrato 	= $row['id_contrato'];

	$id_prov 		= $row['id_prov'];

	$concepto 		= $row['concepto'];
	$importe 		= $row['importe'];
	$km 			= $row['km'];

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


/*
// INICIO saber si subio MAIL
$tieneMail = 0;
if($dM5 > 0){	
	$sql_mail = "SELECT * FROM mttoDocto 
				WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = 5  
				ORDER BY id_docto DESC LIMIT 1 ";
	$mail_R 	= mysql_query($sql_mail);
	while($rowmail = mysql_fetch_assoc($mail_R)){ 
		$archivoMl = $rowmail['archivo'];
		$rutaMl 	= $rowmail['ruta'];
	}
	$tieneMail = mysql_affected_rows();
}
// FIN saber si subio MAIL
*/

/*
// INICIO saber si subio COTIZACION
$tieneCot = 0;
if($dC1 > 0){	
	$sql_cot = "SELECT * FROM mttoDocto 
				WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = 1  
				ORDER BY id_docto DESC LIMIT 1 ";
	$cot_R 	= mysql_query($sql_cot);
	while($rowcot = mysql_fetch_assoc($cot_R)){ 
		$archivoC = $rowcot['archivo'];
		$rutaC 	= $rowcot['ruta'];
	}
	$tieneCot = mysql_affected_rows();
}
// FIN saber si subio COTIZACION
*/

/*
// INICIO saber si subio DEPOSITO
$tieneDep = 0;
if($pagado > 0){
	$sql_dep = "SELECT * FROM mttoDocto 
				WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = 2  
				ORDER BY id_docto DESC LIMIT 1 ";
	$dep_R 	= mysql_query($sql_dep);
	while($rowdep = mysql_fetch_assoc($dep_R)){ 
		$archivoD = $rowdep['archivo'];
		$rutaD 	  = $rowdep['ruta'];
	}
	$tieneDep = mysql_affected_rows();
}
// FIN saber si subio DEPOSITO
*/

/*
// INICIO saber si subio FACTURA
$tieneFact = 0;
if($facturado > 0){
	$sql_fact = "SELECT * FROM mttoDocto 
				WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = 3  
				ORDER BY id_docto DESC LIMIT 1 ";
	$fact_R 	= mysql_query($sql_fact);
	while($rowfact = mysql_fetch_assoc($fact_R)){ 
		$archivoF = $rowfact['archivo'];
		$rutaF 	  = $rowfact['ruta'];
	}
	$tieneFact = mysql_affected_rows();
}
// FIN saber si subio FACTURA
*/

// INICIO saber si tiene FOTOS
//$tieneFot = 0;
if($dF4 > 0){
	$sql_fot = "SELECT * FROM mttoDocto 
				WHERE id_mttoSol = '$id_mttoSol' AND 
				tipo = 4  
				ORDER BY id_docto DESC LIMIT 5 ";
	$fot_R 	= mysql_query($sql_fot);
/*	while($rowfot = mysql_fetch_assoc($fot_R)){ 
		$archivoFt 	= $rowfot['archivo'];
		$rutaFt 	= $rowfot['ruta'];
	}*/
//	$tieneFot = mysql_affected_rows();
}
// FIN saber si tiene FOTOS


// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_mttoSol}</td>";
	echo "<td>{$fechaEj}</td>";
	datosxid($id_unidad);
	echo "<td>{$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";
	number_format($importe, 2);
	echo "<td>{$importe}</td>";
	proveedorxid($id_prov);
	echo "<td>{$esrbolso}{$nombreR}{$esrbolso2}{$PrazonSocial}</td>";
	echo "<td>{$concepto}</td>";
	echo "<td>{$km}</td>";

	


	if($autorizadoS > 0 OR $pagado > 0 )
		{
	echo "<td><a title='Concluido' ><img src='img/Lock.gif' style='width:16px;height:16px;'  alt='Concluido' ></a>
		</td>";
		}
	else
		{
	echo "<td><a href='mttoSolEditar.php?id_mttoSol=$id_mttoSol&pagina=$pagina'  
				style='text-decoration:none;'  title='Editar' >
				<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
		</a></td>";
		}






	echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=0&pagina=$pagina'  
				style='text-decoration:none;'  title='Subir Archivo' >
				<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
		</a></td>";

	##### ##### ##### ##### ##### ##### ##### #####
	// INICIO ESTA AUTORIZADO  
	// 0 INCOMPLETO, 1 PENDIENTE, 2 AUTORIZADO, 3 RECHAZADO, 4 CORREGIR
		// PENDIENTE (NORMAL) DEBE TENER 1 COTIZACION, 1 CORREO
		// PENDIENTE (REEMBOLSO) DEBE TENER 1 FACTURA, 1 CORREO, 1 REEMBOLSO


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

/*
	if($tieneMail == 1)
		{
			echo "<td><a href='../exp/mtto/$rutaMl/$archivoMl'  
					style='text-decoration:none;' target='_blank' title='Ver Mail' >
					<img src='img/Mail.gif' style='width:16px;height:16px;'  alt='Ver Mail' >
				</a></td>"; // COTIZACION
		}
*/
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=5'  
					style='text-decoration:none;' title='Subir Archivo' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
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
/*
			echo "<td><a href='../exp/mtto/$rutaFt/$archivoFt'  
					style='text-decoration:none;' target='blank' title='Ver Foto' >
					<img src='img/Green Tag.gif' style='width:16px;height:16px;'  alt='Ver Foto' >
				</a></td>"; // FOTOS
*/
		}
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=4'  
					style='text-decoration:none;'  title='Subir Archivo' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
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

/*
	if($tieneCot == 1)
		{
			echo "<td><a href='../exp/mtto/$rutaC/$archivoC'  
					style='text-decoration:none;' target='_blank' title='Ver Cotización' >
					<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver Cotización' >
				</a></td>"; // COTIZACION
		}
*/
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=1'  
					style='text-decoration:none;' title='Subir Archivo' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
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
/*	if($tieneDep == 1)
		{
			echo "<td><a href='../exp/mtto/$rutaD/$archivoD'  
					style='text-decoration:none;' target='_blank' title='Ver Deposito' >
					<img src='img/pagado.jpg' style='width:16px;height:16px;'  alt='Ver Deposito' >
				</a></td>"; // PAGO
		}
*/		
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=2'  
					style='text-decoration:none;'  title='Subir Archivo' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
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
/*	if($tieneFact == 1)
		{
			echo "<td><a href='../exp/mtto/$rutaF/$archivoF'  
					style='text-decoration:none;' target='_blank' title='Ver Factura' >
					<img src='img/th.jpg' style='width:16px;height:16px;'  alt='Ver Factura' >
				</a></td>"; // FACTURADO
		}*/
	else // SUBIR
		{
			echo "<td><a href='mttoSolaltaDoc.php?id_mttoSol=$id_mttoSol&tipo=3'  
					style='text-decoration:none;'  title='Subir Archivo' >
					<img src='img/Upload.gif' style='width:16px;height:16px;'  alt='Subir Archivo' >
				</a></td>"; // FACTURADO
		}
	// TERMINA ANALIZA SI ESTA FACTURADO

	echo "<td><a href='SolicitudCHQVerId.php?id_mttoSol=$id_mttoSol'  
	style='text-decoration:none;' target='_blank' title='Ver Formato' >
	<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver Solicitud' ></a></td>";	

	// resetear variables de REEMBOLSO
	$esrbolso = '';
	$nombreR = '';
	$esrbolso2 = '';
	// resetear variables de REEMBOLSO

	echo "</tr>";
// FIN poner renglon resultados

}
echo "</table>";



#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
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
		echo "<a href='mttoSolRes.php?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####
	
?>
</fieldset></section>

<?php } // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>