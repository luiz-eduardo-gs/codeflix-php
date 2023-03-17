<?php

namespace Tests\Unit\UseCase\Category;

use Core\Doamin\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\Domain\ValueObject\Uuid;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CreateCategoryInputDto;
use Core\UseCase\DTO\Category\CreateCategoryOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    private $entity;
    private $repository;
    private $inputDto;

    public function testCreateNewCategory(): void
    {
        $categoryUuid = Uuid::random();
        $categoryName = 'new cat';

        $this->entity = Mockery::mock(Category::class, [
            $categoryUuid,
            $categoryName,
        ]);
        $this->repository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->repository->shouldReceive('insert')->andReturn($this->entity);

        $this->inputDto = Mockery::mock(CreateCategoryInputDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($this->repository);
        $outputDto = $useCase->execute($this->inputDto);

        $this->assertInstanceOf(CreateCategoryOutputDto::class, $outputDto);
        $this->assertEquals($categoryName, $outputDto->name);
        $this->assertEquals('', $outputDto->description);
    }
}