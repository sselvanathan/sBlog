<?php

    declare(strict_types=1);

    namespace Database\Entities;

    use DateTime;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Class BlogEntity
     * @ORM\Entity
     * @ORM\Table(name="blog")
     */
    class BlogEntity
    {
        /**
         * @ORM\Id
         * @ORM\Column(name="id", type="integer", length=11)
         * @ORM\GeneratedValue(strategy="IDENTITY")
         * @var int
         */
        protected int $id;

        /**
         * @ORM\Column(name="post", type="string", length=256)
         * @var string
         */
        protected string $post;

        /**
         * @ORM\Column(name="title", type="string", length=32)
         * @var string
         */
        protected string $title;

        /**
         * @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
         */
        protected DateTime $createdAt;

        public function getId(): int
        {
            return $this->id;
        }

        public function getPost(): string
        {
            return $this->post;
        }

        public function setPost(string $post): BlogEntity
        {
            $this->post = $post;
            return $this;
        }

        public function getTitle(): string
        {
            return $this->title;
        }

        public function setTitle(string $title): BlogEntity
        {
            $this->title = $title;
            return $this;
        }

        public function getCreatedAt(): DateTime
        {
            return $this->createdAt;
        }

        public function setCreatedAt(DateTime $createdAt): BlogEntity
        {
            $this->createdAt = $createdAt;
            return $this;
        }
    }
