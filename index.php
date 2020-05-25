<?php

use Router\Router;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

require 'vendor/autoload.php';
require 'autoload.php';

$controller = (new Router())->getController();

try {
    echo $controller->getTwigEnvironment()->render(
        $controller->getTemplatePath(),
        $controller->getTemplateData()
    );
} catch (LoaderError | RuntimeError  | SyntaxError $e) {
    echo $e;
}
