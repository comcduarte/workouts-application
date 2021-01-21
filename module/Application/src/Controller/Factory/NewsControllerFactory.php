<?php
namespace Application\Controller\Factory;

use Application\Controller\NewsController;
use Application\Form\NewsForm;
use Application\Model\NewsModel;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class NewsControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new NewsController();
        $adapter = $container->get('application-model-adapter');
        $controller->setDbAdapter($adapter);
        $model = new NewsModel($adapter);
        $controller->model = $model;
        $form = new NewsForm();
        $form->init();
        $controller->setForm($form);
        return $controller;
    }
}