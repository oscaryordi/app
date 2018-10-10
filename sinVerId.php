<?php
include '1header.php';
// VER SINIESTRO
?>
<style>
.fa-upload{color:gray;}
.fa-upload:hover{ color:green;}
.fa-edit{color:gray;}
.fa-edit:hover{ color:green;}
</style>
<?php 


$id_siniestro = $_GET['id_siniestro'];

// if(){;}
$pagina 	= @$_GET['pagina'];   // PARA PODER VOLVER AL A PAGINA DE LA QUE VIENE

########## ########## ########## ########## ########## 
$sql_sin 	= "SELECT * FROM `siniestro` WHERE `id_siniestro` = '$id_siniestro' LIMIT 1 ";
$sql_sin_R 	= mysqli_query($dbd2, $sql_sin);
$sql_sin_M 	= mysqli_fetch_array($sql_sin_R);

$id_siniestro 	=	$sql_sin_M['id_siniestro'];
$id_unidad 		=	$sql_sin_M['id_unidad'];
$id_cliente 	=	$sql_sin_M['id_cliente'];
$id_contrato 	=	$sql_sin_M['id_contrato'];

$edoSin			=	$sql_sin_M['edoSin'];
$cdSin 			=	$sql_sin_M['cdSin'];
$domSin 		=	$sql_sin_M['domSin'];
$motivo 		= 	$sql_sin_M['motivo'];
$aseguradora 	=	$sql_sin_M['aseguradora'];
$fechaSin 		= 	$sql_sin_M['fechaSin'];
$numSin			= 	$sql_sin_M['numSin'];
$numPoliza		= 	$sql_sin_M['numPoliza'];
$numInciso 		=	$sql_sin_M['numInciso'];

$numReporte 	=	$sql_sin_M['numReporte'];
$fechaRep 		=	$sql_sin_M['fechaRep'];
$tipoSin 		=	$sql_sin_M['tipoSin'];

$telCond 		=	$sql_sin_M['telCond'];
$edadCond 		=	$sql_sin_M['edadCond'];
$nomConductor 	=	$sql_sin_M['nomConductor'];

$status			=	$sql_sin_M['status'];
$responsabilidad =	$sql_sin_M['responsabilidad'];
$ejecutivoAsg 	=	$sql_sin_M['ejecutivoAsg'];
$corralon 		= 	$sql_sin_M['corralon'];
$contactoCte 	=	$sql_sin_M['contactoCte'];
$datosCte 		= 	$sql_sin_M['datosCte'];
$contactoAsg	= 	$sql_sin_M['contactoAsg'];
$telAsg			= 	$sql_sin_M['telAsg'];
$fechaAsigAsg 	=	$sql_sin_M['fechaAsigAsg'];
$gestorJV 		=	$sql_sin_M['gestorJV'];

$telGJV			=	$sql_sin_M['telGJV'];
$fechaAcredProp =	$sql_sin_M['fechaAcredProp'];
$fechaICrrln 	=	$sql_sin_M['fechaICrrln'];
$fechaECrrln 	= 	$sql_sin_M['fechaECrrln'];
$multa 			=	$sql_sin_M['multa'];
$costoCrrln 	= 	$sql_sin_M['costoCrrln'];
$gastosCrrln	= 	$sql_sin_M['gastosCrrln'];
$agenciaTaller	= 	$sql_sin_M['agenciaTaller'];
$obsSin 		=	$sql_sin_M['obsSin'];
$cartaFact 		=	$sql_sin_M['cartaFact'];

$fact			=	$sql_sin_M['fact'];
$tc 			=	$sql_sin_M['tc'];
$tenencia 		=	$sql_sin_M['tenencia'];
$denunciaMP 	= 	$sql_sin_M['denunciaMP'];
$acredDto 		=	$sql_sin_M['acredDto'];
$oficioLib 		= 	$sql_sin_M['oficioLib'];
$otrosDoc		= 	$sql_sin_M['otrosDoc'];
$obsDesarrollo	= 	$sql_sin_M['obsDesarrollo'];
$capturo 		=	$sql_sin_M['capturo'];

datosxid($id_unidad);
clientexid($id_cliente);
contratoxid($id_contrato);

