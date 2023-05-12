<?php

namespace Tests\Unit\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\Application\Category\ListCategoryUseCase;
use Core\Application\DTO\Category\ListCategory\ListCategoryInputDto;
use Core\Application\DTO\Category\ListCategory\ListCategoryOutputDto;
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
