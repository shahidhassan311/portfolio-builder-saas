<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'short_description',
        'project_url',
        'project_image',
        'sort_order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
