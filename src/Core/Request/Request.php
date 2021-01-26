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
        $parameter = $value = [];
        parse_str($_SERVER['QUERY_STRING'], $parameter);
        parse_str($_SERVER['QUERY_STRING'], $value);

        $value = reset($parameter);


        return (isset($_GET)) ? $parameter : null;
    }

    #[Pure] public function getRequestData(): array
    {
        $body = [];

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $requestData[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $requestData[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'delete') {
            foreach ($_REQUEST as $key => $value) {
                $requestData[$key] = $this->stringToInt(filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        return $body;
    }

    #[Pure] public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    #[Pure] public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    #[Pure] public function stringToInt(string $string): int|string
    {
         if (is_numeric($string)){
             return (int)$string;
         }
         return $string;
    }
}
