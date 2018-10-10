<?php
include("1header.php");

if($_SESSION["movForaneo"] > 0){ // PRIVILEGIO VISTA EJECUTIVO QUE REALIZA 

include ("nav_mov.php");


$id_usuario = $_SESSION["id_usuario"]; 


?>


<table >
	<tr style='background-color: #d2e0e0 ;'><td></td><td><b>CONSULTAR CLIENTE</b></td><td><b>RESULTADO</b></td></tr>
	<tr style='background-color: #d2e0e0 ;'>
		<td>Por Nombre</td>
		<td><input type='text' id='search19'></td>
		<td><div id="result19"></div></td>
	</tr>
	<tr style='background-color: #d2e0e0 ;'>
		<td>Por Alias</td>
		<td><input type='text' id='search20'></td>
		<td><div id="result20"></td>
	</tr>
</table>





<p>
<h3>CLIENTE: </h3>
<form action='' method='GET' >
<!-- -->

<table style="width: 600px;">
		<tr>
			<th style="width: 200px;">INDIQUE RFC DEL CLIENTE<br>
				<input type='text' id='search5'>
			</th>

			<td style='max-width: 200px;'>
					SELECCIONE EL CLIENTE DESPLIGUE LA PERSIANA -> <BR>
					<div id="result5"></div>
			</td>
		</tr>
</table>

<!--
Fecha Inicio->
<input type='text' id='fechainicio' name='fechainicio' placeholder='dd/mm/aaaa' />
Fecha Final->
<input type='text' id='fechafinal' name='fechafinal' placeholder='dd/mm/aaaa' />
-->

Resultados por pagina->
<select name='cuantosR' >
<option>50</option>
<option>100</option>
<option>300</option>
</select>

<input type='submit' name='consultar' value='consultar'>

</form>
<p/>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
     $(document).ready(function()
	{
 
        $('#search5').keyup(function()
		{
         var search5 = $('#search5').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search5:search5},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result5').html(data);
					}
				}
			});
        });


        $('#search19').keyup(function()
		{
         var search19 = $('#search19').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search19:search19},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result19').html(data);
					}
				}
			});
        });

        $('#search20').keyup(function()
		{
         var search20 = $('#search20').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search20:search20},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result20').html(data);
					}
				}
			});
        });




    });
</script>


<?php 

$id_cliente 	= @$_GET['id_cliente'];
//$fechainicio 	= @$_GET['fechainicio'];
//$fechafinal 	= @$_GET['fechafinal'];
$cuantosR 		= @$_GET['cuantosR'];

// TERMINA  FORMULARIO PARA FILTRAR PROYECTO ORIGEN DESTINO
#####


