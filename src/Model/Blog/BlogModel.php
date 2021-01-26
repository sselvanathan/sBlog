<?php

declare(strict_types=1);

namespace Model\Blog;

use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use Model\Model;

class BlogModel extends Model
{
    public int $id;
    public string $title;
    public string $text;
    public DateTime $created_at;

    #[ArrayShape(['title ' => "array", 'post ' => "array"])] public function rules(): array
    {
        return [
            'id' => [
                Model::RULE_REQUIRED
            ],
            'title ' => [
                Model::RULE_REQUIRED,
                [Model::RULE_CHARACTER_MAX, 'max' => 70],
            ],
            'text ' => [
                Model::RULE_REQUIRED
            ],
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }
}