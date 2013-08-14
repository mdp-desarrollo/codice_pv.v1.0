<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-01-04 07:55:28 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'id_nur' in 'where clause' ( SELECT `documentos`.* FROM `documentos` WHERE `id_nur` = '0' AND `original` = 1 LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 08:08:03 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:08:44 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:08:45 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:08:45 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:09:15 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:09:17 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:09:41 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'id_nur' in 'where clause' ( SELECT `documentos`.* FROM `documentos` WHERE `id_nur` = 'I/2011-00001' AND `original` = 1 LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 08:10:03 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:10:31 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 08:10:42 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2012-01-04 10:09:18 --- ERROR: ErrorException [ 2048 ]: Creating default object from empty value ~ APPPATH\classes\controller\bandeja.php [ 175 ]
2012-01-04 10:12:09 --- ERROR: ErrorException [ 8 ]: Undefined index: observaciones ~ APPPATH\views\bandeja\carpeta.php [ 20 ]
2012-01-04 10:14:38 --- ERROR: ErrorException [ 8 ]: Undefined index: observaciones ~ APPPATH\views\bandeja\carpeta.php [ 20 ]
2012-01-04 10:15:46 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'a.obvervaciones' in 'field list' ( SELECT s.id as id_seg,a.id_user, a.obvervaciones, s.id_archivo, c.carpeta, s.accion,s.oficial,s.de_oficina, s.proveido, a.fecha as fecha_archivo, d.id as id_doc, d.nur, d.codigo,d.referencia
            FROM seguimiento s
            INNER JOIN archivados a ON a.id=s.id_archivo
            INNER JOIN carpetas c ON a.id_carpeta=c.id
            INNER JOIN documentos d ON d.nur=s.nur
            WHERE s.estado='10'
            AND c.id='1'
            AND d.original='1'
            AND s.derivado_a='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 10:17:35 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'n.id' in 'on clause' ( SELECT s.id, n.nur,d.codigo,d.referencia,s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision,s.proveido FROM seguimiento s
            INNER JOIN nurs n ON s.nur=n.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN documentos d ON d.id_nur=s.nur
            WHERE s.id='153'
            and d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 20:51:29 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.roles' doesn't exist ( SHOW FULL COLUMNS FROM `roles` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 20:51:35 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.roles' doesn't exist ( SHOW FULL COLUMNS FROM `roles` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 20:51:37 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.roles' doesn't exist ( SHOW FULL COLUMNS FROM `roles` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 20:51:38 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.roles' doesn't exist ( SHOW FULL COLUMNS FROM `roles` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 20:51:40 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.roles' doesn't exist ( SHOW FULL COLUMNS FROM `roles` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-04 20:51:44 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.roles' doesn't exist ( SHOW FULL COLUMNS FROM `roles` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]