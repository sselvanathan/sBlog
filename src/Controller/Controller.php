<?php

namespace Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private const TEMPLATE_PATH = 'view/config/Templates/';

    private string $templatePath = '';

    private array $templateData = [];

    protected array $args;

    public function __construct(array $args = [])
    {
        $this->args = $args;
    }

    public function getTemplateData(): array
    {
        return $this->templateData;
    }

    public function setTemplateData(array $templateData): self
    {
        $this->templateData = $templateData;

        return $this;
    }

    public function getTemplatePath(): string
    {
        return $this->templatePath;
    }

    public function setTemplatePath(string $templateName): self
    {
        $this->templatePath = lcfirst($templateName) . '.twig';

        return $this;
    }

    public function getTwigEnvironment(): Environment
    {
        $loader = new FilesystemLoader(
            self::TEMPLATE_PATH);
        return new Environment($loader);
    }
}
