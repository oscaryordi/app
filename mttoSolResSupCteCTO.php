<?php
include("1header.php");
include ("nav_mtto.php"); 

$id_usuario = $_SESSION["id_usuario"];


if(isset($_GET['id_contrato']))
{
	$id_contrato = $_GET['id_contrato'];
}
else{
	$id_contrato = '';
}

tienecontrato($id_usuario);
if($miflotilla == 1 OR $_SESSION["mttoSolSup"] > 0 ){ // PRIVILEGIO EJECUTIVO

?>
<p>
<p>Consulta de Solicitudes por CONTRATO:</p>


<!--
<form action='' action='' method='GET' >
ELIJA EJECUTIVO->
	<select name="ejecutivoID" style='font-size:.9em;'>
		<?php 
			while($row = mysqli_fetch_assoc($sql_mttoSol_ER))
			{
				$id_usuarioE = 	$row['id_usuario'];	
				$nombreE 	=	strtoupper($row['nombre']);

				$checked = '';
				if($ejecutivoID == $id_usuarioE ){$checked = 'selected';}
				echo "<option value='$id_usuarioE' style='font-size:.9em;' $checked >";
				echo "{$nombreE}";
				echo "</option>";
				$checked = '';
			}
		?>
	</select>
<input type='submit' value='consultar'>
</form>
-->

<p/>
<?php

//$ejecutivoID 		= @$_GET['ejecutivoID'];

// FORMULARIO ELEGIR EJECUTIVO



// INICIO FASE 1 ALGORITMO DE PAGINACION

$rxpag = 50; //RESULTADOS POR PAGINA

if(isset($_GET['pagina'])){
		$pagina = $_GET['pagina'];
	}
else{
		$pagina = "1";
	}

if($pagina == "" || $pagina == 1){ // AQUI SE CHECA SI TIENE DATO O NO
		$pagina_1 = 0;
	}
else{
		$pagina_1 = ($pagina * $rxpag) - $rxpag;
	}

$cuenta_gps;
$cuenta_gps 		= " SELECT id_mttoSol FROM mttoSol WHERE id_contrato = '$id_contrato' ";

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);

contratoxid($id_contrato);
clientexid($id_cliente);
$nombre 	= strtoupper($razonSocial);

echo "<p>RESUMEN DE MANTENIMIENTO X CONTRATO :</p>";
echo "<h2> $nombre </h2>";

echo "<p>".$paginas_entero." PAGINAS,  $cuenta SOLICITUDES</p>";
echo "<p>".$rxpag." Resultados por Pagina</p><br>";
// FIN FASE 1 ALGORITMO DE PAGINACION


// $cuenta ; // TODOS LOS REGISTROS

$contador = 0;
for( $iconoMil = 1; $iconoMil <= ($cuenta); $iconoMil= $iconoMil+ 1000 ) 
	{
		$contador += 1;
		$fin 	= $contador * 1000;
		$inicio = $fin - 999;

// BOTON DE DESCARGA
echo "<p> 
	<a href='mttoSolResSupCteCTO_GET.php?id_usuario=$id_usuario&id_contrato=$id_contrato&contador=$contador' 
	title='DESCARGAR RESUMEN MANTENIMIENTO DEL $inicio AL $fin'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR RESUMEN'>
	DESCARGAR RESUMEN ULTIMOS DEL $inicio A MAXIMO $fin ANTERIORES </a>
	</p>";
// BOTON DE DESCARGA

	}
















echo "<section><fieldset><legend>RESUMEN DE MANTENIMIENTO</legend>";

$sql_mttoSol = '';

$sql_mttoSol = 'SELECT * '
		. ' FROM mttoSol '
		. "  WHERE id_contrato = '$id_contrato' "
		. ' ORDER BY '
		. ' id_mttoSol '
		. ' DESC '
		. " LIMIT $pagina_1, $rxpag " ;


include('mttoSolResultSet.php'); // TABLA QUE MUESTRA LOS RESULTADOS DEL QUERY RESUMEN

#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo 			= 1;
$pagina_maximo 			= $paginas_entero;

$paginas_intervalo 		= 5;
$pagina_vista_inicio 	= $pagina;

$min_mostrar = 1; // PARA TOPE MINIMO DE PAGINACION
if(($pagina_vista_inicio - $paginas_intervalo) > 0 ){
	$min_mostrar 		= $pagina_vista_inicio - $paginas_intervalo;
}

$max_mostrar 			= $paginas_entero;// PARA TOPE MAXIMO DE PAGINACION
if(($pagina_vista_inicio + $paginas_intervalo) < $max_mostrar){
	$max_mostrar 		= $pagina_vista_inicio + $paginas_intervalo;
}
	
$color = ''; // PARA CONDICIONAL PAGINA ACTUAL COLOR
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?pagina=$i&id_contrato=$id_contrato' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####

echo "</fieldset></section>";

} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>