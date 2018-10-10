<?php 
if($_SESSION["clientes"] > 1){ // APERTURA PRIVILEGIOS puede ver archivos
//CONSULTA ARCHIVOS
$sqlARclte = 'SELECT archivo Archivo, tipo Descripcion, obs Detalle, ruta ' 
        . ' FROM '
        . ' clfDto '
        . " WHERE id_cliente = '$id_cliente' 
         	AND id_contrato = 0 
         	ORDER BY fechareg DESC 
         	LIMIT 0, 30 ";
//FIN CONSULTA
$resARclte 		= mysqli_query($dbd2, $sqlARclte);
@$camposARclte 	= mysqli_num_fields($resARclte);
@$filasARclte 	= mysqli_num_rows($resARclte);

echo "<div style='background-color: #d0e1e1; margin:15px; padding: 10px;'>
		<h4>Documentos</h4>";

if( $filasARclte > 0 )
{ // INICIO hay documentos
	echo "\n";
	echo "<div><table class='tablasimple'> 
			<caption>
			<a>Haga click sobre la columna archivo: <b>$filasARclte</b>  
			</a>"; 
	echo "</caption>\n";

	echo "<tr>
			<th>ARCHIVO</th>
			<th>DESCRIPCION</th>
			<th>DETALLE</th>
		  </tr>";

	while($row = mysqli_fetch_assoc($resARclte))
		{
			$d_archivo	= $row['Archivo'];	
			$d_tipo		= $row['Descripcion'];
			$d_detalle	= $row['Detalle'];
			$d_ruta		= $row['ruta'];
			
			echo "<tr>";
			echo "  <td><a href='http://sistema.jetvan.com.mx/$d_ruta/$d_archivo' 
						 target='_blank'>
						 {$d_archivo}
						</a>
					</td>";
			echo "<td>{$d_tipo}</td>";
			echo "<td>{$d_detalle}</td>";
			echo "</tr>";
		}
		echo "</table></div><br/>"; // Cerrar tabla
} // TERMINA hay documentos
else
{
	echo "<h4>No hay documentos del cliente</h4>";
}
echo "</div >";
} // CIERRE PRIVILEGIOS ?>