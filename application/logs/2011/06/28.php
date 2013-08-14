<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-06-28 08:56:00 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asdasd/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 08:59:24 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asdasd/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 08:59:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asdasd/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 08:59:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asdasd/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 08:59:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL asdasd/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 11:51:01 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL bandeja/entrada was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 11:57:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hs/listar was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 12:13:43 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL archivos/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 12:13:46 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL documentos/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-28 12:18:27 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'oo.nombre' in 'field list' [ SELECT s.id,s.padre,s.oficial, oo.nombre as de_oficina,s.nombre_emisor,s.cargo_emisor,s.fecha_emision,o.nombre as a_oficina, s.nombre_receptor,s.cargo_receptor,s.fecha_recepcion,
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
2011-06-28 12:18:48 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL archivos/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 12:21:24 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:21:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:21:27 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:21:58 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:00 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:02 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:03 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:40 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:42 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:22:43 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:23:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL derivar/ajax/documentos was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-28 12:23:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL derivar/ajax/documentos was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-28 12:24:52 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:24:54 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:26:13 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:26:14 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:26:18 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:26:19 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:26:23 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 12:26:24 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'idUsuario' in 'where clause' [ SELECT `documentos`.* FROM `documentos` WHERE `idUsuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-28 14:57:47 --- ERROR: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::as_object() ~ APPPATH\classes\model\seguimiento.php [ 41 ]
2011-06-28 15:02:43 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\seguimiento.php [ 42 ]
2011-06-28 15:03:13 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\seguimiento.php [ 42 ]
2011-06-28 15:08:51 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 44 ]
2011-06-28 15:09:06 --- ERROR: ErrorException [ 1 ]: Cannot use object of type stdClass as array ~ APPPATH\views\user\seguimiento.php [ 30 ]
2011-06-28 15:35:03 --- ERROR: ErrorException [ 1 ]: Call to undefined method myClass::fecha() ~ APPPATH\views\user\seguimiento.php [ 27 ]
2011-06-28 17:55:04 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\pendientes.php [ 13 ]
2011-06-28 17:57:50 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\pendientes.php [ 13 ]
2011-06-28 17:58:01 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hojaruta/recepcionar was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-28 17:58:09 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\recepcionar.php [ 50 ]
2011-06-28 18:00:28 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\recepcionar.php [ 50 ]
2011-06-28 18:00:30 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\recepcionar.php [ 50 ]
2011-06-28 18:00:30 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\recepcionar.php [ 50 ]
2011-06-28 19:20:02 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL entrada/bandeja was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 19:20:10 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hs/listar was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 19:20:19 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL entrada/bandeja was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 19:44:03 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL entrada/bandeja was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-06-28 19:55:58 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hojaruta/recibir was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-28 19:56:03 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL hojaruta/recibir was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]
2011-06-28 19:59:36 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL documentos/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 120 ]