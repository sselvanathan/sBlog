<?php

declare(strict_types=1);

use Core\Application\Application;
use View\Home\HomeView;
use View\Blog\BlogView;

require '../vendor/autoload.php';

$app = new Application();

$app->router->get('/', HomeView::class);
$app->router->get('/blog', BlogView::class);

$app->run();