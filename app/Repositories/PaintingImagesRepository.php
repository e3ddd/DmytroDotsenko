<?php

namespace App\Repositories;

use App\Http\CheckNullableInterface;
use App\Http\CheckNullableParams;
use App\Models\PaintingImage;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class PaintingImagesRepository implements CheckNullableInterface
{

    public function __construct()
    {
        $this->paintingImage = new PaintingImage();
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
            throw new RuntimeException($value . ' is required ! Now is null');
        }
    }

    public function getAllImages()
    {
        return $this->paintingImage->all();
    }

    public function getImageById($imageId)
    {
        $this->checkNullable($imageId);
        return $this->paintingImage->find($imageId);
    }

    public function storeImages($paintingId, $hash_id)
    {
        $this->checkNullable([$paintingId, $hash_id]);
        $this->paintingImage->create([
            'painting_id' => $paintingId,
            'hash_id' => $hash_id,
        ]);

    }

    public function saveImages($storeName, $file)
    {
        $this->checkNullable([$storeName]);
        if(is_file($file)){
            $file->storeAs('public/images', $storeName);
        }
    }
}
