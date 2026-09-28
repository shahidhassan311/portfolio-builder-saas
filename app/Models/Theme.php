<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'preview_image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class, 'active_theme_id');
    }


    public function professions()
{
    return $this->belongsToMany(
        Profession::class,
        'profession_theme',
        'theme_id',
        'profession_id'
    );
}

}
