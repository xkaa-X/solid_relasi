<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Services\Product\CategoryService;
use App\Http\Requests\Product\StoreCategoryRequest;
use App\Http\Requests\Product\UpdateCategoryRequest;
use App\Http\Resources\Product\CategoryResource;
use App\Traits\ApiResponseTrait;
use Exception;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            $categories = $this->categoryService->getAllCategories();
            return $this->successResponse(CategoryResource::collection($categories));
        } catch (Exception $e) {
            return $this->errorResponse($e, 'Gagal mengambil data kategori');
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->createCategory($request->validated());
            return $this->successResponse(new CategoryResource($category), 'Kategori berhasil dibuat', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e, 'Gagal membuat kategori', 400);
        }
    }

    public function show(int $id)
    {
        try {
            $category = $this->categoryService->getCategoryById($id);
            return $this->successResponse(new CategoryResource($category));
        } catch (Exception $e) {
            return $this->errorResponse($e, 'Kategori tidak ditemukan', 404);
        }
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->validated());
            return $this->successResponse(new CategoryResource($category), 'Kategori berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse($e, 'Gagal memperbarui kategori', 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return $this->successResponse(null, 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse($e, $e->getMessage() ?: 'Gagal menghapus kategori', 400);
        }
    }
}