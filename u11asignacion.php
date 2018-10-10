<!-- ########### ASIGNACION ########## -->
<?php
if($_SESSION["asigna"] > 0)
{// INICIO PRIVILEGIOS ASIGNA

	// INICIO consulta asignacion ACTUAL
	$sql_asg = 'SELECT * '
		. ' FROM asignaUnidad '
		. " WHERE id_unidad = '$id_unidad' "
		. ' ORDER BY id_asignacion DESC LIMIT 1 ';
	$res_asg 	= mysqli_query($dbd2, $sql_asg);
	$filas_asg 	= mysqli_num_rows($res_asg);

	$id_clienteM;// 	= $row['id_cliente']; 
	$id_contratoM;// 	= $row['id_contrato'];

	if($filas_asg > 0)
	{ // APERTURA ejecutar si hubo algo

		if($_SESSION["filtroFlotilla"] < 2)
		{
		echo "<fieldset><legend>ASIGNACION</legend>";
		echo "<table class='ResTabla'>";
		echo 	"<tr>
					<th>DESDE</th>
					<th>ID CTO A</th>
					<th>CONTRATO</th>
					<th>RFC</th>
					<th>CLIENTE</th>
					<th>PARTIDA</th>
					<th>AREA ADMINISTRATIVA</th>
				</tr>";
		}

		while($row = mysqli_fetch_assoc($res_asg))
		{
			//global $id_cliente;
			//global $id_contrato;

			$id_cliente 	= $row['id_cliente']; 
			$id_contrato 	= $row['id_contrato'];
			$fecha_inicio 	= $row['fecha_inicio'];

			$id_clienteM  	= $row['id_cliente']; 
			$id_contratoM  	= $row['id_contrato'];
			
			$id_partida 	= $row['id_partida'];
			$id_subDiv2 	= $row['id_subDiv2'];

			//echo "<br>$id_cliente<br>";
			//echo "<br>$id_contrato<br>";



			if($_SESSION["filtroFlotilla"] < 2)
			{
				//echo "<br>$id_cliente<br>";
				// sacar rfc y cliente
				clientexid($id_cliente);
				 
				// sacar numero contrato
				//echo "<br>$id_contrato<br>";
				contratoxid($id_contrato);

				// INICIO poner renglon resultados
				echo "<tr>";
				echo "<td>{$fecha_inicio}</td>";
				echo "<td>ID: 
						<b>  
						<a href='ctoIndex.php?id_contrato=$id_contrato' 
						style='text-decoration:none;' title='IR A CONTRATO' >
						=> {$id_alan}
						</a> 
						</b> 
					  </td>";
				echo "<td>{$numero}</td>";
				echo "<td>{$rfc}</td>";
				echo "<td>{$razonSocial}</td>";

				partidaXid_partida($id_partida);
				echo "<td>{$mostrarPDesc}</td>";
				areaAXid_subDiv2($id_subDiv2);
				echo "<td>{$mostrarAAsn2}</td>";

				if($_SESSION["asigna"] > 1){  // VER HISTORICO // APERTURA PRIVILEGIOS 	
				echo "
					<td>
					<a href='asignaHistorico.php?id_unidad=$id_unidad' >
					<button type='button' title='Historico Asignación'>
					Historico Asignación</button></a>
					</td>";
				} // VER HISTORICO // CIERRE PRIVILEGIOS 

			###### INICIO ASIGNAR UNIDAD PARTIDA Y AREA ADVA 
				if($_SESSION["asignaPtdAA"] > 0){ // AUTORIZACION PARA ASIGNAR PARTIDA Y AREA ADVA
					echo "<td>
						<a href='asignaunidadUPAA.php?id_unidad=".$id_unidad."' > 
						<button type='button' title='Asignar Unidad'>
						Asignar Partida y Area Adva
						</button>
						</a>
						</td>\n";
				}
			###### TERMINA ASIGNAR UNIDAD PARTIDA Y AREA ADVA

				if($_SESSION["clientes"] > 0){  // VER HISTORICO // APERTURA PRIVILEGIOS 	
					echo "<td style='color:blue; font-size: 1.5em; text-align: center;'>
							<a href='clienteflotilla.php?id_contrato=$id_contrato' style='text-decoration: none;' title='VER FLOTILLA'>
							FLOTILLA
							</a>
						  </td>";
				} // VER HISTORICO // CIERRE PRIVILEGIOS 

				echo "</tr>";
				// FIN poner renglon resultados
			}
		}
		echo "</table></fieldset>";
	} // CIERRE ejecutar si hubo algo
} // CIERRE PRIVILEGIOS ASIGNA ?>
<!-- ########### ASIGNACION ########## -->