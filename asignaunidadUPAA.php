<?php
include("1header.php");

if($_SESSION["asignaPtdAA"] > 0){ // INICIA PRIVILEGIO VISTA A ASIGNACION 

$subido = ''; 
$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

// INCIALIZAR VARIABLES QUE QUIZA NO EXISTAN PARA EL CONTRATO ELEGIDO
$id_partida = 0;
$id_subDiv2 = 0;
//$id_subDiv3 = 0;

unidadAsignacion($id_unidad);
echo "$id_subDiv2 $id_subDiv3 OKOK";
clientexid($id_cliente);
contratoxid($id_contrato);
partidaXid_partida($id_partida);
areaAXid_subDiv2($id_subDiv2);
areaAXid_subDiv3($id_subDiv3);
$id_partidaEsta = $id_partida;
$id_subDiv2Esta = $id_subDiv2;
$id_subDiv3Esta = $id_subDiv3;

echo "$id_subDiv3Esta $id_subDiv3 OKOK";

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


echo "<table >";
echo "<tr>
		<th>DESDE</th>
		<th>ID CTO A</th>
		<th>CONTRATO</th>
		<th>RFC</th>
		<th>CLIENTE</th>

		<th>PARTIDA</th>
		<th>AREA ADMINISTRATIVA</th>
		<th>SUBAREA</th>
	</tr>";
echo "<tr>";

echo "<td>{$fecha_inicioASG}</td>";
echo "<td>{$id_alan}</td>";
echo "<td>{$numero}</td>";
echo "<td>{$rfc}</td>";
echo "<td>{$razonSocial}</td>";

echo "<td>{$mostrarPDesc}</td>";
echo "<td>{$mostrarAAsn2}</td>";

echo "<td>{$mostrarAAsn3}</td>";

echo "<td>{$tipoAsig}</td>";
echo "</tr></table >";


if(isset($_POST['Datos']))
	{
		if(	$_POST['id_unidad']!='' 
			&& $_POST['id_cliente']!='' 
			&& $_POST['id_contrato']!='' 
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
						$sql_cto_Asigna = 'INSERT INTO `jetvantlc`.`asignaUnidad` 
							(`id_asignacion`, `id_unidad`, `id_cliente`, `id_contrato`, 
							 `id_partida`, fecha_inicio, tipoAsig, id_subDiv2, id_subDiv3, `capturo`) VALUES ';
						$sql_cto_Asigna .= "(NULL, '$id_unidad', '$id_cliente', '$id_contrato', "
							."  '$id_partida', '$fechaInicio',  '$tipoAsig', '$id_subDiv2', '$id_subDiv3', '$capturo') ;" ;
						$Asigna_rs = mysqli_query($dbd2, $sql_cto_Asigna);

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
								$sql_asigna_anterior = "SELECT id_asignacion FROM asignaUnidad "
									." WHERE id_asignacion < '$id_asignacion_actual' AND id_unidad = '$id_unidad' ORDER BY "
									." id_asignacion DESC LIMIT 1 "; 
								$sql_asigna_anterior_res	= mysqli_query($dbd2, $sql_asigna_anterior);
								$asigna_anterior_matriz		= mysqli_fetch_array($sql_asigna_anterior_res);
								$id_asignacion_anterior		= $asigna_anterior_matriz['id_asignacion'];
								echo "<br/>$id_asignacion_anterior AAct <br/>";
								// TERMINA OBTENER ASIGNACION ANTERIOR

								// INICIO ACTUALIZAR ASIGNACION ANTERIOR 
								$sql_actualiza_aa = "UPDATE asignaUnidad SET fecha_final = '$fechaInicio' WHERE id_asignacion = '$id_asignacion_anterior' LIMIT 1 ";
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
		function buscaSubAreaSD3()
		{
		 var search34 = $('#search34').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search34:search34},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result34').html(data);
					}
				}
			});
		};
</script>

<?php // FECHA DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>

<div id='formulario'>


<form id='alta'  action='' method='POST' >
<input type='hidden' value='<?php echo $id_unidad; ?>'  name ='id_unidad'>
<input type='hidden' value='<?php echo $id_cliente; ?>'  name ='id_cliente'>
<input type='hidden' value='<?php echo $id_contrato; ?>'  name ='id_contrato'>
	<h2>ASIGNAR UNIDAD VEHICULAR A PARTIDA / AREA ADMINISTRATIVA</h2>

<table>
<tr>
	<td></td>
	<th>SELECCIONAR OPCION</th>
</tr>

	<tr><th>PARTIDA</th>
		<td>

<?php

$sql27 = 'SELECT id_cliente, id_contrato, id_partida, modelos, cilindros, clasif, descripcion, precioD, marcas  '
		. ' FROM '
		. ' ctoPartidas '
		. " WHERE id_contrato = '$id_contrato' ORDER BY clasif ASC LIMIT 200 ";
		
		$search_query27 = mysqli_query($dbd2, $sql27);
		if(!$search_query27) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_partida'  >"; // ID DEL ELEMENTO BUSCADO
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query27)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_partida 	= $row['id_partida'];
				$descripcion 	= $row['descripcion'];
				$precioD 		= $row['precioD'];
				$marcas 		= $row['marcas'];
				$modelos 		= $row['modelos'];
				$cilindros 		= $row['cilindros'];
				$clasif 		= $row['clasif'];

				$selected	= ($id_partidaEsta == $id_partida)? 'selected':'';

				echo "<option value='{$id_partida}'    $selected    >ctebd-{$id_cliente} ctobd-{$id_contrato} ::: Partida {$id_partida} ::: Cil {$cilindros} ::: Modelos {$modelos} ::: Clasif {$clasif} ::: Marcas {$marcas}  ::: PrecioDiario {$precioD} ::: Descripcion {$descripcion}</b> </option>";

		}
			echo "</select>"; 
	$filas27 	= mysqli_num_rows($search_query27);
	$xz27 		= ($filas27 > 0)?"":"No hay coincidencias en BD";
	echo $xz27;


