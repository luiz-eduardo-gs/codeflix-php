<?php

namespace Core\UseCase\DTO\Category;

class ListCategoryInputDto
{
    public function __construct(
        public string $id = '',
    ) {
    }
}
