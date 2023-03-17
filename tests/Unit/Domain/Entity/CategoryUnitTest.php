<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes(): void
    {
        $category = new Category(
            name: 'new cat',
            description: 'new desc',
            isActive: true,
        );

        $this->assertEquals('new cat', $category->name);
        $this->assertEquals('new desc', $category->description);
        $this->assertEquals(true, $category->isActive);
    }

    public function testActivated(): void
    {
        $category = new Category(
            name: 'new cat',
            isActive: false,
        );

        $this->assertFalse($category->isActive);

        $category->activate();

        $this->assertTrue($category->isActive);
    }

    public function testDeactivated(): void
    {
        $category = new Category(
            name: 'new cat',
        );

        $this->assertTrue($category->isActive);

        $category->deactivate();

        $this->assertFalse($category->isActive);
    }
    
    public function testUpdated(): void
    {
        $uuid = 'uuid.value';

        $category = new Category(
            id: $uuid,
            name: 'new cat',
            description: 'new desc',
            isActive: true,
        );

        $category->update(
            name: 'new name',
            description: 'new description',
        );

        $this->assertEquals('new name', $category->name);
        $this->assertEquals('new description', $category->description);
    }

    public function testNameException()
    {
        $this->expectException(EntityValidationException::class);

        new Category(
            name: 'ne',
            description: 'new desc',
        );
    }
}