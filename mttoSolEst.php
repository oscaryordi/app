<?php
include("1header.php");

if($_SESSION["mttoSolSup"] > 1){ // PRIVILEGIO SUPERVISOR
	include ("nav_mtto.php"); 
	include ("nav_mtto_est.php"); 
}
include("1footer.php");?>