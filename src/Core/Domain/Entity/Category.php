<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Entity\Trait\MagicProperties;

class Category
{
    use MagicProperties;

    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ) {
        $this->validate();
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function deactivate(): void
    {
        $this->isActive = false;
    }

    public function update(string $name, string $description = ''): void
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->name)) {
            throw new EntityValidationException();
        }

        $nameLength = strlen($this->name);
        if ($nameLength > 255 || $nameLength <= 2) {
            throw new EntityValidationException();
        }

        $descriptionLength = strlen($this->description);
        if ($this->description !== '' && ($descriptionLength > 255 || $descriptionLength < 3)) {
            throw new EntityValidationException();
        }
    }
}
