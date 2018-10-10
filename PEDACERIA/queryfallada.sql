INSERT INTO `jetvantlc`.`formato_inventario` 
( numero_inventario, fecharecepcion, marca, modelo, economico, color, 
tipo, placas, serie,
 kilometraje, combustible, hora_entrada, razonentrada, 
razonentradatexto, proyecto_origen, proyecto_destino, ubicacion_origen, 
ubicacion_destino, conductor_entrada, observaciones, realizo_inventario, 
marca_de_llantas, 
traseros_derecha, traseros_izquierda, antena, g6, g18, 
g6c, id_formato) 
VALUES ( 15372, '2015-10-28', 'RAM', '2014', '2142637', 'BLANCO BRILLANTE', 
'RAM 2500 PROMASTER 11.5 M3 ( AMBULANCIA )', 'LA74579', '3C6TRVCG1EE120971',
/* KILOMETRAJE NO DEBE IR EN CERO */
 , 0, '12:11:37', 'reingreso', 
 '', 'WTC', 'JETVAN TEMPORAL', 'MEXICO', 
 'CALZADA MEXICO - TACUBA', 'JORGE JUTINO URIBE', '', 'Oscar De Sales Yordi',
 '', 
 1, 1, 0, 1, 1, 
 'RASPONES', NULL);
 
 
 
 para modificar valor predeterminado en columna ruta
  ALTER TABLE `expedientes` CHANGE `ruta` `ruta` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2016/febrero' 
  
  
  
 SELECT m.`economico` , m.`cliente` , m.`ubicacion` , m.`fechaRegistro` , u.Vehiculo, u.color
FROM `movimientos` m
JOIN ubicacion u ON u.Economico = m.economico
WHERE u.Vehiculo LIKE '%journey%'
AND fechaRegistro > '2014-01-01'
AND fechaRegistro < '2014-09-01'
LIMIT 360 , 30   