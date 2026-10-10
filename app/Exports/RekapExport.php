<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    public function __construct(private Collection $rekap) {}

    public function collection()
    {
        return $this->rekap;
    }

    public function headings(): array
    {
        return ['Fasilitas', 'Lokasi', 'Total Reservasi', 'Total Kerusakan'];
    }
}