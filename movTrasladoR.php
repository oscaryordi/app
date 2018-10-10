<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["movForaneo"] > 0){  // APERTURA PRIVILEGIOS 
include ("nav_mov.php");



if(isset($_POST{'ElegirUnidad'})){
	echo $id_unidad = $_POST['id_unidad'];
	echo "MOSTRAR ESTO";
}

if(isset($_POST{'Datos'})){
	echo $id_unidad = $_POST['id_unidad'];
	echo "MOSTRAR ESTO";
}



?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	 $(document).ready(function()
	{
 
		$('#search28').keyup(function()
		{
		 var search28 = $('#search28').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{'search28':search28},
				type: 'POST',
				dataType: 'html',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result28').html(data);
					}
				}
			});
		});


		$('#search29').keyup(function()
		{
		 var search29 = $('#search29').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search29:search29},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result29').html(data);
					}
				}
			});
		});

		$('#search30').keyup(function()
		{
		 var search30 = $('#search30').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search30:search30},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result30').html(data);
					}
				}
			});
		});


		$('#search31').keyup(function()
		{
		 var search31 = $('#search31').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search31:search31},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result31').html(data);
					}
				}
			});
		});

	});
</script>

<!--
				 <input type='hidden' name='id_unidad' value='1260'>
-->


<h2>1. REGISTRAR TRASLADO</h2>



<section>
<form id='alta'  action='movTrasladoRF.php' method='POST' > 
	<table>
		<tr>
			<th>ECONOMICO</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search28'>
			</td>
			<td>
				<div id="result28"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="DatosU" value="Elegir"> 
			</td>
		</tr>
	</table>
</form>
</section>


<section>
<form id='alta'  action='movTrasladoRF.php' method='POST' > 
	<table>
		<tr>
			<th>PLACAS</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search29'>
			</td>
			<td>
				<div id="result29"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="DatosU" value="Elegir"> 
			</td>
		</tr>
	</table>
</form>
</section>


<section>
<form id='alta'  action='movTrasladoRF.php' method='POST' > 
	<table>
		<tr>
			<th>SERIE</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search30'>
			</td>
			<td>
				<div id="result30"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="DatosU" value="Elegir"> 
			</td>
		</tr>
	</table>
</form>
</section>


<section>
<form id='alta'  action='movTrasladoRF.php' method='POST' > 
	<table>
		<tr>
			<th>FINAL SERIE</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search31'>
			</td>
			<td>
				<div id="result31"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="DatosU" value="Elegir"> 
			</td>
		</tr>
	</table>
</form>
</section>


<?php	
} // CIERRE PRIVILEGIOS 
include ("1footer.php"); ?>