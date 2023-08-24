<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    const STT_DISABLE = 0;
    const STT_ENABLE = 1;

    protected $fillable = [
        'name',
        'fixed_key',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STT_ENABLE);
    }
}
