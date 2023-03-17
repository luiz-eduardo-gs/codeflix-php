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
}