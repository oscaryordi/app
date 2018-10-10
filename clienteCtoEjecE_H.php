<?php 
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 0)
{ // APERTURA PRIVILEGIOS

include ("nav_cliente.php");

$id_contrato = $_GET['id_contrato'];
contratoxid($id_contrato);
clientexid($id_cliente);

echo "<h2>HISTORICO DE EJECUTIVOS DEL CONTRATO</h2>";
echo "<h3>CLIENTE</h3>";
echo "<p>RFC  ::: $rfc, RAZON SOCIAL ::: $razonSocial, ALIAS_CTE ::: $alias</p>";
echo "<h3>CONTRATO</h3>";
echo "<p>ALAN ::: $id_alan, NUMERO ::: $numero,  ALIAS_CTO ::: $aliasCto</p> ";


########## ########## ######### ######### #########

///////////////
contratoEjecutivosE_H($id_contrato);
$sql_cto_ejecs_ReH; // viene de la funcion ejecutada
//////////////
if(mysqli_num_rows($sql_cto_ejecs_ReH)==0){echo "NO HAY EJECUTIVOS ASIGNADOS";}
//////////////
@$filas_ctoEjecs 	= mysqli_num_rows($sql_cto_ejecs_ReH);
//////////////
/**/


/*
if($_SESSION["clientes"] > 1)
	{ // APERTURA PRIVILEGIOS  // BOTON NUEVO CONVENIO
	echo " <a href='clienteconvalta.php?id_cliente=$id_cliente&id_contrato=$id_contrato'>
	<button>Nuevo Convenio Modificatorio</button></a>";
	} // CIERRE PRIVILEGIOS   // BOTON NUEVO CONVENIO
echo "</p><table class='tablasimple'>"; 
*/

echo "<a href='clienteCtoEjecH.php?id_contrato=$id_contrato' >
			<button type='button' title='VER HISTORICO DE EJECUTIVOS'>Histórico de Ejecutivos</button></a>";

if($filas_ctoEjecs > 0)
{
	echo "<section><p>EJECUTIVOS ASIGNADOS: <b>$filas_ctoEjecs</b>"; 
	echo "<table class='ResTabla'>
		<tr>
		<th>idAsgn</th>
		<th>NOMBRE</th>
		<th>PUESTO</th>
		<th>DESDE</th>
		<th>HASTA</th>
		<th>NIVEL</th>
		</tr>";

	while($row = mysqli_fetch_assoc($sql_cto_ejecs_ReH))
	/////////////
		{
			$id_a_contrato 	= 	$row['id_a_contrato'];
			$id_usuario 	= 	$row['id_usuario']; // ID de ejecutivo asignado

			$fecha_inicioEA	= 	$row['fecha_inicio'];
			$fecha_finalEA 	= 	$row['fecha_final'];
			$filtroFlotilla 	= 	$row['filtroFlotilla'];

			echo "<tr>";

			echo "<td>{$id_a_contrato}</td>";
			usuarioxid($id_usuario);
			echo "<td>{$nombre}</td>";
			echo "<td>{$puestoUSR}</td>";
			echo "<td>{$fecha_inicioEA}</td>";
			echo "<td>{$fecha_finalEA}</td>";
			echo "<td>{$filtroFlotilla}</td>";

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

########## ########## ######### ######### #########

} // CIERRE PRIVILEGIOS


// VOLVER AL CONTRATO
echo "<p>
	  <FORM action='ctoIndex.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_contrato' VALUE='$id_contrato'>
		<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIARB' VALUE='Volver al CONTRATO'>
	  </FORM>
	</p>";
// VOLVER AL CONTRATO

echo"<br>
	<p>
	  <FORM action='clienteindexuno.php' method='POST' id='entabla'>
		<INPUT TYPE='hidden' NAME='id_cliente' VALUE='$id_cliente'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver al CLIENTE'>
	</FORM>
	</p>";

include ("1footer.php");
?>