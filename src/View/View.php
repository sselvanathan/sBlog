<?php

declare(strict_types=1);

namespace View;

use JetBrains\PhpStorm\ArrayShape;

abstract class View
{
    abstract public function getTemplateName(): string;

    abstract public function getTemplateData(?array $params): ?array;

    #[ArrayShape(["scripts" => "array"])] abstract protected function jsFiles(): array;

    #[ArrayShape(["stylesheets" => "array"])] abstract protected function cssFiles(): array;
}
