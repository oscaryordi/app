<?php
include '1header.php';
if($_SESSION["datos"] > 0){ // apertura privilegio 

global $TipoBusqueda;
global $ValorBuscado;

global $economico;
global $placas	 ;
global $serie	 ;

@$economico  = limpiarVariable($_POST['economico']);
@$placas	 = limpiarVariable($_POST['placas']);
@$serie	     = limpiarVariable($_POST['serie']);
@$id_unidad  = limpiarVariable($_GET['id_unidad']);
//@$id_unidad  = limpiarVariable($_POST['id_unidad']);
@$paginaRM   = limpiarVariable($_GET['pagina']);

echo $economico  ;
echo $placas	 ;
echo $serie	     ;

// INICIO OBTENER ID DE UNIDAD
if(isset($economico) && $economico !== ''){
	idxeconomico($economico);
	$TipoBusqueda = 'ECONOMICO';
	$ValorBuscado = $economico ;
	}
elseif(isset($placas) && $placas !== ''){
	idxplaca($placas);
	$TipoBusqueda = 'PLACAS';
	$ValorBuscado = $placas ;
	}
elseif(isset($serie) && $serie !== ''){
	idxserie($serie);
	$TipoBusqueda = 'SERIE';
	$ValorBuscado = $serie ;
	}
elseif(@$_GET['id_unidad'] !== ''){ // reportaba el error de inexistencia
	global $id_unidad;
	@$id_unidad   = $_GET['id_unidad'];
	$TipoBusqueda = 'ID UNIDAD';
	$ValorBuscado = @$id_unidad ; // reportaba el error de inexistencia
	}
/*  NO SIRVIO ?????  
elseif(@$_POST['id_unidad'] !== ''){ // reportaba el error de inexistencia
	global $id_unidad;
	$id_unidad   = $_POST['id_unidad'];
	$TipoBusqueda = 'ID UNIDAD';
	$ValorBuscado = @$id_unidad ; // reportaba el error de inexistencia  
	}
 */ //  NO SIRVIO ?????	 
// TERMINA OBTENER ID DE UNIDAD

// INICIO OBTENER AUTORIZACION DE VISTA
$vistaAutorizada = ''; // CUANDO FILTRO FLOTILLA ES 0 PUEDE VER TODO EN AUTOMATICO

if($_SESSION["filtroFlotilla"] == 0){ // no puede ver // NIVEL CONTRATO
   $vistaAutorizada = 'si';
}
elseif($_SESSION["filtroFlotilla"] == 1){ // no puede ver // NIVEL CONTRATO
	unidadVistaAutorizada($id_unidad, $_SESSION["id_usuario"]);
}
elseif($_SESSION["filtroFlotilla"] == 2){ // SUBNIVEL 2
	unidadVistaAutorizadaSN2($id_unidad, $_SESSION["id_usuario"]);
}
elseif($_SESSION["filtroFlotilla"] == 3){ // SUBNIVEL 3
	unidadVistaAutorizadaSN3($id_unidad, $_SESSION["id_usuario"]);
}
else{
	$vistaAutorizada = 'no';
}
// TERMINA OBTENER AUTORIZACION DE VISTA

if($vistaAutorizada == 'si'){  // INICIA ESTA AUTORIZADO PARA VER
	//echo	"<title>Consulta por $TipoBusqueda</title>";
	echo	'<h3>RESULTADO DE LA CONSULTA</h3>';
	echo	"<h4>por $TipoBusqueda</h4>";
	echo	"Valor buscado: <font size=3em><b>$ValorBuscado</b></font>";
	echo	"<br>ID: ".$id_unidad;

	if($id_unidad != '' && $id_unidad != null && $id_unidad != 0 ){	
		include ("u4datos.php");
		include ("u5placas.php");
		include ("u13km.php");

		if($_SESSION["gpsA"]>0){
		include ("u15gpsAlerta.php");
		}

		include ("u11asignacion.php");

		if($_SESSION["asigEVer"]>0 && isset($id_cliente) ){
			include ("clienteCtoEjec.php");  
		}

		include ("u12siniestro.php");
		include ("u6ubicacion.php");
		include ("u6ubicacionsust.php"); // ES SUSTITUTO
		include ("u6ubicacionsusttrae.php"); // TIENE SUSTITUTO
		include ("u7factura.php");
		include ("u14infraccion.php");
		include ("u16solAtn.php");
		include ("u8mtto.php");
		include ("u9docto.php");
		include ("u10gps.php");
	}   
	else{
		echo "<h3>El valor buscado no fue encontrado intenta con los ultimos 6 digitos de la serie </h3>";
		echo "<a href='u1consulta.php'>Consultar otro</a>";
	}
} // TERMINA ESTA AUTORIZADO PARA VER


} // cierre privilegio
include ("1footer.php");
?>