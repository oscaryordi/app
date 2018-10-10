<?php
if($_SESSION["kmUsr"] > 0)
{
	kmxid($id_unidad);
	if($kmUltimo > 0)
	{
		$kmUltimo = number_format($kmUltimo);
		echo "  <fieldset><legend>-</legend>";
		echo "  Último kilometraje reportado: ".$kmUltimo;
		echo "  <a href='kmhistorico.php?id_unidad=".@$id_unidad."'>
				<button type='button' title='VER HISTORICO DE KILOMETRAJE'>kmH
				</button></a>";
		echo "  </fieldset>";
	}
}
?>