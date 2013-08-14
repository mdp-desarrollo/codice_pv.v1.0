<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-11-27 05:49:27 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 746 ]
2011-11-27 05:49:58 --- ERROR: Kohana_Exception [ 0 ]: The nombreDestinatario property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-11-27 06:00:14 --- ERROR: Kohana_Exception [ 0 ]: The hojas property does not exist in the Model_Documentos class ~ MODPATH\orm\classes\kohana\orm.php [ 746 ]
2011-11-27 13:49:55 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'n.id' in 'on clause' ( SELECT s.id, n.nur FROM seguimiento s
             INNER JOIN nurs n ON s.nur=n.id
             WHERE s.id='125' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]