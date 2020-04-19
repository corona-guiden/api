<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class GenerateTotalCasesImage
{
    /**
     * @param int $confirmedCases
     * @param int $confirmedDeaths
     * @return \Intervention\Image\Image
     */
    public static function make(int $confirmedCases, int $confirmedDeaths)
    {
        $time = Carbon::now()
            ->setTimezone('Europe/Stockholm')
            ->format('14:00   j M Y');

        return Image::make(resource_path('image-templates/total-cases.png'))
            ->text($confirmedCases, 1050, 325, function ($font) {
                $font->file(resource_path('fonts/Avenir-Black.ttf'));
                $font->align('right');
                $font->size(130);
                $font->color('#290303');
            })
            ->text($confirmedDeaths, 1050, 555, function ($font) {
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
