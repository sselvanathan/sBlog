<?php

declare(strict_types=1);

namespace View\Blog;

use Controller\Blog\CreateBlogController;
use Project\Config\Config;
use JetBrains\PhpStorm\ArrayShape;
use View\View;

class BlogView extends View
{
    function getTemplateName(): string
    {
        return 'BlogView.twig';
    }

    public function getTemplateData(?array $params): ?array
    {
        try {
            return array_merge(
                $this->jsFiles(),
                $this->cssFiles(),
                CreateBlogController::getBlogPostById((int)$params['id']),
            );
        } catch (PostNotFoundException $e) {
            echo $e;
        }
        return null;
    }

    #[ArrayShape(["scripts" => "array"])] protected function jsFiles(): array
    {
        return [
            "scripts" =>
                [
                    Config::getPublicDirectory() . "js/blog.js",
                ]
        ];
    }

    #[ArrayShape(["stylesheets" => "array"])] protected function cssFiles(): array
    {
        return [
            "stylesheets" =>
                [
                ]
        ];
    }
}