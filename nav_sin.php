<hr>
<?php if($_SESSION["siniestro"] > 0){ // RESUMEN MTTO ?>
<form action="sinRes.php" class="navegacion"><input id="gobutton2" type="submit" name="" value="Resumen Siniestros"></form>
<?php }

if($_SESSION["siniestro"] > 1){ // RESUMEN MTTO ?>
<form action="sinResDed.php" class="navegacion"><input id="gobutton2" type="submit" name="" value="Solicitudes" title='SOLICITUDES DE PAGOS DE DEDUCIBLES Y HOJALATERIA'></form>
<?php }

if($_SESSION["siniestro"] > 1){ // RESUMEN MTTO ?>
<form action="sinindex.php" class="navegacion"><input id="gobutton2" type="submit" name="" value="Buscar Siniestro"></form>
<?php }

if($_SESSION["siniestro"] > 7){ // RESUMEN MTTO ?>
<form action="#" class="navegacion"><input id="gobutton2" type="submit" name="" value=""></form>
<?php }

if($_SESSION["siniestro"] > 7){ // RESUMEN MTTO ?>
<form action="#" class="navegacion"><input id="gobutton2" type="submit" name="" value=""></form>
<?php } 

if($_SESSION["siniestro"] > 7){ // RESUMEN MTTO ?>
<form action="#" class="navegacion"><input id="gobutton2" type="submit" name="" value=""></form>
<?php }

if($_SESSION["siniestro"] > 7){ // RESUMEN MTTO ?>
<form action="#" class="navegacion"><input id="gobutton2" type="submit" name="" value=""></form>
<?php }

if($_SESSION["siniestro"] > 7){ // RESUMEN MTTO ?>
<form action="#" class="navegacion"><input id="gobutton2" type="submit" name="" value=""></form>
<?php } ?>