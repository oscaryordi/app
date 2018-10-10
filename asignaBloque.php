<?php
include("1header.php");
include("nav_asigna.php");

if($_SESSION["asigna"] > 3){ // APERTURA PRIVILEGIO

echo "<meta charset='utf-8'>";
echo "<div style='padding: 5px;'>";

if(isset($_POST['checkBoxArray'])){

   // echo "RECIBIENDO DATOS<br>";

	$id_cliente  	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
	$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
	$fecha_inicio	= mysqli_real_escape_string($dbd2, $_POST['fecha_inicio']); // UNIFORMAR EN OTROS FORMULARIOS
	$capturo		= $_SESSION["id_usuario"];


	$id_partida 	= @(mysqli_real_escape_string($dbd2, $_POST['id_partida']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_partida']))? mysqli_real_escape_string($dbd2, $_POST['id_partida']):'0';
	$id_subDiv2 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']):'0';
	$id_subDiv3 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']):'0';


	$noHacer = 0;
	$error1 = '';
	$error2 = '';
	$error3 = '';

	if($id_cliente > 0)    {}else{$noHacer++; $error1='No indico CLIENTE,';};
	if($id_contrato > 0)	{}else{$noHacer++; $error2='No indico CONTRATO,';};
	if($fecha_inicio != '') {}else{$noHacer++; $error3='No indico FECHA,';};

	//echo $noHacer."= NO HACER";

	if($noHacer == 0)
	{
		foreach ($_POST['checkBoxArray'] as $key ) 
		{
			//echo $key.",<br>";
			
			$procede = 0;

			$sql_yaExiste   = " SELECT * FROM asignaUactual WHERE "
				." id_unidad 	= '$key' AND "
				." id_cliente 	= '$id_cliente' AND "
				." id_contrato 	= '$id_contrato' AND "
				." id_partida 	= '$id_partida' AND "
				." id_subDiv2 	= '$id_subDiv2' AND "
				." id_subDiv3 	= '$id_subDiv3'  "
				//." tipoAsig 	= '$tipoAsig'  " // ACTUALIZAR PARA PERMITIR CAMBIO DE A ADVA // TABLA VIRTUAL
				." LIMIT 1 ";
			$sql_yaExisteR  = mysqli_query($dbd2, $sql_yaExiste);
			$existe		 	= mysqli_affected_rows($dbd2);

			if($existe == 1){
				$procede = $procede +1;
				echo "YA EXISTE".$key."<br>";
			}
			else{
				//echo "HACER";
			}
			//echo $procede;
			if($procede == 0)
			{
				// TIPO DE ASIGNACION PREDETERMINADO BASE
				$sql_Asigna_U = "INSERT INTO asignaUnidad 
								(`id_asignacion`, `id_unidad`, `id_cliente`, `id_contrato`, 
							 	`id_partida`, fecha_inicio, id_subDiv2,  
							 	id_subDiv3, 
							 	`capturo`) 
							 	VALUES 
								(NULL, '$key', '$id_cliente', '$id_contrato', 
								'$id_partida', '$fecha_inicio', '$id_subDiv2', 
								'$id_subDiv3', 
								'$capturo') ;" ;

				$sql_Asigna_UR  = mysqli_query($dbd2, $sql_Asigna_U);

				if(!$sql_Asigna_UR)
					{
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR ASIGNACION \n";
					}
				else{
						$id_unidad = $key; 
						datosxid($id_unidad);
						echo "<h4>REGISTRO CORRECTO $Placas </h4>";
						$id_unidad = '';
					}
			}
		}
	}
	else
	{
		echo "$error1 $error2 $error3";
	}
}
elseif( isset($_POST['Asignar']) && $_POST['checkBoxArray'] == NULL )
{
	echo "NO SELECCIONO UNIDADES :(";
}

?>

<form action="asignaBloque.php" method="post">
	<p><label>Escribe en el siguiente campo las SERIES a buscar:</label></p>
	<p><textarea name="celulas" rows="7" cols="40"><?php echo @$_POST['celulas']; ?></textarea></p>
	<p>
		<input type="submit" name="search" value="Buscar" />
		<a href='asignaBloque.php' style='text-decoration: none;'>
			<input type="button" value="BORRAR" >
		</a>
	</p>

</form>

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



		$('#selectAllBoxes').click(function(event)
		{
			if(this.checked){
				$('.checkBoxes').each(function(){
					this.checked=true;
				});
			} else {
				 $('.checkBoxes').each(function(){
					this.checked=false;
				});
			}
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


<?php
if (isset($_POST['search'])) {
//	$celulasSC = mysqli_real_escape_string($dbd2, $_POST['celulas']);
//	echo $celulasSC;
	$celulas = trim($_POST['celulas']);
	$celulas = trim(preg_replace('/\s\s+/', '', $celulas));
	$celulas = str_replace(array("\n", "\t", " "),"",$celulas);
	$celulas = mysqli_real_escape_string($dbd2, $celulas);
	$celulas = explode(',', $celulas);

	$query_search = 'SELECT id, Economico, Serie, Vehiculo, Modelo, Color FROM ubicacion WHERE ';
	for ($i=0; $i<count($celulas); $i++) 
	{
		if ($i == 0)
			$query_search .= 'Serie = "'.$celulas[$i].'"';
		else
			$query_search .= ' OR Serie = "'.$celulas[$i].'"  '; //ORDER BY Economico ASC
	}
	$query_search .= ' ORDER BY Economico ASC ';

	$search = $conexion4->query($query_search);

	$consecutivo = 0;
	if ($search->num_rows > 0) 
	{

	   echo "<form action='asignaBloque.php' method='post'>";
		?>

				<div>
					<H2>Desde este formulario todas las asignaciones son BASE</H2>
					<table class="ResTabla" >
						<tr>
							<td></td>
							<th>BUSCAR</th>
							<th>SELECCIONAR OPCION</th>
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
							<td><input type='date' name='fecha_inicio' value="<?php echo date("Y-m-d");?>
								<?php echo @$_POST['fechaInicio'];?>" placeholder='aaaa-mm-dd'>
								aaaa-mm-dd </td>
							</td>
						</tr>
					</table>
				</div>

				<input type='submit'  name='Asignar'  value="Asignar" >

			<?php
			echo '<table class="ResTabla" border="1" cellpadding="5" cellspacing="5">';
			echo '<tr>';
			echo "<th><input  id='selectAllBoxes' type='checkbox'   > </th>";
			echo '<th>LISTADO</th>';
			echo '<th>ECONOMICO</th>';
			echo '<th>SERIE</th>';
			echo '<th>VEHICULO</th>';
			echo '<th>MODELO</th>';
			echo '<th>PLACAS</th>';

			echo '<th>CLIENTE</th>';
			echo '<th>CONTRATO</th>';
			echo '<th>ASIGNACION</th>';

			echo '</tr>';
			while ($row_searched = $search->fetch_array()) { 
				$consecutivo++ ;
				echo '<tr>';
				$id_unidad = $row_searched['id'];
				echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$id_unidad' id='$id_unidad' > </td>";

				echo '<td>'.$consecutivo.'</td>';
				echo '<td>'.$row_searched['Economico'].'</td>';
				echo '<td>'."<label for='$id_unidad' >".$row_searched['Serie']."</label>".'</td>';
				echo '<td>'.$row_searched['Vehiculo'].'</td>';
				echo '<td>'.$row_searched['Modelo'].'</td>';
				datosxid($id_unidad);
				echo '<td>'."<label for='$id_unidad' >".$Placas."</label>".'</td>';
				unidadAsignacion($id_unidad);
				clientexid($id_cliente);
				echo '<td>'.$id_cliente.'::: '.$rfc.' <br> '.$razonSocial.'</td>';
				contratoxid($id_contrato);
				echo '<td>'.$id_contrato.' ::: '.$numero.'</td>';
				echo '<td>'.$fecha_inicioASG.'</td>';

				echo '</tr>';
				$id_unidad  = '';
				$id_cliente = '';
				$id_contrato = '';
				$fecha_inicioASG = '';
				$id_unidad  = '';
			}
			echo '</table><br/>';

		echo "</form>";

	}
	else
	{
		echo '<div class="info">No hay resultados para los criterios de búsqueda.</div>';
	}
}

echo "</div>";
} // CIERRE PRIVILEGIO
include("1footer.php");?>