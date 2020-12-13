<?php

declare(strict_types=1);

namespace Project;

class Config
{
    private const PROJECT_NAME = 'sBlog';

    private const PUBLIC_PATH = '/sBlog/public/';

    public static function getProjectName(): string
    {
        return self::PROJECT_NAME;
    }

    public static function getPublicDirectory(): string
    {
        return self::PUBLIC_PATH;
    }
}