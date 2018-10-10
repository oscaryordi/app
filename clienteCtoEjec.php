<!--EJECUTIVO ASIGNADO-->
<?php
contratoEjecutivos($id_contrato);

$sql_cto_ejecs_R; // viene de la funcion ejecutada

if(mysqli_num_rows($sql_cto_ejecs_R)==0)
{
	echo "NO HAY EJECUTIVOS ASIGNADOS, ";
	echo "<a href='clienteCtoEjecH.php?id_contrato=$id_contrato' >
			<button type='button' title='VER HISTORICO DE EJECUTIVOS'>
			Histórico de Ejecutivos</button></a>";
}
@$filas_ctoEjecs 	= mysqli_num_rows($sql_cto_ejecs_R);

echo "<br>";
echo "<a href='clienteCtoContacto.php?id_contrato=$id_contrato' >
		<button type='button' title='VER CONTACTOS CLIENTE'>
		CONTACTOS CLIENTE</button></a>";

if($filas_ctoEjecs > 0)
{
	echo "<br>";
	echo "<section>USUARIOS EXTERNOS: <b>$filas_ctoEjecs</b>, ";

	if($_SESSION["clientes"] > 0){
	echo "<a href='clienteCtoEjecH.php?id_contrato=$id_contrato' >
			<button type='button' title='VER HISTORICO DE EJECUTIVOS'>Histórico de Ejecutivos</button></a>";

	echo "<a href='clienteCtoEjecE_H.php?id_contrato=$id_contrato' >
			<button type='button' title='VER USUARIOS EXTERNOS'>USUARIOS EXTERNOS</button></a>";
	}

	echo "<table class='ResTabla'>
			<tr>
				<th>idAsgn</th>
				<th>NOMBRE</th>
				<th>PUESTO</th>
				<th>DESDE</th>
				<th>HASTA</th>
			</tr>";

	while($row = mysqli_fetch_assoc($sql_cto_ejecs_R))
		{
			$id_a_contrato 	= 	$row['id_a_contrato'];
			$id_usuario 	= 	$row['id_usuario']; // ID de ejecutivo asignado

			$fecha_inicioEA	= 	$row['fecha_inicio'];
			$fecha_finalEA 	= 	$row['fecha_final'];
			$fecha_finalEA 	= 	$row['fecha_final'];


			echo "<tr>";
			echo "<td>{$id_a_contrato}</td>";
			usuarioxid($id_usuario);
			echo "<td>{$nombre}</td>";
			echo "<td>{$puestoUSR}</td>";
			echo "<td>{$fecha_inicioEA}</td>";

			$pagina = 0;
		// BORRAR
		if($_SESSION["asigcto"] > 1) // INICIO privilegio borrar CONTRATO
			{
			echo "<td>
					<form action='asignaCtoQuitar.php' method='post'>
					<input type='hidden' value='$id_a_contrato' name='id_a_contrato'>
					<input type='hidden' value='$id_usuario' name='ejecutivoID'>
					<input type='hidden' value='1' name='pagina'>";
			?>
					<a onClick="javascript: return confirm('Confirma proceder a QUITAR : DESASIGNAR CONTRATO'); " >
			<?php
			echo "		
					<input type='submit' value='Desasignar' name='Quitar' title='Quitar' >
					</a>
					</form>
				</td>";
			}	   // TERMINA privilegio borrar CONTRATO

			//resetear variables
			$id_usuario 	= '';
			$nombre 		= '';
			$fecha_inicio 	= '';
			$fecha_final 	= '';
			//resetear variables
			echo "</tr>";
		}
	echo "</table></section>"; // Cerrar tabla
}
?>
<!--EJECUTIVO ASIGNADO-->