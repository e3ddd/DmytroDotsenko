<?php

namespace App\Repositories;

use App\Http\CheckNullableInterface;
use App\Http\CheckNullableParams;
use App\Models\Painting;
use RuntimeException;


class PaintingRepository implements CheckNullableInterface
{
    public function __construct()
    {
        $this->painting = new Painting();
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

    public function getAllPaintings()
    {
        return $this->painting->all();
    }

    public function getAllPaintingsWithPagination()
    {
        return $this->painting->with('images')->paginate(5);
    }

    public function getLastPainting()
    {
        return $this->painting->all()->last();
    }

    public function getPaintingById($paintingId)
    {
        return $this->painting->with('images')->find($paintingId);
    }

    public function storePainting($name, $name_en, $price, $description, $description_en, $year, $width, $height, $long, $sold_status)
    {
        $this->checkNullable([$name, $name_en, $price, $description, $description_en, $year, $width, $height, $long, $sold_status]);

        if($sold_status){
            $sold_status = 1;
        }

        $this->painting->create([
            'name' => $name,
            'name_en' => $name_en,
            'price' => $price,
            'description' => $description,
            'description_en' => $description_en,
            'year' => $year,
            'width' => $width,
            'height' => $height,
            'long' => $long,
            'sold_status' => $sold_status,
        ]);

        return $this->painting->all()->last()->id;
    }

    public function updatePainting($painting_id, $painting)
    {
        $this->checkNullable($painting);

        Painting::find($painting_id)->update($painting);
    }

    public function destroyPainting($paintingId)
    {
        $this->checkNullable($paintingId);

        $this->painting->destroy($paintingId);
    }

}
