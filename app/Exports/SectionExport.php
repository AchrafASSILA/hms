<?php

namespace App\Exports;

use App\Models\Section\Section;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Trig\Secant;

use Illuminate\Contracts\View\View;

class SectionExport implements FromView
{

    use Exportable;

    public function view(): View
    {
        return view('exports.sections', [
            'sections' => Section::all()
        ]);
    }
}
