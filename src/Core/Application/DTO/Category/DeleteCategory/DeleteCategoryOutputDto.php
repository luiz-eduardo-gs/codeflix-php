<?php

namespace Core\Application\DTO\Category\DeleteCategory;

class DeleteCategoryOutputDto
{
    public function __construct(
        public bool $success,
    ) {
    }
}
