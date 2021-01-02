<?php

declare(strict_types=1);

namespace Core\Request;

use JetBrains\PhpStorm\Pure;

class Request
{
    #[Pure] public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }
        return substr($path, 0, $position);

    }

    #[Pure] public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getParameter(): ?array
    {
        $parameter = [];
        parse_str($_SERVER['QUERY_STRING'],$parameter);
        return (isset($_GET)) ? $parameter : null;
    }
}