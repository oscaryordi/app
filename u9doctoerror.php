<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["documentos"] > 0){  // APERTURA PRIVILEGIOS

$id_unidad	= $_GET['id_unidad'];
$id_docto	= $_GET['id_docto'];

datosxid($id_unidad);

echo "<h2>REPORTAR DOCUMENTO ERRONEO</h2>";
echo "<h3>ID en bd : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

//$arrayviejo = "Proveedor ".$_GET['Proveedor'].", FechaFactura ".$_GET['FechaFactura'].",
// FolioFactura ".$_GET['FolioFactura'].", importe ".$_GET['importe'];

$subido = '';

	if(isset($_POST['Datos']))
	{
		if($_POST['tipoerror']!='' 
		&& $_POST['tipoerror']!=0		
	//	&& $_POST['obs']!=''
	//	&& $_POST['foliofactura']!='' 
	//	&& $_POST['importeivainc']!='' 
		){
			
	        $tipoerror	=mysqli_real_escape_string($dbd2, $_POST['tipoerror'] );
	        $obs   		=mysqli_real_escape_string($dbd2, $_POST['obs'] );
			$capturo 	= $_SESSION["id_usuario"];
				
			// INICIO Registro de error			
			$sql_expError = "INSERT INTO `jetvantlc`.`expError` 
					(id_errorexp, id_docto, capturo, tipoerror, fecharep, obs) 
					VALUES 
					(NULL, '$id_docto', '$capturo', '$tipoerror', CURRENT_TIMESTAMP , '$obs')" ;

			$sql_expError_R = mysqli_query($dbd2, $sql_expError);
			//echo $sql_expError;
			echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2) . "\n"; // PARA DETECTAR ERROR EN QUERY
				
			if($sql_expError_R)
				{
					echo '<h2>ERROR REPORTADO CORRECTAMENTE</h2>';
					//include ("u7factura.php");
					$subido = 'ok'	;				
				}
		}
		else
		{	
			echo "<p style='background-color:#FFFF99;'>Escoja un tipo de ERROR &#9786;</p>";
		}
	}

if($subido!='ok'){
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
echo "<section><table><caption><a>Haga&nbspclick&nbspsobre&nbspla columna archivo:
		<b>$filasAR</b></a>"; 
echo "</caption>\n"; 

if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='u9doctoalta.php?id_unidad=<?php echo "$id_unidad";?>' >
	<button type='button' title='Subir archivos'>Subir Archivos</button></a>
<?php } // CIERRE PRIVILEGIOS

echo "	<tr>
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

    if($_SESSION["factura"] > 0 	&& $d_tipoclave == 1 ) { $privilegio = 1;}
    if($_SESSION["poliza"] > 0  	&& $d_tipoclave == 2 ) { $privilegio = 1;}
    if($_SESSION["tarjeta"] > 0 	&& $d_tipoclave == 3 ) { $privilegio = 1;}
    if($_SESSION["verifica"] > 0    && $d_tipoclave == 4 ) { $privilegio = 1;}
    if($_SESSION["tenencia"] > 0    && $d_tipoclave == 5 ) { $privilegio = 1;}
    if($_SESSION["docotro"] > 0 	&& $d_tipoclave == 6 ) { $privilegio = 1;}

    if($privilegio == 1)
    {
    	echo "<tr>";
    	echo "<td><a href='http://sistema.jetvan.com.mx/exp/$d_ruta/$d_archivo' target='_blank'>
    			{$d_archivo}</a></td>";
    	echo "<td>{$d_tipo}</td>";
    	echo "<td>{$d_detalle}</td>";
        
        // ERROR reportar permiso documentos 1
        echo "<td><a href='u9doctoerror.php?id_docto=$id_docto&id_unidad=$id_unidad' >
        <button type='button' title='Error'>Reportar error</button></a></td>";
        // EDITAR permisos documentos 3 o 4
        // BORRAR permisos documentos 3 o 4
    	echo "</tr>";
    }
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";
// TERMINA Mostrar documento erroneo

?>
<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<fieldset><legend>REPORTAR DOCUMENTO ERRONEO</legend>
<form id='alta'  action='' method='POST' > 
	<h2>REPORTAR DOCUMENTO ERRONEO</h2>

<table>
	<tr>
		<th>TIPO DE ERROR</th>
		<td>
			<select name = "tipoerror"  >
				  <option value='0'>--</option>
				  <option value='1'>ES DE OTRA UNIDAD</option>
				  <option value='2'>NO ES EL DOCUMENTO DESCRITO</option>
				  <option value='3'>NO ES LEGIBLE</option>
				  <option value='4'>REPETIDO</option>
				  <option value='5'>NO ABRE</option>
				  <option value='6'>OTRO</option>
			</select></p>
		</td>
	</tr>

	<tr>
		<th>OBSERVACIONES</th>
		<td><textarea name='obs' value="<?php echo @$_POST['obs'];?>" ></textarea>
		</td>
	</tr>

	<tr>
	<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Reportar Error"> 
	</td>
	</tr>

</table>
</form>
</fieldset>
<?php }

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<br><td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td><br>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>