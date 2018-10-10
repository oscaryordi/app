<?php
session_start();
include("seguridad.php");
include("caducidad.php");
echo "<meta charset='utf-8'>";
include_once("base.inc.php");
include_once("funcion.php");
$id_sustituto = $_GET['id_sustituto']; 

$sql_sustituto 	= "SELECT * FROM `sustituto` WHERE `id_sust` = '$id_sustituto' LIMIT 1 "; 
$res_sustituto 	= mysqli_query($dbd2, $sql_sustituto);
@$matriz_r_sust = mysqli_fetch_array($res_sustituto);

@$id_contrato =		$matriz_r_sust['id_contrato'];
@$serieF3 =			$matriz_r_sust['serieFallado'];
@$serieS3 =			$matriz_r_sust['serieSustituto'];
@$folioInventario =	$matriz_r_sust['id_formato'];
@$fechaDevolucion =	$matriz_r_sust['fechaDev'];
@$proyecto = 		$matriz_r_sust['proyecto'];
@$motivo = 			$matriz_r_sust['motivo'];
@$lugarResguardo = 	$matriz_r_sust['lugarResguardo'];
@$capturo = 		$matriz_r_sust['capturo'];
@$fecharegistro = 	$matriz_r_sust['fecharegistro'];
 

idxserie($serieF3);
datosxid($id_unidad);
//datosporserie($serieF3);
$economicoF =	$Economico;
$serieF =		$Serie;
$placasF =		$Placas;
$tipoF =		$Vehiculo;


idxserie($serieS3);
datosxid($id_unidad);
//datosporserie($serieS3);
$economicoS =	$Economico;
$serieS =		$Serie;
$placasS =		$Placas;
$tipoS =		$Vehiculo;

$sql_ejec 	= "SELECT * FROM `usuarios` WHERE `id_usuario` = '$capturo' LIMIT 1 ";
$res_ejec 	= mysqli_query($dbd2, $sql_ejec);
@$matriz_ejec = mysqli_fetch_array($res_ejec);

@$nombreEjec = 	$matriz_ejec[nombre];


contratoxid($id_contrato); // para pintar datos de contrato
clientexid($id_cliente); // para pintar dstos de cliente

//echo $serieF3 .$serieS3 .$folioInventario .$fechaDevolucion .$proyecto  .$motivo  .$lugarResguardo  .$capturo  ;
//echo "<br>".$economicoF .$serieF .$placasF .$tipoF ."<br>".$economicoS .$serieS .$placasS .$tipoS ;
//echo $nombreEjec;

?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 14">
<link rel=File-List href="AutoSustituto_archivos/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="AutoSustitutoODSY_22794_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl6522794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"dd\\-mmm";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6622794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6722794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6822794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6922794
	{padding:0px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:red;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7022794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:red;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7122794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:red;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7222794
	{padding:0px;
	mso-ignore:padding;
	color:white;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#00B050;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7322794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#00B050;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7422794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#00B050;
	mso-pattern:black none;
	white-space:nowrap;}
.xl7522794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7622794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:justify;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7722794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:justify;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7822794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:justify;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7922794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	background:#EEECE1;
	mso-pattern:black none;
	mso-protection:unlocked visible;
	white-space:nowrap;}
.xl8022794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8122794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8222794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8322794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8422794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8522794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8622794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8722794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8822794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8922794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9022794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9122794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:0;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9222794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\[$-80A\]dddd\\\,\\ dd\0022 de \0022mmmm\0022 de \0022yyyy\;\@";
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9322794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\[$-80A\]dddd\\\,\\ dd\0022 de \0022mmmm\0022 de \0022yyyy\;\@";
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9422794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\[$-80A\]dddd\\\,\\ dd\0022 de \0022mmmm\0022 de \0022yyyy\;\@";
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9522794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:20.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl9622794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl9722794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9822794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl9922794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10022794
	{padding:0px;
	mso-ignore:padding;
	color:red;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10122794
	{padding:0px;
	mso-ignore:padding;
	color:red;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl10222794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10322794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10422794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10522794
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10622794
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10722794
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl10822794
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:normal;}
.xl10922794
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:normal;}
.xl11022794
	{padding:0px;
	mso-ignore:padding;
	color:windowtext;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:normal;}
