<?php
session_start();
include("seguridad.php");
include("caducidad.php"); 
?>
<meta charset='utf-8'>
<?php 
include_once("base.inc.php");
include_once("funcion.php");
include_once("num2letras.php");

$id_mttoSol = $_GET['id_mttoSol']; // NO MOVER

$sql_mttoSol 	= "SELECT * FROM `mttoSol` WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
@$sql_mttoSol_M = mysqli_fetch_array($sql_mttoSol_R);


@$id_unidad 	=	$sql_mttoSol_M['id_unidad'];
@$id_cliente 	=	$sql_mttoSol_M['id_cliente'];
@$id_contrato 	=	$sql_mttoSol_M['id_contrato'];
@$fechaEj		=	$sql_mttoSol_M['fechaEj'];
@$fechaAu		=	$sql_mttoSol_M['fechaAu'];
@$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
@$importe 		=	$sql_mttoSol_M['importe'];
@$km 			= 	$sql_mttoSol_M['km'];
@$obs 			=	strtoupper($sql_mttoSol_M['obs']);
@$id_prov 		= 	$sql_mttoSol_M['id_prov'];
@$id_prov_c		= 	$sql_mttoSol_M['id_prov_c'];
@$id_prov_s		= 	$sql_mttoSol_M['id_prov_s'];
@$capturo 		=	$sql_mttoSol_M['capturo'];
@$autorizadoS 	=	$sql_mttoSol_M['autorizadoS'];
@$autorizo 		=	$sql_mttoSol_M['autorizo'];

datosxid($id_unidad);

clientexid($id_cliente);
contratoxid($id_contrato);
proveedorxid($id_prov);
provCtaxid($id_prov_c);
reembxid($id_mttoSol);

// EJECUTIVO SOLICITO
$id_usuario = $capturo;
usuarioxid($id_usuario);
$nombreEjec = $nombre;
$id_usuario = '';

// AUTORIZO
$autorizoNombreS = '';
if($autorizadoS == 1){
	$id_usuario = $autorizo;
	usuarioxid($id_usuario);
	$autorizoNombreS = $nombre;
	$id_usuario = '';
}
//if($esreembolso == 1){echo "<h1 style='color:red;'>ES REEMBOLSO</h1>";}


// 2da revisoin contable
$segundaRev = '';
$sql_2da = "SELECT * FROM mttoSolObs WHERE id_mttoSol = $id_mttoSol AND capturo != 95 LIMIT 1 ";
$sql_2daR = mysqli_query($dbd2, $sql_2da);
if(mysqli_affected_rows($dbd2) == 1){
	$segundaRev = '2DA REV';
}

?>


<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 14">
<link rel=File-List href="SolicitudCHQ_archivos/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<style id="SolicitudCHQ_5555_Styles"><!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl645555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl655555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl665555
	{padding:0px;
	mso-ignore:padding;
	color:red;
	font-size:24.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl675555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	background:#D9D9D9;
	mso-pattern:black none;
	white-space:nowrap;}
.xl685555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl695555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl705555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl715555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:12.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\#\,\#\#0";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl725555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\[$-F800\]dddd\\\,\\ mmmm\\ dd\\\,\\ yyyy";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl735555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
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
.xl745555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl755555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Narrow", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl765555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl775555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:14.0pt;
	font-weight:400;
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
.xl785555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
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
.xl795555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Narrow", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl805555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl815555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:13.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\#\,\#\#0";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl825555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:22.0pt;
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
.xl835555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:16.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"\#\,\#\#0";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl845555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"Short Date";
	text-align:center;
	vertical-align:bottom;
	border:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl855555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt hairline windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl865555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Narrow", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl875555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Narrow", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl885555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl895555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:16.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:justify;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	mso-protection:unlocked visible;
	white-space:normal;}
.xl905555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:16.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:justify;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	mso-protection:unlocked visible;
	white-space:normal;}