########## ########## ########## ########## ########## 

echo "<h2><span style='color:blue;' >HISTORIAL DEL SINIESTRO</span></h2>";

if($_SESSION["siniestro"] > 1){
	echo "  <a href='sinEditar.php?id_siniestro=$id_siniestro' > 
			<i class='fas fa-edit'></i>
			 Editar Siniestro
			</a> | 
			<a href='sinDoctoAlta.php?id_siniestro=$id_siniestro' alt='SUBIR ARCHIVO' title='SUBIR ARCHIVO'  >
				<i class='fas fa-upload'   style='font-size:16px;'   alt='SUBIR ARCHIVO' title ='SUBIR ARCHIVO' >
				</i>
			 Subir Documento</a>
		<br><br>";

}

?>
<table>
	<tr>
		<td>
			<b>UNIDAD</b>
			<br>Economico: 
			<?php echo $Economico;?>
			<br>Serie: 
			<?php echo $Serie;?>
			<br>Placas: 
			<?php echo $Placas;?>
		</td>
		<td>
			<br>Tipo: 
			<?php echo $Vehiculo;?>
			<br>Color: 
			<?php echo $Color;?>
			<br>Modelo: 
			<?php echo $Modelo;?>
		</td>
	</tr>
	<tr>
		<td>
			<b>PROYECTO-CLIENTE</b>  
			<br>Cliente:
			<?php echo   $razonSocial;?>
			<br>Contrato:
			<?php echo "id ::: ".$id_alan." ::: ".$numero ;?>			
		</td>
		<td>
		</td>
	</tr>
</table>
<?php 

//include ("mttoSolCreaDir.php"); // Se obtiene la ruta y la crea si no existe


