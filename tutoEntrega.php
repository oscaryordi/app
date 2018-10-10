<?php
include ("1header.php");
if($_SESSION["movimientos"] > 0){ // privilegio ver video
?>

<div class="container">
	<h3>COMO REGISTRAR UNA ENTRADA A PATIO</h3>
	<?php
		echo "<iframe src='https://sistema.jetvan.com.mx/exp/tutoriales/procesoEntregaRecepcionUnidades.pdf' height='800' width='900'></iframe>";
		//echo "<iframe src='../exp/tutoriales/procesoSiniestros.pdf' height='800' width='900'></iframe>";
	?>
</div>

<?php
} // privilegio ver video
include ("1footer.php"); ?>