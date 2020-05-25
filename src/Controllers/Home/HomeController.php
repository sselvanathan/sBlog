<?php

declare(strict_types=1);

namespace Controllers\Home;

use Common\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct(
            [
                $this->setTemplatePath('home'),
                $this->setTemplateData(
                    ['module' => 'Home']
                ),
            ]
        );
    }
}

