<?php

namespace Core\UseCase\DTO\Category\UpdateCategory;

class UpdateCategoryOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public bool   $isActive
    )
    {
    }
}