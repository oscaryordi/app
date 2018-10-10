<?php include("1header.php");?>
<meta charset='utf-8'>
<?php  if($_SESSION["movForaneo"] > 0){  // APERTURA PRIVILEGIOS 

include_once ("base.inc.php");
include_once ("funcion.php");	
	
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

?>
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

		<td style='background-color: #d2e0e0 ;'>
			<table >
				<tr style='background-color: #d2e0e0 ;'><td></td><td><b>CONSULTAR CLIENTE</b></td><td><b>RESULTADO</b></td></tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Nombre</td>
					<td><input type='text' id='search19'></td>
					<td><div id="result19"></div></td>
				</tr>
				<tr style='background-color: #d2e0e0 ;'>
					<td>Por Alias</td>
					<td><input type='text' id='search20'></td>
					<td><div id="result20"></td></tr>
			</table>
		</td>

	</tr>
</table>
<?php	

$subido = ''; 

// FECHA DE MEXICO para utilizarla en lugar de la del servidor
date_default_timezone_set('America/Mexico_city');
// FECHA DE MEXICO para utilizarla en lugar de la del servidor



if(isset($_POST['Datos'])){
	
	// MENSAJES DE ERROR
	$error1 = '';
//	if(isset($_POST['id_cliente']) && $_POST['id_cliente'] != 0 ){;}else{$error1 = ':: No indico cliente';}
	$error2 = '';
//	if(isset($_POST['id_contrato']) && $_POST['id_contrato'] != 0){;}else{$error2 = ':: No indico contrato';}
	$error3 = '';
	if($_POST['id_prov']!= 0 ){;}else{$error3= ':: No indico proveedor';}
	$error4 = '';
	if($_POST['estadoO']!= 0 ){;}else{$error4= ':: No indico Estado de Origen';}
	$error5 = '';
	if($_POST['estadoD']!= 0 ){;}else{$error5= ':: No indico Estado de Destino';}
	$error6 = '';
	if($_POST['domicilioD']!= '' ){;}else{$error6= ':: No indico Domicilio de Destino';}
	// MENSAJES DE ERROR

	$errorES = $error1.$error2.$error3.$error4.$error5.$error6;

	if(
		$errorES == '' 
//		$_POST['id_contrato']!='' 
//		&& $_POST['folio_inv']!=''
//		&& $_POST['id_prov']!='' 
//		&& $_POST['facturaT']!='' 
	)
	{
		
//			$id_unidad	  =mysql_real_escape_string($_POST['id_unidad'],$conectar);
			@$id_cliente	=mysql_real_escape_string($_POST['id_cliente'],$conectar);
			@$id_contrato=mysql_real_escape_string($_POST['id_contrato'],$conectar);
			$folio_inv  =mysql_real_escape_string($_POST['folio_inv'],$conectar);
			$facturaT	=mysql_real_escape_string($_POST['facturaT'],$conectar);
			$costoT		=mysql_real_escape_string($_POST['costoT'],$conectar);

			@$id_clienteD	=mysql_real_escape_string($_POST['id_clienteD'],$conectar);
			@$id_contratoD=mysql_real_escape_string($_POST['id_contratoD'],$conectar);

			@$aliasEmergente		=strtoupper(mysql_real_escape_string($_POST['aliasEmergente'],$conectar));

			$id_prov	=mysql_real_escape_string($_POST['id_prov'],$conectar);
			$conductor	=mysql_real_escape_string($_POST['conductor'],$conectar);

			$kmO  		=mysql_real_escape_string($_POST['kmO'],$conectar);
			$fechaO  	=mysql_real_escape_string($_POST['fechaO'],$conectar);
			$horaO  	=mysql_real_escape_string($_POST['horaO'],$conectar);
			$domicilioO =strtoupper(mysql_real_escape_string($_POST['domicilioO'],$conectar)) ;
			$estadoO   	=mysql_real_escape_string($_POST['estadoO'],$conectar);
			$entregaNO  =strtoupper(mysql_real_escape_string($_POST['entregaNO'],$conectar)) ;
			$telO  		=mysql_real_escape_string($_POST['telO'],$conectar);

			$kmD  		=mysql_real_escape_string($_POST['kmD'],$conectar);
			$fechaD  	=mysql_real_escape_string($_POST['fechaD'],$conectar);
			$horaD  	=mysql_real_escape_string($_POST['horaD'],$conectar);
			$domicilioD =strtoupper(mysql_real_escape_string($_POST['domicilioD'],$conectar)) ;
			$estadoD   	=mysql_real_escape_string($_POST['estadoD'],$conectar);
			$recibeND	=strtoupper(mysql_real_escape_string($_POST['recibeND'],$conectar)) ;
			$telD  		=mysql_real_escape_string($_POST['telD'],$conectar);

			@$falso  	=mysql_real_escape_string($_POST['falso'],$conectar);
			@$observaciones  	=strtoupper(mysql_real_escape_string($_POST['observaciones'],$conectar));


/*			if(isset($falso)){
			$falso  	=mysql_real_escape_string($_POST['falso'],$conectar);
			}
			else{
				$falso  	= 0 ;
			}
*/
/*
				echo "<hr>".$id_unidad."<br>";

				echo "<hr>".$id_cliente."<br>";
				echo $id_contrato."<br>";
				echo $folio_inv."<br>";
				echo $facturaT."<br>";
				echo $costoT."<br>";
				echo $id_prov."<br>";
				echo $conductor."<br><hr>";

				echo $kmO."<br>";
				echo $fechaO."<br>";
				echo $horaO."<br>";
				echo $domicilioO."<br>";
				echo $estadoO."<br>";
				echo $entregaNO."<br>";
				echo $telO."<br><hr>";

				echo $kmD."<br>";
				echo $fechaD."<br>";
				echo $horaD."<br>";
				echo $domicilioD."<br>";
				echo $estadoD."<br>";
				echo $recibeND."<br>";
				echo $telD."<br><hr>";


*/
				echo $falso."<br><hr>";

//			$coma = ',';
//			$importeivainc= str_replace($coma,"",$importeivainc);

			$capturo = $_SESSION["id_usuario"];

			// QUERY CANDADO NO SE DUPLIQUE
				$sql_existe = "SELECT * FROM mov_traslados 
				WHERE 
				folio_inv = '$folio_inv' 
				AND 
				id_cliente = '$id_cliente' 
				AND 
				id_prov = '$id_prov' 
				AND 
				id_unidad = '$id_unidad' 
				AND 
				fechaO = '$fechaO' 
				AND 
				domicilioD = '$domicilioD' 
				AND 
				fechaD = '$fechaD' 
				AND 
				horaD = '$horaD' 
				LIMIT 1 ";
				$sql_existe_resp = mysql_query($sql_existe, $conectar);
				if(mysql_affected_rows() > 0){
					$matrizE 	= mysql_fetch_array($sql_existe_resp);
					$id_movFor 	= $matrizE['id_movFor'];
				}
			// QUERY CANDADO NO SE DUPLIQUE

				if(mysql_affected_rows() == 0) // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
					{
						// INICIA INSERTAR DATOS DE TRASLADO
						$sql_traslado = " INSERT INTO `mov_traslados` 
						(`id_movFor`, `id_cliente`,`id_contrato`, `id_clienteD`,`id_contratoD`, 

						aliasEmergente, `id_unidad`, `folio_inv`, 
						`facturaT`, `costoT`, `id_prov`, 
						`kmO`, `fechaO`, `horaO`, domicilioO, `estadoO`, `entregaNO`, `telO`, 
						`kmD`, `fechaD`, `horaD`, domicilioD, `estadoD`, `recibeND`, `telD`, 
						`conductor`, `capturo`, falso, obs  ) VALUES 
						( NULL, '$id_cliente', '$id_contrato', '$id_clienteD', '$id_contratoD', 

						'$aliasEmergente','$id_unidad', '$folio_inv', 
						'$facturaT', '$costoT', '$id_prov', 
						'$kmO', '$fechaO', '$horaO', '$domicilioO', '$estadoO', '$entregaNO', '$telO', 
						'$kmD', '$fechaD', '$horaD', '$domicilioD', '$estadoD', '$recibeND', '$telD', 
						'$conductor', '$capturo', '$falso', '$observaciones' )
						";
						//echo $sql_traslado;
						$sql_traslado_R = mysql_query($sql_traslado);
						$id_movForR 	= mysql_insert_id(); // OBTIENE EL ID DE ESTA QUERY REALIZADA
						// TERMINA INSERTAR DATOS DE TRASLADO

						if($sql_traslado_R)
						{ 
							echo "<h2>INVENTARIO DE TRASLADO REGISTRADO CORRECTAMENTE, BD: $id_movForR </h2>";
							$subido = 'ok'	;
							include('trasladoRegistrado.php');
						}
						else
						{
							echo mysql_errno($conectar) . ": " . mysql_error($conectar) . "\n"; // PARA DETECTAR ERROR EN QUERY
						}
	  				} // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
	  			else
	  				{
	  					echo "<p>Este traslado con folio $folio_inv ya fue registrado ::: BD-> $id_movFor :::</p>";
	  				}
	}
	else
	{
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; $errorES </p>";
	}
}

?>


<?if($subido!='ok'){
?>

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


		$('#search22').keyup(function()
		{
		 var search22 = $('#search22').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search22:search22},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result22').html(data);
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
 
 function buscaContratosD()
		{
		 var search23 = $('#search23').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search23:search23},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result23').html(data);
					}
				}
			});
		};

