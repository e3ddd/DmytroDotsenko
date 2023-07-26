<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaintingRequest;
use App\Services\PaintingImagesService;
use App\Services\PaintingService;
use Illuminate\Http\Request;

class PaintingController extends Controller
{
    public function __construct()
    {
        $this->paintingService = app(PaintingService::class);
        $this->paintintImagesService = app(PaintingImagesService::class);
    }

    public function getAllPaintings()
    {
        return $this->paintingService->getAllPaintings();
    }

    public function getAllPaintingsWithPagination()
    {
        return $this->paintingService->getAllPaintingsWithPagination();
    }

    public function getLastPainting()
    {
        return $this->paintingService->getLastPainting();
    }

    public function getPaintingById(Request $request)
    {
        return $this->paintingService->getPaintingById($request->id);
    }

    public function getPaintingBySlug(Request $request)
    {
        return $this->paintingService->getPaintingBySlug($request->slug);
    }

    public function getPaintingsByCategory(Request $request)
    {
        return $this->paintingService->getPaintingByCategory($request->category_slug);
    }

    public function storePainting(StorePaintingRequest $request)
    {
        $paintingId = $this->paintingService->storePainting($request->painting);

        if($paintingId){
            foreach ($request->images as $image){
                $this->paintintImagesService->storeImages($paintingId, $image);
            }
        }
    }

    public function updatePainting(StorePaintingRequest $request)
    {
        $this->paintingService->updatePainting($request->painting_id, $request->painting);
    }

    public function destroyPainting(Request $request)
    {
        $this->paintingService->destroyPainting($request->paintingId);
    }
}
