<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\PaintingImagesService;
use Illuminate\Http\Request;


class PaintingImagesController extends Controller
{

    public function __construct()
    {
        $this->paintingImagesService = app(PaintingImagesService::class);
    }

    public function getAllImages()
    {
        return $this->paintingImagesService->getAllImages();
    }

    public function getImageById(Request $request)
    {
        return $this->paintingImagesService->getImageById($request->imageId);
    }

    public function storeImage(Request $request)
    {
        return $request;
        $this->paintingImagesService->storeImage($request->paintingId, $request->images);
    }

}
