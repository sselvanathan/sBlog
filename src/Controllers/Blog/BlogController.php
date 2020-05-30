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

    class BlogController extends Controller implements ControllerInterface
    {
        public function __construct()
        {
            parent::__construct(
                [
                    $this->setTemplatePath('home'),
                    $this->setTemplateData(
                        [
                            $this->getModule()
                        ]
                    ),
                ]
            );
        }

        public function getModule()
        {
            return ['module' => 'Blog'];
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
    }
