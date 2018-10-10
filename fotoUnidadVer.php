<?php 

//INICIA  CONSULTA FOTOS
$sqlFOTO = 'SELECT id_foto, archivo, ruta, tipo ' 
		. ' FROM '
		. ' fotoUnidad '
				. " WHERE id_unidad = '$id_unidad' 
		 AND borrar = 0 ORDER BY tipo DESC LIMIT 1";
//TERMINA CONSULTA FOTOS
$resFOTO 	= mysqli_query($dbd2, $sqlFOTO);
$arrayFOTO 	= mysqli_fetch_array($resFOTO);

$tipoFoto 		= $arrayFOTO['tipo'];
$archivoFoto 	= $arrayFOTO['archivo'];
$rutaFoto 		= $arrayFOTO['ruta'];

$hayFotosU 		= mysqli_affected_rows($dbd2);

if($arrayFOTO['tipo'] == 5 ){
	echo "<img src='../exp/$rutaFoto/$archivoFoto' style='width:auto;height:105px;'  alt='FRENTE' > ";
}

if($hayFotosU > 0 ){
	echo "<a href='fotoUnidadGaleria.php?id_unidad=$id_unidad' >Ver Galeria</a>";
}

?>