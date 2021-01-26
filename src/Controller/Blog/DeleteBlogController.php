<?php

declare(strict_types=1);

namespace Controller\Blog;

use Core\Request\Request;
use Database\Config\EntityManagerConfig;
use Model\Blog\BlogModel;
use View\Home\HomeView;
use View\Twig;

class DeleteBlogController
{
    public function __construct()
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        $blogModel = new BlogModel();
        $blogModel->loadData((new Request)->getRequestData());
        DeleteBlogController::deleteBlogPost($entityManager, $blogModel->getId());
        (new Twig())->renderView(HomeView::class);
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
