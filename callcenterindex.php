<?php
include("1header.php");

// APERTURA PRIVILEGIOS
if($_SESSION["callcenterH"] > 0 || $_SESSION["callcenterV"] > 0)
{ 
include ("nav_callcenter.php"); 
















}// CIERRE PRIVILEGIOS
include("1footer.php");
?>