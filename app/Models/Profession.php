<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $table = 'professions';

    protected $fillable = [
        'name',
        'icon',
    ];

    /**
     * Font Awesome 6 class suffix for the stored icon key (Lucide-style slugs from seed data).
     */
    public function fontAwesomeIconClass(): string
    {
        $icon = $this->icon ?? 'briefcase';

        return match ($icon) {
            'pen-tool' => 'pen-nib',
            'megaphone' => 'bullhorn',
            'bar-chart-3' => 'chart-column',
            default => $icon,
        };
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_professions');
    }


    public function themes()
{
    return $this->belongsToMany(
        Theme::class,
        'profession_theme',
        'profession_id',
        'theme_id'
    );
}
}
