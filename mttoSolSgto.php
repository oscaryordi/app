<?php
include '1header.php';

// PONER FORMATO DE SEGUIMIENTO A SERVICIO


$id_mttoSol 	= $_GET['id_mttoSol'];
$id_mttoSolAut 	= $_GET['id_mttoSol'];
$paginaR 		= $_GET['pagina'];   
// PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE 
// paginaR pues en alguna parte se pierde el valor de la variable pagina
echo $paginaR;
//echo "$id_mttoSol ";

########## ########## ########## ########## ########## 
$sql_mttoSol 	= "SELECT * FROM `mttoSol` WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
$sql_mttoSol_M 	= mysqli_fetch_array($sql_mttoSol_R);

$id_unidad 		=	$sql_mttoSol_M['id_unidad'];
$id_cliente 	=	$sql_mttoSol_M['id_cliente'];
$id_contrato 	=	$sql_mttoSol_M['id_contrato'];
$fechaEj		=	$sql_mttoSol_M['fechaEj'];
$fechaAuANT		=	$sql_mttoSol_M['fechaAu']; // PARA REVERSO
$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
$importe 		=	$sql_mttoSol_M['importe'];
$km 			= 	$sql_mttoSol_M['km'];
$obs 			=	strtoupper($sql_mttoSol_M['obs']);
$id_prov 		= 	$sql_mttoSol_M['id_prov'];
$ESTE_id_prov	= 	$sql_mttoSol_M['id_prov'];
$id_prov_c		= 	$sql_mttoSol_M['id_prov_c'];
$id_prov_s		= 	$sql_mttoSol_M['id_prov_s'];
$capturo 		=	$sql_mttoSol_M['capturo'];
$autorizadoS 	=	$sql_mttoSol_M['autorizadoS'];
// TIENE DOCUMENTOS
$dC1 		=	$sql_mttoSol_M['dC1'];
$pagado 	=	$sql_mttoSol_M['pagado'];
$facturado 	=	$sql_mttoSol_M['facturado'];
$dF4 		=	$sql_mttoSol_M['dF4'];
$dM5 		=	$sql_mttoSol_M['autorizadoS']; // BUG??
// TIENE DOCUMENTOS
datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);
proveedorxid($id_prov);
provCtaxid($id_prov_c);
reembxid($id_mttoSol);

// EJECUTIVO
$sql_ejec 		= "SELECT * FROM `usuarios` WHERE `id_usuario` = '$capturo' LIMIT 1 ";
$res_ejec 		= mysqli_query($dbd2, $sql_ejec);
$matriz_ejec 	= mysqli_fetch_array($res_ejec);
$nombreEjec 	= strtoupper($matriz_ejec['nombre']);
//echo "<br>".$nombreEjec;

usuarioxid($autorizadoS);
$autorizoNombreS = $nombre;
########## ########## ########## ########## ########## 

if($autorizadoS != 1){
echo "<h2><span style='color:blue;' >AUTORIZACION EN TRÁMITE</span></h2>";
}
else{
echo "<h2><span style='color:blue;' >AUTORIZADO $fechaAuANT </span></h2>";
}


##### ##### #####
include('mttoSolUnoTabla.php');
##### ##### #####

##### ##### #####
include('mttoSolObs.php');
##### ##### #####

/*
if($_SESSION["mttoSolAut"] == 0){
	include('mttoSolAutRespResUnidad.php');
}
*/
sgtoMttoExiste($id_mttoSol);

echo "$id_sgto";

sgtoMtto($id_mttoSol);

//echo "$id_sgto";

$mostrar = 'si';


