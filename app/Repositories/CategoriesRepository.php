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

    public function checkNullable(mixed $value)
    {
        $check = CheckNullableParams::checkNullable($value);

        if(is_array($value)){
            if($check){
                foreach ($check as $key => $item){
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

    public function storeCategory($category)
    {
        $this->category->create($category);
    }
}
