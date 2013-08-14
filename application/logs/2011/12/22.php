<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-12-22 08:13:09 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'             
            ORDER BY d.fecha_creacion DESC
            LIMIT 0,50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-12-22 09:13:12 --- ERROR: ErrorException [ 8 ]: Undefined variable: estados ~ APPPATH\views\reportes\recepcionada.php [ 43 ]
2011-12-22 10:40:27 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column '1' in 'where clause' ( SELECT `documentos`.* FROM `documentos` WHERE 0 = 'nur' AND `1` IS NULL LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-12-22 10:42:09 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column '1' in 'where clause' ( SELECT `documentos`.* FROM `documentos` WHERE 0 = 'nur' AND `1` = 'I/2011-00012' LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-12-22 13:36:56 --- ERROR: ErrorException [ 8 ]: Undefined index: oficina ~ APPPATH\classes\controller\reportes.php [ 104 ]
2011-12-22 13:37:34 --- ERROR: Kohana_Exception [ 0 ]: Invalid method recepcionado called in Model_Reportes ~ MODPATH\orm\classes\kohana\orm.php [ 606 ]
2011-12-22 13:49:44 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficina ~ APPPATH\classes\controller\reportes.php [ 106 ]
2011-12-22 13:50:40 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficina ~ APPPATH\classes\controller\reportes.php [ 106 ]
2011-12-22 13:51:08 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficina ~ APPPATH\classes\model\reportes.php [ 30 ]
2011-12-22 13:51:42 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficina ~ APPPATH\classes\model\reportes.php [ 30 ]
2011-12-22 13:51:49 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficina ~ APPPATH\classes\model\reportes.php [ 30 ]
2011-12-22 13:52:12 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'BETWEN '2011-05-12' AND '2011-12-22'' at line 8 ( SELECT * FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        INNER JOIN users u ON s.derivado_por=u.id
        WHERE s.de_oficina='33'
        AND s.derivado_a='4'
        AND s.estado='2'
        OR s.estado='3'
        AND s.fecha_recepcion BETWEN '2011-05-12' AND '2011-12-22' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-12-22 14:09:06 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view reportes/vista.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-12-22 14:10:00 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view reportes/vista.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-12-22 14:30:56 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 's.nombre_remitente' in 'field list' ( SELECT s.nur,s.nombre_remitente FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.id_de_oficina='15'
        AND s.derivado_a='4'
        AND s.estado BETWEEN '2' and '4'        
        AND s.fecha_recepcion BETWEEN '2011-05-12' AND '2011-12-22' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]