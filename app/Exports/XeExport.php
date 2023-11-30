<?php

namespace App\Exports;

use App\Models\Xe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class XeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Xe::all();
    }
    public function headings(): array
    {
        return [
            'Mã xe',
            'Biển số xe',
            'Số ghế',
            'Loại xe',
            'Hình ảnh',
        ];
    }
}