.xl915555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:20.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:"Arial Narrow", sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl925555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:22.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl935555
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:44.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Arial, sans-serif;
	mso-font-charset:0;
	mso-number-format:"_-\0022$\0022* \#\,\#\#0\.00_-\;\\-\0022$\0022* \#\,\#\#0\.00_-\;_-\0022$\0022* \0022-\0022??_-\;_-\@_-";
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
--></style>
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

<div id="SolicitudCHQ_5555" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=1075 class=xl645555
 style='border-collapse:collapse;table-layout:fixed;width:806pt'>
 <col class=xl645555 width=104 style='mso-width-source:userset;mso-width-alt:
 3803;width:78pt'>
 <col class=xl645555 width=383 style='mso-width-source:userset;mso-width-alt:
 14006;width:287pt'>
 <col class=xl645555 width=104 style='mso-width-source:userset;mso-width-alt:
 3803;width:78pt'>
 <col class=xl645555 width=387 style='mso-width-source:userset;mso-width-alt:
 14153;width:290pt'>
 <col class=xl645555 width=97 style='mso-width-source:userset;mso-width-alt:
 3547;width:73pt'>
 <tr height=19 style='height:14.25pt'>
  <td height=19 width=104 style='height:14.25pt;width:78pt' align=left
  valign=top><!--[if gte vml 1]><v:shapetype id="_x0000_t75" coordsize="21600,21600"
   o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe" filled="f"
   stroked="f">
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
   type="#_x0000_t75" style='position:absolute;margin-left:0;margin-top:0;
   width:150.75pt;height:60.75pt;z-index:1;visibility:visible' o:gfxdata="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
EEpGSUYAAQEBAGAAYAAA/+EAWkV4aWYAAE1NACoAAAAIAAUDAQAFAAAAAQAAAEoDAwABAAAAAQAA
AABREAABAAAAAQEAAABREQAEAAAAAQAADsNREgAEAAAAAQAADsMAAAAAAAGGoAAAsY//2wBDAAIC
AgICAQICAgIDAgIDAwYEAwMDAwcFBQQGCAcJCAgHCAgJCg0LCQoMCggICw8LDA0ODg8OCQsQERAO
EQ0ODg7/2wBDAQIDAwMDAwcEBAcOCQgJDg4ODg4ODg4ODg4ODg4ODg4ODg4ODg4ODg4ODg4ODg4O
Dg4ODg4ODg4ODg4ODg4ODg7/wAARCABRAMkDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAA
AAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEI
I0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlq
c3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW
19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL
/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLR
ChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOE
hYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn
6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD99KKKKACiiigAooooAKKKKACiiigAooooAKKK811/
4maTo+qtZ2du2rTR5EzRyhI1P93dg5Prjgfnj5/OM9ynIMMsRmVZUoN2V7tt9kkm38k7dTsw+FxG
LnyUY8zPSqK+Q/EH7UUml/tw+G/g7p/hWK/a70F77Vrs37CSwm+yyXSQ7dmCBHGhY5/5bDHK4bup
fi5rmcw6dYxr/th3/wDZhXzuf8a5Bw17H+0Jyi60eeCUW24vq1bT0dmfQS4azeEYSnTSU4qau1rF
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
">
   <v:imagedata src="SolicitudCHQ_archivos/SolicitudCHQ_5555_image001.png"
    o:title=""/>
   <x:ClientData ObjectType="Pict">
    <x:SizeWithCells/>
    <x:CF>Bitmap</x:CF>
    <x:AutoPict/>
   </x:ClientData>
  </v:shape><![endif]--><![if !vml]><span style='mso-ignore:vglayout;
  position:absolute;z-index:1;margin-left:0px;margin-top:0px;width:201px;
  height:81px'>

<?php 

