<?php

namespace App\Models\Section;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Section extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Description', 'Icon'];
    public function getIcon()
    {
        if (file_exists(asset('assets/images/sections/') . $this->Icon)) {
            return asset('assets/images/sections/') . $this->Icon;
        }
        return asset('assets/images/sections/default.png');
    }
}
