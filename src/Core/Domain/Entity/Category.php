<?php

namespace Core\Domain\Entity;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Entity\Trait\MagicProperties;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MagicProperties;

    public function __construct(
        protected ?Uuid $id = null,
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ) {
        $this->id = $this->id ?? Uuid::random();
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
        DomainValidation::notNull($this->name);
        DomainValidation::stringMinLength($this->name);
        DomainValidation::stringMaxLength($this->name);

        if ($this->description !== '') {
            DomainValidation::stringMaxLength($this->description);
        }
    }
}
