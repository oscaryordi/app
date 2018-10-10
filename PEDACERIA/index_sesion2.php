<?php
//error_reporting(0);
/* iniciar la sesión */
	ini_set("session.cookie_lifetime",7200);
	ini_set("session.gc_maxlifetime",7200);
	session_start();
	$_SESSION['tiempo']=time();
	include("conecta.inc.php");	
	$dbd=conecta();	
	
	
	//$login = mysql_real_escape_string($_POST['usuario'],$dbd);
	$login = $_POST['usuario'];
	//$pass = mysql_real_escape_string($_POST['clave'],$dbd);
	$pass = $_POST['clave'];


	$query = "SELECT * FROM `usuarios` WHERE usuario='$login'";
	$result=@mysqli_query($dbd,$query);
	$row_cnt=mysqli_num_rows($result);
	if($row_cnt==0)
		{
			/*echo "No existe el login introducido";*/
			header("Location: login.php?errorusuario=si");
		}
	else
	{
		$array=mysqli_fetch_array($result);		
		if($array["clave"]==$pass && $array["suspendido"]==0)
			{
				$_SESSION['autentificado']="1";
				$_SESSION['usuario']=$_POST['usuario'];
				
				$_SESSION["login"]=$login;
				$_SESSION["nombre"]=$array["nombre"];
				
				//privilegios
				$_SESSION["datos"]		=$array["datos"];
				$_SESSION["placas"]		=$array["placas"];
				$_SESSION["movimientos"]=$array["movimientos"];
				$_SESSION["mttos"]		=$array["mttos"];
				$_SESSION["mttoSol"]	=$array["mttoSol"];
				$_SESSION["mttoSolAut"]	=$array["mttoSolAut"];
				$_SESSION["documentos"]	=$array["documentos"];
				$_SESSION["facturas"]	=$array["facturas"];
				$_SESSION["id_usuario"]	=$array["id_usuario"];
				$_SESSION["gerencia"]	=$array["gerencia"]; 			
				$_SESSION["sustituto"]	=$array["sustituto"];
				$_SESSION["direccion"]	=$array["direccion"];
				$_SESSION["seminuevos"]	=$array["seminuevos"];
				$_SESSION["ejecutivo"]	=$array["ejecutivo"];
				$_SESSION["compra"]		=$array["compra"];
				$_SESSION["gps"]		=$array["gps"];
				$_SESSION["clientes"]	=$array["clientes"];
				$_SESSION["asigna"]		=$array["asigna"]; // UNIDADES
				$_SESSION["filtroFlotilla"]	=$array["filtroFlotilla"];
				$_SESSION["asigcto"]	=$array["asigcto"]; // EJECUTIVOS
				$_SESSION["oficina"]	=$array["oficina"];

				$_SESSION["factura"]	=$array["factura"];
				$_SESSION["poliza"]		=$array["poliza"];
				$_SESSION["tarjeta"]	=$array["tarjeta"];
				$_SESSION["verifica"]	=$array["verifica"];
				$_SESSION["tenencia"]	=$array["tenencia"];
				$_SESSION["docotro"]	=$array["docotro"];

				$_SESSION["movForaneo"]	=$array["movForaneo"];
				$_SESSION["superLog"]	=$array["superLog"];
				$_SESSION["proveedores"]	=$array["proveedores"];					
							
				header("Location: index.php");
			}
		else
			{
				/*echo "Password incorrecto!";*/
				header("Location: login.php?errorusuario=si");				
			}
	}
?>