<?php include("1header.php");?>
<meta charset='utf-8'>

<?php  if($_SESSION["mttos"] > 4){  // APERTURA PRIVILEGIOS ?>

<?php 
include_once ("base.inc.php");
include_once("funcion.php");
    
$id_unidad = mysql_real_escape_string($_GET['id_unidad'], $conectar);
$id_cliente = mysql_real_escape_string($_GET['id_cliente'], $conectar);
$id_contrato = mysql_real_escape_string($_GET['id_contrato'], $conectar);

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    
    
include ("u4datos.php");
include ("u5placas.php");

include ("mttoSolCreaDir.php"); // Se obtiene la ruta y la crea si no existe

$cantidad_archivos= 1; //la cantidad máxima de archivos que se permitirá enviar.

?> 

<?php $subido = ''; // CONDICION PARA MOSTRAR FORMULARIO?>

<?php

if(isset($_POST['DatosM']))
    {
        if($_POST['km']!='' 
        && $_POST['importe']!='' 
        && $_POST['concepto']!='' 
        && @$_POST['id_prov']!='' 
        && @$_POST['id_cuenta']!='' 
        )
            {		
               	// INICIA limpiar y validad variables
               	$importe 	=mysql_real_escape_string($_POST['importe'],$conectar);
                $concepto   =mysql_real_escape_string($_POST['concepto'],$conectar);
				$km  		=mysql_real_escape_string($_POST['km'],$conectar);

                $id_prov 	=mysql_real_escape_string($_POST['id_prov'],$conectar);
                $id_cuenta 	=mysql_real_escape_string($_POST['id_cuenta'],$conectar);
				$id_sucursal =mysql_real_escape_string($_POST['id_sucursal'],$conectar);

                @$preventivo 	= @$_POST['preventivo']+0;
                @$frenos 		= @$_POST['frenos']+0;
				@$susp 			= @$_POST['susp']+0;
				@$dir 			= @$_POST['dir']+0;

				@$clima 		= @$_POST['clima']+0;				
				@$motor 		= @$_POST['motor']+0;
				@$enfria 		= @$_POST['enfria']+0;
				@$transmision 	= @$_POST['transmision']+0;

				@$llantas 		= @$_POST['llantas']+0;
				@$hojalateria 	= @$_POST['hojalateria']+0;
				@$electrico 	= @$_POST['electrico']+0;
				@$electron 		= @$_POST['electron']+0;

                $capturo       	= $_SESSION["id_usuario"];

				@$reembolso 	= @$_POST['reembolso']+0;

				if($reembolso == 1)
				{
	                $nombreR 	=mysql_real_escape_string($_POST['nombreR'],$conectar);
	                $clabeR   	=mysql_real_escape_string($_POST['clabeR'],$conectar);
					$cuentaR  	=mysql_real_escape_string($_POST['cuentaR'],$conectar);
	               	$sucR   	=mysql_real_escape_string($_POST['sucR'],$conectar);
					$bancoR  	=mysql_real_escape_string($_POST['bancoR'],$conectar);
				}
				// TERMINA limpiar y validad variables

				// INICIA insertar solicitud en tabla mttoSol
				$sql_mttoSol = "INSERT INTO mttoSol (
				id_mttoSol, id_unidad, id_cliente, id_contrato, 
				fechaEj, 
				concepto, importe, km, obs, 
				id_prov, id_prov_c, id_prov_s, 
				capturo, 
				t1, t2, t3, t4, 
				t5, t6, t7, t8, 
				t9, t10, t11, t12
				) 
				VALUES ( 
				NULL, '$id_unidad','$id_cliente','$id_contrato',
				CURRENT_TIMESTAMP,
				'$concepto','$importe','$km','',
				'$id_prov','$id_cuenta','$id_sucursal',
				'$capturo',
				'$preventivo','$frenos','$susp','$dir',
				'$clima','$motor','$enfria','$transmision',
				'$llantas','$hojalateria','$electrico','$electron'
				)";
				$sql_mttoSol_R = mysql_query($sql_mttoSol);
				$id_mttoSol_FA = mysql_insert_id(); // ESTE PARECE SER EL METODO MAS EFECTIVO DE OBTENER EL ULTIMO ID
				// TERMINA insertar solicitud en tabla mttoSol

				if(!$sql_mttoSol_R)
					{
						echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR LA SOLICITUD \n";
					}
				else{
						echo "<br><h2>REGISTRO DE SOLICITUD EXITOSO CON ID $id_mttoSol_FA </h2><br>";
					}

				// INICIA OBTENER ID de solicitud recien hecha
				if($sql_mttoSol_R){
					$sql_id_mttoSol = "SELECT id_mttoSol FROM mttoSol WHERE id_unidad = '$id_unidad' AND id_contrato = '$id_contrato' AND id_prov = '$id_prov' 
					AND importe = '$importe' AND km = '$km' ";
					$sql_id_mttoSol_R = mysql_query($sql_id_mttoSol);
					$sql_id_mttoSol_Matriz	= mysql_fetch_array($sql_id_mttoSol_R);
					$id_mttoSol 	= $sql_id_mttoSol_Matriz['id_mttoSol'];
				}
				// TERMINA OBTENER ID de solicitud recien hecha

				echo "<BR> ULTIMO ID FORMULA DIRECTA: $id_mttoSol_FA , CON QUERY Y TODO EL ROLLO: $id_mttoSol <BR>";

				// INICIA capturar datos reembolso
				if($reembolso == 1)
				{
					$sql_reembolso = "INSERT INTO mttoSolRemb (id_reembolso, id_mttoSol, nombreR, clabeR, cuentaR, sucR, bancoR) 
									VALUES ( NULL,   
									'$id_mttoSol', '$nombreR','$clabeR','$cuentaR','$sucR','$bancoR'
									)";
					$sql_reembolso_R = mysql_query($sql_reembolso);
					if(!$sql_reembolso_R)
										{
											echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR DATOS DE REEMBOLSO \n";
										}
									else{
											echo "<br><h3>REGISTRO DE REEMBOLSO EXITOSO</h3><br>";
										}
				}
				// TERMINA capturar datos reembolso


				// SI SE REGISTRO LA SOLICITUD PROCEDEMOS A INTENTAR SUBIR EL ARCHIVO
					
				if($sql_mttoSol_R)
				{	
					//INICIA comprobamos si se seleccionaron archivos, los cargamos en el servidor
					if (isset($_FILES['archivo']['tmp_name'])) 
						{
							$i=0;
							do  {
									if($_FILES['archivo']['tmp_name'][$i] !="")
									{
										//INICIA VALIDAR FORMATO DE ARCHIVO
										$target_file	= basename($_FILES['archivo']['name'][$i]);
										$subirAutorizado = 1;
										$fileType 		= pathinfo($target_file, PATHINFO_EXTENSION);
											// Algoritmo de validacion de extension
											if( $fileType != "png" &&
												$fileType != "jpg" &&
												$fileType != "tiff" &&
												$fileType != "xls" &&
												$fileType != "xlsx" &&
												$fileType != "doc" &&
												$fileType != "docx" &&
												$fileType != "odp" &&
												$fileType != "odg" &&
												$fileType != "pot" &&
												$fileType != "xml" &&
												$fileType != "pdf" &&
												$fileType != "bmp" &&
												$fileType != "gif" &&
												$fileType != "tif" &&
												$fileType != "ods" &&
												$fileType != "jpeg" &&
												$fileType != "odt" &&
												$fileType != "pptx" &&
												$fileType != "pptx" 
												 )	{
														echo "Formato de ARCHIVO ANEXADO NO VALIDO!!!";
														$subirAutorizado = 0;
													}
										//TERMINA VALIDAR FORMATO DE ARCHIVO

										// INICIA si el formato es correcto lo copiamos
										if($subirAutorizado == 1){ 
										$fecha = time();
										$aleatorio1 = rand();
										$aleatorio = $fecha.'-'.$aleatorio1;
										$nuevonombre = $aleatorio.'-'.$_FILES['archivo']['name'][$i];
										copy($_FILES['archivo']['tmp_name'][$i], '../exp/mtto/'.$rutaz.'/'.$nuevonombre);
										} 
										// TERMINA si el formato es correcto lo copiamos
									}	
									$i++;
								} while ($i < $cantidad_archivos);
						}
					//TERMINA comprobamos si se seleccionaron archivos, los cargamos en el servidor
					
					// INICIA SI LA CARGA FUE CORRECTA registramos en base de datos
					if(file_exists('../exp/mtto/'.$rutaz.'/'.$nuevonombre)){
						$sql_mttoSol_Cot = "INSERT INTO mttoDocto (id_docto, id_mttoSol, archivo, tipo, ruta, id_capturo, fechareg) 
											VALUES (
											NULL, '$id_mttoSol', '$nuevonombre', '1', '$rutaz', '$capturo', CURRENT_TIMESTAMP 
											)";
						$sql_mttoSol_Cot_R = mysql_query($sql_mttoSol_Cot);
						if(!$sql_mttoSol_Cot_R)
						{
							echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL CARGAR ARCHIVO DE COTIZACIÓN \n";
						}
						else{
								echo "<br><h3>ARCHIVO DE COTIZACIÓN SUBIDO Y REGISTRADO CORRECTAMENTE</h3><br>";
							}
					}
					// TERMINA SI LA CARGA FUE CORRECTA registramos en base de datos
				}

            
				echo $importe.",".$concepto.",km".$km
				.",<br> P".$id_prov.",Pc".$id_cuenta.",Ps".$id_sucursal
				.",<br>Un".$id_unidad.",Cte".$id_cliente.",Cto".$id_contrato
				.",<br>b1".$preventivo.",".$frenos.",".$susp.",".$dir
				.",<br>b2".$clima.",".$motor.",".$enfria.",".$transmision
				.",<br>b3".$llantas.",".$hojalateria.",".$electrico.",".$electron
				.",<br>USR".$capturo 
				.",<br> R".$reembolso.",nR".$nombreR.",cR".$clabeR.",ctR".$cuentaR.",sR".$sucR.",bR".$bancoR
				.",<br> aN-".$nuevonombre.",aN".$rutaz
				;

				$subido = 'ok'	;
			}
						
		else
		{	
			echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos , SE DEBE INDICAR PROVEEDOR Y UNA CUENTA VÁLIDA &#9786;</p>";
		}
	}  
