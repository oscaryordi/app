<?php if($_SESSION["documentos"] > 0){ // APERTURA PRIVILEGIOS puede ver archivos ?>
<?php
echo "<fieldset><legend>Documentos</legend>";
//CONSULTA ARCHIVOS
$sqlAR = 'SELECT archivo Archivo, tipo Tipo'
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
// Empezar tabla
// Crear fila
for ($i = 0;$i < $camposAR;$i++) {
    $nombrecampo = mysql_field_name($resAR, $i);
    echo "<th>$nombrecampo</th>";
	} 
	echo "</tr>\n"; // Cerrar fila
while (@$row = mysql_fetch_assoc($resAR)) {
    echo "<tr>"; // Crear fila
    $j=0;
	foreach ($row as $key => $value) {
        $j++;
		if ($j==1){
			echo "<td><a href='http://www.jetvan.mx/jetvan/exp/archivos/$value' target='_blank'> $value&nbsp;</a></td>";
		}else{
			echo "<td><a > $value&nbsp;</a></td>";
		}		
    } 
    echo "</tr>\n"; // Cerrar fila
} 
echo "</table></section>"; // Cerrar tabla
echo "</fieldset>";
?>
<?php } // CIERRE PRIVILEGIOS ?>