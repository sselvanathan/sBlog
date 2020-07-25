<?php

declare(strict_types=1);

namespace Project;

class Config
{
    private const PROJECT_NAME = 'sBlog';

    public function getProjectName(): string
    {
        return self::PROJECT_NAME;
    }
}