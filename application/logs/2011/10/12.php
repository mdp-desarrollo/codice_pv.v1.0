<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-10-12 13:53:42 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$oficial ~ APPPATH\views\hojaruta\seguimiento.php [ 50 ]
2011-10-12 13:53:56 --- ERROR: ErrorException [ 8 ]: Undefined property: stdClass::$proveido ~ APPPATH\views\hojaruta\seguimiento.php [ 107 ]
2011-10-12 13:55:12 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.codigo='' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-10-12 14:16:10 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.codigo='' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-10-12 14:25:49 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.id_archivo' in 'field list' ( SELECT d.id,d.codigo,d.nombreDestinatario,d.cargoDestinatario,d.nombreVia,d.cargoVia,d.nombreRemitente,d.cargoRemitente,d.fecha_creacion,d.referencia,a.codigo as hr, t.tipo,d.contenido,d.id_archivo
            FROM documentos d
            INNER JOIN hojasruta h ON h.id_documento=d.id
            INNER JOIN asignados a ON a.id=h.id_nur
            INNER JOIN tipos t ON t.id=d.id_tipo
            WHERE d.codigo='INF/MDP/DGA/UA/SIS Nº 0002/2011' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-10-12 14:30:14 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-10-12 14:30:22 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-10-12 14:31:02 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column '1' in 'where clause' ( SELECT `documentos`.* FROM `documentos` WHERE 0 = 'codigo' AND `1` = 'INF/MDP/DGA/UA/SIS Nº 0002/2011' LIMIT 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-10-12 14:31:05 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-10-12 14:31:19 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_OBJECT_OPERATOR ~ APPPATH\classes\controller\documentos.php [ 189 ]
2011-10-12 14:31:27 --- ERROR: ErrorException [ 8 ]: Undefined variable: errors ~ APPPATH\views\documentos\vista.php [ 18 ]
2011-10-12 14:32:03 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-10-12 14:32:26 --- ERROR: Kohana_Exception [ 0 ]: The hr property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-10-12 15:32:54 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'u.administrativa' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `email`, `id_oficina`, `mosca`, `cargo`, `nombre`, `nivel`, `genero`) VALUES ('u.administrativa', '8fc9086aa8e7c987c8d808ed06cf00f7ab6470e445ed4dbad79bb02fec917c36', 'juan.chavez@produccion.gob.bo', '14', 'JCC', 'Jefe de Unidad', 'Lic. Juan Carlos Chavez', '3', 'hombre') ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]