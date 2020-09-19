<?php

declare(strict_types=1);

namespace Controller\Blog;

use Controller\Controller;
use Database\Config\EntityManagerConfig;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;

class BlogController extends Controller
{
    private const MODULE = 'Blog';
    public const BLOG_ENTITY_PATH = 'Database\Entities\BlogEntity';

    public function __construct(array $args)
    {
        try {
            parent::__construct(
                [
                    $this->setTemplatePath(self::MODULE),
                    $this->setTemplateData(
                        $this->getTwigData($args)
                    ),
                ]
            );
        } catch (PostNotFoundException $e) {
            parent:
            $this->__construct($args);
        }
    }

    public function getModule()
    {
        return ['module' => self::MODULE];
    }

    /**
     * @param $args
     * @return array
     * @throws PostNotFoundException
     */
    public function getTwigData($args): array
    {
        return array_merge(
            $this->getModule(),
            $this->getBlogPostById($args)
        );
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
