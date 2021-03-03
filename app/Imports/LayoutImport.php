<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LayoutImport implements ToCollection, WithStartRow {
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection) {
        return ExcelController::all();
    }

    public function startRow(): int {
        return 3;
    }

    public function map($map): array
    {
        return [
            Date::dateTimeToExcel($map->created_at),

        ];
    }

}
