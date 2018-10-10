<?php
include("1header.php");
?>
<fieldset><legend>Consulta de Unidad Vehicular</legend>
<table>
<FORM action="u3index.php" method="POST">
    <tr>
        <td>Económico</td>
        <td><INPUT TYPE="text" NAME="economico" placeholder="economico" autofocus></td>
        <td><INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar"></td>
    </tr>
</FORM>

<FORM action="u3index.php" method="POST">
	<tr>
        <td>Placas</td>
        <td><INPUT TYPE="text" NAME="placas" placeholder="placas"></td>
        <td><INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar"></td>
    </tr>
</FORM>

<FORM action="u3index.php" method="POST">
    <tr>
        <td>Serie</td>
        <td><INPUT   TYPE="text" NAME="serie" placeholder="serie"></td>
        <td><INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar"></td>
    </tr>
</FORM>

<FORM action="u2fserie.php" method="POST">
    <tr>
        <td>Final de Serie</td>
        <td><INPUT   TYPE="text" NAME="uFns" placeholder="Ultimos digitos de la serie"></td>
        <td><INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar"></td>
    </tr>
</FORM>


<?php
if($_SESSION["ecoCliente"] > 0 ){
?>
<FORM action="ecoCliente.php" method="POST">
    <tr>
        <td>Económico Cliente</td>
        <td><input   type="text" name="ecoCliente" placeholder="economico cliente"></td>
        <td><input id="gobutton" type="SUBMIT" name="ENVIAR" value="consultar"></td>
    </tr>
</FORM>
<?php 
}
?>

</table>
</fieldset>

<?php 
if($_SESSION["consultaB"] > 0)
{
?>
<div style='padding:5px;'>
    <p>
        <form action='consultaBindex.php' method='post'>
            <input type='submit' name='consultaB' value='Consultar Listado'  >
        </form>
    </p>
</div>
<?php 
}


if($_SESSION["compra"] > 0) // PRIVILEGIO EXCLUSIVO
{
?>
<DIV>
<fieldset style='max-width: 450px;'><legend>BUSQUEDA POR FOLIO DE FACTURA DE ORIGEN</legend>
<FORM action="uFolioFactura.php" method="POST">
    <tr>
        <td>Búsqueda por Folio de Factura</td>
        <td><INPUT   TYPE="text" NAME="folioFactura" placeholder="Digitar Folio de Factura"></td>
        <td><INPUT id="gobutton" TYPE="SUBMIT" NAME="ENVIAR" VALUE="consultar"></td>
    </tr>
</FORM>
</fieldset>
</DIV>
<?php 
}




include("1footer.php");?>