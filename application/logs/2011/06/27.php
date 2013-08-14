<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-06-27 00:03:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL 0/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:03:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL 1/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:03:27 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL 0/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:03:27 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL 1/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:03:55 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL 0/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:03:55 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL 1/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:08:36 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL seguimiento/nuri/1 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-27 00:08:49 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 00:13:01 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'documentos.tipos' in 'on clause' [ SELECT `documentos`.* FROM `documentos` INNER JOIN `tipos` ON (`documentos`.`tipos` = `tipos`.`id`) WHERE `documentos`.`id` = '55' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 00:14:56 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hs/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 00:17:10 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'documentos.tipos' in 'on clause' [ SELECT `documentos`.* FROM `documentos` INNER JOIN `tipos` ON (`documentos`.`tipos` = `tipos`.`id`) WHERE `documentos`.`id` = '56' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 00:23:10 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'documentos.tipos' in 'on clause' [ SELECT `documentos`.* FROM `documentos` INNER JOIN `tipos` ON (`documentos`.`tipos` = `tipos`.`id`) WHERE `documentos`.`id` = '57' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 08:48:56 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL documentos/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-27 09:20:05 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 09:23:54 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='115' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 09:23:58 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='115' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 09:24:09 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='115' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 09:25:36 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hs/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 09:43:33 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='117' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 09:43:39 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='115' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 09:46:06 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Auth_ORM as array ~ APPPATH\views\user\derivar.php [ 82 ]
2011-06-27 09:54:55 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_User as array ~ APPPATH\views\user\derivar.php [ 85 ]
2011-06-27 11:02:22 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'documentos.tipos' in 'on clause' [ SELECT `documentos`.* FROM `documentos` INNER JOIN `tipos` ON (`documentos`.`tipos` = `tipos`.`id`) WHERE `documentos`.`id` = '58' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 11:03:27 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL bandeja/entrada was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 11:05:04 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='117' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-27 11:28:10 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL documento/editar was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-27 11:28:24 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:30:37 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:30:44 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:30:45 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:34:52 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:34:56 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:35:38 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:35:39 --- ERROR: ErrorException [ 1 ]: Class 'PHPWord' not found ~ APPPATH\classes\controller\documento.php [ 131 ]
2011-06-27 11:52:30 --- ERROR: ErrorException [ 2 ]: ZipArchive::open() [ziparchive.open]: Empty string as source ~ APPPATH\libraries\phpword\PHPWord\Writer\Word2007.php [ 73 ]
2011-06-27 11:52:32 --- ERROR: ErrorException [ 2 ]: ZipArchive::open() [ziparchive.open]: Empty string as source ~ APPPATH\libraries\phpword\PHPWord\Writer\Word2007.php [ 73 ]
2011-06-27 11:59:07 --- ERROR: ErrorException [ 2 ]: filesize() [function.filesize]: stat failed for aadocx ~ APPPATH\classes\controller\json.php [ 54 ]
2011-06-27 12:16:24 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL word/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-27 15:37:53 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='117' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]