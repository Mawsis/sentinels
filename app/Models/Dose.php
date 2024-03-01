<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dose extends Model
{
    use HasFactory;
    public function date()
    {
        return $this->belongsTo(Date::class);
    }
    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
