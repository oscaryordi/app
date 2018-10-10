<?php
date_default_timezone_set('America/Mexico_City');
$srv = "jetvan.com.mx"; 
$usr = "check_jetvan"; 
$pss = "J3tv4nroot2017";
$dbb = "check_jetvan";
$id_cliente="1";

$conexion = mysqli_connect("".$srv, "".$usr, "".$pss) or die("1.-Error en connect." .  mysqli_error($conexion));

mysqli_query($conexion,"SET NAMES 'utf8'") or die("2.-Error en UTF-8." .  mysqli_error($conexion));
mysqli_select_db($conexion,$dbb) or die("3.-Error en SELECCIONAR DB." .  mysqli_error($conexion));

$quse 	="SELECT * FROM clientes WHERE id=".$id_cliente." LIMIT 1;";
$resuse = mysqli_query($conexion,$quse) or die('3a.-' .  mysqli_error($conexion));
while($row=mysqli_fetch_array($resuse))
{
$c1=$row["nom"];$c2=$row["dir"];$c3=$row["col"];$c4=$row["mun"];$c5=$row["cd"];$c6=$row["cp"];$c7=$row["rfc"];$c8=$row["cont"];
}

$c8 = $id_contrato."|a".$id_alan;

$fech 			= date('d/m/Y');
$hora 			= "".date("H").":".date("i");
$cuenta 		= 0;
$cuentaplaca 	= 0;
$cuentaot 		= 0;
$region_division ="";

$placa  		= $Placas;
$economico 		= $Economico;
$unidad 		= $Marca." ".$Vehiculo; // EJEMPLO: NISSAN TIIDA MARCA Y SUBMARCA deberan de ser CONCATENADAS $Vehiculo $Marca
$modelo 		= "".$Modelo;
$serie 			= $Serie;

$foliosolicitud = $id_mttoSol; // $mttoSol
$uuid 			= "";
$uuid 			= $foliosolicitud;

$owner_order 	= "";
$solicitud 		= $concepto.$obs; ////igualar al valor posteado desde JETVAN.MX

//$ownerasignado=explode(" ",$solicitud); //PERSONAL DE CLAUDIA USARA LA PRIMERA PALABRA DE LA DESCRIPCION DEL SERVICIO COMO INDICATIVO DEL NOMBRE DEL DUEÑO DE LA OT
$owner_order	="";//.$ownerasignado[0];
//datos extraidos de JETVAN.MX
$fecha_orden 	= $fech; 
$hora_orden 	= $hora;
$km 			= $km;
$region_division= "".$owner_order;

// BUSCAR $id_unidad;

// DETECTAR UNIDAD POR SERIE // STATUS ES SERIE
$quse 			= "SELECT COUNT(status) siExiste FROM unidades WHERE status = '".$serie."';";
$resuse 		= mysqli_query($conexion,$quse) or die('3a.-' .  mysqli_error($conexion));
$row1 			= mysqli_fetch_array($resuse);
$siExiste 		= $row1["siExiste"];

if($siExiste == 1){ 
/**/
	$qusi2="UPDATE unidades SET 
			placa 	= '".$placa."', 
			eco 	= '".$economico."', 
			unidad 	= '".$unidad."' 
			WHERE 
			status 	= '".$serie."';";
	echo $qusi2;
	$resusi=mysqli_query($conexion,$qusi2) or die('4.-' .  mysqli_error($conexion));	
	$qusi2="INSERT INTO bitacos 
			(fecha,hora,orden,autor,ope,numero) 
			VALUES 
			('".$fech."','".$hora."','ACTUALIZANDO VEHICULO','jetvan.mx','jetvan.mx','".$serie."')";
	$resusi=mysqli_query($conexion,$qusi2) or die('5.-' .  mysqli_error($conexion));

	}
else{
	$qusi2=" INSERT INTO unidades  
			(id,placa,eco,unidad,unidades.mod,status)  
			VALUES  
			(NULL,'$placa','$economico','$unidad','$modelo','$serie')";
	//echo $qusi2;		
	$resusi=mysqli_query($conexion,$qusi2) or die('6.-' .  mysqli_error($conexion));
	$qusi2="INSERT INTO bitacos (fecha,hora,orden,autor,ope,numero) VALUES ('".$fech."','".$hora."','CREANDO VEHICULO','jetvan.mx','jetvan.mx','".$serie."')";
	$resusi=mysqli_query($conexion,$qusi2) or die('7.-' .  mysqli_error($conexion));
	}


$quse="SELECT ide FROM ordenes WHERE ide=".$uuid.";";
$resuse=mysqli_query($conexion,$quse) or die('8.-' .  mysqli_error($conexion));
while($row1=mysqli_fetch_array($resuse))
{
	if($row1["status"]!=""){
						$cuentaot=$cuentaot+1;
	}
}

if($cuentaot>0){
	$qusi2="INSERT INTO bitacos (fecha,hora,orden,autor,ope,numero)
	VALUES ('".$fech."','".$hora."','DUPLICIDAD DE OT: ".$uuid."','jetvan.mx','jetvan.mx','".$uuid."')";
	$resusi=mysqli_query($conexion,$qusi2) or die('8.-' .  mysqli_error($conexion));
}
else {
///GENERACIÓN DE LA ORDEN OT
$qusi2="INSERT INTO ordenes 
	(ide,id,fact,surt,ticket, solic,
	c1,c2,c3,c4,c5,c6,c7,c8,
	cont,brig,vobo,vobop,fecha,hora,
	autor,ordenes.desc,folioc,stats,hta, 
	u1,u2, u3, u4 ) 
	VALUES 
	(".$uuid.",'".$uuid."','".$uuid."','".$uuid."','".$uuid."', '".$uuid."',
	'".$c1."','".$c2."','".$c3."','".$c4."','".$c5."','".$c6."','".$c7."','".$c8."',
	'".$c8."','".$region_division."','','','".$fecha_orden."','".$hora_orden."',
	'".$placa."','".$solicitud."','".$km."','TICKET ABIERTO','".$hora."',
	 '$c1' ,'$serie', '$unidad', '$modelo'  );";
	$resusi=mysqli_query($conexion,$qusi2); // or die('6.-' .  mysqli_error($conexion));


$quis2 = str_replace("'", "", $qusi2);
$quis2 = mysqli_real_escape_string($conexion, $qusi2);


	$qusi2="INSERT INTO bitacos (fecha,hora,orden,autor,ope,numero)
	VALUES ('".$fech."','".$hora."','CREANDO OT: ".$quis2."','jetvan.mx','jetvan.mx','".$uuid."')";
	$resusi=mysqli_query($conexion,$qusi2); // or die('7.-' .  mysqli_error($conexion));
}

?>