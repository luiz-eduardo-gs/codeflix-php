<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationUnitTest extends TestCase
{
    public function testShouldThrowExceptionWhenValueIsEmpty(): void
    {
        $this->expectException(EntityValidationException::class);

        DomainValidation::shouldNotBeEmpty('');
    }

    public function testShouldThrowExceptionWhenValueIsEmptyWithCustomExceptionMessage(): void
    {
        $expectedExceptionMessage = 'A custom error.';

        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        DomainValidation::shouldNotBeEmpty('', $expectedExceptionMessage);
    }

    public function testValueShouldNotExceedMaxLength(): void
    {
        $this->expectException(EntityValidationException::class);

        DomainValidation::stringMaxLength('A value', 3);
    }

    public function testValueLengthShouldNotBeLowerThanMin(): void
    {
        $this->expectException(EntityValidationException::class);

        DomainValidation::stringMinLength('A value', 16);
    }
}