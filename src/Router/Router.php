<?php

    declare(strict_types=1);

    namespace Router;

    use Common\Controller;
    use Controllers\Blog\BlogController;
    use Controllers\Home\HomeController;
    use Controllers\Error\ErrorController;

    class Router
    {
        /**
         * @var array
         */
        private $args;
        /**
         * @var string
         */
        private $controllerName;

        public function __construct()
        {
            $uri = ltrim($_SERVER['REQUEST_URI'], '/sBlog/');
            $uriParts = explode('/', $uri);
            $this->controllerName = array_shift($uriParts);
            $this->args = $uriParts;
        }

        public function getController(): Controller
        {
            switch ($this->controllerName) {
                case '' :
                case 'home' :
                    return new HomeController($this->args);
                case 'blog':
                    return new BlogController($this->args);
                default :
                    return new ErrorController($this->args);
            }
        }
    }
