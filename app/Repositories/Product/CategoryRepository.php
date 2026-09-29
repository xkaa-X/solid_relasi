<?php

namespace App\Repositories\Product;

use App\Models\Category;
use App\Contracts\Product\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function findById(int $id): ?Model
    {
        return Category::findOrFail($id);
    }

    public function create(array $data): ?Model
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): ?Model
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        
        return $category;
    }

    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);
        return (bool) $category->delete();
    }
}