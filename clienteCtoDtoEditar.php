<?php
include '1header.php';
include ("nav_cliente.php");
echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 1){  // APERTURA PRIVILEGIOS 

@$id_cliente 	= $_POST['id_cliente'];
@$id_contrato 	= $_POST['id_contrato'];
@$id_docto_objetivo	= $_POST['id_docto'];

//echo $id_docto;

if($id_cliente 	== '')	{$id_cliente = $_GET['id_cliente'];}
if($id_contrato == '')	{$id_contrato = $_GET['id_contrato'];}
if($id_docto_objetivo == '')		{$id_docto_objetivo = $_GET['id_docto'];}

//echo $id_docto_objetivo;

include ("clientegral.php");
include ("clientecto1.php");

//echo $id_docto_objetivo;

$actualizado = '';

// INICIO Consultar CONVENIO
$sql_conv = 'SELECT id_docto, archivo, tipo, obs, ruta '
        . ' FROM '
        . ' clfDto '
        . " WHERE id_docto = '$id_docto_objetivo' ";		

$resultado_conv = mysqli_query($dbd2, $sql_conv);
@$campos_conv 	= mysqli_num_fields($resultado_conv);
@$filas_conv 	= mysqli_num_rows($resultado_conv);
// TERMINA Consultar CONVENIO

// INICIO Asignar variables CONVENIO
while($row = mysqli_fetch_assoc($resultado_conv))
	{
		$archivo 	= 	$row['archivo'];
 		$tipo 		= 	$row['tipo'];		
		$obs 		= 	$row['obs'];
		$ruta 		= 	$row['ruta'];
	} 
// TERMINA Asignar variables de CONVENIO

// INICIO Array viejo -- Para Control de Cambios
$arrayviejo =  "id_docto = ".$id_docto_objetivo.",  archivo = ".$archivo.",  tipo = ".$tipo
				.",  obs = ".$obs ;
// TERMINA Array viejo -- Para Control de Cambios

// INICIO Procesar formulario
if (
	isset($_GET['actualizar']) 
//	&& $_GET['id_docto'] !== '' 
	&& $_GET['tipo'] !== '' 
	&& $_GET['obs'] !== '' 
	)
	{
		// INICIO Formatear y limpiar datos
			$tipo 		= 	mysqli_real_escape_string($dbd2, $_GET['tipo']);
			$obs 		= 	mysqli_real_escape_string($dbd2, $_GET['obs']);
		// TERMINA Formatear y limpiar datos

			$capturo 	= $_SESSION["id_usuario"];
		
		// INICIO Update BD
		$sql_conv_up = "UPDATE  `jetvantlc`.`clfDto`  
						SET 
						tipo 		=   '$tipo',  
						obs 		=  '$obs'  
						WHERE id_docto = '$id_docto_objetivo' 
						LIMIT 1 ";
		$res_conv_up = mysqli_query($dbd2, $sql_conv_up);
		// TERMINA Update DB

		if(!$res_conv_up)
		{
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
		}
		else
		{
			// INICIA Control Cambios
			if($res_conv_up)
			{ 
				$sql_up 	= mysqli_real_escape_string($dbd2, $sql_conv_up );
				$arrayviejo = mysqli_real_escape_string($dbd2, $arrayviejo );
						
				$sql_control_cambios = "INSERT INTO jetvantlc.controlcambios  
				(id_cambios,  capturo,  updatequery,  arrayviejo,  fecharegistro) 
				VALUES (NULL,  '$capturo',  '$sql_up',  '$arrayviejo',  CURRENT_TIMESTAMP ) ";
						
				$cambio_registrado = mysqli_query($dbd2, $sql_control_cambios);
				//TERMINA Control Cambios

				echo "<br><h2>ACTUALIZACION DE DATOS DE ARCHIVO EXITOSA</h2><br>";
				include('clienteCtoDto.php');
			}
			$actualizado = 'si';
		}
	}
// TERMINA Procesar formulario	


if ($actualizado == ''){ // INICIA Mostrar Formulario

include('clienteCtoDto.php');

//echo $id_docto;

$tipo1 = '';
$tipo2 = '';
$tipo3 = '';
$tipo4 = '';
$tipo5 = '';

switch($tipo)
	{
	    case "CONTRATO":
       		$tipo1 = 'selected';
       		break;
   		case "POLIZA DE CUMPLIMIENTO":
       		$tipo2 = 'selected';
       		break;
   		case "POLIZA DE CONFIDENCIALIDAD":
      		$tipo3 = 'selected';
       		break;
	    case "POLIZA DE RESPONSABILIDAD CIVIL":
       		$tipo4 = 'selected';
       		break;
       	case "OTRO":
       		$tipo5 = 'selected';
       		break;	
   		default:
        		;
	}


echo "<h2>EDITAR DATOS DE ARCHIVO</h2>";
?>

<fieldset>
<form action="" method="GET">
	<table>
		<tr>
			<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
			<input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">
			<input type="hidden" name="id_docto" value="<?php echo $id_docto_objetivo; ?>">

			<input type="text" name="archivo" value="<?php echo $archivo; ?>" size='100' disabled >

			<p>
				<strong>Tipo*</strong>
				<select 
				value="<?php echo $_POST['tipo'];?>"
				name = "tipo" id=select >
					<option <?php echo $tipo1;?> >CONTRATO</option>
					<option <?php echo $tipo2;?> >POLIZA DE CUMPLIMIENTO</option>
					<option <?php echo $tipo3;?> >POLIZA DE CONFIDENCIALIDAD</option>
					<option <?php echo $tipo4;?> >POLIZA DE RESPONSABILIDAD CIVIL</option>
					<option <?php echo $tipo5;?> >OTRO</option>
				</select>
			</p>
			
			<p>
				<strong>Observaciones*</strong><br />	
				<input 
				type="text" name="obs" size="70" maxlength="200">
				value="<?php echo @$obs;?>" />
			</p>
		</tr>
		<tr>
			<td colspan=2 align=center>
			<INPUT id="gobutton" TYPE="submit" NAME="actualizar" 
			VALUE="Editar DATOS DE ARCHIVO">
			</td>
		</tr>

	</table>
</form>
</fieldset>

<?php };  // TERMINA Mostrar formulario


// VOLVER AL CONTRATO
	echo "<p>
		  <FORM action='ctoIndex.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
		  </FORM>
		</p>";
// VOLVER AL CONTRATO


// BOTON PARA VER LA CLIENTE // IR AL INDEX DE CLIENTE CONSULTADO
    echo "<p>
        <FORM action='clienteindexuno.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
        </FORM>
        </p>";

} // CIERRE PRIVILEGIOS

include ("1footer.php"); ?>