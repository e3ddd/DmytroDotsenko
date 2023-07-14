<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
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

    public function storeCategory(CreateCategoryRequest $request)
    {
        $this->categoryService->storeCategory($request->category);
    }
}
