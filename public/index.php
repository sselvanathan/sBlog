<?php

declare(strict_types=1);

use Controller\Blog\CreateBlogController;
use Controller\Blog\DeleteBlogController;
use Controller\User\LoginUserController;
use Controller\User\RegisterUserController;
use Core\Application\Application;
use View\Blog\BlogView;
use View\Create\CreateView;
use View\Home\HomeView;

require '../vendor/autoload.php';

$app = new Application();

$app->router->get('/', HomeView::class);
$app->router->get('/blog', BlogView::class);
$app->router->get('/createBlog', CreateView::class);
$app->router->post('/createBlog', CreateBlogController::class);
$app->router->delete('/deleteBlog', DeleteBlogController::class);

$app->run();