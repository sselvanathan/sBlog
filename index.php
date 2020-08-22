<?php

use Controllers\Error\ErrorController;
use Router\NoRouteMatchedException;
use Router\Router;

require 'vendor/autoload.php';

try {
    $controller = (new Router)->getControllerWithArgs();
} catch (NoRouteMatchedException $exception) {
    $controllers = new ErrorController();
}

var_dump($controller->getTemplateData());

echo $controller->getTwigEnvironment()->render(
    $controller->getTemplatePath(),
    $controller->getTemplateData()
);
