<?php

namespace Tests\Unit\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\Domain\ValueObject\Uuid;
use Core\Application\Category\CreateCategoryUseCase;
use Core\Application\DTO\Category\CreateCategory\CreateCategoryInputDto;
use Core\Application\DTO\Category\CreateCategory\CreateCategoryOutputDto;
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
        $entity->shouldReceive('createdAt');

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
