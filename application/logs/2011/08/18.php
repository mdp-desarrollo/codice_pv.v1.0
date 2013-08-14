<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-18 07:53:19 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-18 07:54:13 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-18 07:54:28 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-18 08:02:37 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]
2011-08-18 08:03:19 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-18 08:03:23 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_ECHO, expecting ',' or ';' ~ APPPATH\views\documentos\create.php [ 119 ]
2011-08-18 08:05:50 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='149'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-18 09:37:04 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='137'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-18 09:54:47 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='149'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-18 09:59:24 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 09:59:50 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 09:59:51 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 09:59:52 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 09:59:53 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 09:59:56 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 10:00:03 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 10:00:04 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 185 ]
2011-08-18 10:00:13 --- ERROR: Kohana_Exception [ 0 ]: The plural property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-18 10:00:14 --- ERROR: Kohana_Exception [ 0 ]: The plural property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-18 10:00:15 --- ERROR: Kohana_Exception [ 0 ]: The plural property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-18 10:02:04 --- ERROR: Kohana_Exception [ 0 ]: Method find() cannot be called on loaded objects ~ MODPATH\orm\classes\kohana\orm.php [ 950 ]
2011-08-18 10:02:42 --- ERROR: ErrorException [ 1 ]: Cannot pass parameter 2 by reference ~ APPPATH\classes\controller\documentos.php [ 191 ]
2011-08-18 10:05:39 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-18 10:06:21 --- ERROR: ErrorException [ 8 ]: Undefined variable: word ~ APPPATH\views\documentos\detalle.php [ 121 ]
2011-08-18 13:38:16 --- ERROR: ErrorException [ 8 ]: Use of undefined constant php - assumed 'php' ~ APPPATH\views\documentos\detalle.php [ 161 ]
2011-08-18 14:59:14 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]
2011-08-18 15:14:47 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]
2011-08-18 15:15:53 --- ERROR: ErrorException [ 8 ]: Undefined index: nuri ~ APPPATH\views\nur\listar.php [ 14 ]
2011-08-18 15:23:20 --- ERROR: ErrorException [ 8 ]: Undefined index: nuri ~ APPPATH\views\nur\listar.php [ 14 ]
2011-08-18 15:27:53 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]