$logoActual = 'SolicitudCHQ_archivos/SolicitudCHQ_5555_image002.png';
if($id_contrato == 467 or $id_contrato == 409 or $id_contrato == 493  
or $id_contrato == 475 
or $id_contrato == 494 ){ 
	$logoActual = 'SolicitudCHQ_archivos/forza.png';}


$razonSocialSolicitud = 'JET VAN CAR RENTAL, S.A. DE C.V.';
if($id_contrato == 467 or $id_contrato == 409 or $id_contrato == 493 
or $id_contrato == 475 
or $id_contrato == 494 ){ 
	$razonSocialSolicitud = 'FORZA ARRENDADORA AUTOMOTRIZ, S.A. DE C.V.';}
?>


  <img width=201 height=81
  src="<?php echo $logoActual; ?>" v:shapes="_x0031__x0020_Imagen">
</span><![endif]><span
  style='mso-ignore:vglayout2'>
  <table cellpadding=0 cellspacing=0>
   <tr>
    <td height=19 class=xl645555 width=104 style='height:14.25pt;width:78pt'><a
    name="RANGE!A1:E57"></a></td>
   </tr>
  </table>
  </span></td>
  <td class=xl645555 width=383 style='width:287pt'></td>
  <td class=xl645555 width=104 style='width:78pt'></td>
  <td class=xl645555 width=387 style='width:290pt'></td>
  <td class=xl645555 width=97 style='width:73pt'> <input type="button" name="imprimir" value="Imprimir" onclick="window.print();"> </td>
 </tr>
 <tr height=34 style='height:25.5pt'>
  <td height=34 class=xl645555 style='height:25.5pt'></td>
  <td colspan=4 class=xl915555>
	<?php echo $razonSocialSolicitud; ?>
  
</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555> </td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl795555 width=97 style='width:73pt'>FOLIO SOLICITUD</td>
 </tr>
 <tr height=34 style='height:25.5pt'>
  <td height=34 class=xl645555 style='height:25.5pt'></td>
  <td colspan=3 class=xl915555>SOLICITUD DE CHEQUE</td>
  <td class=xl665555>
  	
<?php echo $id_mttoSol;?>

  </td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl645555 style='height:15.0pt'></td>
  <td class=xl645555></td>
  <td class=xl755555 width=104 style='width:78pt'>FECHA</td>
  <td class=xl725555>
  	
<?php echo $fechaEj;?>

  </td>
  <td class=xl645555><span style='font-size:2em;'><?php echo $segundaRev;?></span></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl675555 style='height:14.25pt'>UNIDAD</td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=37 style='height:27.75pt'>
  <td height=37 class=xl755555 width=104 style='height:27.75pt;width:78pt'>ECONOMICO</td>
  <td class=xl825555 width=383 style='width:287pt'>

<?php echo $Economico;

