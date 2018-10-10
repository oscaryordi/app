<?php
include("1header.php");

if($_SESSION["gps"] > 0){ // VISTA A C4

include ("nav_gps.php");

$subido = '';

if(isset($_POST['Datos']))
{
    if($_POST['id_unidad']!='' 
    && $_POST['id_imei']!=''
    && $_POST['id_linea']!='' 
    && $_POST['id_sim']!='' 
    )
    {		
        $id_unidad 	= mysqli_real_escape_string($dbd2, $_POST['id_unidad']);
        $id_imei  	= mysqli_real_escape_string($dbd2, $_POST['id_imei']);
        $id_linea 	= mysqli_real_escape_string($dbd2, $_POST['id_linea']);
        $id_sim 	= mysqli_real_escape_string($dbd2, $_POST['id_sim']);
        $instalador	= mysqli_real_escape_string($dbd2, $_POST['instalador']);
        $fechaInicio= mysqli_real_escape_string($dbd2, $_POST['fechaInicio']);
        $bloqueo	= mysqli_real_escape_string($dbd2, $_POST['bloqueo']);
        $obs		= mysqli_real_escape_string($dbd2, $_POST['obs']);
              
        $capturo    = $_SESSION["id_usuario"];
            
	// VALIDAR PASO DE ID's
	echo $id_unidad." - ".$id_imei." - ".$id_linea." - ".$id_sim." - ".$instalador." - ".$fechaInicio ;

		// INICIO QUERY CANDADO NO SE DUPLIQUE
		$sql_existe = "SELECT * FROM gpsAsignado WHERE 
						id_unidad 	= '$id_unidad' AND 
						id_imei 	= '$id_imei' AND 
						id_linea 	= '$id_linea' AND 
						fechaInicio = '$fechaInicio' LIMIT 1 ";

		$sql_existe_resp = mysqli_query($dbd2, $sql_existe);
		// TERMINA QUERY CANDADO NO SE DUPLIQUE

		if(mysqli_affected_rows($dbd2) == 0) // CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION // FORMULA PARA SABER SI HUBO RESULTADOS
		{
			$sql_gps_Asigna = 'INSERT INTO `jetvantlc`.`gpsAsignado` 
					    (`id_gps`, `id_imei`, `id_linea`, `id_sim`, id_unidad, 
					    instalador, fechaInicio, `capturofi`, bloqueo, obs) 
					    VALUES ';
			$sql_gps_Asigna .= "(NULL, '$id_imei', '$id_linea', '$id_sim', '$id_unidad', 
						'$instalador', '$fechaInicio', '$capturo', '$bloqueo', '$obs') ;" ;
			$Asigna_rs = mysqli_query($dbd2, $sql_gps_Asigna);

		    if($Asigna_rs)
		    { 
		        echo '<h2>EQUIPO ASIGNADO CORRECTAMENTE</h2>';
			}
 			$subido = 'ok'	;	
		}
	  	else
	  	{
	  		echo "<p>Asignación ya existe</p>";
	  	}
    }
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}

if($subido!='ok'){ ?>


<style>
#alta input {min-width:20px;} #alta #gobutton {width:auto;}
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
	<h2>ASIGNAR EQUIPO A UNIDAD VEHICULAR</h2>

<table>

	<tr>
		<td></td>
		<th>BUSCAR</th>
		<th>SELECCIONAR OPCION</th>
	</tr>

	<tr><th>SERIE DE UNIDAD VEHICULAR</th>
		<td>
			<input type='text' id='search1'>
		</td>
		<td>
			<div id="result1">
			</div>
		</td>
	</tr>

	<tr><th>IMEI</th>
		<td>
			<input type='text' id='search2'>
		</td>
		<td>
			<div id="result2">
			</div>
		</td>	
	</tr>

	<tr><th>LINEA</th>
		<td>
			<input type='text' id='search3'>
		</td>
		<td>
			<div id="result3">
			</div>
		</td>
	</tr>

	<tr><th>SIM</th>
		<td>
			<input type='text' id='search4'>
		</td>
		<td>
			<div id="result4">
			</div>
		</td>
	</tr>

	<tr>
		<th>BLOQUEO INSTALADO</th>
		<td>
			<input type='radio' name='bloqueo' id='NO'  value='0' checked 
			class='statusI' >
			<label for="NO" class='statusL'>NO</label><br>

			<input type='radio' name='bloqueo' id='SI' value='1'
			class='statusI' >
			<label for="SI" class='statusL'>BOMBA DE GASOLINA</label><br>

			<input type='radio' name='bloqueo' id='BT2' value='2'
			class='statusI' >
			<label for="BT2" class='statusL'>IGNICION</label><br>

			<input type='radio' name='bloqueo' id='BT3' value='3'
			class='statusI' >
			<label for="BT3" class='statusL'>OTRO</label><br>
		</td>
		<td>

			OBSERVACIONES<br>
			<input type='text' name='obs' >
		
		</td>
	</tr>

 	<tr><th>INSTALADOR</th>
		<td>
			<select name="instalador">
				<option value="1">Christian</option>
				<option value="2">Agustin</option>
				<option value="3">Cesar</option>
				<option value="4">Otro</option>
				<option value="5">Otro 2</option>
			</select>
		</td>
		<td>
		</td>
	</tr>

	<tr><th>FECHA DE ASIGNACION</th>
		<td><input type='date' name='fechaInicio' value="<?php echo date("Y-m-d");?><?php echo @$_POST['fechaInicio'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td>
 		</td>
		<td>
    </tr>

     <tr>
		<td colspan=3 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Asignar Equipo a Unidad Vehicular"> 
		</td>
	</tr>
</table>
</form>

<?php }

} // FIN PRIVILEGIO VISTA C4 

include("1footer.php");?>