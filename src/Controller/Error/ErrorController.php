<?php

declare(strict_types=1);

namespace Controller\Error;

use Controller\Controller;

class ErrorController extends Controller
{
    private const MODULE = 'Error';

    public function __construct()
    {
        parent::__construct(
            [
                $this->setTemplatePath(self::MODULE),
                $this->setTemplateData(
                    $this->getTwigData()
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
        return array_merge(
            $this->getModule(),
        );
    }
}

