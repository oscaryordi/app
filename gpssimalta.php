<?php
include("1header.php");

if($_SESSION["gps"] > 0){ // VISTA A C4
include ("nav_gps.php");

$subido = '';

if(isset($_POST['Datos']))
    {
        if($_POST['numerosim']!='' 
        && $_POST['version']!=''
        && $_POST['fstock']!='' 
          )
            {		
                $numeroSim 	= mysqli_real_escape_string($dbd2, $_POST['numerosim']);
                $version  	= mysqli_real_escape_string($dbd2, $_POST['version']);
                $fstock 	= mysqli_real_escape_string($dbd2, $_POST['fstock']);
               
                $capturo    = $_SESSION["id_usuario"];
            
                // VALIDAR QUE NO EXISTA PREVIAMENTE

                $sql_validarNS = "SELECT numeroSim FROM gpsSim WHERE numeroSim = '$numeroSim' LIMIT 1 ";
                $validar_rsNS = mysqli_query($dbd2, $sql_validarNS);

                if(mysqli_affected_rows($dbd2 ) == 0 )
                {
					$sql_gps_SIM_alta = 'INSERT INTO `jetvantlc`.`gpsSim` 
					    (`id_sim`, `numeroSim`, `version`, `fstock`, `capturo`) VALUES ';
					$sql_gps_SIM_alta .= "(NULL, '$numeroSim', '$version', '$fstock', '$capturo') ;" ;
					$SIM_rs = mysqli_query($dbd2, $sql_gps_SIM_alta);

					    if($SIM_rs)
					    { 
					        echo '<h2>SIM DADO DE ALTA CORRECTAMENTE</h2>';
					        //include ("#.php");
						}
                }
                else 
                {
                	echo "<p style='background-color:#FFFF99;'><h3>SIM dado de alta previamente &#9786;</h3></p>";
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
	<h2>ALTA DE SIM CHIP</h2>

<table>
	<tr><th>NUMERO SIM</th>
		<td><input type='text' name='numerosim' value="<?php echo @$_POST['numerosim'];?>" placeholder='0000000000'></td></tr>
	<tr><th>VERSION</th>
		<td><input type='text' name='version' value="<?php echo @$_POST['version'];?>" placeholder='version'></td></tr>


	<tr><th>FECHA EN STOCK</th>
		<td><input type='date' name='fstock' value="<?php echo @$_POST['fstock'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td></tr>
    <tr>
		<td colspan=2 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Alta de SIM"> 
		</td>
	</tr>
</table>
</form>

<?php } 
} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>