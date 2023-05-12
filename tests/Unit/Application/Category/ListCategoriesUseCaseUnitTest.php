<?php

namespace Tests\Unit\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;
use Core\Application\Category\ListCategoriesUseCase;
use Core\Application\DTO\Category\ListCategories\ListCategoriesInputDto;
use Core\Application\DTO\Category\ListCategories\ListCategoriesOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use stdClass;

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

    public function testShouldReturnAListOfCategories(): void
    {
        $items = new stdClass();
        $items->id = 'id';
        $items->name = 'name';
        $items->description = 'description';
        $items->is_active = 'is_active';
        $items->created_at = 'created_at';
        $items->updated_at = 'updated_at';
        $items->deleted_at = 'deleted_at';

        $pagination = $this->mockPagination([$items]);

        $repository = Mockery::mock(CategoryRepositoryInterface::class);
        $repository->shouldReceive('paginate')->andReturn($pagination);

        $useCase = new ListCategoriesUseCase($repository);
        $inputDto = Mockery::mock(ListCategoriesInputDto::class, [
            'cat',
            'DESC',
        ]);
        $outputDto = $useCase->execute($inputDto);

        $this->assertCount(1, $outputDto->items);
        $this->assertInstanceOf(stdClass::class, $outputDto->items[0]);
        $this->assertInstanceOf(ListCategoriesOutputDto::class, $outputDto);
    }

    private function mockPagination(array $items = []): PaginationInterface
    {
        $pagination = Mockery::mock(PaginationInterface::class);
        $pagination->shouldReceive('items')->andReturn($items);
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
