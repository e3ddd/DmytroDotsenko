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

    public function storePainting(StorePaintingRequest $request)
    {
        $paintingId = $this->paintingService->storePainting(
            $request->name, $request->name_en, $request->price,
            $request->description, $request->description_en,
            $request->year, $request->width, $request->height,
            $request->long, $request->sold_status);

        if($paintingId){
            foreach ($request->images as $image){
                $this->paintintImagesService->storeImages($paintingId, $image);
            }
        }
    }

    public function updatePaintingById(Request $request)
    {
        $this->paintingService->updatePaintingById($request->paintingId, $request->param, $request->value);
    }

    public function destroyPainting(Request $request)
    {
        $this->paintingService->destroyPainting($request->paintingId);
    }
}
