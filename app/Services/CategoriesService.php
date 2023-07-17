<?php

namespace App\Services;

use App\Repositories\CategoriesRepository;

class CategoriesService
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getAllCategories()
    {
        return $this->categoriesRepository->getAllCategories();
    }

    public function storeCategory($category)
    {
        $this->categoriesRepository->storeCategory($category);
    }

    public function updateCategory($category)
    {
        $this->categoriesRepository->updateCategory($category);
    }

    public function deleteCategory($category_id)
    {
        $this->categoriesRepository->deleteCategory($category_id);
    }
}
