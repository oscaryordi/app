<?php
$TipoBusqueda = "Histórico Km";
include '1header.php';

$id_unidad = $_GET['id_unidad'];
datosxid($id_unidad);

echo "<h3>ID en bd  : ".$id_unidad."</h3>";
echo "<h3>Economico : ".$Economico."</h3>";
echo "<h3>Serie     : ".$Serie."</h3><br />";

include ("u4datos.php");
include ("u5placas.php");


// INICIA FORMULARIO REPORTAR KILOMETRAJE
##### ##### #####
$subido ='';
$error1 = '';
$error2 = '';
if(isset($_POST['kmActualizar']))
    {
        if($_POST['id_unidad']!='' 
        && $_POST['km']!='' && $_POST['km'] > 0 
          )
            {       
                $id_unidad  =mysql_real_escape_string($_POST['id_unidad'],$conectar);
                $km         =mysql_real_escape_string($_POST['km'],$conectar);
                $capturo    = $_SESSION["id_usuario"];

                $sql_kmH    = "INSERT INTO kmH (id_km, id_unidad, km, capturo) VALUES 
                                (null, '$id_unidad', '$km', '$capturo')";

                // INICIO EVITAR REFRESH
                kmxid($id_unidad);
                // TERMINA EVITAR REFRESH
                if($kmUltimo != $km and $kmUltimo < $km )
                {
                    $sql_kmH_R  = mysql_query($sql_kmH, $conectar);
                
                    if($sql_kmH_R)
                    { 
                        echo '<h2>KILOMETRAJE ACTUALIZADO CORRECTAMENTE</h2>';
                        include('kmhlistado.php'); // LISTADO HISTORICO PARA CONFIRMAR INSERCION
                        // INICIA  ALGORITMO DE ALERTA !!!
                        // datos viejos
                        echo $kmUltimo;
                        echo "<br>";
                        echo $fecharegU;
                        echo "<br>";
                        $fecharegUUnix = strtotime("$fecharegU");
                        echo $fecharegUUnix;
                        echo "<br>";

                        // datos nuevos
                        echo $km;
                        echo "<br>";
                        $fecharegHoy = date('Y-m-d h:i:s');
                        echo $fecharegHoy;
                        echo "<br>";
                        $fecharegHoyUnix = strtotime("$fecharegHoy");
                        echo $fecharegHoyUnix;
                        echo "<br>";

                        // obtener intervalo siguiente para mtto
                        $intervalo = 10000;
                        $kmObjetivo = (ceil($km/$intervalo))*$intervalo;
                        echo "PROXIMO OBJETIVO KM: $kmObjetivo";
                        echo "<br>";
                        // obtener tasa km/seg
                        $kmDif      = $km - $kmUltimo;
                        echo "DIFERENCIA KM: $kmDif";
                        echo "<br>";
                        $fechaDif   = $fecharegHoyUnix - $fecharegUUnix;
                        echo "DIFERENCIA FECHA: $fechaDif";
                        echo "<br>";

                        $tasaKmSeg = $kmDif/$fechaDif;
                        echo "TASA DE INCREMENTO KM/SEG : $tasaKmSeg";
                        echo "<br>";

                        $kmObjetivoFalta = $kmObjetivo - $km;
                        echo "FALTAN $kmObjetivoFalta PARA LLEGAR AL SIGUIENTE MTTO";
                        echo "<br>";

                        $tiempoFaltaSeg = $kmObjetivoFalta/$tasaKmSeg;
                        echo "DEBEN TRASNCURRIR $tiempoFaltaSeg SEGUNDOS PARA SIGUIENTE SERVICIO";
                        echo "<br>";

                        $fechaSigServ = $fecharegHoyUnix + $tiempoFaltaSeg;

                        echo "La proxima fecha para servicio es: ".gmdate("Y-m-d\TH:i:s\Z", $fechaSigServ);


                      
                         
                        // TERMINA ALGORITMO DE ALERTA !!!
                    }
                    else
                    { // INICIA MOSTRAR FALLO TECNICO MYSQL
                        echo mysql_errno($conectar) . ": " . mysql_error($conectar). " FALLO AL REGISTRAR KILOMETRAJE \n";;
                    } // TERMINA MOSTRAR FALLO TECNICO MYSQL
                    $subido = 'ok'  ;
                }
                else
                {
                    if($kmUltimo > $km){ $error2 = 'KILOMETRAJE INGRESADO NO PUEDE SER MENOR AL ÚLTIMO REPORTADO';}
                    if($kmUltimo == $km){ $error1 = "ESE KILOMETRAJE YA ESTA REGISTRADO";}
                    echo "<BR><BR><span style='color:red;'>".$error1.$error2."</span><BR><BR>";
                }
            }
        else
            {
                echo "<p style='background-color:#FFFF99;'>Favor de llenar datos completos &#9786; $proceder</p>";
            }
    }

 if($subido!='ok') {// INICIA MOSTRAR FORMULARIO
?>
<fieldset><legend><b>FORMULARIO</b></legend>
<form action="" method="POST"  enctype="multipart/form-data" >
    <h2>ACTUALIZAR KILOMETRAJE</h2>
<table>
        <input type="hidden" name="id_unidad"  value="<?php echo $id_unidad;?>" 
        placeholder="Unidad" >
    <tr>
        <th>KILOMETRAJE ACTUAL <?ECHO DATE('Y-m-d');?>
        </th>
        <td>
        <input type="number" lang="nb" step="1" min="0" max='800000' name="km"  value="" 
            placeholder="0000" required style="text-align: right;" > 0000
        </td>
    </tr>
    <tr>
        <td colspan=2 style="text-align:center;" >
        <input id="gobutton2" type="submit" name="kmActualizar" value="Reportar Kilometraje"> 
        </td>
    </tr>
    </table>
</form>
</fieldset>
<?php

// INICIA MOSTRAR HISTORIAL DE KILOMETRAJES
include('kmhlistado.php');
// TERMINA MOSTRAR HISTORIAL DE KILOMETRAJES

}// TERMINA MOSTRAR FORMULARIO
##### ##### #####
// TERMINA FORMULARIO REPORTAR KILOMETRAJE


// BOTON PARA VOLVER A LA UNIDAD // IR AL INDEX DE UNIDAD CONSULTADA
    echo "<br><td>
        <FORM action='u3index.php' method='POST' id='entabla'>
            <INPUT TYPE='hidden' NAME='serie' VALUE='$Serie'><INPUT id='gobutton' TYPE='SUBMIT' NAME='ENVIAR' VALUE='Volver a unidad'>
        </FORM>
        </td>";
//<!--KILOMETRAJE HISTORICO-->

include '1footer.php'; ?>