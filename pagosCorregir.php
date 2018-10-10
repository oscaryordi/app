<?php
session_start();
include("seguridad.php");
include("caducidad.php");
include_once("base.inc.php");

if(isset($_POST['send']))
{
	$obs 		= mysqli_real_escape_string($dbd2, $_POST['obs']);
	$id_mttoSol = mysqli_real_escape_string($dbd2, $_POST['id_mttoSol']);

	//echo "$obs $id_mttoSol";

	//$sql = "insert into tasks (name) values ('$name')";
	$sql = "UPDATE mttoSol SET autorizadoS = 3, programadoPago = 0 WHERE id_mttoSol = $id_mttoSol LIMIT 1 " ;
	//$val = $db->query($sql);
	$sql_R = mysqli_query($dbd2, $sql);

	if( $obs != '' AND strlen($obs)> 0 ){ // INSERTAR OBSERVACIONES

		date_default_timezone_set('America/Mexico_city');
		$fechaR 	= date('Y-m-d h:i:s');
		//echo "$fechaR";

		$capturo 	= $_SESSION['id_usuario'];
	
		$sql_Mobs = "INSERT INTO mttoSolObs (`id_mttoSolOb`, `id_mttoSol`, `capturo`, `obsA`, `fechareg`, statusAu)
					VALUES 
					(NULL, '$id_mttoSol', '$capturo', '$obs', '$fechaR', '3')
					";
		$MobsR = mysqli_query($dbd2, $sql_Mobs);
	}

	if($MobsR AND $sql_R)
		{
			header("location: pagosindex.php?msg=1&id_mttoSol=".$id_mttoSol);
		}
	else
		{
			echo "error".mysqli_errno($dbd2).mysqli_error($dbd2).", Usuario: imprima o copie la pantalla para reportar el error.";
		}
/**/}
?>