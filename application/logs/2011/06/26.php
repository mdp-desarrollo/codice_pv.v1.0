<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-06-26 10:14:19 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SELECT d.id, d.codigo, d.citeOriginal, d.tituloDestinatario,d.nuri,d.id_nuri, d.nombreDestinatario, d.cargoDestinatario,d.referencia,d.fecha,t.documento,t.action 
            FROM documentos d INNER JOIN tipodocumentos t ON d.tipoDocumento=t.id
            WHERE d.idUsuario='2'
            ORDER BY d.fecha DESC
            LIMIT 5 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:17:53 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.documento' doesn't exist [ SHOW FULL COLUMNS FROM `documento` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:18:30 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SELECT d.id, d.codigo, d.citeOriginal, d.tituloDestinatario,d.nuri,d.id_nuri, d.nombreDestinatario, d.cargoDestinatario,d.referencia,d.fecha,t.documento,t.action
            FROM documentos d INNER JOIN tipodocumentos t ON d.tipoDocumento=t.id
            WHERE d.idUsuario='2'
            ORDER BY d.fecha DESC
            LIMIT 5 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:18:53 --- ERROR: Database_Exception [ 1054 ]: Unknown column 't.documento' in 'field list' [ SELECT d.id, d.codigo, d.citeOriginal, d.tituloDestinatario,d.nuri,d.id_nuri, d.nombreDestinatario, d.cargoDestinatario,d.referencia,d.fecha,t.documento,t.action
            FROM documentos d INNER JOIN tipos t ON d.tipoDocumento=t.id
            WHERE d.idUsuario='2'
            ORDER BY d.fecha DESC
            LIMIT 5 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:19:14 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SHOW FULL COLUMNS FROM `tipodocumentos` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:19:35 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'tipo' in 'field list' [ SELECT tipo, COUNT(*) as n FROM documentos WHERE idUsuario='2' GROUP BY tipoDocumento ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:20:53 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SHOW FULL COLUMNS FROM `tipodocumentos` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:21:03 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SHOW FULL COLUMNS FROM `tipodocumentos` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 10:23:31 --- ERROR: Kohana_Exception [ 0 ]: The fecha property does not exist in the Model_Asignados class ~ MODPATH\orm\classes\kohana\orm.php [ 746 ]
2011-06-26 10:54:15 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'doc' in 'where clause' [ SELECT `tipos`.* FROM `tipos` WHERE `doc` = '0' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 11:05:34 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SHOW FULL COLUMNS FROM `tipodocumentos` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 11:05:48 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SHOW FULL COLUMNS FROM `tipodocumentos` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 11:06:35 --- ERROR: Database_Exception [ 1146 ]: Table 'paperwork.tipodocumentos' doesn't exist [ SHOW FULL COLUMNS FROM `tipodocumentos` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 11:08:35 --- ERROR: Database_Exception [ 1062 ]: Duplicate entry 'NI/MDP/DGA/UA/SIS/2011-0001' for key 'codigo' [ INSERT INTO `documentos` (`idUsuario`, `tipoDocumento`, `codigo`, `citeOriginal`, `tituloDestinatario`, `nombreDestinatario`, `cargoDestinatario`, `institucionDestinatario`, `nombreRemitente`, `cargoRemitente`, `institucionRemitente`, `moscaRemitente`, `referencia`, `contenido`, `fecha`, `adjuntos`, `copias`, `nombreVia`, `cargoVia`, `nroHojas`) VALUES ('2', '4', 'NI/MDP/DGA/UA/SIS/2011-0001', 'NI/MDP/DGA/UA/SIS/2011-0001', '', 'Ana Teresa Morales Olivares', 'Ministra', '', 'Marco Antonio Garcia', 'Encargado de Sistemas', '', 'MGM', 'Solicitud ', '', 1309100915, '', '', 'Lic. Herlan David Rios Zambrana', 'Jefe de Unidad Administrativa', 0) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 16:53:19 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
                        c.accion, e.estado,s.adjuntos,s.archivos
            FROM seguimiento s
            INNER JOIN asignados a ON s.nur=a.id
            INNER JOIN acciones c ON s.accion=c.id
            INNER JOIN estados e ON s.estado=e.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN users w ON s.derivado_por=w.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN oficinas oo ON w.id_oficina=oo.id
            WHERE s.nur='68' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 17:01:51 --- ERROR: Kohana_Exception [ 0 ]: The fecha property does not exist in the Model_Asignados class ~ MODPATH\orm\classes\kohana\orm.php [ 746 ]
2011-06-26 17:13:45 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 17:15:08 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 17:15:24 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 17:15:31 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 17:16:36 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 17:16:42 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 17:16:54 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asignar/hs/46 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-26 17:17:19 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 20:10:08 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL pdf/pdf was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-26 20:33:43 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asignar/hs/54 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-26 21:22:58 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL pdf/pdf was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-26 21:54:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL pdf/pdf was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-26 21:56:35 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL bandeja/entrada was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-26 21:57:45 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
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
2011-06-26 22:05:43 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT id_tipo, COUNT(*) as n FROM documentos WHERE idUsuario='2' GROUP BY tipoDocumento ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:06:30 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT COUNT(*) AS `records_found` FROM `documentos` WHERE `idUsuario` = '2' AND `tipoDocumento` = '' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:07:43 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT COUNT(*) AS `records_found` FROM `documentos` WHERE `idUsuario` = '2' AND `tipoDocumento` = '' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:07:59 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_data::documentos() ~ APPPATH\classes\controller\documento.php [ 201 ]
2011-06-26 22:09:46 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT COUNT(*) AS `records_found` FROM `documentos` WHERE `idUsuario` = '2' AND `tipoDocumento` = '' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:14:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT COUNT(*) AS `records_found` FROM `documentos` WHERE `idUsuario` = '2' AND `tipoDocumento` = '3' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:14:38 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_data::documentos() ~ APPPATH\classes\controller\documento.php [ 201 ]
2011-06-26 22:15:20 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_data::documentos() ~ APPPATH\classes\controller\documento.php [ 201 ]
2011-06-26 22:15:26 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_data::documentos() ~ APPPATH\classes\controller\documento.php [ 201 ]
2011-06-26 22:18:42 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'c.titulo' in 'field list' [ SELECT c.id, c.titulo, c.nombre_documento, t.tipo
              FROM documentos c LEFT JOIN  tipos t ON c.id_tipo=t.id ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:19:57 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'c.titulo' in 'field list' [ SELECT c.id, c.titulo, c.nombre_documento, t.tipo
              FROM documentos c LEFT JOIN  tipos t ON c.id_tipo=t.id ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:21:50 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'c.titulo' in 'field list' [ SELECT c.id, c.titulo, c.nombre_documento, t.tipo
              FROM documentos c LEFT JOIN  tipos t ON c.id_tipo=t.id ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:26:13 --- ERROR: Kohana_Exception [ 0 ]: The fecha property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 22:27:47 --- ERROR: Kohana_Exception [ 0 ]: The fecha property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 22:27:49 --- ERROR: Kohana_Exception [ 0 ]: The fecha property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-06-26 22:29:55 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `id` = '11' AND `idUsuario` = '2' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 22:50:06 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL nur/lista was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-26 22:50:26 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL nur/lista was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-26 22:50:32 --- ERROR: ErrorException [ 4096 ]: Object of class Database_MySQL_Result could not be converted to string ~ APPPATH\classes\controller\nur.php [ 92 ]
2011-06-26 22:51:16 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/general could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2011-06-26 22:53:17 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/general could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2011-06-26 22:54:32 --- ERROR: ErrorException [ 1 ]: Cannot access protected property Database_MySQL_Result::$_total_rows ~ APPPATH\classes\controller\nur.php [ 94 ]
2011-06-26 22:56:30 --- ERROR: ErrorException [ 1 ]: Cannot access protected property Database_MySQL_Result::$_total_rows ~ APPPATH\classes\model\asignados.php [ 24 ]
2011-06-26 22:57:46 --- ERROR: ErrorException [ 1 ]: Cannot access protected property Database_MySQL_Result::$_total_rows ~ APPPATH\classes\model\asignados.php [ 24 ]
2011-06-26 23:01:21 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/general could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2011-06-26 23:02:13 --- ERROR: ErrorException [ 4096 ]: Object of class Database_MySQL_Result could not be converted to string ~ APPPATH\classes\controller\nur.php [ 97 ]
2011-06-26 23:02:14 --- ERROR: ErrorException [ 4096 ]: Object of class Database_MySQL_Result could not be converted to string ~ APPPATH\classes\controller\nur.php [ 97 ]
2011-06-26 23:19:50 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''2','2'' at line 7 [ SELECT *  FROM documentos d
                INNER JOIN asignados a ON a.id=d.id_nuri
                INNER JOIN procesos p ON p.id=d.id_proceso
                WHERE a.id_user='2'
                AND id_tipo=-1
                ORDER BY a.fecha_creacion DESC
                LIMIT '2','2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-26 23:54:58 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: seguimiento/nuri/I/2011-0004 ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-06-26 23:55:10 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL seguimiento/nuri/11 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-26 23:58:19 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
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