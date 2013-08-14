<?php defined('SYSPATH') or die('No direct script access.'); ?>

2013-08-14 12:34:01 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-14 12:35:18 --- ERROR: Kohana_Exception [ 0 ]: Invalid method listaGeneral called in Model_Users ~ MODPATH/orm/classes/kohana/orm.php [ 606 ]
2013-08-14 12:35:25 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-14 16:43:29 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '}' ~ APPPATH/classes/controller/admin/user.php [ 43 ]
2013-08-14 16:43:56 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/entidades.php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2013-08-14 16:43:58 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/entidades.php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2013-08-14 16:44:01 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-14 16:44:15 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/entidades.php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2013-08-14 16:44:27 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-14 16:45:25 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/entidades.php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2013-08-14 16:48:52 --- ERROR: Kohana_Exception [ 0 ]: Invalid method listaGeneral called in Model_Users ~ MODPATH/orm/classes/kohana/orm.php [ 606 ]
2013-08-14 16:48:57 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ') GROUP BY u.id' at line 4 ( SELECT u.id, u.nombre,u.cargo,COUNT(*) as  pendientes FROM users u
    INNER JOIN seguimiento s ON s.derivado_a=u.id
    WHERE s.estado='2'
    AND s.derivado_a IN  ) GROUP BY u.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-14 18:16:38 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ APPPATH/views/documentos/create.php [ 267 ]