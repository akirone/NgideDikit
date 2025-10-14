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
}
