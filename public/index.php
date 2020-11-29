<?php

declare(strict_types=1);

use Controller\BlogController;
use Core\Application\Application;
use View\Blog\BlogView;
use View\Create\CreateView;
use View\Home\HomeView;

require '../vendor/autoload.php';

$app = new Application();

$app->router->get('/', HomeView::class);
$app->router->get('/blog', BlogView::class);
$app->router->get('/create', CreateView::class);
$app->router->post('/create', [BlogController::class, 'handleNewBlogPost']);

$app->run();