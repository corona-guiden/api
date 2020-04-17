<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class GenerateTotalCasesImage
{
    public static function make($confirmed, $deaths)
    {
        $time = date('H:i   j M Y');

        return Image::make(resource_path('image-templates/total-cases.png'))
            ->text($confirmed, 1050, 325, function ($font) {
                $font->file(resource_path('fonts/Avenir-Black.ttf'));
                $font->align('right');
                $font->size(130);
                $font->color('#290303');
            })
            ->text($deaths, 1050, 555, function ($font) {
                $font->file(resource_path('fonts/Avenir-Black.ttf'));
                $font->align('right');
                $font->size(130);
                $font->color('#290303');
            })
            ->text(mb_strtoupper($time), 280, 101, function ($font) {
                $font->file(resource_path('fonts/Avenir-Black.ttf'));
                $font->size(72);
                $font->color('#fff');
            });
    }
}
