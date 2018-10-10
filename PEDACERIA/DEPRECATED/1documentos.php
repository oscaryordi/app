<?php if($_SESSION["documentos"] > 0){ // APERTURA PRIVILEGIOS puede ver archivos ?>
<?php
echo "<fieldset><legend>Documentos</legend>";
//CONSULTA ARCHIVOS
$sqlAR = 'SELECT archivo Archivo, tipo Descripcion, obs Detalle, ruta ' 
        . ' FROM'
        . ' expedientes'
         . " WHERE economico = '$uNEco' ORDER BY fechareg DESC LIMIT 0, 30 ";
//FIN CONSULTA

$resAR = mysql_query($sqlAR);
@$camposAR = mysql_num_fields($resAR);
@$filasAR = mysql_num_rows($resAR);

echo "\n";
echo "<section><table> <caption><a>Haga&nbspclick&nbspsobre&nbspla columna archivo: <b>$filasAR</b>  </a>"; 
echo "<tr>"; 
echo "</caption>\n"; 
?>

<?php if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='subir_archivos.php?uNEco=<?php echo "$uNEco";?>' ><button type='button' title='Subir archivos'><span style='font-size:1.4em'>&#8613;&#9729;</span>Subir Archivos</button></a>
<?php } // CIERRE PRIVILEGIOS ?>

<?php

echo "<tr>
<th>ARCHIVO</th>
<th>DESCRIPCION</th>
<th>DETALLE</th>
</tr>";

while($row = mysql_fetch_assoc($resAR)){
	$d_archivo = $row['Archivo'];	
	$d_tipo = $row['Descripcion'];
	$d_detalle = $row['Detalle'];
	$d_ruta = $row['ruta'];
	
	echo "<tr>";
	echo "<td><a href='http://www.jetvan.mx/jetvan/exp/$d_ruta/$d_archivo' target='_blank'>{$d_archivo}</a></td>";
	echo "<td>{$d_tipo}</td>";
	echo "<td>{$d_detalle}</td>";
//	echo "<td><a href='http://www.jetvan.mx/jetvan/exp/$d_ruta/$d_archivo' target='_blank'>
//	<button >&#x2709;</button></a></td>";
	echo "</tr>";
}
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";
?>
<?php } // CIERRE PRIVILEGIOS ?>