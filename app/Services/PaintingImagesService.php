<?php

namespace App\Services;

use App\Repositories\PaintingImagesRepository;
use App\Repositories\PaintingRepository;
use Illuminate\Support\Facades\Hash;

class PaintingImagesService
{
    private PaintingImagesRepository $paintingImagesRepository;

    public function __construct(PaintingImagesRepository $paintingImagesRepository)
    {
        $this->paintingImagesRepository = $paintingImagesRepository;
    }

    public function getAllImages()
    {
        return $this->paintingImagesRepository->getAllImages();
    }

    public function getImageById($imageId)
    {
        return $this->paintingImagesRepository->getImageById($imageId);
    }

    public function storeImages($paintingId, $image)
    {
            $storeName = $paintingId . '_' . $image->hashName();
            $this->paintingImagesRepository->storeImages($paintingId,  $image->hashName());
            $this->paintingImagesRepository->saveImages($storeName, $image);


    }
}
