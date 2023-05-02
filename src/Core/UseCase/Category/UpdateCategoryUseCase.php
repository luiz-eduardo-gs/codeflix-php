<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\UpdateCategory\UpdateCategoryInputDto;
use Core\UseCase\DTO\Category\UpdateCategory\UpdateCategoryOutputDto;

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
        );
    }

}