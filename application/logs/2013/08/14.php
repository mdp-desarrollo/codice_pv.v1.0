<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-08-14 16:28:41 --- ERROR: Kohana_Exception [ 0 ]: Invalid method listaGeneral called in Model_Users ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2013-08-14 16:36:47 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Model_Users::usuarios(), called in E:\sistemas\codice_pv\application\classes\controller\admin\user.php on line 37 and defined ~ APPPATH\classes\model\users.php [ 47 ]
2013-08-14 16:37:24 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\user.php [ 41 ]
2013-08-14 16:37:38 --- ERROR: ErrorException [ 8 ]: Undefined variable: users ~ APPPATH\classes\controller\admin\user.php [ 38 ]
2013-08-14 16:49:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH\classes\controller\admin\user.php [ 43 ]
2013-08-14 16:49:33 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/entidades.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2013-08-14 16:50:31 --- ERROR: ErrorException [ 8 ]: Undefined variable: usuarios ~ APPPATH\views\admin\usuarios.php [ 40 ]
2013-08-14 16:50:51 --- ERROR: Kohana_Exception [ 0 ]: Invalid method listaGeneral called in Model_Users ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2013-08-14 16:50:57 --- ERROR: Kohana_Exception [ 0 ]: Invalid method listaGeneral called in Model_Users ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2013-08-14 16:51:03 --- ERROR: Kohana_Exception [ 0 ]: Invalid method listaGeneral called in Model_Users ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2013-08-14 16:51:21 --- ERROR: ErrorException [ 8 ]: Undefined variable: usuarios ~ APPPATH\views\admin\usuarios.php [ 40 ]
2013-08-14 16:51:36 --- ERROR: ErrorException [ 8 ]: Undefined variable: entidad ~ APPPATH\views\admin\oficinas.php [ 9 ]
2013-08-14 16:51:44 --- ERROR: ErrorException [ 8 ]: Undefined variable: users ~ APPPATH\views\admin\users.php [ 44 ]
2013-08-14 18:05:08 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-14 18:17:59 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]