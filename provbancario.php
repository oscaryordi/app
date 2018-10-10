<!--DATOS BANCARIOS DE  PROVEEDOR-->
<?php
$sql_pb = 'SELECT id_cuenta, banco, cuenta, clabe, sucursal, suspendido '
		. ' FROM '
		. ' provBanco '
		. " WHERE id_prov = '$id_prov' ";		

$resultado_pb 	= mysqli_query($dbd2, $sql_pb);
@$campos_pb 	= mysqli_num_fields($resultado_pb);
@$filas_pb 		= mysqli_num_rows($resultado_pb);

echo "<section><fieldset><legend>CUENTAS REGISTRADAS: <b>$filas_pb</b></legend><table>"; 
echo "<tr>"; 

if($_SESSION["mttos"] > 1){ // APERTURA PRIVILEGIOS ?>
	<a href='provbancoalta.php?id_prov=<?php echo "$id_prov";?>' ><button type='button' title='Alta cuenta'>Registrar nueva cuenta</button></a>
<?php } // CIERRE PRIVILEGIOS


echo "<tr>
		<th>IDCTA</th>
		<th>BANCO</th>
		<th>CUENTA</th>
		<th>CLABE</th>
		<th>SUCURSAL</th>
		<th>ESTATUS</th>
	</tr>";

while($row = mysqli_fetch_assoc($resultado_pb)){
	$id_cuenta 	= 	$row['id_cuenta'];
	$banco 		= 	$row['banco'];	
	$cuenta 	= 	$row['cuenta'];
	$clabe 		= 	$row['clabe'];
	$sucursal 	= 	$row['sucursal'];
	$suspendido = 	$row['suspendido'];
	
	echo "<tr>";
	echo "<th>{$id_cuenta}</th>";
	echo "<td>{$banco}</td>";
	echo "<td>{$cuenta}</td>";
	echo "<td>{$clabe}</td>";
	echo "<td>{$sucursal}</td>";

//$xz = ($value4 == $matriz5['Placas'])?" Actual ":" Anterior ";

	$statusTxt = ($suspendido == 0)?'ACTIVA':'SUSPENDIDA';
	echo "<td>{$statusTxt}</td>";

	if($_SESSION["proveedores"] > 0 ) // SUSPENDER/REACTIVAR
		if($suspendido == 0) // SUSPENDER
		{
			{
			echo "<td>
					<form action='provbancarioSuspender.php' method='post'>
					<input type='hidden' value='$suspendido' 	name='suspendido'>
					<input type='hidden' value='$id_prov' 		name='id_prov'>
					<input type='hidden' value='$id_cuenta' 	name='id_cuenta'>";
			?>
					<a onClick="javascript: return confirm('Confirma proceder a SUSPENDER CUENTA'); " >
			<?php
			echo "		
				   <input type='submit' value='Suspender Cuenta' name='Suspender' title='SUSPENDER' >
					</a>
					</form>
				</td>";
			}
		}
		else
		{
			if($_SESSION["proveedores"] > 1 ) // REACTIVAR
			{
				{
				echo "<td>
						<form action='provbancarioReactivar.php' method='post'>
						<input type='hidden' value='$suspendido' 	name='suspendido'>
						<input type='hidden' value='$id_prov' 		name='id_prov'>
						<input type='hidden' value='$id_cuenta' 	name='id_cuenta'>";
				?>
						<a onClick="javascript: return confirm('Confirma proceder a REACTIVAR CUENTA'); " >
				<?php
				echo "		
					   <input type='submit' value='Activar Cuenta' name='Activar' title='ACTIVAR' >
						</a>
						</form>
					</td>";
				}
			}
		}

	echo "</tr>";
}
echo "</table></fieldset></section>"; // Cerrar tabla
?>
<!--DATOS BANCARIOS DE  PROVEEDOR-->