</script>




<fieldset><legend>Registrar Traslado</legend>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>REGISTRAR TRASLADO</h2>



<table id='tablaformato' >
<tr><td colspan=2>

<?php // INICIA BLOQUE DATOS GENERALES ?>

<table style="width:100%;">
		<tr>
			<th>RFC CLIENTE <span style="color:orange;">ORIGEN</span><br>
				<input type='text' id='search5'>
			</th>

			<td style='max-width: 200px;'>
					<div id="result5"></div>
			</td>
		</tr>
		<tr>
			<th style="height: 20px;">CONTRATO <span style="color:orange;">ORIGEN</span>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
			</th>
			<td>
					<div id="result6"></div>
			</td>
		</tr>

		<tr style="background-color: #ffe7b3;">
			<th>RFC CLIENTE  <span style="color:#d0e1e1;">DESTINO</span><br>
				<input type='text' id='search22'>
			</th>

			<td style='max-width: 200px;'>
					<div id="result22"></div>
			</td>
		</tr>
		<tr style="background-color: #ffe7b3;">
			<th style="height: 20px;">CONTRATO <span style="color:#d0e1e1;">DESTINO</span>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
			</th>
			<td>
					<div id="result23"></div>
			</td>
		</tr>


<!-- 
		<tr>
			<th style="height: 20px;">ALIAS CONTRATO NO ENCONTRADO
			</th>
			<td>
				<input type='text' 
				name='aliasEmergente' value="<?php echo @$_POST['aliasEmergente'];?>" placeholder=''  >
			</td>
		</tr> 
