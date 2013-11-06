<?php

return array(
    'routes' => array(
        'home' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'index',
                ),
            ),
        ),
        'foo' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/foo',
                'defaults' => array(
                    'controller' => 'Application\Controller\Index',
                    'action' => 'foo',
                ),
            ),
        ),
        'bar' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/bar',
                'defaults' => array(
                    'controller' => 'Application\Controller\Bar',
                    'action' => 'index',
                ),
            ),
        ),
    ),
);
