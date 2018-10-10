<?php
include("1header.php");

if($_SESSION["gps"] > 0){ // VISTA A C4

include ("nav_gps.php");
$subido = '';

if(isset($_POST['Datos']))
{
    if(
    $_POST['imei']!='' && 
    $_POST['marca']!='' && 
    $_POST['modelo']!=''  && 
   	$_POST['fcompra']!='' 
    )
   {
        $imei 	= mysqli_real_escape_string($dbd2, $_POST['imei'] );
        $marca  = mysqli_real_escape_string($dbd2, $_POST['marca'] );
        $modelo = mysqli_real_escape_string($dbd2, $_POST['modelo'] );
        $fcompra= mysqli_real_escape_string($dbd2, $_POST['fcompra'] );

        $capturo        = $_SESSION["id_usuario"];
            
        // VALIDAR QUE NO EXISTA PREVIAMENTE
        $sql_validar = "SELECT imei FROM gpsImei WHERE imei = '$imei' LIMIT 1 ";
        $validar_rs = mysqli_query($dbd2, $sql_validar);

        if(mysqli_affected_rows($dbd2) == 0 )
        {
			$sql_gps_alta 	= 'INSERT INTO `jetvantlc`.`gpsImei` 
					    		(`id_imei`, `imei`, `marca`, `modelo`, `fcompra`, 
					    		`capturo`) VALUES ';
			$sql_gps_alta 	.= "(NULL, '$imei', '$marca', '$modelo','$fcompra', '$capturo') ;" ;
			$gps_rs 		= mysqli_query($dbd2, $sql_gps_alta);

		    if($gps_rs)
		    { 
		        echo '<h2>EQUIPO DADO DE ALTA CORRECTAMENTE</h2>';
		        //include ("#.php");
			}
        } else 
        {
          	echo "<p style='background-color:#FFFF99;'>
           	<h3>Equipo dado de alta previamente &#9786;</h3></p>";
        }
		$subido = 'ok'	;
	}
	else
	{	
		echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
	}
}


if($subido!='ok'){ ?>

<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>ALTA DE EQUIPO GPS</h2>
<table>
	<tr><th>IMEI</th>
		<td><input type='text' name='imei' value="<?php echo @$_POST['imei'];?>" placeholder='imei'></td></tr>
	<tr><th>MARCA</th>
		<td><input type='text' name='marca' value="<?php echo @$_POST['marca'];?>" placeholder='marca'></td></tr>
	<tr><th>MODELO</th>
		<td><input type='text' name='modelo' value="<?php echo @$_POST['modelo'];?>" placeholder='modelo'></td></tr>
	<tr><th>FECHA DE COMPRA</th>
		<td><input type='date' name='fcompra' value="<?php echo @$_POST['fcompra'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td></tr>
    <tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Alta de Equipo"> 
		</td>
	</tr>
</table>
</form>

<?php }
} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>