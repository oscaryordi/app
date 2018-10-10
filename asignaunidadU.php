<?php
include("1header.php");

if($_SESSION["asigna"] > 1){ // INICIA PRIVILEGIO VISTA A ASIGNACION 

$subido = ''; 
$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

// INCIALIZAR VARIABLES QUE QUIZA NO EXISTAN PARA EL CONTRATO ELEGIDO
$id_partida = 0;
$id_subDiv2 = 0;
$id_subDiv3 = 0;


?>

<div style='padding: 5px;'>
<table>
	<tr>
		<td>
			<b>UNIDAD</b>
			<br>Economico: 
			<?php echo $Economico;?>
			<br>Serie: 
			<?php echo $Serie;?>
			<br>Placas: 
			<?php echo $Placas;?>
		</td>
		<td>
			<br>Tipo: 
			<?php echo $Vehiculo;?>
			<br>Color: 
			<?php echo $Color;?>
			<br>Modelo: 
			<?php echo $Modelo;?>
		</td>
	</tr>
</table>
</div>


<?php

if(isset($_POST['Datos']))
	{
		if(	$_POST['id_unidad']!='' 
			&& $_POST['id_cliente']!='' 
			&& $_POST['id_contrato']!='' 
			&& $_POST['id_contrato'] > 0  
			&& $_POST['fechaInicio']!='' 
		  )
			{
				$id_unidad 		= mysqli_real_escape_string($dbd2, $_POST['id_unidad'] );
				$id_cliente  	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
				$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
				$fechaInicio	= mysqli_real_escape_string($dbd2, $_POST['fechaInicio']);
				$tipoAsig 		= mysqli_real_escape_string($dbd2, $_POST['tipoAsig']);

				$id_partida 	= @(mysqli_real_escape_string($dbd2, $_POST['id_partida']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_partida']))? mysqli_real_escape_string($dbd2, $_POST['id_partida']):'0';
				$id_subDiv2 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']):'0';
				$id_subDiv3 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']):'0';

				$capturo 		= $_SESSION["id_usuario"];

				// VALIDAR PASO DE ID's
				echo "<p>UN".$id_unidad." - CE".$id_cliente." - CO".$id_contrato
					." - PT".$id_partida." - AA".$id_subDiv2." - Aa".$id_subDiv3
					." - TA".$tipoAsig." - FI".$fechaInicio."</p>" ;

				// INICIO QUERY CANDADO NO SE DUPLIQUE
				$sql_existe = " SELECT * FROM asignaUactual WHERE "
				." id_unidad 	= '$id_unidad' AND "
				." id_cliente 	= '$id_cliente' AND "
				." id_contrato 	= '$id_contrato' AND "
				." id_partida 	= '$id_partida' AND "
				." id_subDiv2 	= '$id_subDiv2' AND "
				." id_subDiv3 	= '$id_subDiv3' AND "
				." tipoAsig 	= '$tipoAsig'  " // ACTUALIZAR PARA PERMITIR CAMBIO DE A ADVA // TABLA VIRTUAL
				." LIMIT 1 ";

				$sql_existe_resp 	= mysqli_query($dbd2, $sql_existe);
				$sql_existe_resp_M 	= mysqli_fetch_assoc($sql_existe_resp);
				$arrayviejo 		= @json_encode($sql_existe_resp_M);
				// echo "viejo ".$arrayviejo."<br>";

				//echo "tipoAsig ".$tipoAsig."<br>";
				//echo "id_subDiv2 ".$id_subDiv2."<br>";
				//echo "id_subDiv3 ".$id_subDiv3."<br>";

				// TERMINA QUERY CANDADO NO SE DUPLIQUE

				if(mysqli_affected_rows($dbd2) == 0) // CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION // FORMULA PARA SABER SI HUBO RESULTADOS
					{
						$sql_cto_Asigna = ' INSERT INTO `jetvantlc`.`asignaUnidad` 
											(`id_asignacion`, `id_unidad`, `id_cliente`, `id_contrato`, 
							 				`id_partida`, fecha_inicio, tipoAsig, id_subDiv2,  
							 				id_subDiv3, 
							 				`capturo`) 
							 				VALUES ';
						$sql_cto_Asigna .=   "(NULL, '$id_unidad', '$id_cliente', '$id_contrato', "
											."  '$id_partida', '$fechaInicio',  '$tipoAsig', '$id_subDiv2', 
											'$id_subDiv3', 
											'$capturo') ;" ;
						$Asigna_rs = mysqli_query($dbd2, $sql_cto_Asigna );

							if($Asigna_rs){ 
								// INICIO OBTENER ID ACTUAL
								$sql_asigna_actual = 	 " SELECT MAX(id_asignacion) id_asignacion "
														." FROM asignaUnidad "
														." WHERE id_unidad = '$id_unidad' "
														." AND fecha_inicio = '$fechaInicio' ";
								$sql_asigna_actual_res 	= mysqli_query($dbd2, $sql_asigna_actual );
								$asigna_actual_matriz 	= mysqli_fetch_array($sql_asigna_actual_res);
								$id_asignacion_actual	= $asigna_actual_matriz['id_asignacion'];
								echo "<br/>$id_asignacion_actual AAnt<br/>";
								// TERMINA OBTENER ID ACTUAL

								// INICIO OBTENER ASIGNACION ANTERIOR
								$sql_asigna_anterior =   " SELECT id_asignacion FROM asignaUnidad "
														." WHERE id_asignacion < '$id_asignacion_actual' 
														   AND id_unidad = '$id_unidad' ORDER BY "
														." id_asignacion DESC LIMIT 1 "; 
								$sql_asigna_anterior_res	= mysqli_query($dbd2, $sql_asigna_anterior);
								$asigna_anterior_matriz		= mysqli_fetch_array($sql_asigna_anterior_res);
								$id_asignacion_anterior		= $asigna_anterior_matriz['id_asignacion'];
								echo "<br/>$id_asignacion_anterior AAct <br/>";
								// TERMINA OBTENER ASIGNACION ANTERIOR

								// INICIO ACTUALIZAR ASIGNACION ANTERIOR 
								$sql_actualiza_aa = "	UPDATE asignaUnidad 
														SET fecha_final = '$fechaInicio' 
														WHERE id_asignacion = '$id_asignacion_anterior' 
														LIMIT 1 ";
								$sql_actualiza_aa_res = mysqli_query($dbd2, $sql_actualiza_aa);
								// TERMINA ACTUALIZAR ASIGNACION ANTERIOR

								echo '<h2>UNIDAD VEHICULAR ASIGNADA CORRECTAMENTE</h2>';
								echo '<h2>A CONTRATO</h2>';
							}
						$subido = 'ok';
					} // CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION
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
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
#formulario {padding:5px;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
 
		$('#search5').keyup(function()
		{
		 var search5 = $('#search5').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search5:search5},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result5').html(data);
					}
				}
			});
		});


		function buscaContratos()
		{
		 var search6 = $('#search6').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search6:search6},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result6').html(data);
					}
				}
			});
		};


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


		$('#search19').keyup(function()
		{
		 var search19 = $('#search19').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search19:search19},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result19').html(data);
					}
				}
			});
		});

		$('#search20').keyup(function()
		{
		 var search20 = $('#search20').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search20:search20},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result20').html(data);
					}
				}
			});
		});


	});
