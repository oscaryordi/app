<?php
function conecta()
{
	$dbd = @mysqli_connect("50.63.236.78", "jetvantlc", "Jetvan12#");
	if(!$dbd)
		die("<h3>*** Tu internet es lento. ERROR al conectar ***</h3>". mysqli_connect_errno());
		
	if(!mysqli_select_db( $dbd,"jetvantlc"))
		die("<h3>ERROR al seleccionar</h3>".mysqli_errno());
	return $dbd;
}
// // https://p3nlmysqladm001.secureserver.net/grid50/3665/index.php
// BASE DEL jetvantlc
?>