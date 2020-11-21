<?php

declare(strict_types=1);

namespace View\Blog;

use Database\Config\EntityManagerConfig;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use View\View;

class BlogView extends View
{
    public const BLOG_ENTITY_PATH = 'Database\Entities\BlogEntity';

    function getTemplateName(): string
    {
        return 'BlogView.twig';
    }

    public function getTemplateData(): array
    {
        return array_merge(
            $this->jsFiles(),
            $this->cssFiles(),
            $this->getBlogPostById(),
        );
    }

    private function jsFiles(): array
    {
        return [
            "scripts" =>
                [
                ]
        ];
    }

    private function cssFiles(): array
    {
        return [
            "stylesheets" =>
                [
                ]
        ];
    }

    /**
     * @param array $args
     * @return array
     * @throws PostNotFoundException
     */
    public function getBlogPostById(array $args): array
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();
        try {
            $blogPostObject = $entityManager->find(self::BLOG_ENTITY_PATH, $args[1]);
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