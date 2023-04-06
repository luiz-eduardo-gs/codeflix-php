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
        $pagination = $this->mockPagination();

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

    private function mockPagination(): PaginationInterface
    {
        $pagination = Mockery::mock(PaginationInterface::class);
        $pagination->shouldReceive('items')->andReturn([]);
        $pagination->shouldReceive('total')->andReturn(0);
        $pagination->shouldReceive('lastPage')->andReturn(0);
        $pagination->shouldReceive('firstPage')->andReturn(0);
        $pagination->shouldReceive('currentPage')->andReturn(0);
        $pagination->shouldReceive('perPage')->andReturn(0);
        $pagination->shouldReceive('to')->andReturn(0);
        $pagination->shouldReceive('from')->andReturn(0);

        return $pagination;
    }

    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }
}
