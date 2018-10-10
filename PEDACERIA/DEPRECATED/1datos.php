<!--DATOS DE LA UNIDAD-->
<?php
$sql = 'SELECT u.Economico, u.Serie, u.Vehiculo, u.Modelo, u.Color '
        . ' FROM'
        . ' ubicacion u'
        . " WHERE u.Economico = $uNEco LIMIT 0, 30 ";		

$resultado = mysql_query($sql);
@$matriz = mysql_fetch_array($resultado);
?>
<fieldset><legend>Datos de la Unidad</legend>


<?php
		if($_SESSION["datos"] > 2){ // AUTORIZACION PARA EDITAR INFORMACION DE UNIDAD VEHICULAR
  	
			echo "<a href='datos_editar.php?uNEco=".@$uNEco."' > 
			<button type='button' title='Editar dstos de Unidad Vehicular'>
			Editar datos del Vehiculo</button></a>\n";
		}
?>


<table >
<tr><th bgcolor='17375D'>Economico</th><td><?echo @$matriz[Economico];?></td></tr>
<tr><th>Serie</th><td><?echo @$matriz[Serie];?></td></tr>
<tr><th>Tipo</th><td><?echo @$matriz[Vehiculo];?></td></tr>
<tr><th>Modelo</th><td><?echo @$matriz[Modelo];?></td></tr>
<tr><th>Color</th><td><?echo @$matriz[Color];?></td></tr>
</table>
</fieldset>
<!--DATOS DE LA UNIDAD-->