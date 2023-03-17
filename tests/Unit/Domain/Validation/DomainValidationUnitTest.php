<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull(): void
    {
        $value = '';

        $this->expectException(EntityValidationException::class);

        DomainValidation::notNull($value);
    }

    public function testNotNullWithCustomExceptionMessage(): void
    {
        $value = '';
        
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('custom error');

        DomainValidation::notNull($value, 'custom error');
    }

    public function testStringMaxLength(): void
    {
        $value = 'tes';

        $this->expectException(EntityValidationException::class);

        DomainValidation::stringMaxLength($value, 3, 'custom error');
    }

    public function testStringMinLength(): void
    {
        $value = 'test';

        $this->expectException(EntityValidationException::class);

        DomainValidation::stringMinLength($value, 8, 'custom error');
    }
}