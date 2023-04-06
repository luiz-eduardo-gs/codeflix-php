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

class CreateCategoryUseCaseUnitTest extends TestCase
{
    private $entity;
    private $repository;
    private $spy;
    private $inputDto;

    public function testShouldCreateANewCategory(): void
    {
        $categoryUuid = Uuid::random();
        $categoryName = 'new cat';

        $this->entity = Mockery::mock(Category::class, [
            $categoryUuid,
            $categoryName,
        ]);
        $this->repository = Mockery::mock(CategoryRepositoryInterface::class);
        $this->repository->shouldReceive('insert')->andReturn($this->entity);

        $this->inputDto = Mockery::mock(CreateCategoryInputDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($this->repository);
        $outputDto = $useCase->execute($this->inputDto);

        $this->assertInstanceOf(CreateCategoryOutputDto::class, $outputDto);
        $this->assertEquals($categoryName, $outputDto->name);
        $this->assertEquals('', $outputDto->description);

        $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->entity);

        $useCase = new CreateCategoryUseCase($this->spy);
        $outputDto = $useCase->execute($this->inputDto);

        $this->spy->shouldHaveReceived('insert');
    }
}
