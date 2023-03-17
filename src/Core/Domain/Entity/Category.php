<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Trait\MagicProperties;

class Category
{
    use MagicProperties;

    public function __construct(
        protected string $id = '',
        protected string $name,
        protected string $description = '',
        protected bool $isActive = true,
    ) {
    }
}
