<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
                'active' => $section->Active,
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
        return 'hello';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string',
                'description' => 'required|max:100|string',

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            $section = Section::create([
                'Label' => $request->label,
                'Description' => $request->description,
                'Active' => $request->active == "true" ? 1 : 0,

            ]);
            if ($request->hasFile('icon')) {
                $image = $request->file('icon');
                $file_name = $image->getClientOriginalName();
                // move pic
                $imageName =   date('Y_m_d') . '_' . time() . '.png';
                $section->Icon = $imageName;
                $request->icon->move(public_path('/assets/images/sections'), $imageName);

                $section->save();
            }
            return response(['msg' => 'section save with succes ' . $section->Label], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => $e->getMessage()], 403);
        }
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
    }
    public function updateSection(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string',
                'description' => 'required|max:100|string',

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            //code...
            $section = Section::find($request->section_id);
            $section->update([
                'Label' => $request->label,
                'Description' => $request->description,
                'Active' => $request->active == "true" ? 1 : 0,
            ]);
            if ($request->hasFile('icon')) {
                $section->deleteImage();
                $image = $request->file('icon');
                $file_name = $image->getClientOriginalName();
                // move pic
                $imageName =   date('Y_m_d') . '_' . time() . '.png';
                $section->Icon = $imageName;
                $request->icon->move(public_path('/assets/images/sections'), $imageName);

                $section->save();
            }
            return response(['msg' => 'section update with succes ' . $section->Label], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 403);
        }
    }

    /**
     * generate excel file.
     */
    public function generateExcelSections()
    {
        return 'hello excel';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            //code...
            $data = array();
            $data['msg'] = 'deleted succesfully';
            $section = Section::where(['id' => $id])->first();
            $section->deleteImage();
            $section->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
