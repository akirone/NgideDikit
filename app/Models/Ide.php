<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ide extends Model
{
    use HasFactory;

    protected $table = 'ideas';

    protected $fillable = [
        'title',
        'description',
        'category',
        'is_favorite',
    ];

    public function categories()
    {
        return $this->belongstoMany(Kategori::class, 'kategori_idea', 'idea_id', 'category_id');
    }
}
