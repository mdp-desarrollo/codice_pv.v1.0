<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-11-28 07:53:18 --- ERROR: ErrorException [ 8 ]: Undefined variable: nur ~ APPPATH\classes\controller\seguimiento.php [ 97 ]
2011-11-28 07:54:33 --- ERROR: Kohana_Exception [ 0 ]: The nombre_restinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-28 07:54:44 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nombreDestinatario' in 'field list' ( SELECT d.id as id_doc, d.codigo as documento, d.nombreDestinatario as destinatario, d.cargoDestinatario as cargo, d.referencia, d.nombreRemitente as remitente, d.cargoRemitente as cargo_r,
        h.fecha, a.codigo as nur,t.tipo, p.proceso FROM documentos d
        INNER JOIN hojasruta h ON h.id_documento=d.id
        INNER JOIN asignados a ON h.id_nur=a.id
        INNER JOIN tipos t ON t.id=d.id_tipo
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE h.id_nur='I/2011-00001'
        and h.id_seguimiento='-1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-28 07:56:24 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'h.nur' in 'where clause' ( SELECT d.id as id_doc, d.codigo as documento, d.nombre_destinatario as destinatario, d.cargo_destinatario as cargo, d.referencia, d.nombre_remitente as remitente, d.cargo_remitente as cargo_r,
        h.fecha, a.codigo as nur,t.tipo, p.proceso FROM documentos d
        INNER JOIN hojasruta h ON h.id_documento=d.id
        INNER JOIN asignados a ON h.id_nur=a.id
        INNER JOIN tipos t ON t.id=d.id_tipo
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE h.nur='I/2011-00001'
        and h.id_seguimiento='-1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-28 07:57:49 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'h.id_nur' in 'on clause' ( SELECT d.id as id_doc, d.codigo as documento, d.nombre_destinatario as destinatario, d.cargo_destinatario as cargo, d.referencia, d.nombre_remitente as remitente, d.cargo_remitente as cargo_r,
        h.fecha, a.codigo as nur,t.tipo, p.proceso FROM documentos d
        INNER JOIN hojasruta h ON h.id_documento=d.id
        INNER JOIN asignados a ON h.id_nur=a.id
        INNER JOIN tipos t ON t.id=d.id_tipo
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE h.nur='I/2011-00001'
        and h.id_seguimiento='-1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-28 07:57:51 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'h.id_nur' in 'on clause' ( SELECT d.id as id_doc, d.codigo as documento, d.nombre_destinatario as destinatario, d.cargo_destinatario as cargo, d.referencia, d.nombre_remitente as remitente, d.cargo_remitente as cargo_r,
        h.fecha, a.codigo as nur,t.tipo, p.proceso FROM documentos d
        INNER JOIN hojasruta h ON h.id_documento=d.id
        INNER JOIN asignados a ON h.id_nur=a.id
        INNER JOIN tipos t ON t.id=d.id_tipo
        INNER JOIN procesos p ON p.id=h.id_proceso
        WHERE h.nur='I/2011-00001'
        and h.id_seguimiento='-1' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-28 09:03:11 --- ERROR: ErrorException [ 8 ]: Undefined index: txt_buscar ~ APPPATH\classes\controller\buscar.php [ 36 ]
2011-11-28 09:03:35 --- ERROR: ErrorException [ 8 ]: Undefined index: txt_buscar ~ APPPATH\classes\controller\buscar.php [ 36 ]
2011-11-28 09:03:41 --- ERROR: ErrorException [ 8 ]: Object of class Database_MySQL_Result could not be converted to int ~ SYSPATH\classes\kohana\pagination.php [ 162 ]
2011-11-28 09:03:55 --- ERROR: ErrorException [ 8 ]: Object of class Database_MySQL_Result could not be converted to int ~ SYSPATH\classes\kohana\pagination.php [ 162 ]
2011-11-28 09:06:34 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\classes\controller\buscar.php [ 38 ]
2011-11-28 09:07:38 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.tipo        
        FROM documentos INNER JOIN tipos t ON d.id_tipo=t.id
     ' at line 1 ( SELECT d.id, d.codigo, d.nombre_destinatario, d.cargo_destinatario, d.nombre_remitente,d.cargo_remitente,d.referencia,d.fecha_creacion t.tipo        
        FROM documentos INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.codigo like '%15%'
        OR d.nur like '%15%'
        OR d.referencia like '%15%'
        LIMIT 0,15 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-28 09:08:20 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.tipo        
        FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id
   ' at line 1 ( SELECT d.id, d.codigo, d.nombre_destinatario, d.cargo_destinatario, d.nombre_remitente,d.cargo_remitente,d.referencia,d.fecha_creacion t.tipo        
        FROM documentos d INNER JOIN tipos t ON d.id_tipo=t.id
        WHERE d.codigo like '%15%'
        OR d.nur like '%15%'
        OR d.referencia like '%15%'
        LIMIT 0,15 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-11-28 09:09:18 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\views\busqueda\result.php [ 28 ]
2011-11-28 09:11:37 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\views\busqueda\result.php [ 28 ]
2011-11-28 09:12:11 --- ERROR: ErrorException [ 8 ]: Undefined variable: tipo ~ APPPATH\views\busqueda\result.php [ 32 ]
2011-11-28 09:12:45 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\busqueda\result.php [ 57 ]
2011-11-28 09:14:36 --- ERROR: ErrorException [ 8 ]: Undefined index: nur ~ APPPATH\views\busqueda\result.php [ 71 ]
2011-11-28 14:04:47 --- ERROR: ErrorException [ 8 ]: Undefined variable: id_nur ~ APPPATH\classes\controller\hojaruta.php [ 175 ]
2011-11-28 17:01:49 --- ERROR: Database_Exception [ 0 ]: [2000] mysqlnd cannot connect to MySQL 4.1+ using the old insecure authentication. Please use an administration tool to reset your password with the command SET PASSWORD = PASSWORD('your_existing_password'). This will store a new, and more secure, hash value in mysql.user. If this user is used in other scripts executed by PHP 5.2 or earlier you might need to remove the old-passwords flag from your my.cnf file ~ MODPATH\database\classes\kohana\database\mysql.php [ 67 ]
2011-11-28 17:02:28 --- ERROR: Database_Exception [ 0 ]: [2000] mysqlnd cannot connect to MySQL 4.1+ using the old insecure authentication. Please use an administration tool to reset your password with the command SET PASSWORD = PASSWORD('your_existing_password'). This will store a new, and more secure, hash value in mysql.user. If this user is used in other scripts executed by PHP 5.2 or earlier you might need to remove the old-passwords flag from your my.cnf file ~ MODPATH\database\classes\kohana\database\mysql.php [ 67 ]
2011-11-28 17:14:08 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwork.seguimientos' doesn't exist ( SELECT DISTINCT s.codigo, s.derivado_por,s.derivado_a 
            FROM seguimientos s, usuarios u
            WHERE derivado_a='direccion.juridica'
            and f_derivacion BETWEEN '2011-10-01' AND '2011-11-28'
            and s.derivado_por=u.id_usuario
            and u.oficina NOT LIKE '%DAJ%'
             ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]