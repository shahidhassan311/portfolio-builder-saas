<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'organization',
        'issue_date',
        'credential_url',
        'description',
        'sort_order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
