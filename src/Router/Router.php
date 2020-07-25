<?php

declare(strict_types=1);

namespace Router;

use Project\Config;

class Router
{
    protected array $args;

    protected string $controllerName;

    public function getControllerWithArgs()
    {
        $uri = str_replace('/ ' . (new Config)->getProjectName() . '/', '', $_SERVER['REQUEST_URI']);
        $uriParts = explode('/', $uri);
        array_shift($uriParts);
        $this->controllerName = ucfirst($uriParts[0]);
        $controller = $this->getControllerNamespace();

        return new $controller($uriParts);
    }

    private function getControllerNamespace(): string
    {
        if ($this->controllerName === '') {
            $this->controllerName = 'Home';
        }

        return 'Controllers\\' . $this->controllerName . '\\' . $this->controllerName . 'Controller';
    }
}
