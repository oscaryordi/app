<?php
include("1header.php");
echo "<meta charset='utf-8'>";

?>
<!--<script src="js/jquery-1.11.2.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!--<script src="js/jquery-ui.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
	$.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '<Ant',
		 nextText: 'Sig>',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'dd/mm/yy',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: ''
		};
	$.datepicker.setDefaults($.datepicker.regional['es']);

	$(function() {
		$( "#expedicion" ).datepicker({changeYear: true, changeMonth: true});
	});
	$(function() {
		$( "#vencimiento" ).datepicker({changeYear: true, changeMonth: true});
	});
	</script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />
<?php

if($_SESSION["documentos"] > 2){  // APERTURA PRIVILEGIOS 

$id_unidad	= $_GET['id_unidad'];
$id_docto	= $_GET['id_docto'];
@$id_errorexp= $_GET['id_errorexp'];

datosxid($id_unidad);

echo "<h2>EDITAR DATOS DE DOCUMENTO</h2>";
echo "<h3>ID en bd 	: ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie 	: ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");

$subido = '';

	if(isset($_POST['Datos']))
	{
		if($_POST['tipo']!='' 
		&& $_POST['tipo']!=0		
	//	&& $_POST['obs']!=''
	//	&& $_POST['foliofactura']!='' 
	//	&& $_POST['importeivainc']!='' 
		)
		{
			$tipo		= mysqli_real_escape_string($dbd2, $_POST['tipo']);
			$obs   		= mysqli_real_escape_string($dbd2, $_POST['obs']);
			$arrayviejo = mysqli_real_escape_string($dbd2, $_POST['arrayviejo']);
			$importeDto = mysqli_real_escape_string($dbd2, $_POST['importeDto']);			
			$capturo 	= $_SESSION["id_usuario"];

			function validateDate($date, $format = 'Y-m-d H:i:s')
				{
					$d = DateTime::createFromFormat($format, $date);
					return $d && $d->format($format) == $date;
				}
			// VALIDA FORMATO DE FECHA
			$expedicion = $_POST['expedicion'];
			if( $expedicion == '' )
				{ $expedicion = null ;}
			elseif( validateDate($expedicion, 'Y-m-d') == true )
				{ ;}
			else
				{ 
					$date 		= str_replace('/', '-', $expedicion);
					$expedicion = date('Y-m-d', strtotime($date));
				}
			$valorExpedicion = ($expedicion == null)? 'NULL' : "'".$expedicion."'" ;	
			// VALIDA FORMATO DE FECHA

			// VALIDA FORMATO DE FECHA
			$vencimiento = $_POST['vencimiento'];
			if( $vencimiento == '' )
				{ $vencimiento = null ;}
			elseif( validateDate($vencimiento, 'Y-m-d') == true )
				{ ;}
			else
				{ 
					$date 			= str_replace('/', '-', $vencimiento);
					$vencimiento 	= date('Y-m-d', strtotime($date));
				}
			$valorVencimiento = ($vencimiento == null)? 'NULL' : "'".$vencimiento."'" ;	
			// VALIDA FORMATO DE FECHA

			// INICIO Registro de error			
			$sql_expED = "	UPDATE `jetvantlc`.`expedientes` SET 
							tipo 		= '$tipo', 
							obs 		= '$obs' ,
							expedicion 	=  $valorExpedicion, 
							vencimiento =  $valorVencimiento,
							importeDto 	=  '$importeDto'
							WHERE id 	= '$id_docto' 
							LIMIT 1 " ; 

			$sql_expED_R = mysqli_query($dbd2, $sql_expED);
			//echo $sql_expError;
				
			if(!$sql_expED_R)
				{
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
				}
			else{
					// INICIA Control Cambios
					if($sql_expED_R)
						{
							$sql_up 	= mysqli_real_escape_string($dbd2, $sql_expED );
							$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
							
							$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
							(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
							VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
							
							$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
							//TERMINA Control Cambios
							
							// INICIA ACTUALIZAR TABLA DE ERRORES REPORTADOS
							if( $id_errorexp!='' && $id_errorexp!= null && $id_errorexp > 0)
								{  // 1 Ed, 2 B, 3 Ca, 4 Np
									$sql_atendido = "UPDATE  expError SET 
									atendido = '$capturo', 
									fechaatnd = CURRENT_TIMESTAMP , 
									accion = '1' 
									WHERE id_errorexp = '$id_errorexp' 
									LIMIT 1 
									";
									$R_sql_atendido = mysqli_query($dbd2, $sql_atendido);
								}
							// TERMINA ACTUALIZAR TABLA DE ERRORES REPORTADOS

							echo "<br><h2>ACTUALIZACION DE DATOS DEL DOCUMENTO EXITOSA</h2><br>";
						}
					$subido = 'ok';
				}
		}
		else
		{	
			echo "<p style='background-color:#FFFF99;'>Escoja un tipo de DOCUMENTO &#9786;</p>";
		}
	}

if($subido!='ok'){ // INICIO Ver formulario
//include ("u7factura.php");

// INICIA Mostrar documento erroeno

echo "<fieldset><legend>Documentos</legend>";
//CONSULTA ARCHIVOS
$sqlAR = 'SELECT id, archivo Archivo, tipo Descripcion, obs Detalle, ruta, 
			expedicion, vencimiento, importeDto ' 
		. ' FROM'
		. ' expedientes'
		. " WHERE id_unidad = '$id_unidad' AND id= '$id_docto' ORDER BY fechareg DESC LIMIT 0, 30 ";
//FIN CONSULTA

$resAR 		= mysqli_query($dbd2, $sqlAR);
@$camposAR 	= mysqli_num_fields($resAR);
@$filasAR 	= mysqli_num_rows($resAR);

echo "\n";
echo "<section><table> <caption><a>Haga&nbspclick&nbspsobre&nbspla columna archivo: <b>$filasAR</b>  </a>"; 
echo "</caption>\n"; 
echo "<tr>";

if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS Subir Archivos?>
	<a href='u9doctoalta.php?id_unidad=<?php echo "$id_unidad";?>' ><button type='button' title='Subir archivos'>Subir Archivos</button></a>
<?php } // CIERRE PRIVILEGIOS Subir Archivos

echo "<tr>
<th>ARCHIVO</th>
<th>DESCRIPCION</th>
<th>DETALLE</th>
</tr>";

while($row = mysqli_fetch_assoc($resAR))
{
	$id_docto   	= $row['id'];
	$d_archivo		= $row['Archivo'];
	$d_expedicion	= $row['expedicion'];
	$d_tipo			= $row['Descripcion']; // poner descripciones segun valor
	$d_tipoclave  	= $row['Descripcion']; // para definir privilegio
	$d_vencimiento	= $row['vencimiento'];
	$d_importeDto	= $row['importeDto'];
	
	switch($d_tipo)
		{
			case "1":
				$d_tipo = 'FACTURA';
				break;
			case "2":
				$d_tipo = 'POLIZA DE SEGURO';
				break;
			case "3":
				$d_tipo = 'TARJETA DE CIRCULACION';
				break;
			case "4":
				$d_tipo = 'VERIFICACION AMBIENTAL';
				break;
			case "5":
				$d_tipo = 'TENENCIA';
				break;
			case "6":
				$d_tipo = 'OTRO';
				break;
			case "7":
				$d_tipo = 'INVENTARIO';
				break;								
			default:
				;
		}

	$d_detalle	= $row['Detalle'];
	$d_ruta		= $row['ruta'];

	// PRIVILEGIOS ESPECIFICOS PARA CADA TIPO DE DOCUMENTO
	$privilegio = 0;	

	if($_SESSION["factura"] > 0 	&& $d_tipoclave == 1 )	{ $privilegio = 1;}
	if($_SESSION["poliza"] > 0  	&& $d_tipoclave == 2  )	{ $privilegio = 1;}
	if($_SESSION["tarjeta"] > 0 	&& $d_tipoclave == 3  )	{ $privilegio = 1;}
	if($_SESSION["verifica"] > 0	&& $d_tipoclave == 4  )	{ $privilegio = 1;}
	if($_SESSION["tenencia"] > 0	&& $d_tipoclave == 5  )	{ $privilegio = 1;}
	if($_SESSION["docotro"] > 0 	&& $d_tipoclave == 6  )	{ $privilegio = 1;}
	if($_SESSION["inventarioE"] 	> 0 && $d_tipoclave == 7 )	{ $privilegio = 1;}	

	if($privilegio == 1)
	{
		echo "<tr>";
		echo "<td><a href='http://sistema.jetvan.com.mx/exp/$d_ruta/$d_archivo' target='_blank'>{$d_archivo}</a></td>";
		echo "<td>{$d_tipo}</td>";
		echo "<td>{$d_detalle}</td>";
		echo "</tr>";
	}
}
echo "</table></section></fieldset>"; // Cerrar tabla

// TERMINA Mostrar documento erroneo

// ARRAY VIEJO PARA CONTROL DE CAMBIOS
$arrayviejo = "tipo = ".$d_tipoclave.", obs = ".$d_detalle.", expedicion = ".$d_expedicion ;
// ARRAY VIEJO PARA CONTROL DE CAMBIOS

?>

<fieldset><legend>Editar datos del documento</legend>
	<div id="form">
		<form action="" method="post" >
			<input type="hidden" name="id_docto" value="<?php echo $id_docto; ?>">
			<input type="hidden" name="id_unidad" value="<?php echo $id_unidad; ?>">
			<input type="hidden" name="arrayviejo" value="<?php echo $arrayviejo; ?>">

			<p><strong>Editar Tipo*</strong>
			<select name = "tipo" >
				<option value='1' <?php if($d_tipoclave == 1){echo "selected";}?> >FACTURA</option>
				<option value='2' <?php if($d_tipoclave == 2){echo "selected";}?> >POLIZA DE SEGURO</option>
				<option value='3' <?php if($d_tipoclave == 3){echo "selected";}?> >TARJETA DE CIRCULACION</option>
				<option value='4' <?php if($d_tipoclave == 4){echo "selected";}?> >VERIFICACION AMBIENTAL</option>
				<option value='5' <?php if($d_tipoclave == 5){echo "selected";}?> >TENENCIA</option>
				<option value='6' <?php if($d_tipoclave == 6){echo "selected";}?> >OTRO</option>
				<option value='7' <?php if($d_tipoclave == 7){echo "selected";}?> >INVENTARIO</option>
			</select></p>

			<p><strong>Editar Observaciones*</strong><br />	
			<input  size="95%" <?php if (isset ($flag) && $_POST['obs']=='') { echo 'class="error"';} 
			else {echo 'class="campo"';} ?> type="text" name="obs" value="<?php echo @$d_detalle;?>" /></p>

			<p><strong>Fecha de Expedición</strong><br />	
				<input type='text' id='expedicion' name='expedicion' 
				value="<?php echo @$d_expedicion;?>"  
				placeholder='dd/mm/aaaa' />
			</p>

			<p><strong>Fecha de Vencimiento</strong><br />	
				<input type='text' id='vencimiento' name='vencimiento' 
				value="<?php echo @$d_vencimiento;?>"  
				placeholder='dd/mm/aaaa'    /> <!-- readonly='true' -->
			</p>

			<p><strong>Monto Documento</strong><br/>
			$<input 
	 			type="number" lang="en-150" step="0.01" min="0"
	 			pattern="[0-9]+([\.,][0-9]+)?" 
				name="importeDto" value="<?php echo @$importeDto; ?>"
				style="text-align: right;" max='100000000' 
				> 0000.00 sin comas
			</p>

			<p><input  type="submit" name="Datos" value="Editar" /></p>
		</form>
	</div> <!-- end form-->
</fieldset>

<?php } // TERMINA Ver formulario

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<br>
			<td>
				<form action='u3index.php' method='POST' id='entabla'>
					<input type='hidden' name='serie' value='$Serie'>
					<input id='gobutton' type='SUBMIT' name='ENVIAR' value='Volver a unidad'>
				</form>
			</td>
		<br>";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>