</script>

<script>
function buscaContratos()
		{
		 var search6 = $('#search6').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search6:search6},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result6').html(data);
					}
				}
			});
		};
</script>

<script>
function buscaAreaAd()
		{
		 var search26 = $('#search26').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search26:search26},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result26').html(data);
					}
				}
			});
		};
</script>


<script>
function buscaSubAreaAd()
		{
		 var search35 = $('#search35').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search35:search35},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result35').html(data);
					}
				}
			});
		};
</script>


<script>
function buscaPartida()
		{
		 var search27 = $('#search26').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search27:search27},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result27').html(data);
					}
				}
			});
		};
</script>

<?php // FECHA DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>

<div id='formulario'>

<table>
<caption>Busqueda para referencia rápida</caption>
	<tr>
		<td style='background-color: #d2e0e0 ;'>
			<table >
				<tr style='background-color: #d2e0e0 ;'>
					<td></td><td><b>CONSULTAR CLIENTE</b></td>
					<td><b>RESULTADO</b></td>
				</tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Nombre</td>
					<td><input type='text' id='search19'></td>
					<td><div id="result19"></div></td>
				</tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Alias</td>
					<td><input type='text' id='search20'></td>
					<td><div id="result20"></div></td></tr>
			</table>
		</td>
	</tr>
