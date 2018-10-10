<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["mttos"] > 2){  // APERTURA PRIVILEGIOS

$id_unidad 	= $_POST['id_unidad'];
$id_mttoJ 	= $_POST['id_mttoJ'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

############################## INICIO BLOQUE PARA CONSULTAR MANTENIMIENTO

$sql_MJT = 'SELECT * '
        . " FROM mttoJtacuba 
        	WHERE id_mttoJ = '$id_mttoJ' 
        	LIMIT 1 " ;
//       . ' ORDER BY '
//        . ' id_mttoJ '
//        . ' DESC '
//		. ' , `razonSocial` ASC '
//        . " LIMIT $pagina_1, 15" ; 

/*		
echo "<table>\n";
echo "<tr>
<th>FECHA DE INGRESO</th>
<th>HORA</th>

<th>PLACAS</th>
<th>SERIE</th>
<th>TIPO</th>
<th>COLOR</th>

<th>TIPO DE SERVICIO</th>

<th>KILOMETRAJE</th>
<th>EJECUTIVO</th>
<th>DEPENDENCIA</th>
<th>ESTATUS</th>
<th>ACTUALIZACION</th>
<th>EDITAR STATUS</th>

</tr>";
*/

$res_MJT = mysqli_query($dbd2, $sql_MJT);

while($row = mysqli_fetch_assoc($res_MJT)){


	//$id_mttoJ = $row['id_mttoJ'];
	$id_unidad = $row['id_unidad'];
	$fechaI = $row['fechaI'];
	$horaI = $row['horaI'];

	datosxid($id_unidad);

	$preventivo = $row['preventivo'];
	if($preventivo == 1){$preventivo = 'checked';} else {$preventivo = '';}

	$frenos = $row['frenos'];
	if($frenos == 1){$frenos = 'checked';} else {$frenos = '';}

	$suspdir = $row['suspdir'];
	if($suspdir == 1){$suspdir = 'checked';} else {$suspdir = '';}

	$clima = $row['clima'];
	if($clima == 1){$clima = 'checked';} else {$clima = '';}

	$motor = $row['motor'];
	if($motor == 1){$motor = 'checked';} else {$motor = '';}

	$transm = $row['transm'];
	if($transm == 1){$transm = 'checked';} else {$transm = '';}

	$llantas = $row['llantas'];
	if($llantas == 1){$llantas = 'checked';} else {$llantas = '';}

	$hojalateria = $row['hojalateria'];
	if($hojalateria == 1){$hojalateria = 'checked';} else {$hojalateria = '';}

	$electrico = $row['electrico'];
	if($electrico == 1){$electrico = 'checked';} else {$electrico = '';}

	$status1 = '';
	$status2 = '';
	$status3 = '';
	$status4 = '';
	$status5 = '';

	$status = $row['status'];
	if($status == 1){$status1 = 'selected';} 
	elseif($status == 2) {$status2 = 'selected';}
	elseif($status == 3) {$status3 = 'selected';}
	elseif($status == 4) {$status4 = 'selected';}
	elseif($status == 5) {$status5 = 'selected';}

	$ejecutivo = $row['ejecutivo'];
	$cliente = $row['cliente'];
	$km = $row['km'];
	$actualizado = $row['fechareg'];

/*	
	echo "<tr>";
	echo "<td>{$fechaI}</td>";
	echo "<td>{$horaI}</td>";

	echo "<td>{$Placas}</td>";
	echo "<td>{$Serie}</td>";
	echo "<td>{$Vehiculo}</td>";
	echo "<td>{$Color}</td>";

	echo "<td style='font-size:.8em;'>{$preventivo}
		{$frenos}
		{$suspdir}
		{$clima}
		{$transm}
		{$llantas}
		{$hojalateria}
		</td>";
	echo "<td>{$km}</td>";

	echo "<td>{$ejecutivo}</td>";
	echo "<td>{$cliente}</td>";
	echo "<td>{$status}</td>";
	echo "<td>{$actualizado}</td>";	

	echo "<td>
		<FORM action='mttoTacubaEditar.php' method='POST'>
			<INPUT TYPE='hidden' NAME='id_mttoJ' value='$id_mttoJ'>
			<INPUT TYPE='hidden' NAME='id_unidad' value='$id_unidad'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='ACTUALIZAR'>
		</FORM>	
		</td>"; 
	echo "</tr>";
}
echo "</table>";
*/
}
############################## FIN BLOQUE PARA CONSULTAR MANTENIMIENTO


$subido = ''; // CONDICION PARA MOSTRAR FORMULARIO


if(isset($_POST['Datos']))
    {
	
        if($_POST['fecha']!='' 
        && $_POST['hora']!=''
        && $_POST['ejecutivo']!='' 
        && $_POST['cliente']!='' 
        && $_POST['km']!='' 
        )
            {		
                $fecha      = mysqli_real_escape_string($dbd2, $_POST['fecha'] );
                $hora   	= mysqli_real_escape_string($dbd2, $_POST['hora'] );
                $ejecutivo  = strtoupper(mysqli_real_escape_string($dbd2, $_POST['ejecutivo'] ));
                $cliente  	= strtoupper(mysqli_real_escape_string($dbd2, $_POST['cliente'] ));

                @$preventivo 	= @$_POST['preventivo']+0;
                @$frenos 		= @$_POST['frenos']+0;
				@$suspdir 		= @$_POST['suspdir']+0;
				@$clima 		= @$_POST['clima']+0;
				@$motor 		= @$_POST['motor']+0;
				@$transmision 	= @$_POST['transmision']+0;
				@$llantas 		= @$_POST['llantas']+0;
				@$hojalateria 	= @$_POST['hojalateria']+0;
				@$electrico 	= @$_POST['electrico']+0;

				$km  		= mysqli_real_escape_string($dbd2, $_POST['km'] );

				$status 	= $_POST['status'];

                $capturo    = $_SESSION["id_usuario"];


               $sql_mttoJt = "UPDATE `jetvantlc`.`mttoJtacuba` SET 
                			  `preventivo` 	= '$preventivo', 
                			  `frenos` 		= '$frenos', 
                			  `suspdir` 	= '$suspdir', 
                			  `clima` 		= '$clima',    
                			  `motor` 		= '$motor',
                			  `transm` 		= '$transmision', 
                			  `llantas` 	= '$llantas',  
                			  `hojalateria` = '$hojalateria',  
                			  `electrico` 	= '$electrico',
                			  `status` 		= '$status', 
                			  `capturo` 	= '$capturo', 
                			  km = '$km' 
                			  WHERE id_mttoJ = '$id_mttoJ' 
                			  LIMIT 1;" ;





                $mttoJt_registrado = mysqli_query($dbd2, $sql_mttoJt );

                // INICIO REGISTRO DE CAMBIOS DE STATUS
                $sql_mttoJt_update = " 	INSERT INTO mttoJtacubaStatus 
                						(id_update, id_mttoJ, status, capturo) 
                						VALUES 
                						(NULL, '$id_mttoJ', '$status', $capturo) ";

                $mttoJt_update_registrado = mysqli_query($dbd2, $sql_mttoJt_update );
                // FIN REGISTRO DE CAMBIOS DE STATUS


                if($mttoJt_registrado)
                { 
                    echo '<h2>MANTENIMIENTO ACTUALIZADO CORRECTAMENTE</h2>';
                    if($_SESSION["mttos"] > 0)
                    { // RESUMEN MTTO 
						echo "<form action='mttorestacuba.php' class='navegacion'>
						<input id='gobutton2' type='submit' name='resumen mantenimiento' value='Resumen Tacuba'>
						</form>";
					} 
                    // include ("u8mtto.php");
				}
			
			$subido = 'ok'	;			
			}
			else
			{	
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
			}
    }


if($subido!='ok'){ // APERTURA MOSTRAR FORMULARIO

//include ("u8mtto.php");


// CONSULTAR EJECUTIVOS PARA NORMALIZAR TABLA MTTOJTACUBA
$sql_mttoJt_ejec = 'SELECT id_usuario, nombre FROM usuarios WHERE ejecutivo > 0 ORDER BY nombre';
$sql_mttoJt_ejec_r =  mysqli_query($dbd2, $sql_mttoJt_ejec );
// CONSULTA EJECUTIVOS

?>
<fieldset><legend>Mantenimiento Jet Van Tacuba</legend>

<table>

<form action="" method="POST">

<input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>" >
<input type="hidden" name="id_mttoJ"  value="<?php echo $id_mttoJ;?>" >
<tr>
	<th>
	Fecha de ingreso
	</th>
	<td>
	<input type="date" name="fecha"  value="<?php echo $fechaI;?>" placeholder="aaaa-mm-dd">aaaa-mm-dd</td>
</tr>
<tr>
	<th>Hora
	</th>
	<td>
	<input type="time" name="hora"  value="<?php echo $horaI;?>" placeholder="">
	</td>
</tr>
<tr>
	<th>Ejecutivo Responsable
	</th>
	<td>


	<select name="ejecutivo" style='font-size:.9em;'>
<?php 
	while($row_r = mysqli_fetch_assoc($sql_mttoJt_ejec_r))
	{

		$id_usuario = 	$row_r['id_usuario'];	
		$nombre = 		strtoupper($row_r['nombre']);

		$selected = '';

		if(	$id_usuario == $ejecutivo){$selected = 'selected';}

		echo "<option value='$id_usuario' style='font-size:.9em;' $selected >";
		echo "{$nombre}";
		echo "</option>";
	}
?>
	</select>

	</td>
</tr>
<tr>
	<th>Cliente
	</th>
	<td>
	<input type="text" name="cliente"  value="<?php echo $cliente;?>" placeholder="cliente / dependencia">
	</td>
</tr>
<tr>
	<th>Tipo de Servicio
	</th>
	<td>
	<input type="checkbox" id="preventivo" name="preventivo" value="1" <?php echo $preventivo ;?>>
	<label for = "preventivo" >PREVENTIVO</label>
	<input type="checkbox" id="frenos" name="frenos" value="1" <?php echo $frenos;?>>
	<label for = "frenos" >FRENOS</label>
	<input type="checkbox" id="suspdir" name="suspdir" value="1" <?php echo $suspdir;?>>
	<label for = "suspdir" >SUSPENSION/DIRECCION</label>
	<input type="checkbox" id="clima" name="clima" value="1" <?php echo $clima;?>>
	<label for = "clima" >CLIMA</label>
	<input type="checkbox" id="motor" name="motor" value="1" <?php echo $motor;?>>
	<label for = "motor" >MOTOR</label>
	<input type="checkbox" id="transmision" name="transmision" value="1" <?php echo $transm;?>>
	<label for = "transmision" >TRANSMISION</label>
	<input type="checkbox" id="llantas" name="llantas" value="1" <?php echo $llantas;?>>
	<label for = "llantas" >LLANTAS</label>
	<input type="checkbox" id="hojalateria" name="hojalateria" value="1" <?php echo $hojalateria;?>>
	<label for = "hojalateria" >HOJALATERIA</label>
	<input type="checkbox" id="electrico" name="electrico" value="1" <?php echo $electrico;?>>
	<label for = "electrico" >ELECTRICO</label>

	</td>
</tr>
<tr>
	<th>Kilometraje
	</th>
	<td>
	<input type="number" name="km"  value="<?php echo $km;?>" placeholder="0000"> 0000
	</td>
</tr>
<tr>
<tr>
	<th>Status
	</th>
	<td>
	<select name="status">
	<option value="1" <?php echo $status1;?>>POR ASIGNAR</option>
	<option value="2" <?php echo $status2;?>>EN PROCESO</option>
	<option value="3" <?php echo $status3;?>>PENDIENTE/REFACCIONES</option>
	<option value="4" <?php echo $status4;?>>TALLER EXTERNO</option>
	<option value="5" <?php echo $status5;?>>TERMINADO</option>
	</select>
	</td>
</tr>

 <tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="Datos" value="Registrar Mantenimiento"> 
	</td>
</tr>



</form>
</table>
</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO?>

<form action='mttorestacuba.php' class='navegacion'>
	<input id='gobutton2' type='submit' name='resumen mantenimiento' value='Resumen Tacuba'>
</form>

<?php // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

} // CIERRE PRIVILEGIOS
include ("1footer.php");?>