<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-01 09:31:16 --- ERROR: ErrorException [ 8 ]: Undefined variable: grupos ~ APPPATH\views\documentos\reception.php [ 116 ]
2011-09-01 10:57:28 --- ERROR: ErrorException [ 8 ]: Undefined variable: procesos ~ APPPATH\views\documentos\reception.php [ 130 ]
2011-09-01 13:34:18 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'activo' in 'where clause' ( SELECT `procesos`.* FROM `procesos` WHERE `activo` = 1 ORDER BY `procesos`.`proceso` ASC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-01 13:36:38 --- ERROR: ErrorException [ 4096 ]: Argument 2 passed to Kohana_Form::select() must be an array, string given, called in C:\xampp\htdocs\paperwork\application\views\documentos\reception.php on line 144 and defined ~ SYSPATH\classes\kohana\form.php [ 252 ]