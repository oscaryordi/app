<?php
session_start();
//include("seguridad.php");
//include("caducidad.php");
if(isset($_GET["semilla"])){
		if($_GET["semilla"] == "1616"){
		$uuid 	="".$_GET["uuid"];
		$bancoe ="".$_GET["bancoe"];
			if($uuid!="" && $bancoe!="") {
				if($bancoe=="1") { 
					//Es scotia
				 }
				if($bancoe=="2") { 
					//Es santander
				 }
			// FECHA Y HORA DE CIUDAD DE MEXICO
			date_default_timezone_set('America/Mexico_city');
			$fechaPg 	= date("Y-m-d H:i:s");
			include_once ("base.inc.php");
			$id_mttoSol	= mysqli_real_escape_string($dbd2, $uuid);
			$pagoset 	= explode('|', $uuid);
			 // INICIO DE ACTUALIZACION DE SET
			 foreach($pagoset as $ides){
					 if($ides!="") {
								$sql_pagoInfo 	= " UPDATE mttoSol SET pagadoInfo = 1, programadoPago = 1, bancoE= ".$bancoe."   WHERE id_mttoSol = '$ides'  " ;
								$sql_pagoInfo_R = mysqli_query($dbd2, $sql_pagoInfo); 
								
									if(mysqli_affected_rows($dbd2)>0)
									{
										echo $ides.' OK<br>'; 
										$sql_CC = "	INSERT INTO controlcambios 
													(id_cambios, capturo, updatequery, arrayviejo) 
													VALUES 
													(NULL, '52', 'pago realizado', '$ides') ";
										$sql_CC_R = mysqli_query($dbd2, $sql_CC);
									}
									
									/*
										LOS PAGOS SE DIFERENCIAN USANDO UN VALOR ENTERO
										1 = SCOTIA BANK
										2 = SANTANDER
										CON ESTE VALOR SE DEFINE QUE URL DE PREFIJO SE USARIA:
										SCOTIA:    http://jetvan.ddns.net:8021/pdfpagos/
										SANTANDEr: http://jetvan.ddns.net:8021/santander/
									*/

										
								/*	VERIFICACION DE ERRORES EN CONSULTAS
									else
									{
									echo mysqli_error($dbd2);
									echo mysqli_errno($dbd2);
									//echo "<a href='index.php'> QUIZA ALGO FALLO </a>";
									}
								*/	
					 }
				}
			}
		}
}
