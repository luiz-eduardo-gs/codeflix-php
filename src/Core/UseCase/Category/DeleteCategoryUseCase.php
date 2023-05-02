<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\UseCase\DTO\Category\DeleteCategoryInputDto;
use Core\UseCase\DTO\Category\DeleteCategoryOutputDto;

class DeleteCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    )
    {
    }

    public function execute(DeleteCategoryInputDto $input): DeleteCategoryOutputDto
    {
        $success = $this->repository->delete($input->id);

        return new DeleteCategoryOutputDto($success);
        
    }

}