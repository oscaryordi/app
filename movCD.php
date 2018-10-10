<?php
// MEDIDAS
$anio		= date('Y');
$semana		= date('W');
$diadelanio	= date('z');

// RUTAS
$raiz 		= '../exp/traslados';
$checkAnio 	= $raiz."/".$anio;
$checkSem	= $checkAnio."/".$semana;
$checkDia	= $checkSem."/".$diadelanio;

if(!is_dir("$raiz")) // CARPETA DE TEMA o hacer
	{
		mkdir("$raiz");
	}

if(!is_dir("$checkAnio")) // AÑO
	{
		mkdir("$checkAnio");
	}

if(!is_dir("$checkSem")) // SEMANA
	{
		mkdir("$checkSem");
	}

if(!is_dir("$checkDia")) // DIA
	{
		mkdir("$checkDia");
	}

$rutaz = $anio."/".$semana."/".$diadelanio;

echo $rutaz;
//echo "<br/>";

?>