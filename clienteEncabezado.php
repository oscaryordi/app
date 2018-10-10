<?php
echo "<br><fieldset><legend>CLIENTE / CONTRATO</legend>
	<table>
		<tr>
			<th colspan=2 >CLIENTE</th>
			<th colspan=2 >CONTRATO</th>
		<tr>	
		<tr>
			<th>RFC</th>
			<td>$rfc</td>
			<th>ID_ALAN</th>
			<td><span style='font-weight:bold;
				color:red;
				font-size:2em;'>
				$id_alan</span></td>
		</tr>
		<tr>
			<th>Razon Social</th>
			<td><span style='font-weight:bold;'>$razonSocial</span></td>
			<th>Numero Formal</th>
			<td><span style='font-weight:bold;
				font-size:2em;'>
				$numero</span></td>
		</tr>
		<tr>
			<th>Alias CTE</th>
			<td>$alias</td>
			<th>Alias CTO</th>
			<td>$aliasCto</td>
		</tr>
	</table>
	</fieldset>";
?>