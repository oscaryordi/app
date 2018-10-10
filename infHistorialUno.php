<?php
$TipoBusqueda = "Histórico Infracciones";
include '1header.php';

$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie	 : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");
include ("infListadoUno.php");

// BOTON PARA VOLVER A LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
	echo "<p>
		<FORM action='u3index.php' method='POST' id='entabla'>
			<INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
			<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad' id='gobutton'>
		</FORM>
		</p>";

include '1footer.php';
?>