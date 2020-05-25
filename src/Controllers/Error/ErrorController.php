<?php

declare(strict_types=1);

namespace Controllers\Error;

use Common\Controller;

class ErrorController extends Controller
{
    public function __construct()
    {
        parent::__construct(
            [
                $this->setTemplatePath('error'),
                $this->setTemplateData(
                    ['module' => 'Error']
                ),
            ]
        );
    }
}

