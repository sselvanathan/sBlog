<?php

declare(strict_types=1);

namespace View\Home;

use View\View;
use Database\Config\EntityManagerConfig;

class HomeView extends View
{
    public const BLOG_ENTITY_PATH = 'Database\Entities\BlogEntity';

    public function getTemplateName(): string
    {
        return 'HomeView.twig';
    }

    public function getTemplateData(): array
    {
        return $this->getAllBlogPosts();
    }

    public function getAllBlogPosts(): array
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        $blogPostRepository = $entityManager->getRepository(self::BLOG_ENTITY_PATH);
        $blogPosts = $blogPostRepository->findAll();
        $allBlogPosts = [];

        foreach ($blogPosts as $blogPost) {
            $allBlogPosts[] = [
                "id" => $blogPost->getId(),
                "title" => $blogPost->getTitle(),
                "post" => $blogPost->getPost(),
                "created_at" => $blogPost->getCreatedAt(),
            ];
        }
        return ['allBlogPosts' => $allBlogPosts];
    }
}
