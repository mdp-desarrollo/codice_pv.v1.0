<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-12-02 08:18:31 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view ventanilla/lista_pendientes.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-12-02 08:19:05 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view ventanilla/lista_pendientes.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-12-02 08:19:51 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view ventanilla/lista_pendientes.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-12-02 08:20:09 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\views\ventanilla\lista_pendientes.php [ 28 ]
2011-12-02 08:22:00 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\views\ventanilla\lista_pendientes.php [ 28 ]
2011-12-02 08:54:58 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'a.nombre_archivo' in 'field list' ( SELECT d.id, d.codigo, d.nur, d.nombre_destinatario,d.cargo_destinatario,d.institucion_destinatario,d.nombre_remitente,d.cargo_remitente,d.institucion_remitente,d.referencia,g.grupo,a.nombre_archivo,a.id,d.hojas,d.fecha_creacion
            FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            WHERE d.id_user='5'
            AND estado='0' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-12-02 08:55:33 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\ventanilla\lista_pendientes.php [ 73 ]
2011-12-02 08:56:33 --- ERROR: ErrorException [ 8 ]: Undefined variable: page_links ~ APPPATH\views\ventanilla\lista_pendientes.php [ 85 ]
2011-12-02 09:07:46 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH\views\ventanilla\lista_pendientes.php [ 67 ]