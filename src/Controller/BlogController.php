<?php

declare(strict_types=1);

namespace Controller;

use Action\BlogAction;

class BlogController
{
    public function handleNewBlogPost(): void
    {
        (new BlogAction)->createBlogPost($_POST['title'], $_POST['text']);
    }
}