?>

<?php 
	if($subido!='ok') { // APERTURA MOSTRAR FORMULARIO
?>

<style>
	.cuadrotiposervicio, label {font-size: .8em;}
	.cuadrotiposervicio, select {font-size: 1em;}
	.cuadrotiposervicio, option {font-size: 1em;}
	.checkST {font-size: .8em;}
	#alta input {min-width:200px;} #alta #gobutton {width:auto;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
     $(document).ready(function()
	{
         $('#search14').keyup(function()
		{
         var search14 = $('#search14').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search14:search14},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result14').html(data);
					}
				}
			});
        });


    $('#hasPets').on('change', function(){
        if($(this).is(':checked')){
            $('#pets-row').show();
        }
        else{
            $('#pets-row').hide();
        }
    });
    $('#hasPets').trigger('change');


    
     });
</script>
<?php // FUNCION BUSCA SUCURSAL POR EL VALOR DEL ID_PROVEEDOR IGUALMENTE OBTIENE LAS CUENTAS BANCARIAS ?>
<script>
 function buscaSucursal()
		{
         var search15 = $('#search15').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search15:search15},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result15').html(data);
					}
				}
			});
        };
</script>

<?php // FECHA Y HORA DE CIUDAD DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>

<?php if($cantidad_archivos > 1) {$plural='s';} else {$plural='';} ?>

