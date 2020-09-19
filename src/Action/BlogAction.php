<?php

declare(strict_types=1);

namespace Action;

use Database\Config\EntityManagerConfig;
use Database\Entities\BlogEntity;
use DateTime;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class BlogAction

{

    /**
     * @Method("PUT")
     * @param string $title
     * @param string $post
     */
    public function createBlogPost(string $title, string $post): void
    {
        $blog = new BlogEntity();
        $blog->setTitle($title);
        $blog->setPost($post);
        $blog->setCreatedAt(new DateTime('now'));

        $entityManager = (new EntityManagerConfig)->createEntityManager();

        try {
            $entityManager->persist($blog);
        } catch (ORMException $e) {
            echo $e;
        }

        try {
            $entityManager->flush();
        } catch (OptimisticLockException | ORMException $e) {
            echo $e;
        }

        echo "Der Blog mit der ID " . $blog->getId() . " wurde erstellt";
    }
}