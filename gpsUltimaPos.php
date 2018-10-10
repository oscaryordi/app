<?php 
session_start();
include("seguridad.php");
include("caducidad.php");
include_once ("base.inc.php"); 
include_once ("funcion.php");

if($_SESSION["gps"] > 1 or $_SESSION["gpsV"] > 0){
$gpsImeiActual = mysqli_real_escape_string($dbd2, $_POST['gpsImeiActual']);
header("Location: https://track.jetvan.com.mx/last/vars.aspx?uuid=".$gpsImeiActual."");

//echo "<a href='http://187.188.203.80:8080/last/conn.aspx?uuid=$gpsImeiActual' target='_blank' >";
// http://187.188.203.80:8080/last/vars.aspx?uuid=864495030131053 // viejo
// http://187.188.203.80:8080/last/conn.aspx?uuid= // actual
}
?>