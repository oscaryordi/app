<?php 
include_once("base.inc.php");
include_once("funcion.php");

$sql_mttoSol 	= "	SELECT * FROM `mttoSol` 
					WHERE `id_mttoSol` = '$id_mttoSol' LIMIT 1 ";
$sql_mttoSol_R 	= mysqli_query($dbd2, $sql_mttoSol);
@$sql_mttoSol_M = mysqli_fetch_array($sql_mttoSol_R);

@$concepto 		=	strtoupper($sql_mttoSol_M['concepto']);
@$importe 		=	$sql_mttoSol_M['importe'];
@$km 			= 	$sql_mttoSol_M['km'];
@$obs 			=	strtoupper($sql_mttoSol_M['obs']);

$t1ckd 	= $sql_mttoSol_M['t1'];
$t2ckd 	= $sql_mttoSol_M['t2'];
$t3ckd 	= $sql_mttoSol_M['t3'];
$t4ckd 	= $sql_mttoSol_M['t4'];
$t5ckd 	= $sql_mttoSol_M['t5'];
$t6ckd 	= $sql_mttoSol_M['t6'];
$t7ckd 	= $sql_mttoSol_M['t7'];
$t8ckd 	= $sql_mttoSol_M['t8'];
$t9ckd 	= $sql_mttoSol_M['t9'];
$t10ckd = $sql_mttoSol_M['t10'];
$t11ckd = $sql_mttoSol_M['t11'];
$t12ckd = $sql_mttoSol_M['t12'];
$t13ckd = $sql_mttoSol_M['t13'];

if($t1ckd == 1){ $t1ckd = 'checked';} else {$t1ckd = '';}
if($t2ckd == 1){ $t2ckd = 'checked';} else {$t2ckd = '';}
if($t3ckd == 1){ $t3ckd = 'checked';} else {$t3ckd = '';}
if($t4ckd == 1){ $t4ckd = 'checked';} else {$t4ckd = '';}
if($t5ckd == 1){ $t5ckd = 'checked';} else {$t5ckd = '';}
if($t6ckd == 1){ $t6ckd = 'checked';} else {$t6ckd = '';}
if($t7ckd == 1){ $t7ckd = 'checked';} else {$t7ckd = '';}
if($t8ckd == 1){ $t8ckd = 'checked';} else {$t8ckd = '';}
if($t9ckd == 1){ $t9ckd = 'checked';} else {$t9ckd = '';}
if($t10ckd == 1){ $t10ckd = 'checked';} else {$t10ckd = '';}
if($t11ckd == 1){ $t11ckd = 'checked';} else {$t11ckd = '';}
if($t12ckd == 1){ $t12ckd = 'checked';} else {$t12ckd = '';}
if($t13ckd == 1){ $t13ckd = 'checked';} else {$t13ckd = '';}

echo "<h2><span style='color:blue;' >DATOS NUEVOS</span></h2>";




proveedorxid($id_prov);
provCtaxid($id_prov_c);

?>

<form action="" method="POST"  enctype="multipart/form-data" >

<table>





	<tr>
		<td style='vertical-align: top;'>
			
			<b>PROVEEDOR ACTUAL</b> 
			 <br>Razon Social:  
			<?php  if($esreembolso == 1){echo "REEMBOLSO :  $nombreR ";}else{echo "&nbsp". $PrazonSocial;} // PROVEEDOR ?>
			 <br>RFC:  
			<?php  if($esreembolso == 1){echo " &nbsp; Facturado por : $Prfc :::  $PrazonSocial ";}else{echo "&nbsp". $Prfc;} // PROVEEDOR ?>
			
		</td>
		<td>
 
			<b>DATOS PARA PAGO ACTUALES</b> 
			<br>Nombre: 
			<?php echo "&nbsp". $nombreR; // REEMBOLSO ?>
			<br>Clabe: 
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCclabe;} // PROVEEDOR ?>
			<?php echo "&nbsp". $clabeR; // REEMBOLSO ?>
			<br>Cuenta:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCcuenta;} // PROVEEDOR ?>
			<?php echo "&nbsp". $cuentaR; // REEMBOLSO ?>
			<br>Sucursal:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCsucursal;} // PROVEEDOR ?>
			<?php echo "&nbsp". $sucR; // REEMBOLSO ?>
			<br>Banco:
			<?php  if($esreembolso == 1){echo "";}else{echo "&nbsp". $PCbanco;} // PROVEEDOR ?>
			<?php echo "&nbsp". $bancoR; // REEMBOLSO ?>
 
		</td>
	</tr>





