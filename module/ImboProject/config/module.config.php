<?php
/**
 * Module config
 *
 * @var array
 */
return array(
    'router' => array(
        // Application routes
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'ImboProject\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),

            'clients' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/clients',
                    'defaults' => array(
                        'controller' => 'ImboProject\Controller\Clients',
                        'action' => 'index',
                    ),
                ),
            ),

            'docs' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/docs',
                    'defaults' => array(
                        'controller' => 'ImboProject\Controller\Docs',
                        'action' => 'index',
                    ),
                ),
            ),

            'contact' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/contact',
                    'defaults' => array(
                        'controller' => 'ImboProject\Controller\Contact',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    // Service manager configuration
    'service_manager' => array(
        'shared' => array(
            'guzzle' => false,
        ),
        'invokables' => array(
            'guzzle' => 'Guzzle\Http\Client',
        ),
        'factories' => array(
            'github' => 'ImboProject\ServiceFactory\GitHubServiceFactory',
            'memcached' => function($sm) {
                // Fetch memcached config
                $config = $sm->get('config')['memcached'];

                $resourceManager = new Zend\Cache\Storage\Adapter\MemcachedResourceManager();
                $resourceManager->addServers('default', $config['servers']);

                $options = new Zend\Cache\Storage\Adapter\MemcachedOptions();
                $options->setResourceManager($resourceManager);
                $options->setNamespace($config['namespace']);

                return new Zend\Cache\Storage\Adapter\Memcached($options);
            },
        ),
    ),

    // Application controllers
    'controllers' => array(
        'invokables' => array(
            'ImboProject\Controller\Index' => 'ImboProject\Controller\IndexController',
            'ImboProject\Controller\Clients' => 'ImboProject\Controller\ClientsController',
            'ImboProject\Controller\Docs' => 'ImboProject\Controller\DocsController',
            'ImboProject\Controller\Contact' => 'ImboProject\Controller\ContactController',
        ),
    ),

    // Controller plugins
    'controller_plugins' => array(
        'invokables' => array(
            'cache' => 'ImboProject\Controller\Plugin\Cache',
        )
    ),

    // Application view helpers
    'view_helpers' => array(
        'invokables' => array(
            'gist' => 'ImboProject\View\Helper\Gist',
            'imboify' => 'ImboProject\View\Helper\Imboify',
        ),
    ),

    // View manager configuration
    'view_manager' => array(
        // Don't display exeption messages per default
        'display_not_found_reason' => false,
        'display_exceptions' => false,

        'doctype' => 'HTML5',

        // Error templates (views)
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',

        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'memcached' => array(
        'namespace' => 'imbo-project.org-20130902-01',
        'servers' => array(
            array('localhost', 11211),
        ),
    ),
);
