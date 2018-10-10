<?php

// AUTOS POR TIPO Y MODELO
$sql = 'SELECT `Vehiculo`, `Modelo`, COUNT(`Serie`) FROM `ubicacion` GROUP BY `Vehiculo` ORDER BY `Modelo` DESC LIMIT 450, 30 ';

// AUTOS POR TIPO Y MODELO ORDENADO POR AÑO Y LUEGO POR CANTIDAD
SELECT `Vehiculo` , `Modelo` , COUNT( `Serie` ) s
FROM `ubicacion`
GROUP BY `Vehiculo`
ORDER BY `Modelo` DESC , s DESC
LIMIT 60 , 30 


 

// AUTOS POR MODELO
$sql = 'SELECT COUNT(`Serie`), Modelo FROM `ubicacion` GROUP BY `Modelo` ORDER BY Modelo DESC LIMIT 0, 30 '; 



// ARCHIVOS SUBIDOS POR EMPLEADO
$sql = 'SELECT `capturo`, nombre,COUNT(`archivo`) '
        . ' FROM `expedientes` e'
        . ' JOIN '
        . ' usuarios u'
        . ' ON '
        . ' u.id_usuario = e.capturo '
        . ' GROUP BY '
        . ' capturo LIMIT 0, 30 '; 

// 

SELECT `capturo`, nombre,COUNT(`archivo`) 
          FROM `expedientes` e
          JOIN 
          usuarios u
          ON 
          uid_usuario = ecapturo 
          GROUP BY 
          capturo LIMIT 0, 30 ; 

		  
// ARCHIVOS SUBIDOS CON ULTIMA FECHA QUE LO HIZO
		  $sql = 'SELECT `capturo`, nombre, COUNT(`archivo`), MAX(fechareg) '
        . ' FROM `expedientes` e '
        . ' JOIN '
        . ' usuarios u '
        . ' ON '
        . ' u.id_usuario = e.capturo '
        . ' GROUP BY '
        . ' capturo LIMIT 0, 30 '; 
		
SELECT `capturo`, nombre, COUNT(`archivo`), MAX(fechareg) 
          FROM `expedientes` e 
          JOIN 
          usuarios u 
          ON 
          u.id_usuario = e.capturo 
          GROUP BY 
          capturo LIMIT 0, 30 ;

// CAPTURAS POR PERSONA ORDENADO DEL MAS RECIENTE AL MAS ANTIGUO
SELECT `capturo` , nombre, COUNT( `archivo` ) , MAX( fechareg )
FROM `expedientes` e
JOIN usuarios u ON u.id_usuario = e.capturo
GROUP BY capturo
ORDER BY fechareg ASC
LIMIT 0 , 30 