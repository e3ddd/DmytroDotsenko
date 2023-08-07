<?php

namespace App\Http;

use Imagick;

class ImageProcess
{
    /**
     * @throws \ImagickException
     */
    public static function process($imgPath)
    {
        $imagickSrc = new Imagick($imgPath);
        $compressionList = [
            Imagick::COMPRESSION_JPEG2000
        ];
        $imagickDst = new Imagick();
        $imagickDst->setCompression((int)$compressionList);
        $imagickDst->setCompressionQuality(20);
        $imagickDst->newPseudoImage(
            $imagickSrc->getImageWidth(),
            $imagickSrc->getImageHeight(),
            'canvas:white'
        );

        $imagickDst->compositeImage(
            $imagickSrc,
            Imagick::COMPOSITE_ATOP,
            0,
            0
        );
        $imagickDst->setImageFormat("jpg");
//        $imagickSrc->resizeImage(1920, 1080,0,1);
        $imagickDst->writeImage($imgPath);

        return $imagickSrc->getImageGeometry();
    }
}
