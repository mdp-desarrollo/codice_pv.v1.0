<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-11-25 22:18:25 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,d.id_nur,d.nur,t.tipo
            FROM documentos d            
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id_user='2'
            ORDER BY d.fecha_creacion DESC
            LIMIT 10 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-25 22:19:42 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-25 22:28:29 --- ERROR: ErrorException [ 8 ]: A non well formed numeric value encountered ~ APPPATH\views\documentos\listar.php [ 61 ]
2011-11-25 22:29:05 --- ERROR: ErrorException [ 8 ]: A non well formed numeric value encountered ~ APPPATH\views\documentos\listar.php [ 61 ]
2011-11-25 22:29:29 --- ERROR: ErrorException [ 8 ]: A non well formed numeric value encountered ~ APPPATH\views\documentos\listar.php [ 66 ]
2011-11-25 22:34:30 --- ERROR: Kohana_Exception [ 0 ]: The accion property does not exist in the Model_Tipos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-25 22:34:53 --- ERROR: Kohana_Exception [ 0 ]: The accion property does not exist in the Model_Tipos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-25 22:38:45 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-25 22:39:08 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-25 22:40:38 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id as id_documento, d.codigo, d.citeOriginal, d.nombreDestinatario, d.cargoDestinatario, d.referencia, d.id_nur, d.nur, d.fecha_creacion,d.estado,p.proceso,t.tipo FROM documentos d 
        INNER JOIN procesos p ON d.id_proceso=p.id
        INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.id_user='2'
        AND d.original='1'
        ORDER BY d.fecha_creacion DESC
        LIMIT 0 , 50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-25 22:41:08 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-25 22:42:37 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT s.id, s.padre,s.nur as id_nur, s.nombre_emisor,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha, c.accion, s.oficial, s.hijo, s.proveido,s.adjuntos,s.archivos, d.nur
             , d.codigo, d.nombreDestinatario, d.cargoDestinatario, p.proceso
              FROM seguimiento s
              INNER JOIN documentos d ON s.nur=d.id_nur
              INNER JOIN acciones c ON s.accion=c.id      
              INNER JOIN procesos p ON p.id=d.id_proceso												
              WHERE s.estado='1'
              AND s.derivado_a='2'
              AND d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-25 22:42:56 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,d.id_nur,d.nur,t.tipo
            FROM documentos d            
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id_user='2'
            ORDER BY d.fecha_creacion DESC
            LIMIT 10 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-25 22:45:40 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]