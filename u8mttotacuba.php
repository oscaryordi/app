<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["mttos"] > 2){  // APERTURA PRIVILEGIOS
    
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

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
                $fecha      =mysqli_real_escape_string($dbd2, $_POST['fecha']);
                $hora   	=mysqli_real_escape_string($dbd2, $_POST['hora']);
                $ejecutivo  =strtoupper(mysqli_real_escape_string($dbd2, $_POST['ejecutivo']));
                $cliente  	=strtoupper(mysqli_real_escape_string($dbd2, $_POST['cliente']));

                @$preventivo 	= @$_POST['preventivo']+0;
                @$frenos 		= @$_POST['frenos']+0;
				@$suspdir 		= @$_POST['suspdir']+0;
				@$clima 		= @$_POST['clima']+0;
				@$motor 		= @$_POST['motor']+0;
				@$transmision 	= @$_POST['transmision']+0;
				@$llantas 		= @$_POST['llantas']+0;
				@$hojalateria 	= @$_POST['hojalateria']+0;
				@$electrico 	= @$_POST['electrico']+0;

				$km  	=mysqli_real_escape_string($dbd2, $_POST['km']);
				$status = $_POST['status'];
                $capturo = $_SESSION["id_usuario"];
            
                $sql_mttoJt = 'INSERT INTO `jetvantlc`.`mttoJtacuba` 
                			(`id_mttoJ`, `id_unidad`, `fechaI`, `horaI`, `preventivo`, 
                			`frenos`, `suspdir`, `clima`,    `motor`,`transm`,        
                			`llantas`,  `hojalateria`, `electrico`, `status`,    `ejecutivo`,
                			`cliente`,`capturo`, km) VALUES ';
                $sql_mttoJt .= "(NULL, '$id_unidad', '$fecha', '$hora', '$preventivo', 
                			'$frenos', '$suspdir', '$clima', '$motor', '$transmision', 
                			'$llantas', '$hojalateria', '$electrico','$status', '$ejecutivo', 
                			'$cliente','$capturo', '$km') ;" ;
                $mttoJt_registrado = mysqli_query($dbd2, $sql_mttoJt );



                // INICIO ACTUALIZAR TABLA STATUS
                // OBTENER id_mttoJ CREADO
                $sql_id_mttoJ 		= "SELECT MAX(id_mttoJ) FROM mttoJtacuba ";
                $sql_id_mttoJ_res 	= mysqli_query($dbd2, $sql_id_mttoJ);
                if($row_id_mttoJ 	= mysqli_fetch_row($sql_id_mttoJ_res)){
                	$id_mttoJ = trim($row_id_mttoJ[0]);
                }

               $sql_mttoJt_update = "INSERT INTO mttoJtacubaStatus 
               						(id_update, id_mttoJ, status, capturo) 
               						VALUES 
               						(NULL, '$id_mttoJ', '$status', $capturo) ";

               $mttoJt_update_registrado = mysqli_query($dbd2, $sql_mttoJt_update );

                // FIN ACTUALIZAR TABLA STATUS

                if($mttoJt_registrado){ 
                    echo '<h2>MANTENIMIENTO REGISTRADO CORRECTAMENTE</h2>';
                    include ("u8mtto.php");
				}
			$subido = 'ok'	;			
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}


if($subido!='ok'){ // APERTURA MOSTRAR FORMULARIO

include ("u8mtto.php");

// CONSULTAR EJECUTIVOS PARA NORMALIZAR TABLA MTTOJTACUBA
$sql_mttoJt_ejec = 'SELECT id_usuario, nombre FROM usuarios WHERE ejecutivo > 0 ORDER BY nombre';
$sql_mttoJt_ejec_r =  mysqli_query($dbd2, $sql_mttoJt_ejec );
// CONSULTA EJECUTIVOS

?>
<fieldset><legend>Mantenimiento Jet Van Tacuba</legend>

<table class='ResTabla'>

<form action="" method="POST">
<tr>
	<th>
	Fecha de ingreso
	</th>
	<td>
	<input type="date" name="fecha"  value="" placeholder="aaaa-mm-dd">aaaa-mm-dd</td>
</tr>
<tr>
	<th>Hora
	</th>
	<td>
	<input type="time" name="hora"  value="" placeholder="">
	</td>
</tr>
<tr>
	<th>Ejecutivo Responsable
	</th>
	<td>


	<select name="ejecutivo" style='font-size:.9em;'>
	<?php 
		while($row = mysqli_fetch_assoc($sql_mttoJt_ejec_r))
		{
			$id_usuario = 	$row['id_usuario'];	
			$nombre 	= 	strtoupper($row['nombre']);

			echo "<option value='$id_usuario' style='font-size:.9em;'>";
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
	<input type="text" name="cliente"  value="" placeholder="cliente / dependencia">
	</td>
</tr>
<tr>
	<th>Tipo de Servicio
	</th>
	<td>
	<input type="checkbox" id="preventivo" name="preventivo" value="1" >
	<label for = "preventivo" >PREVENTIVO</label>
	<input type="checkbox" id="frenos" name="frenos" value="1">
	<label for = "frenos" >FRENOS</label>
	<input type="checkbox" id="suspdir" name="suspdir" value="1" >
	<label for = "suspdir" >SUSPENSION/DIRECCION</label>
	<input type="checkbox" id="clima" name="clima" value="1" >
	<label for = "clima" >CLIMA</label>
	<input type="checkbox" id="motor" name="motor" value="1" >
	<label for = "motor" >MOTOR</label>
	<input type="checkbox" id="transmision" name="transmision" value="1" >
	<label for = "transmision" >TRANSMISION</label>
	<input type="checkbox" id="llantas" name="llantas" value="1" >
	<label for = "llantas" >LLANTAS</label>
	<input type="checkbox" id="hojalateria" name="hojalateria" value="1" >
	<label for = "hojalateria" >HOJALATERIA</label>
	<input type="checkbox" id="electrico" name="electrico" value="1" >
	<label for = "electrico" >ELECTRICO</label>
	</td>
</tr>
<tr>
	<th>Kilometraje
	</th>
	<td>
	<input type="number" name="km"  value="" placeholder="0000"> 0000
	</td>
</tr>
<tr>
<tr>
	<th>Status
	</th>
	<td>
	<select name="status">
	<option value="1">POR ASIGNAR</option>
	<option value="2">EN PROCESO</option>
	<option value="3">PENDIENTE/REFACCIONES</option>
	<option value="4">TALLER EXTERNO</option>
	<option value="5">TERMINADO</option>
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

<?php } //CIERRE MOSTRAR FORMULARIO

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>