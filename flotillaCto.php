<?php
include('1header.php');


$id_usuario = $_SESSION["id_usuario"];

tienecontrato($_SESSION["id_usuario"]);
if($miflotilla > 0 OR $_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS puede ver archivos

$id_contrato = $_GET["id_contrato"];

//CONSULTA ARCHIVOS
$sqlARclte = 'SELECT id_docto, archivo Archivo, tipo Descripcion, obs Detalle, ruta ' 
		. ' FROM '
		. ' clfDto '
		 . " WHERE id_contrato = '$id_contrato' AND borrado = 0 AND tipo = 'CONTRATO' ORDER BY fechareg DESC LIMIT 1 ";
//FIN CONSULTA
$resARclte 		= mysqli_query($dbd2, $sqlARclte);
@$camposARclte 	= mysqli_num_fields($resARclte);
@$filasARclte 	= mysqli_num_rows($resARclte);


//$borrarTxtIcon = "<i class='fa fa-trash-o'  style='font-size:16px; color:gray;font-weight: ;'   alt='ELIMINAR' ></i>";


/*
echo "<div style='background-color: #d0e1e1; '><h4>Documentos</h4>";
*/

if( $filasARclte > 0 )
	{ // INICIO hay documentos

/*
	echo "<div><table class='tablasimple'> <caption><a>Haga click sobre la columna archivo: <b>$filasARclte</b>  </a>"; 
	echo "</caption>\n"; 

	echo"<tr>
			<th>ARCHIVO</th>
			<th>DESCRIPCION</th>
			<th>DETALLE</th>
		</tr>";
*/
	while($row = mysqli_fetch_assoc($resARclte))
		{
			$id_docto	= $row['id_docto'];
			$d_archivo	= $row['Archivo'];	
			$d_tipo		= $row['Descripcion'];
			$d_detalle	= $row['Detalle'];
			$d_ruta		= $row['ruta'];

/*
			echo "<tr>";
			echo "<td><a href='http://sistema.jetvan.com.mx/$d_ruta/$d_archivo' target='_blank'>{$d_archivo}</a></td>";
			echo "<td>{$d_tipo}</td>";
			echo "<td>{$d_detalle}</td>";
				// INICIO EDITAR INFORMACION DE POLIZA CUMPLIMIENTO
				if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS	
					echo 	"<td>
							<FORM action='clienteCtoDtoEditar.php' method='POST' id='entabla'>
								<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
								<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'>
								<INPUT TYPE='hidden' NAME='id_docto' VALUE='$id_docto'>
								<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Editar'>
							</FORM>
							</td>";
*/



/*
// INICIA BORRAR ARCHIVO
?>
<script>
var archivoTXT 		= '<?php echo $d_archivo; ?>' 	;
var descripcionTXT 	= '<?php echo $d_tipo; ?>' 		;
var detalleTXT 		= '<?php echo $d_detalle; ?>' 	;
</script>
<?php

		echo "<td style='text-align:center;'>";
		echo "<a 	href='clienteCtoDtoBorrar.php?
					id_docto=$id_docto
					&id_cliente=$id_cliente
					&id_contrato=$id_contrato
					'   
					style='text-decoration:none;'  title='Borrar' ";
?>
					onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO:' 
					+ archivoTXT 
					+ ', DESCRIPCION:' 
					+ descripcionTXT 
					+ ', DETALLE: ' 
					+ detalleTXT);"
<?php	echo "		>
					$borrarTxtIcon 
				</a>
			</td>";
// TERMINA BORRAR ARCHIVO
*/


//				} // CIERRE PRIVILEGIOS	  		
				// TERMINA EDITAR INFORMACION DE POLIZA CUMPLIMIENTO
//			echo "</tr>";
		}
//		echo "</table></div><br/>"; // Cerrar tabla
	} // TERMINA hay documentos
	else 
	{
	echo "<h4>No hay documentos del contrato</h4>";
	}
//echo "</div >";




echo "<iframe src='https://sistema.jetvan.com.mx/$d_ruta/$d_archivo' height='800' width='900'></iframe>";








} // CIERRE PRIVILEGIOS 


include('1footer.php'); ?>