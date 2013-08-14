<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-07 09:26:48 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'a.fecha_creacion' in 'order clause' ( SELECT * FROM nurs n
        INNER JOIN nurs_documentos  nd on n.id=nd.id_nur
        INNER JOIN documentos d ON d.id=nd.id_documento
        WHERE n.id_user='5' 
        AND n.original='1'
        ORDER BY a.fecha_creacion DESC
        LIMIT 0 , 30 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-07 09:27:16 --- ERROR: ErrorException [ 8 ]: Undefined index: proceso ~ APPPATH\views\hojaruta\index.php [ 43 ]
2011-09-07 09:30:18 --- ERROR: ErrorException [ 8 ]: Undefined index: derivado ~ APPPATH\views\hojaruta\index.php [ 48 ]
2011-09-07 09:36:01 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 65 ]
2011-09-07 09:36:20 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 65 ]
2011-09-07 09:47:34 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 65 ]
2011-09-07 10:48:16 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 76 ]
2011-09-07 10:53:02 --- ERROR: ErrorException [ 8 ]: Undefined variable: n ~ APPPATH\classes\controller\hojaruta.php [ 60 ]
2011-09-07 10:53:27 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\views\hojaruta\derivar.php [ 89 ]
2011-09-07 11:03:00 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\views\hojaruta\deriv.php [ 191 ]
2011-09-07 11:03:25 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\hojaruta.php [ 110 ]
2011-09-07 11:03:33 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\hojaruta.php [ 110 ]
2011-09-07 11:04:05 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\views\hojaruta\deriv.php [ 207 ]
2011-09-07 11:04:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_AS, expecting ']' ~ APPPATH\views\hojaruta\deriv.php [ 207 ]
2011-09-07 11:04:55 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ']' ~ APPPATH\views\hojaruta\deriv.php [ 207 ]
2011-09-07 11:05:00 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\views\hojaruta\deriv.php [ 210 ]
2011-09-07 11:14:55 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-07 11:27:21 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-07 11:35:27 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-07 14:12:18 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 14:45:01 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-07 15:03:29 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$nur ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:05:36 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$nur ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:08:40 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$nur ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:12:23 --- ERROR: Kohana_Exception [ 0 ]: The nombreRemiente property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-09-07 15:12:35 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$nur ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:13:44 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$nur ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:14:25 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$nur ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:21:59 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:22:14 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:22:28 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:22:28 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 15:22:38 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\views\hojaruta\seguimiento.php [ 3 ]
2011-09-07 16:20:24 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'h.id_seguimiento' in 'field list' ( SELECT s.id, s.padre,s.nombre_emisor,s.oficial,s.cargo_emisor,s.de_oficina,s.fecha_emision as fecha,s.proveido,h.id_nur, h.id_seguimiento, a.codigo as documento, d.codigo, p.proceso,c.accion,s.adjuntos
            FROM seguimiento s
	    INNER JOIN nurs_documentos h ON h.id_nur=s.nur
            INNER JOIN documentos d ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
	    INNER JOIN acciones c ON s.accion=c.id      
	    INNER JOIN	procesos p ON p.id=h.id_proceso												
            WHERE s.estado='1'
            and s.derivado_a='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-07 16:20:42 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$nuri ~ APPPATH\views\bandeja\recepcionar.php [ 68 ]
2011-09-07 16:22:22 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$nuri ~ APPPATH\views\bandeja\recepcionar.php [ 68 ]
2011-09-07 16:22:24 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$nuri ~ APPPATH\views\bandeja\recepcionar.php [ 68 ]
2011-09-07 16:22:50 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 78 ]
2011-09-07 16:22:51 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 78 ]
2011-09-07 16:23:14 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 78 ]
2011-09-07 16:23:45 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 78 ]
2011-09-07 16:23:45 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 78 ]
2011-09-07 16:24:06 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\bandeja\recepcionar.php [ 85 ]
2011-09-07 16:24:49 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$adjunto ~ APPPATH\views\bandeja\recepcionar.php [ 84 ]
2011-09-07 16:33:45 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$fecha ~ APPPATH\views\bandeja\pendientes.php [ 212 ]
2011-09-07 16:34:25 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 215 ]
2011-09-07 16:34:26 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 215 ]
2011-09-07 16:35:13 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 220 ]
2011-09-07 16:35:14 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 220 ]
2011-09-07 16:35:15 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 220 ]
2011-09-07 16:35:34 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 220 ]
2011-09-07 16:35:35 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 220 ]
2011-09-07 16:35:50 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\pendientes.php [ 220 ]
2011-09-07 16:50:26 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:50:28 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:50:30 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:50:31 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:50:32 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:50:33 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:50:34 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:51:07 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:51:09 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:51:11 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:51:11 --- ERROR: ErrorException [ 1 ]: Class 'myClass' not found ~ APPPATH\views\bandeja\recepcionar.php [ 44 ]
2011-09-07 16:56:19 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\entrada.php [ 128 ]
2011-09-07 16:56:22 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$documento ~ APPPATH\views\bandeja\entrada.php [ 128 ]
2011-09-07 17:34:14 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/recepcion.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]