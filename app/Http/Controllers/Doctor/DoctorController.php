<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
            $data = [];
            $list = Doctor::all();
            $doctors = [];
            foreach ($list as $doctor) {
                # code...
                $doctors[] = [
                    'id' => $doctor->id,
                    'name' => $doctor->user->name,
                    'email' => $doctor->user->email,
                    'phone' => $doctor->user->phone,
                    'adress' => $doctor->user->adress ? $doctor->user->adress : '---',
                    'role' => $doctor->user->role_->Label,
                    'image' => $doctor->user->getImage(),
                ];
            }
            $data['doctors'] = $doctors;
            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
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
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:100|string',
                'email' => 'required|max:100|string|email|unique:users,email',
                'phone' => 'required|numeric|digits:10|unique:users',

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'adress' => $request->adress,
                'role' => 2,
            ]);
            $doctor = Doctor::create([
                'User' => $user->id,
            ]);
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $file_name = $image->getClientOriginalName();
                // move pic
                $imageName =   date('Y_m_d') . '_' . time() . '.png';
                $user->image = $imageName;
                $request->file->move(public_path('/assets/images/users'), $imageName);

                $user->save();
            }
            return response(['msg' => 'Doctor save with succes ' . $user->name, 'doctor' => $doctor], 200);
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
        try {
            //code...
            $doctor = Doctor::where('id', $id)->first();
            $data = [];
            $data['doctor'] = [
                'user_id' => $doctor->user->id,
                'name' => $doctor->user->name,
                'email' => $doctor->user->email,
                'phone' => $doctor->user->phone,
                'adress' => $doctor->user->adress,
                'active' => $doctor->user->active,
                'image' => $doctor->getImage(),
            ];
            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 403);
        }
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
        //
    }
}
