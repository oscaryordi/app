<?php 
include("1header.php");
//ECHO $_GET['id_mttoSol'];

if( isset($_GET['id_mttoSol']) && isset($_GET['msg']) ){
$id_mttoSolR 	= $_GET['id_mttoSol'];
$msg 			= $_GET['msg'];
	echo "<p>SOLICITUD CON FOLIO: $id_mttoSolR, ENVIADA A CORRECCION</p>";
}


if($_SESSION["mttoSolPag"] > 0)//INICIO PRIVILEGIO VISTA TESORERIA
{ 
	include ("nav_pagos.php");

// FORMULARIO BUSQUEDA SOLICITUD
?>
<div style="padding:5px;">
	<p> BUSCAR SOLICITUD
	<form action='' method='post'>
		<input type='text' name='id_mttoSol' placeholder='Indique Folio de Solicitud' title='Indique Folio de Solicitud' >
		<input type='submit' name='buscar' value='Buscar'  >
	</form>
	</p>
</div>
<?php
if(isset($_POST['id_mttoSol']) &&  $_POST['id_mttoSol'] != '' )
	{
		$id_mttoSol = mysqli_real_escape_string($dbd2, $_POST['id_mttoSol']);
		echo $id_mttoSol;

		$pagina = '';
		$sql_mttoSol = '';

		$sql_mttoSol = 	' SELECT * '
			        . ' FROM mttoSol '
			        . "  WHERE id_mttoSol = '$id_mttoSol' AND autorizadoS = 1  " ;

		include('pagosResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
		if(mysqli_affected_rows($dbd2)==0)
		{
			echo '<br /><br /> ESA SOLICITUD AUN NO TIENE VISTO BUENO FAVORABLE &#9785; ';
		}

		if(mysqli_affected_rows($dbd2)==1){
			if($pagadoInfo==0)
			{
			echo "<br /> $pagadoInfo";
			?>
			<button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-success ">SOLICITAR CORRECCION</button>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Indicar Motivo</h4>
						</div>
						<div class="modal-body">
							<form method="post" action="pagosCorregir.php">
								<div class="form-group">
									<label>Indicar Motivo</label>
									<input type="text" required 	name="obs" class="form-control">
									<input type="hidden" required 	name="id_mttoSol" value="<?php echo $id_mttoSol; ?>" class="form-control">
								</div>
								<input type="submit" name="send" value="SOLICITAR CORRECCION" class="btn btn-success">
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
						</div>
					</div>
				</div>
			</div>
			<?php
			}
		}
	}
// FORMULARIO BUSQUEDA SOLICITUD
} // FIN PRIVILEGIO VISTA TESORERIA
include("1footer.php");?>