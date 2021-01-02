<?php

declare(strict_types=1);

namespace Controller;

use Database\Config\EntityManagerConfig;
use View\Home\HomeView;
use View\Twig;

class DeleteBlogController
{
    public function __construct()
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        DeleteBlogController::deleteBlogPost($entityManager, (int)$_REQUEST['id']);

        $twig = new Twig();
        $twig->renderView(HomeView::class);
    }

    public function deleteBlogPost($entityManager, $id)
    {
        $blog = $entityManager
            ->getRepository(HomeView::BLOG_ENTITY_PATH)
            ->findBy(['id' => $id])[0];

        $entityManager->remove($blog);
        $entityManager->flush();
    }
}