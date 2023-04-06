<?php

namespace Core\UseCase\Category;

use Core\Doamin\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\ListCategoriesInputDto;
use Core\UseCase\DTO\Category\ListCategoriesOutputDto;

class ListCategoriesUseCase
{
    public function __construct(private CategoryRepositoryInterface $repository)
    {
    }

    public function execute(ListCategoriesInputDto $input): ListCategoriesOutputDto
    {
        $categories = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            itemsPerPage: $input->itemsPerPage
        );

        return new ListCategoriesOutputDto(
            items: $categories->items(),
            total: $categories->total(),
        );
    }
}
