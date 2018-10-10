<?php

$personalR = mysqli_query($dbd2, $sql_personal);

echo "<section><fieldset><legend>RESUMEN DE PERSONAL INTERNO</legend>";		
echo "<table class='ResTabla'>\n";
echo "	<tr>
		<th>id_usuario</th>
		<th>A.Paterno</th>
		<th>A.Materno</th>
		<th>Nombres</th>
		<th>Email</th>
		<th>Puesto</th>
		<th>STATUS ACTUAL</th>
		</tr>";

while($row = mysqli_fetch_assoc($personalR))
{

	$id_usuario 	= $row['id_usuario']; // asignacion corresponde al equipo configurado
	$nombre 		= $row['nombre'];
	$nombres 		= $row['nombres'];
	$paterno 		= $row['paterno'];
	$materno 		= $row['materno'];

	$usuario 		= $row['usuario'];
	$puesto 		= $row['puesto'];
	$suspendido 	= $row['suspendido'];
	$externo 		= $row['externo'];


	// INICIO poner renglon resultados
	echo "<tr>";

	echo "<td>{$id_usuario}</td>";

	echo "<td>{$paterno}</td>";
	echo "<td>{$materno}</td>";
	echo "<td>{$nombres}</td>";

	echo "<td>{$usuario}</td>";
	echo "<td>{$puesto}</td>";
	$suspendidoTXT = ($suspendido==0)?'ACTIVO':'SUSPENDIDO';
	echo "<td>{$suspendidoTXT}</td>";


	if($suspendido==0) // SUSPENDER
	{
		echo "<td style='text-align:center;'>";
		echo "<a 	href='RHsuspender.php?
					id_usuario=$id_usuario
					&suspendido=$suspendido
					&pagina=$pagina
					&externo=$externo' 
					style='text-decoration:none;color:red;font-size:.8em;'  title='SUSPENDER' ";
		echo "		>
					SUSPENDER
				</a>
			</td>";
	}
	else // REACTIVAR
	{	echo "<td style='text-align:center;'>";
		echo "<a 	href='RHreactivar.php?
					id_usuario=$id_usuario
					&suspendido=$suspendido
					&pagina=$pagina
					&externo=$externo' 
					style='text-decoration:none;color:green;'  title='REACTIVAR' ";
		echo "		>
					REACTIVAR
				</a>
			</td>";
	}

	echo "</tr>";
	// FIN poner renglon resultados
}
echo "</table>";
echo "</fieldset></section>";