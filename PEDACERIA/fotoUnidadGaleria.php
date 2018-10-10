<?php
include '1header.php';
include_once ("base.inc.php");
include_once ("funcion.php");    
    
$id_unidad = $_GET['id_unidad'];

datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";    
echo "SUBIR FOTOS";    

include ("u4datos.php");
include ("u5placas.php");

//include ("fotoUnidadCD.php"); // CREAR DIRECTORIO PARA CARGA DE FOTO


if($_SESSION["fotoUnidad"] > 0){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO ?>

		<!--<script src="js/jquery-1.11.2.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

 <style>

  #container {
    overflow: hidden;
    position: relative;
    height: 400px;
  }
 
  .galeria {
    position: absolute;
    height: 360px;
    width: auto;
  }
  </style>

<script>
  $( function() {
    function left( element, using ) {
      element.position({
        my: "right middle",
        at: "left+25 middle",
        of: "#container",
        collision: "none",
        using: using
      });
    }
    function right( element, using ) {
      element.position({
        my: "left middle",
        at: "right-25 middle",
        of: "#container",
        collision: "none",
        using: using
      });
    }
    function center( element, using ) {
      element.position({
        my: "center middle",
        at: "center middle",
        of: "#container",
        using: using
      });
    }
 
    left( $( ".galeria:eq(0)" ) );
    center( $( ".galeria:eq(1)" ) );
    right( $( ".galeria:eq(2)" ) );
 
    function animate( to ) {
      $( this ).stop( true, false ).animate( to );
    }
    function next( event ) {
      event.preventDefault();
      center( $( ".galeria:eq(2)" ), animate );
      left( $( ".galeria:eq(1)" ), animate );
      right( $( ".galeria:eq(0)" ).appendTo( "#container" ) );
    }
    function previous( event ) {
      event.preventDefault();
      center( $( ".galeria:eq(0)" ), animate );
      right( $( ".galeria:eq(1)" ), animate );
      left( $( ".galeria:eq(2)" ).prependTo( "#container" ) );
    }
    $( "#previous" ).on( "click", previous );
    $( "#next" ).on( "click", next );
 
    $( ".galeria" ).on( "click", function( event ) {
      $( ".galeria" ).index( this ) === 0 ? previous( event ) : next( event );
    });
 
    $( window ).on( "resize", function() {
      left( $( ".galeria:eq(0)" ), animate );
      center( $( ".galeria:eq(1)" ), animate );
      right( $( ".galeria:eq(2)" ), animate );
    });
  } );
  </script>





<div id="container">

<?php


//CONSULTA ARCHIVOS
$sqlFOTO = 'SELECT id_foto, archivo, ruta, tipo ' 
        . ' FROM '
        . ' fotoUnidad '
        . " WHERE id_unidad = '$id_unidad' 
         AND borrar = 0 ORDER BY tipo ASC LIMIT 3 ";
//FIN CONSULTA

$resFOTO 	= mysql_query($sqlFOTO);

	if($resFOTO){ // INICIA hubo resultados
	while($row = mysql_fetch_assoc($resFOTO))
		{ // INICIA PONER RESULTADOS

			$archivoFoto 	= $row['archivo'];
			$rutaFoto 		= $row['ruta'];
		
		// INICIO poner renglon resultados
			echo "<img src='../exp/fotos/$rutaFoto/$archivoFoto' 
            width='auto' height='400' alt='IMAGEN' class='galeria' >";
		// FIN poner renglon resultados

		} // TERMINA PONER RESULTADOS
	echo "</table>";
	} // TERMINA hubo resultados

?>



<!--
  <img src="images/earth.jpg" width="458" height="308" alt="earth">
  <img src="images/flight.jpg" width="512" height="307" alt="flight">
  <img src="images/rocket.jpg" width="300" height="353" alt="rocket">
  src='http://www.jetvan.mx/jetvan/exp/$rutaFoto/$archivoFoto' 



 -->




  <a id="previous" href="#"> <-Previo </a> | 
  <a id="next" href="#"> Siguiente-> </a>
</div>






<?php } // CIERRE PRIVILEGIOS 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<p>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </p>";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

include ("1footer.php"); ?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/overcast/jquery-ui.min.css" />