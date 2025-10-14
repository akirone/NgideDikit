<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'description'];

    public function ide_kategori()
    {
        return $this->hasMany(IdeKategori::class);
    }

    public function ideas()
    {
        return $this->belongstoMany(Kategori::class, 'kategori_idea', 'category_id', 'idea_id');
    }
}
