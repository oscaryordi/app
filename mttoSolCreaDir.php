<?php
// MEDIDAS
$anio		= date('Y');
$semana		= date('W');
$diadelanio	= date('z');

// RUTAS
$raiz 		= '../exp/mtto';
$checkAnio 	= $raiz."/".$anio;
$checkSem	= $checkAnio."/".$semana;
$checkDia	= $checkSem."/".$diadelanio;

if(!is_dir("$raiz")) // CARPETA DE TEMA o hacer
	{
		mkdir("$raiz");
	}

if(!is_dir("$checkAnio")) // AÑO o hacer
	{
		mkdir("$checkAnio");
	}

if(!is_dir("$checkSem")) // SEMANA o hacer
	{
		mkdir("$checkSem");
	}

if(!is_dir("$checkDia")) // DIA o hacer
	{
		mkdir("$checkDia");
	}

$rutaz = $anio."/".$semana."/".$diadelanio;

//echo $rutaz; // LA MOSTRAMOS AL PRINCIPIO PARA CONFIRMAR EL SCRIPT
//echo "<br/>";

?>