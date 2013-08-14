<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-06-07 12:14:10 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'usuarios.id' in 'on clause' [ SELECT `users`.* FROM `users` INNER JOIN `vias` ON (`usuarios`.`id` = `vias`.`id_usuario`) WHERE `vias`.`id_usuario` = '2' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-06-07 12:20:13 --- ERROR: ErrorException [ 1 ]: Call to undefined method Database_Query_Builder_Select::find_all() ~ APPPATH\classes\controller\generar.php [ 63 ]
2011-06-07 15:28:29 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\documentos\create.php [ 98 ]
2011-06-07 15:28:33 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\documentos\create.php [ 98 ]
2011-06-07 15:28:46 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\documentos\create.php [ 164 ]
2011-06-07 15:29:52 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH\views\documentos\create.php [ 164 ]
2011-06-07 15:38:53 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ APPPATH\views\documentos\create.php [ 98 ]
2011-06-07 15:44:34 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH\views\documentos\create.php [ 210 ]
2011-06-07 18:04:17 --- ERROR: ErrorException [ 1 ]: Call to undefined function decrypt() ~ APPPATH\views\documentos\create.php [ 116 ]
2011-06-07 18:07:09 --- ERROR: ErrorException [ 1 ]: Call to undefined function Decrypt() ~ APPPATH\views\documentos\create.php [ 116 ]