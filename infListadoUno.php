<?php
if($_SESSION["infraccionV"] > 0){  // APERTURA PRIVILEGIOS
	$sql_InfS =   ' SELECT * '
				. ' FROM infraccion '
				. " WHERE id_unidad = '$id_unidad' "
				. ' ORDER BY fechareg DESC LIMIT 20 ';
	$sql_InfS_R = mysqli_query($dbd2, $sql_InfS);
	@$camposuh  = mysqli_num_fields($sql_InfS_R);
	@$filasuh   = mysqli_num_rows($sql_InfS_R);


echo "<script defer src='https://use.fontawesome.com/releases/v5.0.9/js/all.js' integrity='sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl' crossorigin='anonymous'></script>";

$borrarTxtIcon = "<i class='fa fa-trash-o'  
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='ELIMINAR' ></i>";
$verPdf 	= "<i class='fa fa-file-pdf-o'  
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='PDF' ></i>";
$verDto 	= "<i class='fas fa-file-alt'  
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='DETALLE' ></i>";
$iconoS		= "<i class='fa fa-upload' 
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='SUBIR' ></i>";
$iconoErase	= "<i class='fa fa-times-circle' 
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='BORRAR' ></i>";
$iconEdit	= "<i class='fa fa-pencil' 
					style='font-size:16px; color:gray;font-weight: ;'   
					alt='EDITAR' ></i>";


echo "<br>";
echo "<fieldset><legend>HISTORICO DE INFRACCIONES, se muestran hasta 20 registros</legend>\n";
echo "<table class='ResTabla'>\n"; // Empezar tabla
echo "<tr><th colspan= >CANTIDAD DE REGISTROS: <b>$filasuh</b></th></tr>\n";
echo "<tr>
<th>CONTRATO</th>
<th>FECHA</th>
<th>FOLIO</th>
<th>DESCRIPCION</th>
<th>IMPORTE</th>
<th>ARCHIVO</th>
</tr>
"; // Crear fila

while($row = mysqli_fetch_assoc($sql_InfS_R))
{
	$id_inf 	= $row['id_inf'];
	$fechaInf 	= $row['fechaInf']; // asignacion corresponde al equipo configurado
	$folioInf 	= $row['folioInf'];
	$descripcion= $row['descripcion'];
	$importe 	= $row['importe'];
	$id_unidad	= $row['id_unidad'];

	$id_contrato = $row['id_contrato'];

	// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{}</td>";

	echo "<td>{$fechaInf}</td>";
	echo "<td>{$folioInf}</td>";
	echo "<td>{$descripcion}</td>";
	echo "<td>{$importe}</td>";

	infDocto($id_inf);
	echo "<td>";
	if($nohubo == 0)
	{
	 	echo "<a href='http://sistema.jetvan.com.mx/exp/inf/$ruta/$Archivo' target='_blank' title='Ver Escaneo'>$verDto</a> -- ";
	 	
	 	if($_SESSION["infraccionH"] > 1){
		echo "<a href='infDoctoBorrar.php?id_inf=$id_inf&id_docto=$id_docto&pagina=$pagina' title='Borrar Escaneo'>$iconoErase</a>";
		}

	}
	else{
		if($_SESSION["infraccionH"] > 1){
		echo "<a  href='infDoctoAlta.php?id_inf=$id_inf'   ><i class='fas fa-upload'   style='font-size:16px; color:gray;font-weight: ;'   alt='SUBIR ARCHIVO' ></i></a>";
		}
	}
	echo "</td>";

	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "</fieldset>";
echo "<br>";
} // CIERRE PRIVILEGIOS