<?php
include("1header.php");
$paginaR 	= $_GET['pagina'];
echo $paginaR;

if($_SESSION["movForaneo"] > 0)
{ // PRIVILEGIO VISTA LOGISTICA

include("nav_mov.php");
$id_movForR = $_GET['id_movFor'];


/**/
	if($_SESSION["movForaneo"] > 0){} // NAVEGAR ENTRE ECONOMICOS FOLIOS PROXIMOS
		$siguienteEco 	= $id_movForR + 1;
		$anteriorEco 	= $id_movForR - 1;
		?>
		<style>.lineaF{display: inline-block;}</style>
		<?php
		echo "<h3>VER TRASLADOS</h3>";
		echo "
		<FORM class='lineaF' action='movVerxId.php' method='GET'>
		<INPUT TYPE='text' NAME='id_movFor' value = '$anteriorEco' hidden >
		<INPUT TYPE='hidden' NAME='pagina' VALUE='$paginaR'>
		<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='<- ANTERIOR'>
		</FORM>
		<FORM class='lineaF'  action='movVerxId.php' method='GET'>
		<INPUT TYPE='text' NAME='id_movFor' value = '$siguienteEco' hidden >
		<INPUT TYPE='hidden' NAME='pagina' VALUE='$paginaR'> 
		<INPUT TYPE='SUBMIT' NAME='ENVIAR' VALUE='SIGUIENTE->'>
		</FORM>";
	



echo "<h2>TRASLADO BD : $id_movForR </h2>";
echo "<p>";

include('trasladoRegistrado.php');


buscaDocTra($id_movFor);
echo "<iframe src='https://sistema.jetvan.com.mx/exp/traslados/$rutaTra/$ArchivoTra' height='200' width='900'></iframe>";


echo "</p>";

} // FIN PRIVILEGIO VISTA LOGISTICA



// VOLVER A RESUMEN
//$pagina = ($pagina!='')? $pagina : 1 ;
	echo "<br>
		<p>
		<a href='movResTodo.php?pagina=$paginaR'>Volver</a>
		<FORM action='movResTodo.php' method='GET'>
			<INPUT TYPE='hidden' NAME='pagina' VALUE='$paginaR'>
			<INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a Resumen'>
		</FORM>
		</p>";
// VOVLER A RESUMEN
//movVerxId.php?id_movFor=308&pagina=1



include("1footer.php");?>