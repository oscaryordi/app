<?php
include("1header.php");

if($_SESSION["facturacionV"] > 0)
{ // PRIVILEGIO VISTA FACTURACION 
	include ("nav_fact.php"); 


	# 1 busca listado de quienes han hecho estimaciones
	$sql_USRE = "SELECT DISTINCT (e.capturo), u.nombres, u.paterno, u.materno
				FROM estimacion e
				JOIN usuarios u ON e.capturo = u.id_usuario
				ORDER BY u.paterno ASC , u.materno ASC "; // OBTENER IDS DE CREADORES
	$R_USRE  = 	mysqli_query($dbd2, $sql_USRE);

	# 2 pinta un select con nombres completos
	// PARA CUANDO YA SE CONSULTO
	if(isset($_GET['ejecutivoID']))
	{
		$ejecutivoID = $_GET['ejecutivoID'];
	}
	else{
		$ejecutivoID = '';
	}
	//echo "AQUI VA UN FORMULARIO CON SELECT";

	?>
	<p>
	<p>Consulta de ESTIMACIONES POR EJECUTIVO:</p>
	<form action='' method='GET' >
	ELIJA EJECUTIVO->
		<select name="ejecutivoID" style='font-size:.9em;'>
			<?php 
				while($row = mysqli_fetch_assoc($R_USRE))
				{
					$id_usuarioE = 	$row['capturo'];	
					$nombres 	=	$row['nombres'];
					$paterno 	=	$row['paterno'];
					$materno 	=	$row['materno'];
					$checked = '';
					if($ejecutivoID == $id_usuarioE ){$checked = 'selected';}
					echo "<option value='$id_usuarioE' style='font-size:.9em;' $checked >";
					echo "{$paterno} {$materno} {$nombres} ";
					echo "</option>";
					$checked = '';
				}
			?>
		</select>
	<input type='submit' value='consultar'>
	</form>
	<p/>
	<?php
	# 3 Boton para consultar



	# 4 mostrar resultado
	if( isset($_GET['ejecutivoID']) &&  $_GET['ejecutivoID'] != '')
	{
		$id_usuarioR = mysqli_real_escape_string($dbd2, $_GET['ejecutivoID'] );
		echo $id_usuarioR;

		$pagina 	= '';

		$sql_estRes = "	SELECT * FROM estimacion 
					WHERE capturo = '$id_usuarioR' 
					AND borrado = 0 
					ORDER BY fechaIn DESC ";

		include('estimacionResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN
	}



} // PRIVILEGIO VISTA FACTURACION
include("1footer.php");
?>