<tr>
	<th>TIPO DE SERVICIO

	</th>
	<td>
		<table id='cuadrotiposervicio'>
		<tr>
			<td>
			<input type="checkbox" id="preventivo" name="preventivo" class = 'checkST' value="1" <?php echo $t1ckd;?> disabled >
			<label for = "preventivo" >PREVENTIVO</label>
			</td><td>
			<input type="checkbox" id="frenos" name="frenos"  class = 'checkST' value="1"  <?php echo $t2ckd;?> disabled  >
			<label for = "frenos" >FRENOS</label>
			</td><td>
			<input type="checkbox" id="susp" name="susp"  class = 'checkST' value="1"  <?php echo $t3ckd;?>  disabled >
			<label for = "susp" >SUSPENSION</label>
			</td><td>
			<input type="checkbox" id="dir" name="dir"  class = 'checkST' value="1"  <?php echo $t4ckd;?>  disabled >
			<label for = "dir" >DIRECCION</label>
			</td>
			<td>
			<input type="checkbox" id="deducible" name="deducible"  class = 'checkST' value="1" <?php echo $t13ckd;?> disabled >
			<label for = "deducible" ><span style='color:red;'>DEDUCIBLE</span></label>
			</td>
		</tr><tr>
			<td>
			<input type="checkbox" id="clima" name="clima"  class = 'checkST' value="1"  <?php echo $t5ckd;?>  disabled >
			<label for = "clima" >CLIMA</label>
			</td><td>
			<input type="checkbox" id="motor" name="motor"  class = 'checkST' value="1"  <?php echo $t6ckd;?>  disabled >
			<label for = "motor" >MOTOR</label>
			</td><td>
			<input type="checkbox" id="enfria" name="enfria"  class = 'checkST' value="1"  <?php echo $t7ckd;?>  disabled >
			<label for = "enfria" >ENFRIAMIENTO</label>
			</td><td>
			<input type="checkbox" id="transmision" name="transmision"  class = 'checkST' value="1"  <?php echo $t8ckd;?>  disabled >
			<label for = "transmision" >TRANSMISION</label>
			</td>
			<td></td>
		</tr><tr>
			<td>
			<input type="checkbox" id="llantas" name="llantas"  class = 'checkST' value="1"  <?php echo $t9ckd;?>  disabled >
			<label for = "llantas" >LLANTAS</label>
			</td><td>
			<input type="checkbox" id="hojalateria" name="hojalateria"  class = 'checkST' value="1"  <?php echo $t10ckd;?>  disabled >
			<label for = "hojalateria" >HOJALATERIA</label>
			</td><td>
			<input type="checkbox" id="electrico" name="electrico"  class = 'checkST' value="1"  <?php echo $t11ckd;?>  disabled >
			<label for = "electrico" >ELECTRICO</label>
			</td><td>
			<input type="checkbox" id="electron" name="electron"  class = 'checkST' value="1"  <?php echo $t12ckd;?>  disabled >
			<label for = "electron" >ELECTRONICO</label>
			</td>
			<td></td>
		</tr>
		</table>	
	</td>
</tr>

<tr>
	<th>KILOMETRAJE
	</th>
	<td>
	<input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="<?php echo $km;?>" placeholder="0000" required style="text-align: right;"  disabled > 0000
	</td>
</tr>
<tr>

<tr>
	<th>IMPORTE IVA INCLUIDO
	</th>
	<td>
		<b>$</b><input type="number" lang="nb" step="0.01" min="0" name="importe" value="<?php echo $importe;?>"  required style="text-align: right;" max='200000'  disabled > 0000.00 sin comas
	</td>
</tr>

<tr>
	<th>DESCRIPCION/CONCEPTO</th>
	<td>
		<textarea name="concepto" id="concepto" 
		onKeyDown="cuenta2()" onKeyUp="cuenta2()" cols="50" rows="2" 
		value=""  maxlength='250' required  disabled ><?php echo $concepto;?></textarea>
	</td>
</tr>	

<tr>
	<th>OBSERVACIONES</th>
	<td>
		<textarea name="obs"  cols="50" rows="2" 
		value=""  maxlength='250'  disabled ><?php echo $obs;?></textarea>
		
	</td>
</tr>

</table>
</form>
