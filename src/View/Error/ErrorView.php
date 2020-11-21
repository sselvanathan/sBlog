<?php

declare(strict_types=1);

namespace View\Error;

use View\View;

class ErrorView extends View
{

    public function getTemplateName(): string
    {
        return 'ErrorView.twig';
    }

    public function getTemplateData(): array
    {
        return array_merge(
            $this->jsFiles(),
            $this->cssFiles(),
        );
    }

    private function jsFiles(): array
    {
        return [
            "scripts" =>
                [
                    "/sBlog/view/config/Assets/js/error.js",
                ]
        ];
    }

    private function cssFiles(): array
    {
        return [
            "stylesheets" =>
                [
                    "/sBlog/view/config/Assets/scss/content/errorView.min.css",
                ]
        ];
    }
}