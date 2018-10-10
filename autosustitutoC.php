<?php
include("1header.php");?>
<meta charset='utf-8'>

<?php  
if($_SESSION["sustituto"] > 0){  // APERTURA PRIVILEGIOS


if($_SESSION["sustituto"] > 0){ //PRIVILEGIOS  VISTA A EJECUTIVOS DE CUENTA
	include ("nav_sust.php");
} // CIERRE PRIVILEGIOS

$id_sust = $_POST['id_sust'];

$subido = ''; // CONDICION PARA MOSTRAR FORMULARIO

############################## INICIO BLOQUE PARA ACTUALIZAR
if(isset($_POST['Datos']))
    {
       if($_POST['id_sust']!='' 
         )
            {		
 				$id_sust = $_POST['id_sust'];
 				$status 	= '0';
                $capturo	= $_SESSION["id_usuario"];
                // INICIO REGISTRO DE CAMBIOS DE STATUS
                $sql_sustituto_update = "UPDATE sustituto SET  status = '$status', cancelo = '$capturo' WHERE  id_sust = '$id_sust' LIMIT 1 ";
                $sql_sustituto_update_RES = mysqli_query($dbd2, $sql_sustituto_update );
                // FIN REGISTRO DE CAMBIOS DE STATUS
                if($sql_sustituto_update_RES)
                	{ 
                    echo '<h2>SOLICITUD CANCELADA</h2>';
					} 
                    // include ("u8mtto.php");			
			$subido = 'ok'	;			
			}
			else
			{	
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
			}
    }
############################## FIN BLOQUE PARA ACTUALIZAR


if($subido!='ok'){ // ############################## APERTURA MOSTRAR FORMULARIO

$sql_sust;

// SI CONSULTA GERENTE
if($_SESSION["ejecutivo"] > 0){
	$sql_sust = 'SELECT * '
        . " FROM sustituto 	WHERE id_sust = $id_sust " ;
 }
// SI CONSULTA USUARIO NORMAL
else{
	$sql_sust = 'SELECT * '
        . ' FROM sustituto '
        . " WHERE capturo = $capturo  AND id_sust = $id_sust ";		

}

echo "<br>";		
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>
<th>FOLIO</th>
<th>FECHA SOLICITUD</th>
<th>AUTO BASE</th>
<th>TIPO BASE</th>
<th>AUTO SUSTITUTO</th>
<th>TIPO SUSTITUTO</th>
<th>MOTIVO</th>
<th>VER</th>
<th>SALIDA CONFIRMADA</th>
<th>DEVOLUCION CONFIRMADA</th>
<th>STATUS</th>

</tr>";
// EJECUTAR CONSULTA
$res_sust = mysqli_query($dbd2, $sql_sust);
// ASIGNAR VARIABLES
while($row = mysqli_fetch_assoc($res_sust)){
	$id_sust = $row['id_sust'];
	$serieFallado = $row['serieFallado'];
	$serieSustituto = $row['serieSustituto'];
	$motivo = $row['motivo'];
	$fecharegistro = $row['fecharegistro'];

	$fechaInicio = $row['fechaI'];
	$fechaFinal = $row['fechaF'];

	$status = $row['status'];

// MOSTRAR INFORMACION
	echo "<tr>";
	echo "<td>{$id_sust}</td>"; 
	echo "<td>{$fecharegistro}</td>"; 	

	echo "<td>{$serieFallado}</td>";
	idxserie($serieFallado);
	datosxid($id_unidad);
	$tipoFallado = $Vehiculo;
	echo "<td>{$tipoFallado}</td>";

	echo "<td>{$serieSustituto}</td>";
	idxserie($serieSustituto);
	datosxid($id_unidad);
	$tipoSustituto = $Vehiculo;		
	echo "<td>{$tipoSustituto}</td>";
	
	echo "<td>{$motivo}</td>";
	echo "<td>
		<a href='AutoSustitutoVerId.php?id_sustituto=$id_sust' target='blank'>Ver formato</a>
		</td>";
	

	echo "<td>{$fechaInicio}</td>";	
	echo "<td>{$fechaFinal}</td>";

	if($status == '1'){
		$statustexto = 'ACTIVA';

	echo	"<td> $statustexto <FORM action='autosustitutoC.php' method='POST' >
			<INPUT TYPE='hidden' NAME='id_sust' value='$id_sust'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='CANCELAR' style='font-size:.8em;'>
			</FORM>	</td>";

	}else{$statustexto = 'CANCELADA';
	echo "<td>{$statustexto}</td>";
	}

	echo "</tr>";
}
echo "</table>";
echo "<br>";


?>

<fieldset><legend>Cancelar Solicitud de Sustituto</legend>
<table>
<form action="" method="POST">
	<input type="hidden" name="id_sust"  value="<?php echo $id_sust;?>" >
	<tr>
		<td colspan=2 >
		<input id="gobutton2" type="submit" name="Datos" value="Cancelar Solicitud"> 
		</td>
	</tr>
</form>
</table>
</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO?>
<br>
<form action='autosustitutolistado.php' class='navegacion'><input id='gobutton2' type='submit' name='resumen sustitutos' value='Resumen Sustitutos'></form>

<?php  } // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>