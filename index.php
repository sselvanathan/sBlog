<?php

use Controller\Error\ErrorController;
use Router\NoRouteMatchedException;
use Router\Router;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

require 'vendor/autoload.php';

try {
    $controller = (new Router)->getControllerWithArgs();
} catch (NoRouteMatchedException $exception) {
    $controller = new ErrorController();
}

try {
    echo $controller->getTwigEnvironment()->render(
        $controller->getTemplatePath(),
        $controller->getTemplateData()
    );
} catch (LoaderError | RuntimeError  | SyntaxError $e) {
    echo $e;
}
