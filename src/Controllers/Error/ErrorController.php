<?php

declare(strict_types=1);

namespace Controllers\Error;

use Common\Controller;
use Common\ControllerInterface;

class ErrorController extends Controller implements ControllerInterface
{
    public function __construct()
    {
        parent::__construct(
            [
                $this->setTemplatePath('error'),
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
        return ['module' => 'Error'];
    }

    public function getTwigData()
    {
        // TODO: Implement getTwigData() method.
    }
}

