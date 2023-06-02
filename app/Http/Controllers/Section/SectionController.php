<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = [];
        $data = [];
        foreach (Section::all() as $section) {
            # code...
            $section_ = [
                'id' => $section->id,
                'label' => $section->Label,
                'description' => $section->Description,
                'icon' => $section->getIcon()
            ];
            array_push($sections, $section_);
        }
        $data['sections'] = $sections;
        return response($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        print_r($request);
        exit;
        $this->validate($request, [
            'label' => 'required|max:100',
        ]);
        $section = Section::create([
            'Label' => $request->name,
            'Description' => $request->email,

        ]);
        return response(['msg' => 'section save with succes ' . $section->Label], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $data = array();
        $data['msg'] = 'deleted succesfully';
        $section = Section::where(['id' => $id])->first();
        $section->delete();
        return response($data, 200);
    }
}
