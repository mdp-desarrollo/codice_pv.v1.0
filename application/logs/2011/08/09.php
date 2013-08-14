<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-09 08:03:26 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='138'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-09 08:03:32 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='137'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-09 09:27:21 --- ERROR: ErrorException [ 1 ]: Class 'image' not found ~ APPPATH\views\hojaruta\derivar.php [ 116 ]
2011-08-09 09:27:34 --- ERROR: ErrorException [ 1 ]: Class 'image' not found ~ APPPATH\views\hojaruta\derivar.php [ 116 ]
2011-08-09 09:28:18 --- ERROR: ErrorException [ 1 ]: Class 'Image' not found ~ APPPATH\views\hojaruta\derivar.php [ 116 ]
2011-08-09 09:29:02 --- ERROR: ErrorException [ 1 ]: Class 'Image' not found ~ APPPATH\views\hojaruta\derivar.php [ 116 ]
2011-08-09 09:30:37 --- ERROR: ErrorException [ 1 ]: Class 'Image' not found ~ APPPATH\views\hojaruta\derivar.php [ 116 ]
2011-08-09 09:42:02 --- ERROR: ErrorException [ 2 ]: Missing argument 2 for Kohana_Image::crop(), called in C:\xampp\htdocs\paperwork\application\views\hojaruta\derivar.php on line 119 and defined ~ MODPATH\image\classes\kohana\image.php [ 278 ]
2011-08-09 09:56:00 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]
2011-08-09 09:56:17 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]
2011-08-09 09:59:33 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]
2011-08-09 11:07:09 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='138'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-09 13:58:47 --- ERROR: ErrorException [ 8 ]: Undefined offset: 0 ~ APPPATH\classes\controller\hojaruta.php [ 59 ]