<?php

namespace App\Services;

use App\Repositories\PaintingRepository;

class PaintingService
{
    private PaintingRepository $paintingRepository;

    public function __construct(PaintingRepository $paintingRepository)
    {
        $this->paintingRepository = $paintingRepository;
    }

    public function getAllPaintings()
    {
        return $this->paintingRepository->getAllPaintings();
    }

    public function getPaintingById($paintingId)
    {
        return $this->paintingRepository->getPaintingById($paintingId);
    }

    public function storePainting($name, $name_en, $price, $description, $width, $height, $long, $sold_status)
    {
        $this->paintingRepository->storePainting($name, $name_en, $price, $description, $width, $height, $long, $sold_status);
    }

    public function updatePaintingById($paintingId, $param, $content)
    {
        $this->paintingRepository->updatePaintingById($paintingId, $param, $content);
    }

    public function destroyPainting($paintingId)
    {
        $this->paintingRepository->destroyPainting($paintingId);
    }


}
