<?php
include("1header.php");

if($_SESSION["gps"] > 0){ // VISTA A C4
include ("nav_gps.php");
//echo "<h2>ALERTA GPS</h2>";

$subido = '';


if( isset($_GET['id_unidad']) ){
$id_unidad =  mysqli_real_escape_string($dbd2, $_GET['id_unidad']) ;
datosxid($id_unidad);
echo "<br>id_unidad = $id_unidad<br>";
}


if(isset($_POST['Datos']))
{
	if($_POST['id_unidad']!='' 
	   && $_POST['mensaje']!=''
	   )
	{		
	$id_unidad 	= mysqli_real_escape_string($dbd2, $_POST['id_unidad']  );
	$mensaje  	= mysqli_real_escape_string($dbd2, $_POST['mensaje']  );
	$capturo 	= $_SESSION["id_usuario"];

	// VALIDAR PASO DE ID's
	echo $id_unidad." - ".$mensaje." - " ;

/*	// INICIO QUERY CANDADO NO SE DUPLIQUE
	$sql_existe = "SELECT * FROM gpsAsignado WHERE id_unidad = '$id_unidad' AND 
				id_imei = '$id_imei' AND 
				id_linea = '$id_linea' AND 
				fechaInicio = '$fechaInicio' LIMIT 1 ";

	//$sql_existe_resp = mysqli_query($dbd2, $sql_existe );
	// TERMINA QUERY CANDADO NO SE DUPLIQUE
 */ 
		$proceder = 1;

		// CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION 
		// FORMULA PARA SABER SI HUBO RESULTADOS //if(mysqli_affected_rows($dbd2) == 0) 
		if($proceder == 1) 
		{
		date_default_timezone_set('America/Mexico_city');
		$fechaReg = date("Y-m-d H:i:s");
		$sql_gps_Asigna = ' INSERT INTO `gpsAlerta` 
							(`id_alertaGps`, `id_unidad`, `mensaje`, capturo, 
							 fechaReg ) VALUES ';

		$sql_gps_Asigna .= "(NULL, '$id_unidad', '$mensaje', '$capturo', 
							'$fechaReg' )" ;
		$Asigna_rs 		= mysqli_query($dbd2, $sql_gps_Asigna);

			if($Asigna_rs)
			{ 
				echo '<h2>REGISTRO DE ALERTA CORRECTO</h2>';
				echo "<a href='gpsAlerta.php'>REGISTRAR OTRA ALERTA</a>";
			}
 			$subido = 'ok'	;	
		}
	  	else
	  	{
	  		echo "<p>ALERTA YA EXISTE</p>";
	  	}
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}

if($subido!='ok'){ ?>


<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
textarea{width:auto;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
		 $('#search1').keyup(function()
		{
		 var search1 = $('#search1').val();
			$.ajax(
			{
				url:'gpssearch.php',
				data:{search1:search1},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result1').html(data);
					}
				}
			});
		});
	


		$('#search2').keyup(function()
		{
		 var search2 = $('#search2').val();
			$.ajax(
			{
				url:'gpssearch.php',
				data:{search2:search2},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result2').html(data);
					}
				}
			});
		});


		$('#search3').keyup(function()
		{
		 var search3 = $('#search3').val();
			$.ajax(
			{
				url:'gpssearch.php',
				data:{search3:search3},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result3').html(data);
					}
				}
			});
		});


		$('#search4').keyup(function()
		{
		 var search4 = $('#search4').val();
			$.ajax(
			{
				url:'gpssearch.php',
				data:{search4:search4},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result4').html(data);
					}
				}
			});
		});


	});
</script>

<?php // FECHA DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>

<form id='alta'  action='' method='POST' > 
<h2>GENERAR ALERTA DE MANTENIMIENTO GPS</h2>
<table>

<?php
if( isset($_GET['id_unidad']) ){
//$id_unidad =  mysqli_real_escape_string($dbd2, $_GET['id_unidad']) ;
//datosxid($id_unidad);

echo "<tr> 
		<th>UNIDAD VEHICULAR</th>
		<td>
		Economico: $Economico, Serie: $Serie, 
		Placas: $Placas, 
		Vechiculo: $Vehiculo, Modelo: $Modelo, 
		Color: $Color
		<td>
		<tr>";
echo "<input type ='hidden' name='id_unidad' value='$id_unidad' >";
}
else{
?>
	<tr>
		<td></td>
		<th>BUSCAR</th>
		<th>SELECCIONAR OPCION</th>
	</tr>
	<tr>
		<th>SERIE DE UNIDAD VEHICULAR</th>
		<td>
			<input type='text' id='search1' >
		</td>
		<td>
			<div id="result1"></div>
		</td>	
	</tr>

<?php
}
?>

	<tr>
		<th>MENSAJE</th>
		<td colspan=2>
			<textarea name='mensaje' cols=60 ></textarea>
		</td>
	</tr>
	<tr>
		<td colspan=3 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Generar Alerta"> 
		</td>
	</tr>
</table>
</form>
<?php }
} // FIN PRIVILEGIO VISTA C4 
include("1footer.php");?>