<?php

namespace Tests\Unit\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\ListCategory\ListCategoryInputDto;
use Core\UseCase\DTO\Category\ListCategory\ListCategoryOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ListCategoryUseCaseUnitTest extends TestCase
{

    public function testShouldGetCategoryById(): void
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $entity = Mockery::mock(Category::class, [
            $uuid,
            'category test',
        ]);
        $entity->shouldReceive('createdAt');

        $entity->shouldReceive('id')->andReturn($uuid);

        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('findById')
            ->with($uuid)
            ->andReturn($entity);

        $inputDto = Mockery::mock(ListCategoryInputDto::class, [
            $uuid,
        ]);

        $useCase = new ListCategoryUseCase($repository);
        $outputDto = $useCase->execute($inputDto);

        $this->assertInstanceOf(ListCategoryOutputDto::class, $outputDto);
        $this->assertEquals('category test', $outputDto->name);
        $this->assertEquals($uuid, $outputDto->id);
    }
}
