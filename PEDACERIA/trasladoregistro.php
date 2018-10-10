<?php include("1header.php");?>
<meta charset='utf-8'>
<?php  if($_SESSION["movForaneo"] > 0){  // APERTURA PRIVILEGIOS 

include_once ("base.inc.php");
include_once ("funcion.php");    
    
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

// $arrayviejo = "Proveedor ".$_POST['Proveedor'].", FechaFactura ".$_POST['FechaFactura'].", FolioFactura ".$_POST['FolioFactura'].", importe ".$_POST['importe'];


$subido = ''; 

// FECHA DE MEXICO para utilizarla en lugar de la del servidor
date_default_timezone_set('America/Mexico_city');
// FECHA DE MEXICO para utilizarla en lugar de la del servidor



if(isset($_POST['Datos'])){
	

	if($_POST['id_contrato']!='' 
	&& $_POST['folio_inv']!=''
	&& $_POST['id_prov']!='' 
	&& $_POST['facturaT']!='' )
	{
		
//            $id_unidad      =mysql_real_escape_string($_POST['id_unidad'],$conectar);
            $id_contrato=mysql_real_escape_string($_POST['id_contrato'],$conectar);
            $folio_inv  =mysql_real_escape_string($_POST['folio_inv'],$conectar);
            $id_prov	=mysql_real_escape_string($_POST['id_prov'],$conectar);
            $conductor	=mysql_real_escape_string($_POST['conductor'],$conectar);
            $facturaT	=mysql_real_escape_string($_POST['facturaT'],$conectar);
            $costoT		=mysql_real_escape_string($_POST['costoT'],$conectar);               
            
            $kmO  		=mysql_real_escape_string($_POST['kmO'],$conectar);
            $fechaO  	=mysql_real_escape_string($_POST['fechaO'],$conectar);
            $horaO  	=mysql_real_escape_string($_POST['horaO'],$conectar);
            $callenO  	=mysql_real_escape_string($_POST['callenO'],$conectar);
            $colO  		=mysql_real_escape_string($_POST['colO'],$conectar);
           	$mpioO      =mysql_real_escape_string($_POST['mpioO'],$conectar);
            $estadoO   	=mysql_real_escape_string($_POST['estadoO'],$conectar);
            $entregaNO  =mysql_real_escape_string($_POST['entregaNO'],$conectar);
            $telO  		=mysql_real_escape_string($_POST['telO'],$conectar);

            $kmD  		=mysql_real_escape_string($_POST['kmD'],$conectar);
           	$fechaD  	=mysql_real_escape_string($_POST['fechaD'],$conectar);
            $horaD  	=mysql_real_escape_string($_POST['horaD'],$conectar);
            $callenD  	=mysql_real_escape_string($_POST['callenD'],$conectar);
            $colD  		=mysql_real_escape_string($_POST['colD'],$conectar);
           	$mpioD      =mysql_real_escape_string($_POST['mpioD'],$conectar);
            $estadoD   	=mysql_real_escape_string($_POST['estadoD'],$conectar);
            $recibeND	=mysql_real_escape_string($_POST['recibeND'],$conectar);
            $telD  		=mysql_real_escape_string($_POST['telD'],$conectar);

//			$coma = ',';
//			$importeivainc= str_replace($coma,"",$importeivainc);

			$capturo = $_SESSION["id_usuario"];

			// QUERY CANDADO NO SE DUPLIQUE
				$sql_existe = "SELECT * FROM movimientos_foraneos WHERE folio_inv = '$folio_inv' AND 
				id_prov = '$id_prov' AND 
				id_unidad = '$id_unidad' LIMIT 1 ";

				$sql_existe_resp = mysql_query($sql_existe, $conectar);
			// QUERY CANDADO NO SE DUPLIQUE

				if(mysql_affected_rows() == 0) // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
					{
	

			// INICIA INSERTAR DATOS DE TRASLADO
						$sql_traslado = " INSERT INTO `movimientos_foraneos` 
						(`id_movFor`, `id_contrato`, `id_unidad`, `folio_inv`, 
						`facturaT`, `costoT`, `id_prov`, 
						`kmO`, `fechaO`, `horaO`, `callenO`, `colO`, `mpioO`, `estadoO`, `entregaNO`, `telO`, 
						`kmD`, `fechaD`, `horaD`, `callenD`, `colD`, `mpioD`, `estadoD`, `recibeND`, `telD`, 
						`conductor`, `capturo`  ) VALUES 
						( NULL, '$id_contrato', '$id_unidad', '$folio_inv', 
						'$facturaT', '$costoT', '$id_prov', 
						'$kmO', '$fechaO', '$horaO', '$callenO', '$colO', '$mpioO', '$estadoO', '$entregaNO', '$telO', 
						'$kmD', '$fechaD', '$horaD', '$callenD', '$colD', '$mpioD', '$estadoD', '$recibeND', '$telD', 
						'$conductor', '$capturo' )
						";

			//			echo $sql_traslado;

						$sql_traslado_R = mysql_query($sql_traslado);
			// TERMINA INSERTAR DATOS DE TRASLADO

						if($sql_traslado_R)
						{ 

							echo '<h2>INVENTARIO DE TRASLADO REGISTRADO CORRECTAMENTE</h2>';
							$subido = 'ok'	;				
						}
						else
						{
							echo mysql_errno($conectar) . ": " . mysql_error($conectar) . "\n"; // PARA DETECTAR ERROR EN QUERY
						}


	  				} // CANDADO PARA QUE NO SE DUPLIQUE captura de traslado
	  			else
	  				{
	  					echo "<p>Este traslado con folio $folio_inv ya fue registrado</p>";
	  				}
		
	}
	else
	{
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script >
     $(document).ready(function()
	{

        $('#search13').keyup(function()
		{
         var search13 = $('#search13').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search13:search13},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result13').html(data);
					}
				}
			});
        });

     });
