<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GenerateTotalCasesImage
{
    private \Intervention\Image\Image $image;

    public function __construct($image)
    {
        $this->image = $image;
    }

    /**
     * @param int $confirmedCases
     * @param int $confirmedDeaths
     * @return GenerateTotalCasesImage
     */
    public static function make(int $confirmedCases, int $confirmedDeaths)
    {
        $time = Carbon::now()
            ->setTimezone('Europe/Stockholm')
            ->format('14:00   j M Y');

        $image = Image::make(resource_path('image-templates/total-cases.png'))
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

        return new static($image);
    }

    public function get()
    {
        return $this->image;
    }

    public function save()
    {
        File::isDirectory(storage_path('app/public/stats')) or File::makeDirectory(storage_path('app/public/stats'), 0755, true, true);

        return $this->image->save(storage_path('app/public/stats/total.png'));
    }
}
