<?php

namespace Tests\Unit\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\ValueObject\Uuid;
use Core\Application\Category\DeleteCategoryUseCase;
use Core\Application\DTO\Category\DeleteCategory\DeleteCategoryInputDto;
use Core\Application\DTO\Category\DeleteCategory\DeleteCategoryOutputDto;
use PHPUnit\Framework\TestCase;

class DeleteCategoryUseCaseUnitTest extends TestCase
{
    public function testShouldDeleteCategorySuccessfully(): void
    {
        $expectedId = (string)Uuid::random();

        $repository = \Mockery::mock(CategoryRepositoryInterface::class);
        $repository
            ->shouldReceive('delete')
            ->with($expectedId)
            ->once()
            ->andReturn(true);

        $inputDto = new DeleteCategoryInputDto($expectedId);

        $useCase = new DeleteCategoryUseCase($repository);
        $actualOutput = $useCase->execute($inputDto);

        $this->assertInstanceOf(DeleteCategoryOutputDto::class, $actualOutput);
        $this->assertTrue($actualOutput->success);
    }
}