</script>




<?if($subido!='ok'){
?>

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
			<th>ID CONTRATO ALAN</th>
			<td>

				<table>
					<tr>
						<th>BUSCAR</th>
						<th>SELECCIONAR OPCION</th>
					</tr>
					<tr>
						<td>
							<input type='text' id='search13' value="<?php echo @$_POST['id_alan'];?>" name='id_alan'>
						</td>
						<td>
							<div id="result13"></div>
						</td>
					</tr>
				</table>

			</td>
		</tr>
		
		<tr>
			<th>FOLIO INVENTARIO</th>
			<td>
				<input type='text' 
				name='folio_inv' value="<?php echo @$_POST['folio_inv'];?>" placeholder='' required >
			</td>
		</tr>

		<tr>
			<th>FOLIO FACTURA DE TRASLADO</th>
			<td>
				<input type='text' style='text-align: right;'
				name='facturaT' value="<?php echo @$_POST['facturaT'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>COSTO IVA INCLUIDO</th>
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
				name='kmO' value="<?php echo @$_POST['kmO'];?>" placeholder='0000' required >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaO' value="<?php 

				if(isset($_POST['fechaO']) &&  $_POST['fechaO'] != ''){echo @$_POST['fechaO'];} else {echo date("Y-m-d");}


				//echo date("Y-m-d");?><?php //echo @$_POST['fechaO'];?>" placeholder='' required >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaO' value="<?php 

				if(isset($_POST['horaO']) &&  $_POST['horaO'] != ''){echo @$_POST['horaO'];} else {echo date("h:i:s");}


				?>" placeholder='' required >
			</td>
		</tr>

		<tr>
			<th>CALLE Y NUMERO</th>
			<td>
				<input type='text' 
				name='callenO' value="<?php echo @$_POST['callenO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>COLONIA</th>
			<td>
				<input type='text' 
				name='colO' value="<?php echo @$_POST['colO'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>MUNICIPIO</th>
			<td>
				<input type='text' 
				name='mpioO' value="<?php echo @$_POST['mpioO'];?>" placeholder='' required >
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
				name='entregaNO' value="<?php echo @$_POST['entregaNO'];?>" placeholder='' required >
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
				name='kmD' value="<?php echo @$_POST['kmD'];?>" placeholder='0000' required >
			</td>
		</tr>
		
		<tr>
			<th>FECHA</th>
			<td>
				<input type='date' 
				name='fechaD' value="<?php if(isset($_POST['fechaD']) &&  $_POST['fechaD'] != ''){echo @$_POST['fechaD'];} else {echo date("Y-m-d");}?>" placeholder='' required >
			</td>
		</tr>

		<tr>
			<th>HORA</th>
			<td>
				<input type='time' 
				name='horaD' value="<?php 

				if(isset($_POST['horaD']) &&  $_POST['horaD'] != ''){echo @$_POST['horaD'];} else {echo date("h:i:s");}


				?>" placeholder='' required >
			</td>
		</tr>		

		<tr>
			<th>CALLE Y NUMERO</th>
			<td>
				<input type='text' 
				name='callenD' value="<?php echo @$_POST['callenD'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>COLONIA</th>
			<td>
				<input type='text' 
				name='colD' value="<?php echo @$_POST['colD'];?>" placeholder=''  >
			</td>
		</tr>

		<tr>
			<th>MUNICIPIO</th>
			<td>
				<input type='text' 
				name='mpioD' value="<?php echo @$_POST['mpioD'];?>" placeholder='' required >
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
				name='recibeND' value="<?php echo @$_POST['recibeND'];?>" placeholder='' required >
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
<tr><td  colspan=2>

	<table style="width:100%;">
		<tr>
			<td style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Registrar Traslado"> 
			</td>
		</tr>

	</table>

</td></tr>
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