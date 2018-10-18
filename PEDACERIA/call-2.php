<?PHP
include("1header.php");

echo "<meta charset='utf-8'>";

if($_SESSION["callcenterH"] > 1){  // APERTURA PRIVILEGIOS // cerar privilegio call center
$subido = '';

date_default_timezone_set('America/Mexico_city');

global $id_unidad;

if(isset($_POST['id_unidad']) && $_POST['id_unidad']!='' && $_POST['id_unidad']!=0)
{
	$id_unidad = $_POST['id_unidad'];
}
else
{
	$id_unidad = $_GET['id_unidad'];
}

echo "<div class='container'>";
echo $id_unidad;

include'u4datos.php';
include'u5placas.php';
include'u11asignacion.php';

?>
<head>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php
//echo "</div>";

// CONSULTAR EJECUTIVOS PARA NORMALIZAR TABLA MTTOJTACUBA
/*
$sql_mttoSol_E 	= 'SELECT id_usuario, nombre FROM usuarios WHERE mttoSol > 1 AND externo = 0 ORDER BY nombre';
$sql_mttoSol_ER =  mysqli_query($dbd2, $sql_mttoSol_E );
*/
// CONSULTA EJECUTIVOS


//include'nav_compras.php';
 
	global $error1B;
	global $error2B;
	global $error3B;
	global $error4B;


	@$error1 = (mysqli_real_escape_string($dbd2, $_POST['usNombre']) == '' )?' -- NO DEFINIO NOMBRE DE USUARIO -- ':'';
	//@$error1B = (mysqli_real_escape_string($dbd2, $_POST['usNombre']) == '' )?'is-invalid':'';

	@$error2 = (mysqli_real_escape_string($dbd2, $_POST['usEmail']) == '' )?' -- NO DEFINIO EMAIL DE USUARIO -- ':'';
	//@$error2B = ($error2=='')?'is-invalid':'';



if(isset($_POST['Enviar']))
{

	$id_usuarioEA 	= mysqli_real_escape_string($dbd2, $_POST['id_ejecutivo']); // SE CANALIZO 
	// usuario seleccionado para while 
	// mostrar el mismo en caso de error
	$asuntoEA 		= mysqli_real_escape_string($dbd2, $_POST['asunto']);

	//$error1 = (mysqli_real_escape_string($dbd2, $_POST['usNombre']) == '' )?' -- NO DEFINIO NOMBRE DE USUARIO -- ':'';
	//$error1B = (mysqli_real_escape_string($dbd2, $_POST['usNombre']) == '' )?'is-invalid':'';
	//$error2 = (mysqli_real_escape_string($dbd2, $_POST['usEmail']) == '' )?' -- NO DEFINIO EMAIL DE USUARIO -- ':'';
	//$error2B = ($error2=='')?'is-invalid':'';
	$error3 = (mysqli_real_escape_string($dbd2, $_POST['asunto']) == '' )?' -- NO DEFINIO ASUNTO -- ':'';
	//$error3B = ($error3=='')?'is-invalid':'';
	$error4 = (mysqli_real_escape_string($dbd2, $_POST['comentario']) == '' )?' -- NO DEFINIO COMENTARIO DE USUARIO -- ':'';
	//$error4B = ($error4=='')?'is-invalid':'';

	//$id_unidad = $_POST['id_unidad'];
	echo $id_unidad."xxx";

	if(

	isset($_POST['Enviar'])

/**/
//	$_POST['id_callcenter']!='' 		
//	&& $_POST['id_unidad']!=''  
//	&& $_POST['id_cliente']!=''			
//	&& $_POST['id_contrato']!='' 
	&& $_POST['id_ejecutivo']!=''		
	&& $_POST['usNombre']!='' 
//	&& $_POST['usTelFijo']!=''			
//	&& $_POST['usTelMovil']!='' 
	&& $_POST['usEmail']!=''			
	&& $_POST['asunto']!='' 
//	&& $_POST['fechareg']!='' 			
//	&& $_POST['oficina']!=''
	&& $_POST['comentario']!='' 		
//	&& $_POST['capturo']!=''
	
	)
	{
			//$id_callcenter 	= mysqli_real_escape_string($dbd2, $_POST['id_callcenter']);
			$id_unidad 		= mysqli_real_escape_string($dbd2, $_POST['id_unidad']);
			$id_cliente 	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
			$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);

			$id_ejecutivo 	= mysqli_real_escape_string($dbd2, $_POST['id_ejecutivo']); // SE CANALIZO
			$id_usuarioEA 	= mysqli_real_escape_string($dbd2, $_POST['id_ejecutivo']); // SE CANALIZO // usuario seleccionado para while

			$usNombre 		= mysqli_real_escape_string($dbd2, $_POST['usNombre']);
			$usTelFijo 		= mysqli_real_escape_string($dbd2, $_POST['usTelFijo']);
			$usTelMovil 	= mysqli_real_escape_string($dbd2, $_POST['usTelMovil']);
			$usEmail 		= mysqli_real_escape_string($dbd2, $_POST['usEmail']);

			$asunto 		= mysqli_real_escape_string($dbd2, $_POST['asunto']);
			$comentario 	= mysqli_real_escape_string($dbd2, $_POST['comentario']);

			//$oficina 		= mysqli_real_escape_string($dbd2, $_POST['oficina']);
			$oficina 		= $_SESSION["oficina"]; // QUIEN CAPTURO REGISTRO
			$fechareg 		= date("Y-m-d H:i:s");
	
			$capturo 		= $_SESSION["id_usuario"]; // QUIEN CAPTURO REGISTRO
 
				
			//INSERTAR EN BD
			$sql_alta = '	INSERT INTO `callcenter` 
							( id_callcenter,`id_unidad`, `id_cliente`, `id_contrato`, 
							`id_ejecutivo`, 
							`usNombre`, usTelFijo,`usTelMovil`,`usEmail`, 
							`asunto`, comentario, 
							`oficina`,`fechareg`,`capturo`) 
							VALUES '; 
			$sql_alta .= "	(NULL, '$id_unidad', '$id_cliente', '$id_contrato', 
							'$id_ejecutivo', 
							'$usNombre', '$usTelFijo','$usTelMovil','$usEmail',
							'$asunto','$comentario', 
							'$oficina','$fechareg','$capturo');";
				
			echo $sql_alta;

			//$alta_ejecutada = mysqli_query($dbd2, $sql_alta);
			$id_callcenter 	= mysqli_insert_id($dbd2);
			//echo "<br>$sql_alta<br>";

			//$alta_ejecutada = 'ok';

			if(!$alta_ejecutada)
			{
				?>
				<div class="container" >
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-xs-12">
							<div class='alert alert-danger'>
									<p > <?php echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2);?> FALLO AL REGISTRAR, MENSAJE DE ERROR .  </p>
							</div>
						</div>
					</div>
				</div>
				<?php
				//echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR, MENSAJE DE ERROR \n";;
			}
			else
			{

				?>
				<div class="container" >
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-xs-12">
							<div class='alert alert-success'>
									<p >EL REGISTRO DE LA LLAMADA SE HA HECHO EXITOSAMENTE CON EL FOLIO <?php echo $id_callcenter;?> .</p>
							</div>
						</div>
					</div>
					<a class="btn btn-primary" href="index.php" role="button">IR A INICIO</a>
				</div>
				<?php
				//echo "MENSAJE DE EXITO";
				$subido = 'ok'	;// flag muestra formulario
			}
	}
	else
	{
		?>
		<div class="container" >
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<div class='alert alert-warning'>
							<p >ERROR AL REGISTRAR: FAVOR DE LLENAR DATOS COMPLETOS. <?php echo $error1.$error2.$error3.$error4;?> </p>
					</div>
				</div>
			</div>
		</div>
		<?php
		//echo "FAVOR DE LLENAR LOS DATOS MARCADOS CON ASTERISCO.";
	}
}


