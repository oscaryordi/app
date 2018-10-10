<?php
include_once ("base.inc.php");
include_once("funcion.php");

// datosporeconomico('210112');
// datosporserie('3N1EB31S5AK331039');
// datosporplaca('MFE2320');


//$uPlacas = $_POST['uPlacas'];
//$uNEco = $_POST['uNEco'];
//$uSerie = $_POST['uSerie'];

//$uPlacas = 'MFE2320';
//$uNEco = '210112';
// $uSerie = '3N1EB31S5AK331039';
// datosporserie($uSerie);

if(isset($uPlacas) && $uPlacas !== ''){
	datosporplaca($uPlacas);
	}
elseif(isset($uNEco) && $uNEco !== ''){
	datosporeconomico($uNEco);
	}
elseif(isset($uSerie) && $uSerie !== ''){
	datosporserie($uSerie);
	}

echo $Economico."<br>";
echo $Serie."<br>";
echo $Vehiculo."<br>";
echo $Modelo."<br>";
echo $Color."<br>";
echo $Motor."<br>";
echo $Placas."<br>"; 


// PRUEBA DE FUNCION PARA LIMPIAR Placas Serie O Economico


@$uPlacas = $_POST['uPlacas'];
@$uNEco = $_POST['uNEco'];
@$uSerie = $_POST['uSerie'];

if(isset($_POST['Movimientos'])){


	if(isset($uPlacas)){
	$uPlacas = limpiarVariable($uPlacas);
	}

	if(isset($uNEco)){
	$uNEco = limpiarVariable($uNEco);
	}	
	
	if(isset($uSerie)){
	$uSerie = limpiarVariable($uSerie);
	}	
	
	

echo @$uPlacas." Limpio Fuera?";
echo @$uNEco." Limpio Fuera?";
echo @$uSerie." Limpio Fuera?";

}

?>
<table>
	<FORM action="muestrasprevias.php" method="POST">
		<tr>
			<th colspan=4 >Indique uno de los 3 siguientes datos.</th>
		</tr>
		<tr>
			<td>Económico<INPUT TYPE="text" NAME="uNEco" placeholder="Pon aqui el economico"></td>
			<td>Placas<INPUT TYPE="text" NAME="uPlacas" placeholder="Aqui van las placas" autofocus></td>
			<td>Serie<INPUT   TYPE="text" NAME="uSerie" placeholder="Aqui la serie"></td>
			<td colspan=3 align=center ><INPUT id="gobutton2" TYPE="SUBMIT" NAME="Movimientos" VALUE="Ver movimientos"></td>
		</tr>		
	</FORM>
</table>



