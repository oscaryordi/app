<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["clientes"] > 0)
{  // APERTURA PRIVILEGIOS
include("nav_cliente.php");

// SEARCH 5 busca el rfc 
// SEARCH 8 busca la razon social
// SEARCH 9 busca el alias del cliente
// SEARCH 10 busca el contrato por id alan
// SEARCH 11 busca el contrato por numero oficial
// SEARCH 12 busca el contrato por alias
?>
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


        $('#search8').keyup(function()
		{
         var search8 = $('#search8').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search8:search8},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result8').html(data);
					}
				}
			});
        });

        $('#search9').keyup(function()
		{
         var search9 = $('#search9').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search9:search9},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result9').html(data);
					}
				}
			});
        });




        $('#search10').keyup(function()
		{
         var search10 = $('#search10').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search10:search10},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result10').html(data);
					}
				}
			});
        });



        $('#search11').keyup(function()
		{
         var search11 = $('#search11').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search11:search11},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result11').html(data);
					}
				}
			});
        });



        $('#search12').keyup(function()
		{
         var search12 = $('#search12').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search12:search12},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result12').html(data);
					}
				}
			});
        });


     });
</script>


<div style="margin:15px;">

<h2>CLIENTE</h2>
<?PHP // BUSCAR POR RFC ?>
<section>
<form id='alta'  action='clienteindexuno.php' method='POST' > 
	<h4>POR RFC</h4>
	<table>
		<tr>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search5'>
			</td>
			<td>
				<div id="result5"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Consultar"> 
			</td>
		</tr>
	</table>
</form>
</section>


<?PHP // BUSCAR POR RAZON SOCIAL ?>
<section>
<form id='alta'  action='clienteindexuno.php' method='POST' > 
	<h4>POR RAZON SOCIAL</h4>
	<table>
		<tr>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>

			<td>
				<input type='text' id='search8'>
			</td>
			<td>
				<div id="result8"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Consultar"> 
			</td>
		</tr>
	</table>
</form>
</section>


<?PHP // BUSCAR POR ALIAS DEL CLIENTE ?>
<section>
<form id='alta'  action='clienteindexuno.php' method='POST' > 
	<h4>POR ALIAS</h4>
	<table>
		<tr>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search9'>
			</td>
			<td>
				<div id="result9"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Consultar"> 
			</td>
		</tr>
	</table>
</form>
</section>











<h2>CONTRATO</h2>
<?PHP // BUSCAR CONTRATO POR ID ALAN ?>
<section>
<form id='alta'  action='ctoIndex.php' method='POST' > 
	<h4>POR ID (ALAN)</h4>
	<table>
		<tr>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search10'>
			</td>
			<td>
				<div id="result10"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Consultar"> 
			</td>
		</tr>
	</table>
</form>
</section>


<?PHP // BUSCAR CONTRATO POR NUMERO search11 ?>
<section>
<form id='alta'  action='ctoIndex.php' method='POST' > 
	<h4>POR NUMERO FORMAL DE LA DEPENDENCIA</h4>
	<table>
		<tr>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search11'>
			</td>
			<td>
				<div id="result11"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Consultar"> 
			</td>
		</tr>
	</table>
</form>
</section>


<?PHP // BUSCAR CONTRATO POR ALIAS search12 ?>
<section>
<form id='alta'  action='ctoIndex.php' method='POST' > 
	<h4>POR ALIAS</h4>
	<table>
		<tr>
			<th>BUSCAR</th>
			<th>SELECCIONAR OPCION</th>
		</tr>
		<tr>
			<td>
				<input type='text' id='search12'>
			</td>
			<td>
				<div id="result12"></div>
			</td>
		</tr>
	    <tr>
			<td colspan=3 style="text-align:center;" >
				<input id="gobutton2" type="submit" name="Datos" value="Consultar"> 
			</td>
		</tr>
	</table>
</form>
</section>

</div>


<?php  
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>