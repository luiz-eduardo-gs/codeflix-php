<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\Category as CategoryModel;
use App\Repository\Eloquent\CategoryRepository;
use Core\Domain\Entity\Category;
use Tests\TestCase;

class EloquentCategoryRepository extends TestCase
{
    const TABLE_NAME = 'categories';
    /**
     * @dataProvider categoryProvider
     */
    public function testShouldBeAbleToInsertACategorySuccessfully(Category $category): void
    {
        $repository = new CategoryRepository(new CategoryModel());
        $actualCategory = $repository->insert($category);

        $this->assertInstanceOf(Category::class, $actualCategory);
        $this->assertDatabaseHas(self::TABLE_NAME, [
            'name' => $actualCategory->name,
            'description' => $actualCategory->description,
            'is_active' => $actualCategory->isActive,
        ]);
        $this->assertDatabaseCount(self::TABLE_NAME, 1);
    }

    public function testShouldBeAbleToRetrieveCategoryById(): void
    {
        $repository = new CategoryRepository(new CategoryModel());
        $repository->findById('123456');
    }

    public function categoryProvider(): array
    {
        return [
            'Category 1' => [
                'category' => new Category(
                    name: 'Movies',
                    description: 'Most watched.',
                    isActive: true,
                ),
            ],
            'Category 2' => [
                'category' => new Category(
                    name: 'Series',
                    description: 'Most loved.',
                    isActive: true,
                ),
            ],
            'Category 3' => [
                'category' => new Category(
                    name: 'Anime',
                    description: 'Most hyped.',
                    isActive: true,
                ),
            ],
            'Category 4' => [
                'category' => new Category(
                    name: 'OVAs',
                    description: 'OVAs category.',
                    isActive: false,
                ),
            ],
        ];
    }
}
