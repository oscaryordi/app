<?php
$sin_R = mysqli_query($dbd2, $sql_sin);

?>
<style>
.fa-upload{color:gray;}
.fa-upload:hover{ color:green;}
</style>
<?php 



if(mysqli_affected_rows($dbd2)>0)
{



echo "<section><fieldset><legend>RESUMEN DE SINIESTROS, CORRALONES E INCIDENCIAS</legend>";	
echo "<table class='ResTabla' >";
echo "<tr>
		<th>IDBD SINIESTRO</th>
		<th>UNIDAD</th>
		<th>CIUDAD</th>
		<th>MOTIVO</th>
		<th>DE FECHA</th>
		<th>NUMERO S</th>
		<th>STATUS</th>
		<th>CLIENTE</th>
	  </tr>";

while($row = mysqli_fetch_assoc($sin_R)){
	$id_unidad 		= $row['id_unidad'];
	$id_siniestro 	= $row['id_siniestro']; // 
	$cdSin 			= $row['cdSin'];
	$motivo			= $row['motivo'];
	$fechaSin 		= $row['fechaSin'];
	$numSin 		= $row['numSin'];
	$status 		= $row['status'];
	$id_cliente 	= $row['id_cliente'];

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>
			<a href='sinVerId.php?id_siniestro=$id_siniestro'  
				title='Ver Detalle' >
			$id_siniestro
			</a>
		  </td>";

	datosxid($id_unidad);
	echo "<td>
	<a href='u3index.php?id_unidad=$id_unidad'>{$Economico}</a>
	 ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";
	echo "<td>{$cdSin}</td>";
	echo "<td>{$motivo}</td>";
	echo "<td>{$fechaSin}</td>";
	echo "<td>{$numSin}</td>";
	echo "<td>{$status}</td>";

	clientexid($id_cliente);
	echo "<td>$razonSocial</td>";
	$razonSocial = '';	

	echo "<td>";
	if($_SESSION["siniestro"] > 1)
	{
		echo "	<a href='sinDoctoAlta.php?id_siniestro=$id_siniestro' alt='SUBIR ARCHIVO' title='SUBIR ARCHIVO'  >
				<i class='fas fa-upload'   style='font-size:16px;'   alt='SUBIR ARCHIVO' title ='SUBIR ARCHIVO' >
				</i>
				</a>
			  ";
	}
	echo "</td>";

	echo "</tr>";
// FIN poner renglon resultados
}
echo "</table>";
echo "</fieldset></section>";
}
else
{
	echo "NO HAY RESULTADOS QUE COINCIDAN CON LA BUSQUEDA SOLICITADA.";
}