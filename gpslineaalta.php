<?php include("1header.php");?>
<?php include ("base.inc.php"); ?>

<?php if($_SESSION["gps"] > 0){ // VISTA A C4 ?>

<?php include ("nav_gps.php"); ?>




<?php 

include_once ("base.inc.php");
include_once("funcion.php");
    
?> 

<?php $subido = ''; ?>

<?php

if(isset($_POST['Datos']))
    {
	
        if($_POST['numero']!='' 
        && $_POST['region']!='' 
        && $_POST['cuenta']!=''	
        && $_POST['compania']!=''
        && $_POST['factivacion']!='' 

          )
            {		
                $numero 	= mysqli_real_escape_string($dbd2, $_POST['numero']);
                $region 	= mysqli_real_escape_string($dbd2, $_POST['region']);
                $cuenta 	= mysqli_real_escape_string($dbd2, $_POST['cuenta']);
                $compania  	= mysqli_real_escape_string($dbd2, $_POST['compania']);
                $factivacion = mysqli_real_escape_string($dbd2, $_POST['factivacion']);
               
                $capturo    = $_SESSION["id_usuario"];
            
                // VALIDAR QUE NO EXISTA PREVIAMENTE

                $sql_validarN = "SELECT numero FROM gpsLinea WHERE numero = '$numero' LIMIT 1 ";
                $validar_rsN = mysqli_query($dbd2, $sql_validarN);

                if(mysqli_affected_rows($dbd2 ) == 0 ){
					$sql_gps_linea_alta = 'INSERT INTO `jetvantlc`.`gpsLinea` 
					    (`id_linea`, `numero`, region, cuenta, `compania`, `factivacion`, `capturo`) 
					    VALUES ';
					$sql_gps_linea_alta .= "(NULL, '$numero', '$region', '$cuenta','$compania', '$factivacion', '$capturo') ;" ;
					$linea_rs = mysqli_query($dbd2, $sql_gps_linea_alta);

					    if($linea_rs){ 
					        echo '<h2>LÍNEA DADA DE ALTA CORRECTAMENTE</h2>';
					        //include ("#.php");
						}
                } else {
                	echo "<p style='background-color:#FFFF99;'><h3>Línea dada de alta previamente &#9786;</h3></p>";
                }
			
			$subido = 'ok'	;			
			}
			else
				{	
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
				}
    }

?>

<?php if($subido!='ok'){ ?>


<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<form id='alta'  action='' method='POST' > 
	<h2>ALTA DE LINEA</h2>

<table>
	<tr><th>NUMERO</th>
		<td><input type='number' name='numero' value="<?php echo @$_POST['numero'];?>" placeholder='0000000000'></td></tr>

	<tr><th>REGION</th>
		<td><input type='text' name='region' value="<?php echo @$_POST['region'];?>" placeholder='X00'></td></tr>
	<tr><th>CUENTA</th>
		<td><input type='number' name='cuenta' value="<?php echo @$_POST['cuenta'];?>" placeholder='00000000'></td></tr>

	<tr><th>COMPAÑÍA</th>
		<td><input type='text' name='compania' value="<?php echo @$_POST['compania'];?>" placeholder='compañia'></td></tr>
	<tr><th>FECHA DE ACTIVACION</th>
		<td><input type='date' name='factivacion' value="<?php echo @$_POST['factivacion'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td></tr>
    <tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Alta de Línea"> 
		</td>
	</tr>
</table>
</form>

<?php }

} // FIN PRIVILEGIO VISTA C4

include("1footer.php");?>