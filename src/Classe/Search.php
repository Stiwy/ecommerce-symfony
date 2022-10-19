<?php

namespace App\Classe;

class Search
{
    /**
     * @var ?string
     */
    private ?string $string = "";

    /**
     * @var array
     */
    private array $categories = [];

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @param ?string $string
     */
    public function setString(?string $string): void
    {
        $this->string = $string;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }
}