-->		
		<tr>
			<th>FOLIO INVENTARIO</th>
			<td>
				<input type='text' 
				name='folio_inv' value="<?php echo @$_POST['folio_inv'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>FOLIO FACTURA</th>
			<td>
				<input type='text' style='text-align: right;'
				name='facturaT' value="<?php echo @$_POST['facturaT'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>COSTO A/I</th>
			<td>
				<input type="number" lang="nb" step=".01" min="0"  style='text-align: right;' 
				name='costoT' value="<?php echo @$_POST['costoT'];?>" placeholder='0.00'  >
			</td>
		</tr>

		<tr>
			<th>PROVEEDOR DEL TRASLADO</th>
			<td>
		
				<select name = 'id_prov' >
					<option value = '0' >---</option>
					<option value = '1' >FENIX SERVICIOS DE TRASLADOS, S.A. DE C.V.</option>
					<option value = '2' >TRASLADOS PREMIER, S.A. DE C.V.</option>
					<option value = '3' >VITAL TRASLADO AUTOMOTRIZ, S.A. DE C.V.</option>
					<option value = '4' >JET VAN CAR RENTAL, S.A. DE C.V.</option>
				</select>

			</td>
		</tr>

		<tr>
			<th>CONDUCTOR</th>
			<td>
				<input type='text' 
				name='conductor' value="<?php echo @$_POST['conductor'];?>" placeholder=''  >
			</td>
		</tr>