if($subido!='ok'){  // INICIA MOSTRAR FORMULARIO 

$oficinaM = array('SIN OFICINA ASIGNADA','JETVAN TACUBA' ,'JETVAN TLCG' ,'JETVAN PZRC' ,'JETVAN CNVC' ,'JETVAN MARN' ,'JETVAN JCHTN' ,'JETVAN RIVIERA' ,'JETVAN TOLUCA' , 'JETVAN GUANAJUATO', 'JETVAN MONTERREY','JETVAN QUERETARO');

$oficinaTxt = $oficinaM[($_SESSION['oficina'])];

$asuntoSelected = array('','','','','','','','','','',); // 10 posiciones
@$asuntoSelected[$asuntoEA] = 'selected';

?>



<div class="container"  style="background: #F5F5F5; margin-top:15px; margin-bottom:15px;">
		<br>
		<form action="" class="form-horizontal" method="POST"  >

		<div class="row">
		<div class="form-group has-warning  col-md-12">
			<label for="REGISTRO" class="control-label col-md-2 "></label>
			<div class="col-md-10">
					<h3 class="form-control-static text-success">REGISTRAR LLAMADA DE CALL CENTER</h3>
			</div>
		</div>
		</div>

		<div class="row">
        <div class="form-group  col-md-6">
			<label for="fechareg" class="control-label col-md-6">Fecha:</label>
			<div class="col-md-10">
				<input type="text" name="fechareg" value="<?php echo date("Y-m-d H:i:s");?>" class="form-control" id="fechareg" disabled>
			</div>
		</div>  


        <div class="form-group  col-md-6">
			<label for="oficina" class="control-label col-md-6">Oficina donde se registra llamada:</label>
			<div class="col-md-10">
				<input type="text" name="oficina" value="<?php echo $oficinaTxt;?>" class="form-control" id="fechareg" disabled>
			</div>
		</div>  
		</div>

		<div class="row">
        <div class="form-group  col-md-6">
			<label for="usNombre" class="control-label col-md-6">Nombre del usuario:</label>
			<div class="col-md-10">
				<input type="text" name="usNombre" value="<?php echo@$_POST['usNombre'];?>" class="form-control <?php echo $error1B;?>" id="usNombre" placeholder="usuario" required>

				<input type="hidden" value="<?php echo $id_unidad;?>" name="id_unidad">
				<input type="hidden" value="<?php echo $id_cliente;?>" name="id_cliente">
				<input type="hidden" value="<?php echo $id_contrato;?>" name="id_contrato">

			</div>
		</div>

        <div class="form-group  col-md-6">
			<label for="usEmail" class="control-label col-md-6">Correo electrónico:</label>
			<div class="col-md-10">
				<input type="email" name="usEmail" value="<?php echo@$_POST['usEmail'];?>" class="form-control <?php echo $error2B;?>" id="usEmail" placeholder="email">
			</div>
		</div>
		</div>


		<div class="row">                        
        <div class="form-group  col-md-6">
			<label for="usTelFijo" class="control-label col-md-6">Telefono fijo:</label>
			<div class="col-md-10">
				<input type="texto" name="usTelFijo" value="<?php echo@$_POST['usTelFijo'];?>" class="form-control" id="usTelFijo" placeholder="telefono">
			</div>
		</div>
                        
        <div class="form-group  col-md-6">
			<label for="usTelMovil" class="control-label col-md-6">Telefono movil:</label>
			<div class="col-md-10">
				<input type="texto" name="usTelMovil" value="<?php echo@$_POST['usTelMovil'];?>" class="form-control" id="usTelMovil" placeholder="celular">
			</div>
		</div>
		</div>




		<div class="row">  
 		<div class="form-group  col-md-6">
			<label for="asunto" class="control-label col-md-6">Asunto:</label>
			<div class="col-md-10">
				<select class="form-control <?php echo $error3B;?>" name="asunto" style='font-size:.9em;'  id="asunto">
					<option value='1' <?php echo $asuntoSelected[1];?> >Servicio Preventivo</option>
					<option value='2' <?php echo $asuntoSelected[2];?> >Servicio Correctivo</option>
					<option value='3' <?php echo $asuntoSelected[3];?> >Documentos</option>
					<option value='4' <?php echo $asuntoSelected[4];?> >Seguros</option>
					<option value='5' <?php echo $asuntoSelected[5];?> >Otro</option>
				</select>
			</div>
		</div>

        <div class="form-group  col-md-6">
			<label for="comentario" class="control-label col-md-6">Comentario:</label>
			<div class="col-md-10">
				<textarea class="form-control <?php echo $error4B;?>" name="comentario"  id="comentario" placeholder="Escribe tu comentario"><?php echo trim(@$_POST['comentario'], "	");?></textarea>
			</div>
		</div>
		</div>

		<div class="row">  
		<div class="form-group  col-md-6">
			<label for="ejecutivo" class="control-label col-md-6">Ejecutivo a quien se canalizo llamada:</label>
			<div class="col-md-10">
				<select class="form-control" name="id_ejecutivo" style='font-size:.9em;'  id="id_ejecutivo">
					
					<?php
						contratoEjecutivos($id_contrato);
						$sql_cto_ejecs_R; // viene de la funcion ejecutada

						if(mysqli_affected_rows($dbd2)==0){
						echo "<option value='0' > NO HAY ASIGNACION DE CONTRATO </option>";	
						}
						else
						{
							while($row = mysqli_fetch_assoc($sql_cto_ejecs_R))
							{
								$id_usuarioE 	= 	$row['id_usuario'];
								$nombreE 		=	strtoupper($row['nombre']);

								$checked = '';
								if($id_usuarioE == $id_usuarioEA ){$checked = 'selected';}
								echo "<option value='$id_usuarioE' style='font-size:.9em;' $checked >";
								echo "{$nombreE}";
								echo "</option>";
								$checked = '';
							}
						}
					?>
				</select>
			</div>
		</div>

		<div class="form-group col-md-6">
			<div class="col-md-1 col-md-offset-5">
				<input  class="btn btn-primary" type="submit" name="Enviar">
			</div>
		</div>
		</div>
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php 
	} // TERMINA MOSTRAR FORMULARIO

} // CIERRE PRIVILEGIOS


include ("1footer.php"); ?>