<?php

declare(strict_types=1);

namespace View;

abstract class View
{
    abstract function getTemplateName(): string;

    abstract function getTemplateData(): array;
}
