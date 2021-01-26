<?php

declare(strict_types=1);

namespace View\Create;

use JetBrains\PhpStorm\ArrayShape;
use View\View;

class CreateView extends View
{

    public function getTemplateName(): string
    {
        return 'CreateView.twig';
    }

    public function getTemplateData(?array $params): array
    {
        return [''];
    }

    #[ArrayShape(["scripts" => "array"])] protected function jsFiles(): array
    {
        return [
            "scripts" =>
                [
                ]
        ];
    }

    #[ArrayShape(["stylesheets" => "array"])] protected function cssFiles(): array
    {
        return [
            "stylesheets" =>
                [
                ]
        ];
    }
}