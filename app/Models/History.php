<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    // ✅ Definisikan konstan ENUM
    const STATUS_DONE = 'done';
    const STATUS_NOT_DONE = 'not_done';

    protected $table = 'histories';

    protected $fillable = [
        'user_id',
        'idea_id',
        'status',
        'file_path',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function idea()
    {
        return $this->belongsTo(Ide::class);
    }
}
