<!--UBICACION-->
<?php
if($_SESSION["movimientos"] > 0){  // puede ver movimientos???

ubicacionHistorico($id_unidad);

$dn 	= array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$mn 	= array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
		"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
@$hoy3 	= getdate(strtotime($fechaA));
##### UBICACION

if(is_numeric($clienteA))
{
	contratoxid($clienteA);
	clientexid($id_cliente);
	$clienteA = $razonSocial;
}


?>
<fieldset><legend>Ubicación</legend>
<table>
	<tr>
		<th>Ubicacion</th>
		<td><?php echo  $clienteA;?> / <?php echo  $ubicacionA;?></td>
	</tr>
	<tr>
		<th>Fecha del Reporte</th>
		<td>

		<?php 
			$fvacia = ($fechaA !== NULL)? $dn[$hoy3['wday']].", ".$hoy3['mday']." de ".$mn[$hoy3['mon']-1]." de ".$hoy3['year']:" No hay fecha";
			echo $fvacia; 


		if($_SESSION["movimientos"] > 1 or $_SESSION["almacen"] > 0 )
		{  // VER HISTORICO // APERTURA PRIVILEGIOS ?>	
			<a href='u6ubicacionhist.php?id_unidad=<?php echo "$id_unidad";?>' >
			<button type='button' title='Ver historico de movimientos'>
			Ver histórico
			</button>
			</a>
		<?php
		} // VER HISTORICO // CIERRE PRIVILEGIOS  

		if($_SESSION["direccion"] > 0 || $_SESSION["compra"] > 0 || $_SESSION["movForaneo"] > 0)
		{  // EDITAR UBICACION // APERTURA PRIVILEGIOS ?>	
			<a href='u6ubicacioneditar.php?id_unidad=<?php echo "$id_unidad";?>' >
			<button type='button' title='Editar ubicacion'>
			Actualizar Ubicación</button></a>
		<?php 
		} // EDITAR UBICACION // CIERRE PRIVILEGIOS

		if($_SESSION["movForaneo"] > 0 )
		{  // REGISTRAR TRASLADO // APERTURA PRIVILEGIOS ?>
		<a href='movTrasladoRF.php?id_unidad=<?php echo "$id_unidad";?>' >
		<button type='button' title='Registrar Traslado'>
		Registrar Traslado</button></a>
		<?php 
		} // EDITAR UBICACION // CIERRE PRIVILEGIOS

		if($_SESSION["movForaneo"] > 0 )
		{  // HISTORICO TRASLADOS ?>
		<a href='movResUno.php?id_unidad=<?php echo "$id_unidad";?>' >
		<button type='button' title='Historico Traslados'>
		Histórico Traslados</button></a>
		<?php 
		} // HISTORICO TRASLADOS/* */?>  

		</td>
	</tr>
</table>
</fieldset>
<!--UBICACION-->
<?php

} // CIERRE PRIVILEGIOS puede ver movimientos ?>