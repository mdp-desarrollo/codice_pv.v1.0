<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-21 10:29:17 --- ERROR: ErrorException [ 8 ]: Undefined variable: count ~ APPPATH\views\ventanilla\listar.php [ 24 ]
2011-09-21 10:29:40 --- ERROR: ErrorException [ 8 ]: Undefined index: tipo ~ APPPATH\views\ventanilla\listar.php [ 46 ]
2011-09-21 10:29:53 --- ERROR: ErrorException [ 8 ]: Undefined index: estado ~ APPPATH\views\ventanilla\listar.php [ 51 ]
2011-09-21 10:30:29 --- ERROR: ErrorException [ 8 ]: Undefined variable: page_links ~ APPPATH\views\ventanilla\listar.php [ 64 ]
2011-09-21 11:01:07 --- ERROR: ErrorException [ 1 ]: Call to undefined function timestamp() ~ APPPATH\views\ventanilla\listar.php [ 49 ]
2011-09-21 11:02:21 --- ERROR: ErrorException [ 1 ]: Call to undefined function timestamp() ~ APPPATH\views\ventanilla\listar.php [ 49 ]
2011-09-21 11:02:34 --- ERROR: ErrorException [ 1 ]: Call to undefined function timestamp() ~ APPPATH\views\ventanilla\listar.php [ 49 ]
2011-09-21 11:02:43 --- ERROR: ErrorException [ 1 ]: Call to undefined function timestamp() ~ APPPATH\views\ventanilla\listar.php [ 49 ]
2011-09-21 11:22:11 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50
            ORDER BY d.fecha DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:22:17 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha_creacion DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50
            ORDER BY d.fecha_creacion DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:22:19 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha_creacion DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50
            ORDER BY d.fecha_creacion DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:23:02 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha_creacion DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50
            ORDER BY d.fecha_creacion DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:23:22 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY de.fecha DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50
            ORDER BY de.fecha DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:23:57 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha_creacion DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50 
            ORDER BY d.fecha_creacion DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:23:58 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha_creacion DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50 
            ORDER BY d.fecha_creacion DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-21 11:23:59 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.fecha_creacion DESC' at line 9 ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'
            LIMIT 0,50 
            ORDER BY d.fecha_creacion DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]