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
    public function testShouldCreateANewCategory(): void
    {
        $categoryUuid = Uuid::random();
        $categoryName = 'new cat';

        $entity = Mockery::mock(Category::class, [
            $categoryUuid,
            $categoryName,
        ]);
        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('insert')->andReturn($entity);

        $inputDto = Mockery::mock(CreateCategoryInputDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($repository);
        $outputDto = $useCase->execute($inputDto);

        $this->assertInstanceOf(CreateCategoryOutputDto::class, $outputDto);
        $this->assertEquals($categoryName, $outputDto->name);
        $this->assertEquals('', $outputDto->description);
    }
}
