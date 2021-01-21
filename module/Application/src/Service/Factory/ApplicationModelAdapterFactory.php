<?php
namespace Application\Service\Factory;

use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class ApplicationModelAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = new Adapter($container->get('application-model-adapter-config'));
        return $adapter;
    }
}