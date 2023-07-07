<?php

namespace App\Exports;

use App\Models\Section\Section;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class SectionExport implements FromQuery
{

    use Exportable;

    protected $sections;
    public function __construct($sections)
    {
        $this->$sections = $sections;
    }
    public function query()
    {
        // return Section::query()->whereKey($this->sections);
        return Section::query();
        // return Section::all();
    }
}
