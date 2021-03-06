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

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $params = $this->request->getParameter();
        $callback = $this->routes[$method][$path] ?? false;


        if (!$callback) {
            new Response(Response::RESPONSE_NOT_FOUND);
            $callback = ErrorView::class;
        }

        if ($method === "get") {
            $twig = new Twig();
            $twig->renderView($callback, $params);
            return;
        }

        new $callback;
    }

    public function get(string $path, string $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, string $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function delete(string $path, string $callback)
    {
        $this->routes['delete'][$path] = $callback;
    }
}
