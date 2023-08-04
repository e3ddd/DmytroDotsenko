<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Services\CategoriesService;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->categoryService = app(CategoriesService::class);
    }

    public function getAllCategories()
    {
        return $this->categoryService->getAllCategories();
    }

    public function getCategoryById(Request $request)
    {
        return $this->categoryService->getCategoryById($request->category_id);
    }

    public function getParentCategories()
    {
        return $this->categoryService->getParentCategories();
    }

    public function getSubcategories(Request $request)
    {
        return $this->categoryService->getSubcategories($request->parent_id);
    }

    public function storeCategory(CreateCategoryRequest $request)
    {
        $this->categoryService->storeCategory($request->category);
    }

    public function updateCategory(Request $request)
    {
        $this->categoryService->updateCategory($request->category);
    }

    public function editCategoryById(Request $request)
    {
        $this->categoryService->editCategoryById($request->category);
    }

    public function deleteCategory(Request $request)
    {
        $this->categoryService->deleteCategory($request->category_id);
    }
}
