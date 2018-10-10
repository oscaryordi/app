<?php
if($_SESSION["mttos"] > 0){ // APERTURA PRIVILEGIOS puede ver archivos

//CONSULTA ARCHIVOS
$sql_prodoc = 'SELECT archivo Archivo, tipo Descripcion, obs Detalle, ruta ' 
        . ' FROM '
        . ' provDocto '
         . " WHERE id_prov = '$id_prov' ORDER BY fechareg DESC LIMIT 0, 30 ";
//FIN CONSULTA

$resprodoc 		= mysqli_query($dbd2, $sql_prodoc);
@$camposprodoc 	= mysqli_num_fields($resprodoc);
@$filasprodoc 	= mysqli_num_rows($resprodoc);

echo "<fieldset><legend>DOCUMENTOS: <b>$filasprodoc</b></legend>";
echo "\n";
echo "<section><table>"; 
echo "<tr>"; 
echo "</caption>\n"; 

if($_SESSION["mttos"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='provdoctosalta.php?id_prov=<?php echo "$id_prov";?>' >
	<button type='button' title='Subir archivos'>Subir documentos de soporte</button>
	</a>
<?php } // CIERRE PRIVILEGIOS

echo "<tr>
		<th>ARCHIVO</th>
		<th>DESCRIPCION</th>
		<th>DETALLE</th>
	  </tr>";

while($row = mysqli_fetch_assoc($resprodoc)){
	$d_archivo 	= $row['Archivo'];	
	$d_tipo 	= $row['Descripcion'];
	$d_detalle 	= $row['Detalle'];
	$d_ruta 	= $row['ruta'];
	
	echo "<tr>";
	echo "<td><a href='http://sistema.jetvan.com.mx/exp/$d_ruta/$d_archivo' target='_blank'>{$d_archivo}</a></td>";
	echo "<td>{$d_tipo}</td>";
	echo "<td>{$d_detalle}</td>";
//	echo "<td><a href='http://sistema.jetvan.com.mx/exp/$d_ruta/$d_archivo' target='_blank'>
//	<button >&#x2709;</button></a></td>";
	echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";

} // CIERRE PRIVILEGIOS ?>