<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-01 07:42:35 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 't.image' in 'field list' ( SELECT t.id, t.tipo,t.action,t.plural,t.image FROM tipos t 
        INNER JOIN usertipo u ON u.id_tipo=t.id
        WHERE u.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-01 08:04:52 --- ERROR: ErrorException [ 8 ]: Undefined variable: titulo ~ APPPATH\views\templates\default2.php [ 37 ]
2011-08-01 09:51:50 --- ERROR: ErrorException [ 2 ]: Attempt to assign property of non-object ~ APPPATH\classes\controller\documentos.php [ 13 ]
2011-08-01 09:59:13 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$codigo ~ APPPATH\classes\controller\documentos.php [ 167 ]
2011-08-01 10:01:31 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$id_tipo ~ APPPATH\classes\controller\documentos.php [ 167 ]
2011-08-01 10:29:27 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-01 11:04:29 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 56 ]
2011-08-01 13:37:25 --- ERROR: ErrorException [ 8 ]: Undefined variable: s ~ APPPATH\views\bandeja\entrada.php [ 34 ]
2011-08-01 13:37:33 --- ERROR: ErrorException [ 8 ]: Undefined variable: s ~ APPPATH\views\bandeja\entrada.php [ 34 ]
2011-08-01 13:37:34 --- ERROR: ErrorException [ 8 ]: Undefined variable: s ~ APPPATH\views\bandeja\entrada.php [ 34 ]
2011-08-01 13:37:56 --- ERROR: ErrorException [ 8 ]: Undefined variable: s ~ APPPATH\views\bandeja\entrada.php [ 34 ]
2011-08-01 16:24:17 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\views\bandeja\entrada.php [ 48 ]