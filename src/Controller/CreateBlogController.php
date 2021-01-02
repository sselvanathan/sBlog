<?php

declare(strict_types=1);

namespace Controller;

use Database\Config\EntityManagerConfig;
use Database\Entities\BlogEntity;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use JetBrains\PhpStorm\ArrayShape;
use View\Blog\BlogView;
use View\Blog\PostNotFoundException;
use View\Home\HomeView;
use View\Twig;

class CreateBlogController
{
    public const BLOG_ENTITY_PATH = 'Database\Entities\BlogEntity';

    public function __construct()
    {
        $entityManager = (new EntityManagerConfig)->createEntityManager();

        CreateBlogController::createBlogPost($entityManager, $_POST['title'], $_POST['text']);

        $twig = new Twig();
        $twig->renderView(BlogView::class, [
                'id' => CreateBlogController::getLatestBlogPost($entityManager)->getId()
            ]
        );
    }

    /**
     * @Method("PUT")
     * @param $entityManager
     * @param string $title
     * @param string $post
     */
    public static function createBlogPost(EntityManager $entityManager, string $title, string $post): void
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

    public static function getLatestBlogPost(EntityManager $entityManager)
    {
        return $entityManager
            ->getRepository(HomeView::BLOG_ENTITY_PATH)
            ->findBy([], ['id' => 'DESC'], 1, 0)[0];
    }

    /**
     * @param int $id
     * @return array
     * @throws PostNotFoundException
     */
    #[ArrayShape(['blogPost' => "array"])] public static function getBlogPostById(int $id): array
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