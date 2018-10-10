<?php
$sql_MO = "SELECT * FROM mttoSolObs WHERE id_mttoSol = '$id_mttoSol' ORDER BY id_mttoSolOb DESC";

$sql_MOR = mysqli_query($dbd2, $sql_MO);

if(mysqli_num_rows($sql_MOR) > 0 )
{ // INICIA SI HAY RESULTADOS
	echo "<div style='padding:5px;'><table id='ResTabla' >";
	echo "<tr>
			<th>FECHA</th>
			<th>STATUS AUTORIZACIÓN</th>
			<th>OBSERVACIONES</th>
		  </tr>";
	while($row = mysqli_fetch_assoc($sql_MOR))
	{ // INICIA PINTAR RESULTADOS
		
		$fechareg 	= $row['fechareg'];
		$statusAu 	= $row['statusAu'];
		$obsA 		= $row['obsA']; // 

		switch($statusAu)
		{
		    case "0": // PENDIENTE
        		$statusAuTXT = "PENDIENTE DE REVISAR";
        		break;
    		case "1": // AUTORIZADO
        		$statusAuTXT = "AUTORIZADO";
        		break;
    		case "2": // INCOMPLETO
        		$statusAuTXT = "INCOMPLETO";
        		break;
		    case "3": // CORREGIR
        		$statusAuTXT = "CORREGIR";
        		break;
        	case "4": // RECHAZADO
        		$statusAuTXT = "RECHAZADO";
        		break;	
    		default:
        		break;
		}

		echo "<tr >";
		echo "<td>{$fechareg}</td>";
		echo "<td style='color:blue;font-size:1.2em;' >{$statusAuTXT}</td>";
		echo "<td style='color:blue;font-size:1.2em;' >{$obsA}</td>";
		echo "</tr>";
	} // TERMINA PINTAR RESULTADOS
	echo "</table></div>";
}// TERMINA SI HAY RESULTADOS
?>