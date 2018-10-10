<?php
include("1header.php");
include("nav_logistica.php");

if($_SESSION["movimientos"] > 2){ // APERTURA PRIVILEGIO

echo "<meta charset='utf-8'>";
echo "<div style='padding: 5px;'>";

if(isset($_POST['checkBoxArray'])){

// echo "RECIBIENDO DATOS<br>";

	$cliente     	= mysqli_real_escape_string($dbd2, $_POST['cliente']);
	$ubicacion		= mysqli_real_escape_string($dbd2, $_POST['ubicacion']);
	$fecha_inicio   = @$_POST['fecha_inicio'];
	$capturo		= $_SESSION["id_usuario"];

	$noHacer = 0;
	$error1 = '';
	$error2 = '';
	$error3 = '';

	if($cliente != '' && $cliente != NULL)    {}else{$noHacer++; $error1='No indico CLIENTE,';};
	if($ubicacion != '' && $ubicacion != NULL)	{}else{$noHacer++; $error2='No indico UBICACION,';};
	if($fecha_inicio != '') {}else{$noHacer++; $error3='No indico FECHA,';};

	//echo $noHacer."= NO HACER";

	if($noHacer == 0)
	{
		foreach ($_POST['checkBoxArray'] as $key ) 
		{
			//echo $key.",<br>";
			
			$procede = 0;
			/*
			$sql_yaExiste   = " SELECT * FROM movimientos  
								WHERE id_unidad = '$key' 
								AND id_cliente = '$id_cliente' 
								AND id_contrato = '$id_contrato' LIMIT 1 ";
			$sql_yaExisteR  = mysqli_query($dbd2, $sql_yaExiste);
			$existe		 	= mysqli_affected_rows($dbd2);

			$existe = 0;

			if($existe == 1){
				$procede = $procede +1;
				echo "YA EXISTE".$key."<br>";
			}
			else{
				//echo "HACER";
			}
			*/
			if($key>0){$procede = 0;}else{$procede++;}
			$id_unidad = $key; 

			//echo $procede;
			if($procede == 0)
			{
				$sql_Asigna_U = "INSERT INTO movimientos 
					(id, id_unidad, cliente, ubicacion, 
					fechaRegistro, capturo) 
					VALUES 
					(NULL, '$id_unidad', '$cliente', '$ubicacion', 
					'$fecha_inicio', '$capturo') ";

				$sql_Asigna_UR  = mysqli_query($dbd2, $sql_Asigna_U);

				if(!$sql_Asigna_UR)
					{
						echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR UBICACION \n";
					}
				else{
						$id_unidad = $key; 
						datosxid($id_unidad);
						echo "<h4>REGISTRO CORRECTO $Economico ::: $Serie ::: $Placas </h4>";
						$id_unidad = '';
					}
			}
			else{
				echo "id_unidad no indicado";
			}
		}
	}
	else
	{
		echo "$error1 $error2 $error3";
	}
}
elseif( isset($_POST['Asignar']) && @$_POST['checkBoxArray'] == NULL )
{
	echo "NO SELECCIONO UNIDADES :(";
}

?>

<form action="ubicacionBloque.php" method="post">
	<p>
		<label>Escribe en el siguiente campo las SERIES a buscar:</label>
	</p>
	<p> 
		<textarea name="celulas" rows="7" cols="40">
		<?php echo @$_POST['celulas']; ?>
		</textarea>
	</p>
	<p>
		<input type="submit" name="search" value="Buscar" />
		<a href='ubicacionBloque.php' style='text-decoration: none;'>
		<input type="button" value="BORRAR" >
		</a>
	</p>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<?php
if (isset($_POST['search'])) {
//	$celulasSC = mysqli_real_escape_string($dbd2, $_POST['celulas']);
//	echo $celulasSC;
	$celulas = trim($_POST['celulas']);
	$celulas = trim(preg_replace('/\s\s+/', '', $celulas));
	$celulas = str_replace(array("\n", "\t", " "),"",$celulas);
	$celulas = mysqli_real_escape_string($dbd2, $celulas);
	$celulas = explode(',', $celulas);

	$query_search = '	SELECT id, Economico, Serie, Vehiculo, Modelo, Color 
						FROM ubicacion WHERE ';
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
	if ($search->num_rows > 0) {

	   echo "<form action='ubicacionBloque.php' method='post'>";
	?>

				<div>
					<table class="ResTabla" >
						<tr>
							<th></th>
							<th></th>
							<th></th>
						</tr>

						 <tr><th>UBICACION CLIENTE</th>
							<td>
							</td>

							<td>
								<input type='text' name='cliente'  >
							</td>
						</tr>

						<tr><th>UBICACION LUGAR</th>
							<td>
							</td>
							<td>
								<input type='text' name='ubicacion' >
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

				<input type='submit'  name='Asignar'  value="Actualizar Ubicación" >

			<?php
			echo '<table id="ResTabla" class="ResTabla" 
					border="1" cellpadding="5" cellspacing="5">';
			echo '<tr>';
				echo "<th><input  id='selectAllBoxes' type='checkbox'   > </th>";
				echo '<th>LISTADO</th>';
				echo '<th>ECONOMICO</th>';
				echo '<th>SERIE</th>';
				echo '<th>VEHICULO</th>';
				echo '<th>MODELO</th>';
				echo '<th>PLACAS</th>';

				echo '<th>UB CLIENTE</th>';
				echo '<th>UB LUGAR</th>';
				echo '<th>UB FECHA</th>';
			echo '</tr>';

			while ($row_searched = $search->fetch_array()) 
			{ 
				$consecutivo++ ;
				echo '<tr>';
				$id_unidad = $row_searched['id'];
				echo "<td><input class='checkBoxes' type='checkbox' 
							name='checkBoxArray[]' 
							value='$id_unidad' 
							id='$id_unidad' > </td>";

				echo '<td>'.$consecutivo.'</td>';
				echo '<td>'.$row_searched['Economico'].'</td>';
				echo '<td>'."<label for='$id_unidad' >".$row_searched['Serie']."</label>".'</td>';
				echo '<td>'.$row_searched['Vehiculo'].'</td>';
				echo '<td>'.$row_searched['Modelo'].'</td>';
				datosxid($id_unidad);
				echo '<td>'."<label for='$id_unidad' >".$Placas."</label>".'</td>';

				ubicacionHistorico($id_unidad);
				if(is_numeric($clienteA))
				{
						contratoxid($clienteA);
						clientexid($id_cliente);
						$clienteA = $razonSocial;
						//$id_contrato = '';
						//$id_cliente = '';
				}
				echo '<td>'.$clienteA.'</td>';
				echo '<td>'.$ubicacionA.'</td>';
				echo '<td>'.$fechaA.'</td>';

				echo '</tr>';
				$id_unidad  = '';
				//$id_cliente = '';
				//$id_contrato = '';
				//$fecha_inicioASG = '';
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