<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'tagline',
        'about_title',
        'about_short',
        'about_long',
        'profile_image',
        'location',
        'contact_email',
        'contact_phone',
        'social_facebook',
        'social_instagram',
        'social_linkedin',
        'social_github',
        'social_twitter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
