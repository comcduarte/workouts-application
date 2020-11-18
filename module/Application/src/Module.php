<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

class Module
{
    const TITLE = "Middletown Workouts & Wellness";
    const VERSION = "v0.0.2";
    
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
