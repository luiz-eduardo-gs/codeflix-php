<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(string $value, string $expectionMessage = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($expectionMessage ?? 'Should not be empty');
        }
    }
}