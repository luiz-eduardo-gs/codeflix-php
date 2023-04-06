<?php

namespace Tests\Unit\UseCase\Category;

use Core\Doamin\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\UseCase\DTO\Category\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategoriesOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testShouldReturnAnEmptyList(): void
    {
        $pagination = Mockery::mock(PaginationInterface::class);
        $pagination->shouldReceive('total')->andReturn(0);
        $pagination->shouldReceive('items')->andReturn([]);

        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('paginate')->andReturn($pagination);

        $useCase = new ListCategoriesUseCase($repository);
        $inputDto = Mockery::mock(ListCategoriesInputDto::class, [
            'cat',
            'DESC',
        ]);
        $outputDto = $useCase->execute($inputDto);

        $this->assertCount(0, $outputDto->items);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $outputDto);
    }
}
