<?php

    declare(strict_types=1);

    namespace Controllers\Blog;

    use Common\Controller;
    use Database\Config\EntityManagerConfig;
    use Database\Entities\BlogEntity;
    use DateTime;
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

        /**
         * @param array $args
         * @return array[]
         * @throws PostNotFoundException
         */
        public function getBlogPostById(array $args): array
        {
            $entityManager = (new EntityManagerConfig)->createEntityManager();
            try {
                $blogPostObject = $entityManager->find(self::BLOG_ENTITY_PATH, (int)$args[0]);
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