</table>


<form id='alta'  action='' method='POST' > 
	<h2>ASIGNAR UNIDAD VEHICULAR A CLIENTE / CONTRATO</h2>

<table>

<tr>
<td></td>
<th>BUSCAR</th>
<th>SELECCIONAR OPCION</th>
</tr>

	<tr><th></th>
		<td>
			<input type='hidden' value='<?php echo $id_unidad; ?>'  name ='id_unidad'>
		</td>
		<td>
			
		</td>
	</tr>


	<tr><th>RFC CLIENTE</th>
		<td>
			<input type='text' id='search5'>
		</td>

		<td>
				<div id="result5"></div>
		</td>
	</tr>


	<tr><th>CONTRATO</th>
		<td>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result6"></div>
		</td>
	</tr>


	<tr><th>PARTIDA</th>
		<td>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result27"></div>
		</td>
	</tr>


	<tr><th>AREA ADMINISTRATIVA</th>
		<td>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result26"></div>
		</td>
	</tr>


	<tr><th>SUBAREA</th>
		<td>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result35"></div>
		</td>
	</tr>


	<tr><th>FECHA DE ASIGNACION</th>
		<td>
		</td>
		<td><input type='date' name='fechaInicio' value="<?php echo date("Y-m-d");?><?php echo @$_POST['fechaInicio'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td>
 		</td>
	<tr>

	<!-- STATUS DENTRO DEL CONTRATO -->
	<tr><th>TIPO DE ASIGNACION</th>
		<td colspan="2">
			<table style='border: solid 0px;'>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A0' value='1' checked 
						style='min-width: 30px;' >
					</td>
					<td style='text-align: left;border: solid 0px;'>
						<label for='A0'>BASE</label>
					</td>
				</tr>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A1' value='2'  
						style='min-width: 30px;' >
					</td>
					<td style='text-align: left;border: solid 0px;'>
						<label for='A1'>SUSTITUTO</label><br>
					</td>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A2' value='3' 
						style='min-width: 30px;' >
					<td style='text-align: left;border: solid 0px;'>
						<label for='A2'>CORTESIA</label>
					</td>
				</tr>

				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A3' value='4'  
						style='min-width: 30px;' >
					</td>
					<td style='text-align: left;border: solid 0px;'>
						<label for='A3'>ROBO TOTAL</label>
					</td>
				</tr>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A4' value='5'  
						style='min-width: 30px;' >
					</td>
					<td style='text-align: left;border: solid 0px;'>
						<label for='A4'>PERDIDA TOTAL</label><br>
					</td>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A5' value='6' 
						style='min-width: 30px;' >
					<td style='text-align: left;border: solid 0px;'>
						<label for='A5'>SINIESTRO / DAÑOS MATERIALES</label>
					</td>
				</tr>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A6' value='7' 
						style='min-width: 30px;' >
					<td style='text-align: left;border: solid 0px;'>
						<label for='A6'>PATIO / PENDIENTE DE RECOLECTAR</label>
					</td>
				</tr>
			</table>
		</td>
	</tr>




	 <tr>
		<td colspan=3 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Asignar Unidad a Contrato"> 
		</td>
	</tr>
</table>
</form>


</div>


<?php } 

} // FIN PRIVILEGIO VISTA ASIGNACION 


// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
	   ";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

include("1footer.php");?>