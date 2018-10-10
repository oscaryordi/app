<?


/*
$host = "50.63.236.78";
$usuario = "jetvantlc";
$password = "Jetvan12#";
@$conectar = mysql_connect ($host, $usuario, $password); // hacer validacion de error de conexion ...
*/


function conecta()
{
	$conectar = mysql_connect("50.63.236.78", "jetvantlc", "Jetvan12#");
	if(!$conectar)
		die("<h3>*** Tu internet es lento. ERROR al conectar ***</h3>". mysql_connect_errno());
		
	if(!mysql_select_db("jetvantlc", $conectar))
		die("<h3>ERROR al seleccionar</h3>".mysql_errno());
	return $conectar;
}

















// https://p3nlmysqladm001.secureserver.net/grid50/3665/index.php
?>