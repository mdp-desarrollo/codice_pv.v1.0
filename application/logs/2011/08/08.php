<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-08 08:02:57 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$plural ~ APPPATH\classes\controller\documentos.php [ 280 ]
2011-08-08 08:51:13 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view user/derivar.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-08 08:53:23 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\documentos\index.php [ 63 ]
2011-08-08 14:30:05 --- ERROR: Kohana_Exception [ 0 ]: The id_nur property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 746 ]
2011-08-08 14:30:29 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:30:32 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:30:50 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:30:54 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:36:18 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:36:35 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:36:37 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 14:41:35 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='137'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-08 14:47:57 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-08 14:49:16 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='138'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-08 14:59:50 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-08 15:00:02 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-08 15:07:53 --- ERROR: ErrorException [ 8 ]: Undefined index: tipo ~ APPPATH\views\documentos\index.php [ 46 ]
2011-08-08 15:08:27 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nuri ~ APPPATH\views\documentos\index.php [ 61 ]
2011-08-08 15:08:53 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nuri ~ APPPATH\views\documentos\index.php [ 70 ]
2011-08-08 16:20:26 --- ERROR: Kohana_Exception [ 0 ]: The derivado_por property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 16:20:58 --- ERROR: Kohana_Exception [ 0 ]: The nombre_receptor property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-08 17:03:10 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]