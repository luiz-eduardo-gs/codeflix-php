<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Trait\MagicProperties;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;

class Category
{
    use MagicProperties;

    public function __construct(
        private Uuid|string $id = '',
        private string $name = '',
        private string $description = '',
        private bool $isActive = true,
        private DateTime|string $createdAt = '',
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();

        $this->validate();
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function createdAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i:s');
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
