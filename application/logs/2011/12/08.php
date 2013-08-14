<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-12-08 14:30:01 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.citeOriginal' in 'field list' ( SELECT d.id, d.codigo, d.citeOriginal, d.estado, d.nombreDestinatario,d.cargoDestinatario, d.institucionDestinatario, d.nombreRemitente,d.cargoRemitente,d.institucionRemitente, d.referencia,d.adjuntos, d.nroHojas, d.nur, d.id_nur,de.fecha, g.grupo,m.motivo,p.proceso FROM documentos d 
            INNER JOIN descripcion de ON d.id=de.id_documento
            INNER JOIN grupos g ON de.id_grupo=g.id
            INNER JOIN motivos m ON de.id_motivo=m.id
            INNER JOIN procesosx p ON de.id_proceso=p.id
            WHERE d.id_user='5'
            AND d.id_tipo='6'             
            ORDER BY d.fecha_creacion DESC
            LIMIT 0,50 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]