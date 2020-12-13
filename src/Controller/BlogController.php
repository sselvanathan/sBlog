<?php

declare(strict_types=1);

namespace Controller;

use Action\BlogAction;
use Database\Config\EntityManagerConfig;
use View\Blog\BlogView;
use View\Twig;

class BlogController
{
    public function __construct()
    {
        $blogAction = new BlogAction();
        $entityManager = (new EntityManagerConfig)->createEntityManager();

        $blogAction->createBlogPost($entityManager, $_POST['title'], $_POST['text']);

        $twig = new Twig();
        $twig->renderView(BlogView::class, [
                'id' => $blogAction->getLatestBlogPost($entityManager)->getId()
            ]
        );
    }
}