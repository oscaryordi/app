<meta charset='utf-8'>

<form>
<h2>ALTA DE UNIDAD VEHICULAR</h2>

<table>
	<tr><th>SERIE</th>
	<td><input type='text'></td></tr>
	
	<tr><th>MARCA</th>
	<td><input type='text'></td></tr>
	
	<tr><th>SUBMARCA</th>
	<td><input type='text'></td></tr>
	
	<tr><th>VEHICULO / TIPO</th>
	<td><input type='text'></td></tr>
	
	<tr><th>AÑO DEL MODELO</th>
	<td><input type='text'></td></tr>
	
	<tr><th>COLOR</th>
	<td><input type='text'></td></tr>
	
	<tr><th>MOTOR SERIE</th>
	<td><input type='text'></td></tr>
	
	<tr><th>CLAVE VEHICULAR</th>
	<td><input type='text'></td></tr>
	
	<tr><th>PROVEEDOR</th>
	<td><input type='text'></td></tr>
	
	<tr><th>FECHA DE FACTURA</th>
	<td><input type='text'></td></tr>
	
	<tr><th>FOLIO DE FACTURA</th>
	<td><input type='text'></td></tr>
	
	<tr><th>IMPORTE IVA INCLUIDO</th>
	<td><input type='text'></td></tr>

</table>

</form>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<style>
#form2{max-width:500px; margin:1em auto;}
</style>


<form id='form2' action='' method='post'>
<label for='marca'>Marca</label><input class='form-control' type='text' id='marca' name='marca' value='$Marca'><br>
<label>Submarca</label><input  class='form-control' type='text' name='submarca' value='$Submarca'><br>
<label>Año</label><input  class='form-control' type='text' name='ano' value='$Ano'><br>
<label>NumeroSerie</label><input  class='form-control' type='text' name='numeroserie' value='$NumeroSerie'><br>
<label>Color</label><input  class='form-control' type='text' name='color' value='$Color'><br>
<label>Numeromotor</label><input  class='form-control' type='text' name='numeromotor' value='$Numeromotor'><br>
<input class='btn btn-lg btn-primary btn-block' type='submit' name='daralta' value='Dar alta' ></input>
</form>

<form id='form2' class="form-horizontal">
  <div class="form-group">
    <label for="serie" class="col-sm-4 control-label">Serie</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="serie" placeholder="serie">
    </div>
  </div>
  
  <div class="form-group">
    <label for="marca" class="col-sm-2 control-label">Marca</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="marca" placeholder="marca">
    </div>
  </div>
  
    <div class="form-group">
    <label for="submarca" class="col-sm-2 control-label">Submarca</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="submarca" placeholder="submarca">
    </div>
  </div>
  
  <div class="form-group">
    <label for="tipo" class="col-sm-2 control-label">Vehiculo / Tipo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tipo" placeholder="tipo">
    </div>
	
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Año del Modelo</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Color</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Motor Serie</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Clave Vehicular</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Proveedor</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Fecha de Factura</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Folio de Factura</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Importe IVA Incluido</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-block">Sign in</button>
    </div>
  </div>
</form>

	
<?php include ("1footer.php"); ?>