if($id_cliente == 16){
	ecoClientexid($id_unidad);
	echo "<span style='font-family:Arial Narrow, sans-serif;
	font-size:8.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	'>, ECONOMICO CLIENTE: </span>$EcoCliente";}
?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>MODELO</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo $Modelo;?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl755555 width=104 style='height:15.0pt;width:78pt'>SERIE</td>
  <td class=xl775555 width=383 style='width:287pt'>
  
<?php echo $Serie;?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>COLOR</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo $Color;?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=37 style='height:27.75pt'>
  <td height=37 class=xl755555 width=104 style='height:27.75pt;width:78pt'>TIPO</td>
  <td class=xl775555 width=383 style='width:287pt'>

<?php echo $Vehiculo;?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>PLACAS</td>
  <td class=xl825555 width=387 style='width:290pt'>

<?php echo $Placas;?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=27 style='height:20.25pt'>
  <td height=27 class=xl755555 width=104 style='height:20.25pt;width:78pt'>KILOMETRAJE</td>
  <td class=xl835555>

<?php echo $km;?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>

<?php
placasHist($id_unidad);
if($PlacasH != ''){
echo "PLACAS ANTERIORES";
}
?>
  </td>
  <td class=xl825555>
  
<?php 
if($PlacasH != ''){
echo "<span style='font-size:.6em'>".$PlacasH.'</span>';
}
?>

  </td>
  <td class=xl645555 ></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl755555 width=104 style='height:15.0pt;width:78pt'></td>
  <td class=xl715555></td>
  <td class=xl755555 width=104 style='width:78pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl675555 style='height:15.0pt'>PROYECTO</td>
  <td class=xl715555></td>
  <td class=xl755555 width=104 style='width:78pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl755555 width=104 style='height:14.25pt;width:78pt'>CLIENTE</td>
  <td class=xl815555>

<?php 

$razonSocial 	= substr($razonSocial, 0, 44);

echo  $razonSocial;?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>CONTRATO</td>
  <td class=xl805555>

<?php echo  "id ::: ".$id_alan." ::: ".$numero;?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl755555 width=104 style='height:15.0pt;width:78pt'>RFC CLIENTE</td>
  <td class=xl715555>

<?php echo  "".$rfc;?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>  </td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl655555 width=104 style='height:15.0pt;width:78pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl675555 style='height:14.25pt'>PROVEEDOR</td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=37 style='height:27.75pt'>
  <td height=37 class=xl755555 width=104 style='height:27.75pt;width:78pt'>RAZON
  SOCIAL</td>
  <td colspan=3 class=xl925555>

<?php  if($esreembolso == 1){echo "REEMBOLSO :  $nombreR ";}else{echo "&nbsp". $PrazonSocial;} // PROVEEDOR ?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl755555 width=104 style='height:14.25pt;width:78pt'>RFC</td>
  <td class=xl765555>

<?php  if($esreembolso == 1){echo " &nbsp; Facturado por : $Prfc :::  $PrazonSocial ";}else{echo "&nbsp". $Prfc;} // PROVEEDOR ?>

  </td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=74 style='height:55.5pt'>
  <td height=74 class=xl755555 width=104 style='height:55.5pt;width:78pt'>IMPORTE</td>
  <td colspan=2 class=xl935555>
 
$ <?php echo number_format( $importe, 2);?>

  </td>
  <td class=xl885555 width=387 style='width:290pt'>

 <?php 

//$importe = $importe + 2274;

 echo strtoupper(num2letras($importe, false, true));

 ?>

  </td>
  <td class=xl865555 width=97 style='width:73pt'>IMPORTE CON LETRA</td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl705555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=105 style='mso-height-source:userset;height:78.75pt'>
  <td height=105 class=xl755555 width=104 style='height:78.75pt;width:78pt'>CONCEPTO</td>
  <td colspan=3 class=xl895555 width=874 style='width:655pt'>

<?php echo "&nbsp". $concepto;?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=104 style='mso-height-source:userset;height:78.0pt'>
  <td height=104 class=xl755555 width=104 style='height:78.0pt;width:78pt'>OBSERVACIONES</td>
  <td colspan=3 class=xl905555 width=874 style='width:655pt'>

<?php echo "&nbsp". $obs;?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl675555 style='height:15.0pt'>PAGO</td>
  <td class=xl645555></td>
  <td class=xl755555 width=104 style='width:78pt'>NOMBRE</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo "&nbsp". $nombreR; // REEMBOLSO ?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl645555 style='height:15.0pt'></td>
  <td class=xl775555 width=383 style='width:287pt'>



<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCclabe;} // PROVEEDOR ?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>CLABE</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo "&nbsp". $clabeR; // REEMBOLSO ?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl645555 style='height:15.0pt'></td>
  <td class=xl775555 width=383 style='width:287pt'>

<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCcuenta;} // PROVEEDOR ?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>CUENTA</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo "&nbsp". $cuentaR; // REEMBOLSO ?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl645555 style='height:15.0pt'></td>
  <td class=xl775555 width=383 style='width:287pt'>

