<?php

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(private string $uuid)
    {
        $this->isValid();
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    private function isValid(): void
    {
        if (! RamseyUuid::isValid($this->uuid)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $this->uuid));
        }
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
