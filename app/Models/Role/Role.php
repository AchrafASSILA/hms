<?php

namespace App\Models\Role;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Alias'];

    public function user()
    {
        $this->hasOne(User::class);
    }
}
