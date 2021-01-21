<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Application\Model\NewsModel;
use Laminas\Db\Adapter\AdapterAwareTrait;
use Laminas\Db\Sql\Where;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use User\Form\UserLoginForm;

class IndexController extends AbstractActionController
{
    use AdapterAwareTrait;
    
    public function indexAction()
    {
        $view = new ViewModel();
        
        $form = new UserLoginForm();
        $form->init();
        $view->setVariable('form', $form);
        
        $news = new NewsModel($this->adapter);
        $articles = $news->fetchAll(new Where(), ['DATE_MODIFIED']);
        $view->setVariable('news', $articles[0]);
        
        return $view;
    }
    
    public function workoutAction()
    {
        $view = new ViewModel();
        return $view;
    }
}
