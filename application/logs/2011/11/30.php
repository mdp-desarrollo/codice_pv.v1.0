<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-11-30 06:59:19 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_nur' in 'field list' ( SELECT s.id as id_seg,a.id_user, s.id_archivo, c.carpeta, s.accion,s.oficial,s.de_oficina, s.proveido, a.fecha as fecha_archivo, d.id as id_doc, d.id_nur, d.codigo,d.referencia,d.nur FROM seguimiento s
            INNER JOIN archivados a ON a.id=s.id_archivo
            INNER JOIN carpetas c ON a.id_carpeta=c.id
            INNER JOIN documentos d ON d.id_nur=s.nur
            WHERE s.estado='10'
            AND c.id='1'
            AND d.original='1'
            AND s.derivado_a='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-30 13:42:06 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_nur' in 'field list' ( SELECT s.id as id_seg,a.id_user, s.id_archivo, c.carpeta, s.accion,s.oficial,s.de_oficina, s.proveido, a.fecha as fecha_archivo, d.id as id_doc, d.id_nur, d.codigo,d.referencia,d.nur FROM seguimiento s
            INNER JOIN archivados a ON a.id=s.id_archivo
            INNER JOIN carpetas c ON a.id_carpeta=c.id
            INNER JOIN documentos d ON d.id_nur=s.nur
            WHERE s.estado='10'
            AND c.id='1'
            AND d.original='1'
            AND s.derivado_a='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-30 13:45:09 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_nur' in 'on clause' ( SELECT s.id as id_seg,a.id_user, s.id_archivo, c.carpeta, s.accion,s.oficial,s.de_oficina, s.proveido, a.fecha as fecha_archivo, d.id as id_doc, d.nur, d.codigo,d.referencia
            FROM seguimiento s
            INNER JOIN archivados a ON a.id=s.id_archivo
            INNER JOIN carpetas c ON a.id_carpeta=c.id
            INNER JOIN documentos d ON d.id_nur=s.nur
            WHERE s.estado='10'
            AND c.id='1'
            AND d.original='1'
            AND s.derivado_a='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-30 13:45:23 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nur ~ APPPATH\views\bandeja\carpeta.php [ 16 ]
2011-11-30 13:45:37 --- ERROR: ErrorException [ 8 ]: Undefined index: id_nur ~ APPPATH\views\bandeja\carpeta.php [ 16 ]
2011-11-30 14:47:23 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view busqueda/form_avanzada.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-11-30 14:52:03 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view busqueda/form_avanzada.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-11-30 15:19:33 --- ERROR: ErrorException [ 8 ]: Undefined index: buscar ~ APPPATH\classes\controller\busqueda.php [ 35 ]