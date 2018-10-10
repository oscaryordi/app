<?PHP
include("1header.php");

echo "<meta charset='utf-8'>";

if($_SESSION["datos"] > 1){  // APERTURA PRIVILEGIOS // cerar privilegio call center
$subido = '';

date_default_timezone_set('America/Mexico_city');

$id_unidad = $_GET['id_unidad'];

echo "<div class='container'>";

include'u4datos.php';
include'u5placas.php';
include'u11asignacion.php';

echo "</div>";

//include'nav_compras.php';



	$error15 = '';

if(isset($_POST['Enviar']))
{

	$id_unidad = $_POST['id_unidad'];
	echo $id_unidad."xxx";

	if(

	isset($_POST['Enviar'])

/*
	$_POST['id_callcenter']!='' 		
	&& $_POST['id_unidad']!=''  
	&& $_POST['id_cliente']!=''			
	&& $_POST['id_contrato']!='' 
	&& $_POST['id_ejecutivo']!=''		
	&& $_POST['usNombre']!='' 
	&& $_POST['usTelFijo']!=''			
	&& $_POST['usTelMovil']!='' 
	&& $_POST['usEmail']!=''			
	&& $_POST['asunto']!='' 
	&& $_POST['fechareg']!='' 			
	&& $_POST['oficina']!=''
	&& $_POST['comentario']!='' 		
	&& $_POST['capturo']!=''
*/
	
	)
	{
			//$id_callcenter 	= mysqli_real_escape_string($dbd2, $_POST['id_callcenter']);
			$id_unidad 		= mysqli_real_escape_string($dbd2, $_POST['id_unidad']);
			$id_cliente 	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
			$id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);

			$id_ejecutivo 	= mysqli_real_escape_string($dbd2, $_POST['id_ejecutivo']); // SE CANALIZO

			$usNombre 		= mysqli_real_escape_string($dbd2, $_POST['usNombre']);
			$usTelFijo 		= mysqli_real_escape_string($dbd2, $_POST['usTelFijo']);
			$usTelMovil 	= mysqli_real_escape_string($dbd2, $_POST['usTelMovil']);
			$usEmail 		= mysqli_real_escape_string($dbd2, $_POST['usEmail']);

			$asunto 		= mysqli_real_escape_string($dbd2, $_POST['asunto']);
			$comentario 	= mysqli_real_escape_string($dbd2, $_POST['comentario']);

			$oficina 		= mysqli_real_escape_string($dbd2, $_POST['oficina']);

			$fechareg 		= date("Y-m-d H:i:s");
	
			$capturo 		= $_SESSION["id_usuario"]; // QUIEN CAPTURO REGISTRO
 
				
			//INSERTAR EN BD
			$sql_alta = 'INSERT INTO `REGISTRO` 
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
			$id_unidad 		= mysqli_insert_id($dbd2);

			//echo "<br>$sql_alta<br>";

			if(!$alta_ejecutada){
				echo mysqli_errno($dbd2) . ": " . mysqli_error($dbd2). " FALLO AL REGISTRAR, MENSAJE DE ERROR \n";;
			}
			else
			{
				echo "MENSAJE DE EXITO";
				$subido = 'ok'	;// flag muestra formulario
			}
			
	}
}


if($subido!='ok'){  // INICIA MOSTRAR FORMULARIO ?>

<head>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<div class="container">
		<br>
		<form action="" class="form-horizontal" method="POST">
  
		<div class="form-group has-warning">
			<label for="REGISTRO" class="control-label col-md-2 "></label>
			<div class="col-md-10">
					<h3 class="form-control-static text-success">REGISTRAR LLAMADA DE CALL CENTER</h3>
			</div>
		</div>

        <div class="form-group  col-md-6">
			<label for="usNombre" class="control-label col-md-6">Nombre del usuario:</label>
			<div class="col-md-10">
				<input type="text" name="usNombre" value="<?php echo@$_POST['usNombre'];?>" class="form-control" id="usNombre" placeholder="usuario">

				<input type="hidden" value="<?php echo $id_unidad;?>" name="id_unidad">
				<input type="hidden" value="<?php echo $id_cliente;?>" name="id_cliente">
				<input type="hidden" value="<?php echo $id_contrato;?>" name="id_contrato">

			</div>
		</div>

        <div class="form-group  col-md-6">
			<label for="usEmail" class="control-label col-md-6">Correo electrónico:</label>
			<div class="col-md-10">
				<input type="email" name="usEmail" value="<?php echo@$_POST['usEmail'];?>" class="form-control" id="usEmail" placeholder="email">
			</div>
		</div>
                        
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

        <div class="form-group  col-md-6">
			<label for="comentario" class="control-label col-md-6">Comentario:</label>
			<div class="col-md-10">
				<textarea class="form-control" name="comentario"  id="comentario" placeholder="Escribe tu comentario"><?php echo trim(@$_POST['comentario'], "	");?></textarea>
			</div>
		</div>

		<div class="form-group  col-md-6">
			<label for="ejecutivo" class="control-label col-md-6">Ejecutivo a quien se canalizo llamada:</label>
			<div class="col-md-10">
				<select class="form-control" name="ejecutivo" value="<?php echo@$_POST['id_ejecutivo'];?>" id="id_ejecutivo">
					<option value="1000">Ejecutivo #1000</option>
					<option value="2000">Ejecutivo #2000</option>
					<option value="3000">Ejecutivo #3000</option>
					<option value="4000">Ejecutivo #4000</option>
					<option value="5000">Ejecutivo #5000</option>
				</select>
			</div>
		</div>

		<div class="form-group  col-md-6">
			<label for="oficina" class="control-label col-md-6">Oficina que recibe llamada:</label>
			<div class="col-md-10">
				<select class="form-control" name="oficina" value="<?php echo@$_POST['oficina'];?>" id="oficina">
					<option value="">Tacuba</option>
					<option value="">Rio San Joaquin</option>
					<option value="">Pensilvania</option>
					<option value="">Cuernavaca</option>
					<option value="">Toluca</option>
				</select>
			</div>
		</div>
 
         <div class="form-group  col-md-6">
			<label for="fechareg" class="control-label col-md-6">Fecha:</label>
			<div class="col-md-10">
				<input type="text" name="fechareg" value="<?php echo date("Y-m-d H:i:s");?>" class="form-control" id="fechareg" disabled>
			</div>
		</div>

		<div class="form-group col-md-6">
			<div class="col-md-1 col-md-offset-5">
				<input  class="btn btn-primary" type="submit" name="Enviar">
			</div>
		</div>
	</form>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php } // TERMINA MOSTRAR FORMULARIO
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>