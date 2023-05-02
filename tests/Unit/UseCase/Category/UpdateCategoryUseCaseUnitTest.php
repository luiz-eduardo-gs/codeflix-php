<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\Domain\ValueObject\Uuid;
use Core\UseCase\Category\UpdateCategoryUseCase;
use Core\UseCase\DTO\Category\UpdateCategory\UpdateCategoryInputDto;
use Core\UseCase\DTO\Category\UpdateCategory\UpdateCategoryOutputDto;
use PHPUnit\Framework\TestCase;

class UpdateCategoryUseCaseUnitTest extends TestCase
{
    public function testShouldUpdateCategorySuccessfully(): void
    {
        $expectedId = (string)Uuid::random();
        $expectedName = 'Filmes';
        $expectedDescription = 'A categoria mais assistida';
        $expectedIsActive = true;

        $entity = new Category(
            id: $expectedId,
            name: 'Film',
            description: $expectedDescription,
            isActive: $expectedIsActive
        );

        $repository = \Mockery::mock(CategoryRepositoryInterface::class);
        $repository
            ->shouldReceive('findById')
            ->with($expectedId)
            ->once()
            ->andReturn($entity);

        $repository
            ->shouldReceive('update')
            ->with($entity)
            ->once()
            ->andReturn($entity);

        $inputDto = new UpdateCategoryInputDto(
            id: $expectedId,
            name: $expectedName,
            description: $expectedDescription,
            isActive: $expectedIsActive,
        );

        $useCase = new UpdateCategoryUseCase($repository);
        $actualOutput = $useCase->execute($inputDto);

        $this->assertInstanceOf(UpdateCategoryOutputDto::class, $actualOutput);
        $this->assertEquals($expectedId, $actualOutput->id);
        $this->assertEquals($expectedName, $actualOutput->name);
        $this->assertEquals($expectedDescription, $actualOutput->description);
        $this->assertEquals($expectedIsActive, $actualOutput->isActive);
    }

    public function testShouldDeactivateCategoryIfIsActiveIsFalse(): void
    {
        $expectedId = (string)Uuid::random();
        $expectedName = 'Filmes';
        $expectedDescription = 'A categoria mais assistida';
        $expectedIsActive = false;

        $entity = new Category(
            id: $expectedId,
            name: $expectedName,
            description: $expectedDescription,
            isActive: true
        );

        $repository = \Mockery::mock(CategoryRepositoryInterface::class);
        $repository
            ->shouldReceive('findById')
            ->with($expectedId)
            ->once()
            ->andReturn($entity);

        $repository
            ->shouldReceive('update')
            ->with($entity)
            ->once()
            ->andReturn($entity);

        $inputDto = new UpdateCategoryInputDto(
            id: $expectedId,
            name: $expectedName,
            description: $expectedDescription,
            isActive: $expectedIsActive,
        );

        $useCase = new UpdateCategoryUseCase($repository);
        $actualOutput = $useCase->execute($inputDto);

        $this->assertInstanceOf(UpdateCategoryOutputDto::class, $actualOutput);
        $this->assertEquals($expectedId, $actualOutput->id);
        $this->assertEquals($expectedName, $actualOutput->name);
        $this->assertEquals($expectedDescription, $actualOutput->description);
        $this->assertEquals($expectedIsActive, $actualOutput->isActive);
    }
}
