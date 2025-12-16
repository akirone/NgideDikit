<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserIdea extends Pivot
{
    protected $table = 'user_ideas';

    protected $fillable = [
        'user_id',
        'idea_id',
        'is_favorited',
    ];

    public function idea()
    {
        return $this->belongsTo(Ide::class, 'idea_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
