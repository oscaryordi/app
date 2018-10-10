<?php
include'1header.php';
?>
      	<!--Import Google Icon Font-->
      	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      	<!--Import materialize.css-->
      	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      	<style type="text/css">
      		nav{background-color: #fff;
				clear: both;}
      	</style>
     	<!-- Compiled and minified CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
      	<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!--
    <div class="row">
      <form class="col s12">
        <div class="row">
		<h2>FORMULARIO DE CONTACTO</h2> 
		<H3>PARA QUEJAS Y SUGERENCIAS DE LA PLATAFORMA</H3>         	

        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea2" class="materialize-textarea" data-length="120"></textarea>
            <label for="textarea2">Textarea</label>
          </div>
        </div>
      </form>
    </div>
-->

<?php
$mostrar = 'si';

if(isset($_POST['action'])){
	$mostrar = 'no';
	echo "<div  class='container'>";
	echo "<h5>SE RECIBIERON LOS SIGUIENTES DATOS</h5>";
	echo $_POST['Mensaje']."<br>";
	echo "<a href='soporteQS.php'>Enviar otro comentario ... </a><br>";
	echo "</div>";


	$mensaje = mysqli_real_escape_string($dbd2, $_POST['Mensaje']) ;
	$nombreE = $_SESSION['nombre'];
	$correoE = $_SESSION['usuario'];

	//  $_SESSION["usuario"]
	//.$_SESSION['nombre'].$_SESSION['usuario']

	mail( 'odesales@jetvan.com.mx', 
		"COMENTARIO jetvan.mx ", 
		"$mensaje $nombreE $correoE ", 
		"From: notificaciones@jetvan.mx" );


}



if($mostrar == 'si'){
?>
			<div  class="container">
				<div class="col s12 m12 l6 offset-l3 ">
                  <div class="card-panel">
                    <h4 class="header2">Formulario de Contacto</h4>
                    <h5 class="header2">Para quejas y sugerencias de la plataforma</h5>
                    <div class="row">
                      <form class="col s12"  method="post" action="" >
                        <div class="row">
                          <div class="input-field col s12">
                            <textarea placeholder="Escriba su comentario aqui, maximo 120 caracteres" id="textarea2" class="materialize-textarea"  data-length="120" name='Mensaje' ></textarea>
                            <label for="textarea2" class="active">Mensaje</label>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Enviar
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>  
<?php 
}

?>



    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
      <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
      	  $(document).ready(function(){
			    $('input#input_text, textarea#textarea2').characterCounter();
		});
    </script>

<?php
include'1footer.php';
?>
<style type="text/css">
	nav{background-color: #fff;
		clear: both;
	}

	.container{
		clear: both;
	}
</style>