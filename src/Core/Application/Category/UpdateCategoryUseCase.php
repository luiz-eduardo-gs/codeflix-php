<?php

namespace Core\Application\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Application\DTO\Category\UpdateCategory\UpdateCategoryInputDto;
use Core\Application\DTO\Category\UpdateCategory\UpdateCategoryOutputDto;

class UpdateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    )
    {
    }

    public function execute(UpdateCategoryInputDto $input): UpdateCategoryOutputDto
    {
        $category = $this->repository->findById($input->id);

        $category->update(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $updatedCategory = $this->repository->update($category);

        return new UpdateCategoryOutputDto(
            id: $updatedCategory->id(),
            name: $updatedCategory->name,
            description: $updatedCategory->description,
            isActive: $updatedCategory->isActive,
            createdAt: $updatedCategory->createdAt(),
        );
    }

}