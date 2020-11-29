<?php

declare(strict_types=1);

namespace Core\Request;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }
        return substr($path, 0, $position);

    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getParams(): ?array
    {
        return (isset($_GET)) ? $_GET : null;
    }

    public function getPost()
    {
        
    }
}