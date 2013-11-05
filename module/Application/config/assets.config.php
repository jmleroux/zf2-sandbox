<?php
return array(
    'resolver_configs' => array(
        'collections' => array(
            'js/d.js' => array(
                'js/a.js',
                'js/b.js',
                'js/c.js',
            ),
        ),
        'paths' => array(
            __DIR__ . '/some/particular/directory',
        ),
        'map' => array(
            'specific-path.css' => __DIR__ . '/some/particular/file.css',
        ),
    ),
    'filters' => array(
        'js/d.js' => array(
            array(
                // Note: You will need to require the classes used for the filters yourself.
                'filter' => 'JSMin',
            ),
        ),
    ),
    'caching' => array(
        'js/d.js' => array(
            'cache'     => 'Apc',
        ),
    ),
);
