<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-01-07 14:48:44 --- ERROR: ErrorException [ 1 ]: Call to undefined method ArrayIterator::hasNext() ~ APPPATH\classes\controller\busqueda.php [ 82 ]
2012-01-07 14:52:49 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH\classes\controller\busqueda.php [ 99 ]
2012-01-07 15:06:32 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.nur' in 'where clause' ( SELECT COUNT(*) as count  FROM documentos  WHERE d.nur LIKE '%23%'  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-07 15:46:50 --- ERROR: ErrorException [ 8 ]: Undefined index: buscar ~ APPPATH\classes\controller\busqueda.php [ 36 ]
2012-01-07 19:36:50 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 's.fecha_derivacion' in 'where clause' ( SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.derivado_por='5'
        AND s.estado BETWEEN '1' and '4'   
        and d.original=1
        AND s.fecha_derivacion BETWEEN '2012-01-07 00:00:00' AND '2012-01-07 23:59:00' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-07 19:36:58 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 's.fecha_derivado' in 'where clause' ( SELECT s.nur,s.nombre_receptor,s.cargo_receptor,s.nombre_emisor,s.cargo_emisor,s.fecha_emision, s.fecha_recepcion,s.proveido,d.codigo FROM seguimiento s
        INNER JOIN documentos d ON s.nur=d.nur
        WHERE s.derivado_por='5'
        AND s.estado BETWEEN '1' and '4'   
        and d.original=1
        AND s.fecha_derivado BETWEEN '2012-01-07 00:00:00' AND '2012-01-07 23:59:00' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-01-07 19:56:36 --- ERROR: ErrorException [ 8 ]: Undefined variable: if_oficina ~ APPPATH\views\reportes\vista2.php [ 7 ]