if($_SESSION["mttoSol"] > 1){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO 

//proceso del formulario // si existe "enviar"...
if (isset ($_POST['submit'])) 
{
	//comprobamos si todos los campos fueron completados
	if ($_POST['id_mttoSol']!='') 
	{
		$id_mttoSol = mysqli_real_escape_string($dbd2, $_POST['id_mttoSol'] );

		$fechaSol 	= mysqli_real_escape_string($dbd2, $_POST['fechaSolE'] );
		$horaSol 	= mysqli_real_escape_string($dbd2, $_POST['horaSolE']  );
		$fechaPg 	= mysqli_real_escape_string($dbd2, $_POST['fechaPgE']  );
		$horaPg 	= mysqli_real_escape_string($dbd2, $_POST['horaPgE']   );
		$fechaET 	= mysqli_real_escape_string($dbd2, $_POST['fechaETE']  );
		$horaET 	= mysqli_real_escape_string($dbd2, $_POST['horaETE']   );
		$fechaST 	= mysqli_real_escape_string($dbd2, $_POST['fechaSTE']  );
		$horaST 	= mysqli_real_escape_string($dbd2, $_POST['horaSTE']   );

		$capturo 	= $_SESSION['id_usuario'];

		echo $fechaSol 	."<br>";
		echo $horaSol 	."<br>";
		echo $fechaPg 	."<br>";
		echo $horaPg 	."<br>";
		echo $fechaET 	."<br>";
		echo $horaET 	."<br>";
		echo $fechaST 	."<br>";
		echo $horaST 	."<br>";

		$sql_SGTO = " UPDATE mttoSolSgto 
					  SET 
						fechaSol 	 = 	'$fechaSol'  , 
						horaSol 	 = 	'$horaSol' 	 , 
						fechaPg 	 = 	'$fechaPg' 	 , 
						horaPg 	 	 = 	'$horaPg' 	 , 
						fechaET 	 = 	'$fechaET' 	 , 
						horaET 	 	 = 	'$horaET' 	 , 
						fechaST 	 = 	'$fechaST' 	 , 
						horaST 	 	 = 	'$horaST' 	
					  WHERE id_mttoSol = '$id_mttoSol' 
					  LIMIT 1
					";
		$sql_SGTO_R = mysqli_query($dbd2, $sql_SGTO);

		if($sql_SGTO_R)
		{
			echo "ACTUALIZACION EXITOSA";
		}
		//date_default_timezone_set('America/Mexico_city');
		//$fechaAu = date("Y-m-d H:i:s");
		//INSERCION EN BASE
	}
}
// proceso del formulario



//echo @$mensaje; /*mostramos el estado de envio del form */ 



if (@$flag!='ok' && $mostrar == 'si') {  // INICIA Mostrar formulario  



?>

<style>
.encabezadoGde{padding: 10px;width:200px;}
.fechas td{text-align: center;}
</style>

<table class='fechas'>
	<tr>
		<th colspan='2' class='encabezadoGde'  >SOLICITUD DE SERVICIO</th>
		<th colspan='2' class='encabezadoGde'  >PROGRAMACION</th>
		<th colspan='2' class='encabezadoGde'  >ENTRADA AL TALLER</th>
		<th colspan='2' class='encabezadoGde'  >SALIDA DEL TALLER</th>
<!--
		<th colspan='2' class='encabezadoGde'  >TRABAJO TERMINADO</th>
		<th colspan='2' class='encabezadoGde'  >AVISO DE PAGO</th>
-->
	</tr>
	<tr>
		<th>FECHA</th>
		<th>HORA</th>
		<th>FECHA</th>
		<th>HORA</th>
		<th>FECHA</th>
		<th>HORA</th>
		<th>FECHA</th>
		<th>HORA</th>
<!--
		<th>FECHA</th>
		<th>HORA</th>
		<th>FECHA</th>
		<th>HORA</th>
-->
	</tr>
	<tr>
		<td><?php echo $fechaSol;?></td>
		<td><?php echo $horaSol;?></td>
		<td><?php echo $fechaPg;?></td>
		<td><?php echo $horaPg;?></td>
		<td><?php echo $fechaET;?></td>
		<td><?php echo $horaET;?></td>
		<td><?php echo $fechaST;?></td>
		<td><?php echo $horaST;?></td>
<!--
		<td>2018-05-08</td>
		<td>17:00:00</td>
		<td>2018-05-08</td>
		<td>17:00:00</td>
-->
	</tr>



	<form action='' method='POST' >
	<tr>
		<input type='hidden' name='id_mttoSol' id='id_mttoSol' value='<?php echo $id_mttoSol;?>'  >

		<td><input type='date' name='fechaSolE' id='fechaSolE' value='<?php echo $fechaSol;?>'  ></td>
		<td><input type='time' name='horaSolE' id='horaSolE' value='<?php echo $horaSol = ($horaSol != '')?"$horaSol":'10:00:00';?>'  ></td>

		<td><input type='date' name='fechaPgE' id='fechaPgE' value='<?php echo $fechaPg ;?>'  ></td>
		<td><input type='time' name='horaPgE'  id='horaPgE'  value='<?php echo $horaPg = ($horaPg != '')?"$horaPg":'11:00:00';?>'  ></td>

		<td><input type='date' name='fechaETE' id='fechaETE' value='<?php echo $fechaET;?>'  ></td>
		<td><input type='time' name='horaETE'  id='horaETE'  value='<?php echo $horaET = ($horaET != '')?"$horaET":'09:00:00';?>'  ></td>

		<td><input type='date' name='fechaSTE' id='fechaSTE' value='<?php echo $fechaST;?>'  ></td>
		<td><input type='time' name='horaSTE'  id='horaSTE'  value='<?php echo $horaST = ($horaST != '')?"$horaST":'18:00:00';?>'  ></td>
<!--
		<td>2018-05-08</td>
		<td>17:00:00</td>
		<td>2018-05-08</td>
		<td>17:00:00</td>
-->
		<td><input type='submit' name='submit' value='Guardar Cambios' ></td>
	</tr>
	</form>



</table>




<?php }  // TERMINA Mostrar formulario 
} // CIERRE PRIVILEGIOS 

//echo "$id_unidad";
echo '<p>';
/**/
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "
		<FORM action='u3index.php?id_unidad=$id_unidad' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_unidad' VALUE='$id_unidad'>
			<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
	   ";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 


// BOTON REGRESAR AL RESUMEN // IR AL RESUMEN DE MANTENIMIENTO
$resumenRegresar = '';
if($_SESSION["mttoSolAut"] > 1){$resumenRegresar = 'mttoSolAutSR.php'; }else{$resumenRegresar = 'mttoSolRes.php'; }	  
	echo "
		<a href='$resumenRegresar?pagina=".$paginaR."' style='text-decoration:none;'>
		<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen'>
		</a>
		 ";
 // BOTON REGRESAR AL RESUMEN // IR AL RESUMEN DE MANTENIMIENTO



// BOTON REGRESAR AL RESUMEN // DEL PROVEEDOR
if($_SESSION["mttoSolAut"] > 0){  
	echo "
		<a href='
		mttoSolResSupProv.php?id_prov=".$ESTE_id_prov."' style='text-decoration:none;'>
		<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Ir a PROVEEDOR'>
		</a>
		 ";
 }	
 // BOTON REGRESAR AL RESUMEN // DEL PROVEEDOR

	echo '</p>';

include ("1footer.php"); ?>