<fieldset><legend><H2>SOLICITUD DE MANTENIMIENTO</H2></legend>



<form action="" method="POST"  enctype="multipart/form-data" >

<table>
<tr>
	<th>PRINCIPALES
	</th>
	<td>
	<input type="text" name="id_unidad"  value="<?php echo $id_unidad;?>" placeholder="Unidad" disabled >
	<input type="text" name="id_contrato"  value="<?php echo $id_cliente;?>" placeholder="Contrato" disabled >
	<input type="text" name="id_cliente"  value="<?php echo $id_contrato;?>" placeholder="Cliente" disabled >

	</td>
</tr>
<tr>
	<th>TIPO DE SERVICIO
	</th>
	<td>
		<table id='cuadrotiposervicio'>
		<tr>
			<td>
			<input type="checkbox" id="preventivo" name="preventivo" class = 'checkST' value="1" >
			<label for = "preventivo" >PREVENTIVO</label>
			</td><td>
			<input type="checkbox" id="frenos" name="frenos"  class = 'checkST' value="1">
			<label for = "frenos" >FRENOS</label>
			</td><td>
			<input type="checkbox" id="susp" name="susp"  class = 'checkST' value="1" >
			<label for = "susp" >SUSPENSION</label>
			</td><td>
			<input type="checkbox" id="dir" name="dir"  class = 'checkST' value="1" >
			<label for = "dir" >DIRECCION</label>
			</td>
		</tr><tr>
			<td>
			<input type="checkbox" id="clima" name="clima"  class = 'checkST' value="1" >
			<label for = "clima" >CLIMA</label>
			</td><td>
			<input type="checkbox" id="motor" name="motor"  class = 'checkST' value="1" >
			<label for = "motor" >MOTOR</label>
			</td><td>
			<input type="checkbox" id="enfria" name="enfria"  class = 'checkST' value="1" >
			<label for = "enfria" >ENFRIAMIENTO</label>
			</td><td>
			<input type="checkbox" id="transmision" name="transmision"  class = 'checkST' value="1" >
			<label for = "transmision" >TRANSMISION</label>
			</td>
		</tr><tr>
			<td>
			<input type="checkbox" id="llantas" name="llantas"  class = 'checkST' value="1" >
			<label for = "llantas" >LLANTAS</label>
			</td><td>
			<input type="checkbox" id="hojalateria" name="hojalateria"  class = 'checkST' value="1" >
			<label for = "hojalateria" >HOJALATERIA</label>
			</td><td>
			<input type="checkbox" id="electrico" name="electrico"  class = 'checkST' value="1" >
			<label for = "electrico" >ELECTRICO</label>
			</td><td>
			<input type="checkbox" id="electron" name="electron"  class = 'checkST' value="1" >
			<label for = "electron" >ELECTRONICO</label>
			</td>
		</tr>
		</table>	
	</td>
