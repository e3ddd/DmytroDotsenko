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

    public function getCategoryById($category_id)
    {
        return $this->categoriesRepository->getCategoryById($category_id);
    }

    public function getParentCategories()
    {
        return $this->categoriesRepository->getParentCategories();
    }

    public function getSubcategories($parent_id)
    {
        return $this->categoriesRepository->getSubcategories($parent_id);
    }

    public function storeCategory($category)
    {
        $this->categoriesRepository->storeCategory($category);
    }

    public function editCategoryById($category)
    {
        $this->categoriesRepository->editCategoryById($category);
    }

    public function deleteCategory($category_id)
    {
        $this->categoriesRepository->deleteCategory($category_id);
    }
}
