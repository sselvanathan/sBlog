<?php

declare(strict_types=1);

namespace View\Home;

use JetBrains\PhpStorm\ArrayShape;
use Project\Config\Config;
use View\View;
use Database\Config\EntityManagerConfig;

class HomeView extends View
{
    public const BLOG_ENTITY_PATH = 'Database\Entities\BlogEntity';

    public function getTemplateName(): string
    {
        return 'HomeView.twig';
    }

    #[ArrayShape(['allBlogPosts' => "array"])] public function getTemplateData(?array $params): ?array
    {
            return array_merge(
                $this->jsFiles(),
                $this->cssFiles(),
                $this->getAllBlogPosts(),
            );
    }

    #[ArrayShape(["scripts" => "array"])] private function jsFiles(): array
    {
        return [
            "scripts" =>
                [
                    Config::getPublicDirectory() . "js/blog.js",
                ]
        ];
    }

    #[ArrayShape(["stylesheets" => "array"])] private function cssFiles(): array
    {
        return [
            "stylesheets" =>
                [
                ]
        ];
    }

    #[ArrayShape(['allBlogPosts' => "array"])] public function getAllBlogPosts(): array
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