.xl11122794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11222794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11322794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11422794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11522794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11622794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11722794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11822794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl11922794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12022794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12122794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12222794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12322794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:none;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12422794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12522794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12622794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12722794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:none;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl12822794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl12922794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl13022794
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
-->
</style>
</head>

<body>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--La siguiente información se generó mediante el Asistente para publicar como
página web de Microsoft Excel.-->
<!--Si se vuelve a publicar el mismo elemento desde Excel, se reemplazará toda
la información comprendida entre las etiquetas DIV.-->
<!----------------------------->
<!--INICIO DE LOS RESULTADOS DEL ASISTENTE PARA PUBLICAR COMO PÁGINA WEB DE
EXCEL -->
<!----------------------------->

<div id="AutoSustitutoODSY_22794" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=658 class=xl6553522794
 style='border-collapse:collapse;table-layout:fixed;width:494pt'>
 <col class=xl6553522794 width=40 span=5 style='mso-width-source:userset;
 mso-width-alt:1462;width:30pt'>
 <col class=xl6553522794 width=57 style='mso-width-source:userset;mso-width-alt:
 2084;width:43pt'>
 <col class=xl6553522794 width=48 style='mso-width-source:userset;mso-width-alt:
 1755;width:36pt'>
 <col class=xl6553522794 width=40 span=3 style='mso-width-source:userset;
 mso-width-alt:1462;width:30pt'>
 <col class=xl6553522794 width=51 style='mso-width-source:userset;mso-width-alt:
 1865;width:38pt'>
 <col class=xl6553522794 width=40 span=2 style='mso-width-source:userset;
 mso-width-alt:1462;width:30pt'>
 <col class=xl6553522794 width=62 style='mso-width-source:userset;mso-width-alt:
 2267;width:47pt'>
 <col class=xl6553522794 width=40 style='mso-width-source:userset;mso-width-alt:
 1462;width:30pt'>
 <tr height=20 style='height:15.0pt'>





 <td colspan=3 height=20 class=xl7922794 width=120 style='height:15.0pt;
  width:90pt'>F_SUSTITUTO:<?php echo $id_sustituto;?></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=57 style='width:43pt'></td>
  <td class=xl6553522794 width=48 style='width:36pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=51 style='width:38pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
  <td class=xl6553522794 width=62 style='width:47pt'></td>
  <td class=xl6553522794 width=40 style='width:30pt'></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 style='height:15.0pt' align=left valign=top><!--[if gte vml 1]><v:shapetype
   id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
   path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>
    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="_x0031__x0020_Imagen" o:spid="_x0000_s1025"
   type="#_x0000_t75" alt="logo jet van.jpg" style='position:absolute;
   margin-left:0;margin-top:0;width:170.25pt;height:68.25pt;z-index:1;
   visibility:visible' o:gfxdata="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
BwgMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDP/AABEI
AH0BNgMBIgACEQEDEQH/xAAfAAABBQEBAQEBAQAAAAAAAAAAAQIDBAUGBwgJCgv/xAC1EAACAQMD
AgQDBQUEBAAAAX0BAgMABBEFEiExQQYTUWEHInEUMoGRoQgjQrHBFVLR8CQzYnKCCQoWFxgZGiUm
JygpKjQ1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoOEhYaHiImKkpOUlZaX
mJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4eLj5OXm5+jp6vHy8/T19vf4
+fr/xAAfAQADAQEBAQEBAQEBAAAAAAAAAQIDBAUGBwgJCgv/xAC1EQACAQIEBAMEBwUEBAABAncA
AQIDEQQFITEGEkFRB2FxEyIygQgUQpGhscEJIzNS8BVictEKFiQ04SXxFxgZGiYnKCkqNTY3ODk6
Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqCg4SFhoeIiYqSk5SVlpeYmZqio6Slpqeo
qaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2dri4+Tl5ufo6ery8/T19vf4+fr/2gAMAwEAAhED
EQA/AP38prnatOpsv+rNAEfmt60ea3rTaKAHea3rR5retNooAd5retHmt602igB3mt60ea3rTaKA
Hea3rR5retNooAd5retHmt602igB3mt60ea3rTaKAHea3rR5retNooAd5retHmt602igB3mt60ea
3rTaKAHea3rR5retVI9XtZbmeBbm3aa1AM0YkG6IMMjcM5XPbNMufEen2g/eX9jF/vzKv8zWNbEU
qKvVko+rS/MuNOb2TL3mN618qf8ABVP/AIKJX/8AwT6+GPh3UdH0Kx8Qa54n1B7W3ivZWjt4I4k3
yO23knlVABH3s9ufo26+Jnh2xz5muaUp7j7SpP6Gvyn/AODk7x/a+JNU+EdlYXK3Fqthqt+JIzlW
y0MQI/FSKrJcyy7HY5YSlWhOVm3GMot2XVpO6V7a+aP0nwr4XpZtxRhcFmNJyoycnJO6T5YSkldW
6pdT9Ov2ZPjYv7Rn7Pvg/wAdR2Mmlr4q0uHUPsjtuNuXUEpux8wB6HHI5rvPMb1rwP8AZk+Jfhv4
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
cGVnUEsFBgAAAAAGAAYAhQEAAE1HAAAAAA==
">
   <v:imagedata src="AutoSustituto_archivos/AutoSustitutoODSY_22794_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:0px;margin-top:0px;width:227px;
  height:91px'><img width=227 height=91
  src="AutoSustituto_archivos/AutoSustitutoODSY_22794_image002.png"
  alt="logo jet van.jpg" v:shapes="_x0031__x0020_Imagen"></span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=20 class=xl6553522794 width=40 style='height:15.0pt;width:30pt'></td>
   </tr>
  </table>
  </span></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td colspan=8 rowspan=4 class=xl9522794 width=361 style='width:271pt'>Formato
  de registro para AUTO SUSTITUTO</td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td colspan=5 class=xl9622794>Nombre del ejecutivo solicitante:</td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>


 
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td colspan=7 class=xl8122794 style='border-right:.5pt solid black'><?php echo $nombreEjec;?></td>
  <td colspan=3 class=xl9722794 style='border-right:.5pt solid black;
  border-left:none'>Folio de inventario</td>
  <td colspan=2 class=xl10022794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $folioInventario ;?></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td colspan=5 class=xl9722794 style='border-right:.5pt solid black'>Fecha de
  solicitud de prestamo</td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td colspan=5 class=xl9722794 style='border-right:.5pt solid black'>Fecha
  probable de devolucion</td>
  <td class=xl6553522794></td>
 </tr>
 

 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6522794 style='height:15.0pt'></td>
  <td colspan=5 class=xl9222794 style='border-right:.5pt solid black'><?php echo $fecharegistro;?></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td colspan=5 class=xl9222794 style='border-right:.5pt solid black'><?php echo $fechaDevolucion;?></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td colspan=9 class=xl10222794 style='border-right:.5pt solid black'>Proyecto</td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td colspan=9 class=xl8122794 style='border-right:.5pt solid black'>
  	<?php echo 
  		"ID:".$id_alan
  		."<BR> cte: ".$razonSocial
  		."<BR> cto: ".$numero
  		."  ".$proyecto;    ?>
  			
  	</td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=15 height=20 class=xl9722794 style='border-right:.5pt solid black;
  height:15.0pt'>MOTIVO</td>
 </tr>
 <tr height=72 style='mso-height-source:userset;height:54.0pt'>
  <td colspan=15 height=72 class=xl7622794 width=658 style='border-right:.5pt solid black;
  height:54.0pt;width:494pt'><?php echo $motivo;?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7622794 width=40 style='height:15.0pt;width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=57 style='width:43pt'>&nbsp;</td>
  <td class=xl7722794 width=48 style='width:36pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=51 style='width:38pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=40 style='width:30pt'>&nbsp;</td>
  <td class=xl7722794 width=62 style='width:47pt'>&nbsp;</td>
  <td class=xl7822794 width=40 style='width:30pt'>&nbsp;</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7222794 colspan=3 style='height:15.0pt'>AUTO SUSTITUTO</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7322794>&nbsp;</td>
  <td class=xl7422794 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=15 height=20 class=xl8422794 style='height:15.0pt'>DATOS DEL AUTO
  SUSTITUTO</td>
 </tr>
 

 
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl8022794 style='height:15.0pt'>Economico</td>
  <td colspan=3 class=xl8522794>Placas</td>
  <td colspan=4 class=xl8522794>Serie</td>
  <td colspan=5 class=xl8522794>Tipo</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl8122794 style='border-right:.5pt solid black;
  height:15.0pt'><?php echo $economicoS;?></td>
  <td colspan=3 class=xl8922794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $placasS;?></td>
  <td colspan=4 class=xl8122794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $serieS;?></td>
  <td colspan=5 class=xl8622794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $tipoS;?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6722794 style='height:15.0pt'></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6622794></td>
  <td class=xl6622794></td>
  <td class=xl6553522794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6922794 colspan=2 style='height:15.0pt'>AUTO BASE</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7022794>&nbsp;</td>
  <td class=xl7122794>&nbsp;</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=15 height=20 class=xl8422794 style='height:15.0pt'>DATOS DEL<span
  style='mso-spacerun:yes'>  </span>AUTO EN PROYECTO</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl8022794 style='height:15.0pt'>Economico</td>
  <td colspan=3 class=xl8522794>Placas</td>
  <td colspan=4 class=xl8522794>Serie</td>
  <td colspan=5 class=xl8522794>Tipo</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=3 height=20 class=xl8122794 style='border-right:.5pt solid black;
  height:15.0pt'><?php echo $economicoF;?></td>
  <td colspan=3 class=xl8922794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $placasF;?></td>
  <td colspan=4 class=xl8122794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $serieF;?></td>
  <td colspan=5 class=xl8622794 style='border-right:.5pt solid black;
  border-left:none'><?php echo $tipoF ;?></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6722794 style='height:15.0pt'></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6622794></td>
  <td class=xl6622794></td>
  <td class=xl6553522794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
  <td class=xl6722794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl7522794 style='height:15.0pt'></td>
  <td colspan=13 class=xl8522794>Domicilio de resguardo de la Unidad</td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=86 style='mso-height-source:userset;height:64.5pt'>
  <td height=86 class=xl6553522794 style='height:64.5pt'></td>
  <td colspan=13 class=xl12822794 width=578 style='border-right:.5pt solid black;
  width:434pt'><?php echo $lugarResguardo;?><span style='mso-spacerun:yes'> </span></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td colspan=6 class=xl10522794 style='border-right:.5pt solid black'>Firma
  del ejecutivo</td>
  <td class=xl6553522794></td>
  <td colspan=6 class=xl10822794 width=273 style='border-right:.5pt solid black;
  width:205pt'>Firma de autorizacion control vehicular</td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td colspan=6 rowspan=3 class=xl11122794 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'><?php echo $nombreEjec; ?></td>
  <td class=xl6553522794></td>
  <td colspan=6 rowspan=3 class=xl12022794 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>&nbsp;</td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl6553522794 style='height:15.0pt'></td>
  <td class=xl6822794></td>
  <td class=xl6822794></td>
  <td class=xl6822794></td>
  <td class=xl6822794></td>
  <td class=xl6822794></td>
  <td class=xl6822794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
  <td class=xl6553522794></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=57 style='width:43pt'></td>
  <td width=48 style='width:36pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=51 style='width:38pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=40 style='width:30pt'></td>
  <td width=62 style='width:47pt'></td>
  <td width=40 style='width:30pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--FINAL DE LOS RESULTADOS DEL ASISTENTE PARA PUBLICAR COMO PÁGINA WEB DE
EXCEL-->
<!----------------------------->
</body>

</html>
