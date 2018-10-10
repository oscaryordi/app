<?php #############################################
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Flotilla.xls");
session_start();
include("seguridad.php");
include("caducidad.php");
echo "<meta charset='utf-8'>";
include_once("base.inc.php");
include_once("funcion.php");

$id_contrato = mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
contratoxid($id_contrato);
clientexid($id_cliente);

// CANDADO PRIVILEGIO 
// INICIO privilegio ejecutivo
$id_contrato = mysqli_real_escape_string($dbd2, $_GET['id_contrato']);
$id_usuario = $_SESSION['id_usuario'];

$sql_asignado 	= "	SELECT * FROM asignaEjecutivo 
					WHERE 	id_contrato = '$id_contrato' 
					AND 	id_usuario 	= '$id_usuario' 
					AND fecha_final IS NULL limit 1 ";
$sql_asignado_R 	= mysqli_query($dbd2, $sql_asignado);
$cuentaCorrespondio = mysqli_num_rows($sql_asignado_R);
echo $cuentaCorrespondio;
$autorizado = 0;
if($cuentaCorrespondio == 1){$autorizado = 1;}
// TERMINA privilegio ejecutivo


if($_SESSION["clientes"] > 0 || $autorizado == 1){ 



$sql_flotilla = 'SELECT au.id_unidad id_unidad, 
		au.id_asignacion id_asignacion, 
		u.id, u.Economico Economico, u.marca Marca, 
		u.Serie Serie, u.Vehiculo Vehiculo, u.Modelo Modelo, 
		u.Color Color, u.Motor Motor, u.Cilindros Cilindros, 
		u.Transmision Transmision   '

        . ' FROM asignaUactual au '
        . ' JOIN '
        . ' ubicacion u '
        . ' ON '
        . ' au.id_unidad = u.id '
        . " WHERE  id_contrato = '$id_contrato' "
        . ' ORDER BY '
        . ' u.id '
        . ' DESC ' ;
//        . " LIMIT $pagina_1, $rxpag" ; 
$res_flotilla 	= mysqli_query($dbd2, $sql_flotilla);
$totalFlotilla 	= mysqli_affected_rows($dbd2);

echo "RFC  ::: $rfc, $razonSocial<br>";
echo "ALAN ::: $id_alan<br>";
echo "NUMERO ::: $numero<br>";
echo "FECHA: ".date('Y-m-d');
echo "<p>Resumen de flotilla, $totalFlotilla Unidades Encontradas </p>";
echo "<table>";
echo "<tr>
		<th>idasg</th>
		<th>ID en BD</th>
		<th>ECONOMICO</th>
		<th>MARCA</th>
		<th>SERIE</th>
		<th>VEHICULO</th>
		<th>MODELO</th>
		<th>COLOR</th>
		<th>MOTOR</th>
		<th>CILINDROS</th>
		<th>TRANSMISION</th>
		<th>PLACAS</th>
		<th>FECHA ASG</th>
		<th>PARTIDA</th>
		<th>AREA</th>
	</tr>";

while($row = mysqli_fetch_assoc($res_flotilla)){
	$id_asignacion = $row['id_asignacion'];
	$id 		= $row['id_unidad'];
	$id_unidad 	= $row['id_unidad']; // PARA QUE FUNCIONE LA QUERY DEL HISTORICO
	$economico 	= $row['Economico'];
	$marca 		= $row['Marca'];
	$serie 		= $row['Serie'];
	$vehiculo 	= $row['Vehiculo'];
	$modelo 	= $row['Modelo'];
	$color 		= $row['Color'];
	$Motor 		= $row['Motor'];
	$Cilindros 	= $row['Cilindros'];
	$Transmision = $row['Transmision'];
	$TransTxt = '';
	if($Transmision==1){$TransTxt = 'AUTOMATICA';}
	if($Transmision==2){$TransTxt = 'ESTANDAR';}
	echo "<tr>";
	echo "<td>{$id_asignacion}</td>";
	echo "<td>{$id}</td>";
	echo "<td>{$economico}</td>";
	echo "<td>{$marca}</td>";
	echo "<td>{$serie}</td>";
	echo "<td>{$vehiculo}</td>";
	echo "<td>{$modelo}</td>";
	echo "<td>{$color}</td>";
	echo "<td>{$Motor}</td>";
	echo "<td>{$Cilindros}</td>";
	echo "<td>{$TransTxt}</td>";
	placaxid($id_unidad);
	echo "<td>{$Placas}</td>";

	// SUPERVISOR LOGISTICA
	if($_SESSION["superLog"] > 0){
		// FECHA ASIGNACION
		$sql_FA = "	SELECT fecha_inicio 
					FROM asignaUnidad 
					WHERE id_asignacion = $id_asignacion 
					LIMIT 1";
		$FA_R 		= mysqli_query($dbd2, $sql_FA);
		$arrayFA_R 	= mysqli_fetch_array($FA_R);
		$fechaAsignacion = $arrayFA_R['fecha_inicio'];
		// FECHA ASIGNACION
		echo "<td>{$fechaAsignacion}</td>";
	}
	// SUPERVISOR LOGISTICA


    $fechaEj = date('Y-m-d');
	// MOSTRAR AREA Y PARTIDA
	if($_SESSION["verPartidas"] > 0 OR $_SESSION["verAAdvas"] > 0)
	{
		$fechaResumen = $fechaEj;
		unidadAsignacionHR($id_unidad, $fechaResumen);

		if($id_partida > 0  ) // PARTIDA
		{
			if($_SESSION["verPartidas"] > 0 )
			{
				descId_partida($id_partida);
				echo "<td>$ptdDesc ::: $id_cliente</td>";
			}

		}
		else
		{
			echo "<td>-</td>";
		}


		if($id_subDiv2 > 0  ) // AREA ADMINISTRATIVA
		{
			if($_SESSION["verAAdvas"] > 0)
			{
				descId_subDiv2($id_subDiv2);
				echo "<td>$subDiv2Desc ::: $id_cliente</td>";
			}
		}		
	}
	// MOSTRAR AREA Y PARTIDA
	echo "</tr>";
}
echo "</table>";
echo "<p>&copy Jet Van Car Rental, S.A. de C.V. - ".date('Y')."</p>";
}
?>