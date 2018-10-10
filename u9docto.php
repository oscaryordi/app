<?php 
if($_SESSION["documentos"] > 0){ // APERTURA PRIVILEGIOS puede ver archivos 

//CONSULTA ARCHIVOS
$sqlAR = '  SELECT id, archivo Archivo, tipo Descripcion, obs Detalle, ruta, 
			expedicion, vencimiento, importeDto ' 
		. ' FROM '
		. ' expedientes '
		. " WHERE id_unidad = '$id_unidad' "
		. " AND borrar = 0 "
		. " ORDER BY Descripcion ASC, "
		. "	expedicion DESC, "
		. "	fechareg DESC "
		. "	LIMIT 0, 30 ";
//FIN CONSULTA

$resAR		= mysqli_query($dbd2, $sqlAR);
@$camposAR	= mysqli_num_fields($resAR);
@$filasAR	= mysqli_num_rows($resAR);

echo "<fieldset><legend>Documentos</legend>";
echo "<section><table class='ResTabla'>
		<caption>
		<a>
		Haga&nbspclick&nbspsobre&nbspla columna archivo: <b>$filasAR</b>  
		</a>
		</caption>"; 

if($_SESSION["documentos"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='u9doctoalta.php?id_unidad=<?php echo "$id_unidad";?>' >
	<button type='button' title='Subir archivos'>Subir Archivos</button></a>
<?php } // CIERRE PRIVILEGIOS 

echo "<tr>
<th>ARCHIVO</th>
<th>DESCRIPCION</th>
<th>EXPEDICION</th>
<th>VENCIMIENTO</th>
<th>IMPORTE</th>
<th>DETALLE</th>
</tr>";

while($row = mysqli_fetch_assoc($resAR))
{
	$id_docto   = $row['id'];
	$d_archivo	= $row['Archivo'];	
	$d_tipo		= $row['Descripcion']; // poner descripciones segun valor
	$d_tipoclave  = $row['Descripcion']; // para definir privilegio
	
	$expedicion  = $row['expedicion'];
	$vencimiento = $row['vencimiento'];
	$importeDto  = $row['importeDto'];

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
	if($_SESSION["factura"] 	> 0 && $d_tipoclave == 1 ){ $privilegio = 1;}
	if($_SESSION["poliza"] 		> 0 && $d_tipoclave == 2 ){ $privilegio = 1;}
	if($_SESSION["tarjeta"] 	> 0 && $d_tipoclave == 3 ){ $privilegio = 1;}
	if($_SESSION["verifica"] 	> 0 && $d_tipoclave == 4 ){ $privilegio = 1;}
	if($_SESSION["tenencia"] 	> 0 && $d_tipoclave == 5 ){ $privilegio = 1;}
	if($_SESSION["docotro"] 	> 0 && $d_tipoclave == 6 ){ $privilegio = 1;}
	if($_SESSION["inventarioE"] 	> 0 && $d_tipoclave == 7 ){ $privilegio = 1;}

	if($privilegio == 1)
	{
		echo "<tr>";
		echo "<td><a href='../exp/$d_ruta/$d_archivo' target='_blank'>{$d_archivo}</a></td>"; 
		// echo "<td><a href='http://sistema.jetvan.com.mx/exp/$d_ruta/$d_archivo' target='_blank'>{$d_archivo}</a></td>"; 
		echo "<td>{$d_tipo}</td>";
		echo "<td>{$expedicion}</td>";
		echo "<td>{$vencimiento}</td>";
		echo "<td>".number_format($importeDto,2)."</td>";
		echo "<td>{$d_detalle}</td>";

		// ERROR REPORTAR
		echo "<td><a href='u9doctoerror.php?id_docto=$id_docto&id_unidad=$id_unidad' >
		<button type='button' title='Reportar Error'>Re</button></a></td>";

	// EDITAR
	if($_SESSION["documentos"] > 2)
		{ // INICIO privilegio editar
			echo "<td><a href='u9doctoeditar.php?id_docto=$id_docto&id_unidad=$id_unidad' >
			<button type='button' title='Editar'>Ed</button></a></td>";
		} // TERMINA privilegio editar

	$id_usuario = $_SESSION["id_usuario"];

	// BORRAR
	if($_SESSION["documentos"] > 2) // INICIO privilegio borrar
		{
		echo "<td>
				<form action='u9doctoborrar.php' method='post'>
				<input type='hidden' value='$id_docto' name='id_docto'>
				<input type='hidden' value='$id_unidad' name='id_unidad'>
				<input type='hidden' value='$id_usuario' name='id_usuario'>";
		  ?>
				<a onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO'); " >
		  <?php
		echo "		
				<input type='submit' value='B' name='borrar' title='Borrar' >
				</a>
				</form>
			</td>";
		}// TERMINA privilegio borrar

	// CAMBIAR ASIGNACION
	if($_SESSION["documentos"] > 2)
		{ // INICIO privilegio CAMBIAR ASIGNACION
			echo "<td><a href='u9doctocambiaasignacion.php?id_docto=$id_docto&id_unidad=$id_unidad' >
			<button type='button' title='Cambiar Asignación del Documento'>Ca</button></a></td>";
		} // TERMINA privilegio CAMBIAR ASIGNACION

		echo "</tr>";
	}
}
echo "</table></section></fieldset>"; // Cerrar tabla
} // CIERRE PRIVILEGIOS ?>