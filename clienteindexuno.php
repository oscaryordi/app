<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 0)
{ // APERTURA PRIVILEGIOS
	include ("nav_cliente.php");

	@$rfc = limpiarVariableRFC(mysqli_real_escape_string($dbd2, $_POST['rfc']));

	if(@!$_POST['id_cliente'] == '' ){
		@$id_cliente = $_POST['id_cliente'];
	}
	elseif(@!$_GET['id_cliente'] == '' ){
		@$id_cliente = $_GET['id_cliente'];
	}
	elseif(!$rfc==''){
		$sql_pid = 	 ' SELECT id_cliente '
					. ' FROM '
					. ' claCliente '
					. " WHERE rfc = '$rfc' LIMIT 1";
		$resultado_pid 	= mysqli_query($dbd2, $sql_pid);
		$matriz_pid 	= mysqli_fetch_array($resultado_pid);
		$id_cliente 	= @$matriz_pid['id_cliente'];
	}

	if($id_cliente != null && $id_cliente != '' &&  $id_cliente != '--')
	// NO NULO, NO VACIO, NO DEFAULT PERSIANA
	{
			echo	'<h3>RESULTADO DE LA CONSULTA</h3>';
			echo	"<h4 id='IA$rfc'   >$rfc</h4>";

			echo "Valor buscado: <font size=3em><b>$rfc</b></font>";

			include ("clientegral.php");
			include ("clientedocto.php");

			include ("clientecto.php");
			
			mysqli_close($dbd2);
	}
	else
	{ echo "<br><h3>Cliente no está registrado</h3><br>";}

} // CIERRE PRIVILEGIOS

include ("1footer.php");
?>