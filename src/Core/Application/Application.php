<?php

declare(strict_types=1);

namespace Core\Application;

use Core\Request\Request;
use Core\Routing\Router;

class Application
{
    public Router $router;
    private Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
}