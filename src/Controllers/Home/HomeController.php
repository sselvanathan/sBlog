<?php

declare(strict_types=1);

namespace Controllers\Home;

use Common\Controller;
use Controllers\Blog\BlogController;
use Database\Config\EntityManagerConfig;

class HomeController extends Controller
{
    private const MODULE = 'Home';

    public function __construct()
    {
        parent::__construct(
            [
                $this->setTemplatePath(self::MODULE),
                $this->setTemplateData(
                    $this->getTwigData()
                ),
            ]
        );
    }

    public function getModule(): array
    {
        return ['module' => self::MODULE];
    }

    public function getTwigData(): array
    {
        return array_merge(
            $this->getModule(),
            $this->getAllBlogPosts()
        );
    }

    public function getAllBlogPosts()
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        $blogPostRepository = $entityManager->getRepository(BlogController::BLOG_ENTITY_PATH);
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

