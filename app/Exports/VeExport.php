<?php

namespace App\Exports;

use App\Models\Ve;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class VeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ve::all();
    }
    public function headings(): array
    {
        return [
            'Mã phiếu',
            'CMND',
            'Họ và tên',
            'Giới tính',
            'SĐT',
            'Số lượng',
            'Tổng tiền',
            'Trạng thái',
            'Chuyến xe',
            'Thao tác'
        ];
    }
}
