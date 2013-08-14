<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-01-06 07:37:29 --- ERROR: ErrorException [ 8 ]: Undefined variable: errors ~ APPPATH\views\seguimiento\buscar.php [ 7 ]
2012-01-06 08:24:28 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficinas ~ APPPATH\views\reportes\report_form_recepcion.php [ 39 ]
2012-01-06 08:29:44 --- ERROR: ErrorException [ 8 ]: Undefined index: oficina ~ APPPATH\classes\controller\reports.php [ 156 ]
2012-01-06 08:32:20 --- ERROR: ErrorException [ 8 ]: Undefined index: oficina ~ APPPATH\classes\controller\reports.php [ 156 ]
2012-01-06 08:48:08 --- ERROR: ErrorException [ 8 ]: Undefined index: oficina ~ APPPATH\classes\controller\reports.php [ 156 ]
2012-01-06 09:06:01 --- ERROR: ErrorException [ 8 ]: Undefined index: cargo_remitente ~ APPPATH\views\reportes\ventanilla_recepcion.php [ 22 ]
2012-01-06 09:16:36 --- ERROR: ErrorException [ 8 ]: Undefined variable: fecha1 ~ APPPATH\views\reportes\ventanilla_recepcion.php [ 6 ]
2012-01-06 10:25:13 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'nivel' in 'where clause' ( SELECT `carpetas`.* FROM `carpetas` WHERE `nivel` = '3' ORDER BY `carpetas`.`carpeta` DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-06 10:27:47 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'BYc.carpeta' at line 6 ( SELECT c.id,c.carpeta, COUNT(c.carpeta) as cc 
        FROM archivados a 
        INNER JOIN carpetas c ON a.id_carpeta=c.id
        WHERE a.id_user='2'
        GROUP BY c.id
        ORDER BYc.carpeta ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-06 10:28:05 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'BYc.carpeta
        GROUP BY c.id' at line 5 ( SELECT c.id,c.carpeta, COUNT(c.carpeta) as cc 
        FROM archivados a 
        INNER JOIN carpetas c ON a.id_carpeta=c.id
        WHERE a.id_user='2'
          ORDER BYc.carpeta
        GROUP BY c.id
       ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-06 13:11:17 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficiana ~ APPPATH\classes\controller\reportes.php [ 161 ]
2012-01-06 14:22:06 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view reportes/enviada.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2012-01-06 14:26:36 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\classes\controller\hojaruta.php [ 371 ]
2012-01-06 14:33:31 --- ERROR: ErrorException [ 8 ]: Undefined variable: documento ~ APPPATH\classes\controller\hojaruta.php [ 371 ]
2012-01-06 15:16:04 --- ERROR: Kohana_Exception [ 0 ]: Invalid method enviada_all called in Model_Reportes ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2012-01-06 15:43:26 --- ERROR: ErrorException [ 8 ]: Undefined index: oficina ~ APPPATH\classes\controller\reportes.php [ 236 ]
2012-01-06 15:47:19 --- ERROR: ErrorException [ 8 ]: Undefined index: oficina ~ APPPATH\classes\controller\reportes.php [ 243 ]
2012-01-06 15:47:38 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''2'   
        and d.original=1
        AND s.fecha_recepcion BETWEEN '2012-01-0' at line 4 ( SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_a_oficina='27'        
        AND s.estado '2'   
        and d.original=1
        AND s.fecha_recepcion BETWEEN '2012-01-01 00:00:00' AND '2012-01-06 23:59:00' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-06 15:49:18 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''1'   
        and d.original=1
        AND s.fecha_recepcion BETWEEN '2012-01-0' at line 4 ( SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_a_oficina='1'        
        AND s.estado '1'   
        and d.original=1
        AND s.fecha_recepcion BETWEEN '2012-01-01 00:00:00' AND '2012-01-06 23:59:00' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-06 16:13:03 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'n.id' in 'on clause' ( SELECT s.id, n.nur,d.codigo,d.referencia,s.nombre_receptor,s.cargo_receptor,s.a_oficina,s.fecha_emision,s.proveido FROM seguimiento s
            INNER JOIN nurs n ON s.nur=n.id
            INNER JOIN users u ON s.derivado_a=u.id
            INNER JOIN oficinas o ON u.id_oficina=o.id
            INNER JOIN documentos d ON d.id_nur=s.nur
            WHERE s.id='152'
            and d.original='1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]