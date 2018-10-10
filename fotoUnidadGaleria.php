<?php
include '1header.php';

$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd	: ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";
echo "SUBIR FOTOS";

include ("u4datos.php");
include ("u5placas.php");

//include ("fotoUnidadCD.php"); // CREAR DIRECTORIO PARA CARGA DE FOTO

if($_SESSION["fotoUnidad"] > 0){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO 
?>
		<!--<script src="js/jquery-1.11.2.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
	<style>
	.galeriaMosaico {height: 350px; width:auto; }
	</style>
<?php


//CONSULTA ARCHIVOS
$sqlFOTO = 'SELECT id_foto, archivo, ruta, tipo ' 
		. ' FROM '
		. ' fotoUnidad '
		. " WHERE id_unidad = '$id_unidad' 
		 AND borrar = 0 ORDER BY tipo ASC LIMIT 10 ";
//FIN CONSULTA
$resFOTO	= mysqli_query($dbd2, $sqlFOTO);

echo "<div id='container'>";
	if($resFOTO)
	{ // INICIA hubo resultados
		while($row = mysqli_fetch_assoc($resFOTO))
		{ // INICIA PONER RESULTADOS
			$id_foto 		= $row['id_foto'];
			$archivoFoto 	= $row['archivo'];
			$rutaFoto 		= $row['ruta'];
			$tipo 			= $row['tipo'];

			if($tipo != 7 )
			{
				echo "<img src='../exp/fotos/$rutaFoto/$archivoFoto' 
					 alt='IMAGEN' class='galeriaMosaico' >";
				if($_SESSION["fotoUnidad"] > 1 ) // BORRAR
				{
					echo " 	<form action='fotoUnidadBorrar.php' method='post' style='display: inline;'>
							<input type='hidden' value='$id_foto' 	name='id_foto'>
							<input type='hidden' value='$id_unidad' name='id_unidad'>";
					?>
							<a onClick="javascript: return confirm('Confirma proceder a BORRAR FOTO'); " >
					<?php
					echo "
							<input type='submit' value='Borrar' name='Borrar' title='BORRAR' >
							</a>
							</form>";
				}
			}

			if($tipo == 7 AND ($_SESSION["gps"] > 0 OR $_SESSION["documentos"] > 1))
			{
				echo "<img src='../exp/fotos/$rutaFoto/$archivoFoto' 
					 alt='IMAGEN' class='galeriaMosaico' >";
				if($_SESSION["fotoUnidad"] > 1  OR $_SESSION["gps"] > 0) // BORRAR
				{
					echo " 	<form action='fotoUnidadBorrar.php' method='post' style='display: inline;'>
							<input type='hidden' value='$id_foto' 	name='id_foto'>
							<input type='hidden' value='$id_unidad' name='id_unidad'>";
					?>
							<a onClick="javascript: return confirm('Confirma proceder a BORRAR FOTO'); " >
					<?php
					echo "		
							<input type='submit' value='Borrar' name='Borrar' title='BORRAR' >
							</a>
							</form>";
				}
			}

			echo "<br>";
		} // TERMINA PONER RESULTADOS
	} // TERMINA hubo resultados
echo "</div>";
} // CIERRE PRIVILEGIOS 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
		</FORM>
		</p>";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

include ("1footer.php"); ?>
<!--
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />
-->