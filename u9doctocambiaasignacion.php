<?php
include("1header.php");
echo "<meta charset='utf-8'>";
if($_SESSION["documentos"] > 2){  // APERTURA PRIVILEGIOS
    
$id_unidad	= $_GET['id_unidad'];
$id_docto	= $_GET['id_docto'];
$id_errorexp= $_GET['id_errorexp'];

datosxid($id_unidad);

echo "<h2 style='color:blue;'>CAMBIAR ASIGNACION DE DOCUMENTO</h2>";
echo "<h3>ID en bd 	: ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie 	: ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

$subido = '';

	if(isset($_POST['Datos']))
	{
		if($_POST['id_unidad']!='' 
		&& $_POST['id_unidad']!=0		
		&& $_POST['id_unidad']!= $id_unidad 
	//	&& $_POST['foliofactura']!='' 
	//	&& $_POST['importeivainc']!='' 
		)
		{
	        $id_unidad_nuevo = mysqli_real_escape_string($dbd2, $_POST['id_unidad'] );
			$capturo 		 = $_SESSION["id_usuario"];
				
			echo $id_unidad."<br>";
			echo $id_unidad_nuevo;
			$arrayviejo = "id_unidad anterior = ".$id_unidad;

			// INICIO Registro de error			
			$sql_expEDasgn = "UPDATE `jetvantlc`.`expedientes` 
					SET id_unidad = '$id_unidad_nuevo'  
					WHERE id = '$id_docto' LIMIT 1 " ;

			$sql_expEDasgn_R = mysqli_query($dbd2, $sql_expEDasgn);
			//echo $sql_expError;
			// PARA DETECTAR ERROR EN QUERY

			if(!$sql_expEDasgn_R)
				{
					echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). "\n";
				}
			else{
					// INICIA Control Cambios
					if($sql_expEDasgn_R)
						{
							$sql_up 	= mysqli_real_escape_string($dbd2, $sql_expEDasgn );
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
									accion = '3' 
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
			echo "<p style='background-color:#FFFF99;'>Elija un vehiculo. No puede ser el mismo &#9786; .</p>";
		}
	}

if($subido!='ok'){ // INICIO Ver formulario
//include ("u7factura.php");

// INICIA Mostrar documento erroeno

//CONSULTA ARCHIVOS
$sqlAR = 'SELECT id, archivo Archivo, tipo Descripcion, obs Detalle, ruta ' 
        . ' FROM'
        . ' expedientes'
        . " WHERE id_unidad = '$id_unidad' 
        	AND id= '$id_docto' 
        	ORDER BY fechareg DESC 
        	LIMIT 0, 30 ";
//FIN CONSULTA

$resAR 		= mysqli_query($dbd2, $sqlAR);
@$camposAR 	= mysqli_num_fields($resAR);
@$filasAR 	= mysqli_num_rows($resAR);

echo "<fieldset><legend>Documentos</legend>";
echo "<section><table> <caption><a>Haga&nbspclick&nbspsobre&nbspla columna archivo: 
	  <b>$filasAR</b>  </a>"; 
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
	$id_docto   = $row['id'];
    $d_archivo	= $row['Archivo'];	
	$d_tipo		= $row['Descripcion']; // poner descripciones segun valor
    $d_tipoclave  = $row['Descripcion']; // para definir privilegio
    
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
    		default:
        		;
		}

	$d_detalle	= $row['Detalle'];
	$d_ruta		= $row['ruta'];

    // PRIVILEGIOS ESPECIFICOS PARA CADA TIPO DE DOCUMENTO
    $privilegio = 0;    

    if($_SESSION["factura"] > 0 	&& $d_tipoclave == 1  ){ $privilegio = 1;}
    if($_SESSION["poliza"] > 0  	&& $d_tipoclave == 2  ){ $privilegio = 1;}
    if($_SESSION["tarjeta"] > 0 	&& $d_tipoclave == 3  ){ $privilegio = 1;}
    if($_SESSION["verifica"] > 0 	&& $d_tipoclave == 4  ){ $privilegio = 1;}
    if($_SESSION["tenencia"] > 0 	&& $d_tipoclave == 5  ){ $privilegio = 1;}
    if($_SESSION["docotro"] > 0 	&& $d_tipoclave == 6  ){ $privilegio = 1;}

    if($privilegio == 1)
    {
    	echo "<tr>";
    	echo "<td><a href='http://sistema.jetvan.com.mx/exp/$d_ruta/$d_archivo' target='_blank'>
    			{$d_archivo}</a></td>";
    	echo "<td>{$d_tipo}</td>";
    	echo "<td>{$d_detalle}</td>";
     	echo "</tr>";
    }
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";
// TERMINA Mostrar documento erroneo

// ARRAY VIEJO PARA CONTROL DE CAMBIOS
$arrayviejo = "tipo = ".$d_tipoclave.", obs = ".$d_detalle ;
// ARRAY VIEJO PARA CONTROL DE CAMBIOS

?>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
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
				url:'asignasearch.php',
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
     });
</script>
<?php // FECHA DE MEXICO

date_default_timezone_set('America/Mexico_city');

?>
<form id='alta'  action='' method='POST' > 
	<h3 style='color:blue;' >ASIGNAR DOCUMENTO A UNIDAD QUE REALMENTE CORRESPONDE</h3>
	<table>
		<tr>
			<td></td>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<th>SERIE DE UNIDAD VEHICULAR</th>
			<td>
				<input type='text' id='search1'>
			</td>
			<td>
				<div id="result1"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Asignar Documento a esta Unidad"> 
			</td>
		</tr>
	</table>
</form>
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