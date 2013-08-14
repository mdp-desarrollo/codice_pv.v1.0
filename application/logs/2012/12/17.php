<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-12-17 12:07:24 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'ar.nivel' in 'field list' ( SELECT car.id,car.carpeta,car.fecha_creacion,ar.nivel,ofi.sigla,ofi.oficina
FROM carpetas AS car INNER JOIN oficinas AS ofi ON car.id_oficina = ofi.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-12-17 12:24:03 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'ar.nivel' in 'field list' ( SELECT car.id,car.carpeta,car.fecha_creacion,ar.nivel,ofi.sigla,ofi.oficina
FROM carpetas AS car INNER JOIN oficinas AS ofi ON car.id_oficina = ofi.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-12-17 14:58:07 --- ERROR: ErrorException [ 8 ]: Undefined variable: mensaje ~ APPPATH\views\admin\add_carpeta.php [ 7 ]
2012-12-17 14:59:33 --- ERROR: ErrorException [ 8 ]: Undefined variable: errors ~ APPPATH\views\admin\add_carpeta.php [ 8 ]
2012-12-17 15:01:46 --- ERROR: ErrorException [ 8 ]: Undefined index: entidad ~ APPPATH\classes\controller\admin\carpetas.php [ 49 ]
2012-12-17 15:07:46 --- ERROR: ErrorException [ 8 ]: Undefined index: sigla ~ APPPATH\classes\controller\admin\carpetas.php [ 51 ]
2012-12-17 15:12:45 --- ERROR: ErrorException [ 8 ]: Undefined variable: oficina ~ APPPATH\classes\controller\admin\carpetas.php [ 58 ]