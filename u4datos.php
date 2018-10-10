<!--DATOS DE LA UNIDAD-->
<?php
datosxid($id_unidad);

$Cilindros 		= ($Cilindros == 0)?'':$Cilindros;
$TransmisionTxt = ($Transmision == 1)?'AUTOMATICO':(($Transmision == 2)?'ESTANDAR':'');
//$TransmisionTxt = ($Transmision == 2)?'ESTANDAR':'';

###### INICIO NAVEGAR ENTRE ECONOMICOS  
	if($_SESSION["navEcos"] > 0){ // NAVEGAR ENTRE ECONOMICOS PROXIMOS
		$siguienteEco 	= $Economico + 1;
		$anteriorEco 	= $Economico - 1;
		?>
		<style>.lineaF{display: inline-block;}</style>
		<?php
		echo "
		<FORM class='lineaF' action='u3index.php' method='POST'>
		<INPUT TYPE='text' NAME='economico' value = '$anteriorEco' hidden >
		<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='<-'>
		</FORM>
		<FORM class='lineaF'  action='u3index.php' method='POST'>
		<INPUT TYPE='text' NAME='economico' value = '$siguienteEco' hidden >
		<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='->'>
		</FORM>";
	}
###### INICIO NAVEGAR ENTRE ECONOMICOS


###### INICIO ESTE BLOQUE SE DEBE ACTUALIZAR
		if($_SESSION["datos"] > 2){ // AUTORIZACION PARA EDITAR INFORMACION DE UNIDAD VEHICULAR
			echo "<a href='u4datoseditar.php?id_unidad=".@$id_unidad."' 
			style='text-decoration:none;'>
			<button type='button' title='Editar datos de Unidad Vehicular'>
			Editar datos del Vehiculo</button></a>\n";
		}
###### INICIO ESTE BLOQUE SE DEBE ACTUALIZAR   


###### INICIO VENTA DE UNIDAD
		if($_SESSION["seminuevos"] > 0){ // AUTORIZACION PARA VENDER UNIDAD VEHICULAR
			echo "<a href='semVenta.php?id_unidad=".@$id_unidad."' > 
			<button type='button' title='Registrar Venta de Unidad Vehicular'>
			Venta</button></a>\n";
		}
###### TERMINA VENTA DE UNIDAD  


###### INICIO CARGAR FOTO DE UNIDAD	
		if($_SESSION["fotoUnidad"] > 0){ // AUTORIZACION PARA SUBIR FOTOS UNIDAD VEHICULAR
			echo "<a href='fotoUnidad.php?id_unidad=".@$id_unidad."' > 
			<button type='button' title='Ingresar Foto a Galeria de Unidad'>
			Subir Foto</button></a>\n";
		}
###### TERMINA CARGAR FOTO DE UNIDAD  


###### INICIO REGISTRAR SINIESTRO  
		if($_SESSION["siniestro"] > 0){ // AUTORIZACION PARA REGISTRO SINIESTRO UNIDAD VEHICULAR
			echo "<a href='sinRegistro.php?id_unidad=".$id_unidad."' > 
			<button type='button' title='Registrar Siniestro'>
			Registrar Siniestro</button></a>\n";
		}
###### TERMINA REGISTRAR SINIESTRO


###### INICIO ASIGNAR UNIDAD  
		if($_SESSION["asigna"] > 1){ // AUTORIZACION PARA ASIGNAR UNIDAD VEHICULAR
			echo "<a href='asignaunidadU.php?id_unidad=".$id_unidad."' > 
			<button type='button' title='Asignar Unidad'>
			Asignar Unidad</button></a>\n";
		}
###### TERMINA ASIGNAR UNIDAD


###### INICIO REPORTAR KILOMETRAJE 
		if($_SESSION["kmUsr"] >= 0){ // AUTORIZACION PARA ACTUALIZAR KILOMETRAJE
			echo "<a href='kmFormulario.php?id_unidad=".$id_unidad."' > 
			<button type='button' title='ReportarKilometraje'>
			Reportar Kilometraje</button></a>\n";
		}
###### TERMINA REPORTAR KILOMETRAJE


###### INICIO REPORTAR INFRACCION 
		if($_SESSION["infraccionH"] > 0){ // AUTORIZACION PARA ACTUALIZAR KILOMETRAJE
			echo "<a href='infAlta.php?id_unidad=".$id_unidad."' > 
			<button type='button' title='ReportarInfraccion'>
			Subir Infracción</button></a>\n";
		}
###### TERMINA REPORTAR INFRACCION


###### INICIO SOLICITUD ATENCION
		if($_SESSION["solAtn"] > 0){ // AUTORIZACION PARA ACTUALIZAR KILOMETRAJE
			echo "<a href='solAtnAlta.php?id_unidad=".$id_unidad."' > 
			<button type='button' title='SolcitarAtencion'>
			Solicitar Atención</button></a>\n";
		}
###### TERMINA SOLICITUD ATENCION


###### INICIO SOLICITUD ATENCION
		if($_SESSION["gps"] > 0){ // AUTORIZACION PARA ACTUALIZAR KILOMETRAJE
			echo "<a href='gpsAlerta.php?id_unidad=".$id_unidad."' > 
			<button type='button' title='GenerarAlertaGps'>
			Generar Alerta GPS</button></a>\n";
		}
###### TERMINA SOLICITUD ATENCION

?>
<fieldset><legend>Datos de la Unidad</legend>
<table>
<tr>
	<td><table>
		<tr><th bgcolor='17375D'>Economico</th><td><?php echo $Economico;?></td></tr>
		<tr><th>Serie</th>	<td><?php echo $Serie;?></td></tr>
		<tr><th>Marca</th>	<td><?php echo $Marca;?></td></tr>
		<tr><th>Tipo</th>	<td><?php echo $Vehiculo;?></td></tr>
		<tr><th>Modelo</th>	<td><?php echo $Modelo;?></td></tr>
		<tr><th>Color</th>	<td><?php echo $Color;?></td></tr>
		</table>
	</td>

	<td>
	<table>
		<tr><th>Cilindros</th><td><?php echo  $Cilindros;?></td></tr>
		<tr><th>Transmision</th><td><?php echo  $TransmisionTxt;?></td></tr>
		<?php
		if($_SESSION["datos"] > 2 OR $_SESSION["documentos"] > 2 OR $_SESSION["verMotor"] > 0 )
		{
			echo "<tr><th>Motor</th><td>$Motor</td></tr>";
			echo "<tr><th>Clave Vehicular</th><td>$ClaveVehicular</td></tr>";
			if($ClaveVehicular != 0)
			{
				cVehicularxid($ClaveVehicular);
				echo "<tr><th>CV.Empresa</th><td>$cVempresaDescrip</td></tr>";
				echo "<tr><th>CV.Modelo</th><td>$cVmodeloDescrip</td></tr>";
				echo "<tr><th>CV.Version</th><td>$cVehicularDescrip</td></tr>";
			};
		}
		?>
	</table>
	</td>

	<td>
		<?php 
			if($_SESSION["fotoUnidad"] > 0)
			{
				include('fotoUnidadVer.php');
			}
		?><!--<img src='img/frenteWEB.jpg' style='width:auto;height:105px;'  alt='FRENTE' >-->
	</td>
</tr>
</table>
</fieldset>
<!--DATOS DE LA UNIDAD-->