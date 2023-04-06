<?php

namespace Core\UseCase\DTO\Category;

class ListCategoryOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $is_active = true,
    ) {
    }
}
