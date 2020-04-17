<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class GenerateTotalCasesImage
{
    public static function make($confirmed, $deaths)
    {
        $time = date('H:i   j M Y');

        return Image::make(storage_path('app/total-cases-template.png'))
            ->text($confirmed, 1050, 325, function ($font) {
                $font->file(storage_path('app/fonts/Avenir-Black.ttf'));
                $font->align('right');
                $font->size(130);
                $font->color('#290303');
            })
            ->text($deaths, 1050, 555, function ($font) {
                $font->file(storage_path('app/fonts/Avenir-Black.ttf'));
                $font->align('right');
                $font->size(130);
                $font->color('#290303');
            })
            ->text(mb_strtoupper($time), 280, 101, function ($font) {
                $font->file(storage_path('app/fonts/Avenir-Black.ttf'));
                $font->size(72);
                $font->color('#fff');
            })
            ->response('png');
    }
}
