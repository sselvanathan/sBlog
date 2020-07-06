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
            $uriParts = explode('/', $_SERVER['REQUEST_URI']);

            foreach ($uriParts as $uriPart){
                if ($uriPart === "") {
                    unset($uriPart);
                } else {
                    $refactoredUriParts[] = $uriPart;
                }
            }

            $refactoredUriParts = (empty($refactoredUriParts)) ? [''] : $refactoredUriParts;

            $this->controllerName = array_shift($refactoredUriParts);

             $this->args = $refactoredUriParts;
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
