<?php

namespace App\Models\DoctorSections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSections extends Model
{
    use HasFactory;
    protected $fillable = ['Doctor', 'Section'];
}