if($_SESSION["siniestro"] > 0){ // APERTURA PRIVILEGIOS // TEMPORALMENTE BLOQUEADO 
?>
<table> <!-- PRINCIPAL -->
	<tr><!-- PRIMERA COLUMNA -->
		<td style="max-width: 600px;">

<table style='table-layout: fixed;'  >
<tr>
	<th>IDBD Siniestro</th>
	<td><?php echo $id_siniestro ; ?></td>
</tr>

<!--
<tr><th>Unidad</th>
	<td><?php echo $id_unidad ; ?></td>
</tr>
<tr><th>Cliente</th>
	<td><?php echo $id_cliente ; ?></td>
<tr><th>Contrato</th>
	<td><?php echo $id_contrato ; ?></td>
</tr>
-->
<tr><th>Estado ocurrio</th>
	<td>
	<?php 
		estadoxidEdo($edoSin);
		echo $nombreE; 
	?>
	</td>
</tr>
<tr><th>Ciudad ocurrio</th>
	<td><?php echo $cdSin ; ?></td>
</tr>
<tr><th>Domicilio</th>
	<td><?php echo $domSin ; ?></td>
	</tr>
<tr><th>Motivo</th>
	<td><?php echo $motivo ; ?></td>
	</tr>
<tr><th>Aseguradora</th>
	<td><?php echo $aseguradora ; ?></td>
	</tr>
<tr><th>Fecha del Siniestro</th>
	<td><?php echo $fechaSin ; ?></td>
	</tr>
<tr><th>Numero de Siniestro</th>
	<td style="color:red;font-size: 2em;"><?php echo $numSin; ?></td>
	</tr>
<tr><th>Numero de Poliza</th>
	<td><?php echo $numPoliza; ?></td>
	</tr>
<tr><th>Numero de Inciso</th>
	<td><?php echo $numInciso ; ?></td>
</tr>
<tr><th>Numero de Reporte</th>
	<td><?php echo $numReporte ; ?></td>
</tr>
<tr><th>Fecha de Reporte</th>
	<td><?php echo $fechaRep ; ?></td>
</tr>
<tr><th>Tipo de Siniestro</th>
	<td><?php echo $tipoSin ; ?></td>
</tr>
<tr><th>Telefono Conductor</th>
	<td><?php echo $telCond ; ?></td>
</tr>
<tr><th>Edad Conductor</th>
	<td><?php echo $edadCond ; ?></td>
</tr>
<tr><th>Nombre Conductor</th>
	<td><?php echo $nomConductor ; ?></td>
</tr>

<tr><th>STATUS</th>
	<td  style="color:blue;font-size: 2em;"><?php echo $status; ?></td>
</tr>
<tr><th>Responsabilidad</th>
	<td><?php echo $responsabilidad; ?></td>
</tr>
<tr><th>Ejecutivo Asignado Asg</th>
	<td><?php echo $ejecutivoAsg ; ?></td>
</tr>
<tr><th>Corralon</th>
	<td><?php echo $corralon ; ?></td>
</tr>
<tr><th>Contacto Cliente</th>
	<td><?php echo $contactoCte ; ?></td>
</tr>
<tr><th>Datos Cliente</th>
	<td><?php echo $datosCte ; ?></td>
</tr>
<tr><th>Contacto Aseguradora</th>
	<td><?php echo $contactoAsg; ?></td>
</tr>
<tr><th>Telefono Aseguradora</th>
	<td><?php echo $telAsg; ?></td>
</tr>
<tr><th>Fecha Asignacion Aseguradora</th>
	<td><?php echo $fechaAsigAsg ; ?></td>
</tr>
<tr><th>Gestor Jet Van</th>
	<td><?php echo $gestorJV ; ?></td>
</tr>

<tr><th>Telefono Gestor Jet Van</th>
	<td><?php echo $telGJV; ?></td>
</tr>
<tr><th>Fecha Acreditacion Propiedad</th>
	<td><?php echo $fechaAcredProp; ?></td>
</tr>
<tr><th>Fecha INGRESO Corralon</th>
	<td><?php echo $fechaICrrln ; ?></td>
</tr>
<tr><th>Fecha EGRESO Corralon</th>
	<td><?php echo $fechaECrrln ; ?></td>
</tr>
<tr><th>Multa</th>
	<td><?php echo $multa ; ?></td>
</tr>
<tr><th>Costo Corralon</th>
	<td><?php echo $costoCrrln ; ?></td>
</tr>
<tr><th>Gastos Corralon</th>
	<td><?php echo $gastosCrrln; ?></td>
</tr>
<tr><th>Agencia o Taller</th>
	<td><?php echo $agenciaTaller; ?></td>
</tr>
<tr><th>Observaciones SINIESTRO (Hecho)</th>
	<td><?php echo $obsSin ; ?></td>
</tr>
<tr><th>Carta Factura</th>
	<td><?php echo $cartaFact ; ?></td>
</tr>

<tr><th>Factura</th>
	<td><?php echo $fact; ?></td>
</tr>
<tr><th>Tarjeta de Circulación</th>
	<td><?php echo $tc ; ?></td>
</tr>
<tr><th>Tenencia</th>
	<td><?php echo $tenencia ; ?></td>
</tr>
<tr><th>Denuncia MP</th>
	<td><?php echo $denunciaMP ; ?></td>
</tr>
<tr><th>Acreditación</th>
	<td><?php echo $acredDto ; ?></td>
</tr>
<tr><th>Oficio Liberación</th>
	<td><?php echo $oficioLib ; ?></td>
</tr>
<tr><th>Otros Documentos</th>
	<td><?php echo $otrosDoc; ?></td>
</tr>
<tr><th>Observaciones DESARROLLO</th>
	<td><?php echo $obsDesarrollo; ?></td>
</tr>
<tr><th>SEGUIMIENTO</th>
	<td><?php echo $capturo ; ?></td>
</tr>
</table>


</td><!-- SEGUNDA COLUMNA --><td style="vertical-align: top;">
<?php
include'sinDoctoRes.php';
?>
</td>
	</tr>
</table>
<?php





} // CIERRE PRIVILEGIOS 

// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'>
            <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
       ";
// BOTON PARA VER LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA 

// BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
    echo "
        <a href='sinRes.php?pagina=$pagina' style='text-decoration:none;'>
        <INPUT id='gobutton2' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a resumen SINIESTROS'>
        </a>
         ";
 // BOTON REGRESAR AL RESUMEN // IR AL INDEX DE UNIDAD CONSULTADA
echo '</p>';
include ("1footer.php"); ?>