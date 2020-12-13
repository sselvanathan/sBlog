<?php

declare(strict_types=1);

namespace Action;

use Database\Entities\BlogEntity;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use View\Home\HomeView;

class BlogAction

{
    /**
     * @Method("PUT")
     * @param $entityManager
     * @param string $title
     * @param string $post
     */
    public function createBlogPost(EntityManager $entityManager, string $title, string $post): void
    {
        $blogEntity = new BlogEntity();

        $blogEntity->setTitle($title);
        $blogEntity->setPost($post);
        $blogEntity->setCreatedAt(new DateTime('now'));

        try {
            $entityManager->persist($blogEntity);
        } catch (ORMException $e) {
            echo $e;
        }

        try {
            $entityManager->flush();
        } catch (OptimisticLockException | ORMException $e) {
            echo $e;
        }
    }

    public function getLatestBlogPost(EntityManager $entityManager)
    {
        return $entityManager
            ->getRepository(HomeView::BLOG_ENTITY_PATH)
            ->findBy([], ['id' => 'DESC'], 1, 0)[0];
    }
}