<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-06-24 12:23:56 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'useres.id_oficina' in 'on clause' [ SELECT `users`.* FROM `users` INNER JOIN `oficinas` ON (`oficinas`.`id` = `useres`.`id_oficina`) WHERE `users`.`id` = '1' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-24 12:24:22 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='69' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-24 12:25:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='70' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-24 12:26:33 --- ERROR: Kohana_Exception [ 0 ]: The oficina property does not exist in the Model_Users class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-24 12:27:00 --- ERROR: Kohana_Exception [ 0 ]: The oficina property does not exist in the Model_Users class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-24 12:27:12 --- ERROR: Kohana_Exception [ 0 ]: The oficina property does not exist in the Model_Users class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-24 12:27:39 --- ERROR: Kohana_Exception [ 0 ]: The íd_oficina property does not exist in the Model_Users class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-24 13:05:37 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL pdf/pdf was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-24 13:05:42 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='72' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-24 14:12:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='72' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]