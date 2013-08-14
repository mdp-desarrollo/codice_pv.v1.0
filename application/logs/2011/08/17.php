<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-08-17 08:25:39 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\hojaruta.php [ 282 ]
2011-08-17 08:26:45 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='141'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:27:17 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='141'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:27:23 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='138'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:30:15 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'I/2011-00034' for key 'nuri' ( INSERT INTO `documentos` (`id_user`, `codigo`, `id_tipo`, `nombreDestinatario`, `cargoDestinatario`, `nombreRemitente`, `cargoRemitente`, `fecha_creacion`, `nur`) VALUES ('2', 'CIR/MDP/DGA/UA/SIS/2011-0004', '1', 'Lic. Herlan David Rios Zambrana', 'Jefe de Unidad Administrativa', 'Marco Antonio Garcia', 'Encargado de Sistemas', 1313587815, 'I/2011-00034') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:31:36 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'I/2011-00034' for key 'nuri' ( INSERT INTO `documentos` (`id_user`, `codigo`, `id_tipo`, `nombreDestinatario`, `cargoDestinatario`, `nombreRemitente`, `cargoRemitente`, `fecha_creacion`, `id_nur`, `nur`) VALUES ('2', 'CIR/MDP/DGA/UA/SIS/2011-0005', '1', 'Lic. Herlan David Rios Zambrana', 'Jefe de Unidad Administrativa', 'Marco Antonio Garcia', 'Encargado de Sistemas', 1313587896, '191', 'I/2011-00034') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:36:46 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'I/2011-00034' for key 'nuri' ( INSERT INTO `documentos` (`id_user`, `codigo`, `id_tipo`, `nombreDestinatario`, `cargoDestinatario`, `nombreRemitente`, `cargoRemitente`, `fecha_creacion`, `id_nur`, `nur`) VALUES ('2', 'CIR/MDP/DGA/UA/SIS/2011-0006', '1', 'Lic. Herlan David Rios Zambrana', 'Jefe de Unidad Administrativa', 'Marco Antonio Garcia', 'Encargado de Sistemas', 1313588206, '191', 'I/2011-00034') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:37:36 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'I/2011-00034' for key 'nuri' ( INSERT INTO `documentos` (`id_user`, `codigo`, `id_tipo`, `nombreDestinatario`, `cargoDestinatario`, `nombreRemitente`, `cargoRemitente`, `fecha_creacion`, `id_nur`, `nur`) VALUES ('2', 'CIR/MDP/DGA/UA/SIS/2011-0007', '1', 'Lic. Herlan David Rios Zambrana', 'Jefe de Unidad Administrativa', 'Marco Antonio Garcia', 'Encargado de Sistemas', 1313588256, '191', 'I/2011-00034') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 08:38:34 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='146'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 09:55:26 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='147'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 09:55:43 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='147'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 10:03:15 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-17 10:03:42 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view errors/404.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2011-08-17 10:05:52 --- ERROR: Kohana_Exception [ 0 ]: The loaded property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:06:10 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Documentos as array ~ APPPATH\classes\controller\documentos.php [ 272 ]
2011-08-17 10:06:24 --- ERROR: Kohana_Exception [ 0 ]: The id_doc property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:08:15 --- ERROR: Kohana_Exception [ 0 ]: The id_doc property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:45:20 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:45:34 --- ERROR: Kohana_Exception [ 0 ]: The nuri property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:46:12 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:48:24 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:48:49 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:49:17 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:49:25 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 10:49:32 --- ERROR: Kohana_Exception [ 0 ]: The adjunto property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-08-17 15:02:50 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH\classes\controller\defaulttemplate.php [ 21 ]
2011-08-17 15:02:57 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH\classes\controller\defaulttemplate.php [ 21 ]
2011-08-17 15:02:58 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH\classes\controller\defaulttemplate.php [ 21 ]
2011-08-17 15:09:36 --- ERROR: ErrorException [ 8 ]: Undefined variable: topmenu ~ APPPATH\views\templates\layout.php [ 28 ]
2011-08-17 15:09:47 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\templates\menutop.php [ 1 ]
2011-08-17 15:55:24 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='148'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 16:08:59 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='148'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 16:09:17 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='138'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-08-17 17:04:26 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.id_tipo,t.plural,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.id='148'
            AND d.id_user='2' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]