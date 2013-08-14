<?php
return array(
    'nombre' => array(
        'not_empty' => 'Ingrese un nombre de oficina.',
        'min_length' => 'El nombre de usuario debe tener al menos: param2 caracteres.',
        'max_length' => 'The username must be less than :param2 characters long.',
        'nombre_available' => 'This username is already in use.',
    ),
    'sigla' => array(
        'not_empty' => 'El campo no deberia estar vacio',
        'sigla_available'=>'Ya existe la Oficina'
    )
);
?>
