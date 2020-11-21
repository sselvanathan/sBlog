<?php

declare(strict_types=1);

namespace Core\Response;

class Response

{
    public const RESPONSE_NOT_FOUND = 404;
    public const RESPONSE_OK = 200;

    public function __construct($response)
    {
        $this->setStatusCode($response);
    }

    protected function setStatusCode(int $code): int
    {
        return $code
            ? http_response_code($code)
            : http_response_code(self::RESPONSE_NOT_FOUND);
    }
}
