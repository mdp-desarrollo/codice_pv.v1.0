<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-13 05:41:09 --- ERROR: Database_Exception [ 0 ]: [1048] Column 'id_documento' cannot be null ( INSERT INTO `nurs_documentos` (`id_documento`, `id_nur`) VALUES (NULL, 3) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-13 07:40:21 --- ERROR: Database_Exception [ 0 ]: [1048] Column 'id_documento' cannot be null ( INSERT INTO `nurs_documentos` (`id_documento`, `id_nur`) VALUES (NULL, 3) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-13 13:48:47 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\admin\oficinas.php [ 34 ]
2011-09-13 14:15:08 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\controller\admin\oficinas.php [ 34 ]
2011-09-13 14:41:09 --- ERROR: ErrorException [ 2 ]: Invalid argument supplied for foreach() ~ APPPATH\views\hojaruta\index.php [ 40 ]
2011-09-13 14:41:41 --- ERROR: ErrorException [ 1 ]: Cannot use object of type stdClass as array ~ APPPATH\views\hojaruta\index.php [ 42 ]
2011-09-13 14:43:07 --- ERROR: ErrorException [ 1 ]: Call to undefined method Database_MySQL_Result::count_all() ~ APPPATH\classes\controller\hojaruta.php [ 33 ]