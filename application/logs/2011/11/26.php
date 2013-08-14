<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-11-26 05:15:52 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 05:15:55 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,d.id_nur,d.nur,t.tipo
            FROM documentos d            
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id_user='2'
            ORDER BY d.fecha_creacion DESC
            LIMIT 10 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 05:18:28 --- ERROR: ErrorException [ 8 ]: Undefined index: nombreDestinatario ~ APPPATH\views\documentos\index.php [ 41 ]
2011-11-26 05:19:15 --- ERROR: ErrorException [ 8 ]: A non well formed numeric value encountered ~ APPPATH\views\documentos\index.php [ 45 ]
2011-11-26 05:20:48 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nur ~ APPPATH\views\documentos\index.php [ 59 ]
2011-11-26 05:23:40 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 05:27:06 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 05:27:52 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:12:56 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:16:00 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:16:10 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id as id_documento, d.codigo, d.citeOriginal, d.nombreDestinatario, d.cargoDestinatario, d.referencia, d.id_nur, d.nur, d.fecha_creacion,d.estado,p.proceso,t.tipo FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id
        INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.id_user='2'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT 0 , 50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:23:25 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:23:28 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id as id_documento, d.codigo, d.citeOriginal, d.nombreDestinatario, d.cargoDestinatario, d.referencia, d.id_nur, d.nur, d.fecha_creacion,d.estado,p.proceso,t.tipo FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id
        INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.id_user='2'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT 0 , 50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:25:43 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:25:46 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id as id_documento, d.codigo, d.citeOriginal, d.nombreDestinatario, d.cargoDestinatario, d.referencia, d.id_nur, d.nur, d.fecha_creacion,d.estado,p.proceso,t.tipo FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id
        INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.id_user='2'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT 0 , 50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 06:27:36 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 07:13:32 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 07:13:43 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 07:13:55 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 07:15:27 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 07:21:05 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 07:31:08 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 07:43:49 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:25:40 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:27:04 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 08:28:35 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id as id_documento, d.codigo, d.citeOriginal, d.nombreDestinatario, d.cargoDestinatario, d.referencia, d.id_nur, d.nur, d.fecha_creacion,d.estado,p.proceso,t.tipo FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id
        INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.id_user='2'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT 0 , 50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 08:30:41 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT d.id as id_documento, d.codigo, d.nombreDestinatario, d.cargoDestinatario, d.referencia, d.nur, d.fecha_creacion,d.estado,p.proceso,t.tipo FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id
        INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.id_user='2'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT 0 , 50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 08:31:01 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nur ~ APPPATH\views\hojaruta\index.php [ 45 ]
