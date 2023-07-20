<?php

namespace App\Models\Doctor;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['User'];
    // user relation
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
}