if(isset($_GET['consultar'])){// INICIA PROCESO DE FORMULARIO 





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

if($_SESSION["movForaneo"] == 0){
$cuenta_gps 		= " SELECT id_movFor FROM mov_traslados WHERE capturo = '$id_usuario' AND id_cliente = '$id_cliente' ";
}

if($_SESSION["movForaneo"] > 0){
$cuenta_gps 		= " SELECT id_movFor FROM mov_traslados WHERE id_cliente = '$id_cliente' ";	
}

$sacar_cuentagps 	= mysqli_query($dbd2, $cuenta_gps);
$cuenta 			= mysqli_num_rows($sacar_cuentagps);
$paginas 			= $cuenta/$rxpag;
$paginas_entero 	= ceil($cuenta/$rxpag);
// echo $cuenta."<br>";
// echo $paginas."<br>";
echo "<h2>RESUMEN DE TRASLADOS REGISTRADOS</h2>";
echo "<h3>".$paginas_entero." PAGINAS,  $cuenta TRASLADOS</h3>";
echo "<h4>".$rxpag." Resultados por Pagina</h4>";
echo "Página $pagina";
// FIN FASE 1 ALGORITMO DE PAGINACION


/*
// BOTON DE DESCARGA
echo "<p> 
	<a href='mttoSolRes_GET.php?id_usuario=$id_usuario&pagina=$pagina' 
	title='DESCARGAR RESUMEN MANTENIMIENTO'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR FLOTILLA'>
	</a>
	</p>";
// BOTON DE DESCARGA
*/

?>
<style>
	#ResTabla tr:hover {background-color: #ddd;}
</style>
<section><fieldset><legend>RESUMEN DE TRASLADOS</legend>

<?php


$sql_movFor = '';

if($_SESSION["movForaneo"] == 0){
// SI CONSULTA EJECUTIVO
	$sql_movFor = 'SELECT * '
        . ' FROM mov_traslados '
        . "  WHERE capturo = '$id_usuario'  AND id_cliente = '$id_cliente'  OR id_clienteD = '$id_cliente'  "
        . ' ORDER BY '
        . ' id_movFor '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}

if($_SESSION["movForaneo"] > 0){
// SI CONSULTA SUPERVISOR
	$sql_movFor = 'SELECT * '
        . ' FROM mov_traslados '
        . "  WHERE id_cliente = '$id_cliente' OR id_clienteD = '$id_cliente' "
        . ' ORDER BY '
        . ' id_movFor '
        . ' DESC '
        . " LIMIT $pagina_1, $rxpag " ;
}


echo "<table id='ResTabla' >";
echo "<tr>
<th>BD_mov</th>
<th>FECHA</th>
<th>UNIDAD</th>
<th>PROVEEDOR</th>
<th>CLIENTE ORIGEN</th>
<th>CLIENTE DESTINO</th>
<th>FOLIO INVENTARIO</th>
<th>DOMICILIO DESTINO</th>
<th>F</th>
<th>Ver</th>
<th>Editar</th>
<th>Borrar</th>
</tr>";


$movFor_R = mysqli_query($dbd2, $sql_movFor);

while($row = mysqli_fetch_assoc($movFor_R)){

	$id_movFor 	= $row['id_movFor'];
	$id_cliente = $row['id_cliente'];
	$id_contrato= $row['id_contrato'];
	$id_clienteD = $row['id_clienteD'];
	$id_contratoD= $row['id_contratoD'];
	$id_unidad 	= $row['id_unidad'];
	$folio_inv 	= $row['folio_inv'];
	$facturaT 	= $row['facturaT'];
	$costoT 	= $row['costoT'];

	$aliasEmergente 	= $row['aliasEmergente'];

	$kmO 		= $row['kmO'];
	$fechaO 	= $row['fechaO'];
	$horaO 		= $row['horaO'];
	$domicilioO = $row['domicilioO'];
	$estadoO 	= $row['estadoO'];
	$entregaNO 	= $row['entregaNO'];
	$telO 		= $row['telO'];

	$kmD 		= $row['kmD'];
	$fechaD 	= $row['fechaD'];
	$horaD 		= $row['horaD'];
	$domicilioD	= $row['domicilioD'];
	$estadoD 	= $row['estadoD'];
	$recibeND 	= $row['recibeND'];
	$telD 		= $row['telD'];

	$id_prov 	= $row['id_prov'];
	$conductor 	= $row['conductor'];

	$falso 		= $row['falso'];

// INICIO poner renglon resultados
	echo "<tr>";
	echo "<td>{$id_movFor}</td>";
	echo "<td>{$fechaD}</td>";
	datosxid($id_unidad);
	echo "<td>{$Economico} ::: {$Placas} ::: {$Serie} ::: {$Vehiculo}</td>";

	provTxid($id_prov);
	echo "<td>{$provTN}</td>";

	$aE = '';
	if($aliasEmergente != '0'){$aE = 'ae: '.$aliasEmergente;};
	clientexid($id_cliente);
	echo "<td>{$aE} {$alias} ::: {$razonSocial} </td>";

	clientexid($id_clienteD);
	echo "<td>{$aE} {$alias} ::: {$razonSocial} </td>";


	echo "<td>{$folio_inv}</td>";
	echo "<td>{$domicilioD}</td>";
	echo "<td>{$falso}</td>";

	echo "<td>";
	echo " <a href='movVerxId.php?id_movFor=$id_movFor&pagina=$pagina'  
			style='text-decoration:none;'  title='Ver detalle' >
			<img src='img/Text_preview.gif' style='width:16px;height:16px;'  alt='Ver detalle' >
		</a> ";
	echo "</td>";

	echo "<td>";
	echo " 	<a href='movEdit.php?id_movFor=$id_movFor&pagina=$pagina'  
				style='text-decoration:none;'  title='Editar' >
			<img src='img/Modify.gif' style='width:16px;height:16px;'  alt='Editar' >
			</a> ";
	echo "</td>";

	echo "<td>";
	echo " 	<form action='movBorrar.php' method='post'>
            	<input type='hidden' value='$id_movFor' name='id_movFor'>";
        ?>
            <a onClick="javascript: return confirm('Confirma proceder a BORRAR DOCUMENTO'); " >
        <?php
    echo "  	<input type='submit' value='Borrar' name='borrar' title='Borrar' > </a>
        	</form> ";
	echo "</td>";


	echo "</tr>";
// FIN poner renglon resultados

}
echo "</table></fieldset></section>";


#####
// INICIO ALGORITMO PAGINACION // 2da parte
$pagina_minimo = 1;
$pagina_maximo = $paginas_entero;

$paginas_intervalo 	= 5;
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
		echo "<a href='movResClt.php?pagina=$i&consultar=consultar&id_cliente=$id_cliente' 
				style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
// FIN ALGORITMO PAGINACION // 2da parte
#####


	}// TERMINA PROCESO DE FORMULARIO 


} // FIN PRIVILEGIO EJECUTIVO QUE REALIZA

include("1footer.php");?>