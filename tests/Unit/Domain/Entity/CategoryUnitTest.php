<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testShouldBeAbleToInstantiateCategorySuccessfully(): void
    {
        $expectedName = 'Movies';
        $expectedDescription = 'Most watched.';
        $expectedIsActive = true;

        $category = new Category(
            name: $expectedName,
            description: $expectedDescription,
            isActive: $expectedIsActive,
        );

        $this->assertNotEmpty($category->id);
        $this->assertEquals($expectedName, $category->name);
        $this->assertEquals($expectedDescription, $category->description);
        $this->assertEquals($expectedIsActive, $category->isActive);
        $this->assertNotEmpty($category->createdAt());
    }

    public function testShouldBeAbleToActivateCategorySuccessfully(): void
    {
        $category = new Category(
            name: 'Movies',
            description: 'Most watched.',
            isActive: false,
        );

        $this->assertFalse($category->isActive);

        $category->activate();

        $this->assertTrue($category->isActive);
    }

    public function testShouldBeAbleToDeactivateCategorySuccessfully(): void
    {
        $category = new Category(
            name: 'Movies',
            description: 'Most watched.',
            isActive: true,
        );

        $this->assertTrue($category->isActive);

        $category->deactivate();

        $this->assertFalse($category->isActive);
    }
    
    public function testShouldBeAbleToUpdateACategory(): void
    {
        $expectedId = Uuid::random();
        $expectedName = 'Movies';
        $expectedDescription = 'Most watched category.';

        $category = new Category(
            id: $expectedId,
            name: 'Movie',
            description: 'Most watched.',
            isActive: false,
            createdAt: '2023-01-01 12:12:12',
        );

        $category->update(
            name: $expectedName,
            description: $expectedDescription,
            isActive: true,
        );

        $this->assertEquals($expectedId, $category->id);
        $this->assertEquals($expectedName, $category->name);
        $this->assertEquals($expectedDescription, $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testShouldThrowAnExceptionWhenNameIsInvalid(): void
    {
        $this->expectException(EntityValidationException::class);

        new Category(
            name: 'Mov',
            description: 'Most watched.',
        );
    }

    public function testShouldThrowAnExceptionWhenDescriptionIsInvalid(): void
    {
        $this->expectException(EntityValidationException::class);

        new Category(
            name: 'Movies',
            description: random_bytes(999999),
        );
    }
}