<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Application\Service\Factory\ApplicationModelAdapterFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'news' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/news',
                    'defaults' => [
                        'controller' => Controller\NewsController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'image' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/image',
                            'defaults' => [
                                'action' => 'image',
                                'controller' => Controller\NewsController::class,
                            ],
                        ],
                    ],
                    'config' => [
                        'type' => Segment::class,
                        'priority' => 100,
                        'options' => [
                            'route' => '/config[/:action]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => Controller\NewsConfigController::class,
                            ],
                        ],
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => Controller\NewsController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\NewsController::class => Controller\Factory\NewsControllerFactory::class,
            Controller\NewsConfigController::class => Controller\Factory\NewsConfigControllerFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'home',
                'class' => 'dropdown',
            ],
            'news' => [
                'label' => 'News',
                'route' => 'news/default',
                'class' => 'dropdown',
                'action' => 'index',
                'pages' => [
                    [
                        'label' => 'New Entry',
                        'route' => 'news/default',
                        'resource' =>  'news/default',
                        'action' => 'create',
                        'privilege' => 'create',
                    ],
                    [
                        'label' => 'News Listing',
                        'route' => 'news/default',
                        'resource' => 'news/default',
                        'action' => 'index',
                        'privilege' => 'index',
                    ],
                ],
            ],
            'settings' => [
                'label' => 'Settings',
                'route' => 'home',
                'class' => 'dropdown',
                'order' => 100,
                'pages' => [
                    'user' => [
                        'label'  => 'News Settings',
                        'route'  => 'news/config',
                        'action' => 'index',
                        'resource' => 'news/config',
                        'privilege' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'application-model-adapter-config' => 'model-adapter-config',
        ],
        'factories' => [
            'application-model-adapter' => ApplicationModelAdapterFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../../User/view/layout/user-layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'navigation'              => __DIR__ . '/../view/partials/navigation.phtml',
            'flashmessenger'          => __DIR__ . '/../view/partials/flashmessenger.phtml',
            'application/login'       => __DIR__ . '/../view/partials/login.phtml',
            'image'                   => __DIR__ . '/../view/layout/image_layout.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
