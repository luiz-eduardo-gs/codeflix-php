<?php

namespace Core\UseCase\DTO\Category;

class ListCategoriesOutputDto
{
    public function __construct(
        public array $items,
        public int $total,
    )
    {
    }
}