</tr>
<tr>
	<th>KILOMETRAJE
	</th>
	<td>
	<input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="" placeholder="0000" required style="text-align: right;" > 0000
	</td>
</tr>
<tr>
<tr>
	<th>IMPORTE IVA INCLUIDO
	</th>
	<td>
		<b>$</b><input type="number" lang="nb" step="0.01" min="0" name="importe" value="0<?php //echo $cuenta; ?>"  required style="text-align: right;" max='200000' > 0000.00 sin comas
	</td>
</tr>


<?php  /////////////////////////////////////////////INICIA CUENTA CARACTERES ?>
	<script>
		function cuenta2()
		{
			document.getElementById("conceptoCTA").value=document.getElementById("concepto").value.length	
		}
	</script>
<tr>
	<th>DESCRIPCION/CONCEPTO</th>
	<td>
		<textarea name="concepto" id="concepto" 
		onKeyDown="cuenta2()" onKeyUp="cuenta2()" cols="50" rows="2" 
		value="<?php //echo $cuenta; ?>"  maxlength='250' required ></textarea><br>
		Máximo 250 caracteres
		<input type='text' id='conceptoCTA' name='conceptoCTA' size='4' disabled >
	</td>
</tr>	
<?php  /////////////////////////////////////////////TERMINA CUENTA CARACTERES ?>




	<tr style='height: 7.5em;'><th>PROVEEDOR</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search14' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result14"></div>
			<div id="result15"></div>
		</td>
	</tr>




<?php // INICIO DATOS PARA REEMBOLSO ?>

<tr>
    <th>
        <label>REEMBOLSO</label>
        <input type="checkbox" id="hasPets" name="reembolso"  value="1" />
    </th>   
    <td>
        <div id="pets-row">
        <table>
        	<tr>
        		<td colspan='2'>Llenar los siguientes datos:  </td>
		    </tr><tr>
		    	<td><label for = "nombreR">NOMBRE:</label></td>
		    	<td><input type='text' id="pet" name="nombreR" >Obligatorio</td>
		    </tr><tr>
		    	<td><label for = "clabeR">CLABE-:</label></td><td>
		    	<input type='number' id="pet" name="clabeR" >Obligatorio</td>
		    </tr><tr>
		    	<td><label for = "cuentaR">CUENTA:</label></td><td>
		    	<input type='number' id="pet" name="cuentaR" > </td>
		    </tr><tr>
		    	<td><label for = "sucR">SUCURSAL:</label></td><td>
		    	<input type='text' id="pet" name="sucR" ></td>
		    </tr><tr>
		    	<td><label for = "bancoR">BANCO-:</label></td><td>
		    	<input type='text' id="pet" name="bancoR" >Obligatorio</td>
		    </tr>
        </table>
        </div> 
	</td>
</tr>

<?php // TERMINA DATOS PARA REEMBOLSO ?>



<?php // INICIO CARGA DE COTIZACION ?>

<tr><th>
			ANEXAR COTIZACIÓN
</th><td>
				Puede subir hasta <?=$cantidad_archivos?> archivo<?=$plural?> a la vez.
			<input type="file" class="multi max-<?=$cantidad_archivos?>"  name="archivo[]" value="<?=$_FILES['archivos']?>"></p>
</td></tr>



<?php // TERMINA CARGA DE COTIZACION ?>


 <tr>
	<td colspan=2 style="text-align:center;" >
	<input id="gobutton2" type="submit" name="DatosM" value="Registrar Mantenimiento"> 
	</td>
</tr>


</table>
</form>

</fieldset>

<?php } //CIERRE MOSTRAR FORMULARIO?>

<?php include ("u8mtto.php");  ?>
<?php // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
 // BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA ?> 

<?php  } // CIERRE PRIVILEGIOS ?>	
<?php include ("1footer.php"); ?>