</table>

<?php // TERMINA BLOQUE DATOS GENERALES ?>

</td></tr>
<tr><td>



<?php // INICIA BLOQUE DATOS ORIGEN ?>
<table>
		<tr><th colspan=2>ORIGEN</th></tr>
		<tr>
			<th>KILOMETRAJE</th>
			<td>
				<input type="number" lang="nb" step="1" min="0" 
				name='kmO' value="<?php echo @$_POST['kmO'];?>" placeholder='0000'  >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaO' value="<?php 

				if(isset($_POST['fechaO']) &&  $_POST['fechaO'] != ''){echo @$_POST['fechaO'];} else {echo date("Y-m-d");}


				//echo date("Y-m-d");?><?php //echo @$_POST['fechaO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaO' value="<?php 

				if(isset($_POST['horaO']) &&  $_POST['horaO'] != ''){echo @$_POST['horaO'];} else {echo "12:00:00";}
//echo date("h:i:s");

				?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>DOMICILIO SALIDA</th>
			<td>
				<input type='text' 
				name='domicilioO' value="<?php echo @$_POST['domicilioO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>ESTADO</th>
			<td>
				<select name = 'estadoO' >
					<option value = '0' >---</option>
					<option value = '1' >Aguascalientes</option>
					<option value = '2' >Baja California</option>
					<option value = '3' >Baja California Sur</option>
					<option value = '4' >Campeche</option>
					<option value = '5' >Chiapas</option>
					<option value = '6' >Chihuahua</option>
					<option value = '7' >Ciudad de México</option>
					<option value = '8' >Coahuila de Zaragoza</option>
					<option value = '9' >Colima</option>
					<option value = '10' >Durango</option>
					<option value = '11' >Estado de México</option>
					<option value = '12' >Guanajuato</option>
					<option value = '13' >Guerrero</option>
					<option value = '14' >Hidalgo</option>
					<option value = '15' >Jalisco</option>
					<option value = '16' >Michoacán de Ocampo</option>
					<option value = '17' >Morelos</option>
					<option value = '18' >Nayarit</option>
					<option value = '19' >Nuevo León</option>
					<option value = '20' >Oaxaca</option>
					<option value = '21' >Puebla</option>
					<option value = '22' >Querétaro</option>
					<option value = '23' >Quintana Roo</option>
					<option value = '24' >San Luis Potosí</option>
					<option value = '25' >Sinaloa</option>
					<option value = '26' >Sonora</option>
					<option value = '27' >Tabasco</option>
					<option value = '28' >Tamaulipas</option>
					<option value = '29' >Tlaxcala</option>
					<option value = '30' >Veracruz de Ignacio de la Llave</option>
					<option value = '31' >Yucatán</option>
					<option value = '32' >Zacatecas</option>
				</select>
			</td>
		</tr>

		<tr>
			<th>PERSONA QUE ENTREGA</th>
			<td>
				<input type='text' 
				name='entregaNO' value="<?php echo @$_POST['entregaNO'];?>" placeholder='' >
			</td>
		</tr>

		<tr>
			<th>TELEFONO</th>
			<td>
				<input type='text' 
				name='telO' value="<?php echo @$_POST['telO'];?>" placeholder=''  >
			</td>
		</tr>
</table>
<?php // TERMINA BLOQUE DATOS ORIGEN ?>


</td><td>


