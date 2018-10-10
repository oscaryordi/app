<?php

if($_SESSION["estimacionH"] > 0){
	echo "<p><a href='tutoEstimacion.php' > E1. COMO SUBIR ESTIMACIONES</a></p>";}

if($_SESSION["estimacionH"] > 0){
echo "<p><a href='tutoFacturacion.php' > E2. COMO SUBIR FACTURAS</a></p>";}



if($_SESSION["datos"] > 0){
	echo "<p><a href='tutoConsultaUnidadVehicular.php' > C1. COMO CONSULTAR UNIDAD VEHICULAR</a></p>";}

tienecontrato($_SESSION["id_usuario"]);
if($miflotilla > 0){
	echo "<p><a href='tutoConsultaFlotilla.php' > C2. COMO CONSULTAR FLOTILLA ASIGNADA</a></p>";}




if($_SESSION["siniestro"] > 1){
	echo "<p><a href='tutoSiniestro.php' > S1. COMO REGISTRAR SINIESTROS</a></p>";}

if($_SESSION["documentos"] > 1){
	echo "<p><a href='tutoDocumentos.php' > D1. COMO SUBIR DOCUMENTOS</a></p>";}

if($_SESSION["mttoSol"] > 1){
	echo "<p><a href='tutoMtto.php' > M1. COMO SOLICITAR PAGO DE MANTENIMIENTO VEHICULAR</a></p>";}

if($_SESSION["sustituto"] > 1){
	echo "<p><a href='tutoSustituto.php' > L1. COMO SOLICITAR SUSTITUTO</a></p>";}

if($_SESSION["movimientos"] > 1)
{
	echo "<p><a href='tutoEntradas.php' > L2. COMO REGISTRAR ENTRADAS Y SALIDAS A PATIOS</a></p>";
	echo "<p><a href='tutoEntrega.php' > L3. COMO RECIBIR Y ENTREGAR UNIDADES</a></p>";
}

?>