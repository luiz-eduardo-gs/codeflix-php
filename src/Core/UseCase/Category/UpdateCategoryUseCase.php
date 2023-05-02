<?php

namespace Core\UseCase\Category;

use Core\Doamin\Repository\CategoryRepositoryInterface;
use Core\Domain\Entity\Category;
use Core\UseCase\DTO\Category\UpdateCategoryInputDto;
use Core\UseCase\DTO\Category\UpdateCategoryOutputDto;

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