?>

		</td>
	</tr>



	<tr><th>AREA ADMINISTRATIVA</th>
		<td>
<?php
		$sql26 = 'SELECT id_cliente, id_contrato, id_subDiv2, descripcion '
		. ' FROM '
		. ' clbSubDiv2 '
		. " WHERE id_contrato = '$id_contrato' ORDER BY descripcion ASC LIMIT 200 ";
		
		$search_query26 = mysqli_query($dbd2, $sql26);
		if(!$search_query26) 
		   {
		   die('QUERY FAILED' . mysqli_error($dbd2));
		   }
		echo "<select name='id_subDiv2'  id='search34' 
				 onchange='buscaSubAreaSD3(this);'   >";
		echo "<option value='0'> -- </option>"; 
		while($row = mysqli_fetch_array($search_query26)) {
				$id_cliente 	= $row['id_cliente'];
				$id_contrato 	= $row['id_contrato'];
				$id_subDiv2 	= $row['id_subDiv2'];
				$descripcion 	= $row['descripcion'];

				$selected	= ($id_subDiv2Esta == $id_subDiv2)? 'selected':'';

				$sql_unidadesSD 		= "SELECT count( id_unidad ) unidades "
										."	FROM asignaUactual "
										."	WHERE id_subDiv2 = '$id_subDiv2' ";
				$sql_unidadesSD_res 	= mysqli_query($dbd2, $sql_unidadesSD);
				$unidades_matrizSD		= mysqli_fetch_array($sql_unidadesSD_res);
				$unidadesCtoSD 			= $unidades_matrizSD['unidades'];

					echo "<option value='{$id_subDiv2}'  $selected   >ctebd-{$id_cliente} ctobd-{$id_contrato} ::: AreaAdva {$id_subDiv2} ::: UNIDADES  <b>{$unidadesCtoSD} ::: {$descripcion}</b> </option>";

		}
		echo "</select>"; 
	$filas26 = mysqli_num_rows($search_query26);
	$xz26 = ($filas26 > 0)?"":"No hay coincidencias en BD";
	echo $xz26;
?>

		</td>
	</tr>





	<tr><th>SUBAREA</th>
		<td>
			<div  id="result34"></div>
		</td>
	</tr>





	<tr><th>FECHA DE ASIGNACION</th>
		<td><input type='date' name='fechaInicio' value="<?php echo date("Y-m-d");?><?php echo @$_POST['fechaInicio'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td>
 		</td>
	<tr>




<?php
$tipoAsigCkd = array('','','','','','','','','','');
$tipoAsigCkd[$tipoAsig] = 'checked';
?>
	<tr><th>TIPO DE ASIGNACION</th>
		<td >
			<table style='border: solid 0px;'>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='tipoAsig' id='A0' value='1' 
					<?php echo $tipoAsigCkd[1];?> 
					style='min-width: 30px;' >
				</td>
				<td style='text-align: left;border: solid 0px;'>
					<label for='A0'>BASE</label>					
				</td>
			</tr>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='tipoAsig' id='A1' value='2' 
					<?php echo $tipoAsigCkd[2];?> 
					style='min-width: 30px;' >
				</td>
				<td style='text-align: left;border: solid 0px;'>
					<label for='A1'>SUSTITUTO</label><br>
				</td>
			<tr  >
				<td style='text-align: left; padding: 0px;border: solid 0px;'>
					<input type='radio' name='tipoAsig' id='A2' value='3' 
					<?php echo $tipoAsigCkd[3];?> 
					style='min-width: 30px;' >
				<td style='text-align: left;border: solid 0px;'>
					<label for='A2'>CORTESIA</label>
				</td>
			</tr>


				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A3' value='4' 
						<?php echo $tipoAsigCkd[4];?> 
						style='min-width: 30px;' >
					</td>
					<td style='text-align: left;border: solid 0px;'>
						<label for='A3'>ROBO TOTAL</label>
					</td>
				</tr>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A4' value='5'  
						<?php echo $tipoAsigCkd[5];?> 
						style='min-width: 30px;' >
					</td>
					<td style='text-align: left;border: solid 0px;'>
						<label for='A4'>PERDIDA TOTAL</label><br>
					</td>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A5' value='6' 
						<?php echo $tipoAsigCkd[6];?> 
						style='min-width: 30px;' >
					<td style='text-align: left;border: solid 0px;'>
						<label for='A5'>SINIESTRO / DAÑOS MATERIALES</label>
					</td>
				</tr>
				<tr  >
					<td style='text-align: left; padding: 0px;border: solid 0px;'>
						<input type='radio' name='tipoAsig' id='A6' value='7' 
						<?php echo $tipoAsigCkd[7];?> 
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