<?php

declare(strict_types=1);

namespace View\Error;

use JetBrains\PhpStorm\ArrayShape;
use Project\Config\Config;
use View\View;

class ErrorView extends View
{

    public function getTemplateName(): string
    {
        return 'ErrorView.twig';
    }

    public function getTemplateData($params): ?array
    {
        return array_merge(
            $this->jsFiles(),
            $this->cssFiles(),
        );
    }

    #[ArrayShape(["scripts" => "string[]"])] protected function jsFiles(): array
    {
        return [
            "scripts" =>
                [
                    Config::getPublicDirectory() . "js/error.js",
                ]
        ];
    }

    #[ArrayShape(["stylesheets" => "string[]"])] protected function cssFiles(): array
    {
        return [
            "stylesheets" =>
                [
                    Config::getPublicDirectory() . "scss/content/errorView.min.css",
                ]
        ];
    }
}