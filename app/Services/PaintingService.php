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

    public function getLastPainting()
    {
        return $this->paintingRepository->getLastPainting();
    }

    public function getPaintingById($paintingId)
    {
        return $this->paintingRepository->getPaintingById($paintingId);
    }

    public function storePainting($name, $name_en, $price, $description, $width, $height, $long, $sold_status)
    {
        return $this->paintingRepository->storePainting($name, $name_en, $price, $description, $width, $height, $long, $sold_status);
    }

    public function updatePaintingById($paintingId, $param, $value)
    {
        $this->paintingRepository->updatePaintingById($paintingId, $param, $value);
    }

    public function destroyPainting($paintingId)
    {
        $this->paintingRepository->destroyPainting($paintingId);
    }


}
