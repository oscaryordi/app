<!-- ########### BITACORA MANTENIMIENTO BASADA EN ID_UNIDAD ########## -->
<?php
if($_SESSION["mttos"] > 0){  // puede ver mantenimientos??? 

echo "<fieldset>";
echo "<p>";
	// BOTON DESCARGA
	echo " <p>
		<a href='mttoSolResUnidad_GET.php?id_unidad=$id_unidad' 
		title='DESCARGAR RESUMEN MTTO UNIDAD'>
		<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN MTTO UNIDAD'>
		DESCARGAR RESUMEN DE MTTO DE LA UNIDAD </a>
		</p>";
	// BOTON DESCARGA

	// SOLICITAR MANTENIMIENTO
	if($_SESSION["mttoSol"] > 1 && isset($id_contrato)){  
		echo "<a href='mttoSol.php?id_unidad=".@$id_unidad."&id_contrato=".$id_contratoM."&id_cliente=
			".$id_clienteM."' >
			<button type='button' title='mantenimiento'>Solicitar Mantenimiento</button></a>\n";
	} // SOLICITAR MANTENIMIENTO

	if(!isset($paginaRM)){$paginaRM = 1;}

	if($_SESSION["mttoSol"] > 1){ 
	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <a href='mttoSolRes.php?pagina=$paginaRM' style='text-decoration:none;'><INPUT  TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de Mantenimiento'></a>
         ";
 	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    }    


	if($_SESSION["mttoSolAut"] > 0){ 
	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <a href='mttoSolResAutSR.php?pagina=$paginaRM' style='text-decoration:none;'><INPUT  TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen de AUTORIZACION'></a>
         ";
 	// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    }    


	if($_SESSION["mttos"] > 2){  // REGISTRAR MANTENIMIENTO JET VAN TACUBA
		echo "<a href='u8mttotacuba.php?id_unidad=".$id_unidad."' >
			<button type='button' title='mttoTacuba'>Mtto Jet Van Tacuba</button></a>\n";
	} // REGISTRAR MANTENIMIENTO JET VAN TACUBA



	  // RECUPERAR INFORMACION DE MANTENIMIENTO
	if($_SESSION["mttoSol"] > 1 && isset($id_contrato) && $_SESSION['externo'] == 0 ){  
		echo "<a href='mttoSolRecup.php?id_unidad=".@$id_unidad."&id_contrato=".$id_contratoM."&id_cliente=
			".$id_clienteM."' >
			<button type='button' title='mantenimiento'>Recuperar Información</button></a>\n";
	} // RECUPERAR INFORMACION DE MANTENIMIENTO




echo "</p>";

include("mttoSolResUnidad.php");


// INICIA mantenimientos INVENT y EXCEL de cada ejecutivo viejo...
$sql3 = "SELECT 
		id FH, 
		`fecha` 	as `FECHA`, 
		`importe` 	as `IMPORTE`, 
		`proveedor` as `PROVEEDOR`, 		
		`concepto` 	as `CONCEPTO`, 
		`km` 		as `KM`, 
		`cliente` 	as `CLIENTE`
		FROM `bitacora` 
		WHERE `id_unidad` = $id_unidad  
		ORDER BY fecha DESC 
		LIMIT 0, 30 ";

$res3 		= mysqli_query($dbd2, $sql3);
@$campos3 	= mysqli_num_fields($res3);
@$filas3 	= mysqli_num_rows($res3);

if($filas3 > 0){

echo "<legend>Bitacora de Mantenimiento</legend>"; // Empezar tabla
echo "<table class='ResTabla'>\n"; // Empezar tabla
echo "<caption><a>Cantidad de mantenimientos encontrados: <b>$filas3</b>   ";
echo "</a></caption>\n";

echo "<tr>"; // Crear fila
    echo "<th>FH</th>";
    echo "<th>FECHA</th>";
    echo "<th>IMPORTE</th>";
    echo "<th>PROVEEDOR</th>";
    echo "<th>CONCEPTO</th>";
    echo "<th>KM</th>";
    echo "<th>CLIENTE</th>";
echo "</tr>\n"; // Cerrar fila

while (@$row = mysqli_fetch_assoc($res3)) 
{
    echo "<tr>"; // Crear fila
    foreach ($row as $key => $value) 
    {
        echo "<td>$value&nbsp;</td>";
    } 
    echo "</tr>\n"; // Cerrar fila
} 

echo "</table>\n"; // Cerrar tabla
}
// TERMINA mantenimientos INVENT y EXCEL de cada ejecutivo viejo...

include("u8mttotacubares.php");

echo "</fieldset>";
} // CIERRE PRIVILEGIOS puede ver mantenimientos ?>
<!-- ########### BITACORA MANTENIMIENTO BASADA EN ID_UNIDAD ########## -->