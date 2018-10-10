<?php
date_default_timezone_set('America/Mexico_city');

// MEDIDAS
$anio		= date('Y');
$semana		= date('W');
$diadelanio	= date('z')+1; // desde 0 hasta 365

$diadelanio = 800;


// RUTAS
$raiz 		= '../exp';

//$raiz 		='C:/inetpub/wwwroot/jetvan/exp';

$checkAnio 	= $raiz."/".$anio;
$checkSem	= $checkAnio."/".$semana;
$checkDia	= $checkSem."/".$diadelanio;

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
		echo "<br>RESULTADO dentro";
		var_dump(is_dir("$checkDia"));
		echo "<br>";
		mkdir("$checkDia");
		echo "<br>RESULTADO dentro";
		var_dump(is_dir("$checkDia"));
		echo "<br>";

	}
		echo "<br>RESULTADO fuera";
		var_dump(is_dir("$checkDia"));
		echo "<br>";

/*
if(!file_exists("$checkAnio")) // AÑO
	{
		mkdir("$checkAnio", 0777, true);
	}
if(!file_exists("$checkSem")) // SEMANA
	{
		mkdir("$checkSem", 0777, true);
	}

if(!file_exists("$checkDia")) // DIA
	{
		mkdir("$checkDia", 0777, true);
	}
*/



echo $checkDia;


echo "<br>";
$rutaz = $anio."/".$semana."/".$diadelanio;

echo $rutaz;
echo "<br/>";
?>