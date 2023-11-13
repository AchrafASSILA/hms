<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Doctor\Doctor;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'auth_key',
        'adress',
        'phone',
        'active',
        'image',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function role_()
    {
        return $this->belongsTo(Role::class, 'role');
    }
    public function getImage()
    {
        $path = public_path("/assets/images/users/" . $this->image);
        if (file_exists($path) && $this->image) {
            return asset("/assets/images/users/" . $this->image);
        }
        return asset('/assets/images/users/default-user.png');
    }
}
