<?php
$TipoBusqueda = "Histórico Traslados";
include '1header.php';

$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");

		$sql_movFor = 	  ' SELECT * '
			        	. ' FROM mov_traslados '
			        	. " WHERE id_unidad = '$id_unidad' ORDER BY CONCAT( fechaD, ' ', `horaD` ) DESC ";

		$id_usuario = $_SESSION["id_usuario"];
		$pagina		= 0;



include('movResultSet.php');

// BOTON PARA VOLVER A LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td>";
//<!--KILOMETRAJE HISTORICO-->
include '1footer.php'; ?>