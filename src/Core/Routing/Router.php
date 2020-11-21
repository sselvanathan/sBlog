<?php

declare(strict_types=1);

namespace Core\Routing;

use Core\Request\Request;
use Core\Response\Response;
use View\Error\ErrorView;
use View\Twig;

class Router
{
    public Request $request;
    protected array $routes = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function resolve(): void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;


        if (!$callback) {
            new Response(Response::RESPONSE_NOT_FOUND);
            $callback = ErrorView::class;
        }

        if (is_string($callback)) {
            $twig = new Twig();
            $twig->renderView($callback);
        }
    }


    public function get(string $path, string $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
}
