<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-07-01 12:27:10 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: hojaruta/papwerwork/ajax/archivar ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-07-01 12:27:23 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: hojaruta/papwerwork/ajax/archivar ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-07-01 12:27:29 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: hojaruta/papwerwork/ajax/archivar ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-07-01 12:27:32 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: hojaruta/papwerwork/ajax/archivar ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-07-01 12:28:02 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: hojaruta/paperwork/ajax/archivar ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-07-01 15:40:05 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\pendientes.php [ 128 ]
2011-07-01 17:16:50 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 72 ]
2011-07-01 17:16:58 --- ERROR: Kohana_Exception [ 0 ]: Invalid method query called in Model_Seguimiento ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2011-07-01 17:57:14 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.`nur, s`.`nombre_emisor, s`.`cargo_emisor, s`.`de_oficina, s`.`fecha_emision as' at line 1 [ SELECT `SELECT s`.`id, a`.`codigo as nuri,s`.`nur, s`.`nombre_emisor, s`.`cargo_emisor, s`.`de_oficina, s`.`fecha_emision as fecha, s`.`oficial, s`.`proveido,s`.`archivos,s`.`adjuntos,d`.`id as id_doc, d`.`codigo, d`.`citeOriginal,
            d`.`nombreDestinatario, d`.`cargoDestinatario, d`.`institucionDestinatario,d`.`referencia, d`.`adjuntos as adjunto,c`.`accion as accion, p`.`proceso
            FROM seguimiento s
	    INNER JOIN documentos d ON d`.`id_nuri=s`.`nur
            INNER JOIN asignados a ON s`.`nur=a`.`id
            INNER JOIN acciones c ON s`.`accion=c`.`id
            INNER JOIN estados e ON s`.`estado=e`.`id
	    INNER JOIN	procesos p ON p`.`id=d`.`id_proceso												
            WHERE s`.`estado='2'
            and s`.`derivado_a='3'` ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-07-01 17:59:12 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 76 ]
2011-07-01 17:59:13 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 76 ]
2011-07-01 17:59:14 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 76 ]
2011-07-01 17:59:15 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 76 ]
2011-07-01 17:59:15 --- ERROR: ErrorException [ 1 ]: Call to a member function query() on a non-object ~ APPPATH\classes\model\seguimiento.php [ 76 ]
2011-07-01 18:02:45 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\user\pendientes.php [ 73 ]