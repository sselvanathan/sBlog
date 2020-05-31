<?php

    declare(strict_types=1);

    namespace Controllers\Blog;

    use Common\Controller;
    use Common\ControllerInterface;
    use Database\Config\EntityManagerConfig;
    use Database\Entities\BlogEntity;
    use DateTime;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Doctrine\ORM\TransactionRequiredException;

    class BlogController extends Controller implements ControllerInterface
    {
        private const MODULE = 'Blog';

        public function __construct(array $args)
        {
            try {
                parent::__construct(
                    [
                        $this->setTemplatePath(self::MODULE),
                        $this->setTemplateData(
                            array_merge(
                                $this->getModule(),
                                $this->getBlogPostById($args)
                            )
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

        public function getTwigData()
        {
            // TODO: Implement getTwigData() method.
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
                $blogPostObject = $entityManager->find('Database\Entities\BlogEntity', (int)$args[0]);
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
