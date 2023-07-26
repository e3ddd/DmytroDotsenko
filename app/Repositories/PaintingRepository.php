<?php

namespace App\Repositories;

use App\Http\CheckNullableInterface;
use App\Http\CheckNullableParams;
use App\Models\Category;
use App\Models\Painting;
use App\Models\PaintingImage;
use Illuminate\Support\Facades\Storage;
use RuntimeException;


class PaintingRepository implements CheckNullableInterface
{
    public function __construct()
    {
        $this->painting = new Painting();
    }

    public function checkNullable(mixed $value, mixed $exceptions = null)
    {
        $check = CheckNullableParams::checkNullable($value);

        if(is_array($value)){
            if($check){
                foreach ($check as $key => $item){
                    if($exceptions !== null){
                        foreach ($exceptions as $exception){
                            if($exception == $key){
                                return;
                            }
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

    public function getAllPaintings()
    {
        return $this->painting->with('images')->get();
    }

    public function getAllPaintingsWithPagination()
    {
        return $this->painting->with('images')->paginate(1);
    }

    public function getLastPainting()
    {
        return $this->painting->all()->last();
    }

    public function getPaintingById($paintingId)
    {
        return $this->painting->with('images')->find($paintingId);
    }

    public function getPaintingBySlug($slug)
    {
        $this->checkNullable($slug);

        return $this->painting->where('slug', $slug)->with('images')->get();
    }

    public function getPaintingByCategory($category_slug)
    {
        $this->checkNullable($category_slug);

        $category_id = Category::where('slug', $category_slug)->first()->id ?? null;

        return $this->painting->where('category_id', $category_id)->with('images')->get();

    }

    public function storePainting($painting)
    {
        $this->checkNullable($painting, ['price']);

        $this->painting->create($painting);

        return $this->painting->all()->last()->id;
    }

    public function updatePainting($painting_id, $painting)
    {
        $this->checkNullable($painting, ['price']);

        Painting::find($painting_id)->update($painting);
    }

    public function destroyPainting($paintingId)
    {
        $this->checkNullable($paintingId);

        $images = PaintingImage::where('painting_id', $paintingId)->get() ?? null;

        if($images !== null){
            foreach ($images as $image){
                if(Storage::disk('public')->exists('/images/' . $image->painting_id . '_' . $image->hash_id)){
                    Storage::disk('public')->delete('/images/' . $image->painting_id . '_' . $image->hash_id);
                }
            }
            $this->painting->destroy($paintingId);
        }



    }

}
