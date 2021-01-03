<?php

declare(strict_types=1);

namespace Controller;

use Core\Request\Request;
use Database\Config\EntityManagerConfig;
use View\Home\HomeView;

class DeleteBlogController
{
    public function __construct()
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        $requestData = (new Request())->getRequestData();

        DeleteBlogController::deleteBlogPost($entityManager, (int)$requestData['id']);
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