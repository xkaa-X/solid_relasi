<?php

namespace App\Services\Product;

use App\Contracts\Product\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Exception;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepo->getAll();
    }

    public function getCategoryById(int $id): Model
    {
        return $this->categoryRepo->findById($id);
    }

    public function createCategory(array $data): Model
    {
        return $this->categoryRepo->create($data);
    }

    public function updateCategory(int $id, array $data): Model
    {
        return $this->categoryRepo->update($id, $data);
    }

    public function deleteCategory(int $id): bool
    {
        $category = $this->categoryRepo->findById($id);
        if ($category->products()->count() > 0) {
            throw new Exception('Tidak bisa menghapus kategori karena masih memiliki produk terkait.');
        }

        return $this->categoryRepo->delete($id);
    }
}