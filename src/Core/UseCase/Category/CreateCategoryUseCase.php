<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\DTO\Category\CreateCategory\{
    CreateCategoryInputDto,
    CreateCategoryOutputDto,
};

class CreateCategoryUseCase
{

    public function __construct(private CategoryRepositoryInterface $repository)
    {
    }

    public function execute(CreateCategoryInputDto $input): CreateCategoryOutputDto
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $inserted = $this->repository->insert($category);

        return new CreateCategoryOutputDto(
            id: $inserted->id,
            name: $inserted->name,
            description: $inserted->description,
            is_active: $inserted->isActive,
            created_at: $inserted->createdAt(),
        );
    }
}