2011-11-26 08:32:17 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nur ~ APPPATH\views\hojaruta\index.php [ 59 ]
2011-11-26 08:48:39 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\hojaruta.php [ 53 ]
2011-11-26 08:49:03 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\hojaruta.php [ 53 ]
2011-11-26 08:49:15 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:49:56 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:50:38 --- ERROR: Kohana_Exception [ 0 ]: The nombre_estinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:51:28 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:52:19 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:53:17 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:58:11 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:59:11 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 08:59:13 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 14:43:45 --- ERROR: ErrorException [ 8 ]: Undefined variable: listaDerivacion ~ APPPATH\views\hojaruta\deriv.php [ 193 ]
2011-11-26 14:50:27 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'nurs.id' in 'where clause' ( SELECT `nurs`.* FROM `nurs` WHERE `nurs`.`id` = 'I/2011-00017' LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:07:49 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:07:57 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'nurs.id' in 'where clause' ( SELECT `nurs`.* FROM `nurs` WHERE `nurs`.`id` = 'I/2011-00017' LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:09:59 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:10:14 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:13:00 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:14:24 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:15:49 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:17:12 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:17:24 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:18:04 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:26:02 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:26:48 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:28:08 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 16:30:49 --- ERROR: Kohana_Exception [ 0 ]: The id_documento property does not exist in the Model_nurs class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-26 16:31:56 --- ERROR: ErrorException [ 1 ]: Class 'Model_Nurs_documentos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 109 ]
2011-11-26 16:33:59 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:00:37 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:40:57 --- ERROR: ErrorException [ 8 ]: Undefined variable: type ~ APPPATH\views\hojaruta\deriv.php [ 175 ]
2011-11-26 17:42:16 --- ERROR: ErrorException [ 1 ]: Class 'Model_Seguimientos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 109 ]
2011-11-26 17:42:53 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '), 'Area de Sistemas', 'Despacho Ministerial')' at line 1 ( INSERT INTO `seguimiento` (`id_seguimiento`, `nur`, `derivado_por`, `nombre_emisor`, `cargo_emisor`, `fecha_emision`, `derivado_a`, `nombre_receptor`, `cargo_receptor`, `estado`, `accion`, `oficial`, `proveido`, `adjuntos`, `de_oficina`, `a_oficina`) VALUES (0, 'I/2011-00023', '2', 'Marco Antonio Garcia M.', 'Encargado de Sistemas', '2011-11-26 17:42:53', '8', 'Ana Teresa Morales Olivares', 'Ministra', 1, '1', '1', '123', (), 'Area de Sistemas', 'Despacho Ministerial') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:43:21 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '), 'Area de Sistemas', 'Despacho Ministerial')' at line 1 ( INSERT INTO `seguimiento` (`id_seguimiento`, `nur`, `derivado_por`, `nombre_emisor`, `cargo_emisor`, `fecha_emision`, `derivado_a`, `nombre_receptor`, `cargo_receptor`, `estado`, `accion`, `oficial`, `proveido`, `adjuntos`, `de_oficina`, `a_oficina`) VALUES (0, 'I/2011-00023', '2', 'Marco Antonio Garcia M.', 'Encargado de Sistemas', '2011-11-26 17:43:21', '8', 'Ana Teresa Morales Olivares', 'Ministra', 1, '1', '1', '123', (), 'Area de Sistemas', 'Despacho Ministerial') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:44:02 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '), 'Area de Sistemas', 'Despacho Ministerial')' at line 1 ( INSERT INTO `seguimiento` (`id_seguimiento`, `nur`, `derivado_por`, `nombre_emisor`, `cargo_emisor`, `fecha_emision`, `derivado_a`, `nombre_receptor`, `cargo_receptor`, `estado`, `accion`, `oficial`, `proveido`, `adjuntos`, `de_oficina`, `a_oficina`) VALUES (0, 'I/2011-00023', '2', 'Marco Antonio Garcia M.', 'Encargado de Sistemas', '2011-11-26 17:44:02', '8', 'Ana Teresa Morales Olivares', 'Ministra', 1, '1', '1', '123', (), 'Area de Sistemas', 'Despacho Ministerial') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:44:04 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '), 'Area de Sistemas', 'Despacho Ministerial')' at line 1 ( INSERT INTO `seguimiento` (`id_seguimiento`, `nur`, `derivado_por`, `nombre_emisor`, `cargo_emisor`, `fecha_emision`, `derivado_a`, `nombre_receptor`, `cargo_receptor`, `estado`, `accion`, `oficial`, `proveido`, `adjuntos`, `de_oficina`, `a_oficina`) VALUES (0, 'I/2011-00023', '2', 'Marco Antonio Garcia M.', 'Encargado de Sistemas', '2011-11-26 17:44:03', '8', 'Ana Teresa Morales Olivares', 'Ministra', 1, '1', '1', '123', (), 'Area de Sistemas', 'Despacho Ministerial') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:45:47 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '), 'Area de Sistemas', 'Unidad Administrativa')' at line 1 ( INSERT INTO `seguimiento` (`id_seguimiento`, `nur`, `derivado_por`, `nombre_emisor`, `cargo_emisor`, `fecha_emision`, `derivado_a`, `nombre_receptor`, `cargo_receptor`, `estado`, `accion`, `oficial`, `proveido`, `adjuntos`, `de_oficina`, `a_oficina`) VALUES (0, 'I/2011-00024', '2', 'Marco Antonio Garcia M.', 'Encargado de Sistemas', '2011-11-26 17:45:47', '3', 'Lic. Herlan David Rios Zambrana', 'Jefe de Unidad Administrativa', 1, '1', '1', '123', (), 'Area de Sistemas', 'Unidad Administrativa') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:47:44 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '' for key 'codigo' ( INSERT INTO `documentos` (`estado`) VALUES (1) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 17:53:27 --- ERROR: ErrorException [ 1 ]: Class 'Model_Documento' not found ~ MODPATH\orm\classes\kohana\orm.php [ 109 ]
2011-11-26 17:55:28 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 18:17:12 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$id_nur ~ APPPATH\views\bandeja\pendientes.php [ 232 ]
2011-11-26 18:23:51 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'n.id' in 'on clause' ( SELECT s.id, n.nur FROM seguimiento s
             INNER JOIN nurs n ON s.nur=n.id
             WHERE s.id='108' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 18:26:03 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado=1
              AND s.derivado_por='3'
              AND d.original=1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 18:26:15 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_nur' in 'field list' ( SELECT s.id as id_seg,a.id_user, s.id_archivo, c.carpeta, s.accion,s.oficial,s.de_oficina, s.proveido, a.fecha as fecha_archivo, d.id as id_doc, d.id_nur, d.codigo,d.referencia,d.nur FROM seguimiento s
            INNER JOIN archivados a ON a.id=s.id_archivo
            INNER JOIN carpetas c ON a.id_carpeta=c.id
            INNER JOIN documentos d ON d.id_nur=s.nur
            WHERE s.estado='10'
            AND c.id='7'
            AND d.original='1'
            AND s.derivado_a='3' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 18:33:32 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado=1
              AND s.derivado_por='2'
              AND d.original=1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-26 18:35:15 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_nur' in 'on clause' ( SELECT s.id, s.padre,s.nur, s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos
             , d.codigo, d.nombre_destinatario, d.cargo_destinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado=1
              AND s.derivado_por='2'
              AND d.original=1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]