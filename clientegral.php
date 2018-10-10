<!--DATOS DE CLIENTE-->
<?php
$sql_p = '    SELECT id_cliente, rfc, razonSocial, alias, 
              calleNumero, colonia, municipio, estado, cp '
        . '   FROM '
        . '   claCliente '
        . "   WHERE id_cliente = '$id_cliente' LIMIT 1";

$resultado_p  = mysqli_query($dbd2, $sql_p);
@$matriz_p    = mysqli_fetch_array($resultado_p);
@$rfc         = $matriz_p['rfc'];

@$razonSocial 	= $matriz_p['razonSocial'];
@$alias 		= $matriz_p['alias'];
@$calleNumero 	= $matriz_p['calleNumero'];
@$colonia 		= $matriz_p['colonia'];
@$municipio 	= $matriz_p['municipio'];
@$estado 		= $matriz_p['estado'];
@$cp 			= $matriz_p['cp'];

echo "<h2>$razonSocial</h2>";
echo "<h3>$alias</h3>";

?>
<fieldset><legend>RFC Y DOMICILIO</legend>
<table >
<tr><th>RFC</th>
    <td  id='IA<?php echo "$rfc";?>' ><?php echo  @$rfc;?></td>

    <?php if($_SESSION["clientes"] > 1){  // INICIO Permiso para Editar Cliente ?>
    <td>
       	<FORM action='clienteeditar.php' method='POST' id='entabla'>
    		<input type='hidden' name='id_cliente' value='<?php echo $id_cliente; ?>' >
       		<input type='SUBMIT' name='ENVIAR' value='Editar'>
    	</FORM>
    </td>
    <td>
       	<FORM action='clientedoctoalta.php' method='POST'>
    		<input type='hidden' name='id_cliente' value='<?php echo $id_cliente; ?>' >
       		<input type='SUBMIT' name='ENVIAR' value='Subir Archivo'>
    	</FORM>
    </td>
    <?php } // TERMINA Permiso para Editar Cliente  ?>
</tr>
<tr><th>RAZON SOCIAL</th>
    <td><?php echo  @$razonSocial;?></td></tr>
<tr><th>ALIAS</th>
    <td><?php echo  @$alias;?></td></tr>
<tr><th>DOMICILIO</th>
    <td><?php echo  @$calleNumero;?></td></tr>
<tr><th>COLONIA</th>
    <td><?php echo  @$colonia;?></td></tr>
<tr><th>MUNICIPIO</th>
    <td><?php echo  @$municipio;?></td></tr>
<tr><th>ESTADO</th>
    <td><?php echo  @$estado;?></td></tr>
<tr><th>CODIGO POSTAL</th>
    <td><?php echo  @$cp;?></td></tr>
</table>
</fieldset>
<!--DATOS DE CLIENTE-->