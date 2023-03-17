<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes(): void
    {
        $category = new Category(
            id: '123',
            name: 'new cat',
            description: 'new desc',
            isActive: true,
        );
        
        $this->assertEquals('new cat', $category->name);
        $this->assertEquals('new desc', $category->description);
        $this->assertEquals(true, $category->isActive);
    }
}