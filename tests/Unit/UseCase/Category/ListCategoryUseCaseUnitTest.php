<?php

namespace Tests\Unit\UseCase\Category;

use Core\Doamin\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\ListCategoryInputDto;
use Core\UseCase\DTO\Category\ListCategoryOutputDto;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ListCategoryUseCaseUnitTest extends TestCase
{
    private $entity;
    private $repository;
    private $inputDto;
    private $useCase;
    private $spy;

    public function testShouldGetCategoryById(): void
    {
        $uuid = (string) Uuid::uuid4()->toString();

        $this->entity = Mockery::mock(Category::class, [
            $uuid,
            'category test',
        ]);

        $this->entity->shouldReceive('id')->andReturn($uuid);

        $this->repository = Mockery::mock(CategoryRepositoryInterface::class);
        $this->repository->shouldReceive('findById')
            ->with($uuid)
            ->andReturn($this->entity);

        $this->inputDto = Mockery::mock(ListCategoryInputDto::class, [
            $uuid,
        ]);

        $this->useCase = new ListCategoryUseCase($this->repository);
        $outputDto = $this->useCase->execute($this->inputDto);

        $this->assertInstanceOf(ListCategoryOutputDto::class, $outputDto);
        $this->assertEquals('category test', $outputDto->name);
        $this->assertEquals($uuid, $outputDto->id);

        $this->spy = Mockery::spy(CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('findById')
            ->with($uuid)
            ->andReturn($this->entity);

        $this->useCase = new ListCategoryUseCase($this->spy);
        $outputDto = $this->useCase->execute($this->inputDto);
        
        $this->spy->shouldHaveReceived('findById');
    }
}
