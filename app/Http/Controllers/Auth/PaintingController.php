<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaintingRequest;
use App\Services\PaintingService;
use Illuminate\Http\Client\Request;

class PaintingController extends Controller
{
    public function __construct()
    {
        $this->paintingService = app(PaintingService::class);
    }

    public function getAllPaintings()
    {
        return $this->paintingService->getAllPaintings();
    }

    public function getPaintingById(Request $request)
    {
        return $this->paintingService->getPaintingById($request->id);
    }

    public function storePainting(StorePaintingRequest $request)
    {
        $this->paintingService->storePainting($request->name, $request->name_en, $request->price, $request->description, $request->width, $request->height, $request->long, $request->sold_status);
    }

    public function updatePaintingById(Request $request)
    {
        $this->paintingService->updatePaintingById($request->paintingId, $request->param, $request->content);
    }

    public function destroyPainting(Request $request)
    {
        $this->paintingService->destroyPainting($request->paintingId);
    }
}
