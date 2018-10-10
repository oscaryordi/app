<?php
define('DB_SERVER', 			'50.63.236.78');
//define('DB_SERVER', 			'https://p3nlmysqladm001.secureserver.net/grid50/3665/index.php');
define('DB_SERVER_USERNAME', 	'jetvantlc');
define('DB_SERVER_PASSWORD', 	'Jetvan12#');
define('DB_DATABASE', 			'jetvantlc');
 
function conecta() // CASI TODO EL CODIGO
{
	@$conectar = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
	if(!$conectar)
		die("<h3>*** ERROR al conectar ***</h3>". mysql_errno());
	if(!mysql_select_db(DB_DATABASE, $conectar))
		die("<h3>ERROR al seleccionar</h3>".mysql_errno());
	return $conectar;
}

@$dbd2 		= mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE); 
// QUERYS AJAX
@$conexion4 	= new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE); 
// BUSQUEDA BLOQUE

function conectad() // PARA EL LOGIN
{
	$dbd = @mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
	if(!$dbd)
		die("<h3>*** ERROR al conectar (i)***</h3>". mysqli_connect_errno());
	if(!mysqli_select_db( $dbd, DB_DATABASE))
		die("<h3>ERROR al seleccionar (i)</h3>".mysqli_errno());
	return $dbd;
}
// https://p3nlmysqladm001.secureserver.net/grid50/3665/index.php
// https://p3nlmysqladm001.secureserver.net/grid50/3665/index.php
//define('DB_SERVER', 			'50.63.236.78');
?>