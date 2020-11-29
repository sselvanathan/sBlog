<?php

declare(strict_types=1);

namespace View;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class Twig
{
    private const TEMPLATE_PATH = '../view/config/Templates/';

    public function renderView(string $view, ?array $params)
    {
        $view = new $view();

        try {
            echo $this->getTwigEnvironment()->render(
                lcfirst($view->getTemplateName()),
                $view->getTemplateData($params)

            );
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            echo $e;
        }
    }

    public function getTwigEnvironment(): Environment
    {
        $loader = new FilesystemLoader(
            self::TEMPLATE_PATH);
        return new Environment($loader);
    }
}