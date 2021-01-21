<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Controller\NewsConfigController;

class NewsConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new NewsConfigController();
        $controller->setDbAdapter($container->get('application-model-adapter'));
        return $controller;
    }
}