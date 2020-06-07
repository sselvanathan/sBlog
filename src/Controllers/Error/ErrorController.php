<?php

    declare(strict_types=1);

    namespace Controllers\Error;

    use Common\Controller;

    class ErrorController extends Controller
    {
        private const ERROR_MODULE = 'Error';

        public function __construct($args)
        {
            parent::__construct(
                [
                    $this->setTemplatePath(self::ERROR_MODULE),
                    $this->setTemplateData(
                        [
                            $this->getModule()
                        ]
                    ),
                ]
            );
        }

        public function getModule()
        {
            return ['module' => self::ERROR_MODULE];
        }

        public function getTwigData()
        {
            // TODO: Implement getTwigData() method.
        }
    }

