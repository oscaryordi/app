<?php
include("1header.php");

if($_SESSION["asigcto"] > 1){ // INICIA PRIVILEGIO VISTA A ASIGNACION 
include ("nav_asigna.php");

$subido = '';

if(isset($_POST['Datos']))
    {
        if(	$_POST['id_usuario']!='' 
        	&& $_POST['id_cliente']!=''
        	&& $_POST['id_contrato']!='' 
        	&& $_POST['fechaInicio']!='' 
          )
            {		
                $id_usuario 	= mysqli_real_escape_string($dbd2, $_POST['id_usuario']);
                $id_cliente  	= mysqli_real_escape_string($dbd2, $_POST['id_cliente']);
                $id_contrato 	= mysqli_real_escape_string($dbd2, $_POST['id_contrato']);
                $fechaInicio	= mysqli_real_escape_string($dbd2, $_POST['fechaInicio']);
                $id_subDiv2 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv2']):'0';
                $id_subDiv3 	= @(mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']) != '' 
									AND mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']))? mysqli_real_escape_string($dbd2, $_POST['id_subDiv3']):'0';

                
                $capturo    = $_SESSION["id_usuario"];

				// VALIDAR PASO DE ID's
				echo "<p>"	.$id_usuario
							." - ".$id_cliente
							." - ".$id_contrato
							." - ".$id_subDiv2
							." - ".$id_subDiv3
							." - ".$fechaInicio
							."</p>" ;

				// QUERY CANDADO NO SE DUPLIQUE
				$sql_existe = "	SELECT * 
								FROM asignaEjecutivo 
								WHERE id_usuario 	= '$id_usuario' 
								AND id_cliente 		= '$id_cliente' 
								AND id_contrato 	= '$id_contrato' 
								AND id_subDiv2 		= '$id_subDiv2' 
								AND id_subDiv3 		= '$id_subDiv3' 
								AND fecha_final IS NULL LIMIT 1 ";

				$sql_existe_resp = mysqli_query($dbd2, $sql_existe);

				// QUERY CANDADO NO SE DUPLIQUE
				if(mysqli_affected_rows($dbd2) == 0) // CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION // FORMULA PARA SABER SI HUBO RESULTADOS
					{
						$sql_cto_AsignaE = 'INSERT INTO `jetvantlc`.`asignaEjecutivo` 
						    				(	`id_a_contrato`, `id_usuario`, `id_cliente`, `id_contrato`, 
						    					fecha_inicio, id_subDiv2, id_subDiv3,
						    					`capturo`) VALUES ';
						$sql_cto_AsignaE .= "(	NULL, '$id_usuario', '$id_cliente', '$id_contrato', 
												'$fechaInicio', '$id_subDiv2', '$id_subDiv3', 
												'$capturo') ;" ;
						$AsignaE_rs = mysqli_query($dbd2, $sql_cto_AsignaE );

						    if($AsignaE_rs){ 
						        echo "<h2><span style='color:red'>EJECUTIVO</span> ASIGNADO A CONTRATO CORRECTAMENTE</h2>";
						    	echo '<h2>A CONTRATO</h2>';
							}
	 					$subido = 'ok'	;	
	  				} // CANDADO PARA QUE NO SE DUPLIQUE ASIGNACION
	  			else
	  				{
	  					echo "<p>Asignación ya existe</p>";
	  				}
            }
		else
			{	
				echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786;</p>";
			}
   }

if($subido!='ok'){ ?>

<style>
#alta input {min-width:200px;} #alta #gobutton {width:auto;}
#formulario {padding:5px;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
     $(document).ready(function()
	{
         $('#search7').keyup(function()
		{
         var search7 = $('#search7').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search7:search7},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result7').html(data);
					}
				}
			});
        });

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

<script>
 function buscaContratos()
		{
         var search6 = $('#search6').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search6:search6},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result6').html(data);
					}
				}
			});
        };
</script>

<script>
function buscaAreaAd()
		{
		 var search26 = $('#search26').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search26:search26},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result26').html(data);
					}
				}
			});
		};
</script>

<script>
function buscaSubAreaAd()
		{
		 var search35 = $('#search35').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search35:search35},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result35').html(data);
					}
				}
			});
		};
</script>



<?php // FECHA DE MEXICO
date_default_timezone_set('America/Mexico_city');
?>
<div id='formulario'>
<table>
<caption>Busqueda para referencia rápida</caption>
	<tr>
		<td style='background-color: #d2e0e0 ;'>
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
					<td><div id="result20"></td></tr>
			</table>
		</td>
	</tr>
</table>

<form id='alta'  action='' method='POST' > 
	<h2>ASIGNAR EJECUTIVO DE CUENTA A CLIENTE / CONTRATO</h2>

<table>

	<tr>
		<td></td>
		<th>BUSCAR</th>
		<th>SELECCIONAR OPCION</th>
	</tr>

	<tr><th>NOMBRE DEL EJECUTIVO</th>
		<td>
			<input type='text' id='search7'>
		</td>
		<td>
				<div id="result7"></div>
		</td>
	</tr>


	<tr><th>RFC CLIENTE</th>
		<td>
			<input type='text' id='search5'>
		</td>

		<td>
				<div id="result5"></div>
		</td>
	</tr>


	<tr><th>CONTRATO</th>
		<td>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result6"></div>
		</td>
	</tr>


	<tr><th>AREA ADMINISTRATIVA</th>
		<td>
			<!-- <input type='text' id='search6'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result26"></div>
		</td>
	</tr>

	<tr><th>SUBAREA</th>
		<td>
			<!-- <input type='text' id='search26'> OBTENIDO ARRIBA -->
		</td>
		<td>
				<div id="result35"></div>
		</td>
	</tr>


	<tr><th>FECHA DE ASIGNACION</th>
		<td>
		</td>
		<td><input type='date' name='fechaInicio' value="<?php echo date("Y-m-d");?><?php echo @$_POST['fechaInicio'];?>" placeholder='aaaa-mm-dd'>aaaa-mm-dd </td>
 		</td>
    <tr>


     <tr>
		<td colspan=3 style="text-align:center;" >
		<input id="gobutton2" type="submit" name="Datos" value="Asignar Ejecutivo a Contrato"> 
		</td>
	</tr>
</table>
</form>
</div>
<?php } 
} // FIN PRIVILEGIO VISTA ASIGNACION 
include("1footer.php");?>