<!--DATOS DE PROVEEDOR-->
<?php
$sql_p = '	SELECT id_prov, rfc, razonSocial, aliasProv, calleNumero, 
			colonia, municipio, estado, cp, suspendido, credito '
		. ' FROM '
		. ' provAlta '
		. " WHERE id_prov = '$id_prov' LIMIT 1";

$resultado_p 	= mysqli_query($dbd2, $sql_p);
$matriz_p 		= mysqli_fetch_array($resultado_p);

if(mysqli_affected_rows($dbd2) > 0){ // INICIA SI HAY COINCIDENCIA MOSTRAR

$rfc 			= $matriz_p['rfc'];
$suspendidoP 	= $matriz_p['suspendido'];
$suspendidoLetrero = '';

if($suspendidoP == 1){
$suspendidoLetrero = "<span style='color:yellow;background-color:red;font-size:1.5em;font-weight:bold' > PROVEEDOR SUSPENDIDO </span>";
}

	 if($_SESSION["proveedores"] > 0) // AUTORIZACION PARA EDITAR INFORMACION DEL PROVEEDOR
	 	{ 
			 echo "<a href='provaltaeditar.php?id_prov=".$id_prov."' > 
			 <button type='button' title='Editar'>
			 Editar</button></a>\n";
		}



	 if($_SESSION["proveedores"] > 2) // AUTORIZACION PARA MARCAR CON CREDITO
	 	{ 
	 		if($matriz_p['credito'] == 0 )
	 		{
			 echo "<a href='provCreditoAlta.php?id_prov=".$id_prov."' > 
			 <button type='button' title='Credito'>
			 Marcar con Crédito</button></a>\n";
			}
			else
			{
			 echo "<a href='provCreditoBaja.php?id_prov=".$id_prov."' > 
			 <button type='button' title='Credito'>
			 Quitar de Crédito</button></a>\n";
			}
		}



	 if($_SESSION["proveedores"] > 1) // AUTORIZACION PARA EDITAR INFORMACION DEL PROVEEDOR
	 	{ 
			 if($suspendidoP == 0) // SUSPENDER
			 {
				echo "<a >
						<form action='provSuspender.php' method='post' style='display: inline;'>
						<input type='hidden' value='$suspendidoP' 	name='suspendido'>
						<input type='hidden' value='$id_prov' 		name='id_prov'>";
					?>
						<a onClick="javascript: return confirm('Confirma proceder a SUSPENDER PROVEEDOR'); " >
					<?php
				echo "		
					   <input type='submit' value='Suspender Proveedor' name='Suspender' title='SUSPENDER' >
						</a>
						</form>
					</a>";
			 }
			 elseif($suspendidoP == 1) // REACTIVAR
			 {
				echo "<a >
						<form action='provReactivar.php' method='post' style='display: inline;'>
						<input type='hidden' value='$suspendidoP' 	name='suspendido'>
						<input type='hidden' value='$id_prov' 		name='id_prov'>";
					?>
						<a onClick="javascript: return confirm('Confirma proceder a REACTIVAR PROVEEDOR'); " >
					<?php
				echo "		
					   <input type='submit' value='Activar' name='Activar' title='REACTIVAR' >
						</a>
						</form>
					</a>";
			 }
		}
?>
<fieldset><legend>RFC Y DOMICILIO</legend>
<table >
<tr><th>RFC</th><td><?php echo  $matriz_p['rfc'].$suspendidoLetrero;?></td></tr>
<tr><th>RAZON SOCIAL</th><td><?php echo  $matriz_p['razonSocial'];?></td></tr>
<tr><th>ALIAS</th><td><?php echo  $matriz_p['aliasProv'];?></td></tr>
<tr><th>DOMICILIO</th><td><?php echo  $matriz_p['calleNumero'];?></td></tr>
<tr><th>COLONIA</th><td><?php echo  $matriz_p['colonia'];?></td></tr>
<tr><th>MUNICIPIO</th><td><?php echo  $matriz_p['municipio'];?></td></tr>
<tr><th>ESTADO</th><td><?php echo  $matriz_p['estado'];?></td></tr>
<tr><th>CODIGO POSTAL</th><td><?php echo  $matriz_p['cp'];?></td></tr>
</table>
</fieldset>
<!--DATOS DE PROVEEDOR-->
<?php 

if($matriz_p['credito']==1)
{
echo "<h3>PROVEEDOR CUENTA CON CREDITO ADMINISTRADO POR CONTABILIDAD (JETVAN - SAN JOAQUIN) </h3>";
}



} // TERMINA SI HAY COINCIDENCIA MOSTRAR