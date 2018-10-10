<?php
##### PAGINACION 2DA PARTE
// INICIO ALGORITMO PAGINACION // 2da parte
if(@$variablesGet == ''){$variablesGet 	=	'';};

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

// IR APRIMERA PAGINA
echo "<br>";
echo "<a href='?pagina=1' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >Primera</a> ";
for($i=$min_mostrar; $i <= ($max_mostrar); $i++) 
	{
		if($pagina == $i) // IF CONDICIONAL PARA EL COLOR DE PAGINA ACTUAL
			{
				$color = 'red';
			}
		else {$color='';}
		echo "<a href='?".$variablesGet."pagina=$i' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >$i</a> ";
	}
echo "<a href='?pagina=$pagina_maximo' style='color:$color;text-decoration: none; padding: 0px 7px; margin: 0px 2px; background-color: #F8F8F8 ;' >Última</a> ";
// FIN ALGORITMO PAGINACION // 2da parte
#####
##### // FORMULARIO ELEGIR PAGINA
echo "  <br>ELEGIR PAGINA:";
echo "	<form action='' method='get' style='display: inline;'>
		<input type='text' name='pagina' maxlength='5' size='5' value='$pagina'>
		<input type='submit' name='submit' value='Ir'>
		</form>";
echo "";
##### // FORMULARIO ELEGIR PAGINA
##### PAGINACION 2DA PARTE