<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCsucursal;} // PROVEEDOR ?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>SUC</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo "&nbsp". $sucR; // REEMBOLSO ?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl645555 style='height:15.0pt'></td>
  <td class=xl775555 width=383 style='width:287pt'>

<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCbanco;} // PROVEEDOR ?>

  </td>
  <td class=xl755555 width=104 style='width:78pt'>BANCO</td>
  <td class=xl775555 width=387 style='width:290pt'>

<?php echo "&nbsp". $bancoR; // REEMBOLSO ?>

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl675555 style='height:14.25pt'>FIRMAS</td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl695555 style='height:14.25pt'>SOLICITA</td>
  <td class=xl785555>

<?php echo "&nbsp". $nombreEjec; ?>

  </td>
  <td class=xl695555>AUTORIZA</td>
  <td class=xl785555>

 <?php echo @$autorizoNombreG; // VOBO autoriza GERENTE ?> 

  </td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl695555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl695555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl695555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl695555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl695555 style='height:14.25pt'>VO.BO.</td>
  <td class=xl785555>

 <?php 

 $verfechaAu = '';
 if($autorizadoS == 1){$verfechaAu = $fechaAu;}

 echo $autorizoNombreS." / ".$verfechaAu;  // VOBO autoriza SUPERVISOR ?> 

  </td>
  <td class=xl695555>RECIBIO</td>
  <td class=xl785555>

 <?php echo @$recibeNombre; // RECIBE CONTABILIDAD ?> 

 </td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl685555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl645555 style='height:14.25pt'></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl675555 style='height:14.25pt'>HISTORIAL</td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>
 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl875555 colspan=2 style='height:14.25pt'>ANTERIORES 
  SERVICIOS REALIZADOS (max 10) </td>
  <td class=xl645555></td>
  <td class=xl645555></td>
  <td class=xl645555></td>
 </tr>


 <tr height=19 style='height:14.25pt'>
  <td height=19 class=xl735555 width=104 style='height:14.25pt;width:78pt'>FECHA</td>
  <td class=xl735555 width=383 style='width:287pt'>CONCEPTO</td>
  <td class=xl735555 width=104 style='width:78pt'>IMPORTE</td>
  <td class=xl735555 width=387 style='width:290pt'>PROVEEDOR</td>
  <td class=xl735555 width=97 style='width:73pt'>KM</td>
 </tr>




<?php

$sql_historial 	= "	SELECT * FROM mttoSol 
					WHERE 	id_unidad = '$id_unidad' 
					AND 	id_mttoSol < '$id_mttoSol' 
					AND 	cancelado = 0 
					ORDER BY id_mttoSol DESC 
					LIMIT 10 ";

$historial_R 	= mysqli_query($dbd2, $sql_historial);

while($row = mysqli_fetch_assoc($historial_R)){
	$id_mttoSolH= $row['id_mttoSol'];
	$fechaEjH 	= $row['fechaEj'];
	$conceptoH 	= substr($row['concepto'], 0, 48);
	$importeH 	= $row['importe'];
	$provH 		= $row['id_prov'];
	$kmH 		= $row['km']; 

proveedorxid($provH);

echo "

<tr height=19 style='height:14.25pt'>
  <td height=19 class=xl845555 style='height:14.25pt'>
  $fechaEjH
  </td>
  <td class=xl745555 style='border-left:none'>
  ::: FOLIO $id_mttoSolH ::: $conceptoH
  </td>
  <td class=xl855555 style='border-left:none'>
 $importeH
  </td>
  <td class=xl745555 style='border-left:none'>
 $PrazonSocial
  </td>
  <td class=xl855555 style='border-left:none'>
 $kmH
  </td>
 </tr>

";


}


?>


 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=104 style='width:78pt'></td>
  <td width=383 style='width:287pt'></td>
  <td width=104 style='width:78pt'></td>
  <td width=387 style='width:290pt'></td>
  <td width=97 style='width:73pt'></td>
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

