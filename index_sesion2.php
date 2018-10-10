<?php
//error_reporting(0);
/* iniciar la sesión */
	ini_set("session.cookie_lifetime",7200);
	ini_set("session.gc_maxlifetime",7200);
	session_start();
	$_SESSION['tiempo']=time();

	include_once("base.inc.php");
	$dbd	= conectad();


	$login 	= mysqli_real_escape_string($dbd,$_POST['usuario']);
	$pass 	= mysqli_real_escape_string($dbd,$_POST['clave']);

	$query 	= "SELECT * FROM `usuarios` WHERE usuario='$login'";
	$result	=@mysqli_query($dbd,$query);
	$row_cnt=mysqli_num_rows($result);
	if($row_cnt==0)
	{
		/*echo "No existe el login introducido";*/
		header("Location: ../login.php?errorusuario=si");
	}
	else
	{
		$array=mysqli_fetch_array($result);
		if($array["clave"]==$pass && $array["suspendido"]==0)
			{
				$_SESSION['autentificado']="1";
				$_SESSION['usuario'] 	=$_POST['usuario'];

				$_SESSION["login"] 		=$login;
				$_SESSION["nombre"] 	=$array["nombre"];

				//privilegios
				$_SESSION["consultaB"] 	=$array["consultaB"];
				$_SESSION["datos"]		=$array["datos"];
				$_SESSION["verMotor"]	=$array["verMotor"];
				$_SESSION["placas"]		=$array["placas"];
				$_SESSION["movimientos"]=$array["movimientos"];
				$_SESSION["mttos"]		=$array["mttos"];
				$_SESSION["mttoSol"]	=$array["mttoSol"];
				$_SESSION["mttoSolAut"]	=$array["mttoSolAut"];
				$_SESSION["mttoSolDep"]	=$array["mttoSolDep"];
				$_SESSION["mttoSolSup"]	=$array["mttoSolSup"];
				$_SESSION["mttoSolPag"]	=$array["mttoSolPag"];
				$_SESSION["supPago"]	=$array["supPago"];

				$_SESSION["solAtn"]		=$array["solAtn"];

				$_SESSION["kmUsr"]		=$array["kmUsr"];
				$_SESSION["kmSup"]		=$array["kmSup"];

				$_SESSION["documentos"]	=$array["documentos"];
				$_SESSION["navEcos"]	=$array["navEcos"];
				$_SESSION["ecoCliente"]	=$array["ecoCliente"];
				$_SESSION["fotoUnidad"]	=$array["fotoUnidad"];
				$_SESSION["facturas"]	=$array["facturas"];
				$_SESSION["id_usuario"]	=$array["id_usuario"];
				$_SESSION["gerencia"]	=$array["gerencia"];
				$_SESSION["sustituto"]	=$array["sustituto"];
				$_SESSION["direccion"]	=$array["direccion"];
				$_SESSION["seminuevos"]	=$array["seminuevos"];
				$_SESSION["ejecutivo"]	=$array["ejecutivo"];
				$_SESSION["compra"]		=$array["compra"];
				$_SESSION["gps"]		=$array["gps"];
				$_SESSION["gpsV"]		=$array["gpsV"];
				$_SESSION["gpsA"]		=$array["gpsA"];
				$_SESSION["clientes"]	=$array["clientes"];
				$_SESSION["estimacionH"]	=$array["estimacionH"];
				$_SESSION["estimacionV"]	=$array["estimacionV"];
				$_SESSION["facturacionV"]	=$array["facturacionV"];

				$_SESSION["asigna"]		=$array["asigna"];// UNIDADES
				$_SESSION["asignaPtdAA"]=$array["asignaPtdAA"];// PARTIDAS Y AADVA
				$_SESSION["filtroFlotilla"]	=$array["filtroFlotilla"];
				$_SESSION["verPartidas"]=$array["verPartidas"];
				$_SESSION["verAAdvas"]	=$array["verAAdvas"];
				$_SESSION["asigcto"]	=$array["asigcto"];// EJECUTIVOS
				$_SESSION["asigEctoSup"]=$array["asigEctoSup"];// EJECUTIVOS
				$_SESSION["asigEVer"]	=$array["asigEVer"];// EJECUTIVOS asigEVer
				$_SESSION["oficina"]	=$array["oficina"];

				$_SESSION["rh"]			=$array["rh"];

				$_SESSION["factura"]	=$array["factura"];
				$_SESSION["poliza"]		=$array["poliza"];
				$_SESSION["tarjeta"]	=$array["tarjeta"];
				$_SESSION["verifica"]	=$array["verifica"];
				$_SESSION["tenencia"]	=$array["tenencia"];
				$_SESSION["docotro"]	=$array["docotro"];
				$_SESSION["inventarioE"]=$array["inventarioE"];
				$_SESSION["infraccionV"]=$array["infraccionV"];
				$_SESSION["infraccionH"]=$array["infraccionH"];

				$_SESSION["externo"]	=$array["externo"];

				$_SESSION["movForaneo"]	=$array["movForaneo"];
				$_SESSION["superLog"]	=$array["superLog"];
				$_SESSION["proveedores"]	=$array["proveedores"];

				$_SESSION["siniestro"]		=$array["siniestro"];
				$_SESSION["siniestroSup"]	=$array["siniestroSup"];

				$_SESSION["almacen"]	=$array["almacen"];

				header("Location: index.php");
			}
		else
			{
				/*echo "Password incorrecto!";*/
				header("Location: ../login.php?errorusuario=si");
			}
	}
?>