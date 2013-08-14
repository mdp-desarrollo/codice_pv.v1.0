<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'database' => array(
		'group'   => 'default',
		'table'   => 'sessions',
		'gc'      => 500,
		'columns' => array(
			/**
			 * session_id:  session identifier
			 * last_active: timestamp of the last activity
			 * contents:    serialized session data
			 */
			'session_id'  => 'session_id',
			'last_active' => 'last_active',
			'contents'    => 'contents'
		),
	),
    'cookie' => array(
        'name' => 'session_cookie',
        'encrypted' => TRUE,
        'lifetime' => 108000,
    ),
    'native' => array(
        'name' => 'session_native',
        'encrypted' => TRUE,
        'lifetime' => 108000,
    ),
);
