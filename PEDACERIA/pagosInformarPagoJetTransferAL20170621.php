<?php
session_start();
//include("seguridad.php");
//include("caducidad.php");
if(isset($_GET["semilla"])){
		if($_GET["semilla"] == "1616"){
		$uuid="".$_GET["uuid"];
			if($uuid!="") {
			// FECHA Y HORA DE CIUDAD DE MEXICO
			date_default_timezone_set('America/Mexico_city');
			$fechaPg = date("Y-m-d H:i:s");
			include_once ("base.inc.php");
			$id_mttoSol	= mysql_real_escape_string($uuid);
			//$pagina		= mysql_real_escape_string($_GET['pagina']);
			//$capturo	= $_SESSION["id_usuario"];
		//echo"OK ".$uuid ;
		$pagoset = explode('|', $uuid);
			 // INICIO DE ACTUALIZACION DE SET
			 foreach($pagoset as $ides){
					 if($ides!="") {
								$sql_pagoInfo 	= " UPDATE mttoSol SET pagadoInfo = 1  WHERE id_mttoSol = '$ides'  " ;
								$sql_pagoInfo_R = mysql_query($sql_pagoInfo); 
								
									if(mysql_affected_rows()>0)
									{
										echo $ides.' OK<br>'; 
				$sql_CC = "INSERT INTO controlcambios (id_cambios, capturo, updatequery, arrayviejo) VALUES (NULL, '52', 'pago realizado', '$ides') ";
				$sql_CC_R = mysql_query($sql_CC);
									}
									
									
								/*	VERIFICACION DE ERRORES EN CONSULTAS
									else
									{
									echo mysql_error();
									echo mysql_errno();
									//echo "<a href='index.php'> QUIZA ALGO FALLO </a>";
									}
								*/	
					 }
 				}
			}
		}
}
