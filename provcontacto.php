<!--DATOS BANCARIOS DE  PROVEEDOR-->
<?php
$sql_pc = 'SELECT id_contacto, nombre, correo, telefono, extension '
        . ' FROM '
        . ' provContacto '
        . " WHERE id_prov = '$id_prov' ";

$resultado_pc 	= mysqli_query($dbd2, $sql_pc);
@$campos_pc 	= mysqli_num_fields($resultado_pc);
@$filas_pc 		= mysqli_num_rows($resultado_pc);

echo "<section>
		<fieldset>
		<legend>CONTACTO: <b>$filas_pc</b></legend>
		<table>"; 
echo ""; 

if($_SESSION["mttos"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='provcontactoalta.php?id_prov=<?php echo "$id_prov";?>' >
	<button type='button' title='Alta cuenta'>Registrar nuevo contacto</button>
	</a>
<?php } // CIERRE PRIVILEGIOS


echo "<tr>
		<th>NOMBRE</th>
		<th>CORREO</th>
		<th>TELEFONO</th>
	  </tr>";

	while($row = mysqli_fetch_assoc($resultado_pc))
	{
		$id_contacto = 	$row['id_contacto'];	
		$nombre 	= 	$row['nombre'];	
		$correo 	= 	$row['correo'];
		$telefono 	= 	$row['telefono'];
		$extension 	= 	$row['extension'];
		
		echo "<tr>";
		echo "<td>{$nombre}</td>";
		echo "<td>{$correo}</td>";
		echo "<td>{$telefono}</td>";
		echo "<td>{$extension}</td>";

		if($_SESSION["proveedores"] > 0)
		{
		echo "<td>
				<a href='provcontactoEdit.php?id_contacto=$id_contacto' >
					<button type='button' title='Editar Contacto'>Editar</button>
				</a>
			  </td>";
		}

		echo "</tr>";
	}
echo "</table>
	</fieldset>
	</section>"; // Cerrar tabla
?>
<!--DATOS BANCARIOS DE  PROVEEDOR-->