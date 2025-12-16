<?php

namespace App\Imports;

use App\Models\Ide;
use App\Models\Kategori;
use App\Models\IdeKategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IdeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Create ide
        $ide = Ide::create([
            'title' => $row['judul'] ?? $row['title'],
            'description' => $row['deskripsi'] ?? $row['description'] ?? null,
            'is_favorite' => isset($row['favorit']) && strtolower($row['favorit']) === 'ya' ? true : false,
        ]);

        // Attach categories if provided
        if (isset($row['kategori']) && $row['kategori']) {
            $kategoriNames = array_map('trim', explode(',', $row['kategori']));
            foreach ($kategoriNames as $name) {
                $kategori = Kategori::where('name', $name)->first();
                if ($kategori) {
                    IdeKategori::create([
                        'idea_id' => $ide->id,
                        'category_id' => $kategori->id,
                    ]);
                }
            }
        }

        return $ide;
    }
}
