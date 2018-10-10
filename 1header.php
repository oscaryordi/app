<?php 
ini_set("session.cookie_lifetime",7200);
ini_set("session.gc_maxlifetime",7200);
session_start();
include("seguridad.php");
include("caducidad.php");
include_once('base.inc.php');
include_once('funcion.php');
$urlPrincipal = 'https://www.jetvan.mx/jetvan';
?>
<!DOCTYPE html>
<html>
<meta name=viewport content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<meta name="description" content="Jet Van, Administración y Monitoreo del Servicio" />
<meta name="keywords" content="Jet Van, jetvan, servicio, arrendamiento, automotriz" />
<script defer src='https://use.fontawesome.com/releases/v5.0.9/js/all.js' 
	integrity='sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl' 
	crossorigin='anonymous'>
</script>
<!-- modernizr enables HTML5 elements and feature detects -->
<!--<script type="text/javascript" src="js/modernizr-1.5.min.js"></script>-->
<head>
	<STYLE > 
		img{height:50px;width:auto;}
		.encabezado{display: inline-block; margin-left: 1em ;vertical-align:middle;}
		.encabezado2{display: inline-block; margin-left: 1em ;vertical-align:middle;}
		.ResTabla tr:hover {background-color: #ddd;}
		#ResTabla tr:hover {background-color: #ddd;}
		#ResTabla a {text-decoration: none; color:#006699;}
	</STYLE>
	<link href="https://fonts.googleapis.com/css?family=Handlee|" rel="stylesheet"> 
	<link rel='shortcut icon' href='/favicon.ico' />
	<link rel='icon' href='/favicon.ico' />
	<link href="/favicon.ico" rel='shortcut icon'  type='image/x-icon' />
	<link href="/favicon.ico" rel='icon'  type='image/x-icon' />
	<link rel="apple-touch-icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlPrincipal;?>/favicon.ico" />
	<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" href="<?php echo $urlPrincipal;?>/favicon.ico"/>
	<link rel='icon' href='/favicon.ico' type="image/vnd.microsoft.icon"/>
	<?php if(@$TipoBusqueda==''){$TipoBusqueda= 'Jet Van Car Rental, S.A. de C.V.';}?>
	<title><?php echo @$TipoBusqueda; ?></title>
</head>
<body>
<div id= "wrapper"> <!-- CONTENIDO GENERAL --> <!-- #wrapper -->
	<div id="header"> <!-- ENCABEZADO --> <!-- #header -->
		<header>
			<img src="logo_i2.jpg" class="encabezado" />
			<p class="encabezado" ><razon> Jet Van Car Rental, S.A. de C.V. </razon></p>
			<!-- <h4>Administración, monitoreo, registro y seguimiento del servicio de arrendamiento automotriz</h4> -->
			<p class="encabezado2">Bienvenido: <usuario><?php echo $_SESSION['nombre']; ?></usuario></p>
			<p class="encabezado2"><?php echo date('Y-m-d');?></p>
			<p class="encabezado2"><a href='usuarioClave.php'>Cambiar Clave</a></p>
		</header>
		<?php include("1nav.php");?>
	</div>	<!-- ENCABEZADO --> <!-- #header -->
<div id="content">