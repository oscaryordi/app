<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php");

$capturo	=	$_SESSION['id_usuario'];

if($capturo)
	{
		header("Location: http://netdevel.online/soporte/aviso.htm");
	}
?>