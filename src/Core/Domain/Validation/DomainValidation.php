<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function shouldNotBeEmpty(string $value, ?string $expectionMessage = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($expectionMessage ?? 'Should not be empty');
        }
    }

    public static function stringMaxLength(string $value, int $maxLength = 255, ?string $expectionMessage = null): void
    {
        if (strlen($value) >= $maxLength) {
            throw new EntityValidationException($expectionMessage ?? 'Should not be greater then ' . $maxLength);
        }
    }

    public static function stringMinLength(string $value, int $minLength = 3, ?string $expectionMessage = null): void
    {
        if (strlen($value) <= $minLength) {
            throw new EntityValidationException($expectionMessage ?? 'Should not be greater then ' . $minLength);
        }
    }
}