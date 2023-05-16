<?php

namespace App\Repository\Eloquent;

use App\Models\Category as CategoryModel;
use Core\Domain\Entity\Category;
use Core\Domain\Repository\CategoryRepositoryInterface;
use Core\Domain\Repository\PaginationInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(private CategoryModel $model)
    {
        
    }
    public function insert(Category $category): Category
    {
        $categoryCreated = $this->model->create([
            'id' => $category->id(),
            'name' => $category->name,
            'description' => $category->description,
            'is_active' => $category->isActive,
            'created_at' => $category->createdAt(),
        ]);

        return $this->toEntity($categoryCreated);
    }

    public function findById(string $id): Category
    {
        $category = $this->model->find('123');

        if ($category === null) {
            throw new \Exception('Model not found.');
        }

        return $this->toEntity($category);
    }

    public function findAll(string $filter = '', $order = 'DESC'): array
    {
        return [];
    }
    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $itemsPerPage = 15): PaginationInterface
    {
        return new class implements PaginationInterface{};
    }

    public function update(Category $category): Category
    {
        return new Category();
    }

    public function delete(string $id): bool
    {
        return true;
    }

    private function toEntity(object $category): Category
    {
        return new Category(
            id: $category->id,
            name: $category->name,
            description: $category->description,
            isActive: $category->is_active,
            createdAt: $category->created_at, 
        );
    }
}