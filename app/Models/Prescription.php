<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function doses()
    {
        return $this->hasMany(Dose::class);
    }
}
