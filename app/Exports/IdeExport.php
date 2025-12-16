<?php

namespace App\Exports;

use App\Models\Ide;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IdeExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Ide::with('categories')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Kategori',
            'Favorit',
            'Tanggal Dibuat',
        ];
    }

    public function map($ide): array
    {
        return [
            $ide->id,
            $ide->title,
            $ide->categories->pluck('name')->join(', '),
            $ide->is_favorite ? 'Ya' : 'Tidak',
            $ide->created_at ? $ide->created_at->format('d-m-Y H:i') : '-',
        ];
    }
}
