<!-- SUCURSAL DE  PROVEEDOR -->
<?php
$sql_ps = 'SELECT id_sucursal, nombreSucursal, calleNumero, colonia, municipio, estado, cp '
        . ' FROM '
        . ' provSucursal '
        . " WHERE id_prov = '$id_prov' ";		

$resultado_ps 	= mysqli_query($dbd2, $sql_ps);
@$campos_ps 	= mysqli_num_fields($resultado_ps);
@$filas_ps 		= mysqli_num_rows($resultado_ps);

echo "<section>
		<fieldset>
		<legend>SUCURSALES: <b>$filas_ps</b>
		</legend>
		<table>
		<tr>"; 


if($_SESSION["proveedores"] > 0){ // APERTURA PRIVILEGIOS ?>
	<a href='provsucursalalta.php?id_prov=<?php echo "$id_prov";?>' >
	<button type='button' title='Alta sucursal'>Registrar nueva sucursal</button>
	</a>
<?php } // CIERRE PRIVILEGIOS 

echo "<tr>
		<th>NOMBRE</th>
		<th>DOMICILIO</th>
		<th>COLONIA</th>
		<th>MUNICIPIO</th>
		<th>ESTADO</th>
		<th>CODIGO POSTAL</th>
	  </tr> ";

while($row = mysqli_fetch_assoc($resultado_ps)){
	$id_sucursal	= 	$row['id_sucursal'];	
	$nombreSucursal	= 	$row['nombreSucursal'];	
	$calleNumero 	= 	$row['calleNumero'];
	$colonia 		= 	$row['colonia'];
	$municipio 		= 	$row['municipio'];
	$estado 		= 	$row['estado'];
	$cp 			= 	$row['cp'];
	
	echo "<tr>";
	echo "<td>{$nombreSucursal}</td>";
	echo "<td>{$calleNumero}</td>";
	echo "<td>{$colonia}</td>";
	echo "<td>{$municipio}</td>";
	echo "<td>{$estado}</td>";
	echo "<td>{$cp}</td>";

	if($_SESSION["proveedores"] > 0)
	{
	echo "<td>
			<a href='provsucursalEdit.php?id_sucursal=$id_sucursal' >
				<button type='button' title='Editar SUCURSAL'>Editar</button>
			</a>
		  </td>";
	}

	echo "</tr>";
}
echo "	</table>
		</fieldset>
		</section>"; // Cerrar tabla
?>
<!-- SUCURSAL DE PROVEEDOR -->