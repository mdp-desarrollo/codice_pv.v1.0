<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-01-23 10:39:17 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/error.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2012-01-23 12:28:24 --- ERROR: Kohana_Exception [ 0 ]: Invalid method WHERE called in Model_Oficinas ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2012-01-23 18:14:24 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'doc' in 'where clause' ( SELECT `documentos`.* FROM `documentos` WHERE `doc` = 0 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-23 18:17:13 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH\views\admin\add_oficina.php [ 48 ]
2012-01-23 18:22:40 --- ERROR: Kohana_Exception [ 0 ]: The gestion property does not exist in the Model_Correlativo class ~ MODPATH\orm\classes\kohana\orm.php [ 746 ]
2012-01-23 18:29:26 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\admin\oficinas.php [ 34 ]
2012-01-23 18:43:26 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\admin\oficinas.php [ 34 ]
2012-01-23 20:14:54 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\admin\oficinas.php [ 34 ]
2012-01-23 20:17:30 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\admin\oficinas.php [ 34 ]
2012-01-23 20:28:20 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'e.id_entidad' in 'field list' ( SELECT o.id,e.id_entidad,o.oficina,e.entidad,o.sigla 
            FROM oficinas o INNER JOIN entidades e ON o.id_entidad=e.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-23 20:42:04 --- ERROR: ErrorException [ 8 ]: Undefined index: buscar ~ APPPATH\classes\controller\busqueda.php [ 36 ]