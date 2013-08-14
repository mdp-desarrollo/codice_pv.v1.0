<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-08 08:00:22 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-08 08:40:29 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-08 08:44:11 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-08 09:07:07 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_PUBLIC ~ APPPATH\classes\controller\hojaruta.php [ 509 ]
2011-09-08 09:07:53 --- ERROR: ErrorException [ 8 ]: Undefined variable: nur_asignado ~ APPPATH\classes\controller\hojaruta.php [ 486 ]
2011-09-08 09:08:15 --- ERROR: ErrorException [ 8 ]: Undefined variable: nur_asignado ~ APPPATH\classes\controller\hojaruta.php [ 487 ]
2011-09-08 09:42:17 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 172 ]
2011-09-08 10:00:20 --- ERROR: ErrorException [ 8 ]: Undefined variable: lista_db ~ APPPATH\classes\controller\hojaruta.php [ 73 ]
2011-09-08 10:08:19 --- ERROR: Kohana_Exception [ 0 ]: Method find() cannot be called on loaded objects ~ MODPATH\orm\classes\kohana\orm.php [ 950 ]
2011-09-08 10:11:13 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column '1' in 'where clause' ( SELECT `oficinas`.* FROM `oficinas` WHERE 0 = 'id' AND `1` = '9' LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-08 10:35:29 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-09-08 11:08:05 --- ERROR: ErrorException [ 1 ]: Class 'Model_Seguimientos' not found ~ MODPATH\orm\classes\kohana\orm.php [ 109 ]
2011-09-08 11:08:15 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'id_nur' in 'where clause' ( SELECT `seguimiento`.* FROM `seguimiento` WHERE `id_nur` = '31' AND `derivado_a` = '2' AND `estado` = 2 LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-08 11:08:30 --- ERROR: ErrorException [ 8 ]: Undefined variable: derivaciones ~ APPPATH\classes\controller\hojaruta.php [ 242 ]
2011-09-08 11:08:45 --- ERROR: ErrorException [ 8 ]: Undefined variable: arr ~ APPPATH\classes\controller\hojaruta.php [ 242 ]
2011-09-08 11:12:59 --- ERROR: Kohana_Exception [ 0 ]: The documentos property does not exist in the Model_Seguimiento class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-09-08 11:13:16 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\views\hojaruta\derivar.php [ 89 ]
2011-09-08 11:14:50 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\hojaruta.php [ 214 ]
2011-09-08 11:16:49 --- ERROR: ErrorException [ 8 ]: Undefined variable: destinatario ~ APPPATH\classes\controller\hojaruta.php [ 206 ]
2011-09-08 14:04:56 --- ERROR: ErrorException [ 8 ]: Undefined variable: docs ~ APPPATH\views\templates\submenu.php [ 7 ]
2011-09-08 14:05:13 --- ERROR: ErrorException [ 8 ]: Undefined variable: doc ~ APPPATH\views\templates\submenu.php [ 7 ]
2011-09-08 14:05:16 --- ERROR: ErrorException [ 8 ]: Undefined variable: doc ~ APPPATH\views\templates\submenu.php [ 7 ]
2011-09-08 14:13:42 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$descripcion ~ APPPATH\views\documentos\nuevo.php [ 6 ]
2011-09-08 14:14:26 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 't.descripcion' in 'field list' ( SELECT t.id, t.tipo,t.action,t.plural,t.image,t.descripcion FROM tipos t 
        INNER JOIN usertipo u ON u.id_tipo=t.id
        WHERE u.id_user='5' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-08 14:14:27 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 't.descripcion' in 'field list' ( SELECT t.id, t.tipo,t.action,t.plural,t.image,t.descripcion FROM tipos t 
        INNER JOIN usertipo u ON u.id_tipo=t.id
        WHERE u.id_user='5' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-08 14:16:03 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 't.descripcion' in 'field list' ( SELECT t.id, t.tipo,t.action,t.plural,t.image,t.descripcion FROM tipos t 
        INNER JOIN usertipo u ON u.id_tipo=t.id
        WHERE u.id_user='5' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-08 14:16:05 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 't.descripcion' in 'field list' ( SELECT t.id, t.tipo,t.action,t.plural,t.image,t.descripcion FROM tipos t 
        INNER JOIN usertipo u ON u.id_tipo=t.id
        WHERE u.id_user='5' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-08 15:45:59 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Controller_Hojaruta::action_deriv() ~ APPPATH\classes\controller\hojaruta.php [ 51 ]
2011-09-08 16:13:30 --- ERROR: ErrorException [ 1 ]: Class 'Controller_SeguimientotTemplate' not found ~ APPPATH\classes\controller\seguimiento.php [ 3 ]
2011-09-08 16:13:33 --- ERROR: ErrorException [ 1 ]: Class 'Controller_SeguimientotTemplate' not found ~ APPPATH\classes\controller\seguimiento.php [ 3 ]
2011-09-08 17:27:08 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\classes\controller\seguimiento.php [ 65 ]
2011-09-08 17:45:15 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$fecha_recpecion ~ APPPATH\views\hojaruta\seguimiento.php [ 62 ]