<?php


namespace App\Imports;

use App\RegionStat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FourthSheetImport implements ToCollection, WithStartRow
{

    /**
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (!isset($row[0])) {
                return null;
            }

            RegionStat::updateOrCreate([
                'region' => mb_strtolower($row[0]),
            ], [
                'region' => mb_strtolower($row[0]),
                'infected' => $row[1],
                'infected_per_100000_ppl' => $row[2],
                'intensive_care' => $row[3],
                'deceased' => $row[4],
            ]);
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
