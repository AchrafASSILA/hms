<?php

namespace App\Models\Section;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['Label', 'Slug', 'Description', 'Icon', 'Active'];
    public function getIcon()
    {
        $path = public_path("/assets/images/sections/" . $this->Icon);
        if (file_exists($path) && $this->Icon) {
            return asset("/assets/images/sections/" . $this->Icon);
        }
        return asset('/assets/images/sections/default.png');
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'Section');
    }
    public function deleteImage()
    {
        $path = public_path("/assets/images/sections/" . $this->Icon);
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}
