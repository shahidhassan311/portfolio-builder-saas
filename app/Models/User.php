<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'active_theme_id',
        'is_admin',
        'plan',
        'custom_domain',
        'remove_branding',
        'organization_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'remove_branding' => 'boolean',
        ];
    }

    public function planKey(): string
    {
        $plan = $this->plan ?? 'free';

        return array_key_exists($plan, config('plans', [])) ? $plan : 'free';
    }

    public function planConfig(): array
    {
        return config('plans.' . $this->planKey(), config('plans.free'));
    }

    public function isFreePlan(): bool
    {
        return $this->planKey() === 'free';
    }

    public function isProPlan(): bool
    {
        return $this->planKey() === 'pro';
    }

    public function isTeamsPlan(): bool
    {
        return $this->planKey() === 'teams';
    }

    public function activeTheme()
    {
        return $this->belongsTo(Theme::class, 'active_theme_id');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function skills()
    {
        return $this->hasMany(UserSkill::class)->orderBy('sort_order');
    }

    public function projects()
    {
        return $this->hasMany(UserProject::class)->orderBy('sort_order');
    }

    public function goals()
    {
        return $this->hasMany(UserGoal::class)->orderBy('sort_order');
    }

    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('sort_order')->orderByDesc('start_date');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('sort_order')->orderByDesc('start_date');
    }

}
