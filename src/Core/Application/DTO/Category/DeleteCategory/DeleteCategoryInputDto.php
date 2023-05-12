<?php

namespace Core\Application\DTO\Category\DeleteCategory;

class DeleteCategoryInputDto
{
    public function __construct(
        public string $id,
    ) {
    }
}
