<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-03 08:02:32 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'id_user' in 'where clause' ( SELECT `seguimiento`.* FROM `seguimiento` WHERE `id` = '11' AND `id_user` = '2' LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-03 14:59:40 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$id_tipo ~ APPPATH\classes\controller\documentos.php [ 269 ]
2011-08-03 15:01:07 --- ERROR: Kohana_Exception [ 0 ]: Method find() cannot be called on loaded objects ~ MODPATH\orm\classes\kohana\orm.php [ 950 ]
2011-08-03 15:01:36 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$via ~ APPPATH\views\documentos\edit.php [ 103 ]
2011-08-03 15:03:01 --- ERROR: ErrorException [ 8 ]: Undefined variable: user ~ APPPATH\views\documentos\edit.php [ 189 ]
2011-08-03 15:16:41 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Controller_documentos::action_editar() ~ APPPATH\classes\controller\documentos.php [ 258 ]
2011-08-03 15:17:03 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$id ~ APPPATH\views\documentos\edit.php [ 81 ]