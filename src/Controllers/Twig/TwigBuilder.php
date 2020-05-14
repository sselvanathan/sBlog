<?php

    declare(strict_types=1);

    namespace Controllers\Twig;

    class TwigBuilder
    {
        const TEMPLATE_PATH = 'src/Views/Templates/';

        public function getTwigTemplateName(?string $url = 'home'): string
        {
            switch ($url) {
                case 'home':
                    $template = 'home';
                    break;
                default:
                    $template = 'error';
            }

            return $template . '.twig';
        }

        public function getTwigTemplatePath(): string
        {
            return self::TEMPLATE_PATH;

        }

        public function getTwigData()
        {
            return [];
        }
    }
