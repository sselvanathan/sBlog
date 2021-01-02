<?php

declare(strict_types=1);

namespace View;

abstract class View
{
    abstract function getTemplateName(): string;

    abstract function getTemplateData(?array $params): ?array;

    abstract protected function jsFiles(): array;

    abstract protected function cssFiles(): array;
}
