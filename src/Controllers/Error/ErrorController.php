<?php

    declare(strict_types=1);

    namespace Controllers\Error;

    use Common\Controller;
    use Common\ControllerInterface;

    class ErrorController extends Controller implements ControllerInterface
    {
        private const MODULE = 'Error';

        public function __construct($args)
        {
            parent::__construct(
                [
                    $this->setTemplatePath(self::MODULE),
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
            return ['module' => self::MODULE];
        }

        public function getTwigData()
        {
            // TODO: Implement getTwigData() method.
        }
    }

