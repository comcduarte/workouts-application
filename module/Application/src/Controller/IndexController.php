<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Form\UserLoginForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $view = new ViewModel();
        
        $form = new UserLoginForm();
        $form->init();
        $view->setVariable('form', $form);
        
        return $view;
    }
    
    public function workoutAction()
    {
        $view = new ViewModel();
        return $view;
    }
}
