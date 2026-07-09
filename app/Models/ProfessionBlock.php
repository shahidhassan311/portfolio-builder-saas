<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionBlock extends Model
{
    protected $fillable = [
        'profession_id',
        'block_id',
        'is_default',
        'display_order',
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
