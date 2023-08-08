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
        $imagickDst->setImageFormat('webp');
        $imagickDst->setImageCompressionQuality(50);
        $imagickDst ->setOption('webp:lossless', 'true');
        $imagickDst->writeImage($imgPath);

        return $imagickSrc->getImageGeometry();
    }
}
