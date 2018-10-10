<?php
include 	'1header.php';
include 	("nav_mtto.php");

$rfc 		= '';
$id_prov 	= '';

if(@$_POST['rfc'] != '' )
{
	$rfc = limpiarVariableRFC(mysqli_real_escape_string($dbd2, $_POST['rfc'] ));
	provXrfc($rfc);
}
elseif(@$_POST['id_prov'] != '' )
{
	$id_prov = $_POST['id_prov'];
}
elseif($_GET['id_prov'] != '' )
{
	$id_prov = mysqli_real_escape_string($dbd2, $_GET['id_prov'] );
}
	if($id_prov != null)
	{
			
		echo	'<h3>RESULTADO DE LA CONSULTA</h3>';
		echo	"<h4>$rfc</h4>";
		echo 	"<h2> idBD $id_prov</h2><br />";

		echo "Valor buscado: <font size=3em><b>$rfc</b></font><br/>";

		// BOTON REGRESAR AL RESUMEN // DEL PROVEEDOR
		if($_SESSION["mttoSolAut"] > 0)
		{  
				echo "
					<a href='
					mttoSolResSupProv.php?id_prov=".$id_prov."' style='text-decoration:none;'>
					<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='Ir a RESUMEN DE MTTO DEL PROVEEDOR'>
					</a>
					 ";
		}	
		 // BOTON REGRESAR AL RESUMEN // DEL PROVEEDOR

			include ("provconsultado.php");
			include ("provbancario.php");
			include ("provcontacto.php");
			include ("provsucursal.php");
			include ("provdoctos.php");

			// VER EJEMPLO DE FACTURA
			if($_SESSION["proveedores"] > 0){  
				echo "<div><fieldset><legend>EJEMPLO FACTURA</legend>
					<a href='
					provUltimaFactura.php?id_prov=".$id_prov."' style='text-decoration:none;' target='blank'  type='button'  >
					Ver Ejemplo de Factura
					</a>
					</fieldset>
					</div>
					 ";
			 }	
			 // VER EJEMPLO DE FACTURA	

			mysqli_close($dbd2);
	}
	else
	{ echo "<br><h3>Proveedor no está registrado</h3><br>";}

include ("1footer.php");
?>