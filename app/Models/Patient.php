<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    public function medicalFiles()
    {
        return $this->hasMany(MedicalFile::class);
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
