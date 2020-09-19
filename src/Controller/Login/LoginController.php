<?php

declare(strict_types=1);

namespace Controller\Login;

use Controller\Controller;

class LoginController extends Controller
{
    private const MODULE = 'Login';

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