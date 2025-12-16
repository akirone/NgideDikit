<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KategoriExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Kategori::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Kategori',
            'Deskripsi',
            'Tanggal Dibuat',
        ];
    }

    public function map($kategori): array
    {
        return [
            $kategori->id,
            $kategori->name,
            $kategori->description ?? '-',
            $kategori->created_at ? $kategori->created_at->format('d-m-Y H:i') : '-',
        ];
    }
}
