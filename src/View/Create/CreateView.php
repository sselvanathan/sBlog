<?php

declare(strict_types=1);

namespace View\Create;

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
}