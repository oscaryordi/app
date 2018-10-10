<?php
if($_SESSION['autentificado']!="1")
{
	header("Location: ../login.php");
	exit();
}
?>