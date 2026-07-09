<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function userBlocks()
    {
        return $this->hasMany(UserBlock::class);
    }

    public function professionBlocks()
    {
        return $this->hasMany(ProfessionBlock::class);
    }
}
