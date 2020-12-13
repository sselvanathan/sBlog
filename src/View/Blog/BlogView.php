<?php

declare(strict_types=1);

namespace View\Blog;

use Database\Config\EntityManagerConfig;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use JetBrains\PhpStorm\ArrayShape;
use View\View;

class BlogView extends View
{
    public const BLOG_ENTITY_PATH = 'Database\Entities\BlogEntity';

    function getTemplateName(): string
    {
        return 'BlogView.twig';
    }

    public function getTemplateData(?array $params): ?array
    {
        try {
            return array_merge(
                $this->jsFiles(),
                $this->cssFiles(),
                $this->getBlogPostById((int)$params['id']),
            );
        } catch (PostNotFoundException $e) {
            echo $e;
        }
        return null;
    }

    #[ArrayShape(["scripts" => "array"])] private function jsFiles(): array
    {
        return [
            "scripts" =>
                [
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

    /**
     * @param int $id
     * @return array
     * @throws PostNotFoundException
     */
    #[ArrayShape(['blogPost' => "array"])] public function getBlogPostById(int $id): array
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        try {
            $blogPostObject = $entityManager->find(self::BLOG_ENTITY_PATH, $id);
            $blogPost = [
                "id" => $blogPostObject->getId(),
                "title" => $blogPostObject->getTitle(),
                "post" => $blogPostObject->getPost(),
                "created_at" => $blogPostObject->getCreatedAt(),
            ];
            return ['blogPost' => $blogPost];
        } catch (OptimisticLockException | TransactionRequiredException | ORMException $e) {
            echo $e;
        }

        throw new PostNotFoundException();
    }
}