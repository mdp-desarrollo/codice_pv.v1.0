<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-15 09:39:51 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='139'
            AND d.id_user='3' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-15 10:40:47 --- ERROR: ErrorException [ 1 ]: Class 'FB' not found ~ APPPATH\views\bandeja\entrada.php [ 119 ]
2011-08-15 10:40:49 --- ERROR: ErrorException [ 1 ]: Class 'FB' not found ~ APPPATH\views\bandeja\entrada.php [ 119 ]
2011-08-15 10:41:44 --- ERROR: ErrorException [ 2 ]: log() expects parameter 1 to be double, string given ~ APPPATH\views\bandeja\entrada.php [ 119 ]
2011-08-15 10:56:03 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/recepcion.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]