<?php // INICIA BLOQUE DATOS DESTINO  ?>
<table>
		<tr><th colspan=2>DESTINO</th></tr>
		<tr>
			<th>KILOMETRAJE</th>
			<td>
				<input type="number" lang="nb" step="1" min="0" 
				name='kmD' value="<?php echo @$_POST['kmD'];?>" placeholder='0000'  >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaD' value="<?php if(isset($_POST['fechaD']) &&  $_POST['fechaD'] != ''){echo @$_POST['fechaD'];} else {echo date("Y-m-d");}?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaD' value="<?php 

				if(isset($_POST['horaD']) &&  $_POST['horaD'] != ''){echo @$_POST['horaD'];} else {echo "12:00:00";}


				?>" placeholder=''  >
			</td>
		</tr>		

		<tr>
			<th>DOMICILIO LLEGADA</th>
			<td>
				<input type='text' 
				name='domicilioD' value="<?php echo @$_POST['domicilioD'];?>" placeholder=''   >
			</td>
		</tr>

		<tr>
			<th>ESTADO</th>
			<td>
				<select name = 'estadoD' >
					<option value = '0' >---</option>
					<option value = '1' >Aguascalientes</option>
					<option value = '2' >Baja California</option>
					<option value = '3' >Baja California Sur</option>
					<option value = '4' >Campeche</option>
					<option value = '5' >Chiapas</option>
					<option value = '6' >Chihuahua</option>
					<option value = '7' >Ciudad de México</option>
					<option value = '8' >Coahuila de Zaragoza</option>
					<option value = '9' >Colima</option>
					<option value = '10' >Durango</option>
					<option value = '11' >Estado de México</option>
					<option value = '12' >Guanajuato</option>
					<option value = '13' >Guerrero</option>
					<option value = '14' >Hidalgo</option>
					<option value = '15' >Jalisco</option>
					<option value = '16' >Michoacán de Ocampo</option>
					<option value = '17' >Morelos</option>
					<option value = '18' >Nayarit</option>
					<option value = '19' >Nuevo León</option>
					<option value = '20' >Oaxaca</option>
					<option value = '21' >Puebla</option>
					<option value = '22' >Querétaro</option>
					<option value = '23' >Quintana Roo</option>
					<option value = '24' >San Luis Potosí</option>
					<option value = '25' >Sinaloa</option>
					<option value = '26' >Sonora</option>
					<option value = '27' >Tabasco</option>
					<option value = '28' >Tamaulipas</option>
					<option value = '29' >Tlaxcala</option>
					<option value = '30' >Veracruz de Ignacio de la Llave</option>
					<option value = '31' >Yucatán</option>
					<option value = '32' >Zacatecas</option>
				</select>
			</td>
		</tr>

		<tr>
			<th>PERSONA QUE RECIBE</th>
			<td>
				<input type='text' 
				name='recibeND' value="<?php echo @$_POST['recibeND'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>TELEFONO</th>
			<td>
				<input type='text' 
				name='telD' value="<?php echo @$_POST['telD'];?>" placeholder=''  >
			</td>
		</tr>
</table>
<?php // TERMINA BLOQUE DATOS DESTINO  ?>

</td></tr>




<tr>	
	<td colspan="2">
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id='falso' type="checkbox" name="falso" value="1">
					<label for='falso'><b>REGISTRAR FALSO</b></label> 
				</td>
				<td>
				<b>OBSERVACIONES</b>
				</td>
				<td>
				<input type='text' 
				name='observaciones' value="<?php echo @$_POST['observaciones'];?>" placeholder='' maxlength='100'  >
				</td>
			</tr>
		</table>
	</td>
</tr>


<tr>
	<td  colspan=2>
		<table style="width:100%;">
			<tr>
				<td style="text-align:center;" >
					<input id="gobutton2" type="submit" name="Datos" value="Registrar Traslado"> 
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>



</form>
</fieldset>

<?php } 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<br><table><tr><td>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</td></tr></table><br>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA ?

} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>