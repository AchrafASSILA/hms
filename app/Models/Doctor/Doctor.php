<?php

namespace App\Models\Doctor;

use App\Models\Section\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['User' , 'Section'];

    // user relation
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'Section');
    }

    public function getImage()
    {
        $path = public_path("/assets/images/users/" . $this->user->image);
        if (file_exists($path) && $this->user->image) {
            return asset("/assets/images/users/" . $this->user->image);
        }
        return asset('/assets/images/users/default-doctor.png');
    }
}
