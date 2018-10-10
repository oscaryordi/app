<?php
include("1header.php");

if($_SESSION["mttos"] > 0 || $_SESSION["mttoSolAut"] > 0 ){ // VISTA A EJECUTIVOS
	include ("nav_mtto.php");
	$id_usuario = $_SESSION["id_usuario"]; 
?>
<div style="padding:5px;">
	<p> BUSCAR SOLICITUD
	<form action='' method='post'>
		<input 	type='text' name='id_mttoSol' 
				placeholder='Indique Folio de Solicitud' 
				title='Indique Folio de Solicitud' >
		<input type='submit' name='buscar' value='Buscar'  >
	</form>
	</p>
</div>
<?php


if( isset($_POST['id_mttoSol']) &&  $_POST['id_mttoSol'] != '')
	{
		$id_mttoSol = mysqli_real_escape_string( $dbd2, $_POST['id_mttoSol']);
		echo $id_mttoSol;

		$pagina 	 = '';
		$sql_mttoSol = '';

		$sql_mttoSol = 	  ' SELECT * '
			        	. ' FROM mttoSol '
			        	. "  WHERE id_mttoSol = '$id_mttoSol'   " ;

		$sql_mttoSol_RR = mysqli_query($dbd2, $sql_mttoSol);
		$row			= mysqli_fetch_array($sql_mttoSol_RR);
		$id_contrato 	= $row['id_contrato'];
		$capturo 		= $row['capturo'];

		$id_usuario 	= $_SESSION["id_usuario"];
		contratosDelEjecutivo($id_usuario);
		$leCorresponde 	= in_array($id_contrato, $contratosArray);
		// echo "LeCorresponde". var_dump($leCorresponde);

		if($_SESSION["mttoSol"] > 2 ) // SI CONSULTA SUPERVISOR
		{
			include('mttoSolResultSet.php');
		} 
		elseif ($leCorresponde == 1 ) { // SI ES DE SUS CONTRATOS
			include('mttoSolResultSet.php');
		}
		elseif ( $capturo ==  $id_usuario ) { // SI LA ELABORO EL
			include('mttoSolResultSet.php');
		}
		// include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
	}
} // FIN PRIVILEGIO VISTA EJECUTIVOS


if($_SESSION["filtroFlotilla"] < 2)
{ // supervisores contratos y jetvan
	##### // INICIA DEFINIR LOS CONTRATOS DEL EJECUTIVO
	contratosDelEjecutivo($id_usuario);
	//print_r($contratosArray) ;
	//echo "<br/>";
	//var_dump($contratosArray) ;
	if($contratosArray) // OBTIENE UN ARRAY PARA HACER UN SELECT QUE INCLUYA LOS CONTRATOS DEL EJECUTIVO
	{
		$todosMisContratos='';
		$cuantos 	= sizeof($contratosArray);
		$contador 	= 1;
		foreach( $contratosArray as $key => $value)
		{
			$todosMisContratos.=" id_contrato = $value ";
			if($cuantos > $contador)
			{
				$todosMisContratos.=" OR ";
			}
			$contador++;
		}
		//echo "<br>";
		//echo $todosMisContratos; // PARA VER CONSTRUCCION DEL WHERE
	}else
	{
		echo "NO TIENE CONTRATOS ASIGNADOS";
	}
	##### // TERMINA DEFINIR LOS CONTRATOS DEL EJECUTIVO

	// INICIA OBTENER TOTALES DE SOLICITUDES DE EXTERNOS
	$sql_tableroMttoSol = "	SELECT count( autorizadoS ) AS solsCuenta, autorizadoS AS status 
							FROM `mttoSol` 
							WHERE externo = 1 
							AND   ($todosMisContratos) 
							GROUP BY autorizadoS ";
	$sql_tableroR 		= mysqli_query($dbd2, $sql_tableroMttoSol);
	// TERMINA OBTENER TOTALES DE SOLICITUDES DE EXTERNOS
	if(@mysqli_num_rows($sql_tableroR) > 0 )
	{
		echo "<br><br><br>";
		echo "<h3>SERVICIOS SOLICITADOS POR PERSONAL EXTERNO</h3>";
		echo "<table id='ResTabla' >";
		while($row = mysqli_fetch_assoc($sql_tableroR))
		{
			$status 		= $row['status'];
			$statusTxt = '';
			switch($status)
			{
				case "0":
					$statusTxt  .= 'AUT PENDIENTE'; // USUARIO
					break;
				case "1":
					$statusTxt  .= 'AUTORIZADO'; // USUARIO
					break;
				case "2":
					$statusTxt  .= 'CORREGIR'; // USUARIO
					break;
				case "3":
					$statusTxt  .= 'CORREGIR'; // USUARIO
					break;
				case "4":
					$statusTxt  .= 'RECHAZADO'; // USUARIO
					break;
				case "5":
					$statusTxt  .= 'CANCELADO'; // USUARIO
					break;
				default:
					break;
			}
			$solsCuenta 	= $row['solsCuenta'];
			echo "<tr><th>$statusTxt</th><td>
						<a href='mttoSolExt.php?id_usuario=$id_usuario' >
						$solsCuenta
						</a>
					  </td>
				  </tr>";
		}
		echo "</table>";
	}
}


include("1footer.php");?>