<?php
include("1header.php");
echo "<meta charset='utf-8'>";

if($_SESSION["mttos"] > 1 OR $_SESSION["proveedores"] > 0 )
{  // APERTURA PRIVILEGIOS
include("nav_mtto.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery-1.11.2.min.js"></script> -->
<script >
	$(document).ready(function()
	{
		$('#search14').keyup(function()
		{
		 var search14 = $('#search14').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search14:search14},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result14').html(data);
					}
				}
			});
		});

		$('#search17').keyup(function()
		{
		 var search17 = $('#search17').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search17:search17},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result17').html(data);
					}
				}
			});
		});

		$('#search18').keyup(function()
		{
		 var search18 = $('#search18').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search18:search18},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result18').html(data);
					}
				}
			});
		});

		$('#search21').keyup(function()
		{
		 var search21 = $('#search21').val();
			$.ajax(
			{
				url:'asignasearch.php',
				data:{search21:search21},
				type: 'POST',
				success:function(data)
				{
					if(!data.error) 
					{
						$('#result21').html(data);
					}
				}
			});
		});		  
	});
</script>
<div style='padding: 5px 5px;' >
<br>
<section>
<FORM action="provindex.php" method="POST">
<table>
	<tr style='height: 6.5em;'>
		<th style='width: 7em; font-weight: normal;'>RFC</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search14' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result14"></div>
		<INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar" >	
		</td>
	</tr>
</table>
</FORM>
</section>


<section>
<FORM action="provindex.php" method="POST">
<table>
	<tr style='height: 6.5em;'>
		<th style='width: 7em; font-weight: normal;'>NOMBRE</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search17' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result17"></div>
		<INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar">	
		</td>
	</tr>
</table>
</FORM>
</section>


<section>
<FORM action="provindex.php" method="POST">
<table>
	<tr style='height: 6.5em;'>
		<th style='width: 7em; font-weight: normal;'>ALIAS O NOMBRE COMERCIAL</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search21' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result21"></div>
		<INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar">	
		</td>
	</tr>
</table>
</FORM>
</section>


<section>
<FORM action="provindex.php" method="POST">
<table>
	<tr style='height: 6.5em;'>
		<th style='width: 7em; font-weight: normal;'>ESTADO</th>
		<td style='vertical-align: top;'>
			Buscar-> &#128269;<input type='text' id='search18' maxlength='13' size='14' >
		<br>
			Resultados:  
			<div id="result18"></div>
		<INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar">	
		</td>
	</tr>
</table>
</FORM>
</section>

<?php

if($_SESSION["proveedores"] > 1)
{
// BOTON DE DESCARGA
echo "<p> 
	<a href='provListado_GET.php' 
	title='DESCARGAR LISTADO DE PROVEEDORES'>
	<img src='img/Download1.gif' style='width:16px;height:16px;' alt='DESCARGAR LISTADO'>
	DESCARGAR LISTADO DE PROVEEDORES
	</a>
	</p>";
// BOTON DE DESCARGA
}


include('provlistado.php'); 

echo "</div>";
} // CIERRE PRIVILEGIOS
include ("1footer.php"); ?>