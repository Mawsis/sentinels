<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
    public function scopeFilterByName($query, $string)
    {
        return $query->where('dci', 'like', '%'.$string.'%')
                    ->where('brand', 'like', '%'.$string.'%');
    }
}
