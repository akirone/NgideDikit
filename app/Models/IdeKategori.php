<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class IdeKategori extends Pivot
{
    protected $table = 'kategori_idea';

    protected $fillable = [
        'idea_id',
        'category_id',
    ];

    public function idea()
    {
        return $this->belongsTo(Ide::class, 'idea_id');
    }

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }
}
