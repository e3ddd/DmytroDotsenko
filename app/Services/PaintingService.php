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

    public function getAllPaintingsWithPagination()
    {
        return $this->paintingRepository->getAllPaintingsWithPagination();
    }

    public function getLastPainting()
    {
        return $this->paintingRepository->getLastPainting();
    }

    public function getPaintingById($paintingId)
    {
        return $this->paintingRepository->getPaintingById($paintingId);
    }

    public function getPaintingBySlug($slug)
    {
        return $this->paintingRepository->getPaintingBySlug($slug);
    }

    public function getPaintingByCategory($subcategory_slug, $category_slug)
    {
        return $this->paintingRepository->getPaintingByCategory($subcategory_slug, $category_slug);
    }

    public function storePainting($painting)
    {
        return $this->paintingRepository->storePainting($painting);
    }

    public function updatePainting($painting_id, $painting)
    {
        $this->paintingRepository->updatePainting($painting_id, $painting);
    }

    public function destroyPainting($paintingId)
    {
        $this->paintingRepository->destroyPainting($paintingId);
    }


}
