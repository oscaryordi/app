<?php
include("1header.php");

if($_SESSION["documentos"] > 2){ // VISTA A C4 
include ("nav_doc.php");

// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 25; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = "";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta_docE;
$cuenta_docE 		= " SELECT COUNT(id_errorexp) as cantidad FROM expError  ";
$sacar_cuenta_docE 	= mysqli_query($dbd2, $cuenta_docE);
$sacar_cuenta_docE_Matriz	= mysqli_fetch_array($sacar_cuenta_docE);
$cuenta 			= $sacar_cuenta_docE_Matriz['cantidad'];

$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta ERRORES REPORTADOS</h3><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION



// SI CONSULTA GERENTE
	$sql_expE = 'SELECT * '
		. ' FROM expError '
		. ' ORDER BY '
		. ' id_errorexp '
		. ' DESC '
		. " LIMIT $pagina_1, $rxpag " ;

?>
<section><fieldset><legend>RESUMEN DE ERRORES REPORTADOS</legend>
<?php
echo "<table class='table  table-bordered table-hover table-condensed'>\n";
echo "<tr>

<th>E.FECHA REPORTE</th>
<th>E.CONSECUTIVO</th>
<th>E.TIPO</th>
<th>E.OBSERVACIONES</th>
<th>E.REPORTO</th>
<th>UNIDAD</th>
<th>D.ARCHIVO</th>
<th>D.DESCRIPCION</th>
<th>D.DETALLE</th>
</tr>";

$R_sql_expE = mysqli_query($dbd2, $sql_expE);

while($row = mysqli_fetch_assoc($R_sql_expE)){

	$fecharep 		= $row['fecharep'];
	$id_errorexp 	= $row['id_errorexp'];
	$id_docto 		= $row['id_docto'];
	$tipoerror 		= $row['tipoerror'];
	$obs 	 		= $row['obs'];
	$fechaatnd 		= $row['fechaatnd'];
	$accion 		= $row['accion'];
	$chismoso 		= $row['capturo'];


// INICIO sacar id_unidad a que corresponde
$sql_docto 		= "SELECT * FROM expedientes WHERE id = '$id_docto' LIMIT 1 ";
$R_sql_docto 	= mysqli_query($dbd2, $sql_docto);
while($rowdocto = mysqli_fetch_assoc($R_sql_docto))
	{ 
		$id_unidad 	= $rowdocto['id_unidad'];
		$Aarchivo 	= $rowdocto['archivo'];
		$Atipo 		= $rowdocto['tipo'];
		$Aobs 		= $rowdocto['obs'];
		$Aruta 		= $rowdocto['ruta'];
	}
// FIN sacar id_unidad a que corresponde


// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$fecharep}</td>";

	$color = '#ffcc99'; // SALMON (TONO AL ROJO)
	if($accion>0){$color = '#ccffcc';} // VERDE (TONO AL VERDE)
	
	echo "<td style='background:$color;'>{$id_errorexp}, ATENDIDO:{$accion}</td>";
	doctipoerror($tipoerror);
	echo "<td>{$tipoerrorDescripcion}</td>";
	echo "<td>{$obs}</td>";

	$id_usuarioC = $chismoso;
	usuarioxidC($id_usuarioC);
	echo "<td>{$nombreC} ::: {$usuarioC}</td>";
	$nombreC = '';
	$usuario = '';

	datosxid($id_unidad);
	echo "<td>{$Economico} ::: {$Serie} ::: {$Vehiculo} ::: {$Placas}</td>";

	if($accion==0){
	
	echo 	"<td>
				<a href='http://sistema.jetvan.com.mx/exp/$Aruta/$Aarchivo' target='_blank'>{$Aarchivo}</a>
			</td>";	
	}else{
	echo 	"<td>
				{$Aarchivo}
			</td>";	
	}

	$d_tipoclave = $Atipo; 
	dictipoxclave($d_tipoclave);
	echo "<td>{$d_tipo}</td>";
	echo "<td>{$Aobs }</td>";



if($accion==0){ // INICIO MOSTRAR OPCIONES DE CORRECCION 
//INICIO  OPCIONES DE -- EDICION -- BORRAR -- CAMBIO DE ASIGNACION
// EDITAR
   if($_SESSION["documentos"] > 2)
		{ // INICIO privilegio editar
			echo "<td><a href='u9doctoeditar.php?id_docto=$id_docto&id_unidad=$id_unidad&id_errorexp=$id_errorexp' >
			<button type='button' title='Editar'>Ed</button></a></td>";
		} // TERMINA privilegio editar

		// BORRAR permisos documentos 3 o 4
	$id_usuario = $_SESSION["id_usuario"];

// BORRAR
	if($_SESSION["documentos"] > 2) // INICIO privilegio borrar
		{
		echo "<td>
				<form action='u9doctoborrar.php' method='post'>
				<input type='hidden' value='$id_docto' name='id_docto'>
				<input type='hidden' value='$id_unidad' name='id_unidad'>
				<input type='hidden' value='$id_usuario' name='id_usuario'>
				<input type='hidden' value='$id_errorexp' name='id_errorexp'>
			  ";
		?>
				<a onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO'); " >
		<?php
		echo "		
				<input type='submit' value='B' name='borrar' title='Borrar' >
				</a>
				</form>
			</td>";
		}	   // TERMINA privilegio borrar

// CAMBIAR ASIGNACION
   if($_SESSION["documentos"] > 2)
		{ // INICIO privilegio CAMBIAR ASIGNACION
			echo "<td><a href='u9doctocambiaasignacion.php?id_docto=$id_docto&id_unidad=$id_unidad&id_errorexp=$id_errorexp' >
			<button type='button' title='Cambiar Asignación del Documento'>Ca</button></a></td>";
		} // TERMINA privilegio CAMBIAR ASIGNACION
 
//TERMINA  OPCIONES DE -- EDICION -- BORRAR -- CAMBIO DE ASIGNACION
} // TERMINA MOSTRAR OPCIONES DE CORRECCION

	echo "</tr>";
// FIN poner renglon resultados

}
echo "</table>";


#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo = 5;
$pagina_vista_inicio = $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar = $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar = $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
	$max_mostrar = $pagina_vista_inicio + $paginas_intervalo;
}

$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";

} // FIN PRIVILEGIO VISTA C4
include("1footer.php");?>