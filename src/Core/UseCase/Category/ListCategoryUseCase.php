<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategoryInputDto;
use Core\UseCase\DTO\Category\ListCategoryOutputDto;

class ListCategoryUseCase
{
    public function __construct(private CategoryRepositoryInterface $repository)
    {
    }

    public function execute(ListCategoryInputDto $input): ListCategoryOutputDto
    {
        $category = $this->repository->findById($input->id);

        return new ListCategoryOutputDto(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive,
        );
    }
}
