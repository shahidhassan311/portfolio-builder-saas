<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'user_id',
        'organization_name',
        'role',
        'location',
        'start_date',
        'end_date',
        'currently_volunteering',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'currently_volunteering' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
