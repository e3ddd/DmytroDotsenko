<?php

namespace App\Repositories;

use App\Http\CheckNullableInterface;
use App\Http\CheckNullableParams;
use App\Models\Category;
use http\Exception\RuntimeException;

class CategoriesRepository implements CheckNullableInterface
{
    public function __construct()
    {
        $this->category = new Category();
    }

    public function checkNullable(mixed $value, mixed $exceptions = null)
    {
        $check = CheckNullableParams::checkNullable($value);

        if(is_array($value)){
            if($check){
                foreach ($check as $key => $item){
                    foreach ($exceptions as $exception){
                        if($exception == $key){
                            return;
                        }
                    }
                    throw new RuntimeException($key . ' is required ! Now is null');
                }
            }
        }else{
            if($check){
                throw new RuntimeException($value . ' is required ! Now is null');
            }
        }
    }

    public function getAllCategories()
    {
        return $this->category->all();
    }

    public function getParentCategories()
    {
        return $this->category->where('parent_id', null)->get();
    }

    public function getSubcategories($parent_id)
    {
        return $this->category->where('parent_id', $parent_id)->get();
    }

    public function storeCategory($category)
    {
        $this->category->create($category);
    }

    public function updateCategory($category)
    {
        $this->checkNullable($category);

        Category::find($category['category_id'])->update($category);
    }

    public function deleteCategory($category_id)
    {
        if(Category::where('parent_id', $category_id)->exists()){
            throw new RuntimeException('This category is parent and has children !');
        }

        Category::destroy($category_id);
    }

}
