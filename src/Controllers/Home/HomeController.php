<?php

    declare(strict_types=1);

    namespace Controllers\Home;

    use Common\Controller;
    use Common\ControllerInterface;
    use Database\Config\EntityManagerConfig;

    class HomeController extends Controller implements ControllerInterface
    {
        public function __construct()
        {
            parent::__construct(
                [
                    $this->setTemplatePath('home'),
                    $this->setTemplateData(
                        array_merge(
                            $this->getModule(),
                            $this->getAllBlogPosts()
                        )
                    ),
                ]
            );
        }

        public function getModule(): array
        {
            return ['module' => 'Home'];
        }

        public function getTwigData(): array
        {
            return [
                $this->getAllBlogPosts()
            ];
        }

        public function getAllBlogPosts()
        {
            $entityManager = (new EntityManagerConfig)->createEntityManager();
            $blogPostRepository = $entityManager->getRepository('Database\Entities\BlogEntity');
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

