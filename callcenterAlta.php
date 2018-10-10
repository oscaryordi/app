<?php
include'1header.php';






?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Call center</title>
			<meta name="viewport" content="width=device-width, user-scalable=no, intial-scale=1.0, minimun-scale=1.0"/>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
		<br>
		<form action="" class="form-horizontal">
        
        <div class="form-group has-warning">
          
			<label for="DATOS" class="control-label  "></label>
			<div class="col-md-10">
				<h3 class="form-control-static text-success">DATOS VEHICULARES:</h3>
			</div>
		</div>
            
		<div class="form-group col-md-6">
			<label for="placas" class="control-label col-md-2">Placas</label>
			<div class="col-md-10">
				<input type="text" name="placas" value="<?php echo@$_POST['placas'];?>"class="form-control" id="placas" placeholder="Placas" required>
			</div>
		</div>

			<div class="form-group col-md-6">
				<div class="col-md-2 col-md-offset-2">
				<button class="btn btn-primary">Buscar</button>
			</div>
		</div>
        
  
		<div class="form-group  col-md-6">
				<label for="contrato" class="control-label col-md-2">Contrato</label>
				<div class="col-md-10">
					<input type="texto" class="form-control" id="contrato" placeholder="Contrato" disabled>
				</div>
			</div>
				<div class="form-group  col-md-6">
				<label for="cliente" class="control-label col-md-2">Cliente</label>
				<div class="col-md-10">
					<input type="texto" class="form-control" id="cliente" placeholder="Cliente" disabled>
				</div>
			</div>
		<div class="form-group  col-md-6">
			<label for="option" class="control-label col-md-2">Ejecutivo:</label>
				<div class="col-md-10">
					<select class="form-control" name="" id="option">
						<option value="">Ejecutivo #</option>
						<option value="">Ejecutivo #</option>
						<option value="">Ejecutivo #</option>
						<option value="">Ejecutivo #</option>
						<option value="">Ejecutivo #</option>
					</select>
				</div>
		</div>
  
			<div class="form-group has-warning">
          
				<label for="REGISTRO" class="control-label col-md-2 "></label>
				<div class="col-md-10">
					<h3 class="form-control-static text-success">REGISTRO</h3>
				</div>
			</div>

			            
			<div class="form-group  col-md-6">
				<label for="usuario" class="control-label col-md-6">Nombre del usuario:</label>
				<div class="col-md-10">
					<input type="texto" class="form-control" id="usuario" placeholder="usuario">
				</div>
			</div>
            
                        
            <div class="form-group  col-md-6">
				<label for="tel" class="control-label col-md-6">Telefono fijo:</label>
				<div class="col-md-10">
					<input type="texto" class="form-control" id="tel" placeholder="telefono">
				</div>
			</div>
                        
            <div class="form-group  col-md-6">
				<label for="cel" class="control-label col-md-6">Telefono movil:</label>
				<div class="col-md-10">
					<input type="texto" class="form-control" id="cel" placeholder="celular">
				</div>
			</div>
            
                <div class="form-group  col-md-6">
				<label for="comentario" class="control-label col-md-6">Comentario:</label>
				<div class="col-md-10">
					<textarea class="form-control" id="mensaje" placeholder="Escribe tu comentario"></textarea>
				</div>
			</div>
            
            	<div class="form-group  col-md-6">
				<label for="ejecutivo" class="control-label col-md-6">Atendio:</label>
				<div class="col-md-10">
					<input type="texto" class="form-control" id="id_ejecutivo" placeholder="" disabled>
				</div>
			</div>
            
		<div class="form-group  col-md-6">
			<label for="option" class="control-label col-md-6">Oficina:</label>
				<div class="col-md-10">
					<select class="form-control" name="" id="option">
						<option value="">Tacuba</option>
						<option value="">Rio San Joaquin</option>
						<option value="">Pensilvania</option>
						<option value="">Cuernavaca</option>
						<option value="">Toluca</option>
					</select>
				</div>
		</div>
        
         <div class="form-group  col-md-6">
				<label for="fecha" class="control-label col-md-6">Fecha:</label>
				<div class="col-md-10">
				<input type="texto" class="form-control" id="fecha" placeholder="fecha">
			</div>
		</div>
        
         <div class="form-group  col-md-6">
			<label for="recepcion" class="control-label col-md-6">Capturo:</label>
			<div class="col-md-10">
				<input type="texto" class="form-control" id="recepcion" placeholder="" disabled>
			</div>
		</div>
	
            
            
			<div class="form-group">
				<div class="col-md-1 col-md-offset-5">
				<button class="btn btn-primary">Enviar</button>
			</div>
		</div>
		<div class="checkbox">
		</div>
	</form>
</div>




		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>


<?php
include'1footer.php';
?>
