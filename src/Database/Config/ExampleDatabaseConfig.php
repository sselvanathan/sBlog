<?php

declare(strict_types=1);

namespace Database\Config;

class ExampleDatabaseConfig
    /*
     *ToDo
     * -> rename file & classname to DatabaseConfig
     * -> adjust constants
     */
{
    private const USER = 'username';
    private const PASSWORD = 'password';
    private const NAME = 'dbname';
    private const HOST = 'host';
    private const DRIVER = 'driver';

    private function getUser(): string
    {
        return self::USER;
    }

    private function getPassword(): string
    {
        return self::PASSWORD;
    }

    private function getDbName(): string
    {
        return self::NAME;
    }

    private function getHost(): string
    {
        return self::HOST;
    }

    private function getDriver(): string
    {
        return self::DRIVER;
    }

    public function getDbParams()
    {
        return [
            'driver' => $this->getDriver(),
            'user' => $this->getUser(),
            'password' => $this->getPassword(),
            'dbname' => $this->getDbName(),
            'host' => $this->getHost(),
        ];
    }
}
