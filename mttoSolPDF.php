<?php
ob_start();

//$id_mttoSol = 15957;
$id_mttoSol = $_GET['id_mttoSol']; // NO MOVER

include("mttoSolPDFformato.php");

//require_once 'dompdf/autoload.inc.php';//ruta local
require_once 'Dompdf/autoload.inc.php';//ruta jetvan.mx

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml(ob_get_clean());

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$pdf 		= $dompdf->output(); // nuevo
$filename 	= 'nombre.pdf';

// Output the generated PDF to Browser
$dompdf->stream();