<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGoal extends Model
{
    protected $fillable = [
        'user_id',
        'goal_text',
        'sort_order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
