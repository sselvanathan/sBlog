<?php

declare(strict_types=1);

namespace Controller\Create;

use Controller\Controller;

class CreateController extends Controller
{
    private const MODULE = 'Create';

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

    public function getTwigData(): array
    {
        return array_merge(
            $this->getModule()
        );
    }
}