<?php

    use Controllers\Twig\TwigBuilder;

    require 'vendor/autoload.php';
    require 'autoload.php';

    $twigBuilder = new TwigBuilder();
    $loader = new \Twig\Loader\FilesystemLoader($twigBuilder->getTwigTemplatePath());
    $twig = new \Twig\Environment($loader);

    try {
        echo $twig->render(
            $twigBuilder->getTwigTemplateName(),
            $twigBuilder->getTwigData()
        );
    } catch (\Twig\Error\LoaderError $e) {
    } catch (\Twig\Error\RuntimeError $e) {
    } catch (\Twig\Error\SyntaxError $e) {
    }
